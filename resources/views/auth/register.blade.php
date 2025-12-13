<x-layouts.auth title="{{ __('Sign Up') }}">
    <x-slot:title-bar>
        <x-partials.guest.layout.title-bars.overlap title="{{ __('Sign Up') }}"/>
    </x-slot:title-bar>

    <div class="card">
        <div class="card-body p-11 text-center">
            <h2 class="mb-3 text-start">Sign Up</h2>
            <p class="lead mb-6 text-start">Registration takes less than a minute.</p>

            <x-partials.guest.form action="{{ route('register.store') }}" button="Sign Up" class="text-start mb-3">
                <x-partials.guest.form-inputs.input name="name"/>
                <x-partials.guest.form-inputs.input name="email" type="email"/>
                <x-partials.guest.form-inputs.input name="password" type="password"/>
                <x-partials.guest.form-inputs.input name="password_confirmation" type="password"/>
            </x-partials.guest.form>

            <div class="divider-icon my-4">or</div>

            <p class="mb-0">
                Already have an account? <a href="{{ route('login.index') }}" class="hover">Sign in</a>
            </p>
        </div>
    </div>
</x-layouts.auth>
