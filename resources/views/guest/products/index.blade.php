<x-layouts.guest title="{{ __('Products') }}">
    <x-partials.guest.layout.page-title title="{{ __('Products') }}"/>
    <section class="wrapper bg-light">
        <div class="container py-14 py-md-16">
            <livewire:shop.product-list/>
        </div>
    </section>
</x-layouts.guest>
