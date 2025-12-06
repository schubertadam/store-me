@props([
    'product'
])
<div class="project item col-md-6 col-xl-3">
    <figure class="rounded mb-6">
        <img src="{{ $product->getThumbnail() }}" style="width: 290px" alt="" />
        @auth
            <a class="item-like" href="#" data-bs-toggle="white-tooltip" title="Add to wishlist">
                <i class="uil uil-heart"></i>
            </a>
            <a class="item-view" href="#" data-bs-toggle="white-tooltip" title="Quick view">
                <i class="uil uil-eye"></i>
            </a>
        @endauth
        <button onclick="dispatchAddToCart({{ $product->id }})" class="item-cart">
            <i class="uil uil-shopping-bag"></i> Add to Cart
        </button>
    </figure>
    <div class="post-header">
        <div class="d-flex flex-row align-items-center justify-content-between mb-2">
            <div class="post-category text-ash mb-0">{{ $product->category->name }}</div>
        </div>
        <h2 class="post-title h3 fs-22"><a href="./shop-product.html" class="link-dark">Earphones</a></h2>
        <p class="price"><span class="amount">$55.00</span></p>
    </div>
</div>
