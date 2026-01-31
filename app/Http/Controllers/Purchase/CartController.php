<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{

	public function __construct(protected CartService $cartService) {}

	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		// $cart = $this->cartService->getCart();

		return Inertia::render('purchase/cart', [
			// 'cart' => $cart
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

		return back();
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

		return back();
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function remove(string $id)
	{
		$this->cartService->removeItem((int)$id);

		return back();
	}
}
