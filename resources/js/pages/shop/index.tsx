import ProductCard from '@/components/product/product-card';
import { PopularProductCard } from '@/components/product/popular-product-card';
import AppHead from '@/components/shared/app-head';
import Container from '@/components/shared/container';
import Pagination from '@/components/shared/pagination';
import AppLayout from '@/layouts/app-layout';
import type { Collection, Paginator, Product } from '@/types';
import { useTransValue } from '@/lib/utils/trans-value';
import { useTranslation } from 'react-i18next';
import Section from '@/components/shared/section';
import {
    Carousel,
    CarouselContent,
    CarouselItem,
} from '@/components/ui/carousel';
import CardCategory from '@/components/product/card-category';

type ShopProps = {
    products: Paginator<Product>;
    featured_products: Paginator<Product>;
    collections: Paginator<Collection>;
    active_collection: Collection | null;
};

export default function ShopIndex({
    products,
    featured_products,
    collections,
    active_collection,
}: ShopProps) {
    const { t } = useTranslation();
    const tv = useTransValue();

    return (
        <AppLayout>
            <AppHead title={t('shop.title')} />

            {/* Hero Banner */}
            <Section className="pt-6 lg:pt-10">
                <Container>
                    <div className="relative h-40 overflow-hidden md:h-64 lg:h-80">
                        <img
                            src={
                                active_collection?.image?.url ||
                                '/assets/images/banner/shop.jpg'
                            }
                            alt={t('shop.bannerAlt')}
                            className="h-full w-full object-cover"
                        />
                        <div className="absolute inset-0 flex items-center justify-center bg-black/40 px-5">
                            <h1 className="max-w-2xl text-center text-h-24-bold text-white lg:text-h-56-bold">
                                {active_collection
                                    ? tv(active_collection.title)
                                    : t('shop.bannerTitle')}
                            </h1>
                        </div>
                    </div>
                </Container>
            </Section>

            {/* Categories */}
            {!active_collection && (
                <Section>
                    <Container>
                        {collections.data.length > 0 ? (
                            <Carousel
                                opts={{ align: 'center' }}
                                className="[&>div]:overflow-visible lg:[&>div]:overflow-hidden"
                            >
                                <CarouselContent className="-ml-4 lg:-ml-6">
                                    {collections.data.map((collection) => (
                                        <CarouselItem
                                            key={collection.id}
                                            className="basis-1/3 pl-4 lg:basis-1/5 lg:pl-6"
                                        >
                                            <CardCategory
                                                key={collection.id}
                                                collection={collection}
                                            />
                                        </CarouselItem>
                                    ))}
                                </CarouselContent>
                            </Carousel>
                        ) : (
                            <p className="py-4 text-p-16-regular text-duyang-grey">
                                {t('shop.noCategories')}
                            </p>
                        )}
                    </Container>
                </Section>
            )}

            {/* All Products */}
            <Section>
                <Container>
                    <h2 className="mb-12 text-h-32-bold text-duyang-black lg:mb-16 lg:text-h-40-bold">
                        {t('shop.allProducts')}
                    </h2>

                    {products.data.length > 0 ? (
                        <div className="grid grid-cols-2 gap-6 md:grid-cols-3 lg:grid-cols-4">
                            {products.data.map((product) => (
                                <ProductCard
                                    key={product.id}
                                    product={product}
                                />
                            ))}
                        </div>
                    ) : (
                        <p className="text-center text-p-16-regular text-duyang-grey">
                            {t('shop.noProducts')}
                        </p>
                    )}

                    {/* Pagination */}
                    <Pagination
                        links={products.links}
                        lastPage={products.last_page}
                        className="mt-10"
                    />
                </Container>
            </Section>

            {/* Featured Products */}
            <Section className="mb-10 overflow-hidden lg:mb-16">
                <Container>
                    <div className="mb-12 flex items-center justify-between lg:mb-16">
                        <h2 className="text-h-32-bold text-duyang-black lg:text-h-40-bold">
                            {t('shop.featuredProducts')}
                        </h2>
                    </div>

                    {featured_products.data.length > 0 ? (
                        <Carousel
                            opts={{ align: 'center' }}
                            className="[&>div]:overflow-visible lg:[&>div]:overflow-hidden"
                        >
                            <CarouselContent className="-ml-6 lg:-ml-8">
                                {featured_products.data.map((product) => (
                                    <CarouselItem
                                        key={product.id}
                                        className="max-w-100 basis-[calc(100%-6rem)] pl-6 lg:max-w-max lg:basis-1/3 lg:pl-8"
                                    >
                                        <PopularProductCard
                                            product={product}
                                            version="v2"
                                        />
                                    </CarouselItem>
                                ))}
                            </CarouselContent>
                        </Carousel>
                    ) : (
                        <p className="text-center text-p-16-regular text-duyang-grey">
                            {t('shop.noFeaturedProducts')}
                        </p>
                    )}
                </Container>
            </Section>
        </AppLayout>
    );
}
