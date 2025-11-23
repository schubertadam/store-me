<x-layouts.auth title="Forgot password">
    <div class="card mt-4">
        <div class="card-body p-4">
            <div class="text-center mt-2">
                <h5 class="text-primary">Forgot Password?</h5>
                <p class="text-muted">Reset password with Store Me</p>

                <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop" colors="primary:#0ab39c" class="avatar-xl"></lord-icon>
            </div>

            <div class="alert border-0 alert-warning text-center mb-2 mx-2" role="alert">
                Enter your email and instructions will be sent to you!
            </div>

            <div class="p-2 mt-4">
                <x-partials.admin.form action="{{ route('forgot-password.store') }}">
                    <x-partials.admin.forms.input name="email" type="email" autocomplete="email"/>

                    @error('custom')
                    <p>{{ $message }}</p>
                    @enderror

                    <div class="mt-4">
                        <button class="btn btn-success w-100" type="submit">Send Reset Link</button>
                    </div>
                </x-partials.admin.form>
            </div>
        </div>
    </div>

    <div class="mt-4 text-center">
        <p class="mb-0">Wait, I remember my password... <a href="{{ route('login.index') }}" class="fw-semibold text-primary text-decoration-underline">Click here</a> </p>
    </div>
</x-layouts.auth>
