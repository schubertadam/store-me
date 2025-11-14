<?php

namespace App\Enums;

enum ProductSaleTypeEnum: string
{
    case PERCENT = 'percent';
    case SALE_PRICE = 'sale-price';

    public static function labels(): array
    {
        return [
            self::PERCENT->value => __('Percent'),
            self::SALE_PRICE->value => __('Sale price'),
        ];
    }
}
