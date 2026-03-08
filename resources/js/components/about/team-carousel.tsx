import React, { useEffect, useState } from 'react';
import {
    Carousel,
    CarouselContent,
    CarouselItem,
    useCarousel,
} from '../ui/carousel';

const members = [
    {
        name: 'Jakub Pettersen',
        role: 'Tổng Giám Đốc',
        image: '/images/about.jpg',
    },
    { name: 'Nguyen Van A', role: 'Thiết Kế', image: '/images/about.jpg' },
    { name: 'Daniel Rojas', role: 'Kỹ Thuật Viên', image: '/images/about.jpg' },
    { name: 'Lucas Chen', role: 'Vận Hành', image: '/images/about.jpg' },
];

function CarouselControls() {
    const { scrollPrev, scrollNext, canScrollPrev, canScrollNext } =
        useCarousel();

    return (
        <div className="flex gap-2">
            <button
                onClick={scrollPrev}
                disabled={!canScrollPrev}
                aria-label="Previous"
                className="flex h-10 w-10 items-center justify-center border border-duyang-black text-duyang-black transition-opacity disabled:opacity-30"
            >
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path
                        d="M10 3L5 8L10 13"
                        stroke="currentColor"
                        strokeWidth="1.5"
                        strokeLinecap="round"
                        strokeLinejoin="round"
                    />
                </svg>
            </button>
            <button
                onClick={scrollNext}
                disabled={!canScrollNext}
                aria-label="Next"
                className="flex h-10 w-10 items-center justify-center border border-duyang-black text-duyang-black transition-opacity disabled:opacity-30"
            >
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path
                        d="M6 3L11 8L6 13"
                        stroke="currentColor"
                        strokeWidth="1.5"
                        strokeLinecap="round"
                        strokeLinejoin="round"
                    />
                </svg>
            </button>
        </div>
    );
}

function CarouselDots() {
    const { api } = useCarousel();
    const [current, setCurrent] = useState(0);
    const [count, setCount] = useState(0);

    useEffect(() => {
        if (!api) return;
        setCount(api.scrollSnapList().length);
        setCurrent(api.selectedScrollSnap());
        api.on('select', () => setCurrent(api.selectedScrollSnap()));
    }, [api]);

    if (count <= 1) return null;

    return (
        <div className="mt-8 flex justify-center gap-2">
            {Array.from({ length: count }).map((_, i) => (
                <button
                    key={i}
                    onClick={() => api?.scrollTo(i)}
                    aria-label={`Go to slide ${i + 1}`}
                    className={`h-1.5 transition-all duration-300 ${i === current ? 'w-6 bg-duyang-black' : 'w-1.5 bg-duyang-grey-light'}`}
                />
            ))}
        </div>
    );
}

const TeamCarousel = () => {
    return (
        <Carousel opts={{ align: 'start' }}>
            <div className="mb-12 flex items-center justify-between lg:mb-16">
                <h2 className="text-h-32-bold text-duyang-black lg:text-h-40-bold">
                    Gặp Gỡ Những Người Phát Triển
                </h2>
                <CarouselControls />
            </div>

            <CarouselContent className="-ml-6 lg:-ml-8">
                {members.map((member) => (
                    <CarouselItem
                        key={member.name}
                        className="basis-full pl-6 md:basis-1/2 lg:basis-1/4 lg:pl-8"
                    >
                        <div className="relative flex flex-col gap-3">
                            <div className="relative aspect-295/320 w-full transition-all hover:static">
                                <div className="group absolute top-0 left-0 h-full w-full overflow-hidden transition-all">
                                    <img
                                        src={member.image}
                                        alt={member.name}
                                        className="h-full w-full bg-duyang-cream object-cover object-top transition-all"
                                    />
                                    <div className="absolute bottom-3 left-3 flex gap-2 opacity-0 transition-opacity duration-200 group-hover:opacity-100">
                                        {['IG', 'IN', 'FB'].map((platform) => (
                                            <button
                                                key={platform}
                                                className="bg-duyang-white px-2.5 py-1.5 text-btn-14 text-duyang-black"
                                            >
                                                {platform}
                                            </button>
                                        ))}
                                    </div>
                                </div>
                            </div>
                            <div className="flex flex-col gap-2">
                                <span className="text-p-14-regular text-duyang-grey">
                                    {member.role}
                                </span>
                                <span className="text-p-18-bold text-duyang-black lg:text-h-22-bold">
                                    {member.name}
                                </span>
                            </div>
                        </div>
                    </CarouselItem>
                ))}
            </CarouselContent>

            <CarouselDots />
        </Carousel>
    );
};

export default TeamCarousel;
