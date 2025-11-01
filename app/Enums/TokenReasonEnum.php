<?php

namespace App\Enums;

enum TokenReasonEnum: string
{
    case REGISTRATION = 'registration';
    case PASSWORD_RESET = 'password-reset';
}
