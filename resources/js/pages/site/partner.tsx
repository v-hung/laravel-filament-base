import CoreValues from '@/components/about/core-values';
import Process from '@/components/partner/process';
import Stats from '@/components/partner/stats';
import Container from '@/components/shared/container';
import HeroSection from '@/components/shared/hero-section';
import Section from '@/components/shared/section';
import Story from '@/components/shared/story';
import Story2 from '@/components/shared/story2';
import AppLayout from '@/layouts/app-layout';
import { useTransValue, type Translatable } from '@/lib/utils/trans-value';
import type { Media } from '@/types';

export type SectionData = {
    title?: string;
    description?: string;
    image?: Media;
};

export type StatItem = {
    value?: string;
    unit?: string;
    label?: string;
};

export type ProcessFeature = {
    image?: Media;
    title?: string;
};

type PartnerProps = {
    sections?: Translatable<{
        hero?: SectionData;
        innovation?: SectionData;
        stats?: {
            items?: StatItem[];
        };
        direction?: SectionData;
        core_values?: {
            title?: string;
            values?: { image?: Media; title?: string; description?: string }[];
        };
        design?: SectionData;
        improvement?: SectionData;
        materials?: SectionData;
        process?: SectionData & {
            features?: ProcessFeature[];
        };
    }>;
};

const Partner = ({ sections }: PartnerProps) => {
    const tv = useTransValue();
    const sectionsTrans = tv(sections);

    return (
        <AppLayout>
            <HeroSection
                title={sectionsTrans?.hero?.title ?? ''}
                description={sectionsTrans?.hero?.description}
                image={sectionsTrans?.hero?.image?.url}
            />

            <Section>
                <Container>
                    <Story
                        title={sectionsTrans?.innovation?.title}
                        description={sectionsTrans?.innovation?.description ?? ''}
                        image={sectionsTrans?.innovation?.image?.url ?? ''}
                    />
                </Container>
            </Section>

            <Section>
                <Container>
                    <Stats items={sectionsTrans?.stats?.items} />
                </Container>
            </Section>

            <Section>
                <Container>
                    <Story
                        title={sectionsTrans?.direction?.title}
                        description={sectionsTrans?.direction?.description ?? ''}
                        image={sectionsTrans?.direction?.image?.url ?? ''}
                    />
                </Container>
            </Section>

            <Section>
                <Container>
                    <CoreValues
                        title={sectionsTrans?.core_values?.title}
                        values={sectionsTrans?.core_values?.values}
                    />
                </Container>
            </Section>

            <Section>
                <Container>
                    <Story
                        title={sectionsTrans?.design?.title}
                        description={sectionsTrans?.design?.description ?? ''}
                        image={sectionsTrans?.design?.image?.url ?? ''}
                    />
                </Container>
            </Section>

            <Section>
                <Container>
                    <Story2
                        title={sectionsTrans?.improvement?.title ?? ''}
                        description={sectionsTrans?.improvement?.description ?? ''}
                        image={sectionsTrans?.improvement?.image?.url ?? ''}
                    />
                </Container>
            </Section>

            <Section>
                <Container>
                    <Story
                        title={sectionsTrans?.materials?.title}
                        description={sectionsTrans?.materials?.description ?? ''}
                        image={sectionsTrans?.materials?.image?.url ?? ''}
                        reverse
                    />
                </Container>
            </Section>

            <Section className="mb-10 lg:mb-16">
                <Container>
                    <Process
                        title={sectionsTrans?.process?.title}
                        description={sectionsTrans?.process?.description}
                        image={sectionsTrans?.process?.image}
                        features={sectionsTrans?.process?.features}
                    />
                </Container>
            </Section>
        </AppLayout>
    );
};

export default Partner;
