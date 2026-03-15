interface StoryProps {
    title?: string;
    description: string;
    image: string;
    imageAlt?: string;
    reverse?: boolean;
}

export default function Story({
    title,
    description,
    image,
    imageAlt,
    reverse = false,
}: StoryProps) {
    return (
        <div
            className={`flex flex-col gap-10 lg:gap-20 ${reverse ? 'lg:flex-row-reverse' : 'lg:flex-row'}`}
        >
            <div className="flex flex-1 flex-col gap-6">
                {title && (
                    <h2 className="text-h-32-bold text-duyang-black lg:text-h-40-bold">
                        {title}
                    </h2>
                )}
                <p className="text-p-16-regular whitespace-pre-line text-duyang-grey">
                    {description}
                </p>
            </div>
            <div className="flex-1 overflow-hidden rounded">
                <img
                    src={image}
                    alt={imageAlt}
                    className="h-80 min-h-full w-full bg-duyang-cream object-cover"
                />
            </div>
        </div>
    );
}
