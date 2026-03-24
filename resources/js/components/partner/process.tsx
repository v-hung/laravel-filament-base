import type { ProcessFeature, SectionData } from '@/pages/site/partner';

type ProcessProps = SectionData & {
    features?: ProcessFeature[];
};

const Process = ({ title, description, image, features = [] }: ProcessProps) => {
    return (
        <div className="flex flex-col gap-12 surface-page p-10 lg:gap-20 lg:p-16">
            <div className="flex flex-col gap-10 lg:flex-row lg:gap-20">
                <div className="flex flex-1 flex-col gap-6">
                    {title && (
                        <h2 className="text-h-32-bold text-duyang-black lg:text-h-40-bold">
                            {title}
                        </h2>
                    )}
                    {description && (
                        <p className="text-p-16-regular whitespace-pre-line text-duyang-grey">
                            {description}
                        </p>
                    )}
                </div>
                {image?.url && (
                    <div className="flex-1 overflow-hidden rounded">
                        <img
                            src={image.url}
                            className="h-full min-h-80 w-full object-cover"
                        />
                    </div>
                )}
            </div>

            {features.length > 0 && (
                <div className="grid grid-cols-2 gap-8 lg:grid-cols-4">
                    {features.map((feature, index) => (
                        <div
                            key={index}
                            className="flex flex-col items-center gap-3 text-center lg:flex-row lg:gap-6 lg:text-start"
                        >
                            {feature.image && (
                                <div className="flex h-14 w-14 shrink-0 items-center justify-center rounded bg-duyang-white text-duyang-black">
                                    <img
                                        src={feature.image.url}
                                        alt={feature.title ?? ''}
                                        className="h-7 w-7 object-contain"
                                    />
                                </div>
                            )}
                            <span className="text-p-14-medium text-duyang-black lg:text-p-18-medium">
                                {feature.title}
                            </span>
                        </div>
                    ))}
                </div>
            )}
        </div>
    );
};

export default Process;
