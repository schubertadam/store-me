<x-layouts.auth title="Login">
    <x-partials.admin.form action="{{ route('login.store') }}" button="Login">
        <x-partials.admin.forms.input name="email" type="email" autocomplete="email"/>
        <x-partials.admin.forms.input name="password" type="password" autocomplete="current-password"/>

        @error('custom')
            <p>{{ $message }}</p>
        @enderror
    </x-partials.admin.form>
    <hr>
    <a href="{{ route('register.create') }}">Register</a>
</x-layouts.auth>
