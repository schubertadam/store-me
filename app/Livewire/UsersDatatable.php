<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UsersDatatable extends Datatable
{
    protected function builder(): Builder
    {
        return User::query();
    }

    protected function getColumns(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Név',
            'email' => 'E-mail',
            'created_at' => 'Regisztrált',
            '_actions' => 'Műveletek',
        ];
    }

    protected function actions(object $record): array
    {
        return [
            [
                'label' => 'Szerkesztés',
                'route' => route('users.edit', $record),
                'class' => 'primary',
                'icon'  => 'edit',
                'type'  => 'link',
            ],
            [
                'label' => 'Törlés',
                'class' => 'danger',
                'icon'  => 'trash',
                'type'  => 'livewire',
                'method' => 'delete',
            ],
        ];
    }


}
