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
            </ul>
        </nav>
    </header>
    {{ $slot }}
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
@livewireScripts
</body>
</html>
