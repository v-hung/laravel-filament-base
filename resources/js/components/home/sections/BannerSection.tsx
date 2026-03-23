import Container from '@/components/shared/container';
import type { Media } from '@/types';
import type { FC } from 'react';

type BannerSectionProps = {
    data?: { image?: Media };
};

const BannerSection: FC<BannerSectionProps> = ({ data }) => {
    const image = data?.image;
    if (!image) return null;

    return (
        <div className="relative h-[calc(100vh-var(--header-height))] w-full">
            <img src={image.url} className="absolute top-0 left-0 h-full w-full object-cover" />
            <Container className="relative" />
        </div>
    );
};

export default BannerSection;
