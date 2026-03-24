import type { FC } from 'react';

import { cn } from '@/lib/utils/cn';
import { useTransValue } from '@/lib/utils/trans-value';
import { useFormat } from '@/lib/utils/date';
import { Link } from '@inertiajs/react';
import type { Page } from '@/types/models/page';
import pages from '@/routes/pages';

export type PageItemProps = {
    page: Page;
    className?: string;
};

const PageItem: FC<PageItemProps> = ({ page, className }) => {
    const tv = useTransValue();
    const { format } = useFormat();

    return (
        <article className={cn('overflow-hidden', className)}>
            <div className="grid grid-cols-1 gap-6 lg:grid-cols-12">
                <div className="flex flex-col gap-6 lg:col-span-8">
                    <p className="text-p-16-regular text-duyang-grey capitalize">
                        {format(page.created_at, 'MMMM dd.yyyy')}
                    </p>

                    <Link href={pages.detail(tv(page.slug))}>
                        <h3 className="text-h-20-bold text-duyang-black lg:text-h-24-bold">
                            {tv(page.title)}
                        </h3>
                    </Link>

                    <p className="line-clamp-2 text-p-16-regular text-duyang-grey">
                        {tv(page.description)}
                    </p>
                </div>

                <div className="min-h-40 lg:col-span-4 lg:h-full">
                    <Link href={pages.detail(tv(page.slug))}>
                        <img
                            src={
                                page.image?.conversions?.['thumb']?.url ??
                                page.image?.url ??
                                ''
                            }
                            alt={
                                page.image?.custom_properties?.alt_text ??
                                tv(page.title)
                            }
                            className="h-full w-full object-cover"
                        />
                    </Link>
                </div>
            </div>
        </article>
    );
};

export default PageItem;
