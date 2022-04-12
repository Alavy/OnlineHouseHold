<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Prescription;
use App\Models\Suggestion;


use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class RegisteredAdminController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.admin.register-admin');
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'admin',
            'profileUpdated'=>true,
            'password' => Hash::make($request->password),
            'user_identity'=>crc32($request->email.' '.time())
        ]);
        return redirect(RouteServiceProvider::HOME);
    }
    public function post_suggestion(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string|max:500',
            'contractEmail' => 'required|string|email|max:255'
        ]);

        Suggestion::create([
            'name' => $request->name,
            'contractEmail' => $request->contractEmail,
            'message' => $request->message
        ]);
        return view('contractus')->with('succes',"Succesfullly submitted your suggestion");
    }
    public function edit_admin()
    {
        $admin = DB::table('users')->select('name',
                'email')
                ->where('users.id','=',Auth::user()->id)
                ->get()
                ->first();

        return \view('auth.admin.edit-admin')->with('admin',$admin);
    }
    public function post_edit_admin(Request $request)
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
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::find(Auth::user()->id);

        $user->name = $request->name;
        $user->email = $request->email;

        if( isset($request->password) && !empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect(RouteServiceProvider::HOME);
    }
    public function show()
    {
        $admin = DB::table('users')->select('name',
                'email')
                ->where('users.id','=',Auth::user()->id)
                ->get()
                ->first();

        return view('auth.admin.dashboard')->with('admin',$admin);
    }

    public function show_client()
    {
        return view('auth.admin.show-client');
    }
    public function post_show_client(Request $request)
    {
        $request->validate([
            'searchClient' => 'required|string|max:1000'
        ]);
        $q = $request->searchClient;      
        $clients = DB::table('users')
            ->join('clients','users.id','=','clients.user_id')
            ->select('users.name as name', 'users.id as user_id','users.email as email',
                'clients.dateOfBirth as dateOfBirth',
                'clients.sex as sex','clients.address as address',
                'clients.mobileNumber as mobileNumber')
            ->where('users.name','LIKE','%'.$q.'%')
            ->orWhere('users.email','LIKE','%'.$q.'%')
            ->orWhere('clients.address','LIKE','%'.$q.'%')
            ->orWhere('clients.sex','LIKE','%'.$q.'%')
            ->orWhere('clients.mobileNumber','LIKE','%'.$q.'%')
            ->get();
        return view('auth.admin.show-client')->with('clients',$clients);;
    }
    public function show_worker()
    {
        return view('auth.admin.show-worker');
    }
    public function post_show_worker(Request $request)
    {
        $request->validate([
            'searchWorker' => 'required|string|max:1000'
        ]);
        $q = $request->searchWorker;      
        $workers = DB::table('users')
            ->join('workers','users.id','=','workers.user_id')
            ->select('users.name as name','users.id as user_id', 'users.email as email','workers.id as id',
            'workers.expertField as expertField',
            'workers.perHourFee as fee', 'workers.experience as experience',
            'workers.aboutme as aboutme',
              'workers.address as address','workers.mobileNumber as mobileNumber')
            ->where('users.name','LIKE','%'.$q.'%')
            ->orWhere('users.email','LIKE','%'.$q.'%')
            ->orWhere('workers.expertField','LIKE','%'.$q.'%')
            ->orWhere('workers.address','LIKE','%'.$q.'%')
            ->orWhere('workers.mobileNumber','LIKE','%'.$q.'%')
            ->get();
        return view('auth.admin.show-worker')->with('workers',$workers);
    }
    public function show_suggestions()
    {
        $suggestions = DB::table('suggestions')
        ->select('name','contractEmail','message')
        ->get();
        return view('auth.admin.show-suggestions')->with('suggestions',$suggestions);

    }
    public function show_transactions()
    {
        $transactions = DB::table('transactions')
        ->join('appointments','transactions.appointment_id','=','appointments.worker_id')
        ->join('workers','appointments.worker_id','=','workers.id')
        ->join('users','users.id','=','workers.user_id')
        ->select('transactions.name as client_name',
            'transactions.email as client_email',
            'transactions.phone as client_phone','transactions.amount as amount',
            'transactions.address as client_address',
            'transactions.status as status',
            'users.name as worker_name',
            'workers.mobileNumber as worker_phone',
            'transactions.isWorkerPaid as isWorkerPaid')
        ->get();
        return view('auth.admin.show-transactions')->with('transactions',$transactions);

    }
    public function delete_user($user_id)
    {
        $user = User::find($user_id);
        $user->delete();

        return redirect(route('dashboard'));
    }


}
