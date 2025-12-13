<x-layouts.auth title="{{ __('Reset password') }}">
    <x-slot:title-bar>
        <x-partials.guest.layout.title-bars.overlap title="{{ __('Reset password') }}"/>
    </x-slot:title-bar>

    <div class="card">
        <div class="card-body p-11 text-center">
            <h2 class="mb-3 text-start">Create new password</h2>
            <p class="lead mb-6 text-start">Your new password must be different from previous used password.</p>

            <x-partials.guest.form action="{{ route('reset-password.update', $token) }}" method="PATCH" button="Reset Password" class="text-start mb-3">
                <x-partials.guest.form-inputs.input name="password" type="password"/>
                <x-partials.guest.form-inputs.input name="password_confirmation" type="password"/>
            </x-partials.guest.form>

            <div class="divider-icon my-4">or</div>

            <p class="mb-0">
                Wait, I remember my password... <a href="{{ route('login.index') }}" class="hover">Sign in</a>
            </p>
        </div>
    </div>
</x-layouts.auth>

