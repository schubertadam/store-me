<x-layouts.admin title="Edit product">
    <x-partials.admin.layout.page-title title="Edit: {{ $product->name }}"/>
    <x-partials.admin.form action="{{ route('admin.products.update', $product) }}" method="PATCH" has-file="true">
        <x-partials.admin.shared.product-form
            :product="$product"
            :statuses="$statuses"
            :categories="$categories"
            :sale-types="$saleTypes"
            button="{{ __('Update') }}"
        />
    </x-partials.admin.form>
</x-layouts.admin>
