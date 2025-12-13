<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartService
{
    /**
     * Megtalálja vagy létrehozza a kosarat a paraméterek alapján, prioritás szerint.
     *
     * @param string $sessionId Az aktuális session ID (mindig létezik).
     * @param int|null $userId A bejelentkezett felhasználó ID-ja, vagy null.
     * @return Cart
     */
    public function getOrCreateCart(string $sessionId, ?int $userId = null): Cart
    {
        $cart = null;

        if (!is_null($userId)) {
            $cart = Cart::where('user_id', $userId)->first();
        }

        if (!$cart) {
            $cart = Cart::where('session_id', $sessionId)->first();
        }

        if ($cart) {
            if (!is_null($userId) && !$cart->user_id) {
                $cart->update([
                    'user_id' => $userId,
                    'session_id' => null,
                ]);
            }
            return $cart;
        }

        $data = !is_null($userId) ? ['user_id' => $userId] : ['session_id' => $sessionId];

        return Cart::create($data);
    }

    public function getCartSubtotal(?Cart $cart): int
    {
        if (is_null($cart)) {
            return 0;
        }

        $summary = 0;

        foreach ($cart->items as $item) {
            $summary += $item->price_at_addition * $item->quantity;
        }

        return $summary;
    }

    public function getCartItemsNumber(?Cart $cart): int
    {
        if (is_null($cart)) {
            return 0;
        }

        $number = 0;

        foreach ($cart->items as $item) {
            $number += $item->quantity;
        }

        return $number;
    }

    public function mergeCarts(string $guestSessionId, int $userId): void
    {
        // 1. Kosarak azonosítása
        $userCart = Cart::where('user_id', $userId)->first();
        $guestCart = Cart::where('session_id', $guestSessionId)->first();

        // Nincs mit tenni, ha vendég kosár nincs, vagy már fel lett dolgozva
        if (!$guestCart) {
            return;
        }

        // 2. Eset: Felhasználónak még nincs kosara -> KÖZVETLEN KONVERZIÓ
        if (!$userCart) {
            $guestCart->update([
                'user_id' => $userId,
                'session_id' => null, // Tisztítás
            ]);
            return;
        }

        // 3. Eset: Mindkét kosár létezik -> ITEM SZINTŰ FÚZIÓ

        $userCartId = $userCart->id;

        // Tételenkénti fúzió: increment vagy move
        foreach ($guestCart->items as $guestItem) {

            // A. Megpróbáljuk inkrementálni a darabszámot (ha az item már létezik a user kosárban)
            $isIncremented = CartItem::where('cart_id', $userCartId)
                ->where('product_id', $guestItem->product_id)
                ->increment('quantity', $guestItem->quantity); // Egyetlen DB hívás

            if ($isIncremented) {
                // Ha sikeresen inkrementáltunk, töröljük a vendég tételt
                $guestItem->delete();
            } else {
                // B. Ha az item még nem létezett, átmozgatjuk a user kosarába
                $guestItem->update(['cart_id' => $userCartId]);
            }
        }

        // 4. Utolsó lépés: Töröljük a vendég kosár fejlécét
        $guestCart->delete();
    }
}
