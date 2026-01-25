<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Shared\SharedData;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected CartService $cartService;
    protected OrderService $orderService;

    public function __construct(CartService $cartService, OrderService $orderService)
    {
        $this->cartService = $cartService;
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = $this->cartService->getCart();

        if (count($cart) == 0) {
            return redirect('cart');
        }

        parent::shared(app(SharedData::class)->getCart());
        parent::shared(app(SharedData::class)->getAddress());

        return parent::view([
            'cart' => $cart,
            'cart_total' => $this->cartService->calculateTotal($cart)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function process(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'phone'       => 'required|digits_between:9,11',
            'email'       => 'required|email',
            'province_id' => 'required|exists:provinces,id',
            'ward_id'     => 'required|exists:wards,id',
            'address'     => 'required|string|max:255',
            'note'        => 'nullable|string|max:500',
            'payment_method' => 'required|in:bank_transfer,cash_delivery',
        ]);

        $cart = $this->cartService->getCart();

        if (count($cart) == 0) {
            return redirect('cart');
        }

        $order = $this->orderService->createOrder($cart, $data);

        parent::setSuccessMessage('Tạo đơn hàng thành công');

        return parent::redirectRoute('home');
    }
}
