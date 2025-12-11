<x-layouts.auth title="Signup">
    <div class="card mt-4">
        <div class="card-body p-4">
            <div class="text-center mt-2">
                <h5 class="text-primary">Create New Account</h5>
                <p class="text-muted">Get your free account now</p>
            </div>
            <div class="p-2 mt-4">
                <x-partials.admin.form action="{{ route('admin.register.store') }}">
                    <x-partials.admin.forms.input name="name"/>
                    <x-partials.admin.forms.input name="email" type="email"/>
                    <x-partials.admin.forms.input-password name="password"/>
                    <x-partials.admin.forms.input-password name="password_confirmation"/>

                    @error('custom')
                    <p>{{ $message }}</p>
                    @enderror

                    <div class="mt-4">
                        <button class="btn btn-success w-100" type="submit">Sign Up</button>
                    </div>
                </x-partials.admin.form>
            </div>
        </div>
    </div>

    <div class="mt-4 text-center">
        <p class="mb-0">Already have an account ? <a href="{{ route('admin.login.index') }}" class="fw-semibold text-primary text-decoration-underline"> Signin </a> </p>
    </div>
</x-layouts.auth>
