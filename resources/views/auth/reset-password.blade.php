<x-layouts.auth title="Reset password">
    <x-partials.admin.form action="{{ route('reset-password.update', $token) }}" method="PATCH" button="Update password">
        <x-partials.admin.forms.input name="email" type="email" autocomplete="email"/>
        <x-partials.admin.forms.input name="password" type="password"/>
        <x-partials.admin.forms.input name="password_confirmation" type="password"/>

        @error('custom')
        <p>{{ $message }}</p>
        @enderror
    </x-partials.admin.form>
    <hr>
    <a href="{{ route('login.index') }}">Login</a> | <a href="{{ route('register.create') }}">Register</a>
</x-layouts.auth>
