<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('appoinment.{user_identity}', function ($user, $user_identity) {
    return  (int) $user->user_identity ===  (int) $user_identity;
});

Broadcast::channel('message.{user_identity}', function ($user, $user_identity) {
    return (int) $user->user_identity ===  (int) $user_identity;
});