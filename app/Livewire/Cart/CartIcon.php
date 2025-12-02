<?php

namespace App\Livewire\Cart;

use App\Services\CartService;
use Livewire\Component;

class CartIcon extends Component
{
    public int $numberOfItems = 0;

    protected $listeners = ['cartUpdated' => 'recalculate'];

    public function mount(CartService $cartService)
    {
        $this->recalculate($cartService);
    }

    public function recalculate(CartService $cartService): void
    {
        $this->numberOfItems = $cartService->getCartItemsNumber(request()->get('cart'));
    }

    public function render()
    {
        return view('livewire.cart.cart-icon');
    }
}
