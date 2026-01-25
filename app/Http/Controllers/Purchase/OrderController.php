<?php

namespace App\Http\Controllers\Purchase;

use App\Data\SearchParams;
use App\Http\Controllers\InertiaController;
use App\Http\Controllers\Shared\SharedData;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

class OrderController extends InertiaController
{

    protected OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = $this->orderRepository->search(SearchParams::fromRequest($request));

        return $this->inertia('Purchase/Orders', [
            'orders' => $orders,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $code)
    {
        $order = $this->orderRepository->getByCode($code);

        return $this->inertia('Purchase/OrderDetail', [
            'order' => $order,
        ]);
    }
}
