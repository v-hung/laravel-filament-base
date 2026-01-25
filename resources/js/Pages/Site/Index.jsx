import { Head, Link } from '@inertiajs/react';
import AppLayout from '../../Layouts/AppLayout';

export default function Index({ products, posts, testimonials, partners, cart }) {
    return (
        <AppLayout>
            <Head title="Home" />

            {/* Hero Section */}
            <section className="bg-white mb-8">
                <div className="bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg p-12 text-white">
                    <h1 className="text-4xl font-bold mb-4">Welcome to Our Store</h1>
                    <p className="text-xl mb-6">Discover amazing products at great prices</p>
                    <Link
                        href="/shop"
                        className="inline-block bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition"
                    >
                        Shop Now
                    </Link>
                </div>
            </section>

            {/* Best Selling Products */}
            <section className="mb-12">
                <div className="flex justify-between items-center mb-6">
                    <h2 className="text-2xl font-bold text-gray-900">Best Selling Products</h2>
                    <Link href="/shop" className="text-blue-600 hover:text-blue-800">
                        View All →
                    </Link>
                </div>
                
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    {products?.data?.map((product) => (
                        <div key={product.id} className="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                            <div className="aspect-w-1 aspect-h-1 bg-gray-200">
                                {product.image && (
                                    <img
                                        src={product.image}
                                        alt={product.name}
                                        className="w-full h-48 object-cover"
                                    />
                                )}
                            </div>
                            <div className="p-4">
                                <h3 className="font-semibold text-gray-900 mb-2">{product.name}</h3>
                                <p className="text-gray-600 text-sm mb-3 line-clamp-2">{product.description}</p>
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
            </section>

            {/* Latest Posts */}
            {posts?.data?.length > 0 && (
                <section className="mb-12">
                    <div className="flex justify-between items-center mb-6">
                        <h2 className="text-2xl font-bold text-gray-900">Latest Posts</h2>
                        <Link href="/blogs" className="text-blue-600 hover:text-blue-800">
                            View All →
                        </Link>
                    </div>
                    
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        {posts.data.map((post) => (
                            <div key={post.id} className="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                                {post.image && (
                                    <img
                                        src={post.image}
                                        alt={post.title}
                                        className="w-full h-48 object-cover"
                                    />
                                )}
                                <div className="p-4">
                                    <h3 className="font-semibold text-gray-900 mb-2">{post.title}</h3>
                                    <p className="text-gray-600 text-sm mb-3 line-clamp-2">{post.excerpt}</p>
                                    <Link
                                        href={`/posts/${post.slug}`}
                                        className="text-blue-600 hover:text-blue-800 text-sm font-medium"
                                    >
                                        Read More →
                                    </Link>
                                </div>
                            </div>
                        ))}
                    </div>
                </section>
            )}

            {/* Testimonials */}
            {testimonials?.data?.length > 0 && (
                <section className="mb-12">
                    <h2 className="text-2xl font-bold text-gray-900 mb-6">What Our Customers Say</h2>
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        {testimonials.data.map((testimonial) => (
                            <div key={testimonial.id} className="bg-white rounded-lg shadow-md p-6">
                                <p className="text-gray-600 mb-4 italic">"{testimonial.content}"</p>
                                <div className="flex items-center">
                                    {testimonial.image && (
                                        <img
                                            src={testimonial.image}
                                            alt={testimonial.name}
                                            className="w-12 h-12 rounded-full mr-3"
                                        />
                                    )}
                                    <div>
                                        <p className="font-semibold text-gray-900">{testimonial.name}</p>
                                        <p className="text-sm text-gray-500">{testimonial.position}</p>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                </section>
            )}

            {/* Partners */}
            {partners?.data?.length > 0 && (
                <section>
                    <h2 className="text-2xl font-bold text-gray-900 mb-6">Our Partners</h2>
                    <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                        {partners.data.map((partner) => (
                            <div key={partner.id} className="bg-white rounded-lg shadow-md p-4 flex items-center justify-center">
                                {partner.image ? (
                                    <img
                                        src={partner.image}
                                        alt={partner.name}
                                        className="max-h-16 max-w-full object-contain"
                                    />
                                ) : (
                                    <span className="text-gray-500">{partner.name}</span>
                                )}
                            </div>
                        ))}
                    </div>
                </section>
            )}
        </AppLayout>
    );
}
