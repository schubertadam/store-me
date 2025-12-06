<div>
    @forelse ($items as $item)
        {{-- Minden tételt beágyazott Livewire komponensként renderel --}}
        <livewire:cart.cart-item-row :item="$item" :key="$item->id" />
    @empty
        <p class="text-muted text-center">A kosár jelenleg üres.</p>
    @endforelse
</div>
