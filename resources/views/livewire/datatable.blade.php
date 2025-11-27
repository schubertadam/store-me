<div>
    <div class="row mb-3">
        <div class="col-md-4 mb-2 mb-md-0">
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
    <div class="row">
        <div class="table-responsive">
            <table class="table nowrap align-middle" style="width:100%">
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
                                            @php
                                                // Speciális flag a delete formhoz
                                                $isDeleteForm = ($action['type'] ?? 'link') === 'delete-form';
                                            @endphp

                                            {{-- 1. DELETE FORM INDÍTÁSA (HA SZÜKSÉGES) --}}
                                            @if ($isDeleteForm)
                                                {{-- Használjuk a korábban definiált route-ot, pl. users.destroy --}}
                                                <form action="{{ $action['route'] }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Biztosan törölni szeretnéd ezt az elemet?');"
                                                      class="d-inline me-2" {{-- Bootstrap d-inline a gombok elrendezéséhez --}}>
                                                    @csrf
                                                    @method('DELETE')
                                                    @endif

                                                    {{-- 2. AKCIÓ GOMB MEGJELENÍTÉSE --}}
                                                    <button
                                                        @if ($action['type'] === 'livewire' || $isDeleteForm)
                                                            {{-- Livewire akcióhoz wire:click, DELETE formhoz type="submit" --}}
                                                            type="{{ $isDeleteForm ? 'submit' : 'button' }}"
                                                        @if ($action['type'] === 'livewire')
                                                            wire:click.prevent="{{ $action['method'] }}({{ $record->id }})"
                                                        @endif
                                                        @else
                                                            type="button"
                                                        @endif

                                                        class="btn btn-sm btn-{{ $action['class'] ?? 'secondary' }} me-2"
                                                        @if ($action['type'] === 'link')
                                                            onclick="window.location.href='{{ $action['route'] ?? '#' }}'"
                                                        @endif
                                                    >
                                                        {{-- Ikon és Szöveg --}}
                                                        @if (isset($action['icon'])) <i class="fas fa-{{ $action['icon'] }}"></i> @endif
                                                        @if (isset($action['label'])) <span class="ms-1 d-none d-sm-inline">{{ $action['label'] }}</span> @endif
                                                    </button>

                                                    {{-- 3. DELETE FORM BEZÁRÁSA --}}
                                                    @if ($isDeleteForm)
                                                </form>
                                            @endif

                                        @endforeach
                                    </div>

                                @else
                                    {!! $this->formatColumnValue($record, $fieldName) !!}
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

    <div class="row mt-3">
        {{ $records->links('pagination::bootstrap-5') }}
    </div>
</div>
