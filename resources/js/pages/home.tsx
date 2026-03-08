import AppHead from '@/components/shared/app-head';
import Container from '@/components/shared/container';
import { Icons } from '@/components/shared/Icons';
import Section from '@/components/shared/section';
import AppLayout from '@/layouts/app-layout';
import { useTranslation } from 'react-i18next';

export default function Home() {
    const { t } = useTranslation();

    const features = [
        { icon: Icons.Leaf, label: t('home.features.sustainableMaterials') },
        { icon: Icons.Couch, label: t('home.features.designForLife') },
        { icon: Icons.Hammer, label: t('home.features.craftedByExperts') },
        { icon: Icons.Truck, label: t('home.features.convenientDelivery') },
    ];
    return (
        <AppLayout>
            <AppHead />

            {/* About & Values */}
            <Section>
                <Container>
                    <div className="grid grid-cols-1 items-center gap-12 md:grid-cols-2 md:gap-25">
                        {/* Factory image */}
                        <div className="overflow-hidden rounded-2xl">
                            <img
                                src="/images/factory.jpg"
                                alt={t('home.about.factoryAlt')}
                                className="h-full w-full object-cover"
                            />
                        </div>

                        {/* Content */}
                        <div className="flex flex-col gap-8">
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
                    </div>

                    {/* Feature cards */}
                    <div className="mt-12 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                        {features.map(({ icon: Icon, label }) => (
                            <div
                                key={label}
                                className="flex items-center gap-5"
                            >
                                <div className="bg-duyang-white p-4">
                                    <Icon
                                        size={28}
                                        className="shrink-0 text-duyang-grey-mid"
                                    />
                                </div>
                                <span className="text-p-16-medium whitespace-pre-line text-duyang-black lg:text-p-18-medium">
                                    {label}
                                </span>
                            </div>
                        ))}
                    </div>
                </Container>
            </Section>
        </AppLayout>
    );
}
