import BlogListItem from '@/components/post/blog-list-item';
import Container from '@/components/shared/container';
import Section from '@/components/shared/section';
import AppLayout from '@/layouts/app-layout';
import { format } from '@/lib/utils/date';
import { useTransValue } from '@/lib/utils/trans-value';
import type { Paginator, Post } from '@/types';
import { useTranslation } from 'react-i18next';

type PostDetailProps = {
    post: Post;
    other_posts: Paginator<Post>;
};

const PostDetail = ({ post, other_posts }: PostDetailProps) => {
    const { t } = useTranslation();
    const tv = useTransValue();

    return (
        <AppLayout>
            {/* Hero Section */}
            <Section className="pt-0 lg:pt-0">
                <Container>
                    <div className="flex items-end justify-between py-8 lg:py-14">
                        <h2 className="text-h-56-bold">{tv(post.title)}</h2>
                        <p className="max-w-80 text-p-16-regular text-duyang-grey">
                            {format(tv(post.created_at), 'MMMM dd.yyyy')}
                        </p>
                    </div>
                </Container>
                <img
                    src={post.image?.url}
                    alt="News"
                    className="h-60 w-full bg-duyang-cream object-cover md:h-90 lg:h-125"
                />
            </Section>

            {/* Post Content Section */}
            <Section className="py-8 lg:py-14">
                <Container>
                    <div
                        className="prose max-w-none"
                        dangerouslySetInnerHTML={{ __html: tv(post.content) }}
                    ></div>
                </Container>
            </Section>

            {/* Related Posts Section */}
            <Section>
                <Container>
                    <div className="flex flex-col gap-10 lg:flex-row lg:items-start lg:gap-20">
                        <div className="shrink-0 lg:w-50">
                            <h2 className="text-h-32-bold text-duyang-black lg:text-h-56-bold">
                                Tin tức khác
                            </h2>
                        </div>

                        <div className="flex grow flex-col">
                            <div className="grid grid-cols-1 gap-10">
                                {other_posts.data.map((value) => (
                                    <BlogListItem key={value.id} post={value} />
                                ))}
                            </div>
                        </div>
                    </div>
                </Container>
            </Section>
        </AppLayout>
    );
};

export default PostDetail;
