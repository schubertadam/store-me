@props([
    'name',
    'label' => '',
    'value' => '',   // A textarea tartalma
    'rows' => 5,     // Alapértelmezett magasság
    'divClass' => 'mb-3',
])

@php
    // Címke generálása a 'name'-ből, ha hiányzik
    if (empty($label)) {
        $label = ucfirst(str_replace('_', ' ', $name));
    }

    // CSS osztályok beállítása, figyelembe véve a hibákat
    $textareaClasses = trim(
        'form-control ' . // Bootstrap form-control class
        ($attributes->get('class') ?? '') .
        ($errors->has($name) ? ' is-invalid' : '')
    );

    // A régi (old) érték lekérése, vagy a props-ban átadott érték használata
    $currentValue = old($name, $value);
@endphp

<div class="{{ $divClass }}">

    <label for="{{ $name }}" class="form-label">{{ $label }}</label>

    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        {{ $attributes->except('class') }}
        class="{{ $textareaClasses }}"
    >{{ $currentValue }}</textarea>

    @error($name)
    <div class="invalid-feedback d-block">
        {{ $message }}
    </div>
    @enderror

</div>
