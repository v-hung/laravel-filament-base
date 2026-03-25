import RelatedPosts from '@/components/post/related-posts';
import Container from '@/components/shared/container';
import HeroSection from '@/components/shared/hero-section';
import Section from '@/components/shared/section';
import AppLayout from '@/layouts/app-layout';
import { useTransValue } from '@/lib/utils/trans-value';
import type { Paginator, Post } from '@/types';
import { useMemo } from 'react';
import { useTranslation } from 'react-i18next';

type PostDetailProps = {
    post: Post;
    other_posts: Paginator<Post>;
};

const PostDetail = ({ post, other_posts }: PostDetailProps) => {
    const { t } = useTranslation();
    const tv = useTransValue();

    const content = useMemo(() => {
        const html = tv(post.content);
        const hasContent = /[^\s<>]/.test(html);
        return hasContent ? html : null;
    }, [post.content, tv]);

    return (
        <AppLayout>
            {/* Hero Section */}
            <HeroSection
                title={tv(post.title)}
                date={post.created_at}
                image={post.image?.url}
            />

            {/* Post Content Section */}
            <Section className="py-8 lg:py-14">
                <Container>
                    {content ? (
                        <div
                            className="flex flex-col gap-6 text-p-16-regular text-duyang-grey"
                            dangerouslySetInnerHTML={{ __html: content }}
                        ></div>
                    ) : (
                        <p className="text-center text-duyang-grey">
                            {t('content.noContent')}
                        </p>
                    )}
                </Container>
            </Section>

            {/* Related Posts Section */}
            <Container>
                <RelatedPosts
                    posts={other_posts}
                    className="border-t py-10 lg:py-16"
                />
            </Container>
        </AppLayout>
    );
};

export default PostDetail;
