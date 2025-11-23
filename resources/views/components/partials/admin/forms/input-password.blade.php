@props([
    'name' => 'password',
    'label' => '',
    'value' => '',
    'divClass' => 'mb-3',
    'floatRoute' => null,
    'autocomplete' => '',
    'placeholder' => ''
])

@php
    if (empty($label)) {
        $label = ucfirst(str_replace('_', ' ', $name));
    }

    // CSS osztályok beállítása, figyelembe véve a hibákat
    $inputClasses = trim(
        'form-control pe-5 password-input ' . // Bootstrap és sablon specifikus osztályok
        ($attributes->get('class') ?? '') .
        ($errors->has($name) ? ' is-invalid' : '')
    );
@endphp

<div class="{{ $divClass }}">
    {{-- Elfelejtett jelszó link (opcionális) --}}
    @if ($floatRoute)
        <div class="float-end">
            <a href="{{ $floatRoute }}" class="text-muted">{{ $floatRouteName }}</a>
        </div>
    @endif

    <label class="form-label" for="{{ $name }}">{{ $label }}</label>

    <div class="position-relative auth-pass-inputgroup mb-3">
        <input
            type="password"
            name="{{ $name }}"
            class="{{ $inputClasses }}"
            placeholder="{{ $placeholder }}"
            id="{{ $name }}"
            value="{{ old($name, $value) }}"
            autocomplete="{{ $autocomplete }}"
            {{ $attributes->except('class') }}
        >

        <button
            class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
            type="button"
            id="password-addon"
        >
            <i class="ri-eye-fill align-middle"></i>
        </button>

        @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
</div>
