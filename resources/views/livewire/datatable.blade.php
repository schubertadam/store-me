<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-4">
                <input
                    wire:model.live.debounce.300ms="search"
                    type="search"
                    class="form-control"
                    placeholder="Keresés az összes mezőben..."
                >
            </div>

            <div class="col-md-2 ms-auto">
                <select wire:model.live="perPage" class="form-select">
                    @foreach([10, 25, 50, 100] as $page)
                        <option value="{{ $page }}">{{ $page }} / oldal</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                <tr>
                    @foreach ($columns as $fieldName => $label)
                        <th
                            wire:click="sortBy('{{ $fieldName }}')"
                            class="text-uppercase cursor-pointer"
                        >
                            {{ $label }}

                            @if ($sortField === $fieldName)
                                <i class="fas fa-{{ $sortDirection === 'asc' ? 'sort-up' : 'sort-down' }} ms-1"></i>
                            @else
                                <i class="fas fa-sort text-muted ms-1"></i>
                            @endif
                        </th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @forelse ($records as $record)
                    <tr>
                        @foreach ($columns as $fieldName => $label)
                            <td>
                                @if ($fieldName === '_actions')
                                    <div class="d-flex">
                                        @foreach ($this->actions($record) as $action)
                                            <a
                                                {{-- Route-os link vagy Livewire akció --}}
                                                @if ($action['type'] === 'livewire')
                                                    wire:click.prevent="{{ $action['method'] }}({{ $record->id }})"
                                                href="#"
                                                @else
                                                    href="{{ $action['route'] ?? '#' }}"
                                                @endif

                                                class="btn btn-sm btn-{{ $action['class'] ?? 'secondary' }} me-2"
                                            >
                                                <i class="fas fa-{{ $action['icon'] ?? 'cog' }}"></i>
                                                <span class="d-none d-sm-inline">{{ $action['label'] }}</span>
                                            </a>
                                        @endforeach
                                    </div>

                                @else
                                    {{ data_get($record, $fieldName) }}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($columns) }}" class="text-center">
                            Nincs találat.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer">
        {{ $records->links('pagination::bootstrap-5') }}
    </div>
</div>
