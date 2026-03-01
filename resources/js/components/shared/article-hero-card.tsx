import type { FC } from 'react';

import { cn } from '@/lib/utils/cn';

export type ArticleHeroCardProps = {
    date: string;
    title: string;
    description: string;
    imageUrl: string;
    imageAlt: string;
    className?: string;
};

const ArticleHeroCard: FC<ArticleHeroCardProps> = ({
    date,
    title,
    description,
    imageUrl,
    imageAlt,
    className,
}) => {
    return (
        <article className={cn('overflow-hidden bg-duyang-black', className)}>
            <div className="grid grid-cols-1 lg:grid-cols-12">
                <div className="flex flex-col gap-8 px-6 py-8 lg:col-span-8 lg:justify-center lg:px-12 lg:py-12">
                    <p className="text-p-18-regular text-duyang-grey-light">
                        {date}
                    </p>
                    <h3 className="text-h-32-bold text-duyang-white lg:text-h-56-bold">
                        {title}
                    </h3>
                    <p className="max-w-5xl text-p-18-regular text-duyang-grey-light">
                        {description}
                    </p>
                </div>
                <div className="h-72 lg:col-span-4 lg:h-full">
                    <img
                        src={imageUrl}
                        alt={imageAlt}
                        className="h-full w-full object-cover"
                    />
                </div>
            </div>
        </article>
    );
};

export default ArticleHeroCard;