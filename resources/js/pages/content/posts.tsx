import PostItem from '@/components/post/post-item';
import Container from '@/components/shared/container';
import HeroSection from '@/components/shared/hero-section';
import Pagination from '@/components/shared/pagination';
import Section from '@/components/shared/section';
import AppLayout from '@/layouts/app-layout';
import type { Paginator, Post } from '@/types';

type PostsProps = {
    posts: Paginator<Post>;
};

const Posts = ({ posts }: PostsProps) => {
    return (
        <AppLayout>
            {/* Hero Section */}
            <HeroSection
                title="Tin tức"
                description="Cập nhật các hoạt động sản xuất, tiến độ đơn hàng và thông tin xuất xưởng mới nhất từ nhà máy."
                image="/images/news.jpg"
            />

            {/* Post List Section */}
            <Section className="pt-0 lg:pt-0">
                <Container>
                    <div className="grid grid-cols-1 gap-x-8 gap-y-12 md:grid-cols-2">
                        {posts.data.map((post) => (
                            <PostItem key={post.id} post={post} />
                        ))}
                    </div>

                    {/* Pagination */}
                    <Pagination
                        links={posts.links}
                        lastPage={posts.last_page}
                        className="mt-10"
                    />
                </Container>
            </Section>
        </AppLayout>
    );
};

export default Posts;
