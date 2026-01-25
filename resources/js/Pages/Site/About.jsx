import { Head } from '@inertiajs/react';
import AppLayout from '../../Layouts/AppLayout';

export default function About({ testimonials }) {
    return (
        <AppLayout title="About Us">
            <Head title="About Us" />

            {/* Company Introduction */}
            <section className="bg-white rounded-lg shadow-md p-8 mb-8">
                <h2 className="text-3xl font-bold text-gray-900 mb-6">Who We Are</h2>
                <div className="prose prose-lg max-w-none text-gray-600">
                    <p className="mb-4">
                        Welcome to our company. We are dedicated to providing the best products and services to our customers.
                        With years of experience in the industry, we have built a reputation for excellence and customer satisfaction.
                    </p>
                    <p className="mb-4">
                        Our mission is to deliver high-quality products that enhance the lives of our customers while maintaining
                        sustainable and ethical business practices. We believe in innovation, integrity, and continuous improvement.
                    </p>
                    <p>
                        Thank you for choosing us as your trusted partner. We look forward to serving you and exceeding your expectations.
                    </p>
                </div>
            </section>

            {/* Our Values */}
            <section className="bg-white rounded-lg shadow-md p-8 mb-8">
                <h2 className="text-3xl font-bold text-gray-900 mb-6">Our Values</h2>
                <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div className="text-center p-6">
                        <div className="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg className="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 className="text-xl font-semibold text-gray-900 mb-2">Quality</h3>
                        <p className="text-gray-600">
                            We are committed to delivering the highest quality products and services to our customers.
                        </p>
                    </div>

                    <div className="text-center p-6">
                        <div className="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg className="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <h3 className="text-xl font-semibold text-gray-900 mb-2">Customer First</h3>
                        <p className="text-gray-600">
                            Our customers are at the heart of everything we do. Your satisfaction is our priority.
                        </p>
                    </div>

                    <div className="text-center p-6">
                        <div className="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg className="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 className="text-xl font-semibold text-gray-900 mb-2">Innovation</h3>
                        <p className="text-gray-600">
                            We continuously innovate to bring you the best and latest products in the market.
                        </p>
                    </div>
                </div>
            </section>

            {/* Testimonials */}
            {testimonials?.data?.length > 0 && (
                <section className="bg-white rounded-lg shadow-md p-8">
                    <h2 className="text-3xl font-bold text-gray-900 mb-6">What Our Customers Say</h2>
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        {testimonials.data.map((testimonial) => (
                            <div key={testimonial.id} className="border border-gray-200 rounded-lg p-6">
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
                                        {testimonial.position && (
                                            <p className="text-sm text-gray-500">{testimonial.position}</p>
                                        )}
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                </section>
            )}
        </AppLayout>
    );
}
