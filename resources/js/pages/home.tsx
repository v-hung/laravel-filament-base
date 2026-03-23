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
import type { Collection, Media, Paginator, Post, Product } from '@/types';
import { useTransValue, type Translatable } from '@/lib/utils/trans-value';

type HomeSections = {
    banner?: {
        image?: Media;
    };
    about?: {
        image?: Media;
        label?: string;
        title?: string;
        description?: string;
        features?: { image?: Media; label?: string }[];
    };
    featured?: {
        title?: string;
        description?: string;
    };
    banner2?: {
        image?: Media;
        title?: string;
        description?: string;
    };
    collections?: {
        title?: string;
        description?: string;
    };
    cta?: {
        image?: Media;
        title?: string;
        description?: string;
    };
    inspiration?: {
        title?: string;
        images?: { image?: Media }[];
    };
};

type HomeProps = {
    latestProducts: Paginator<Product>;
    pages: Paginator<Post>;
    collections: Paginator<Collection>;
    sections?: Translatable<HomeSections>;
};

export default function Home({
    latestProducts,
    pages,
    collections,
    sections,
}: HomeProps) {
    const tv = useTransValue();
    const sectionsTrans = tv(sections);

    return (
        <AppLayout>
            <AppHead />

            <BannerSection data={sectionsTrans?.banner} />
            <AboutSection data={sectionsTrans?.about} />
            <FeaturedSection
                data={sectionsTrans?.featured}
                products={latestProducts}
            />
            <Banner2Section data={sectionsTrans?.banner2} />
            <CollectionsSection
                data={sectionsTrans?.collections}
                collections={collections}
            />
            <CtaSection data={sectionsTrans?.cta} />
            <InspirationSection data={sectionsTrans?.inspiration} />

            <Section className="mb-10 lg:mb-16">
                <Container>
                    <RelatedPosts posts={pages} />
                </Container>
            </Section>
        </AppLayout>
    );
}
