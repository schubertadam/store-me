<x-layouts.admin title="Edit user">
    <x-partials.admin.layout.page-title title="edit user: {{ $user->name }}"/>
    <div class="card">
        <div class="card-body">
            <x-partials.admin.form action="{{ route('users.update', $user) }}" method="PATCH" button="Update">
                <x-partials.admin.shared.user-form :user="$user" :roles="$roles"/>
            </x-partials.admin.form>
        </div>
    </div>
</x-layouts.admin>
