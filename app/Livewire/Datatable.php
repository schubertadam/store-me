<?php

namespace App\Livewire;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

abstract class Datatable extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';
    public string $sortField = 'id';
    public string $sortDirection = 'asc';
    public int $page = 1;
    public int $perPage = 10;

    abstract protected function builder(): Builder;

    abstract protected function getColumns(): array;

    abstract protected function actions(object $record): array;

    public function formatColumnValue(object $record, string $fieldName): string
    {
        return data_get($record, $fieldName);
    }

    public function mount(): void
    {
        // 1. perPage inicializálása:
        $urlPerPage = request()->query('perPage');

        // Ellenőrizzük, hogy az érték a megengedett listában van-e, és beállítjuk.
        if ($urlPerPage && in_array((int)$urlPerPage, [10, 25, 50, 100])) {
            $this->perPage = (int)$urlPerPage;
        }

        // 2. page inicializálása:
        // A WithPagination kezeli, de a $page propertyt beállíthatjuk a pontosság kedvéért.
        $urlPage = request()->query('page');
        if ($urlPage && (int)$urlPage >= 1) {
            // A WithPagination Trait általában kezeli a $page beállítást,
            // de ez a sor garantálja, hogy a komponens property is helyesen induljon.
            $this->page = (int)$urlPage;
        }
    }

    protected function queryString(): array
    {
        return [
            // Oldalszám (page): 'p' alias-szal, kivéve ha az 1. oldal.
            'page' => ['except' => 1],

            // Oldalonkénti elemek száma (perPage): kivéve ha az alapértelmezett (10).
            'perPage' => ['except' => 10],

            // Keresési kifejezés (search): kivéve ha üres.
            'search' => ['except' => ''],

            // Rendezési mező (sortField): kivéve ha az alapértelmezett ('id').
            'sortField' => ['except' => 'id'],

            // Rendezési irány (sortDirection): kivéve ha az alapértelmezett ('asc').
            'sortDirection' => ['except' => 'asc'],
        ];
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
