<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedSessionController;
use Illuminate\Http\Request;


use App\Http\Controllers\Auth\Admin\RegisteredAdminController;
use App\Http\Controllers\Auth\Worker\RegisteredWorkerController;
use App\Http\Controllers\Auth\Client\RegisteredClientController;
use App\Http\Controllers\SslCommerzPaymentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');
Route::get('/aboutus', function () {
    return view('aboutus');
})->name('aboutus');
Route::get('/policy', function () {
    return view('policy');
})->name('policy');
Route::get('/services', function () {
        
    })->name('services');
Route::get('/contract/us', function () {
        return view('contractus');
})->name('contractus');
Route::get('/blog/{blog_id?}', [AuthenticatedSessionController::class, 'blog'])->name('blog');

Route::post('/contract/us',[RegisteredAdminController::class,'post_suggestion']);

Route::get('/dashboard',function(Request $request){
    return redirect('/dashboard/'.$request->user()->role);
})->middleware('auth')
->name('dashboard');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');
Route::get('/login', [AuthenticatedSessionController::class, 'login'])
                ->middleware('guest')
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'login_post'])
                ->middleware('guest');

Route::get('/register', [AuthenticatedSessionController::class, 'register'])
                ->middleware('guest')
                ->name('register');

Route::post('/register', [AuthenticatedSessionController::class, 'register_post'])
                ->middleware('guest');


// <------ client ----->

Route::get('/update/client',[RegisteredClientController::class,'create'])
        ->middleware(['auth','client'])
        ->name('client.update');
Route::post('/update/client',[RegisteredClientController::class,'store'])
        ->middleware(['auth','client']);

Route::get('/dashboard/client',[RegisteredClientController::class,'show'])
        ->middleware(['auth','profileCheck','client']);

Route::get('/dashboard/client/show/appointment',[RegisteredClientController::class,'show_appointment'])
        ->middleware(['auth','profileCheck','client'])->name('client.show.appointment');

Route::get('/dashboard/client/search/worker',[RegisteredClientController::class,'search_worker'])
        ->middleware(['auth','profileCheck','client'])->name('client.search.worker');
Route::post('/dashboard/client/search/worker',[RegisteredClientController::class,'post_search_worker'])
        ->middleware(['auth','profileCheck','client']);

Route::get('/dashboard/client/create/appointment/{worker_id?}',[RegisteredClientController::class,'create_appointment'])
        ->middleware(['auth','profileCheck','client'])->name('client.create.appointment');
Route::post('/dashboard/client/create/appointment',[RegisteredClientController::class,'store_appointment'])
        ->middleware(['auth','profileCheck','client']);

Route::get('/dashboard/client/edit',[RegisteredClientController::class,'edit_client'])
        ->middleware(['auth','profileCheck','client'])->name('client.edit');
Route::post('/dashboard/client/edit',[RegisteredClientController::class,'post_edit_client'])
        ->middleware(['auth','profileCheck','client']);


Route::get('/dashboard/client/chat/list',[RegisteredClientController::class,'client_chat_list'])
        ->middleware(['auth','profileCheck','client'])->name('client.chat.list');

Route::get('/dashboard/client/chat/{worker_id}',[RegisteredClientController::class,'client_chat'])
        ->middleware(['auth','profileCheck','client']);

Route::post('/dashboard/client/chat',[RegisteredClientController::class,'post_client_chat'])
        ->middleware(['auth','profileCheck','client'])->name('client.chat.post');

Route::get('/dashboard/client/message/count',[RegisteredClientController::class,'message_count'])
        ->middleware(['auth','profileCheck','client'])
        ->name('client.message.count');

Route::get('/dashboard/client/cancel/appointment/{apppointment_id?}',[RegisteredClientController::class,'cancel_appointment'])
        ->middleware(['auth','profileCheck','client'])->name('client.cancel.appointment');

Route::get('/dashboard/client/detail/appointment/{worker_id?}/{apppointment_id?}',[RegisteredClientController::class,'detail_appointment'])
        ->middleware(['auth','profileCheck','client'])->name('client.detail.appointment');

Route::post('/dashboard/client/manual/payment/',[RegisteredClientController::class,'manual_payment'])
        ->middleware(['auth','profileCheck','client'])->name('client.manual.payment');

// <---- worker------>



Route::get('/update/worker',[RegisteredWorkerController::class,'create'])
        ->middleware(['auth','worker'])
        ->name('worker.update');

Route::post('/update/worker',[RegisteredWorkerController::class,'store'])
        ->middleware(['auth','worker']);

Route::get('/dashboard/worker',[RegisteredWorkerController::class,'show'])
       ->middleware(['auth','profileCheck','worker']);

Route::get('/dashboard/worker/show/appointment',[RegisteredWorkerController::class,'show_appointment'])
        ->middleware(['auth','profileCheck','worker'])->name('worker.show.appointment');

Route::get('/dashboard/worker/detail/appointment/{client_id?}/{apppointment_id?}',[RegisteredWorkerController::class,'detail_appointment'])
        ->middleware(['auth','profileCheck','worker'])->name('worker.detail.appointment');

Route::get('/dashboard/worker/cancel/appointment/{apppointment_id?}',[RegisteredWorkerController::class,'cancel_appointment'])
        ->middleware(['auth','profileCheck','worker'])->name('worker.cancel.appointment');

Route::get('/dashboard/worker/confirm/appointment/{apppointment_id?}',[RegisteredWorkerController::class,'confirm_appointment'])
        ->middleware(['auth','profileCheck','worker'])->name('worker.confirm.appointment');

Route::get('/dashboard/worker/edit',[RegisteredWorkerController::class,'edit_worker'])
        ->middleware(['auth','profileCheck','worker'])->name('worker.edit');
Route::post('/dashboard/worker/edit',[RegisteredWorkerController::class,'post_edit_worker'])
        ->middleware(['auth','profileCheck','worker']);



Route::get('/dashboard/worker/chat/list',[RegisteredWorkerController::class,'worker_chat_list'])
        ->middleware(['auth','profileCheck','worker'])->name('worker.chat.list');

Route::get('/dashboard/worker/chat/{client_id}',[RegisteredWorkerController::class,'worker_chat'])
        ->middleware(['auth','profileCheck','worker']);

Route::post('/dashboard/worker/chat',[RegisteredWorkerController::class,'post_worker_chat'])
        ->middleware(['auth','profileCheck','worker'])->name('worker.chat.post');

Route::get('/dashboard/worker/appointment/count',[RegisteredWorkerController::class,'appointment_count'])
        ->middleware(['auth','profileCheck','worker'])
        ->name('worker.appointment.count');
Route::get('/dashboard/worker/message/count',[RegisteredWorkerController::class,'message_count'])
        ->middleware(['auth','profileCheck','worker'])
        ->name('worker.message.count');

/// admins
Route::get('/dashboard/admin',[RegisteredAdminController::class,'show'])
        ->middleware(['auth','admin']);
        
Route::get('/register/admin', [RegisteredAdminController::class, 'create'])
        ->middleware(['auth','admin'])
        ->name('register.admin');

Route::post('/register/admin', [RegisteredAdminController::class, 'store'])
        ->middleware(['auth','admin']);

Route::get('/dashboard/admin/show/client',[RegisteredAdminController::class,'show_client'])
        ->middleware(['auth','admin'])->name('admin.show.client');
Route::post('/dashboard/admin/show/client',[RegisteredAdminController::class,'post_show_client'])
        ->middleware(['auth','admin']);
Route::get('/dashboard/admin/show/worker',[RegisteredAdminController::class,'show_worker'])
        ->middleware(['auth','admin'])->name('admin.show.worker');
Route::post('/dashboard/admin/show/worker',[RegisteredAdminController::class,'post_show_worker'])
        ->middleware(['auth','admin']);

Route::get('/dashboard/admin/edit',[RegisteredAdminController::class,'edit_admin'])
        ->middleware(['auth','admin'])->name('admin.edit');
Route::post('/dashboard/admin/edit',[RegisteredAdminController::class,'post_edit_admin'])
        ->middleware(['auth','admin']);

Route::get('/dashboard/admin/show/suggestions',[RegisteredAdminController::class,'show_suggestions'])
        ->middleware(['auth','admin'])->name('admin.show.suggestions');
Route::get('/dashboard/admin/show/transactions',[RegisteredAdminController::class,'show_transactions'])
        ->middleware(['auth','admin'])->name('admin.show.transactions');

Route::get('/dashboard/admin/delete/{user_id?}',[RegisteredAdminController::class,'delete_user'])
        ->middleware(['auth','admin'])->name('admin.delete.user');

// online payment System

Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax'])
->middleware(['auth','profileCheck','client']);
        
Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);