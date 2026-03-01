import ProductCard from '@/components/product/product-card';
import { PopularProductCard } from '@/components/product/popular-product-card';
import AppHead from '@/components/shared/app-head';
import Container from '@/components/shared/container';
import Pagination from '@/components/shared/pagination';
import AppLayout from '@/layouts/app-layout';
import { detail } from '@/routes/products';
import type { Paginator, Product } from '@/types';
import { Link } from '@inertiajs/react';
import { transValue } from '@/lib/utils/trans-value';

type ShopProps = {
    products: Paginator<Product>;
    featured_products: Paginator<Product>;
};

export default function ShopIndex({ products, featured_products }: ShopProps) {
    return (
        <AppLayout>
            <AppHead title="Shop" />

            {/* Hero Banner */}
            <section className="relative h-40 overflow-hidden md:h-64 lg:h-80">
                <img
                    src="/images/shop-banner.jpg"
                    alt="Khám phá tất cả sản phẩm"
                    className="h-full w-full object-cover"
                />
                <div className="absolute inset-0 flex items-center justify-center bg-black/40 px-5">
                    <h1 className="max-w-2xl text-center text-h-24-bold text-white lg:text-h-56-bold">
                        Khám phá tất cả sản phẩm
                    </h1>
                </div>
            </section>

            {/* All Products */}
            <section className="py-14 lg:py-20">
                <Container>
                    <h2 className="text-h-32-bold text-duyang-black lg:text-h-40-bold">
                        Khám Phá Tất Cả Các Sản Phẩm Móc
                    </h2>

                    <div className="mt-10 grid grid-cols-2 gap-6 md:grid-cols-3 lg:grid-cols-4">
                        {products.data.map((product) => (
                            <Link
                                key={product.id}
                                href={detail.url(transValue(product.slug))}
                            >
                                <ProductCard product={product} />
                            </Link>
                        ))}
                    </div>

                    {/* Pagination */}
                    <Pagination
                        links={products.links}
                        lastPage={products.last_page}
                        className="mt-10"
                    />
                </Container>
            </section>

            {/* Featured Products */}
            <section className="surface-page pb-14 lg:pb-20">
                <Container>
                    <h2 className="lg:text-h-40 text-h-32-bold text-duyang-black">
                        Sản Phẩm Được Khách Hàng Yêu Thích Nhất
                    </h2>

                    <div className="mt-10 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                        {featured_products.data.map((product) => (
                            <Link
                                key={product.id}
                                href={detail.url(transValue(product.slug))}
                            >
                                <PopularProductCard
                                    product={product}
                                    version="v2"
                                />
                            </Link>
                        ))}
                    </div>
                </Container>
            </section>
        </AppLayout>
    );
}
