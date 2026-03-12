import type { FC } from 'react';

import { cn } from '@/lib/utils/cn';
import { useTransValue } from '@/lib/utils/trans-value';
import type { Post } from '@/types';
import { useFormat } from '@/lib/utils/date';
import { Link } from '@inertiajs/react';
import posts from '@/routes/posts';

export type BlogListItemProps = {
    post: Post;
    className?: string;
};

const BlogListItem: FC<BlogListItemProps> = ({ post, className }) => {
    const tv = useTransValue();
    const { format } = useFormat();

    return (
        <article className={cn('overflow-hidden', className)}>
            <div className="grid grid-cols-1 gap-6 lg:grid-cols-12">
                <div className="flex flex-col gap-6 lg:col-span-8">
                    <p className="text-p-16-regular text-duyang-grey capitalize">
                        {format(post.created_at, 'MMMM dd.yyyy')}
                    </p>

                    <Link href={posts.detail(tv(post.slug))}>
                        <h3 className="text-h-20-bold text-duyang-black lg:text-h-24-bold">
                            {tv(post.title)}
                        </h3>
                    </Link>

                    <p className="line-clamp-2 text-p-16-regular text-duyang-grey">
                        {tv(post.description)}
                    </p>
                </div>

                <div className="min-h-40 lg:col-span-4 lg:h-full">
                    <Link href={posts.detail(tv(post.slug))}>
                        <img
                            src={
                                post.image?.conversions?.['thumb']?.url ??
                                post.image?.url ??
                                ''
                            }
                            alt={
                                post.image?.custom_properties?.alt_text ??
                                tv(post.title)
                            }
                            className="h-full w-full object-cover"
                        />
                    </Link>
                </div>
            </div>
        </article>
    );
};

export default BlogListItem;
