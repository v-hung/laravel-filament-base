import { cn } from '@/lib/utils/cn';
import type { Product } from '@/types/models/product';
import { Icons } from '../shared/Icons';

interface PopularProductCardProps {
    product: Product;
    version?: 'v1' | 'v2';
    className?: string;
}

function ProductImage({
    product,
    className,
}: {
    product: Product;
    className?: string;
}) {
    const imageUrl = product.images?.[0]?.original_url ?? null;

    return (
        <div className={cn('overflow-hidden bg-duyang-cream', className)}>
            {imageUrl ? (
                <img
                    src={imageUrl}
                    alt={product.name}
                    className="h-full w-full object-cover"
                />
            ) : (
                <div className="flex h-full w-full items-center justify-center">
                    <span className="text-p-14-regular text-duyang-grey-light">
                        No image
                    </span>
                </div>
            )}
        </div>
    );
}

export function PopularProductCard({
    product,
    version = 'v1',
    className,
}: PopularProductCardProps) {
    const rating = (product as { rating?: number; review_count?: number })
        .rating;
    const reviewCount = (product as { review_count?: number }).review_count;

    return (
        <div
            className={cn(
                'max-w-100 overflow-hidden bg-duyang-white',
                className,
            )}
        >
            {/* Image (detailed: rating overlay badge) */}
            <div className="relative">
                <ProductImage
                    product={product}
                    className={`${version === 'v2' ? 'aspect-[4/4.6]' : 'aspect-[4/4.3]'} w-full`}
                />
                <div className="absolute top-0 right-0 left-0 flex justify-between p-4">
                    {version === 'v2' && rating !== undefined && (
                        <div className="flex items-center gap-0.5 rounded bg-duyang-white px-3 py-0.5 shadow-sm">
                            <Icons.Star width={20} height={20} />
                            <span className="text-p-16-bold text-duyang-black">
                                {rating}
                            </span>
                            {reviewCount !== undefined && (
                                <span className="text-p-16-regular text-duyang-black">
                                    ({reviewCount} Reviews)
                                </span>
                            )}
                        </div>
                    )}
                    {version === 'v1' && (
                        <>
                            <div className="text-p-16-semibold flex items-center gap-2 text-duyang-grey">
                                {product.collections
                                    ?.slice(0, 2)
                                    .map((col, index) => (
                                        <span
                                            key={col.id}
                                            className="flex items-center gap-2"
                                        >
                                            {index > 0 && (
                                                <div className="h-1 w-1 rounded-full bg-duyang-grey" />
                                            )}
                                            <span className="text-p-14-regular text-duyang-grey">
                                                {col.title}
                                            </span>
                                        </span>
                                    ))}
                            </div>
                            {rating !== undefined && (
                                <div className="flex items-center gap-0.5">
                                    <Icons.StarFill
                                        width={20}
                                        height={20}
                                        fill="var(--color-duyang-grey)"
                                    />
                                    <span className="text-p-16-bold text-duyang-grey">
                                        ({rating})
                                    </span>
                                </div>
                            )}
                        </>
                    )}
                </div>
            </div>

            {/* Info */}
            <div>
                <h3 className="text-h-20-semibold mt-3 text-duyang-black">
                    {product.name}
                </h3>
                {version === 'v2' && product.description && (
                    <p className="text-p-16-regular mt-3 line-clamp-2 text-duyang-grey">
                        {product.description}
                    </p>
                )}
                <p
                    className={cn(
                        'mt-1',
                        version === 'v2'
                            ? 'text-p-18-semibold mt-3 text-duyang-black'
                            : 'text-p-14-regular mt-3 text-duyang-grey',
                    )}
                >
                    ${Number(product.price).toLocaleString()}
                </p>
            </div>
        </div>
    );
}
