<?php

namespace App\Listeners;

use App\Events\UserInvitedEvent;
use App\Mail\UserInvitationMail;
use Illuminate\Support\Facades\Mail;

class UserInvitedEventListener
{
    public function __construct()
    {
    }

    public function handle(UserInvitedEvent $event): void
    {
        Mail::to($event->user->email)->send(new UserInvitationMail($event->user, $event->token));
    }
}
