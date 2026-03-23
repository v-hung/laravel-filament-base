import RelatedPosts from '@/components/post/related-posts';
import AboutSection from '@/components/home/sections/AboutSection';
import Banner2Section from '@/components/home/sections/Banner2Section';
import BannerSection from '@/components/home/sections/BannerSection';
import CollectionsSection from '@/components/home/sections/CollectionsSection';
import CtaSection from '@/components/home/sections/CtaSection';
import FeaturedSection from '@/components/home/sections/FeaturedSection';
import InspirationSection from '@/components/home/sections/InspirationSection';
import AppHead from '@/components/shared/app-head';
import Container from '@/components/shared/container';
import Section from '@/components/shared/section';
import AppLayout from '@/layouts/app-layout';
import type { Collection, Paginator, Post, Product } from '@/types';

type HomeProps = {
    latestProducts: Paginator<Product>;
    pages: Paginator<Post>;
    collections: Paginator<Collection>;
    sections?: {
        banner?: Record<string, any>;
        about?: Record<string, any>;
        featured?: Record<string, any>;
        banner2?: Record<string, any>;
        collections?: Record<string, any>;
        cta?: Record<string, any>;
        inspiration?: Record<string, any>;
    };
};

export default function Home({
    latestProducts,
    pages,
    collections,
    sections,
}: HomeProps) {
    return (
        <AppLayout>
            <AppHead />

            <BannerSection data={sections?.banner} />
            <AboutSection data={sections?.about} />
            <FeaturedSection
                data={sections?.featured}
                products={latestProducts}
            />
            <Banner2Section data={sections?.banner2} />
            <CollectionsSection
                data={sections?.collections}
                collections={collections}
            />
            <CtaSection data={sections?.cta} />
            <InspirationSection data={sections?.inspiration} />

            <Section className="mb-10 lg:mb-16">
                <Container>
                    <RelatedPosts posts={pages} />
                </Container>
            </Section>
        </AppLayout>
    );
}
