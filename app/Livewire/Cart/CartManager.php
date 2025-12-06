<?php

namespace App\Livewire\Cart;

use App\Models\CartItem;
use App\Models\Product;
use Livewire\Component;

class CartManager extends Component
{
    // Figyeli a JavaScriptből érkező 'addItemFromJs' eseményt
    protected $listeners = ['cartItemAdded' => 'addItemToCart'];

    // Dependency Injection
    public function __construct() {}

    /**
     * Kosárba helyezés esemény kezelése.
     * @param array $data A JavaScriptből érkező adatok (pl. ['variantId' => 5]).
     */
    public function addItemToCart(int $productId)
    {
        $product = Product::find($productId)->first();
        $cart = request()->get('cart');

        $item = $cart->items()->where('product_id', $productId)->first();

        if ($item) {
            $item->quantity += 1;
            $item->save();
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => 1,
                'price_at_addition' => $product->price,
            ]);
        }

        $this->dispatch('cartUpdated');
    }

    /**
     * A komponensnek csak egy üres View-t kell renderelnie, mivel ez egy rejtett vezérlő.
     */
    public function render()
    {
        return view('livewire.cart.cart-manager'); // Ez lehet egy üres div
    }
}
