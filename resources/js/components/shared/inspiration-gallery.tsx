import { cn } from '@/lib/utils/cn';
import type { FC } from 'react';

export type InspirationGalleryProps = {
    images: string[];
    className?: string;
};

type ImagePanelProps = {
    images: string[];
    type?: 'horizontal' | 'vertical';
};

const ImagePanel: FC<ImagePanelProps> = ({ images, type = 'horizontal' }) => {
    const count = images.length;

    return (
        <div
            className={`grid h-full gap-4 lg:gap-6 ${count === 1 ? 'grid-cols-1' : 'grid-cols-2 grid-rows-2'}`}
        >
            {images.map((src, i) => (
                <div
                    key={i}
                    className={cn(
                        'overflow-hidden rounded',
                        count == 2 &&
                            (type === 'vertical' ? 'row-span-2' : 'col-span-2'),
                        count === 3 &&
                            i === 3 &&
                            (type === 'vertical' ? 'col-span-2' : 'row-span-2'),
                    )}
                >
                    <img
                        src={src}
                        alt={`Ảnh ${i + 1}`}
                        className="h-full w-full bg-duyang-cream object-cover"
                    />
                </div>
            ))}
        </div>
    );
};

const InspirationGallery: FC<InspirationGalleryProps> = ({
    images,
    className,
}) => {
    const n = Math.min(images.length, 8);
    const imgs = images.slice(0, n);

    if (n === 0) {
        return null;
    }

    if (n === 1) {
        return (
            <div
                className={cn('aspect-2/1 overflow-hidden rounded', className)}
            >
                <img
                    src={imgs[0]}
                    alt="Ảnh 1"
                    className="h-full w-full bg-duyang-cream object-cover"
                />
            </div>
        );
    }

    const leftCount = Math.ceil(n / 2);
    const leftImages = imgs.slice(0, leftCount);
    const rightImages = imgs.slice(leftCount);

    return (
        <div
            className={cn(
                'grid aspect-2/1 w-full grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-6',
                className,
            )}
        >
            <ImagePanel images={leftImages} />
            <ImagePanel images={rightImages} />
        </div>
    );
};

export default InspirationGallery;
