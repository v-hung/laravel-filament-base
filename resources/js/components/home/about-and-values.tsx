import { Icons } from '../shared/Icons';
import { useTranslation } from 'react-i18next';

const AboutAndValues = () => {
    const { t } = useTranslation();

    const processFeatures = [
        { icon: Icons.Leaf, label: t('home.features.sustainableMaterials') },
        { icon: Icons.Couch, label: t('home.features.designForLife') },
        { icon: Icons.Hammer, label: t('home.features.craftedByExperts') },
        { icon: Icons.Truck, label: t('home.features.convenientDelivery') },
    ];
    return (
        <div>
            <div className="flex flex-col gap-10 lg:flex-row-reverse lg:gap-20">
                <div className="flex flex-1 flex-col gap-6 lg:py-4">
                    <span className="text-p-16-regular text-duyang-grey lg:text-p-18-regular">
                        {t('home.about.label')}
                    </span>
                    <h2 className="text-h-32-bold text-duyang-black lg:text-h-40-bold">
                        {t('home.about.title')}
                    </h2>
                    <div className="flex flex-col gap-3 whitespace-pre-line">
                        <p className="text-p-14-regular text-duyang-grey lg:text-p-16-regular">
                            {t('home.about.description')}
                        </p>
                    </div>
                </div>

                <div className="flex-1 overflow-hidden rounded">
                    <img
                        src="/assets/images/home/home-about.jpg"
                        className="h-80 min-h-full w-full bg-duyang-cream object-cover"
                    />
                </div>
            </div>

            {/* Feature cards */}
            <div className="grid grid-cols-2 gap-8 pt-12 lg:grid-cols-4 lg:pt-16">
                {processFeatures.map((feature, index) => {
                    const Icon = feature.icon;
                    return (
                        <div
                            key={index}
                            className="flex flex-col items-center gap-3 text-center lg:flex-row lg:gap-6 lg:text-start"
                        >
                            <div className="flex h-14 w-14 flex-none items-center justify-center rounded bg-duyang-white text-duyang-black">
                                <Icon size={28} />
                            </div>
                            <span className="text-p-14-medium text-duyang-black lg:text-p-18-medium">
                                {feature.label}
                            </span>
                        </div>
                    );
                })}
            </div>
        </div>
    );
};

export default AboutAndValues;
