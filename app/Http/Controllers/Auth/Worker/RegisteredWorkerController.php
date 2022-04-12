<?php

namespace App\Http\Controllers\Auth\Worker;


use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Client;
use App\Models\Worker;
use App\Models\Message;
use App\Models\ChatRoom;

use App\Events\MessageEvent;
use App\Events\AppointmentEvent;

use App\Models\Appointment;


use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class RegisteredWorkerController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.worker.register');
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
            'perHourFee' => 'required|numeric',
            'expertField' => 'required|string|max:200',
            'experience' => 'required|string',
            'aboutme'=>'required|string',
            'address' => 'required|string|max:400',
            'mobileNumber' => 'required|max:14',
            'latitude'=>'required|numeric',
            'longitude'=>'required|numeric'
            
        ]);
        
        $user = User::find(Auth::user()->id);
        $user->profileUpdated = true;
        $user->save();

        Worker::create([
            'user_id'=>$request->user()->id,
            'perHourFee' => $request->perHourFee,
            'expertField' => $request->expertField,
            'experience' => $request->experience,
            'aboutme'=>$request->aboutme,
            'address' => $request->address,
            'mobileNumber' => $request->mobileNumber,
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude

        ]);
        return redirect(route('dashboard'));
    }
    public function show()
    {
        $worker = DB::table('users')
        ->join('workers','users.id','=','workers.user_id')
        ->select('users.name as name', 'users.email as email',
        'workers.expertField as expertField',
        'workers.perHourFee as fee', 'workers.experience as experience',
        'workers.aboutme as aboutme',
        'workers.address as address','workers.mobileNumber as mobileNumber')
          ->where('workers.id','=',Auth::user()->worker->id)
          ->get()
          ->first();
        return view('auth.worker.dashboard')->with('worker',$worker);
    }

    public function show_appointment()
    {
        $appoinments = DB::table('appointments')
            ->join('clients','appointments.client_id','=','clients.id')
            ->join('users','users.id','=','clients.user_id')
            ->select('users.name as name','users.email as email',
            'clients.id as client_id','appointments.id as appointment_id', 'clients.mobileNumber as mobileNumber',
            'appointments.appointmentDate as date','appointments.fee as fee','appointments.isCanceled as isCanceled',
            'appointments.isConfirmed as isConfirmed','appointments.address as address')
            ->where('appointments.worker_id','=',Auth::user()->worker->id)
            ->orderBy('appointments.created_at')
            ->get();
        return view('auth.worker.show-appointment')->with('appoinments',$appoinments);
    }

    public function detail_appointment($client_id,$appointment_id)
    {
        if(empty($client_id)){
            return redirect(RouteServiceProvider::HOME);
        }
        if(empty($appointment_id)){
            return redirect(RouteServiceProvider::HOME);
        }

        $client = DB::table('clients')
            ->join('users','users.id','=','clients.user_id')
            ->select('users.name as name','users.email as email',
            'clients.mobileNumber as mobileNumber','clients.id as id',
            'clients.dateOfBirth as dateOfBirth','clients.sex as sex',
            'clients.address as address')
            ->where('clients.id','=',$client_id)
            ->get()
            ->first();

        $appoinments = DB::table('appointments')
                        ->select('appointments.appointmentDate as date',
                                'appointments.fee as fee',
                                'appointments.address as address')
                        ->where('appointments.client_id','=',$client_id)
                        ->where('appointments.worker_id','=',Auth::user()->worker->id)
                        ->get();
        $appointment = Appointment::find($appointment_id);
        $appointment->isReviewed=true;
        $appointment->save();

        return \view('auth.worker.detail-appointment')
        ->with('client',$client)
        ->with('appoinments',$appoinments);
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
        $clientUserIdentity=User::find(Client::find($appointment->client_id)->user_id)->user_identity;
        broadcast(new AppointmentEvent($appointment,$clientUserIdentity))->toOthers();
        
        return redirect(route('worker.show.appointment'));
    }
    public function confirm_appointment($appointment_id)
    {
        if(empty($appointment_id)){
            return redirect(RouteServiceProvider::HOME);
        }

        $appointment = Appointment::find($appointment_id);
        $appointment->isConfirmed=true;
        $appointment->isReviewed=true;
        $appointment->save();
        $clientUserIdentity=User::find(Client::find($appointment->client_id)->user_id)->user_identity;
        broadcast(new AppointmentEvent($appointment,$clientUserIdentity))->toOthers();
        
        return redirect(route('worker.show.appointment'));
    }
    public function edit_worker()
    {
        $worker = DB::table('users')
        ->join('workers','users.id','=','workers.user_id')
        ->select('users.name as name', 'users.email as email',
        'workers.expertField as expertField',
        'workers.perHourFee as fee', 'workers.experience as experience',
        'workers.aboutme as aboutme','workers.latitude as latitude','workers.longitude as longitude',
        'workers.address as address','workers.mobileNumber as mobileNumber')
          ->where('workers.id','=',Auth::user()->worker->id)
          ->get()
          ->first();
        return \view('auth.worker.edit-worker')->with('worker',$worker)
        ->with('latitude',$worker->latitude)
        ->with('longitude',$worker->longitude);
    }
    public function post_edit_worker(Request $request)
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
            'perHourFee' => 'required|numeric',
            'expertField' => 'required|string|max:200',
            'experience' => 'required|string',
            'aboutme'=>'required|string',
            'address' => 'required|string|max:400',
            'mobileNumber' => 'required|max:14',
            'latitude'=>'required|numeric',
            'longitude'=>'required|numeric'
            
        ]);

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $worker = Worker::find(Auth::user()->worker->id);
        $worker->perHourFee = $request->perHourFee;
        $worker->expertField = $request->expertField;
        $worker->experience = $request->experience;
        $worker->aboutme = $request->aboutme;
        $worker->address = $request->address;
        $worker->latitude = $request->latitude;
        $worker->longitude = $request->longitude;
        $worker->mobileNumber = $request->mobileNumber;

        $worker->save();

        
        return redirect(RouteServiceProvider::HOME);
    }
    public function worker_chat($client_id)
    {
        if(empty($client_id)){
            return redirect(RouteServiceProvider::HOME);
        }
        $client = DB::table('clients')
        ->join('users','users.id','=','clients.user_id')
        ->select('users.name as name')
        ->where('clients.id','=',$client_id)
        ->first();

        $messages = DB::table('messages')
            ->select('messages.owner_user_id as owner_user_id',
            'messages.id as id','messages.body as body','messages.sendTime as sendTime')
            ->where('messages.worker_id','=',Auth::user()->worker->id)
            ->where('messages.client_id','=',$client_id)
            ->get();

        // update messages
        Message::where('worker_id', '=',
         Auth::user()->worker->id)->update(['isViewed' => true]);

        return \view('auth.worker.chat-window')
        ->with('messages',$messages)
        ->with('name',$client->name)
        ->with('client_id',$client_id)
        ->with('own_user_id',Auth::user()->id);

    }

    public function post_worker_chat(Request $request)
    {
        $request->validate([
            'messageBody' => 'required|string',
            'id' => 'required|integer'
        ]);

        $message = Message::create([
            'body'=> $request->messageBody,
            'sendTime'=>\now(),
            'client_id' => $request->id,
            'owner_user_id'=>Auth::user()->id,
            'worker_id'=> Auth::user()->worker->id
        ]);

        
        $clientUserIdentity=User::find(Client::find($request->id)->user_id)->user_identity;

        broadcast(new MessageEvent($message,$clientUserIdentity))->toOthers();

        return $message->toArray();

    }
    public function worker_chat_list()
    {
        $clients = DB::table('chat_rooms')
        ->select('chat_rooms.client_id')
        ->distinct()
        ->join('clients','clients.id','=','chat_rooms.client_id')
        ->join('users','users.id','=','clients.user_id')
        ->select('users.name as name','clients.id as client_id')
        ->where('chat_rooms.worker_id','=',Auth::user()->worker->id)
        ->get();
        return \view('auth.worker.chat-list')->with('clients',$clients);
    }
    public function appointment_count()
    {
        $num =DB::table('appointments')
        ->select('appointments.id as id')
        ->where('appointments.worker_id','=',Auth::user()->worker->id)
        ->where('isReviewed','=',false)
        ->get()
        ->count();

        return $num;
    }
    public function message_count()
    {
        $num =DB::table('messages')
        ->select('messages.id as id')
        ->where('messages.worker_id','=',Auth::user()->worker->id)
        ->where('isViewed','=',false)
        ->get()
        ->count();
        return $num;
    }

}
