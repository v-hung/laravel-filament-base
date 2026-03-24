import { cn } from '@/lib/utils/cn';
import type { PaginatorMeta } from '@/types';
import { Link } from '@inertiajs/react';
import { useTranslation } from 'react-i18next';

type PaginationProps = {
    meta: PaginatorMeta;
    className?: string;
};

export default function Pagination({ meta, className }: PaginationProps) {
    const { t } = useTranslation();

    if (meta.last_page <= 1) return null;

    const prevLink = meta.links[0]; // Prev luôn ở đầu
    const nextLink = meta.links[meta.links.length - 1]; // Next luôn ở cuối

    // Các trang số nằm giữa
    const pageLinks = meta.links
        .slice(1, -1)
        .filter((l) => typeof l.page === 'number');

    const currentPage = pageLinks.find((l) => l.active)?.page ?? 1;
    const lastPage = pageLinks[pageLinks.length - 1]?.page ?? currentPage;

    // Build visible pages với ellipsis
    const visiblePages: (number | '...')[] = [];
    const delta = 1;
    const start = Math.max(2, currentPage - delta);
    const end = Math.min(lastPage - 1, currentPage + delta);

    visiblePages.push(1); // luôn show trang 1
    if (start > 2) visiblePages.push('...');
    for (let i = start; i <= end; i++) visiblePages.push(i);
    if (end < lastPage - 1) visiblePages.push('...');
    if (lastPage > 1) visiblePages.push(lastPage);

    return (
        <div
            className={cn(
                'flex flex-wrap items-center justify-center gap-1',
                className,
            )}
        >
            {/* Previous */}
            {prevLink?.url ? (
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

            {/* Pages */}
            {visiblePages.map((p, i) => {
                if (p === '...') {
                    return (
                        <span
                            key={`ellipsis-${i}`}
                            className="px-2 py-2 text-p-14-regular text-duyang-grey-mid"
                        >
                            &hellip;
                        </span>
                    );
                }

                const link = pageLinks.find((l) => l.page === p);
                if (!link) return null;

                return link.url ? (
                    <Link
                        key={p}
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
                        key={p}
                        className="min-w-9 border border-duyang-black/20 px-3 py-2 text-center text-p-14-regular text-duyang-grey-mid"
                    >
                        {link.label}
                    </span>
                );
            })}

            {/* Next */}
            {nextLink?.url ? (
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
