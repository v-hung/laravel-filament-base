import PostItem from '@/components/post/post-item';
import Container from '@/components/shared/container';
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
            <Section className="pt-0 lg:pt-0">
                <Container>
                    <div className="flex items-center justify-between py-8 lg:py-14">
                        <h2 className="text-h-56-bold">Tin tức</h2>
                        <p className="max-w-80 text-p-16-regular text-duyang-grey">
                            {`Cập nhật các hoạt động sản xuất, tiến độ đơn hàng và thông tin xuất xưởng mới nhất từ nhà máy.`}
                        </p>
                    </div>
                </Container>
                <img
                    src="/images/news.jpg"
                    alt="News"
                    className="h-60 w-full bg-duyang-cream md:h-90 lg:h-125"
                />
            </Section>

            {/* Post List Section */}
            <Section>
                <Container>
                    <div className="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-3">
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
