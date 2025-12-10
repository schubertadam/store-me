<x-layouts.admin title="User management">
    <x-partials.admin.layout.page-title title="users"/>
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.users.create') }}" class="btn btn-success">
                <i class="ri-add-line align-bottom me-1"></i> Add User
            </a>
        </div>
        <div class="card-body">
            <livewire:users-datatable />
        </div>
    </div>
</x-layouts.admin>
