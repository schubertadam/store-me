<?php

namespace App\Listeners;

use App\Events\PasswordResetRequestedEvent;
use App\Mail\PasswordResetMail;
use Mail;

class PasswordResetRequestedEventListener
{
    public function __construct()
    {
    }

    public function handle(PasswordResetRequestedEvent $event): void
    {
        Mail::to($event->email)->send(new PasswordResetMail($event->token));
    }
}
