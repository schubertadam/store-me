<x-layouts.admin title="Products">
    <x-partials.admin.layout.page-title title="Create product"/>
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.products.create') }}" class="btn btn-success">
                <i class="ri-add-line align-bottom me-1"></i> Add Product</a>
        </div>
        <div class="card-body border border-dashed border-end-0 border-start-0">
            <livewire:products-datatable />
        </div>
    </div>
</x-layouts.admin>
