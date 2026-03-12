import AppHead from '@/components/shared/app-head';
import Container from '@/components/shared/container';
import Section from '@/components/shared/section';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
import AppLayout from '@/layouts/app-layout';
import { useTransValue } from '@/lib/utils/trans-value';
import type { Product } from '@/types';
import { useState } from 'react';

type ProductDetailProps = {
    product: Product;
};

const ProductDetail = ({ product }: ProductDetailProps) => {
    const [activeImage, setActiveImage] = useState(0);
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
                            <div className="aspect-square overflow-hidden bg-duyang-white">
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
                            <div className="grid grid-cols-4 gap-3">
                                {product.images?.map((image, i) => (
                                    <button
                                        key={i}
                                        onClick={() => setActiveImage(i)}
                                        className={`aspect-square overflow-hidden bg-duyang-white outline-2 outline-offset-2 transition-all ${
                                            activeImage === i
                                                ? 'outline-duyang-black'
                                                : 'outline-transparent'
                                        }`}
                                    >
                                        <img
                                            src={
                                                image?.conversions?.['thumb']
                                                    ?.url ?? image?.url
                                            }
                                            alt={
                                                image?.custom_properties
                                                    ?.alt_text ??
                                                tv(product.name)
                                            }
                                            className="h-full w-full object-cover"
                                        />
                                    </button>
                                ))}
                            </div>
                        </div>

                        {/* Info */}
                        <div className="flex flex-col gap-6">
                            <h1 className="text-h-24-bold text-duyang-black lg:text-h-32-bold">
                                {tv(product.name)}
                            </h1>

                            <p className="text-p-16-regular text-duyang-grey">
                                {tv(product.description) ||
                                    'Không có mô tả nào cho sản phẩm này.'}
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
                                        Thông Số Kỹ Thuật
                                    </TabsTrigger>
                                    <TabsTrigger
                                        value="features"
                                        className="px-4 py-6 text-h-20-semibold"
                                    >
                                        Đặc trưng
                                    </TabsTrigger>
                                    <TabsTrigger
                                        value="policy"
                                        className="px-4 py-6 text-h-20-semibold"
                                    >
                                        Chính sách
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
                                            Thông số kỹ thuật sẽ được cập nhập
                                        </p>
                                    )}
                                </TabsContent>

                                <TabsContent value="features" className="mt-6">
                                    <p className="text-p-14-regular text-duyang-grey">
                                        Thông tin đặc trưng sản phẩm sẽ được cập
                                        nhật.
                                    </p>
                                </TabsContent>

                                <TabsContent value="policy" className="mt-6">
                                    <p className="text-p-14-regular text-duyang-grey">
                                        Chính sách đổi trả và bảo hành sẽ được
                                        cập nhật.
                                    </p>
                                </TabsContent>
                            </Tabs>
                        </div>
                    </div>
                </Container>
            </Section>
        </AppLayout>
    );
};

export default ProductDetail;
