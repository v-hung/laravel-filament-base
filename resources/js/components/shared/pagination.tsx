import { cn } from '@/lib/utils/cn';
import type { PaginatorLink } from '@/types';
import { Link } from '@inertiajs/react';
import { useTranslation } from 'react-i18next';

type PaginationProps = {
    links: PaginatorLink[];
    lastPage: number;
    className?: string;
};

export default function Pagination({
    links,
    lastPage,
    className,
}: PaginationProps) {
    const { t } = useTranslation();

    if (lastPage <= 1) {
        return null;
    }

    const prevLink = links[0];
    const nextLink = links[links.length - 1];
    const pageLinks = links.slice(1, -1);

    const currentPage = pageLinks.findIndex((l) => l.active) + 1 || 1;

    const visiblePages = (() => {
        const pages: (number | '...')[] = [];
        const delta = 1;

        const rangeStart = Math.max(2, currentPage - delta);
        const rangeEnd = Math.min(lastPage - 1, currentPage + delta);

        pages.push(1);

        if (rangeStart > 2) {
            pages.push('...');
        }

        for (let p = rangeStart; p <= rangeEnd; p++) {
            pages.push(p);
        }

        if (rangeEnd < lastPage - 1) {
            pages.push('...');
        }

        if (lastPage > 1) {
            pages.push(lastPage);
        }

        return pages;
    })();

    return (
        <div
            className={cn(
                'flex flex-wrap items-center justify-center gap-1',
                className,
            )}
        >
            {prevLink.url ? (
                <Link
                    href={prevLink.url}
                    className="border border-duyang-black/20 px-4 py-2 text-p-14-regular text-duyang-black hover:bg-duyang-cream"
                >
                    {t('common.previous')}
                </Link>
            ) : (
                <span className="cursor-not-allowed border border-duyang-black/10 px-4 py-2 text-p-14-regular text-duyang-grey-mid">
                    {t('common.previous')}
                </span>
            )}

            {visiblePages.map((page, i) => {
                if (page === '...') {
                    return (
                        <span
                            key={`ellipsis-${i}`}
                            className="px-2 py-2 text-p-14-regular text-duyang-grey-mid"
                        >
                            &hellip;
                        </span>
                    );
                }

                const link = pageLinks[page - 1];
                if (!link) return null;

                return link.url ? (
                    <Link
                        key={page}
                        href={link.url}
                        className={cn(
                            'min-w-9 border px-3 py-2 text-center text-p-14-regular',
                            link.active
                                ? 'border-duyang-black bg-duyang-black text-white'
                                : 'border-duyang-black/20 text-duyang-black hover:bg-duyang-cream',
                        )}
                    >
                        {link.label}
                    </Link>
                ) : (
                    <span
                        key={page}
                        className="min-w-9 border border-duyang-black/20 px-3 py-2 text-center text-p-14-regular text-duyang-grey-mid"
                    >
                        {link.label}
                    </span>
                );
            })}

            {nextLink.url ? (
                <Link
                    href={nextLink.url}
                    className="border border-duyang-black/20 px-4 py-2 text-p-14-regular text-duyang-black hover:bg-duyang-cream"
                >
                    {t('common.next')}
                </Link>
            ) : (
                <span className="cursor-not-allowed border border-duyang-black/10 px-4 py-2 text-p-14-regular text-duyang-grey-mid">
                    {t('common.next')}
                </span>
            )}
        </div>
    );
}
