import { cn } from '@/lib/utils/cn';
import type { PaginatorLink } from '@/types';
import { Link } from '@inertiajs/react';

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
    if (lastPage <= 1) {
        return null;
    }

    const prevLink = links[0];
    const nextLink = links[links.length - 1];
    const pageLinks = links.slice(1, -1);

    return (
        <div
            className={cn('flex items-center justify-center gap-1', className)}
        >
            {prevLink.url ? (
                <Link
                    href={prevLink.url}
                    className="border border-duyang-black/20 px-4 py-2 text-p-14-regular text-duyang-black hover:bg-duyang-cream"
                >
                    Previous
                </Link>
            ) : (
                <span className="cursor-not-allowed border border-duyang-black/10 px-4 py-2 text-p-14-regular text-duyang-grey-mid">
                    Previous
                </span>
            )}

            {pageLinks.map((link, i) =>
                link.url ? (
                    <Link
                        key={i}
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
                        key={i}
                        className="px-2 py-2 text-p-14-regular text-duyang-grey-mid"
                    >
                        {link.label}
                    </span>
                ),
            )}

            {nextLink.url ? (
                <Link
                    href={nextLink.url}
                    className="border border-duyang-black/20 px-4 py-2 text-p-14-regular text-duyang-black hover:bg-duyang-cream"
                >
                    Next
                </Link>
            ) : (
                <span className="cursor-not-allowed border border-duyang-black/10 px-4 py-2 text-p-14-regular text-duyang-grey-mid">
                    Next
                </span>
            )}
        </div>
    );
}
