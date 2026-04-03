import { cn } from '@/lib/utils/cn';
import { useTransValue } from '@/lib/utils/trans-value';
import { products } from '@/routes';
import type { Collection } from '@/types';
import { Link } from '@inertiajs/react';
import React from 'react';

export type CardCategoryProps = React.HTMLAttributes<HTMLDivElement> & {
    collection: Collection;
};

const CardCategory: React.FC<CardCategoryProps> = (props) => {
    const { className = '', collection, ...rest } = props;
    const tv = useTransValue();

    return (
        <div {...rest} className={cn('', className)}>
            <Link
                href={products.url({
                    query: { category: tv(collection.slug) },
                })}
                className="block"
            >
                <div className="aspect-square overflow-hidden rounded bg-duyang-cream">
                    {collection.image && (
                        <img
                            src={collection.image.url}
                            alt={
                                collection.image.custom_properties?.alt_text ??
                                tv(collection.title)
                            }
                            className="h-full w-full object-cover transition-transform duration-300 hover:scale-105"
                        />
                    )}
                </div>

                <p className="mt-4 text-center text-p-16-semibold text-duyang-black lg:text-h-20-semibold">
                    {tv(collection.title)}
                </p>
            </Link>
        </div>
    );
};

export default CardCategory;
