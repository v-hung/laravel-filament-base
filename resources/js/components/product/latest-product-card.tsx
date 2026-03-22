import { Link } from '@inertiajs/react';
import { type FC } from 'react';

import { Icons } from '@/components/shared/Icons';
import { cn } from '@/lib/utils/cn';
import type { Product } from '@/types/models/product';
import { useTransValue } from '@/lib/utils/trans-value';
import products from '@/routes/products';

export type LatestProductCardProps = {
    product: Product;
    className?: string;
};

const LatestProductCard: FC<LatestProductCardProps> = ({
    product,
    className,
}) => {
    const tv = useTransValue();

    const collections = product.collections ?? [];

    const image = product.images?.[0] ?? null;

    return (
        <div className={cn('group relative bg-duyang-white', className)}>
            {/* Image */}
            <Link
                href={products.detail(tv(product.slug))}
                className="relative block aspect-square overflow-hidden rounded bg-duyang-cream"
            >
                {image ? (
                    <img
                        src={image.conversions?.['thumb']?.url ?? image.url}
                        alt={tv(product.name)}
                        className="h-full w-full object-cover transition-transform duration-300 hover:scale-105"
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
                                {tv(col.title)}
                            </span>
                        ))}
                    </div>
                )}
            </Link>

            {/* Info */}
            <div className="relative pt-4">
                <Link
                    href={products.detail(tv(product.slug))}
                    className="text-p-18-semibold text-duyang-black lg:text-h-20-semibold"
                >
                    {tv(product.name)}
                </Link>
                {/* <p className="mt-1 text-p-16-regular text-duyang-grey lg:text-p-18-regular">
                    ${Number(product.price).toLocaleString()}
                </p> */}

                {/* Arrow icon — visible on hover */}
                <Link
                    href={products.detail(tv(product.slug))}
                    className="absolute right-0 bottom-0 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
                >
                    <Icons.ArrowUpRight
                        size={24}
                        className="text-duyang-black"
                    />
                </Link>
            </div>
        </div>
    );
};

export default LatestProductCard;
