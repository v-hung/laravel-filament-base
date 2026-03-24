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
                'relative isolate h-full overflow-hidden bg-duyang-grey-mid',
                className,
            )}
            {...props}
        >
            <div
                className="absolute inset-0 bg-duyang-cream bg-cover bg-center bg-no-repeat"
                style={{ backgroundImage: `url(${image})` }}
            />
            <div className="absolute inset-0 bg-linear-to-r from-duyang-black/60 via-duyang-black/35 to-duyang-black/10" />

            <div className="relative flex min-h-80 flex-col justify-between gap-6 p-6 lg:max-w-110 lg:p-8">
                <h1 className="text-h-32-bold whitespace-pre-line text-duyang-white lg:text-h-40-bold">
                    {title}
                </h1>

                <p className="text-p-14-regular text-duyang-white lg:text-p-16-regular">
                    {description}
                </p>
            </div>
        </section>
    );
}
