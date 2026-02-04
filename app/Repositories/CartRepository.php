<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartRepository
{
    public function getCartByUserId(int $userId): ?Cart
    {
        return Cart::with(['items.product'])->where('user_id', $userId)->first();
    }

    public function createCart(int $userId): Cart
    {
        return Cart::create(['user_id' => $userId]);
    }

    public function addItem(Cart $cart, int $productId, int $quantity, float $price): CartItem
    {
        $cartItem = $cart->items()->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->price = $price; // cập nhật giá
            $cartItem->save();
        } else {
            $cartItem = CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $price,
            ]);
        }

        return $cartItem;
    }

    /**
     * Update the quantity of an item in the cart
     */
    public function updateItem(Cart $cart, int $productId, int $quantity): ?CartItem
    {
        $cartItem = $cart->items()->where('product_id', $productId)->first();
        if (! $cartItem) {
            return null;
        }

        $cartItem->quantity = max(1, $quantity);
        $cartItem->save();

        return $cartItem;
    }

    /**
     * Remove an item from the cart by product ID
     */
    public function removeItem(Cart $cart, int $productId): bool
    {
        $cartItem = $cart->items()->where('product_id', $productId)->first();
        if (! $cartItem) {
            return false;
        }

        return $cartItem->delete();
    }

    public function clearCart(Cart $cart): void
    {
        $cart->items()->delete();
    }
}
