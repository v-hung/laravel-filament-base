import Container from '@/components/shared/container';
import DuButton from '@/components/shared/du-button';
import Section from '@/components/shared/section';
import { partner } from '@/routes';
import type { Media } from '@/types';
import { Link } from '@inertiajs/react';
import type { CSSProperties, FC } from 'react';

type CtaSectionProps = {
    data?: { title?: string; description?: string; image?: Media };
};

const CtaSection: FC<CtaSectionProps> = ({ data }) => {
    const bgStyle: CSSProperties | undefined = data?.image?.url
        ? { backgroundImage: `url(${data.image.url})` }
        : undefined;

    return (
        <Section className="relative bg-cover" style={bgStyle}>
            <div className="absolute inset-0 bg-black/50 from-black/60 via-black/20 to-transparent lg:bg-transparent lg:bg-linear-to-r" />
            <Container className="relative">
                <div className="w-full text-white lg:w-1/2">
                    <h3 className="text-h-32-bold drop-shadow lg:text-h-56-bold">
                        {data?.title}
                    </h3>
                    {data?.description && (
                        <p className="pt-6 text-p-14-regular drop-shadow lg:text-p-16-regular">
                            {data.description}
                        </p>
                    )}
                    <DuButton color="white" className="mt-16 lg:mt-26">
                        <Link href={partner().url}>Xem ngay</Link>
                    </DuButton>
                </div>
            </Container>
        </Section>
    );
};

export default CtaSection;
