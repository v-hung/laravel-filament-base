<?php

namespace App\Http\Controllers\Shared;

use App\Models\Province;
use App\Models\Ward;
use App\Services\CartService;

class SharedData
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function getCart(): array
    {
        $cart = $this->cartService->getCart();
        $cartTotal = $this->cartService->calculateTotal($cart);

        return [
            'cart' => $cart,
            'cart_total' => $cartTotal,
        ];
    }

    public function getAddress()
    {
        $provinces = Province::get();
        $wards = Ward::Get();

        return [
            'provinces' => $provinces,
            'wards' => $wards,
        ];
    }
}
