<?php

namespace App\Enums;

enum CategoryTypeEnum: string
{
    case POST = 'post';
    case PRODUCT = 'product';

    public static function labels(): array
    {
        return [
            self::POST->value => __('Post'),
            self::PRODUCT->value => __('Product'),
        ];
    }
}
