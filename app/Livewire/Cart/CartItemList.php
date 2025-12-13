<?php

namespace App\Livewire\Cart;

use Livewire\Component;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartItemList extends Component
{
    public $items;

    protected $listeners = [
        'cartUpdated' => 'updateCart',
    ];

    public function mount(): void
    {
        $cart = request()->get('cart');

        if (is_null($cart)) {
            $this->items = [];
        } else {
            $this->items = $cart->items;
        }
    }

    public function updateCart()
    {
        $this->items = request()->get('cart')->items;
    }

    public function render()
    {
        return view('livewire.cart.cart-item-list');
    }
}
