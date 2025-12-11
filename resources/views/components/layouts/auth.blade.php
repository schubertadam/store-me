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
</head>
<body>
<div class="auth-page-wrapper pt-5">
    <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
        <div class="bg-overlay"></div>

        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
            </svg>
        </div>
    </div>

    <div class="auth-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-sm-5 mb-4 text-white-50">
                        <div>
                            <a href="{{ route('admin.login.index') }}" class="d-inline-block auth-logo">
                                <h1>Store Me</h1>
                            </a>
                        </div>
                        <p class="mt-3 fs-15 fw-medium">Webshop engine made with <i class="mdi mdi-heart text-danger"></i> for you.</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0 text-muted">&copy;
                            <script>document.write(new Date().getFullYear())</script> Store Me. Developed by <a href="">Adam Schubert</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<script src="{{ asset('assets/libs/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/jquery/jquery-3.6.1.min.js') }}"></script>

<script src="{{ asset('assets/libs/particles-js/particles.js') }}"></script>
<script src="{{ asset('assets/libs/particles-js/particles.app.js') }}"></script>
<script src="{{ asset('assets/js/velzon/password-addon.init.js') }}"></script>
</body>
</html>
