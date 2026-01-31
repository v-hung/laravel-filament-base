<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaymentController extends Controller
{

	public function __construct(
		protected CartService $cartService,
		protected OrderService $orderService
	) {}
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$cart = $this->cartService->getCart();

		if (count($cart) == 0) {
			return redirect()->route('cart');
		}

		$cartTotal = $this->cartService->calculateTotal($cart);

		return Inertia::render('purchase/payment', [
			'cart' => $cart,
			'cartTotal' => $cartTotal,
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
			return redirect()->route('cart');
		}

		$order = $this->orderService->createOrder($cart, $data);

		return to_route('home');
	}
}
