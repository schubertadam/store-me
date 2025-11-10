<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
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
</script>
</body>
</html>
