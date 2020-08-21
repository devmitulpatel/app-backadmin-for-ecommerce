<?php

use Illuminate\Support\Facades\Broadcast;

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

Broadcast::channel('randomchat_{id}', function ($id) {
    return true;
});

Broadcast::channel('commona_user', function ($user) {

    return true;
});


Broadcast::channel('allComman', function ($user) {

    dd($user);


    return true;
});
