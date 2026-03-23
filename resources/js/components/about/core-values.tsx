import { Icons } from '../shared/Icons';

type CoreValue = {
    title?: string;
    description?: string;
};

type CoreValuesProps = {
    title?: string;
    values?: CoreValue[];
};

const icons = [Icons.ClockCountdown, Icons.SealCheck, Icons.Leaf, Icons.UserFocus];

export default function CoreValues({ title, values = [] }: CoreValuesProps) {
    const list = values;

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
                    {list.map((value, i) => {
                        const Icon = icons[i % icons.length];
                        return (
                            <div key={i} className="flex w-full gap-4 border-duyang-grey-light/30 px-4 py-8 lg:w-1/2">
                                <div className="flex h-16 w-16 shrink-0 items-center justify-center bg-duyang-cream text-duyang-black lg:h-20 lg:w-20">
                                    <Icon className="h-7 w-7 lg:h-9 lg:w-9" />
                                </div>
                                <div className="flex flex-col gap-2">
                                    <h3 className="text-h-20-semibold text-duyang-black lg:text-h-24-bold">
                                        {value.title}
                                    </h3>
                                    <p className="text-p-14-regular text-duyang-grey lg:text-p-16-regular">
                                        {value.description}
                                    </p>
                                </div>
                            </div>
                        );
                    })}
                </div>
            </div>
        </div>
    );
}
