<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class WelcomeUser implements ShouldQueue
{
    public function handle(UserCreated $event)
    {
        $user = $event->user;

        $html = "Seja bem vindo. voce já pode acessar o sistema";

        Mail::html($html, function ($message) use ($user) {
            $message->to($user->email, $user->name)
                    ->subject('Bem Vindo ao sistema!');
        });
    }
}
