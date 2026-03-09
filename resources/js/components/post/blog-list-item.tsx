import type { FC } from 'react';

import { cn } from '@/lib/utils/cn';
import { useTransValue } from '@/lib/utils/trans-value';
import type { Post } from '@/types';
import { format } from '@/lib/utils/date';

export type BlogListItemProps = {
    post: Post;
    className?: string;
};

const BlogListItem: FC<BlogListItemProps> = ({ post, className }) => {
    const tv = useTransValue();
    const image = post.image ?? post.images?.[0] ?? null;

    return (
        <article className={cn('overflow-hidden', className)}>
            <div className="grid grid-cols-1 lg:grid-cols-12">
                <div className="flex flex-col gap-8 px-6 py-8 lg:col-span-8 lg:justify-center lg:px-12 lg:py-12">
                    <p className="text-h-40-bold text-duyang-grey">
                        {format(tv(post.created_at), 'MMMM dd.yyyy')}
                    </p>

                    <h3 className="text-h-32-bold text-duyang-black lg:text-h-56-bold">
                        {tv(post.title)}
                    </h3>

                    <p className="max-w-5xl text-p-18-regular text-duyang-grey">
                        {tv(post.description)}
                    </p>
                </div>

                <div className="h-40 lg:col-span-4">
                    <img
                        src={
                            image?.conversions?.['thumb']?.url ??
                            image?.url ??
                            ''
                        }
                        alt={image?.custom_properties?.alt_text ?? ''}
                        className="h-full w-full object-cover"
                    />
                </div>
            </div>
        </article>
    );
};

export default BlogListItem;
