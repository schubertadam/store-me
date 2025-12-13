<x-layouts.auth title="{{ __('Login') }}">
    <x-slot:title-bar>
        <x-partials.guest.layout.title-bars.overlap title="{{ __('Login') }}"/>
    </x-slot:title-bar>

    <div class="card">
        <div class="card-body p-11 text-center">
            <h2 class="mb-3 text-start">Welcome Back</h2>
            <p class="lead mb-6 text-start">Fill your email and password to sign in.</p>

            <x-partials.guest.form action="{{ route('login.store') }}" button="Login" class="text-start mb-3">
                <x-partials.guest.form-inputs.input name="email" type="email"/>
                <x-partials.guest.form-inputs.input name="password" type="password"/>
            </x-partials.guest.form>

            <div class="divider-icon my-4">or</div>
            <p class="mb-1">
                <a href="{{ route('forgot-password.create') }}" class="hover">Forgot Password?</a>
            </p>
            <p class="mb-0">
                Don't have an account? <a href="{{ route('register.create') }}" class="hover">Sign up</a>
            </p>
        </div>
    </div>
</x-layouts.auth>
