import type { FC } from 'react';

import { cn } from '@/lib/utils/cn';

export type StoryProps = {
    title: string;
    content: string;
    imageSrc: string;
    imageAlt?: string;
    className?: string;
};

const Story: FC<StoryProps> = ({
    title,
    content,
    imageSrc,
    imageAlt = '',
    className,
}) => {
    return (
        <section
            className={cn(
                'bg-duyang-black px-6 py-10 md:px-10 md:py-14 lg:px-16 lg:py-16',
                className,
            )}
        >
            <div className="mx-auto grid max-w-400 grid-cols-1 items-center gap-8 lg:grid-cols-2 lg:gap-12">
                <div className="flex flex-col gap-6 lg:pr-6">
                    <h2 className="text-h-56-bold text-duyang-black">
                        {title}
                    </h2>
                    <p className="text-p-18-semibold whitespace-pre-line text-duyang-grey">
                        {content}
                    </p>
                </div>

                <div className="overflow-hidden rounded-xl">
                    <img
                        src={imageSrc}
                        alt={imageAlt}
                        className="h-full w-full object-cover"
                    />
                </div>
            </div>
        </section>
    );
};

export default Story;
