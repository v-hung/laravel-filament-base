import { Head, Link, router } from '@inertiajs/react';
import AppLayout from '../../Layouts/AppLayout';
import { useState } from 'react';

export default function Shop({ products, best_selling_products, collections, price_range, cart }) {
    const [filters, setFilters] = useState({
        search: '',
        collection: '',
        min_price: '',
        max_price: '',
        sort: 'newest',
    });

    const handleFilterChange = (key, value) => {
        const newFilters = { ...filters, [key]: value };
        setFilters(newFilters);
        
        // Apply filters via Inertia
        router.get('/shop', newFilters, {
            preserveState: true,
            preserveScroll: true,
        });
    };

    return (
        <AppLayout title="Shop">
            <Head title="Shop" />

            <div className="grid grid-cols-1 lg:grid-cols-4 gap-8">
                {/* Sidebar Filters */}
                <aside className="bg-white rounded-lg shadow-md p-6 h-fit">
                    <h3 className="text-lg font-bold text-gray-900 mb-4">Filters</h3>

                    {/* Search */}
                    <div className="mb-6">
                        <label className="block text-sm font-medium text-gray-700 mb-2">Search</label>
                        <input
                            type="text"
                            value={filters.search}
                            onChange={(e) => handleFilterChange('search', e.target.value)}
                            placeholder="Search products..."
                            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                    </div>

                    {/* Collections */}
                    <div className="mb-6">
                        <label className="block text-sm font-medium text-gray-700 mb-2">Collection</label>
                        <select
                            value={filters.collection}
                            onChange={(e) => handleFilterChange('collection', e.target.value)}
                            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <option value="">All Collections</option>
                            {collections?.map((collection) => (
                                <option key={collection.id} value={collection.id}>
                                    {collection.name}
                                </option>
                            ))}
                        </select>
                    </div>

                    {/* Price Range */}
                    <div className="mb-6">
                        <label className="block text-sm font-medium text-gray-700 mb-2">Price Range</label>
                        <div className="flex gap-2">
                            <input
                                type="number"
                                value={filters.min_price}
                                onChange={(e) => handleFilterChange('min_price', e.target.value)}
                                placeholder="Min"
                                className="w-1/2 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            />
                            <input
                                type="number"
                                value={filters.max_price}
                                onChange={(e) => handleFilterChange('max_price', e.target.value)}
                                placeholder="Max"
                                className="w-1/2 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            />
                        </div>
                        {price_range && (
                            <p className="text-xs text-gray-500 mt-1">
                                Range: ${price_range.min} - ${price_range.max}
                            </p>
                        )}
                    </div>

                    {/* Sort */}
                    <div className="mb-6">
                        <label className="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                        <select
                            value={filters.sort}
                            onChange={(e) => handleFilterChange('sort', e.target.value)}
                            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <option value="newest">Newest</option>
                            <option value="price_asc">Price: Low to High</option>
                            <option value="price_desc">Price: High to Low</option>
                            <option value="name">Name</option>
                        </select>
                    </div>

                    {/* Best Selling */}
                    {best_selling_products?.data?.length > 0 && (
                        <div>
                            <h4 className="text-md font-semibold text-gray-900 mb-3">Best Selling</h4>
                            <div className="space-y-3">
                                {best_selling_products.data.map((product) => (
                                    <Link
                                        key={product.id}
                                        href={`/products/${product.slug}`}
                                        className="flex gap-3 hover:bg-gray-50 p-2 rounded transition"
                                    >
                                        {product.image && (
                                            <img
                                                src={product.image}
                                                alt={product.name}
                                                className="w-16 h-16 object-cover rounded"
                                            />
                                        )}
                                        <div className="flex-1">
                                            <p className="text-sm font-medium text-gray-900 line-clamp-2">
                                                {product.name}
                                            </p>
                                            <p className="text-sm font-bold text-blue-600">${product.price}</p>
                                        </div>
                                    </Link>
                                ))}
                            </div>
                        </div>
                    )}
                </aside>

                {/* Products Grid */}
                <main className="lg:col-span-3">
                    <div className="bg-white rounded-lg shadow-md p-6 mb-6">
                        <div className="flex justify-between items-center">
                            <h2 className="text-xl font-bold text-gray-900">
                                Products {products?.total && `(${products.total})`}
                            </h2>
                        </div>
                    </div>

                    {products?.data?.length > 0 ? (
                        <>
                            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                {products.data.map((product) => (
                                    <div key={product.id} className="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                                        <div className="aspect-w-1 aspect-h-1 bg-gray-200">
                                            {product.image && (
                                                <img
                                                    src={product.image}
                                                    alt={product.name}
                                                    className="w-full h-56 object-cover"
                                                />
                                            )}
                                        </div>
                                        <div className="p-4">
                                            <h3 className="font-semibold text-gray-900 mb-2">{product.name}</h3>
                                            <p className="text-gray-600 text-sm mb-3 line-clamp-2">
                                                {product.description}
                                            </p>
                                            <div className="flex justify-between items-center">
                                                <span className="text-lg font-bold text-blue-600">
                                                    ${product.price}
                                                </span>
                                                <Link
                                                    href={`/products/${product.slug}`}
                                                    className="text-sm bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition"
                                                >
                                                    View Details
                                                </Link>
                                            </div>
                                        </div>
                                    </div>
                                ))}
                            </div>

                            {/* Pagination */}
                            {products.links && (
                                <div className="mt-8 flex justify-center">
                                    <div className="flex gap-2">
                                        {products.links.map((link, index) => (
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
                            <p className="text-gray-500 text-lg">No products found</p>
                        </div>
                    )}
                </main>
            </div>
        </AppLayout>
    );
}
