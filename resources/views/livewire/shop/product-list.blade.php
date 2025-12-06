<div class="row gy-10">
    {{-- BAL OLDAL: SZŰRŐK --}}
    <aside class="col-lg-3 sidebar">

        <div class="widget">
            <h4 class="widget-title mb-3">Kategóriák</h4>

            <ul class="list-unstyled ps-0">

                {{-- KÖTELEZŐ: Összes termék gomb (szűrő reset) --}}
                <li class="mb-1">
                    <a href="#"
                       wire:click.prevent="$set('categoryFilter', null)"
                       class="align-items-center rounded link-body @if(is_null($categoryFilter)) active @endif"
                    >
                        Minden termék
                    </a>
                </li>

                {{-- KULCS: REKURZÍV HÍVÁS A KATEGÓRIÁKRA --}}
                @if (isset($categories))
                    @include('components.partials.guest.shop.category-tree', ['categories' => $categories])
                @endif
            </ul>
        </div>


        {{-- ÁR SZŰRŐ (Range Sliderrel) --}}
        <div class="widget">
            <h4 class="widget-title mb-3">Ár Szűrő</h4>
            {{-- Megjegyzés: A valós csúszka itt complex JS-t igényel. Egyszerű inputokat használunk a bindeléshez. --}}
            <div class="mb-3">
                <label for="minPrice" class="form-label">Min. Ár:</label>
                <input type="number" wire:model.live.debounce.500ms="minPrice" min="0" class="form-control" />
            </div>
            <div class="mb-3">
                <label for="maxPrice" class="form-label">Max. Ár ({{ format_currency($maxPrice) }})</label>
                <input type="range" wire:model.live="maxPrice" min="0" max="1000000" step="1000" class="form-range" />
            </div>
        </div>

        {{-- RATING SZŰRŐ --}}
        <div class="widget">
            <h4 class="widget-title mb-3">Rating</h4>
            {{-- Minden radio gombot bindelni kell --}}
            @for ($i = 5; $i >= 1; $i--)
                <div class="form-check mb-1">
                    <input class="form-check-input" type="radio" wire:model.live="ratingFilter" name="rating" id="rating{{ $i }}" value="{{ $i }}">
                    <label class="form-check-label" for="rating{{ $i }}">
                        <span class="ratings five"></span> ({{ $i }} csillag)
                    </label>
                </div>
            @endfor
        </div>
    </aside>

    {{-- JOBB OLDAL: TERMÉKLISTA --}}
    <div class="col-lg-9 order-lg-2">

        {{-- RENDEZÉS --}}
        <div class="row align-items-center mb-10 position-relative zindex-1">
            <div class="col-md-7 col-xl-8 pe-xl-20">
                {{-- Dinamikus darabszám kijelzés --}}
                <h2 class="display-6 mb-1">Termékek</h2>
                <p class="mb-0 text-muted">Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }} results</p>
            </div>
            <div class="col-md-5 col-xl-4 ms-md-auto text-md-end mt-5 mt-md-0">
                <div class="form-select-wrapper">
                    {{-- Rendezés SELECT (orderBy bindelés) --}}
                    <select wire:model.live="orderBy" class="form-select">
                        @foreach ($sortOptions as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- TERMÉK CIKLUS --}}
        <div class="grid grid-view projects-masonry shop mb-13">
            <div class="row gx-md-8 gy-10 gy-md-13 isotope">
                @forelse($products as $product)
                    <x-partials.guest.layout.product :product="$product"/>
                @empty
                    <p class="alert alert-info">A szűrőnek megfelelő termék nem található.</p>
                @endforelse
            </div>
        </div>

        {{-- LAPOZÁS --}}
        <nav class="d-flex justify-content-center" aria-label="pagination">
            {{ $products->links('pagination::bootstrap-5') }}
        </nav>
    </div>
</div>
