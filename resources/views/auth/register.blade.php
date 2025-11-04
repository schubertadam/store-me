<x-layouts.auth title="Signup">
    <x-partials.admin.form action="{{ route('register.store') }}" button="Signup">
        <x-partials.admin.forms.input name="name"/>
        <x-partials.admin.forms.input name="email" type="email"/>
        <x-partials.admin.forms.input name="password" type="password"/>
        <x-partials.admin.forms.input name="password_confirmation" type="password"/>

        @error('custom')
        <p>{{ $message }}</p>
        @enderror
    </x-partials.admin.form>
    <hr>
    <a href="{{ route('login.index') }}">Login</a>
</x-layouts.auth>
