<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="dark" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable"
      data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/velzon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/material-design-icons/icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/node-waves/waves.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/summernote/summernote-bs5.css') }}">
    @livewireStyles

    <script src="{{ asset('assets/js/velzon/layout.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery/jquery-3.6.1.min.js') }}"></script>
</head>
<body>
<div id="layout-wrapper">
    <header id="page-topbar">
        <div class="layout-width">
            <div class="navbar-header">
                @include('components.partials.admin.layout.topbar')
            </div>
        </div>
    </header>

    <div class="app-menu navbar-menu">
        <div class="navbar-brand-box">
            <!-- Dark Logo-->
            <a class="logo logo-dark">
                <span class="logo-sm p-0">
                    <h1 class="py-3">SM</h1>
                </span>
                <span class="logo-lg">
                    <h1 class="py-3">Store Me</h1>
                </span>
            </a>
            <!-- Light Logo-->
            <a class="logo logo-light">
                <span class="logo-sm">
                    <h1 class="py-3">SM</h1>
                </span>
                <span class="logo-lg">
                    <h1 class="py-3">Store Me</h1>
                </span>
            </a>
            <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                <i class="ri-record-circle-line"></i>
            </button>
        </div>

        <div id="scrollbar">
            <div class="container-fluid">
                <div id="two-column-menu"></div>
                <ul class="navbar-nav" id="navbar-nav">
                    @include('components.partials.admin.layout.navbar')
                </ul>
            </div>
        </div>

        <div class="sidebar-background"></div>
    </div>

    <div class="vertical-overlay"></div>

    <div class="main-content mb-3">
        <div class="page-content">
            <div class="container-fluid">
                {{ $slot }}
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Store Me
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Develop by <a href="https://www.linkedin.com/in/adam-schubert-40488b167/" target="_blank">Adam Schubert</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="{{ asset('assets/libs/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/summernote/summernote-bs5.js') }}"></script>
<script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/libs/choices/choices.min.js') }}"></script>
<script src="{{ asset('assets/libs/fontawesome/all.min.js') }}"></script>

<script src="{{ asset('assets/js/admin_custom.js') }}"></script>
<script src="{{ asset('assets/js/velzon/app.js') }}"></script>
<script src="{{ asset('assets/js/velzon/custom.js') }}"></script>

@livewireScripts
</body>
</html>
