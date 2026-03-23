import InspirationGallery from '@/components/shared/inspiration-gallery';
import Container from '@/components/shared/container';
import Section from '@/components/shared/section';
import type { FC } from 'react';

type InspirationSectionProps = {
    data?: { title?: string };
};

const InspirationSection: FC<InspirationSectionProps> = ({ data }) => (
    <Section>
        <Container>
            <div className="mb-12 lg:mb-16">
                <h2 className="text-h-32-bold text-duyang-black lg:text-center lg:text-h-40-bold">
                    {data?.title}
                </h2>
            </div>
            <InspirationGallery />
        </Container>
    </Section>
);

export default InspirationSection;
