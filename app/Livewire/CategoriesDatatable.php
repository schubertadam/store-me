<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;

class CategoriesDatatable extends Datatable
{
    protected function builder(): Builder
    {
        return Category::query();
    }

    protected function getColumns(): array
    {
        return [
            'name' => 'Név',
            'type' => 'Típus',
            '_actions' => 'Műveletek',
        ];
    }

    protected function actions(object $record): array
    {
        return [
            [
                'label' => 'Szerkesztés',
                'route' => route('admin.categories.edit', $record),
                'class' => 'primary',
                'icon'  => 'edit',
                'type'  => 'link',
            ],
            [
                'label' => 'Törlés',
                'class' => 'danger',
                'icon'  => 'trash',
                'type'  => 'delete-form',
                'route' => route('admin.categories.destroy', $record),
            ],
        ];
    }

    public function formatColumnValue(object $record, string $fieldName): string
    {
        return match ($fieldName) {
            'type' => $this->translateCategoryType($record->type->value),
            default => parent::formatColumnValue($record, $fieldName),
        };
    }

    protected function translateCategoryType(string $typeValue): string
    {
        $translations = [
            'product' => 'Termék',
            'post' => 'Blog/Hír',
        ];

        return $translations[$typeValue] ?? ucfirst($typeValue);
    }
}
