<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class ProductsDatatable extends Datatable
{
    protected function builder(): Builder
    {
        return Product::query();
    }

    protected function getColumns(): array
    {
        return [
            'name' => 'Terméknév',
            'price' => 'Ár',
            'stock' => 'Készlet',
            '_actions' => 'Műveletek',
        ];
    }

    protected function actions(object $record): array
    {
        return [
            [
                'route' => route('admin.products.edit', $record),
                'class' => 'primary',
                'icon'  => 'edit',
                'type'  => 'link',
            ],
            [
                'class' => 'danger',
                'icon'  => 'trash',
                'type'  => 'delete-form',
                'method' => 'delete',
                'route' => route('admin.products.destroy', $record),
            ],
        ];
    }
}
