import { cn } from '@/lib/utils/cn';
import { transValue } from '@/lib/utils/trans-value';
import type { Product } from '@/types';
import React from 'react';

export type ProductCardProps = React.HTMLAttributes<HTMLDivElement> & {
    product: Product;
};

const ProductCard: React.FC<ProductCardProps> = (props) => {
    const { className = '', product, ...rest } = props;

    const image = product.images?.[0] ?? null;

    return (
        <div {...rest} className={cn('group relative max-w-100', className)}>
            <div className="relative aspect-square overflow-hidden bg-duyang-cream">
                <img
                    src={image?.conversions?.['thumb']?.url ?? image?.url}
                    alt={image?.custom_properties?.alt_text ?? ''}
                    className="h-full w-full object-cover"
                />

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
                                    {transValue(col.title)}
                                </span>
                            </span>
                        ))}
                    </div>
                </div>
            </div>

            {/* Info */}
            <div>
                <h3 className="mt-3 text-p-18-semibold text-duyang-black lg:text-h-20-semibold">
                    {transValue(product.name)}
                </h3>

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
