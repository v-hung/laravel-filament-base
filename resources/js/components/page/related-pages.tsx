import { cn } from '@/lib/utils/cn';
import type { Paginator } from '@/types';
import type { Page } from '@/types/models/page';
import React from 'react';
import PageItem from './page-item';
import { useTranslation } from 'react-i18next';

type RelatedPagesProps = {
    pages: Paginator<Page>;
    data?: {
        title?: string;
        description?: string;
    };
    className?: string;
};

const RelatedPages = ({
    pages,
    data: { title, description } = {},
    className,
}: RelatedPagesProps) => {
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
                    {title ?? t('page.related.title')}
                </h2>
                <p className="pt-6 text-p-16-regular text-duyang-grey">
                    {description ?? t('page.related.description')}
                </p>
            </div>

            <div className="flex grow flex-col">
                {pages.data.length > 0 ? (
                    <div className="grid grid-cols-1 gap-10">
                        {pages.data.map((page, index) => (
                            <React.Fragment key={page.id}>
                                <PageItem page={page} />
                                {index < pages.data.length - 1 && (
                                    <div className="border-b"></div>
                                )}
                            </React.Fragment>
                        ))}
                    </div>
                ) : (
                    <p className="text-p-16-regular text-duyang-grey">
                        {t('content.noPages')}
                    </p>
                )}
            </div>
        </div>
    );
};

export default RelatedPages;
