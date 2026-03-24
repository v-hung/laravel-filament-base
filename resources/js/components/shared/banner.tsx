import { type HTMLAttributes } from 'react';

import { cn } from '@/lib/utils/cn';

export type BannerProps = HTMLAttributes<HTMLElement> & {
    image?: string;
    title?: string;
    description?: string;
};

export default function Banner({
    image,
    title,
    description,
    className,
    ...props
}: BannerProps) {
    return (
        <section
            className={cn(
                'relative isolate overflow-hidden bg-duyang-grey-mid',
                className,
            )}
            {...props}
        >
            <div
                className="absolute inset-0 bg-duyang-cream bg-cover bg-center bg-no-repeat"
                style={{ backgroundImage: `url(${image})` }}
            />
            <div className="absolute inset-0 bg-linear-to-r from-duyang-black/60 via-duyang-black/35 to-duyang-black/10" />

            <div className="relative flex min-h-105 flex-col justify-between px-6 py-8 md:min-h-140 md:px-12 md:py-12 lg:min-h-175 lg:px-20 lg:py-16">
                <h1 className="max-w-[20rem] text-h-40-bold whitespace-pre-line text-duyang-white md:max-w-136 md:text-h-56-bold">
                    {title}
                </h1>

                <p className="max-w-5xl text-p-16-regular text-duyang-white md:text-p-18-regular">
                    {description}
                </p>
            </div>
        </section>
    );
}
