import AboutAndValues from '@/components/home/about-and-values';
import InspirationGallery from '@/components/shared/inspiration-gallery';
import RelatedPosts from '@/components/post/related-posts';
import ItemListCategory from '@/components/product/item-list-category';
import LatestProductCard from '@/components/product/latest-product-card';
import AppHead from '@/components/shared/app-head';
import Container from '@/components/shared/container';
import DuButton from '@/components/shared/du-button';
import Section from '@/components/shared/section';
import AppLayout from '@/layouts/app-layout';
import { partner, shop } from '@/routes';
import type { Collection, Paginator, Post, Product } from '@/types';
import { Link } from '@inertiajs/react';

type HomeProps = {
    latestProducts: Paginator<Product>;
    posts: Paginator<Post>;
    collections: Paginator<Collection>;
};

export default function Home({
    latestProducts,
    posts,
    collections,
}: HomeProps) {
    const inspirationImages = [
        '/assets/images/home/inspiration-1.jpg',
        '/assets/images/home/inspiration-2.jpg',
        '/assets/images/home/inspiration-3.jpg',
        '/assets/images/home/inspiration-4.jpg',
        '/assets/images/home/inspiration-5.jpg',
        '/assets/images/home/inspiration-6.jpg',
        '/assets/images/home/inspiration-7.jpg',
        '/assets/images/home/inspiration-8.jpg',
    ];

    return (
        <AppLayout>
            <AppHead />

            {/* Banner */}
            <div className="relative h-[calc(100vh-var(--header-height))] w-full">
                <img
                    src="/assets/images/banner/home.jpg"
                    className="absolute top-0 left-0 h-full w-full object-cover"
                />

                <Container className="relative"></Container>
            </div>

            {/* About & Values */}
            <Section className="bg-duyang-cream">
                <Container>
                    <AboutAndValues />
                </Container>
            </Section>

            {/* Featured Products */}
            <Section>
                <Container>
                    <div className="flex flex-col gap-6 lg:flex-row lg:gap-10">
                        <div className="flex flex-none flex-col items-start gap-6 lg:w-1/4">
                            <h3 className="text-h-32-bold lg:text-h-40-bold">
                                Sản Phẩm Mới Nhất Từ Nhà Máy
                            </h3>
                            <p className="mt-auto line-clamp-3 text-p-14-regular text-duyang-grey lg:line-clamp-none lg:text-p-16-regular">
                                {`Chúng tôi liên tục nghiên cứu, cải tiến và đưa vào sản xuất các dòng sản phẩm mới nhằm đáp ứng nhu cầu đa dạng của thị trường. Với hệ thống máy móc hiện đại và quy trình kiểm soát chất lượng chặt chẽ, mỗi sản phẩm đều đạt độ hoàn thiện cao, bền bỉ và phù hợp cho sử dụng thực tế cũng như sản xuất số lượng lớn.
Các dòng sản phẩm từ móc treo gỗ tiêu chuẩn, móc theo thiết kế riêng đến các chi tiết gia công gỗ – nhựa kỹ thuật đều được sản xuất đồng bộ, đảm bảo tính ổn định và độ chính xác trước khi xuất xưởng.`}
                            </p>

                            <DuButton>
                                <Link href={shop().url}>View All</Link>
                            </DuButton>
                        </div>

                        <div className="min-w-0 grow">
                            <div className="grid grid-cols-2 gap-4 lg:grid-cols-3">
                                {latestProducts.data.map((product) => (
                                    <LatestProductCard
                                        key={product.id}
                                        product={product}
                                    />
                                ))}
                            </div>
                        </div>
                    </div>
                </Container>
            </Section>

            {/* Banner */}
            <Section>
                <Container>
                    <div className="relative bg-[url('/assets/images/home/home-banner.jpg')] bg-cover">
                        <div className="absolute inset-0 bg-black/50 from-black/60 via-black/20 to-transparent lg:bg-transparent lg:bg-linear-to-r"></div>
                        <div className="relative w-full p-6 text-white lg:w-1/2 lg:p-10">
                            <h3 className="text-h-32-bold drop-shadow lg:text-h-56-bold">
                                Năng Lực Sản Xuất Quy Mô Lớn
                            </h3>
                            <p className="pt-10 text-p-14-regular drop-shadow lg:text-p-16-regular">
                                Chúng tôi vận hành hệ thống sản xuất hiện đại
                                với khả năng đáp ứng đơn hàng số lượng lớn cho
                                thị trường trong nước và xuất khẩu. Với quy
                                trình sản xuất khép kín, kiểm soát chất lượng
                                chặt chẽ và đội ngũ kỹ thuật giàu kinh nghiệm,
                                chúng tôi đảm bảo mỗi sản phẩm đạt tiêu chuẩn
                                cao về độ bền, tính chính xác và độ hoàn thiện.
                            </p>
                        </div>
                    </div>
                </Container>
            </Section>

            {/* Collections */}
            <Section>
                <Container>
                    <div className="flex flex-col gap-6 lg:flex-row lg:gap-20">
                        <div className="flex flex-none flex-col items-start gap-6 lg:w-1/4">
                            <h3 className="text-h-32-bold lg:text-h-40-bold">
                                Danh Mục Sản Phẩm Theo Vật Liệu
                            </h3>
                            <p className="line-clamp-3 text-p-14-regular text-duyang-grey lg:line-clamp-none lg:text-p-16-regular">
                                {`Khám phá các dòng sản phẩm được phân loại theo vật liệu sản xuất, giúp khách hàng dễ dàng lựa chọn giải pháp phù hợp với nhu cầu sử dụng và tiêu chuẩn kỹ thuật. Chúng tôi cung cấp đa dạng sản phẩm từ kim loại, nhựa đến gỗ, đáp ứng từ sản phẩm tiêu chuẩn đến gia công theo yêu cầu (OEM / ODM).`}
                            </p>
                        </div>

                        <div className="min-w-0 grow">
                            <div className="flex flex-col gap-8">
                                {collections.data.map((item) => (
                                    <ItemListCategory
                                        key={item.id}
                                        collection={item}
                                        reverse={item.id % 2 === 0}
                                    />
                                ))}
                            </div>
                        </div>
                    </div>
                </Container>
            </Section>

            {/* CTA */}
            <Section className="relative bg-[url('/assets/images/home/home-cta.jpg')] bg-cover">
                <div className="absolute inset-0 bg-black/50 from-black/60 via-black/20 to-transparent lg:bg-transparent lg:bg-linear-to-r"></div>
                <Container className="relative">
                    <div className="w-full text-white lg:w-1/2">
                        <h3 className="text-h-32-bold drop-shadow lg:text-h-56-bold">
                            Vì Sao Chọn Nhà Máy Của Chúng Tôi
                        </h3>
                        <p className="pt-6 text-p-14-regular drop-shadow lg:text-p-16-regular">
                            Chúng tôi cung cấp giải pháp sản xuất ổn định, chất
                            lượng cao và lâu dài cho đối tác trong và ngoài
                            nước.
                        </p>

                        <DuButton color="white" className="mt-16 lg:mt-26">
                            <Link href={partner().url}>Xem ngay</Link>
                        </DuButton>
                    </div>
                </Container>
            </Section>

            {/* Decoration Inspiration */}
            <Section>
                <Container>
                    <div className="mb-12 flex items-center justify-between lg:mb-16">
                        <h2 className="text-h-32-bold text-duyang-black lg:text-h-40-bold">
                            Cảm Hứng Trang Trí
                        </h2>
                    </div>

                    <InspirationGallery images={inspirationImages} />
                </Container>
            </Section>

            {/* Related Posts */}
            <Section className="mb-10 lg:mb-16">
                <Container>
                    <RelatedPosts posts={posts} />
                </Container>
            </Section>
        </AppLayout>
    );
}
