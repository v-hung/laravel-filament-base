import { Head, Link } from '@inertiajs/react';
import AppLayout from '../../Layouts/AppLayout';

export default function Posts({ posts }) {
    return (
        <AppLayout title="Blog Posts">
            <Head title="Blogs" />

            <div className="bg-white rounded-lg shadow-md p-6 mb-8">
                <h2 className="text-3xl font-bold text-gray-900 mb-2">Latest Blog Posts</h2>
                <p className="text-gray-600">
                    Discover our latest articles, news, and insights
                </p>
            </div>

            {posts?.data?.length > 0 ? (
                <>
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        {posts.data.map((post) => (
                            <article key={post.id} className="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                                {post.image && (
                                    <img
                                        src={post.image}
                                        alt={post.title}
                                        className="w-full h-56 object-cover"
                                    />
                                )}
                                <div className="p-6">
                                    {post.category && (
                                        <span className="inline-block px-3 py-1 bg-blue-100 text-blue-600 text-xs font-semibold rounded-full mb-3">
                                            {post.category.name}
                                        </span>
                                    )}
                                    
                                    <h3 className="text-xl font-bold text-gray-900 mb-3 hover:text-blue-600">
                                        <Link href={`/posts/${post.slug}`}>
                                            {post.title}
                                        </Link>
                                    </h3>
                                    
                                    <p className="text-gray-600 text-sm mb-4 line-clamp-3">
                                        {post.excerpt || post.content}
                                    </p>
                                    
                                    <div className="flex items-center justify-between text-sm text-gray-500">
                                        <span>{post.published_at || post.created_at}</span>
                                        <Link
                                            href={`/posts/${post.slug}`}
                                            className="text-blue-600 hover:text-blue-800 font-medium"
                                        >
                                            Read More →
                                        </Link>
                                    </div>
                                </div>
                            </article>
                        ))}
                    </div>

                    {/* Pagination */}
                    {posts.links && (
                        <div className="mt-12 flex justify-center">
                            <div className="flex gap-2">
                                {posts.links.map((link, index) => (
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
                    <p className="text-gray-500 text-lg">No posts found</p>
                </div>
            )}
        </AppLayout>
    );
}
