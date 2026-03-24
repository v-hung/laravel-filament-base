import Container from '@/components/shared/container';
import Section from '@/components/shared/section';
import type { Media } from '@/types';
import type { FC } from 'react';

type AboutSectionProps = {
    data?: {
        label?: string;
        title?: string;
        description?: string;
        image?: Media;
        features?: { label?: string; image?: Media }[];
    };
};

const AboutSection: FC<AboutSectionProps> = ({ data }) => {
    const features = (data?.features ?? []).filter((f) => f.label || f.image);

    return (
        <Section className="bg-duyang-cream">
            <Container>
                <div className="flex flex-col gap-10 lg:flex-row-reverse lg:gap-20">
                    <div className="flex flex-1 flex-col gap-6 lg:py-4">
                        {data?.label && (
                            <span className="text-p-16-regular text-duyang-grey lg:text-p-18-regular">
                                {data.label}
                            </span>
                        )}
                        {data?.title && (
                            <h2 className="text-h-32-bold text-duyang-black lg:text-h-40-bold">
                                {data.title}
                            </h2>
                        )}
                        {data?.description && (
                            <p className="text-p-14-regular whitespace-pre-line text-duyang-grey lg:text-p-16-regular">
                                {data.description}
                            </p>
                        )}
                    </div>

                    {data?.image && (
                        <div className="flex-1 overflow-hidden rounded">
                            <img
                                src={data.image.url}
                                className="h-80 min-h-full w-full bg-duyang-cream object-cover"
                            />
                        </div>
                    )}
                </div>

                {features.length > 0 && (
                    <div className="grid grid-cols-2 gap-8 pt-12 lg:grid-cols-4 lg:pt-16">
                        {features.map((feature, index) => (
                            <div
                                key={index}
                                className="flex flex-col items-center gap-3 text-center lg:flex-row lg:gap-6 lg:text-start"
                            >
                                {feature.image && (
                                    <div className="flex h-14 w-14 flex-none items-center justify-center overflow-hidden rounded bg-duyang-white p-3 lg:h-16 lg:w-16 lg:p-4">
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
            </Container>
        </Section>
    );
};

export default AboutSection;
