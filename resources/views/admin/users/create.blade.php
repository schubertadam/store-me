<x-layouts.admin title="Create new user">
    <x-partials.admin.layout.page-title title="create new user"/>
    <div class="card">
        <div class="card-body">
            <x-partials.admin.form action="{{ route('users.store') }}" button="Create">
                <x-partials.admin.shared.user-form :user="$user" :roles="$roles"/>
            </x-partials.admin.form>
        </div>
    </div>
</x-layouts.admin>
