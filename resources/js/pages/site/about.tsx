import CoreValues from '@/components/about/core-values';
import TeamCarousel from '@/components/about/team-carousel';
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

export type TeamMember = {
    name?: string;
    role?: string;
    image?: Media;
    social_links?: Record<string, string>;
};

type AboutProps = {
    sections?: Translatable<{
        hero?: SectionData;
        who_we_are?: SectionData;
        vision?: SectionData;
        mission?: SectionData;
        development?: SectionData;
        team?: {
            title?: string;
            members?: TeamMember[];
        };
        core_values?: {
            title?: string;
            values?: { title?: string; description?: string }[];
        };
    }>;
};

export default function About({ sections }: AboutProps) {
    const tv = useTransValue();
    const sectionsTrans = tv(sections);

    console.log({ sectionsTrans });

    return (
        <AppLayout>
            {/* Hero Section */}
            <HeroSection
                title={sectionsTrans?.hero?.title ?? ''}
                description={sectionsTrans?.hero?.description}
                image={sectionsTrans?.hero?.image?.url}
            />

            {/* Company Overview */}
            <Section>
                <Container className="flex flex-col gap-10 lg:gap-20">
                    <Story
                        title={sectionsTrans?.who_we_are?.title}
                        description={sectionsTrans?.who_we_are?.description}
                        image={sectionsTrans?.who_we_are?.image?.url}
                    />
                </Container>
            </Section>

            {/* Vision */}
            <Section>
                <Container className="flex flex-col gap-10 lg:gap-20">
                    <Story
                        title={sectionsTrans?.vision?.title}
                        description={sectionsTrans?.vision?.description}
                        image={sectionsTrans?.vision?.image?.url}
                        reverse
                    />
                </Container>
            </Section>

            {/* Mission Section */}
            <Section>
                <Container className="flex flex-col gap-10 lg:gap-20">
                    <Story
                        title={sectionsTrans?.mission?.title}
                        description={sectionsTrans?.mission?.description}
                        image={sectionsTrans?.mission?.image?.url}
                    />
                </Container>
            </Section>

            {/* Team Carousel Section */}
            <Section>
                <Container>
                    <TeamCarousel
                        title={sectionsTrans?.team?.title}
                        members={sectionsTrans?.team?.members}
                    />
                </Container>
            </Section>

            {/* Core Values Section */}
            <Section>
                <Container>
                    <CoreValues
                        title={sectionsTrans?.core_values?.title}
                        values={sectionsTrans?.core_values?.values}
                    />
                </Container>
            </Section>

            {/* Development Section */}

            <Section className="mb-10 lg:mb-16">
                <Container>
                    <Story2
                        title={sectionsTrans?.development?.title}
                        description={sectionsTrans?.development?.description}
                        image={sectionsTrans?.development?.image?.url}
                    />
                </Container>
            </Section>
        </AppLayout>
    );
}
