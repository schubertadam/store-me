<x-layouts.admin title="Create new user">
    <h1>Create new user</h1>
    <a href="{{ route('users.index') }}">Back to list</a>
    <hr>
    <x-partials.admin.form action="{{ route('users.store') }}" button="Create">
        <x-partials.admin.forms.input name="name"/>
        <x-partials.admin.forms.input name="email" type="email"/>
        <x-partials.admin.forms.input name="password" type="password"/>
        <x-partials.admin.forms.input name="password_confirmation" type="password"/>

        @error('custom')
        <p>{{ $message }}</p>
        @enderror
    </x-partials.admin.form>
</x-layouts.admin>
