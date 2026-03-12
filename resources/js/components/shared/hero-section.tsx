import { cn } from '@/lib/utils/cn';
import React from 'react';
import { useFormat } from '@/lib/utils/date';
import AppHead from './app-head';
import Section from './section';
import Container from './container';

export type HeroSectionProps = React.HTMLAttributes<HTMLDivElement> & {
    title: string;
    description?: string;
    date?: Date | string;
    image?: string;
};

const HeroSection: React.FC<HeroSectionProps> = (props) => {
    const { className = '', title, date, description, image, ...rest } = props;
    const { format } = useFormat();

    return (
        <Section
            {...rest}
            className={cn('flex flex-col pt-0 lg:pt-0', className)}
        >
            <AppHead title={title} />
            <Container>
                <div
                    className={`flex flex-col items-start justify-between gap-6 py-8 lg:flex-row lg:py-14 ${date ? 'lg:items-end' : 'lg:items-center'}`}
                >
                    <h2 className="text-h-56-bold">{title}</h2>
                    <p className="max-w-80 text-p-16-regular text-duyang-grey capitalize">
                        {date ? format(date, 'MMMM dd.yyyy') : description}
                    </p>
                </div>
            </Container>
            <img
                src={image}
                alt="News"
                className="h-60 w-full bg-duyang-cream object-cover md:h-90 lg:h-125"
            />
        </Section>
    );
};

export default HeroSection;
