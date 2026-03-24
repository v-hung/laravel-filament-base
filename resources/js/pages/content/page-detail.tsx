import RelatedPages from '@/components/page/related-pages';
import RelatedPosts from '@/components/post/related-posts';
import Container from '@/components/shared/container';
import HeroSection from '@/components/shared/hero-section';
import Section from '@/components/shared/section';
import AppLayout from '@/layouts/app-layout';
import { useFormat } from '@/lib/utils/date';
import { useTransValue } from '@/lib/utils/trans-value';
import type { Paginator } from '@/types';
import type { Page } from '@/types/models/page';
import { useMemo } from 'react';

type PageDetailProps = {
    page: Page;
    other_pages: Paginator<Page>;
};

const PageDetail = ({ page, other_pages }: PageDetailProps) => {
    const { format } = useFormat();
    const tv = useTransValue();

    const content = useMemo(() => {
        const html = tv(page.content);
        const hasContent = /[^\s<>]/.test(html);
        return hasContent ? html : null;
    }, [page.content, tv]);

    return (
        <AppLayout>
            {/* Hero Section */}
            <HeroSection
                title={tv(page.title)}
                date={page.created_at}
                image={page.image?.url}
            />

            {/* Page Content Section */}
            <Section className="py-8 lg:py-14">
                <Container>
                    {content ? (
                        <div
                            className="flex flex-col gap-6 text-p-16-regular text-duyang-grey"
                            dangerouslySetInnerHTML={{ __html: content }}
                        ></div>
                    ) : (
                        <p className="text-center text-duyang-grey">
                            Không có nội dung
                        </p>
                    )}
                </Container>
            </Section>

            {/* Related Pages Section */}
            <Container>
                <RelatedPages
                    pages={other_pages}
                    className="border-t py-10 lg:py-16"
                />
            </Container>
        </AppLayout>
    );
};

export default PageDetail;
