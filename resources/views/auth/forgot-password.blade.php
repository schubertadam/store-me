<x-layouts.auth title="{{ __('Forgot password') }}">
    <x-slot:title-bar>
        <x-partials.guest.layout.title-bars.overlap title="{{ __('Forgot password') }}"/>
    </x-slot:title-bar>

    <div class="card">
        <div class="card-body p-11 text-center">
            <h2 class="mb-3 text-start">Forgot your password?</h2>
            <p class="lead mb-6 text-start">Enter your email and we will reset it for you!</p>

            <x-partials.guest.form action="{{ route('forgot-password.store') }}" button="Send Reset Link" class="text-start mb-3">
                <x-partials.guest.form-inputs.input name="email" type="email"/>
            </x-partials.guest.form>

            <div class="divider-icon my-4">or</div>

            <p class="mb-0">
                Wait, I remember my password... <a href="{{ route('login.index') }}" class="hover">Sign in</a>
            </p>
        </div>
    </div>
</x-layouts.auth>
