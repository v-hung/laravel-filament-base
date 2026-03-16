import { cn } from '@/lib/utils/cn';
import { useTransValue } from '@/lib/utils/trans-value';
import products from '@/routes/products';
import type { Product } from '@/types';
import { Link } from '@inertiajs/react';
import React from 'react';

export type CardRelatedProductProps = React.HTMLAttributes<HTMLDivElement> & {
    product: Product;
};

const CardRelatedProduct: React.FC<CardRelatedProductProps> = (props) => {
    const { className = '', product, ...rest } = props;
    const tv = useTransValue();

    const image = product.images?.[0] ?? null;

    return (
        <div {...rest} className={cn('', className)}>
            <Link
                href={products.detail(tv(product.slug))}
                className="rounded-duyang-card block aspect-square overflow-hidden rounded bg-duyang-cream"
            >
                {image && (
                    <img
                        src={image.conversions?.['thumb']?.url ?? image.url}
                        alt={
                            image.custom_properties?.alt_text ??
                            tv(product.name)
                        }
                        className="h-full w-full object-cover transition-transform duration-300 hover:scale-105"
                    />
                )}
            </Link>

            <Link href={products.detail(tv(product.slug))}>
                <h3 className="lg:text-h-22-semibold mt-4 text-h-20-bold text-duyang-black">
                    {tv(product.name)}
                </h3>
            </Link>

            <div className="mt-3 flex items-center gap-6">
                <p className="text-p-16-semibold text-duyang-black lg:text-p-18-semibold">
                    ${Number(product.price).toLocaleString()}
                </p>
                <p className="text-p-16-regular text-duyang-grey lg:text-p-18-regular">
                    {product.collections &&
                        product.collections.map((collection) => (
                            <span className="line-through">
                                $
                                {Number(
                                    collection.discount_price,
                                ).toLocaleString()}
                            </span>
                        ))}
                </p>
            </div>
        </div>
    );
};

export default CardRelatedProduct;
