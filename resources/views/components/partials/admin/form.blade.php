@props([
    'action' => '',
    'method' => 'POST',
    'class' => '',
    'hasFile' => false,
    'button' => null,
])

@php
    $method = strtoupper($method);

    $formAttributes = [
        'action' => $action,
        'method' => ($method === 'GET' || $method === 'POST') ? $method : 'POST',
    ];

    if ($hasFile) {
        $formAttributes['enctype'] = 'multipart/form-data';
    }

    $finalClass = trim($class . ' ' . $attributes->get('class'));
@endphp

<form
    {{ $attributes->except(['action', 'method', 'class']) }}
    action="{{ $formAttributes['action'] }}"
    method="{{ $formAttributes['method'] }}"
    class="{{ $finalClass }}"
    @if(isset($formAttributes['enctype'])) enctype="{{ $formAttributes['enctype'] }}" @endif
>
    @unless ($method === 'GET')
        @csrf

        @if ($method !== 'POST' && $method !== 'GET' && $method !== 'HEAD')
            @method($method)
        @endif
    @endunless

    {{ $slot }}

    @isset($button)
        <button type="submit" class="btn btn-primary" onclick="this.disabled = true; this.form.submit();">
            {{ $button }}
        </button>
    @endisset

</form>
