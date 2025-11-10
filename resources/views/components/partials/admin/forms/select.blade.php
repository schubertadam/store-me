@props([
    'name',
    'label' => '',
    'options' => [], // A választható opciók tömbje (érték => címke)
    'value' => '',   // A már kiválasztott érték
    'divClass' => 'mb-3',
])

@php
    // Címke generálása a 'name'-ből, ha hiányzik
    if (empty($label)) {
        $label = ucfirst(str_replace('_', ' ', $name));
    }

    // Input/Select CSS osztályok beállítása
    $selectClasses = trim(
        'form-select ' . // Bootstrap form-select class
        ($attributes->get('class') ?? '') .
        ($errors->has($name) ? ' is-invalid' : '')
    );
@endphp

<div class="{{ $divClass }}">

    <label for="{{ $name }}" class="form-label">{{ $label }}</label>

    <select
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $attributes->except('class') }}
        class="{{ $selectClasses }}"
    >
        {{-- Alapértelmezett, üres opció --}}
        <option value="">Válasszon...</option>

        {{-- Iterálás az átadott opciókon --}}
        @foreach ($options as $optionValue => $optionLabel)
            <option
                value="{{ $optionValue }}"
                {{-- Kétféle ellenőrzés: régi érték VAGY a props-ban átadott érték --}}
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
