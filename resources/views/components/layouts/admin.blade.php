<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('vendor/summernote/summernote-bs5.css') }}">
    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/all.min.js') }}"></script>
    <script src="{{ asset('vendor/summernote/summernote-bs5.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        header {
            border-bottom: 1px solid black;
            align-items: center;
        }
        nav ul {
            margin-bottom: 0;
        }
        nav ul li {
            list-style: none;
            display: inline-flex;
            padding: 5px;
        }
        nav ul li a {
            text-decoration: none;
        }
    </style>
    @livewireStyles
</head>
<body>
<div class="container">
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('users.index') }}">User management</a></li>
                <li><a href="{{ route('categories.index') }}">Categories</a></li>
                <li><a href="{{ route('products.index') }}">Products</a></li>
            </ul>
        </nav>
    </header>
    {{ $slot }}
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
@livewireScripts
<script>
    // Érvénytelen token/session esetén átirányítás bejelentkezésre
    document.addEventListener('livewire:initialized', () => {
        // Livewire v3 esetén 'livewire:initialized' eseményre regisztrálunk
        Livewire.hook('message.failed', ({ response }) => {
            // Ellenőrizzük, hogy a hiba kódja 419 (CSRF Token lejárt)
            if (response && response.status === 419) {
                alert('A munkamenet lejárt. Kérjük, jelentkezzen be újra!');
                // Átirányítás a bejelentkezési oldalra
                window.location.href = '{{ route("login.index") }}';
                return false; // Megakadályozza a hiba továbbfutását
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Használjuk a Select2-t a megadott osztályon
        $('.select2-multiple').select2({
            // A TÉMA BEÁLLÍTÁSA A MEGFELELŐ CSS HASZNÁLATÁHOZ
            theme: "bootstrap-5",
            placeholder: "Kezdj el gépelni a választáshoz...",
            allowClear: true
        });
    });
</script>
</body>
</html>
