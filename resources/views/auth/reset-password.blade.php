<x-layouts.auth title="Login">
    <div class="card mt-4">
        <div class="card-body p-4">
            <div class="text-center mt-2">
                <h5 class="text-primary">Create new password</h5>
                <p class="text-muted">Your new password must be different from previous used password.</p>
            </div>
            <div class="p-2 mt-4">
                <x-partials.admin.form action="{{ route('reset-password.update', $token) }}" method="PATCH">
                    <x-partials.admin.forms.input name="email" type="email" autocomplete="email"/>
                    <x-partials.admin.forms.input name="password" type="password"/>
                    <x-partials.admin.forms.input name="password_confirmation" type="password"/>

                    @error('custom')
                    <p>{{ $message }}</p>
                    @enderror

                    <div class="mt-4">
                        <button class="btn btn-success w-100" type="submit">Reset Password</button>
                    </div>
                </x-partials.admin.form>
            </div>
        </div>
    </div>

    <div class="mt-4 text-center">
        <p class="mb-0">Wait, I remember my password... <a href="{{ route('login.index') }}" class="fw-semibold text-primary text-decoration-underline"> Click here </a> </p>
    </div>
</x-layouts.auth>
