import CoreValues from '@/components/about/core-values';
import Process from '@/components/partner/process';
import Stats from '@/components/partner/stats';
import Container from '@/components/shared/container';
import HeroSection from '@/components/shared/hero-section';
import Section from '@/components/shared/section';
import Story from '@/components/shared/story';
import Story2 from '@/components/shared/story2';
import AppLayout from '@/layouts/app-layout';
import type { Media } from '@/types';

type SectionData = {
    title?: string;
    description?: string;
    image?: Media;
};

type PartnerProps = {
    sections?: {
        hero?: SectionData;
        innovation?: SectionData;
        stats?: {
            items?: { value?: string; unit?: string; label?: string }[];
        };
        direction?: SectionData;
        core_values?: {
            title?: string;
            values?: { title?: string; description?: string }[];
        };
        design?: SectionData;
        improvement?: SectionData & { button_text?: string };
        materials?: SectionData;
        process?: SectionData & {
            features?: { title?: string }[];
        };
    };
};

const Partner = ({ sections }: PartnerProps) => {
    const hero = sections?.hero;
    const innovation = sections?.innovation;
    const stats = sections?.stats;
    const direction = sections?.direction;
    const coreValues = sections?.core_values;
    const design = sections?.design;
    const improvement = sections?.improvement;
    const materials = sections?.materials;
    const process = sections?.process;

    return (
        <AppLayout>
            {hero?.title && (
                <HeroSection
                    title={hero.title}
                    description={hero.description}
                    image={hero.image?.url}
                />
            )}

            {innovation?.title && innovation?.description && innovation?.image && (
                <Section>
                    <Container>
                        <Story
                            title={innovation.title}
                            description={innovation.description}
                            image={innovation.image.url}
                        />
                    </Container>
                </Section>
            )}

            {stats?.items && stats.items.length > 0 && (
                <Section>
                    <Container>
                        <Stats items={stats.items} />
                    </Container>
                </Section>
            )}

            {direction?.title && direction?.description && direction?.image && (
                <Section>
                    <Container>
                        <Story
                            title={direction.title}
                            description={direction.description}
                            image={direction.image.url}
                        />
                    </Container>
                </Section>
            )}

            {(coreValues?.title || (coreValues?.values && coreValues.values.length > 0)) && (
                <Section>
                    <Container>
                        <CoreValues title={coreValues?.title} values={coreValues?.values} />
                    </Container>
                </Section>
            )}

            {design?.title && design?.description && design?.image && (
                <Section>
                    <Container>
                        <Story
                            title={design.title}
                            description={design.description}
                            image={design.image.url}
                        />
                    </Container>
                </Section>
            )}

            {improvement?.title && improvement?.description && improvement?.image && (
                <Section>
                    <Container>
                        <Story2
                            title={improvement.title}
                            description={improvement.description}
                            buttonText={improvement.button_text}
                            image={improvement.image.url}
                        />
                    </Container>
                </Section>
            )}

            {materials?.title && materials?.description && materials?.image && (
                <Section>
                    <Container>
                        <Story
                            title={materials.title}
                            description={materials.description}
                            image={materials.image.url}
                            reverse
                        />
                    </Container>
                </Section>
            )}

            {(process?.title || process?.description || process?.image || (process?.features && process.features.length > 0)) && (
                <Section className="mb-10 lg:mb-16">
                    <Container>
                        <Process
                            title={process?.title}
                            description={process?.description}
                            image={process?.image}
                            features={process?.features}
                        />
                    </Container>
                </Section>
            )}
        </AppLayout>
    );
};

export default Partner;
