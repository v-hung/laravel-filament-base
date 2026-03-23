import Container from '@/components/shared/container';
import Section from '@/components/shared/section';
import type { Media } from '@/types';
import type { CSSProperties, FC } from 'react';

type Banner2SectionProps = {
    data?: { title?: string; description?: string; image?: Media };
};

const Banner2Section: FC<Banner2SectionProps> = ({ data }) => {
    const bgStyle: CSSProperties | undefined = data?.image?.url
        ? { backgroundImage: `url(${data.image.url})` }
        : undefined;

    return (
        <Section>
            <Container>
                <div className="relative bg-cover" style={bgStyle}>
                    <div className="absolute inset-0 bg-black/50 from-black/60 via-black/20 to-transparent lg:bg-transparent lg:bg-linear-to-r" />
                    <div className="relative w-full p-6 text-white lg:w-1/2 lg:p-10">
                        <h3 className="text-h-32-bold drop-shadow lg:text-h-56-bold">
                            {data?.title}
                        </h3>
                        {data?.description && (
                            <p className="pt-10 text-p-14-regular drop-shadow lg:text-p-16-regular">
                                {data.description}
                            </p>
                        )}
                    </div>
                </div>
            </Container>
        </Section>
    );
};

export default Banner2Section;
