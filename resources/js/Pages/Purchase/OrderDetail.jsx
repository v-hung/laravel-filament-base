import { Head, Link } from '@inertiajs/react';
import AppLayout from '../../Layouts/AppLayout';

export default function OrderDetail({ order }) {
    const getStatusBadge = (status) => {
        const badges = {
            pending: 'bg-yellow-100 text-yellow-800',
            processing: 'bg-blue-100 text-blue-800',
            completed: 'bg-green-100 text-green-800',
            cancelled: 'bg-red-100 text-red-800',
        };
        return badges[status] || 'bg-gray-100 text-gray-800';
    };

    const getPaymentStatusBadge = (status) => {
        const badges = {
            pending: 'bg-yellow-100 text-yellow-800',
            paid: 'bg-green-100 text-green-800',
            failed: 'bg-red-100 text-red-800',
        };
        return badges[status] || 'bg-gray-100 text-gray-800';
    };

    return (
        <AppLayout>
            <Head title={`Order #${order.code}`} />

            <div className="max-w-4xl mx-auto space-y-6">
                {/* Back Link */}
                <Link
                    href={route('orders')}
                    className="inline-flex items-center text-blue-600 hover:text-blue-800"
                >
                    <svg className="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Orders
                </Link>

                {/* Order Header */}
                <div className="bg-white rounded-lg shadow-md p-6">
                    <div className="flex items-center justify-between mb-4">
                        <div>
                            <h1 className="text-2xl font-bold text-gray-900">Order #{order.code}</h1>
                            <p className="text-gray-600 mt-1">Placed on {order.created_at}</p>
                        </div>
                        <span className={`px-4 py-2 rounded-full text-sm font-semibold ${getStatusBadge(order.status)}`}>
                            {order.status}
                        </span>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-3 gap-6 pt-6 border-t border-gray-200">
                        <div>
                            <h3 className="text-sm font-medium text-gray-500 mb-1">Payment Status</h3>
                            <span className={`inline-block px-3 py-1 rounded text-sm font-semibold ${getPaymentStatusBadge(order.payment_status)}`}>
                                {order.payment_status}
                            </span>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500 mb-1">Payment Method</h3>
                            <p className="text-gray-900 font-medium">{order.payment_method}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500 mb-1">Total Amount</h3>
                            <p className="text-2xl font-bold text-gray-900">${order.total?.toFixed(2)}</p>
                        </div>
                    </div>
                </div>

                {/* Shipping Information */}
                <div className="bg-white rounded-lg shadow-md p-6">
                    <h2 className="text-xl font-bold text-gray-900 mb-4">Shipping Information</h2>
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 className="text-sm font-medium text-gray-500 mb-2">Customer Name</h3>
                            <p className="text-gray-900">{order.customer_name}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium text-gray-500 mb-2">Phone Number</h3>
                            <p className="text-gray-900">{order.phone}</p>
                        </div>
                        <div className="md:col-span-2">
                            <h3 className="text-sm font-medium text-gray-500 mb-2">Delivery Address</h3>
                            <p className="text-gray-900">{order.address}</p>
                        </div>
                        {order.notes && (
                            <div className="md:col-span-2">
                                <h3 className="text-sm font-medium text-gray-500 mb-2">Order Notes</h3>
                                <p className="text-gray-900">{order.notes}</p>
                            </div>
                        )}
                    </div>
                </div>

                {/* Order Items */}
                <div className="bg-white rounded-lg shadow-md p-6">
                    <h2 className="text-xl font-bold text-gray-900 mb-4">Order Items</h2>
                    <div className="divide-y divide-gray-200">
                        {order.items?.map((item) => (
                            <div key={item.id} className="py-4 flex gap-4">
                                <div className="flex-shrink-0">
                                    {item.product?.image ? (
                                        <img
                                            src={item.product.image}
                                            alt={item.product.name}
                                            className="w-20 h-20 object-cover rounded"
                                        />
                                    ) : (
                                        <div className="w-20 h-20 bg-gray-200 rounded flex items-center justify-center">
                                            <span className="text-gray-400 text-xs">No image</span>
                                        </div>
                                    )}
                                </div>
                                <div className="flex-1">
                                    <h3 className="font-semibold text-gray-900">{item.product_name}</h3>
                                    <p className="text-sm text-gray-500 mt-1">
                                        Quantity: {item.quantity}
                                    </p>
                                    <p className="text-sm text-gray-500">
                                        Price: ${item.price?.toFixed(2)}
                                    </p>
                                </div>
                                <div className="text-right">
                                    <p className="font-semibold text-gray-900">
                                        ${(item.price * item.quantity)?.toFixed(2)}
                                    </p>
                                </div>
                            </div>
                        ))}
                    </div>

                    {/* Order Summary */}
                    <div className="border-t border-gray-200 mt-6 pt-6">
                        <div className="space-y-2">
                            <div className="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span>${order.subtotal?.toFixed(2)}</span>
                            </div>
                            <div className="flex justify-between text-gray-600">
                                <span>Shipping</span>
                                <span>${order.shipping_cost?.toFixed(2) || '0.00'}</span>
                            </div>
                            {order.tax > 0 && (
                                <div className="flex justify-between text-gray-600">
                                    <span>Tax</span>
                                    <span>${order.tax?.toFixed(2)}</span>
                                </div>
                            )}
                            <div className="flex justify-between text-lg font-bold text-gray-900 pt-2 border-t border-gray-200">
                                <span>Total</span>
                                <span>${order.total?.toFixed(2)}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
