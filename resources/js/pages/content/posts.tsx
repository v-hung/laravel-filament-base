import PageItem from '@/components/page/page-item';
import PostItem from '@/components/post/post-item';
import Container from '@/components/shared/container';
import HeroSection from '@/components/shared/hero-section';
import Pagination from '@/components/shared/pagination';
import Section from '@/components/shared/section';
import AppLayout from '@/layouts/app-layout';
import { useTransValue, type Translatable } from '@/lib/utils/trans-value';
import type { Media, Paginator, Post } from '@/types';
import type { Page } from '@/types/models/page';
import { useTranslation } from 'react-i18next';

type PostsProps = {
    posts: Paginator<Page>;
    sections: Translatable<{
        hero?: {
            title?: string;
            description?: string;
            image?: Media;
        };
    }>;
};

const Posts = ({ posts, sections }: PostsProps) => {
    const { t } = useTranslation();

    const tv = useTransValue();
    const sectionsTrans = tv(sections);

    return (
        <AppLayout>
            {/* Hero Section */}
            <HeroSection
                title={sectionsTrans?.hero?.title ?? ''}
                description={sectionsTrans?.hero?.description}
                image={sectionsTrans?.hero?.image?.url}
            />

            {/* Post List Section */}
            <Section className="pt-0 lg:pt-0">
                <Container>
                    {posts.data.length > 0 ? (
                        <div className="grid grid-cols-1 gap-x-8 gap-y-12 md:grid-cols-2">
                            {posts.data.map((post) => (
                                <PostItem key={post.id} post={post} />
                            ))}
                        </div>
                    ) : (
                        <p className="py-4 text-p-16-regular text-duyang-grey">
                            {t('content.noContent')}
                        </p>
                    )}

                    {/* Pagination */}
                    <Pagination meta={posts.meta} className="mt-10" />
                </Container>
            </Section>
        </AppLayout>
    );
};

export default Posts;
