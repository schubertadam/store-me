<x-layouts.admin title="Products">
    <h1>Products</h1>
    <a href="{{ route('products.create') }}">Add new</a>
    <hr>
    <livewire:products-datatable />
</x-layouts.admin>
