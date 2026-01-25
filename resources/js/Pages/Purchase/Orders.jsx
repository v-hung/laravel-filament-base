import { Head, Link } from '@inertiajs/react';
import AppLayout from '../../Layouts/AppLayout';

export default function Orders({ orders }) {
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
        <AppLayout title="My Orders">
            <Head title="Orders" />

            {orders?.data?.length > 0 ? (
                <>
                    <div className="space-y-4">
                        {orders.data.map((order) => (
                            <div key={order.id} className="bg-white rounded-lg shadow-md overflow-hidden">
                                <div className="p-6">
                                    <div className="flex items-center justify-between mb-4">
                                        <div>
                                            <h3 className="text-lg font-semibold text-gray-900">
                                                Order #{order.code}
                                            </h3>
                                            <p className="text-sm text-gray-500 mt-1">
                                                Placed on {order.created_at}
                                            </p>
                                        </div>
                                        <div className="text-right">
                                            <span className={`inline-block px-3 py-1 rounded-full text-xs font-semibold ${getStatusBadge(order.status)}`}>
                                                {order.status}
                                            </span>
                                        </div>
                                    </div>

                                    <div className="border-t border-gray-200 pt-4">
                                        <div className="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                            <div>
                                                <p className="text-sm text-gray-500">Total Amount</p>
                                                <p className="text-lg font-semibold text-gray-900">
                                                    ${order.total?.toFixed(2)}
                                                </p>
                                            </div>
                                            <div>
                                                <p className="text-sm text-gray-500">Payment Status</p>
                                                <span className={`inline-block px-2 py-1 rounded text-xs font-semibold ${getPaymentStatusBadge(order.payment_status)}`}>
                                                    {order.payment_status}
                                                </span>
                                            </div>
                                            <div>
                                                <p className="text-sm text-gray-500">Payment Method</p>
                                                <p className="text-sm font-medium text-gray-900">
                                                    {order.payment_method}
                                                </p>
                                            </div>
                                        </div>

                                        {/* Order Items Preview */}
                                        {order.items && order.items.length > 0 && (
                                            <div className="mb-4">
                                                <p className="text-sm text-gray-500 mb-2">Items ({order.items.length})</p>
                                                <div className="flex gap-2 overflow-x-auto">
                                                    {order.items.slice(0, 4).map((item, index) => (
                                                        <div key={index} className="flex-shrink-0">
                                                            {item.product?.image ? (
                                                                <img
                                                                    src={item.product.image}
                                                                    alt={item.product.name}
                                                                    className="w-16 h-16 object-cover rounded"
                                                                />
                                                            ) : (
                                                                <div className="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                                                    <span className="text-xs text-gray-400">No img</span>
                                                                </div>
                                                            )}
                                                        </div>
                                                    ))}
                                                    {order.items.length > 4 && (
                                                        <div className="flex-shrink-0 w-16 h-16 bg-gray-100 rounded flex items-center justify-center">
                                                            <span className="text-sm font-medium text-gray-600">
                                                                +{order.items.length - 4}
                                                            </span>
                                                        </div>
                                                    )}
                                                </div>
                                            </div>
                                        )}

                                        <div className="flex justify-end">
                                            <Link
                                                href={route('orders.show', order.code)}
                                                className="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition"
                                            >
                                                View Details
                                                <svg className="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5l7 7-7 7" />
                                                </svg>
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>

                    {/* Pagination */}
                    {orders.links && (
                        <div className="mt-8 flex justify-center">
                            <div className="flex gap-2">
                                {orders.links.map((link, index) => (
                                    <Link
                                        key={index}
                                        href={link.url || '#'}
                                        className={`px-4 py-2 rounded ${
                                            link.active
                                                ? 'bg-blue-600 text-white'
                                                : 'bg-white text-gray-700 hover:bg-gray-100'
                                        } ${!link.url ? 'opacity-50 cursor-not-allowed' : ''}`}
                                        dangerouslySetInnerHTML={{ __html: link.label }}
                                    />
                                ))}
                            </div>
                        </div>
                    )}
                </>
            ) : (
                <div className="bg-white rounded-lg shadow-md p-12 text-center">
                    <svg className="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <h2 className="text-2xl font-bold text-gray-900 mb-2">No Orders Yet</h2>
                    <p className="text-gray-600 mb-6">You haven't placed any orders yet.</p>
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
