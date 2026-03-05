import ProductCard from '@/components/product/product-card';
import { PopularProductCard } from '@/components/product/popular-product-card';
import AppHead from '@/components/shared/app-head';
import Container from '@/components/shared/container';
import Pagination from '@/components/shared/pagination';
import AppLayout from '@/layouts/app-layout';
import { detail } from '@/routes/products';
import type { Paginator, Product } from '@/types';
import { Link } from '@inertiajs/react';
import { useTransValue } from '@/lib/utils/trans-value';
import { useTranslation } from 'react-i18next';

type ShopProps = {
    products: Paginator<Product>;
    featured_products: Paginator<Product>;
};

export default function ShopIndex({ products, featured_products }: ShopProps) {
    const { t } = useTranslation();
    const tv = useTransValue();

    return (
        <AppLayout>
            <AppHead title={t('shop.title')} />

            {/* Hero Banner */}
            <section className="relative h-40 overflow-hidden md:h-64 lg:h-80">
                <img
                    src="/images/shop-banner.jpg"
                    alt={t('shop.bannerAlt')}
                    className="h-full w-full object-cover"
                />
                <div className="absolute inset-0 flex items-center justify-center bg-black/40 px-5">
                    <h1 className="max-w-2xl text-center text-h-24-bold text-white lg:text-h-56-bold">
                        {t('shop.bannerTitle')}
                    </h1>
                </div>
            </section>

            {/* All Products */}
            <section className="py-14 lg:py-20">
                <Container>
                    <h2 className="text-h-32-bold text-duyang-black lg:text-h-40-bold">
                        {t('shop.allProducts')}
                    </h2>

                    <div className="mt-10 grid grid-cols-2 gap-6 md:grid-cols-3 lg:grid-cols-4">
                        {products.data.map((product) => (
                            <Link
                                key={product.id}
                                href={detail.url(
                                    tv(product.slug) || '#',
                                )}
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
                        {t('shop.featuredProducts')}
                    </h2>

                    <div className="mt-10 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                        {featured_products.data.map((product) => (
                            <Link
                                key={product.id}
                                href={detail.url(
                                    tv(product.slug) || '#',
                                )}
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
