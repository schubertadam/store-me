@props([
    'action' => '',
    'method' => 'post',
    'class' => '',
    'hasFile' => false,
    'button' => null,
])

@php
    $method = ($method === 'get' || $method === 'post') ? $method : 'post';
@endphp

<form method="{{ $method }}" action="{{ $action }}" class="{{ $class }}" @if($hasFile) enctype="multipart/form-data" @endif>
    @unless ($method === 'GET')
        @csrf

        @if ($method !== 'post' && $method !== 'get')
            @method(strtoupper($method))
        @endif
    @endunless

    {{ $slot }}

    @isset($button)
        <button type="submit" class="btn btn-primary rounded-pill btn-login w-100 mb-2" onclick="this.disabled = true; this.form.submit();">
            {{ $button }}
        </button>
    @endisset
</form>
