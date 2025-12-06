<x-layouts.guest title="Products">
    <x-partials.guest.layout.page-title title="Shop"/>
    <section class="wrapper bg-light">
        <div class="container py-14 py-md-16 pt-12">
            <div class="grid grid-view projects-masonry shop mb-13">
                <div class="row gx-md-8 gy-10 gy-md-13 isotope">
                    @foreach(\App\Models\Product::all() as $product)
                        <x-partials.guest.layout.product :product="$product"/>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</x-layouts.guest>
