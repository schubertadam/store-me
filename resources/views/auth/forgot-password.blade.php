<x-layouts.auth title="Forgot password">
    <x-partials.admin.form action="{{ route('forgot-password.store') }}" button="Send reset link">
        <x-partials.admin.forms.input name="email" type="email" autocomplete="email"/>

        @error('custom')
        <p>{{ $message }}</p>
        @enderror
    </x-partials.admin.form>
    <hr>
    <a href="{{ route('login.index') }}">Login</a> | <a href="{{ route('register.create') }}">Register</a>
</x-layouts.auth>
