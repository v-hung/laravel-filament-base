import { cn } from '@/lib/utils/cn';
import { useTransValue } from '@/lib/utils/trans-value';
import { products } from '@/routes';
import type { Collection } from '@/types';
import { Link } from '@inertiajs/react';
import React from 'react';

export type ItemListCategoryProps = React.HTMLAttributes<HTMLDivElement> & {
    collection: Collection;
    reverse?: boolean;
};

const ItemListCategory: React.FC<ItemListCategoryProps> = (props) => {
    const { className = '', collection, reverse, ...rest } = props;
    const tv = useTransValue();

    return (
        <div
            {...rest}
            className={cn(
                `${reverse ? 'lg:flex-row-reverse' : 'lg:flex-row'} flex flex-col gap-6`,
                className,
            )}
        >
            <div className="shrink-0 overflow-hidden rounded bg-duyang-cream lg:w-3/5">
                {collection.image && (
                    <img
                        src={collection.image.url}
                        alt={
                            collection.image.custom_properties?.alt_text ??
                            tv(collection.title)
                        }
                        className="aspect-square w-full object-cover transition-transform duration-300 hover:scale-105 lg:aspect-auto lg:h-60"
                    />
                )}
            </div>

            <div className="flex flex-col items-start justify-center gap-4 lg:w-2/5 lg:gap-8">
                <h2 className="text-h-40-bold text-duyang-black">
                    {tv(collection.title)}
                </h2>

                {collection.description && (
                    <p className="line-clamp-3 text-p-16-regular text-duyang-grey">
                        {tv(collection.description)}
                    </p>
                )}

                <Link
                    href={products.url({
                        query: { category: tv(collection.slug) },
                    })}
                    className="inline-flex items-center gap-2 border-b pt-2 pb-2 text-p-18-medium text-duyang-black transition-opacity hover:opacity-70"
                >
                    <span>↗</span>
                    <span>Xem danh mục</span>
                </Link>
            </div>
        </div>
    );
};

export default ItemListCategory;
