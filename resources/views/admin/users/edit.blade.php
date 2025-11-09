<x-layouts.admin title="Edit user">
    <h1>Edit user</h1>
    <a href="{{ route('users.index') }}">Back to list</a>
    <hr>
    <x-partials.admin.form action="{{ route('users.update', $user) }}" method="PATCH" button="Update">
        <x-partials.admin.forms.input name="name" value="{{ $user->name }}"/>
        <x-partials.admin.forms.input name="email" type="email" value="{{ $user->email }}"/>

        @error('custom')
        <p>{{ $message }}</p>
        @enderror
    </x-partials.admin.form>
</x-layouts.admin>
