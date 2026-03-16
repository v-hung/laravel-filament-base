import { cn } from '@/lib/utils/cn';
import { useTransValue } from '@/lib/utils/trans-value';
import products from '@/routes/products';
import type { Product } from '@/types';
import { Link } from '@inertiajs/react';
import React from 'react';

export type ProductCardProps = React.HTMLAttributes<HTMLDivElement> & {
    product: Product;
};

const ProductCard: React.FC<ProductCardProps> = (props) => {
    const { className = '', product, ...rest } = props;
    const tv = useTransValue();

    const image = product.images?.[0] ?? null;

    return (
        <div {...rest} className={cn('group relative max-w-100', className)}>
            <div className="relative aspect-square overflow-hidden rounded bg-duyang-cream">
                <Link
                    href={products.detail(tv(product.slug))}
                    className="h-full w-full"
                >
                    <img
                        src={image?.conversions?.['thumb']?.url ?? image?.url}
                        alt={image?.custom_properties?.alt_text ?? ''}
                        className="h-full w-full object-cover transition-transform duration-300 hover:scale-105"
                    />
                </Link>

                <div className="absolute top-2 left-2 flex items-center md:top-2 md:left-4">
                    <div className="flex items-center gap-2 rounded-sm bg-duyang-white p-1 text-p-14-medium lg:text-p-16-medium">
                        {product.collections?.slice(0, 2).map((col, index) => (
                            <span
                                key={col.id}
                                className="flex items-center gap-2"
                            >
                                {index > 0 && (
                                    <div className="h-1 w-1 rounded-full bg-duyang-grey" />
                                )}
                                <span className="text-p-14-regular text-duyang-grey lg:text-p-16-regular">
                                    {tv(col.title)}
                                </span>
                            </span>
                        ))}
                        {(product.collections?.length ?? 0) > 2 && (
                            <span className="group/more relative flex items-center gap-2">
                                <div className="h-1 w-1 rounded-full bg-duyang-grey" />
                                <span className="cursor-default text-p-14-regular text-duyang-grey lg:text-p-16-regular">
                                    +{(product.collections?.length ?? 0) - 2}
                                </span>
                                <div className="pointer-events-none absolute bottom-full left-1/2 z-10 mb-1 -translate-x-1/2 rounded-sm bg-duyang-black px-2 py-1 text-p-14-regular whitespace-nowrap text-duyang-white opacity-0 shadow transition-opacity duration-200 group-hover/more:opacity-100">
                                    {product.collections
                                        ?.slice(2)
                                        .map((col) => tv(col.title))
                                        .join(', ')}
                                </div>
                            </span>
                        )}
                    </div>
                </div>
            </div>

            {/* Info */}
            <div>
                <Link
                    href={products.detail(tv(product.slug))}
                    className="h-full w-full"
                >
                    <h3 className="mt-3 text-p-18-semibold text-duyang-black lg:text-h-20-semibold">
                        {tv(product.name)}
                    </h3>
                </Link>

                <p
                    className={cn(
                        'mt-3 text-p-16-regular text-duyang-grey lg:text-p-18-regular',
                    )}
                >
                    ${Number(product.price).toLocaleString()}
                </p>
            </div>
        </div>
    );
};

export default ProductCard;
