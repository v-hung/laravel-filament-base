import { Head, Link, router } from '@inertiajs/react';
import AppLayout from '../../Layouts/AppLayout';

export default function Cart({ cart, cart_total }) {
    const handleUpdateQuantity = (itemId, quantity) => {
        if (quantity < 1) return;
        
        router.patch(`/cart/${itemId}`, { quantity }, {
            preserveState: true,
            preserveScroll: true,
        });
    };

    const handleRemoveItem = (itemId) => {
        if (confirm('Are you sure you want to remove this item?')) {
            router.delete(`/cart/${itemId}`, {
                preserveState: true,
                preserveScroll: true,
            });
        }
    };

    const handleCheckout = () => {
        router.get('/checkout');
    };

    return (
        <AppLayout title="Shopping Cart">
            <Head title="Cart" />

            {cart && cart.length > 0 ? (
                <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    {/* Cart Items */}
                    <div className="lg:col-span-2">
                        <div className="bg-white rounded-lg shadow-md">
                            <div className="p-6 border-b border-gray-200">
                                <h2 className="text-2xl font-bold text-gray-900">Shopping Cart</h2>
                                <p className="text-gray-600 mt-1">{cart.length} items</p>
                            </div>

                            <div className="divide-y divide-gray-200">
                                {cart.map((item) => (
                                    <div key={item.id} className="p-6">
                                        <div className="flex gap-6">
                                            {/* Product Image */}
                                            <div className="flex-shrink-0">
                                                {item.product?.image ? (
                                                    <img
                                                        src={item.product.image}
                                                        alt={item.product.name}
                                                        className="w-24 h-24 object-cover rounded-lg"
                                                    />
                                                ) : (
                                                    <div className="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center">
                                                        <span className="text-gray-400">No image</span>
                                                    </div>
                                                )}
                                            </div>

                                            {/* Product Info */}
                                            <div className="flex-1">
                                                <div className="flex justify-between">
                                                    <div>
                                                        <Link
                                                            href={`/products/${item.product?.slug}`}
                                                            className="text-lg font-semibold text-gray-900 hover:text-blue-600"
                                                        >
                                                            {item.product?.name}
                                                        </Link>
                                                        <p className="text-sm text-gray-500 mt-1">
                                                            ${item.price} each
                                                        </p>
                                                    </div>
                                                    <button
                                                        onClick={() => handleRemoveItem(item.id)}
                                                        className="text-red-600 hover:text-red-800"
                                                    >
                                                        <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>

                                                <div className="flex items-center justify-between mt-4">
                                                    {/* Quantity Controls */}
                                                    <div className="flex items-center gap-2">
                                                        <button
                                                            onClick={() => handleUpdateQuantity(item.id, item.quantity - 1)}
                                                            className="w-8 h-8 rounded-md border border-gray-300 flex items-center justify-center hover:bg-gray-100"
                                                            disabled={item.quantity <= 1}
                                                        >
                                                            -
                                                        </button>
                                                        <span className="w-12 text-center font-medium">{item.quantity}</span>
                                                        <button
                                                            onClick={() => handleUpdateQuantity(item.id, item.quantity + 1)}
                                                            className="w-8 h-8 rounded-md border border-gray-300 flex items-center justify-center hover:bg-gray-100"
                                                        >
                                                            +
                                                        </button>
                                                    </div>

                                                    {/* Subtotal */}
                                                    <div className="text-right">
                                                        <p className="text-lg font-bold text-gray-900">
                                                            ${(item.price * item.quantity).toFixed(2)}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>

                        {/* Continue Shopping */}
                        <div className="mt-6">
                            <Link
                                href="/shop"
                                className="inline-flex items-center text-blue-600 hover:text-blue-800"
                            >
                                <svg className="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 19l-7-7 7-7" />
                                </svg>
                                Continue Shopping
                            </Link>
                        </div>
                    </div>

                    {/* Order Summary */}
                    <div className="lg:col-span-1">
                        <div className="bg-white rounded-lg shadow-md p-6 sticky top-6">
                            <h3 className="text-xl font-bold text-gray-900 mb-4">Order Summary</h3>

                            <div className="space-y-3 mb-6">
                                <div className="flex justify-between text-gray-600">
                                    <span>Subtotal</span>
                                    <span>${cart_total?.subtotal?.toFixed(2) || '0.00'}</span>
                                </div>
                                <div className="flex justify-between text-gray-600">
                                    <span>Shipping</span>
                                    <span>${cart_total?.shipping?.toFixed(2) || '0.00'}</span>
                                </div>
                                <div className="flex justify-between text-gray-600">
                                    <span>Tax</span>
                                    <span>${cart_total?.tax?.toFixed(2) || '0.00'}</span>
                                </div>
                                <div className="border-t border-gray-200 pt-3 flex justify-between text-lg font-bold text-gray-900">
                                    <span>Total</span>
                                    <span>${cart_total?.total?.toFixed(2) || '0.00'}</span>
                                </div>
                            </div>

                            <button
                                onClick={handleCheckout}
                                className="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition"
                            >
                                Proceed to Checkout
                            </button>

                            <div className="mt-6 space-y-2">
                                <div className="flex items-center text-sm text-gray-600">
                                    <svg className="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5 13l4 4L19 7" />
                                    </svg>
                                    Free shipping on orders over $100
                                </div>
                                <div className="flex items-center text-sm text-gray-600">
                                    <svg className="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5 13l4 4L19 7" />
                                    </svg>
                                    Secure checkout
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ) : (
                /* Empty Cart */
                <div className="bg-white rounded-lg shadow-md p-12 text-center">
                    <svg className="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <h2 className="text-2xl font-bold text-gray-900 mb-2">Your cart is empty</h2>
                    <p className="text-gray-600 mb-6">Start shopping to add items to your cart</p>
                    <Link
                        href="/shop"
                        className="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition"
                    >
                        Start Shopping
                    </Link>
                </div>
            )}
        </AppLayout>
    );
}
