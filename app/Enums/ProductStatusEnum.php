<?php

namespace App\Enums;

enum ProductStatusEnum: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case PRE_ORDER = 'pre-order';

    public static function labels(): array
    {
        return [
            self::ACTIVE->value => __('Active'),
            self::INACTIVE->value => __('Inactive'),
            self::PRE_ORDER->value => __('Pre-order'),
        ];
    }
}
