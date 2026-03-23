import type { Media } from '@/types';

type CoreValue = {
    title?: string;
    description?: string;
    image?: Media;
};

type CoreValuesProps = {
    title?: string;
    values?: CoreValue[];
};

export default function CoreValues({ title, values = [] }: CoreValuesProps) {
    return (
        <div className="flex flex-col gap-10 lg:flex-row lg:items-start lg:gap-20">
            <div className="shrink-0 lg:w-50">
                {title && (
                    <h2 className="text-h-32-bold text-duyang-black lg:text-h-56-bold">
                        {title}
                    </h2>
                )}
            </div>

            <div className="flex grow flex-col">
                <div className="-mx-4 -mb-4 flex flex-wrap lg:*:border-b-0! [&>*:not(:last-child)]:border-b lg:[&>*:not(:nth-last-child(-n+2))]:border-b!">
                    {values.map((value, i) => (
                        <div key={i} className="flex w-full gap-4 border-duyang-grey-light/30 px-4 py-8 lg:w-1/2">
                            {value.image && (
                                <div className="flex h-16 w-16 shrink-0 items-center justify-center bg-duyang-cream lg:h-20 lg:w-20">
                                    <img
                                        src={value.image.url}
                                        alt={value.title ?? ''}
                                        className="h-7 w-7 object-contain lg:h-9 lg:w-9"
                                    />
                                </div>
                            )}
                            <div className="flex flex-col gap-2">
                                <h3 className="text-h-20-semibold text-duyang-black lg:text-h-24-bold">
                                    {value.title}
                                </h3>
                                <p className="text-p-14-regular text-duyang-grey lg:text-p-16-regular">
                                    {value.description}
                                </p>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </div>
    );
}
