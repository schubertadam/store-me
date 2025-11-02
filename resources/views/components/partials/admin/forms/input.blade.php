@props([
    'name',
    'label' => '',
    'type' => 'text',
    'value' => '',
    'id' => null,
    'divClass' => 'mb-3',
    'autocomplete' => ''
])

@php
    if (empty($label)) {
        $label = ucfirst(str_replace('_', ' ', $name));
    }

    $inputClasses = trim(
        'form-control ' .
        ($attributes->get('class') ?? '') .
        ($errors->has($name) ? ' is-invalid' : '')
    );
@endphp

<div class="{{ $divClass }}">

    <label for="{{ $name }}" class="form-label">{{ $label }}</label>

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        {{ $attributes->except('class') }}
        class="{{ $inputClasses }}"
        autocomplete="{{ $autocomplete }}"
    >

    @error($name)
    <div class="invalid-feedback d-block">
        {{ $message }}
    </div>
    @enderror

</div>
