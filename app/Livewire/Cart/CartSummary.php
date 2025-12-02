<?php

namespace App\Livewire\Cart;

use Livewire\Component;
use App\Services\CartService;

class CartSummary extends Component
{
    // Publikus property-k a megjelenítéshez
    public float $subtotal = 0.0;
    public float $shippingFee = 0.0;
    public float $total = 0.0;

    // Figyeli a frissítési eseményt a CartItemRow komponensből
    protected $listeners = [
        'cartUpdated' => 'recalculateSummary',
        'cartItemAdded' => 'recalculateSummary'
    ];

    public function mount(CartService $cartService)
    {
        // Kezdeti adatok betöltése
        $this->recalculateSummary($cartService);
    }

    // Minden kosár-módosítás (mennyiség, törlés) után lefut
    public function recalculateSummary(CartService $cartService)
    {
        // 1. Nettó végösszeg lekérése a Service-től
        $this->subtotal = $cartService->getCartSubtotal(request()->get('cart'));

        // 2. Szállítási díj (példa: 1500 Ft)
        // Megjegyzés: A valós logikát ide be kell építeni (pl. ingyenes szállítás határ)
        $this->shippingFee = 1500.00;

        // 3. Végösszeg számítása
        $this->total = $this->subtotal + $this->shippingFee;
    }

    public function render()
    {
        return view('livewire.cart.cart-summary');
    }
}
