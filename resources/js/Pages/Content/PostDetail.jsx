import { Head, Link } from '@inertiajs/react';
import AppLayout from '../../Layouts/AppLayout';

export default function PostDetail({ post }) {
    return (
        <AppLayout>
            <Head title={post.title} />

            <article className="bg-white rounded-lg shadow-md overflow-hidden">
                {post.image && (
                    <img
                        src={post.image}
                        alt={post.title}
                        className="w-full h-96 object-cover"
                    />
                )}

                <div className="p-8 lg:p-12">
                    <div className="max-w-3xl mx-auto">
                        {/* Meta Information */}
                        <div className="flex items-center gap-4 mb-6">
                            {post.category && (
                                <span className="inline-block px-3 py-1 bg-blue-100 text-blue-600 text-sm font-semibold rounded-full">
                                    {post.category.name}
                                </span>
                            )}
                            <span className="text-gray-500 text-sm">
                                {post.published_at || post.created_at}
                            </span>
                        </div>

                        {/* Title */}
                        <h1 className="text-4xl font-bold text-gray-900 mb-6">
                            {post.title}
                        </h1>

                        {/* Excerpt */}
                        {post.excerpt && (
                            <p className="text-xl text-gray-600 mb-8 italic border-l-4 border-blue-600 pl-4">
                                {post.excerpt}
                            </p>
                        )}

                        {/* Content */}
                        <div 
                            className="prose prose-lg max-w-none"
                            dangerouslySetInnerHTML={{ __html: post.content }}
                        />

                        {/* Back Link */}
                        <div className="mt-12 pt-8 border-t border-gray-200">
                            <Link
                                href="/blogs"
                                className="inline-flex items-center text-blue-600 hover:text-blue-800"
                            >
                                <svg className="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 19l-7-7 7-7" />
                                </svg>
                                Back to Blog
                            </Link>
                        </div>
                    </div>
                </div>
            </article>
        </AppLayout>
    );
}
