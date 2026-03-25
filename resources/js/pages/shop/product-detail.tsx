import CardRelatedProduct from '@/components/product/card-related-product';
import AppHead from '@/components/shared/app-head';
import Container from '@/components/shared/container';
import Section from '@/components/shared/section';
import {
    Carousel,
    CarouselContent,
    CarouselItem,
} from '@/components/ui/carousel';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
import AppLayout from '@/layouts/app-layout';
import { useTransValue } from '@/lib/utils/trans-value';
import type { Paginator, Product } from '@/types';
import { useState } from 'react';
import { useTranslation } from 'react-i18next';

type ProductDetailProps = {
    product: Product;
    related_products: Paginator<Product>;
};

const ProductDetail = ({ product, related_products }: ProductDetailProps) => {
    const [activeImage, setActiveImage] = useState(0);
    const { t } = useTranslation();
    const tv = useTransValue();
    const specifications = tv(product.specifications);

    return (
        <AppLayout>
            <AppHead title={tv(product.name)} />

            {/* Product Images and Info */}
            <Section className="pt-6 lg:pt-10">
                <Container>
                    <div className="grid grid-cols-1 gap-10 lg:grid-cols-2 lg:gap-16">
                        {/* Images */}
                        <div className="flex flex-col gap-4">
                            <div className="aspect-square overflow-hidden rounded bg-duyang-white">
                                <img
                                    src={product.images?.[activeImage].url}
                                    alt={
                                        product.images?.[activeImage]
                                            ?.custom_properties?.alt_text ??
                                        tv(product.name)
                                    }
                                    className="h-full w-full object-cover"
                                />
                            </div>
                            <Carousel opts={{ align: 'start' }}>
                                <CarouselContent className="-ml-2 lg:-ml-3">
                                    {product.images?.map((image, i) => (
                                        <CarouselItem
                                            key={i}
                                            className="basis-1/3 pl-2 lg:basis-1/4 lg:pl-3"
                                        >
                                            <button
                                                key={i}
                                                onClick={() =>
                                                    setActiveImage(i)
                                                }
                                                className={`aspect-square overflow-hidden rounded border-2 bg-duyang-white transition-all ${
                                                    activeImage === i
                                                        ? ''
                                                        : 'border-transparent'
                                                }`}
                                            >
                                                <img
                                                    src={
                                                        image?.conversions?.[
                                                            'thumb'
                                                        ]?.url ?? image?.url
                                                    }
                                                    alt={
                                                        image?.custom_properties
                                                            ?.alt_text ??
                                                        tv(product.name)
                                                    }
                                                    className="h-full w-full object-cover"
                                                />
                                            </button>
                                        </CarouselItem>
                                    ))}
                                </CarouselContent>
                            </Carousel>
                        </div>

                        {/* Info */}
                        <div className="flex flex-col gap-6">
                            <h1 className="text-h-24-bold text-duyang-black lg:text-h-32-bold">
                                {tv(product.name)}
                            </h1>

                            <p className="text-p-16-regular text-duyang-grey">
                                {tv(product.description) ||
                                    t('shop.descriptionUpdating')}
                            </p>

                            {/* Tabs */}
                            <Tabs defaultValue="specs">
                                <TabsList
                                    variant="line"
                                    className="h-14.5! w-full overflow-x-auto overflow-y-hidden border-b border-duyang-grey/50 px-0 whitespace-nowrap"
                                >
                                    <TabsTrigger
                                        value="specs"
                                        className="px-4 py-6 text-h-20-semibold"
                                    >
                                        {t('shop.technicalSpecs')}
                                    </TabsTrigger>
                                    <TabsTrigger
                                        value="features"
                                        className="px-4 py-6 text-h-20-semibold"
                                    >
                                        {t('shop.features')}
                                    </TabsTrigger>
                                    <TabsTrigger
                                        value="policy"
                                        className="px-4 py-6 text-h-20-semibold"
                                    >
                                        {t('shop.policies')}
                                    </TabsTrigger>
                                </TabsList>

                                <TabsContent value="specs" className="mt-3">
                                    {specifications?.length ? (
                                        <table className="w-full">
                                            <tbody>
                                                {specifications.map(
                                                    (row, i) => (
                                                        <tr key={i}>
                                                            <td className="w-1/3 py-3 text-p-14-semibold text-duyang-black">
                                                                {row.key}
                                                            </td>
                                                            <td className="py-3 text-p-14-regular text-duyang-grey">
                                                                {row.value}
                                                            </td>
                                                        </tr>
                                                    ),
                                                )}
                                            </tbody>
                                        </table>
                                    ) : (
                                        <p className="text-p-14-regular text-duyang-grey">
                                            {t('shop.technicalSpecsUpdating')}
                                        </p>
                                    )}
                                </TabsContent>

                                <TabsContent value="features" className="mt-6">
                                    <p className="text-p-14-regular text-duyang-grey">
                                        {t('shop.featuresInfoUpdating')}
                                    </p>
                                </TabsContent>

                                <TabsContent value="policy" className="mt-6">
                                    <p className="text-p-14-regular text-duyang-grey">
                                        {t('shop.policiesUpdating')}
                                    </p>
                                </TabsContent>
                            </Tabs>
                        </div>
                    </div>
                </Container>
            </Section>

            {/* Related Products - Placeholder for future implementation */}
            <Section className="overflow-hidden">
                <Container>
                    <div className="mb-12 flex items-center justify-between lg:mb-16">
                        <h2 className="text-h-32-bold text-duyang-black lg:text-h-40-bold">
                            {t('shop.youMayLike')}
                        </h2>
                    </div>

                    {related_products.data.length > 0 ? (
                        <Carousel
                            opts={{ align: 'center' }}
                            className="[&>div]:overflow-visible lg:[&>div]:overflow-hidden"
                        >
                            <CarouselContent className="-ml-6 lg:-ml-8">
                                {related_products.data.map((product) => (
                                    <CarouselItem
                                        key={product.id}
                                        className="max-w-100 basis-[calc(100%-6rem)] pl-6 lg:max-w-max lg:basis-1/3 lg:pl-8"
                                    >
                                        <CardRelatedProduct product={product} />
                                    </CarouselItem>
                                ))}
                            </CarouselContent>
                        </Carousel>
                    ) : (
                        <p className="py-4 text-p-16-regular text-duyang-grey">
                            {t('shop.noRelatedProducts')}
                        </p>
                    )}
                </Container>
            </Section>
        </AppLayout>
    );
};

export default ProductDetail;
