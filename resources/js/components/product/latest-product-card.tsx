import { Link } from '@inertiajs/react';
import { type FC } from 'react';

import { Icons } from '@/components/shared/Icons';
import { cn } from '@/lib/utils/cn';
import type { Product } from '@/types/models/product';
import { transValue } from '@/lib/utils/trans-value';

export type LatestProductCardProps = {
    product: Product;
    href?: string;
    className?: string;
};

const LatestProductCard: FC<LatestProductCardProps> = ({
    product,
    href,
    className,
}) => {
    const imageUrl = product.images?.[0]?.url ?? null;
    const collections = product.collections ?? [];

    const inner = (
        <div className={cn('group relative bg-duyang-white', className)}>
            {/* Image */}
            <div className="relative aspect-square overflow-hidden bg-duyang-cream">
                {imageUrl ? (
                    <img
                        src={imageUrl}
                        alt={transValue(product.name)}
                        className="h-full w-full object-cover"
                    />
                ) : (
                    <div className="h-full w-full" />
                )}

                {/* Collection tags — visible on hover */}
                {collections.length > 0 && (
                    <div className="absolute top-3 left-3 flex flex-wrap gap-1.5 opacity-0 transition-opacity duration-200 group-hover:opacity-100">
                        {collections.map((col) => (
                            <span
                                key={col.id}
                                className="bg-duyang-white px-2.5 py-1 text-p-14-regular text-duyang-black"
                            >
                                {transValue(col.title)}
                            </span>
                        ))}
                    </div>
                )}
            </div>

            {/* Info */}
            <div className="relative pt-4">
                <p className="text-h-24-bold text-duyang-black">
                    {transValue(product.name)}
                </p>
                <p className="mt-1 text-p-18-regular text-duyang-grey">
                    ${Number(product.price).toLocaleString()}
                </p>

                {/* Arrow icon — visible on hover */}
                <div className="absolute right-0 bottom-0 opacity-0 transition-opacity duration-200 group-hover:opacity-100">
                    <Icons.ArrowUpRight
                        size={24}
                        className="text-duyang-black"
                    />
                </div>
            </div>
        </div>
    );

    if (href) {
        return <Link href={href}>{inner}</Link>;
    }

    return inner;
};

export default LatestProductCard;
