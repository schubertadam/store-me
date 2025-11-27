@props([
    'name',
    'label' => '',
    'options' => [],
    'selected' => [],
])

@php
    if (empty($label)) {
        $label = ucfirst(str_replace('_', ' ', $name));
    }

    $currentSelected = old($name, $selected);
    $class = trim('form-control ' . ($errors->has($name) ? ' is-invalid' : ''));
@endphp

<div class="mb-3">

    <label for="{{ $name }}" class="form-label">{{ $label }}</label>

    <select name="{{ $name }}[]" id="{{ $name }}" class="{{ $class }}" data-choices data-choices-removeItem multiple>
        @foreach ($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" @if(in_array((string)$optionValue, (array)$currentSelected)) selected @endif>
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
