import type { Media } from '@/types';
import type { FC } from 'react';

type Feature = {
    image?: Media;
    label?: string;
};

type AboutAndValuesProps = {
    label?: string;
    title?: string;
    description?: string;
    image?: Media;
    features?: Feature[];
};

const AboutAndValues: FC<AboutAndValuesProps> = ({
    label,
    title,
    description,
    image,
    features = [],
}) => {
    const visibleFeatures = features.filter((f) => f.label || f.image);

    return (
        <div>
            <div className="flex flex-col gap-10 lg:flex-row-reverse lg:gap-20">
                <div className="flex flex-1 flex-col gap-6 lg:py-4">
                    {label && (
                        <span className="text-p-16-regular text-duyang-grey lg:text-p-18-regular">
                            {label}
                        </span>
                    )}
                    {title && (
                        <h2 className="text-h-32-bold text-duyang-black lg:text-h-40-bold">
                            {title}
                        </h2>
                    )}
                    {description && (
                        <div className="flex flex-col gap-3 whitespace-pre-line">
                            <p className="text-p-14-regular text-duyang-grey lg:text-p-16-regular">
                                {description}
                            </p>
                        </div>
                    )}
                </div>

                {image && (
                    <div className="flex-1 overflow-hidden rounded">
                        <img
                            src={image.url}
                            className="h-80 min-h-full w-full bg-duyang-cream object-cover"
                        />
                    </div>
                )}
            </div>

            {visibleFeatures.length > 0 && (
                <div className="grid grid-cols-2 gap-8 pt-12 lg:grid-cols-4 lg:pt-16">
                    {visibleFeatures.map((feature, index) => (
                        <div
                            key={index}
                            className="flex flex-col items-center gap-3 text-center lg:flex-row lg:gap-6 lg:text-start"
                        >
                            {feature.image && (
                                <div className="flex h-14 w-14 flex-none items-center justify-center overflow-hidden rounded bg-duyang-white">
                                    <img
                                        src={feature.image.url}
                                        alt={feature.label ?? ''}
                                        className="h-full w-full object-cover"
                                    />
                                </div>
                            )}
                            {feature.label && (
                                <span className="text-p-14-medium text-duyang-black lg:text-p-18-medium">
                                    {feature.label}
                                </span>
                            )}
                        </div>
                    ))}
                </div>
            )}
        </div>
    );
};

export default AboutAndValues;
