<x-layouts.auth title="Login">
    <div class="card mt-4">
        <div class="card-body p-4">
            <div class="text-center mt-2">
                <h5 class="text-primary">Welcome Back !</h5>
                <p class="text-muted">Sign in to continue to Store Me.</p>
            </div>
            <div class="p-2 mt-4">
                <x-partials.admin.form action="{{ route('login.store') }}">
                    <x-partials.admin.forms.input name="email" type="email" autocomplete="email"/>
                    <x-partials.admin.forms.input-password name="password" autocomplete="current-password" float-route="{{ route('forgot-password.create') }}" float-route-name="{{ __('Forgot Password?') }}"/>

                    @error('custom')
                    <p>{{ $message }}</p>
                    @enderror

                    <div class="mt-4">
                        <button class="btn btn-success w-100" type="submit">Sign In</button>
                    </div>
                </x-partials.admin.form>
            </div>
        </div>
    </div>

    <div class="mt-4 text-center">
        <p class="mb-0">Don't have an account ? <a href="{{ route('register.create') }}" class="fw-semibold text-primary text-decoration-underline"> Signup </a> </p>
    </div>
</x-layouts.auth>
