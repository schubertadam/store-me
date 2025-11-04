<?php

namespace App\Listeners;

use App\Events\UserRegisteredEvent;
use App\Mail\UserActivationMail;
use Illuminate\Support\Facades\Mail;

class UserRegisteredEventListener
{
    public function __construct()
    {
    }

    public function handle(UserRegisteredEvent $event): void
    {
        Mail::to($event->user->email)->send(new UserActivationMail($event->user, $event->token));
    }
}
