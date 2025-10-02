<x-layouts.auth title="Login">
    <x-admin.form action="{{ route('login.store') }}" button="hello">
        <x-admin.forms.input name="email"/>
        <x-admin.forms.input name="password" type="password"/>

        @error('custom')
        <div class="text-danger mb-3">
            <small>{{ $message }}</small>
        </div>
        @enderror
    </x-admin.form>
    <hr>
    <a href="{{ route('register.index') }}">Register</a>
</x-layouts.auth>
