@props(['type' => 'text', 'placeholder' => '', 'value' => null, 'label' => null, 'noLabel' => false])

@php
    $name = $attributes['name'];
    $old = old($name, $value ?? '');
@endphp

<x-admin.forms.field :name="$name" :label="$label" :noLabel="$noLabel" :help="$help ?? null">
    <input type="{{ $type }}"
           name="{{ $name }}"
           id="{{ $name }}"
           value="{{ $old }}"
           placeholder="{{ $placeholder }}"
        {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}>
</x-admin.forms.field>
