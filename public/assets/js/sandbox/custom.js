function dispatchAddToCart(productId) {
    // Livewire V3+ szintaxis: A globális diszpatch használata
    if (typeof Livewire !== 'undefined') {

        // KULCS: Elindítja az eseményt, amit a CartManager figyel
        Livewire.dispatch('cartItemAdded', { productId: productId });
    } else {
        // Vészmegoldás, ha a Livewire JS hiányzik
        alert("A kosárba helyezéshez a Livewire JS szükséges!");
    }
}
