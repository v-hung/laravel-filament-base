import CoreValues from '@/components/about/core-values';
import TeamCarousel from '@/components/about/team-carousel';
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

type AboutProps = {
    sections?: {
        hero?: SectionData;
        who_we_are?: SectionData;
        vision?: SectionData;
        mission?: SectionData;
        development?: SectionData;
        team?: {
            title?: string;
            members?: { name?: string; role?: string; image?: Media }[];
        };
        core_values?: {
            title?: string;
            values?: { title?: string; description?: string }[];
        };
    };
};

export default function About({ sections }: AboutProps) {
    const hero = sections?.hero;
    const whoWeAre = sections?.who_we_are;
    const vision = sections?.vision;
    const mission = sections?.mission;
    const development = sections?.development;
    const team = sections?.team;
    const coreValues = sections?.core_values;

    const hasStories =
        (whoWeAre?.description && whoWeAre?.image) ||
        (vision?.description && vision?.image) ||
        (mission?.description && mission?.image);

    return (
        <AppLayout>
            {/* Hero Section */}
            {hero?.title && (
                <HeroSection
                    title={hero.title}
                    description={hero.description}
                    image={hero.image?.url}
                />
            )}

            {/* Company Overview, Vision, Mission Section */}
            {hasStories && (
                <Section>
                    <Container className="flex flex-col gap-10 lg:gap-20">
                        {whoWeAre?.description && whoWeAre?.image && (
                            <Story
                                title={whoWeAre.title}
                                description={whoWeAre.description}
                                image={whoWeAre.image.url}
                            />
                        )}
                        {vision?.description && vision?.image && (
                            <Story
                                title={vision.title}
                                description={vision.description}
                                image={vision.image.url}
                                reverse
                            />
                        )}
                        {mission?.description && mission?.image && (
                            <Story
                                title={mission.title}
                                description={mission.description}
                                image={mission.image.url}
                            />
                        )}
                    </Container>
                </Section>
            )}

            {/* Team Carousel Section */}
            {team?.members && team.members.length > 0 && (
                <Section>
                    <Container>
                        <TeamCarousel title={team.title} members={team.members} />
                    </Container>
                </Section>
            )}

            {/* Core Values Section */}
            {(coreValues?.title || (coreValues?.values && coreValues.values.length > 0)) && (
                <Section>
                    <Container>
                        <CoreValues title={coreValues.title} values={coreValues.values} />
                    </Container>
                </Section>
            )}

            {/* Development Section */}
            {development?.title && development?.description && development?.image && (
                <Section className="mb-10 lg:mb-16">
                    <Container>
                        <Story2
                            title={development.title}
                            description={development.description}
                            image={development.image.url}
                        />
                    </Container>
                </Section>
            )}
        </AppLayout>
    );
}
