<x-layouts.admin title="Create product">
    <x-partials.admin.layout.page-title title="Create product"/>


    <x-partials.admin.form action="{{ route('products.store') }}" has-file="true">
        <x-partials.admin.shared.product-form
            :product="$product"
            :statuses="$statuses"
            :categories="$categories"
            :sale-types="$saleTypes"
            button="{{ __('Submit') }}"
        />
    </x-partials.admin.form>
</x-layouts.admin>
