import { cn } from '@/lib/utils/cn';
import { useTransValue } from '@/lib/utils/trans-value';
import { useSettingStore } from '@/stores/setting';
import type { Media } from '@/types';
import { type FC } from 'react';

type ImagePanelProps = {
    images: string[];
    type?: 'horizontal' | 'vertical';
    after?: boolean;
};

const ImagePanel: FC<ImagePanelProps> = ({
    images,
    type = 'horizontal',
    after,
}) => {
    const count = images.length;

    return (
        <div
            className={`grid h-full gap-4 lg:gap-6 ${count === 1 ? 'grid-cols-1' : 'grid-cols-2 grid-rows-2'}`}
        >
            {images.map((src, i) => (
                <div
                    key={i}
                    className={cn(
                        'aspect-square overflow-hidden rounded',
                        count === 2
                            ? type === 'horizontal'
                                ? 'col-span-2 aspect-2/1'
                                : 'row-span-2 aspect-1/2'
                            : '',
                        count === 3 && i === 0
                            ? type === 'horizontal'
                                ? 'col-span-2 aspect-auto'
                                : 'row-span-2 aspect-auto'
                            : '',
                        after ? 'lg:aspect-auto' : '',
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

type InspirationGalleryProps = {
    images?: Media[];
};

const InspirationGallery: FC<InspirationGalleryProps> = ({ images = [] }) => {
    const tv = useTransValue();
    const gallery = images.map((media) => media.url);

    const n = Math.min(gallery.length, 8);
    const imgs = gallery.slice(0, n);

    if (n === 0) {
        return null;
    }

    if (n === 1) {
        return (
            <div className={cn('aspect-2/1 overflow-hidden rounded')}>
                <img
                    src={imgs[0]}
                    alt="Ảnh 1"
                    className="h-full w-full bg-duyang-cream object-cover"
                />
            </div>
        );
    }

    const leftCount = n <= 4 ? Math.ceil(n / 2) : 4;
    const leftImages = imgs.slice(0, leftCount);
    const rightImages = imgs.slice(leftCount);

    return (
        <div
            className={cn(
                'grid w-full grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-6',
            )}
        >
            <ImagePanel images={leftImages} />
            <ImagePanel images={rightImages} type="vertical" after />
        </div>
    );
};

export default InspirationGallery;
