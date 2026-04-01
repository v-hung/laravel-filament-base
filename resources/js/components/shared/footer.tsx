import { Link, router } from '@inertiajs/react';
import type { FC } from 'react';
import { useTranslation } from 'react-i18next';

import { cn } from '@/lib/utils/cn';
import { contact } from '@/routes';

import BrandLogo from './brand-logo';
import Container from './container';
import DuButton from './du-button';
import { useSettingStore } from '@/stores/setting';
import { useTransValue } from '@/lib/utils/trans-value';
import { useMenuStore } from '@/stores/menu';
import type { MenuNavItem } from '@/types';

function FooterSectionColumn({
    section,
    className,
}: {
    section: MenuNavItem;
    className?: string;
}) {
    const tv = useTransValue();

    return (
        <div
            className={cn(
                'flex flex-col gap-6 md:row-span-2 md:grid md:grid-rows-subgrid',
                className,
            )}
        >
            <h4 className="text-h-20-bold text-duyang-white lg:text-h-22-bold">
                {tv(section.title)}
            </h4>
            <ul className="flex flex-wrap gap-5 md:flex-col md:flex-nowrap">
                {section.children.map((item) => {
                    const isExternal =
                        item.url?.startsWith('http') ||
                        item.url?.startsWith('mailto:') ||
                        item.url?.startsWith('tel:');

                    const Component = isExternal ? 'a' : Link;

                    return (
                        <li key={item.id}>
                            <Component
                                href={item.url || '#'}
                                target={item.target}
                                className="text-btn-14 text-duyang-grey-light transition-colors hover:text-duyang-white lg:text-btn-16"
                            >
                                {tv(item.title)}
                            </Component>
                        </li>
                    );
                })}
            </ul>
        </div>
    );
}

function NewsletterSection({
    className,
    siteName,
}: {
    className?: string;
    siteName: string;
}) {
    const { t } = useTranslation();

    const handleSubmit = (e: React.SubmitEvent<HTMLFormElement>) => {
        e.preventDefault();
        const email = e.currentTarget.email.value;
        if (email) {
            router.get(contact().url, { email });
        }
    };

    return (
        <div
            className={cn(
                'flex flex-col gap-4 md:row-span-2 md:grid md:grid-rows-subgrid',
                className,
            )}
        >
            <h4 className="text-h-20-bold text-duyang-white lg:text-h-22-bold">
                {t('footer.newsletter.title', { siteName })}
            </h4>
            <div className="flex flex-col gap-4">
                <p className="text-p-14-regular text-duyang-grey-light lg:text-p-16-regular">
                    {t('footer.newsletter.description')}
                </p>
                <form
                    className="mt-6 flex items-end gap-3"
                    onSubmit={handleSubmit}
                >
                    <input
                        type="email"
                        placeholder={t('common.email')}
                        name="email"
                        className="flex-1 border-b border-duyang-grey-light bg-transparent pb-2 text-p-14-regular text-duyang-white transition-colors outline-none placeholder:text-duyang-grey-light focus:border-duyang-white lg:text-p-16-regular"
                        required
                    />
                    <DuButton type="submit" variant="solid" color="white">
                        {t('common.subscribe')}
                    </DuButton>
                </form>
            </div>
        </div>
    );
}

export const Footer: FC = () => {
    const { t } = useTranslation();
    const tv = useTransValue();
    const footerMenu = useMenuStore((state) => state.footerMenu);
    const siteName = useSettingStore((state) => state.shopSettings.site_name);

    console.log({ footerMenu });

    return (
        <footer className="bg-duyang-black">
            <Container>
                <div className="pt-12 pb-12 md:pt-16 md:pb-14">
                    {/* Mobile-only logo at top */}
                    <div className="mb-8 md:hidden">
                        <BrandLogo white />
                    </div>
                    {/* Link columns + Newsletter */}
                    <div className="grid grid-cols-1 gap-8 md:grid-cols-2 md:gap-10 lg:grid-cols-8 xl:grid-cols-12">
                        {footerMenu.map((section) => (
                            <FooterSectionColumn
                                key={section.id}
                                section={section}
                                className="lg:col-span-2"
                            />
                        ))}
                        <NewsletterSection
                            className="md:col-span-2 lg:col-span-8 xl:col-span-4"
                            siteName={tv(siteName)}
                        />
                    </div>
                </div>

                {/* Separator */}
                <div className="border-t border-duyang-grey-light/30" />

                {/* Bottom bar */}
                <div className="py-6 lg:py-10">
                    <div className="flex flex-col items-center gap-4 md:flex-row md:justify-between">
                        {/* Logo — desktop only (mobile logo is at top) */}
                        <div className="hidden lg:block">
                            <BrandLogo white />
                        </div>
                        <div className="flex flex-wrap justify-center gap-4 md:gap-8 lg:justify-normal lg:gap-12">
                            <p className="text-p-14- text-center text-duyang-white lg:text-p-16-semibold">
                                {t('common.copyright', {
                                    year: new Date().getFullYear(),
                                    siteName: tv(siteName),
                                })}
                            </p>
                            <a
                                href="#"
                                className="text-p-14-regular text-duyang-cream transition-colors hover:text-duyang-white lg:text-p-16-regular"
                            >
                                {t('common.privacyPolicy')}
                            </a>
                            <a
                                href="#"
                                className="text-p-14-regular text-duyang-cream transition-colors hover:text-duyang-white lg:text-p-16-regular"
                            >
                                {t('common.termsOfService')}
                            </a>
                        </div>
                    </div>
                </div>
            </Container>
        </footer>
    );
};

export default Footer;
