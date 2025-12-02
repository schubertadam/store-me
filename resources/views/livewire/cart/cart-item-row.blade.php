<div class="shopping-cart-item d-flex justify-content-between mb-4">
    <div class="d-flex flex-row">
        <figure class="rounded w-17">
            <a href="#">
                <img src="{{ $item->product->getThumbnail() }}" alt="{{ $item->product->name }}" />
            </a>
        </figure>
        <div class="w-100 ms-4">
            <h3 class="post-title fs-16 lh-xs mb-1">
                <a href="#" class="link-dark">
                    {{ $item->product->name }}
                </a>
            </h3>

            {{-- Ár (nettó ár, mivel a bruttót a rendszer számolja) --}}
            <p class="price fs-sm">
                <ins><span class="amount">{{ format_currency($item->price_at_addition) }}</span></ins>
            </p>

            {{-- Darabszám input (wire:model.live használatával) --}}
            <div class="form-select-wrapper">
                <input type="number"
                       wire:model.live.debounce.300ms="quantity"
                       wire:key="qty-{{ $item->id }}"
                       min="1"
                       class="form-control form-control-sm"
                       style="width: 80px;">
                @error('quantity') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    {{-- Törlés gomb --}}
    <div class="ms-2">
        <button wire:click="removeItem" wire:confirm="Biztosan törölni szeretnéd a terméket a kosárból?" class="btn btn-link link-dark p-0">
            <i class="uil uil-trash-alt"></i>
        </button>
    </div>
</div>
