<?php

namespace App\Http\Controllers\Auth\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Client;
use App\Models\Worker;
use App\Models\Appointment;
use App\Models\Message;
use App\Models\ChatRoom;

use App\Events\MessageEvent;
use App\Events\AppointmentEvent;



use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;



class RegisteredClientController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.client.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'dateOfBirth' => 'required',
            'sex' => 'required',
            'address' => 'required|string|max:400',
            'mobileNumber' => 'required|max:14'
        ]);
        $user = User::find(Auth::user()->id);
        $user->profileUpdated = true;
        $user->save();

        Client::create([
            'user_id'=> $request->user()->id,
            'dateOfBirth' => $request->dateOfBirth,
            'sex' => $request->sex,
            'address' => $request->address,
            'mobileNumber' =>$request->mobileNumber
        ]);
        
        return redirect(route('dashboard'));
    }
    public function show()
    {
        $client = DB::table('clients')
            ->join('users','users.id','=','clients.user_id')
            ->select('users.name as name','users.email as email',
            'clients.mobileNumber as mobileNumber',
            'clients.dateOfBirth as dateOfBirth','clients.sex as sex',
            'clients.address as address')
            ->where('clients.id','=',Auth::user()->client->id)
            ->get()
            ->first();
        return \view('auth.client.dashboard')->with('client',$client);
    }
    public function create_appointment($worker_id)
    {
        if(empty($worker_id)){
            return redirect(RouteServiceProvider::HOME);
        }
        return view('auth.client.create-appointment')->with('worker_id',$worker_id);
    }
    public function detail_appointment($worker_id,$appointment_id)
    {
        if(empty($worker_id)){
            return redirect(RouteServiceProvider::HOME);
        }
        if(empty($appointment_id)){
            return redirect(RouteServiceProvider::HOME);
        }

        $worker = DB::table('workers')
            ->join('users','users.id','=','workers.user_id')
            ->select('users.name as name','users.email as email',
            'workers.expertField as expertField','workers.id as id',
            'workers.perHourFee as fee', 'workers.experience as experience',
            'workers.aboutme as aboutme','workers.address as address','workers.mobileNumber as mobileNumber')
            ->where('workers.id','=',$worker_id)
            ->get()
            ->first();

        $appoinments = DB::table('appointments')
                        ->select('appointments.appointmentDate as date',
                                'appointments.fee as fee')
                        ->where('appointments.client_id','=',$worker_id)
                        ->where('appointments.worker_id','=',Auth::user()->client->id)
                        ->get();
        $appointment = Appointment::find($appointment_id);
        $appointment->isReviewed=true;
        $appointment->save();

        $client = DB::table('clients')
                        ->join('users','users.id','=','clients.user_id')
                        ->select('users.name as name','users.email as email',
                        'clients.mobileNumber as mobileNumber',
                        'clients.dateOfBirth as dateOfBirth','clients.sex as sex',
                        'clients.address as address')
                        ->where('clients.id','=',Auth::user()->client->id)
                        ->get()
                        ->first();

        return \view('auth.client.detail-appointment')
        ->with('worker',$worker)
        ->with('appoinments',$appoinments)
        ->with('client',$client)
        ->with('appointment_id',$appointment_id);
    }
    public function store_appointment(Request $request)
    {
        $request->validate([
            'appointmentDate' => 'required|date',
            'appointmentTime' => 'required|date_format:H:i',
            'address' => 'required|string|max:400',
            'worker_id' => 'required|integer',
        ]);
        $worker_id = $request->worker_id;
        $worker = Worker::find($worker_id);
       
        if(empty($worker)){
            return redirect(RouteServiceProvider::HOME);
        }
        
        $appointment = Appointment::create([
            'worker_id'=> $worker_id,
            'client_id' => $request->user()->client->id,
            'appointmentDate' => $request->appointmentDate.' '.$request->appointmentTime,
            'address'=> $request->address,
            'fee'=>$worker->perHourFee
        ]);

        $room = DB::table('chat_rooms')
        ->select('chat_rooms.id as id')
        ->where('client_id','=', $request->user()->client->id)
        ->where('worker_id','=',$worker_id)
        ->first();
        if($room === null || empty($room)){

            ChatRoom::create([
                'client_id' =>$request->user()->client->id,
                'worker_id'=> $worker_id,
            ]);
        }

        $workerUserIdentity=User::find(Worker::find($worker_id)->user_id)->user_identity;

        broadcast(new AppointmentEvent($appointment,$workerUserIdentity))->toOthers();

        $client = DB::table('clients')
            ->join('users','users.id','=','clients.user_id')
            ->select('users.name as name','users.email as email',
            'clients.mobileNumber as mobileNumber',
            'clients.dateOfBirth as dateOfBirth','clients.sex as sex',
            'clients.address as address')
            ->where('clients.id','=',Auth::user()->client->id)
            ->get()
            ->first();

        return view('auth.client.dashboard')->with('success','successfully created Appointment')->with('client',$client);
    }

    public function search_worker(Request $request)
    {
        return view('auth.client.search-worker');
    }

    public function post_search_worker(Request $request)
    {
        $request->validate([
            'searchWorker' => 'required|string|max:1000',
            'latitude'=>'required|numeric',
            'longitude'=>'required|numeric'
        ]);
        $latitude=$request->latitude;
        $longitude=$request->longitude;

        $q = $request->searchWorker;      
        $workers = DB::table('users')
            ->join('workers','users.id','=','workers.user_id')
            ->select('users.name as name', 'users.email as email','workers.id as id',
             'workers.expertField as expertField',
              'workers.perHourFee as fee', 'workers.experience as experience',
              'workers.aboutme as aboutme',
              'workers.address as address','workers.mobileNumber as mobileNumber',
              'workers.latitude as latitude','workers.longitude as longitude')
            ->where('users.name','LIKE','%'.$q.'%')
            ->orWhere('users.email','LIKE','%'.$q.'%')
            ->orWhere('workers.expertField','LIKE','%'.$q.'%')
            ->orWhere('workers.address','LIKE','%'.$q.'%')
            ->orWhere('workers.aboutme','LIKE','%'.$q.'%')
            ->orWhere('workers.mobileNumber','LIKE','%'.$q.'%')
            ->get();
        $distances=array();
        foreach($workers as $item){
            array_push($distances,$this->twopoints_on_earth( $latitude, $longitude,
            $item->latitude,  $item->longitude));
        }
        return view('auth.client.search-worker')
        ->with('workers',$workers)
        ->with('latitude',$latitude)
        ->with('longitude',$longitude)
        ->with('distances',$distances);
    }
    function twopoints_on_earth($latitudeFrom, $longitudeFrom,
                                    $latitudeTo,  $longitudeTo)
      {
           $long1 = deg2rad($longitudeFrom);
           $long2 = deg2rad($longitudeTo);
           $lat1 = deg2rad($latitudeFrom);
           $lat2 = deg2rad($latitudeTo);
             
           //Haversine Formula
           $dlong = $long2 - $long1;
           $dlati = $lat2 - $lat1;
             
           $val = pow(sin($dlati/2),2)+cos($lat1)*cos($lat2)*pow(sin($dlong/2),2);
             
           $res = 2 * asin(sqrt($val));
             
           $radius = 3958.756;
             
           return ($res*$radius);
    }
    public function show_appointment(){

        $appoinments = DB::table('appointments')
                        ->join('workers','appointments.worker_id','=','workers.id')
                        ->join('users','users.id','=','workers.user_id')
                        ->select('users.name as name','users.email as email','workers.id as worker_id',
                        'workers.mobileNumber as mobileNumber','workers.expertField as expertField',
                        'workers.experience as experience','workers.aboutme as aboutme','appointments.isCanceled as isCanceled',
                        'appointments.isConfirmed as isConfirmed',
                        'appointments.appointmentDate as date','appointments.id as appointment_id','appointments.fee as fee',
                        'workers.address as address')
                        ->where('appointments.client_id','=',Auth::user()->client->id)
                        ->get();

        return view('auth.client.show-appointment')
        ->with('appoinments',$appoinments);
    }
    public function edit_client()
    {
        $client = DB::table('clients')
            ->join('users','users.id','=','clients.user_id')
            ->select('users.name as name','users.email as email',
            'clients.mobileNumber as mobileNumber',
            'clients.dateOfBirth as dateOfBirth','clients.sex as sex',
            'clients.address as address')
            ->where('clients.id','=',Auth::user()->client->id)
            ->get()
            ->first();
        return \view('auth.client.client-edit')->with('client',$client);
    }
    public function post_edit_client(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore(Auth::user()->id),
            ],
            'dateOfBirth' => 'required',
            'sex' => 'required',
            'address' => 'required|string|max:400',
            'mobileNumber' => 'required|max:20'
        ]);

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $client = Client::find(Auth::user()->client->id);
        $client->dateOfBirth = $request->dateOfBirth;
        $client->sex = $request->sex;
        $client->address = $request->address;
        $client->mobileNumber = $request->mobileNumber;
        $client->save();

        return redirect(RouteServiceProvider::HOME);
    }
    public function cancel_appointment($appointment_id)
    {
        if(empty($appointment_id)){
            return redirect(RouteServiceProvider::HOME);
        }

        $appointment = Appointment::find($appointment_id);
        $appointment->isCanceled=true;
        $appointment->isReviewed=true;
        $appointment->save();
        $workerUserIdentity=User::find(Worker::find($appointment->worker_id)->user_id)->user_identity;
        broadcast(new AppointmentEvent($appointment,$workerUserIdentity))->toOthers();
        return redirect(route('client.show.appointment'));
    }
    public function manual_payment(Request $request)
    {
        $request->validate([
            'appointmentFee' => 'required|numeric',
            'appointment_id' => 'required|integer',
        ]);
        $appointment_id=$request->appointment_id;

        $appointment = Appointment::find($appointment_id);
        $appointment->isReviewed=true;
        $appointment->isPaidUp=true;
        $appointment->fee=$request->appointmentFee;
        $appointment->save();
        $transaction_id=crc32(Auth::user()->email.' '.time());
        DB::table('transactions')
        ->where('transaction_id', $transaction_id)
        ->updateOrInsert([
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'phone' => Auth::user()->client->mobileNumber,
            'amount' => $request->appointmentFee,
            'status' => 'Complete',
            'address' => Auth::user()->client->address,
            'transaction_id' =>$transaction_id,
            'currency' => "BDT",
            'isWorkerPaid'=>true,
            'appointment_id' => $appointment_id
        ]);


        $workerUserIdentity=User::find(Worker::find($appointment->worker_id)->user_id)->user_identity;
        broadcast(new AppointmentEvent($appointment,$workerUserIdentity))->toOthers();
        $message=array("Transaction is Processing");
        array_push($message,"Transaction is successfully Completed");
        return view('auth.client.transaction-state')->with('message',$message);
    }
    public function client_chat($worker_id)
    {
        if(empty($worker_id)){
            return redirect(RouteServiceProvider::HOME);
        }
        $worker = DB::table('workers')
        ->join('users','users.id','=','workers.user_id')
        ->select('users.name as name')
        ->where('workers.id','=',$worker_id)
        ->first();

        $messages = DB::table('messages')
            ->select('messages.owner_user_id as owner_user_id','messages.id as id','messages.body as body','messages.sendTime as sendTime')
            ->where('messages.client_id','=',Auth::user()->client->id)
            ->where('messages.worker_id','=',$worker_id)
            ->get();

        // update messages
        Message::where('worker_id', '=',
                Auth::user()->client->id)->update(['isViewed' => true]);

        
        return \view('auth.client.chat-window')
        ->with('messages',$messages)
        ->with('name',$worker->name)
        ->with('worker_id',$worker_id)
        ->with('own_user_id',Auth::user()->id);

    }
    public function post_client_chat(Request $request)
    {
        $request->validate([
            'messageBody' => 'required|string',
            'id' => 'required|integer'
        ]);

        $message = Message::create([
            'body'=> $request->messageBody,
            'sendTime'=>\now(),
            'worker_id' => $request->id,
            'owner_user_id'=>Auth::user()->id,
            'client_id'=> Auth::user()->client->id
        ]);
        $workerUserIdentity= User::find(Worker::find($request->id)->user_id)->user_identity;


        broadcast(new MessageEvent($message,$workerUserIdentity))->toOthers();
        return $message->toArray();
    }
    public function client_chat_list()
    {
        $workers = DB::table('chat_rooms')
        ->select('chat_rooms.worker_id')
        ->distinct()
        ->join('workers','workers.id','=','chat_rooms.worker_id')
        ->join('users','users.id','=','workers.user_id')
        ->select('users.name as name','workers.id as worker_id')
        ->where('chat_rooms.client_id','=',Auth::user()->client->id)
        ->get();
        return \view('auth.client.chat-list')->with('workers',$workers);
    }
    public function message_count()
    {
        $num =DB::table('messages')
        ->select('messages.id as id')
        ->where('messages.client_id','=',Auth::user()->client->id)
        ->where('isViewed','=',false)
        ->get()
        ->count();
        return $num;
    }

}