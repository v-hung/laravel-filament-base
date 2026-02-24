import type { Product } from '@/types/models/product';
import { cn } from '@/lib/utils/cn';

interface PopularProductCardProps {
    product: Product;
    variant?: 'compact' | 'detailed';
    className?: string;
}

function StarIcon({ className }: { className?: string }) {
    return (
        <svg
            className={cn('inline-block', className)}
            width="16"
            height="16"
            viewBox="0 0 24 24"
            fill="currentColor"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
        </svg>
    );
}

function ProductImage({ product, className }: { product: Product; className?: string }) {
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
                    <span className="text-muted text-duyang-grey-light">No image</span>
                </div>
            )}
        </div>
    );
}

function CompactCard({ product, className }: { product: Product; className?: string }) {
    const rating = (product as { rating?: number }).rating;
    const collections = product.collections ?? [];

    return (
        <div className={cn('surface-card overflow-hidden', className)}>
            {/* Top meta row */}
            <div className="flex items-center justify-between px-5 pt-5 pb-3">
                <div className="flex items-center gap-1.5">
                    {collections.map((col, index) => (
                        <span key={col.id} className="text-muted text-duyang-grey">
                            {col.title}
                            {index < collections.length - 1 && (
                                <span className="mx-1.5 text-duyang-grey-light">•</span>
                            )}
                        </span>
                    ))}
                </div>
                {rating !== undefined && (
                    <div className="flex items-center gap-1">
                        <StarIcon className="text-duyang-black" />
                        <span className="text-muted text-duyang-black">{rating}</span>
                    </div>
                )}
            </div>

            {/* Image */}
            <ProductImage product={product} className="aspect-[4/3] w-full" />

            {/* Info */}
            <div className="px-5 pt-4 pb-5">
                <h3 className="text-body-md text-duyang-black">{product.name}</h3>
                <p className="text-muted text-duyang-grey mt-1">${Number(product.price).toLocaleString()}</p>
            </div>
        </div>
    );
}

function DetailedCard({ product, className }: { product: Product; className?: string }) {
    const rating = (product as { rating?: number; review_count?: number }).rating;
    const reviewCount = (product as { review_count?: number }).review_count;

    return (
        <div className={cn('surface-card overflow-hidden', className)}>
            {/* Image with rating badge overlay */}
            <div className="relative">
                <ProductImage product={product} className="aspect-[4/3] w-full" />
                {rating !== undefined && (
                    <div className="absolute top-4 left-4 flex items-center gap-1.5 rounded-duyang-sm bg-duyang-white px-3 py-1.5 shadow-sm">
                        <StarIcon className="text-duyang-black" />
                        <span className="text-body-sm text-duyang-black">{rating}</span>
                        {reviewCount !== undefined && (
                            <span className="text-muted text-duyang-grey">
                                ({reviewCount} Reviews)
                            </span>
                        )}
                    </div>
                )}
            </div>

            {/* Info */}
            <div className="px-5 pt-4 pb-5">
                <h3 className="text-body-md text-duyang-black">{product.name}</h3>
                {product.description && (
                    <p className="text-muted text-duyang-grey mt-2 line-clamp-2">
                        {product.description}
                    </p>
                )}
                <p className="text-body-md text-duyang-black mt-3">
                    ${Number(product.price).toLocaleString()}
                </p>
            </div>
        </div>
    );
}

export function PopularProductCard({ product, variant = 'compact', className }: PopularProductCardProps) {
    if (variant === 'detailed') {
        return <DetailedCard product={product} className={className} />;
    }

    return <CompactCard product={product} className={className} />;
}
