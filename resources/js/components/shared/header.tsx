import { Link, usePage, router } from '@inertiajs/react';
import { CheckIcon, ChevronDownIcon } from 'lucide-react';
import type { FC } from 'react';
import { useEffect, useRef, useState } from 'react';
import { useTranslation } from 'react-i18next';

import { cn } from '@/lib/utils/cn';
import { about, contact, home, partner, shop } from '@/routes';
import { CURRENT_LANGUAGE, type AppLocale } from '@/i18n/constants';
import { Dialog, DialogContent, DialogTrigger } from '@/components/ui/dialog';
import {
    Sheet,
    SheetContent,
    SheetTitle,
    SheetTrigger,
} from '@/components/ui/sheet';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';

import Container from './container';
import { Icons } from './Icons';
import DuInput from './du-input';
import BrandLogo from './brand-logo';

type NavItem = {
    label: string;
    href: string;
    children?: NavItem[];
};

type Language = {
    value: AppLocale;
    label: string;
    icon: FC<{ size?: number; className?: string }>;
};

function useNavItems(): NavItem[] {
    const { t } = useTranslation();
    return [
        { label: t('nav.home'), href: home().url },
        { label: t('nav.partner'), href: partner().url },
        {
            label: t('nav.shop'),
            href: shop().url,
            children: [
                {
                    label: t('footer.woodenHangers'),
                    href: shop().url + '?category=wooden-hangers',
                },
                {
                    label: t('footer.plasticHangers'),
                    href: shop().url + '?category=plastic-hangers',
                },
                {
                    label: t('footer.metalRacks'),
                    href: shop().url + '?category=metal-racks',
                },
            ],
        },
        { label: t('nav.about'), href: about().url },
        { label: t('nav.contact'), href: contact().url },
    ];
}

const LANGUAGES: Language[] = [
    { value: 'vi', label: 'VI', icon: Icons.Vi },
    { value: 'en', label: 'EN', icon: Icons.En },
];

// Desktop: dùng DropdownMenu của Radix (tự quản lý state & animation)
const DesktopNavItem: FC<{ item: NavItem; currentUrl: string }> = ({
    item,
    currentUrl,
}) => {
    const isActive = currentUrl.split('?')[0] === item.href;
    const baseLinkCls = cn(
        'px-1.5 py-2.5 text-btn-14 transition-colors lg:text-btn-16',
        isActive
            ? 'border-b border-duyang-grey-light text-duyang-black'
            : 'text-duyang-grey hover:text-duyang-black',
    );

    if (!item.children) {
        return (
            <Link href={item.href} className={baseLinkCls}>
                {item.label}
            </Link>
        );
    }

    return (
        <DropdownMenu>
            <DropdownMenuTrigger asChild>
                <button
                    type="button"
                    className={cn(baseLinkCls, 'flex items-center gap-1')}
                >
                    {item.label}
                    <ChevronDownIcon className="size-4 transition-transform duration-200 group-data-[state=open]:rotate-180" />
                </button>
            </DropdownMenuTrigger>
            <DropdownMenuContent
                align="start"
                sideOffset={8}
                className="min-w-44 rounded-none border border-duyang-grey-light bg-duyang-white p-1 shadow-sm"
            >
                {item.children.map((child) => (
                    <DropdownMenuItem key={child.label} asChild>
                        <Link
                            href={child.href}
                            className="cursor-pointer rounded-none px-3 py-2 text-p-14-medium text-duyang-grey transition-colors hover:bg-duyang-cream hover:text-duyang-black focus:bg-duyang-cream focus:text-duyang-black"
                        >
                            {child.label}
                        </Link>
                    </DropdownMenuItem>
                ))}
            </DropdownMenuContent>
        </DropdownMenu>
    );
};

// Mobile: accordion với CSS grid animation (không mount/unmount)
const MobileNavItem: FC<{
    item: NavItem;
    currentUrl: string;
    expanded: boolean;
    onToggle: () => void;
    onClose: () => void;
}> = ({ item, currentUrl, expanded, onToggle, onClose }) => {
    const isActive = currentUrl.split('?')[0] === item.href;
    const baseCls = 'py-2.5 text-p-14-semibold transition-colors';
    const activeCls = 'text-duyang-black';
    const inactiveCls = 'text-duyang-grey hover:text-duyang-black';

    if (!item.children) {
        return (
            <Link
                href={item.href}
                className={cn(
                    baseCls,
                    isActive
                        ? cn(activeCls, 'border-b border-duyang-grey-light')
                        : inactiveCls,
                )}
                onClick={onClose}
            >
                {item.label}
            </Link>
        );
    }

    return (
        <div>
            <button
                type="button"
                className={cn(
                    baseCls,
                    'flex w-full items-center justify-between',
                    isActive ? activeCls : inactiveCls,
                )}
                onClick={onToggle}
            >
                {item.label}
                <ChevronDownIcon
                    className={cn(
                        'size-4 transition-transform duration-300',
                        expanded && 'rotate-180',
                    )}
                />
            </button>

            {/* CSS grid trick: animates height without knowing exact px */}
            <div
                className={cn(
                    'grid transition-all duration-300 ease-in-out',
                    expanded
                        ? 'grid-rows-[1fr] opacity-100'
                        : 'grid-rows-[0fr] opacity-0',
                )}
            >
                <div className="overflow-hidden">
                    <div className="ml-3 flex flex-col border-l border-duyang-grey-light pb-1 pl-3">
                        {item.children.map((child) => (
                            <Link
                                key={child.label}
                                href={child.href}
                                className="py-2 text-p-14-medium text-duyang-grey transition-colors hover:text-duyang-black"
                                onClick={onClose}
                            >
                                {child.label}
                            </Link>
                        ))}
                    </div>
                </div>
            </div>
        </div>
    );
};

export type HeaderProps = {
    className?: string;
};

const Header: FC<HeaderProps> = ({ className }) => {
    const { t, i18n } = useTranslation();
    const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
    const [searchPopupOpen, setSearchPopupOpen] = useState(false);
    const [expandedMobileItem, setExpandedMobileItem] = useState<string | null>(
        null,
    );
    const headerRef = useRef<HTMLElement>(null);

    useEffect(() => {
        const el = headerRef.current;
        if (!el) return;

        const updateHeaderHeight = () => {
            const height = el.getBoundingClientRect().height;
            document.documentElement.style.setProperty(
                '--header-height',
                `${height}px`,
            );
        };

        updateHeaderHeight();

        const observer = new ResizeObserver(updateHeaderHeight);
        observer.observe(el);

        return () => observer.disconnect();
    }, []);

    const navItems = useNavItems();
    const { url, props } = usePage();
    const appLocale = (props.appLocale as AppLocale) || CURRENT_LANGUAGE;

    const language =
        (i18n.language as AppLocale) || appLocale || CURRENT_LANGUAGE;
    const selectedLanguage =
        LANGUAGES.find((item) => item.value === language) ?? LANGUAGES[0];

    const handleLanguageChange = async (locale: AppLocale) => {
        router.visit(`/greeting/${locale}`, {
            method: 'get',
            preserveState: true,
            onSuccess: () => {
                i18n.changeLanguage(locale);
            },
        });
    };

    const handleMobileClose = () => setMobileMenuOpen(false);

    const toggleMobileItem = (label: string) =>
        setExpandedMobileItem((prev) => (prev === label ? null : label));

    return (
        <header ref={headerRef} className={cn('bg-duyang-white', className)}>
            <Container>
                <div className="flex items-center justify-between py-4 lg:py-8">
                    {/* Left: Menu Icon + Logo */}
                    <div className="flex items-center gap-4">
                        <Sheet
                            open={mobileMenuOpen}
                            onOpenChange={setMobileMenuOpen}
                        >
                            <SheetTrigger asChild>
                                <button
                                    type="button"
                                    className="text-duyang-black hover:text-duyang-grey motion-safe:transition-all motion-safe:duration-200 lg:hidden"
                                    aria-label={t('nav.openMenu')}
                                >
                                    <Icons.List size={24} />
                                </button>
                            </SheetTrigger>

                            <SheetContent
                                side="left"
                                className="w-[85%] max-w-xs border-r border-duyang-grey-light bg-duyang-white p-0 shadow-none"
                            >
                                <div className="p-6">
                                    <SheetTitle className="mb-6 text-p-18-semibold text-duyang-black lg:text-h-20-semibold">
                                        {t('common.menu')}
                                    </SheetTitle>

                                    <nav className="flex flex-col">
                                        {navItems.map((item) => (
                                            <MobileNavItem
                                                key={item.label}
                                                item={item}
                                                currentUrl={url}
                                                expanded={
                                                    expandedMobileItem ===
                                                    item.label
                                                }
                                                onToggle={() =>
                                                    toggleMobileItem(item.label)
                                                }
                                                onClose={handleMobileClose}
                                            />
                                        ))}
                                    </nav>
                                </div>
                            </SheetContent>
                        </Sheet>

                        <span className="flex items-center gap-2">
                            <BrandLogo />
                        </span>
                    </div>

                    {/* Center: Navigation Menu (Desktop) */}
                    <nav className="hidden items-center gap-8 lg:flex">
                        {navItems.map((item) => (
                            <DesktopNavItem
                                key={item.label}
                                item={item}
                                currentUrl={url}
                            />
                        ))}
                    </nav>

                    {/* Right: Search + Language */}
                    <div className="flex items-center gap-4">
                        <Dialog
                            open={searchPopupOpen}
                            onOpenChange={setSearchPopupOpen}
                        >
                            <DialogTrigger asChild>
                                <button
                                    type="button"
                                    className="text-duyang-black hover:text-duyang-grey motion-safe:transition-all motion-safe:duration-200"
                                    aria-label="Search"
                                    onClick={() => setMobileMenuOpen(false)}
                                >
                                    <Icons.MagnifyingGlass size={24} />
                                </button>
                            </DialogTrigger>

                            <DialogContent className="top-16! translate-y-0! rounded-none border border-duyang-grey-light bg-duyang-white p-6 shadow-none sm:top-20! sm:max-w-4xl">
                                <div className="relative">
                                    <DuInput
                                        autoFocus
                                        type="text"
                                        label={t('common.search')}
                                        placeholder={t(
                                            'contact.faq.searchPlaceholder',
                                        )}
                                    />
                                </div>
                            </DialogContent>
                        </Dialog>

                        <DropdownMenu>
                            <DropdownMenuTrigger asChild>
                                <button
                                    type="button"
                                    aria-label={t('nav.selectLanguage')}
                                    className="rounded-none border-0 bg-transparent px-0 py-0 focus-visible:outline-none"
                                >
                                    <selectedLanguage.icon size={24} />
                                </button>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent>
                                {LANGUAGES.map((item) => (
                                    <DropdownMenuItem
                                        key={item.value}
                                        onClick={() =>
                                            handleLanguageChange(item.value)
                                        }
                                        className="text-p-14-medium text-duyang-black focus:bg-duyang-cream focus:text-duyang-black"
                                    >
                                        <span className="flex w-full items-center justify-between gap-3">
                                            <span className="flex items-center gap-2">
                                                <item.icon size={20} />
                                                <span>{item.label}</span>
                                            </span>
                                            {language === item.value && (
                                                <CheckIcon
                                                    className="size-4 text-duyang-black"
                                                    aria-hidden="true"
                                                />
                                            )}
                                        </span>
                                    </DropdownMenuItem>
                                ))}
                            </DropdownMenuContent>
                        </DropdownMenu>
                    </div>
                </div>
            </Container>
        </header>
    );
};

export default Header;
