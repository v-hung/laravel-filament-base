import BlogListItem from '@/components/post/blog-list-item';
import { cn } from '@/lib/utils/cn';
import type { Paginator, Post } from '@/types';
import React from 'react';
import { useTranslation } from 'react-i18next';

type RelatedPostsProps = {
    posts: Paginator<Post>;
    data?: {
        title?: string;
        description?: string;
    };
    className?: string;
};

const RelatedPosts = ({
    posts,
    data: { title, description } = {},
    className,
}: RelatedPostsProps) => {
    const { t } = useTranslation();
    return (
        <div
            className={cn(
                `flex flex-col gap-10 lg:flex-row lg:items-start lg:gap-20`,
                className,
            )}
        >
            <div className="shrink-0 lg:w-80">
                <h2 className="text-h-32-bold text-duyang-black lg:text-h-56-bold">
                    {title}
                </h2>
                <p className="pt-6 text-p-16-regular text-duyang-grey">
                    {description}
                </p>
            </div>

            <div className="flex grow flex-col">
                {posts.data.length > 0 ? (
                    <div className="grid grid-cols-1 gap-10">
                        {posts.data.map((post, index) => (
                            <React.Fragment key={post.id}>
                                <BlogListItem post={post} />
                                {index < posts.data.length - 1 && (
                                    <div className="border-b"></div>
                                )}
                            </React.Fragment>
                        ))}
                    </div>
                ) : (
                    <p className="text-p-16-regular text-duyang-grey">
                        {t('content.noPosts')}
                    </p>
                )}
            </div>
        </div>
    );
};

export default RelatedPosts;
