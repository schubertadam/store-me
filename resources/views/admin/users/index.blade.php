<x-layouts.admin title="User management">
    <h1>List of users</h1>
    <a href="{{ route('users.create') }}">Add new</a>
    <hr>
    <livewire:users-datatable />
</x-layouts.admin>
