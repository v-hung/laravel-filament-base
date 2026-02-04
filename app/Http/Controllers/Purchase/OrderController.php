<?php

namespace App\Http\Controllers\Purchase;

use App\Data\SearchParams;
use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function __construct(protected OrderRepository $orderRepository) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = $this->orderRepository->search(SearchParams::fromRequest($request));

        return Inertia::render('purchase/orders', [
            'orders' => $orders,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $code)
    {
        $order = $this->orderRepository->getByCode($code);

        return Inertia::render('purchase/order-detail', [
            'order' => $order,
        ]);
    }
}
