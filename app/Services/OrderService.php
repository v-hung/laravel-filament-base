<?php

namespace App\Services;

use App\Data\SearchParams;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function createOrder($cart, array $data): Order
    {
        $cart = $cart ?? $this->cartService->getCart();

        if (empty($cart)) {
            throw new \Exception('Giỏ hàng trống');
        }

        $orderCode = $this->createOrderCode();

        return DB::transaction(function () use ($cart, $data, $orderCode) {
            $order = Order::create([
                'code' => $orderCode,
                'user_id' => Auth::id(),
                'total' => $this->cartService->calculateTotal($cart),
                'status' => OrderStatus::Pending,
                'payment_method' => $data['payment_method'],
                'payment_status' => PaymentStatus::Pending,
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'province_id' => $data['province_id'] ?? null,
                'ward_id' => $data['ward_id'] ?? null,
                'address' => $data['address'] ?? null,
                'note' => $data['note'] ?? null,
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['product']['price'],
                ]);
            }

            $this->cartService->clearCart();

            return $order;
        });
    }

    public function createOrderCode(): string
    {
        $todayOrdersCount = Order::whereDate('created_at', today())->count() + 1;
        $orderCode = 'ORD-' . now()->format('Ymd') . '-' . str_pad($todayOrdersCount, 4, '0', STR_PAD_LEFT);

        return $orderCode;
    }
}
