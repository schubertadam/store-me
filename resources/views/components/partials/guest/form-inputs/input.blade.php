@props([
    'name',
    'label' => '',
    'type' => 'text',
    'value' => '',
    'autocomplete' => '',
    'icon' => null,
    'iconStart' => true
])

@php
    if (empty($label)) {
        $label = ucfirst(str_replace('_', ' ', $name));
    }

    $class = trim('form-control ' . ($errors->has($name) ? ' is-invalid' : ''));
@endphp

<div class="form-floating mb-4 @if($type == 'password') password-field @endif">
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}" class="{{ $class }}" autocomplete="{{ $autocomplete }}" placeholder="{{ $label }}">
    @if($type == 'password')
        <span class="password-toggle"><i class="uil uil-eye"></i></span>
    @endif
    <label for="{{ $name }}">{{ $label }}</label>

    @error($name)
    <div class="invalid-feedback d-block">
        {{ $message }}
    </div>
    @enderror
</div>
