import BlogListItem from '@/components/post/blog-list-item';
import Container from '@/components/shared/container';
import HeroSection from '@/components/shared/hero-section';
import Section from '@/components/shared/section';
import AppLayout from '@/layouts/app-layout';
import { useFormat } from '@/lib/utils/date';
import { useTransValue } from '@/lib/utils/trans-value';
import type { Paginator, Post } from '@/types';
import React, { useMemo } from 'react';

type PostDetailProps = {
    post: Post;
    other_posts: Paginator<Post>;
};

const PostDetail = ({ post, other_posts }: PostDetailProps) => {
    const { format } = useFormat();
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
                            className="flex flex-col gap-6 text-p-16-regular whitespace-pre-line text-duyang-grey"
                            dangerouslySetInnerHTML={{ __html: content }}
                        ></div>
                    ) : (
                        <p className="text-center text-duyang-grey">
                            Không có nội dung
                        </p>
                    )}
                </Container>
            </Section>

            {/* Related Posts Section */}
            <Container>
                <div className="flex flex-col gap-10 border-t py-10 lg:flex-row lg:items-start lg:gap-20 lg:py-16">
                    <div className="shrink-0 lg:w-80">
                        <h2 className="text-h-32-bold text-duyang-black lg:text-h-56-bold">
                            Tin tức khác
                        </h2>
                        <p className="pt-6 text-p-16-regular text-duyang-grey">
                            Cập nhật các hoạt động sản xuất, tiến độ đơn hàng và
                            thông tin xuất xưởng mới nhất từ nhà máy.
                        </p>
                    </div>

                    <div className="flex grow flex-col">
                        <div className="grid grid-cols-1 gap-10">
                            {other_posts.data.map((value, index) => (
                                <React.Fragment key={value.id}>
                                    <BlogListItem key={value.id} post={value} />
                                    {index < other_posts.data.length - 1 && (
                                        <div className="border-b"></div>
                                    )}
                                </React.Fragment>
                            ))}
                        </div>
                    </div>
                </div>
            </Container>
        </AppLayout>
    );
};

export default PostDetail;
