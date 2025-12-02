<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/sandbox_plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sandbox.css') }}">
    <script src="{{ asset('assets/libs/fontawesome/all.min.js') }}"></script>
</head>
<body>
    <div class="content-wrapper">
        <livewire:cart.cart-manager/>
        <header class="wrapper bg-black">
            @include('components.partials.guest.layout.navbar')
        </header>

        {{ $slot }}
    </div>

    @include('components.partials.guest.layout.footer')
    <script src="{{ asset('assets/js/sandbox/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/sandbox/theme.js') }}"></script>
</body>
</html>
