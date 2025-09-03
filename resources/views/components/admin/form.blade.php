@php
    $fileExtension = isset($fileUpload) ? 'enctype="multipart/form-data"' : '';
@endphp
<form action="{{ $action }}" method="{{ isset($method) && $method == 'get'? 'get' : 'post' }}" {{ $fileExtension }}>
    @csrf
    @method(strtoupper($method ?? 'post'))

    {{ $slot }}

    @isset($button)
        <button type="submit" class="btn btn-primary">
            {{ $button }}
        </button>
    @endisset
</form>
