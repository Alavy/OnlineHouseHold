<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use App\Models\Worker;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;

use App\Events\MessageEvent;
use App\Events\AppointmentEvent;

class SslCommerzPaymentController extends Controller
{
    public function payViaAjax(Request $request)
    {

        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # Fuck you SslCommerz for your bokchod Api mistake
        $data=$request->cart_json;// because sslcommerz send the data as string rather than as objects 
        $data=json_decode($data,true);
        $post_data = array();
        $post_data['total_amount'] = $data['amount']; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $data['cus_name'];
        $post_data['cus_email'] = $data['cus_email'];
        $post_data['cus_add1'] = $data['cus_addr1'];
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $data['cus_phone'];
        $post_data['cus_fax'] = "";
        $post_data['appointment_id'] = $data['appointment_id'];

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('transactions')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency'],
                'appointment_id' => $post_data['appointment_id']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
        $message=array("Transaction is Processing");

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order table against the transaction id or order id.
        $order_detials = DB::table('transactions')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status','appointment_id','currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('transactions')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);
                    array_push($message,"Transaction is successfully Completed");
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                $update_product = DB::table('transactions')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Failed']);

                array_push($message,"validation Fail");
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            array_push($message,"Transaction is successfully Completed");
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            array_push($message,"Invalid Transaction");

        }
        $appointment_id=$order_detials->appointment_id;

        $appointment = Appointment::find($appointment_id);
        $appointment->isPaidUp=true;
        $appointment->save();
        $workerUserIdentity=User::find(Worker::find($appointment->worker_id)->user_id)->user_identity;
        broadcast(new AppointmentEvent($appointment,$workerUserIdentity))->toOthers();
        return view('auth.client.transaction-state')->with('message',$message);

    }

    public function fail(Request $request)
    {
        $message=array();
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('transactions')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('transactions')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            array_push($message,"Transaction is Falied");

        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            array_push($message,"Transaction is already Successful");

        } else {

            array_push($message,"Transaction is Invalid");

        }
        return view('auth.client.transaction-state')->with('message',$message);


    }

    public function cancel(Request $request)
    {
        $message=array();

        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('transactions')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            array_push($message,"Transaction is Cancel");

        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            array_push($message,"Transaction is already Successful");

        } else {

            array_push($message,"Transaction is Invalid");

        }
        return view('auth.client.transaction-state')->with('message',$message);
    }

    public function ipn(Request $request)
    {
        $message=array();

        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('transactions')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('transactions')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    array_push($message,"Transaction is successfully Completed");
                    
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('transactions')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed']);

                    array_push($message,"validation Fail");
                }

            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                array_push($message,"Transaction is already successfully Completed");

            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                array_push($message,"Invalid Transaction");

            }
        } else {
            array_push($message,"Invalid Data");
        }
        return view('auth.client.transaction-state')->with('message',$message);

    }

}
