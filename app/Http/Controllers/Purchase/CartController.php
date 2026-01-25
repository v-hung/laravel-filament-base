<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\InertiaController;
use App\Http\Controllers\Shared\SharedData;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends InertiaController
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = $this->cartService->getCart();

        return $this->inertia('Purchase/Cart', [
            'cart' => $cart,
            'cart_total' => $this->cartService->calculateTotal($cart)
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $quantity = $request->input('quantity', 1);

        $this->cartService->addItem($request->product_id, $quantity);

        parent::setSuccessMessage('Sản phẩm đã được thêm vào giỏ hàng.');

        return parent::back();
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1'
        ]);

        foreach ($request->quantities as $productId => $qty) {
            $this->cartService->updateItem((int)$productId, (int)$qty);
        }

        parent::setSuccessMessage('Giỏ hàng đã được cập nhật.');

        return parent::back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function remove(string $id)
    {
        $this->cartService->removeItem((int)$id);

        parent::setSuccessMessage('Sản phẩm đã được xóa khỏi giỏ hàng.');

        return parent::back();
    }
}
