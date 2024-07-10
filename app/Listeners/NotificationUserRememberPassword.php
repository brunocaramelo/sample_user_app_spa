<?php

namespace App\Listeners;

use App\Events\UserRememberPassword;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NotificationUserRememberPassword implements ShouldQueue
{
    public function handle(UserRememberPassword $event)
    {
        $user = $event->user;

        $html = 'Ola , '.$user->name.'<br /> sua nova senha :<br />'.$event->passwordRemember;

        Mail::html($html, function ($message) use ($user) {
            $message->to($user->email, $user->name)
                    ->subject('Nova senha por email!');
        });
    }
}
