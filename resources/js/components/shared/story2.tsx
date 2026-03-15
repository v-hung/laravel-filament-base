import DuButton from './du-button';

export type Story2Props = {
    title: string;
    description: string;
    image: string;
    buttonText?: string;
};

const Story2: React.FC<Story2Props> = ({
    title,
    description,
    image,
    buttonText,
}) => {
    return (
        <div className="grid grid-cols-1 overflow-hidden rounded bg-duyang-white lg:grid-cols-2">
            <div className="flex flex-col gap-6 bg-duyang-cream p-10 lg:p-16">
                <h2 className="text-h-40-bold text-duyang-black lg:text-h-56-bold">
                    {title}
                </h2>
                <p className="text-p-16-regular whitespace-pre-line text-duyang-grey">
                    {description}
                </p>
                {buttonText && <DuButton size="lg">{buttonText}</DuButton>}
            </div>
            <div className="min-h-80 lg:min-h-0">
                <img
                    src={image}
                    alt="Sự phát triển của DUYANG VIETNAM"
                    className="h-full w-full bg-duyang-cream object-cover"
                />
            </div>
        </div>
    );
};

export default Story2;
