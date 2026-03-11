import type { FC } from 'react';

import { cn } from '@/lib/utils/cn';
import { useTransValue } from '@/lib/utils/trans-value';
import type { Post } from '@/types';
import { useFormat } from '@/lib/utils/date';

export type BlogListItemProps = {
    post: Post;
    className?: string;
};

const BlogListItem: FC<BlogListItemProps> = ({ post, className }) => {
    const tv = useTransValue();
    const { format } = useFormat();

    return (
        <article className={cn('overflow-hidden', className)}>
            <div className="grid grid-cols-1 lg:grid-cols-12">
                <div className="flex flex-col gap-8 px-6 py-8 lg:col-span-8 lg:justify-center lg:px-12 lg:py-12">
                    <p className="text-h-40-bold text-duyang-grey">
                        {format(post.created_at, 'MMMM dd.yyyy')}
                    </p>

                    <h3 className="text-h-20-bold text-duyang-black lg:text-h-24-bold">
                        {tv(post.title)}
                    </h3>

                    <p className="text-p-16-regular text-duyang-grey">
                        {tv(post.description)}
                    </p>
                </div>

                <div className="h-40 lg:col-span-4">
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
                </div>
            </div>
        </article>
    );
};

export default BlogListItem;
