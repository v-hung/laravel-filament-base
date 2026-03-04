import type { FC } from 'react';
import { useTranslation } from 'react-i18next';

import { cn } from '@/lib/utils/cn';
import { transValue } from '@/lib/utils/trans-value';
import type { Blog, Post } from '@/types';

export type PostItemProps = {
    post: Post;
    date: string;
    className?: string;
};

const PostItem: FC<PostItemProps> = ({ post, date, className }) => {
    const { t } = useTranslation();
    const image = post.image ?? post.images?.[0] ?? null;

    return (
        <article className={cn('flex flex-col', className)}>
            <div className="aspect-[4/3] w-full overflow-hidden">
                <img
                    src={image?.conversions?.['thumb']?.url ?? image?.url ?? ''}
                    alt={image?.custom_properties?.alt_text ?? ''}
                    className="h-full w-full object-cover"
                />
            </div>

            <div className="flex flex-col gap-6 pt-6">
                <div className="flex flex-wrap items-center gap-2">
                    {post.categories?.map((category: Blog) => (
                        <span
                            key={category.id}
                            className="flex items-center gap-2 bg-duyang-cream px-4 py-2 text-p-14-semibold text-duyang-black uppercase"
                        >
                            <span aria-hidden="true">•</span>
                            {transValue(category.title)}
                        </span>
                    ))}

                    <span className="bg-duyang-black px-4 py-2 text-p-14-semibold text-duyang-white">
                        {date}
                    </span>
                </div>

                <h3 className="text-h-40 text-duyang-black">
                    {transValue(post.title)}
                </h3>

                {post.description && (
                    <p className="text-p-18-regular text-duyang-grey">
                        {transValue(post.description)}
                    </p>
                )}

                <a
                    href={`/blog/${transValue(post.slug)}`}
                    className="inline-flex items-center gap-3 text-p-16-semibold text-duyang-black hover:opacity-70"
                >
                    {t('common.readMore')}
                    <span aria-hidden="true">&#8594;</span>
                </a>
            </div>
        </article>
    );
};

export default PostItem;
