<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartService
{

    protected CartRepository $cartRepository;
    protected ProductRepository $productRepository;

    public function __construct(CartRepository $cartRepository, ProductRepository $productRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Get cart (DB if logged in, session if guest)
     *
     * @return CartItem[] Array of CartItem objects
     */
    public function getCart(): array
    {
        if (Auth::check()) {
            $cart = $this->cartRepository->getCartByUserId(Auth::id());
            return $cart ? $cart->items->toArray() : [];
        } else {
            $sessionCart = Session::get('cart', []);

            // Get product info
            $productIds = array_column($sessionCart, 'product_id');
            $products = $this->productRepository->findByIds($productIds)->keyBy('id');

            foreach ($sessionCart as &$item) {
                $item['product'] = $products[$item['product_id']] ?? null;
            }

            return $sessionCart;
        }
    }

    /**
     * Add items to cart
     */
    public function addItem(int $productId, int $quantity = 1)
    {
        $product = $this->productRepository->firstOrFail($productId);
        $price = $product->price;

        if (Auth::check()) {
            $cart = $this->cartRepository->getCartByUserId(Auth::id());
            if (!$cart) {
                $cart = $this->cartRepository->createCart(Auth::id());
            }
            return $this->cartRepository->addItem($cart, $productId, $quantity, $price);
        } else {
            $cart = Session::get('cart', []);

            // Check if the product already exists in the session cart
            $found = false;
            foreach ($cart as &$item) {
                if ($item['product_id'] == $productId) {
                    $item['quantity'] += $quantity;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $cart[] = [
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'price' => $price,
                ];
            }

            Session::put('cart', $cart);
            return $cart;
        }
    }

    /**
     * Update the quantity of an item in the cart
     */
    public function updateItem(int $productId, int $quantity)
    {
        if ($quantity < 1) {
            $quantity = 1;
        }

        if (Auth::check()) {
            $cart = $this->cartRepository->getCartByUserId(Auth::id());
            if (!$cart) return null;

            return $this->cartRepository->updateItem($cart, $productId, $quantity);
        } else {
            $cart = Session::get('cart', []);
            foreach ($cart as &$item) {
                if ($item['product_id'] == $productId) {
                    $item['quantity'] = $quantity;
                    break;
                }
            }
            Session::put('cart', $cart);
            return $cart;
        }
    }

    /**
     * Remove an item from the cart
     */
    public function removeItem(int $productId)
    {
        if (Auth::check()) {
            $cart = $this->cartRepository->getCartByUserId(Auth::id());
            if (!$cart) return null;

            return $this->cartRepository->removeItem($cart, $productId);
        } else {
            $cart = Session::get('cart', []);
            $cart = array_filter($cart, fn($item) => $item['product_id'] != $productId);
            // Reindex array to avoid gaps in session
            $cart = array_values($cart);
            Session::put('cart', $cart);
            return $cart;
        }
    }

    /**
     * Calculate total cart
     */
    public function calculateTotal($cart = null): float
    {
        $items = $cart ?? $this->getCart();

        return collect($items)->sum(fn($item) => $item['price'] * $item['quantity']);
    }

    /**
     * Clear cart
     */
    public function clearCart()
    {
        if (Auth::check()) {
            $cart = $this->cartRepository->getCartByUserId(Auth::id());
            if ($cart) {
                $this->cartRepository->clearCart($cart);
            }
        } else {
            Session::forget('cart');
        }
    }

    public function mergeSessionCart()
    {
        $sessionCart = Session::get('cart', []);
        if (!Auth::check() || empty($sessionCart)) return;

        $cart = $this->cartRepository->getCartByUserId(Auth::id()) ?? $this->cartRepository->createCart(Auth::id());

        foreach ($sessionCart as $item) {
            $this->cartRepository->addItem($cart, $item['product_id'], $item['quantity'], $item['price']);
        }

        Session::forget('cart');
    }
}
