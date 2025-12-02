<?php

namespace App\Livewire\Cart;

use App\Models\Product;
use Livewire\Component;
use App\Models\CartItem; // A kosártétel modell

class CartItemRow extends Component
{
    // Publikus property-k a kezdeti érték átadásához
    public CartItem $item;
    public int $quantity;

    // A kosár oldalt frissítő esemény
    protected $listeners = [
        'cartItemRemoved' => '$refresh',
        'cartItemAdded' => 'updateQuantityFromDB'
    ];

    public function mount(CartItem $item)
    {
        $this->item = $item;
        $this->quantity = $item->quantity;
    }

    public function updateQuantityFromDB()
    {
        $cart = request()->get('cart');

        $this->quantity = $cart->items()->where('id', $this->item->id)->first()->quantity;
    }

    public function updatedQuantity()
    {
        // 1. Validáció: biztosítsuk, hogy a darabszám minimum 1 legyen
        $this->validate(['quantity' => 'required|integer|min:1']);

        // 2. Adatbázis frissítése
        $this->item->quantity = $this->quantity;
        $this->item->save();

        // Opcionális: Esemény küldése a CartSummary komponensnek a végösszeg frissítéséhez
        $this->dispatch('cartUpdated');
    }

    // Tétel törlése
    public function removeItem()
    {
        $this->item->delete();

        // Esemény küldése: Frissítjük a teljes oldalt és a kosárszámlálót
        $this->dispatch('cartUpdated');
        $this->dispatch('cartItemRemoved'); // Frissíti a listát (a lista kikerül a DOM-ból)

        session()->flash('success', 'A termék el lett távolítva a kosárból.');
    }

    public function render()
    {
        // Itt a view-ban történik a tényleges renderelés
        return view('livewire.cart.cart-item-row');
    }
}
