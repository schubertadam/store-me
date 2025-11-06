<?php

namespace App\Livewire;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

abstract class Datatable extends Component
{
    use WithPagination;

    public string $search = '';
    public string $sortField = 'id';
    public string $sortDirection = 'asc';
    public int $perPage = 10;

    abstract protected function builder(): Builder;

    abstract protected function getColumns(): array;

    abstract protected function actions(object $record): array;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    protected function getRecords(): LengthAwarePaginator
    {
        $query = $this->builder();

        if ($this->search) {
            $query->where(function ($query) {
                foreach ($this->getColumns() as $fieldName => $label) {
                    if ($fieldName === '_actions') {
                        continue;
                    }

                    $query->orWhere($fieldName, 'like', '%' . $this->search . '%');
                }
            });
        }

        $query->orderBy($this->sortField, $this->sortDirection);

        return $query->paginate($this->perPage);
    }

    public function render(): View
    {
        return view('livewire.datatable', [
            'records' => $this->getRecords(),
            'columns' => $this->getColumns(),
        ]);
    }
}
