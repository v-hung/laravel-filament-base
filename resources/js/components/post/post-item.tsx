import type { FC } from 'react';
import { useTranslation } from 'react-i18next';

import { cn } from '@/lib/utils/cn';
import { useTransValue } from '@/lib/utils/trans-value';
import type { Blog, Post } from '@/types';
import { Link } from '@inertiajs/react';
import { useFormat } from '@/lib/utils/date';
import pages from '@/routes/pages';
import type { Page } from '@/types/models/page';

export type PostItemProps = {
    post: Page;
    className?: string;
};

const PostItem: FC<PostItemProps> = ({ post, className }) => {
    const { t } = useTranslation();
    const tv = useTransValue();
    const { format } = useFormat();
    const image = post.image ?? post.images?.[0] ?? null;

    return (
        <article className={cn('flex flex-col', className)}>
            <Link
                href={pages.detail(tv(post.slug))}
                className="aspect-4/3 w-full overflow-hidden"
            >
                <img
                    src={image?.conversions?.['thumb']?.url ?? image?.url ?? ''}
                    alt={image?.custom_properties?.alt_text ?? ''}
                    className="h-full w-full object-cover"
                />
            </Link>

            <div className="flex flex-col gap-4 pt-6">
                <div className="flex flex-wrap items-center gap-2">
                    {/* {post.categories?.map((category: Blog) => (
                        <span
                            key={category.id}
                            className="flex items-center gap-2 bg-duyang-cream px-4 py-2 text-p-14-semibold text-duyang-black uppercase"
                        >
                            <span aria-hidden="true">•</span>
                            {tv(category.title)}
                        </span>
                    ))} */}

                    <span className="bg-duyang-black px-4 py-2 text-p-14-semibold text-duyang-white capitalize">
                        {format(post.created_at, 'MMMM dd.yyyy')}
                    </span>
                </div>

                <Link href={pages.detail(tv(post.slug))}>
                    <h3 className="text-h-24-bold text-duyang-black">
                        {tv(post.title)}
                    </h3>
                </Link>

                {post.description && (
                    <p className="py-2 text-p-16-regular text-duyang-grey">
                        {tv(post.description)}
                    </p>
                )}

                <Link
                    href={pages.detail(tv(post.slug))}
                    className="inline-flex items-center gap-3 text-p-18-regular text-duyang-black hover:opacity-70"
                >
                    {t('common.readMore')}
                    <span aria-hidden="true">&#8594;</span>
                </Link>
            </div>
        </article>
    );
};

export default PostItem;
