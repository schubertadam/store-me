<?php

namespace App\Http\Middleware;

use App\Services\CartService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCartExistsMiddleware
{
    private readonly CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function handle(Request $request, Closure $next): Response
    {
        $cart = $this->cartService->getOrCreateCart($request->session()->getId(), auth()->user()->id ?? null);

        $request->attributes->set('cart', $cart);

        return $next($request);
    }
}
