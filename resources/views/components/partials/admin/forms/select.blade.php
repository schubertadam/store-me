@props([
    'name',
    'label' => '',
    'options' => [],
    'value' => '',
    'divClass' => 'mb-3',
    'searchable' => false, // <-- ÚJ PARAMÉTER (alapértelmezett: false)
])

@php
    // ... (egyéb @php logika: label generálás, classes beállítása) ...

    // Hozzáadunk egy specifikus osztályt az inicializáláshoz
    $selectClasses = trim(
        'form-select ' .
        ($attributes->get('class') ?? '') .
        ($errors->has($name) ? ' is-invalid' : '') .
        ($searchable ? ' select2-searchable' : '') // Csak akkor adjuk hozzá az osztályt, ha searchable
    );

    if (empty($label)) {
        $label = ucfirst(str_replace('_', ' ', $name));
    }
@endphp

<div class="{{ $divClass }}">

    <label for="{{ $name }}" class="form-label">{{ $label }}</label>

    <select
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $attributes->except('class') }}
        class="{{ $selectClasses }}"
    >
        <option value="">Válasszon...</option>
        @foreach ($options as $optionValue => $optionLabel)
            <option
                value="{{ $optionValue }}"
                {{ (string)$optionValue === (string)old($name, $value) ? 'selected' : '' }}
            >
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>

    @error($name)
    <div class="invalid-feedback d-block">
        {{ $message }}
    </div>
    @enderror

</div>

{{-- 2. JavaScript: Select2 Inicializálása --}}
@if ($searchable)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializáljuk a Select2-t az adott mezőre
            $('#{{ $name }}').select2({
                theme: "bootstrap-5",
                placeholder: "Kezdj el gépelni a kereséshez...",
                allowClear: true
            });
        });
    </script>
@endif
