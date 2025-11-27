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

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>

    @if(!is_null($icon))<div class="input-group mb-3">@endif
        @if(!is_null($icon) && $iconStart)<span class="input-group-text" id="{{ $name }}-addon">{{ $icon }}</span>@endif
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}" class="{{ $class }}" autocomplete="{{ $autocomplete }}">
        @if(!is_null($iconStart) && !$iconStart)<span class="input-group-text">{{ $icon }}</span>@endif
        @if(!is_null($icon))</div>@endif

    @error($name)
    <div class="invalid-feedback d-block">
        {{ $message }}
    </div>
    @enderror
</div>
