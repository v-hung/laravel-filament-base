import { Link, usePage, router } from '@inertiajs/react';
import { CheckIcon, ChevronDownIcon } from 'lucide-react';
import type { FC } from 'react';
import { useEffect, useRef, useState } from 'react';
import { useTranslation } from 'react-i18next';

import { cn } from '@/lib/utils/cn';
import { CURRENT_LANGUAGE, type AppLocale } from '@/i18n/constants';
import type { MenuNavItem } from '@/types/models';
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

type Language = {
    value: AppLocale;
    label: string;
    icon: FC<{ size?: number; className?: string }>;
};

const LANGUAGES: Language[] = [
    { value: 'vi', label: 'VI', icon: Icons.Vi },
    { value: 'en', label: 'EN', icon: Icons.En },
    { value: 'zh', label: 'ZH', icon: Icons.Zh },
];

function resolveTitle(title: Record<string, string>, locale: string): string {
    return title[locale] ?? Object.values(title)[0] ?? '';
}

// Desktop: dùng DropdownMenu của Radix (tự quản lý state & animation)
const DesktopNavItem: FC<{
    item: MenuNavItem;
    locale: string;
    currentUrl: string;
}> = ({ item, locale, currentUrl }) => {
    const title = resolveTitle(item.title, locale);
    const href = item.url ?? '#';
    const isActive = item.url ? currentUrl.split('?')[0] === item.url : false;
    const baseLinkCls = cn(
        'px-1.5 py-2.5 text-btn-14 transition-colors lg:text-btn-16',
        isActive
            ? 'border-b border-duyang-grey-light text-duyang-black'
            : 'text-duyang-grey hover:text-duyang-black',
    );

    if (item.children.length === 0) {
        return (
            <Link href={href} className={baseLinkCls}>
                {title}
            </Link>
        );
    }

    return (
        <DropdownMenu>
            <DropdownMenuTrigger asChild>
                <div className="flex cursor-default items-center gap-0.5">
                    <span
                        role="link"
                        tabIndex={0}
                        className={cn(baseLinkCls, 'cursor-pointer')}
                        onPointerDown={(e) => e.stopPropagation()}
                        onClick={() => router.visit(href)}
                        onKeyDown={(e) => {
                            if (e.key === 'Enter') router.visit(href);
                        }}
                    >
                        {title}
                    </span>
                    <button
                        type="button"
                        className={cn(
                            'group py-2.5 transition-colors',
                            isActive
                                ? 'text-duyang-black'
                                : 'text-duyang-grey hover:text-duyang-black',
                        )}
                    >
                        <ChevronDownIcon className="size-4 transition-transform duration-200 group-data-[state=open]:rotate-180" />
                    </button>
                </div>
            </DropdownMenuTrigger>
            <DropdownMenuContent
                align="start"
                sideOffset={8}
                className="min-w-44 rounded-none border border-duyang-grey-light/10 bg-duyang-white p-1 shadow-lg shadow-duyang-grey/30"
            >
                {item.children.map((child) => (
                    <DropdownMenuItem key={child.id} asChild>
                        <Link
                            href={child.url ?? '#'}
                            className="cursor-pointer rounded-none px-3 py-2 text-p-14-medium text-duyang-grey transition-colors hover:bg-duyang-cream hover:text-duyang-black focus:bg-duyang-cream focus:text-duyang-black"
                        >
                            {resolveTitle(child.title, locale)}
                        </Link>
                    </DropdownMenuItem>
                ))}
            </DropdownMenuContent>
        </DropdownMenu>
    );
};

// Mobile: accordion với CSS grid animation (không mount/unmount)
const MobileNavItem: FC<{
    item: MenuNavItem;
    locale: string;
    currentUrl: string;
    expanded: boolean;
    onToggle: () => void;
    onClose: () => void;
}> = ({ item, locale, currentUrl, expanded, onToggle, onClose }) => {
    const title = resolveTitle(item.title, locale);
    const href = item.url ?? '#';
    const isActive = item.url ? currentUrl.split('?')[0] === item.url : false;
    const baseCls = 'py-2.5 text-p-14-semibold transition-colors';
    const activeCls = 'text-duyang-black';
    const inactiveCls = 'text-duyang-grey hover:text-duyang-black';

    if (item.children.length === 0) {
        return (
            <Link
                href={href}
                className={cn(
                    baseCls,
                    isActive
                        ? cn(activeCls, 'border-b border-duyang-grey-light')
                        : inactiveCls,
                )}
                onClick={onClose}
            >
                {title}
            </Link>
        );
    }

    return (
        <div>
            <div
                className={cn(
                    baseCls,
                    'flex w-full items-center justify-between',
                    isActive ? activeCls : inactiveCls,
                )}
            >
                <Link href={href} className="flex-1" onClick={onClose}>
                    {title}
                </Link>
                <button type="button" onClick={onToggle} className="p-1">
                    <ChevronDownIcon
                        className={cn(
                            'size-4 transition-transform duration-300',
                            expanded && 'rotate-180',
                        )}
                    />
                </button>
            </div>

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
                                key={child.id}
                                href={child.url ?? '#'}
                                className="py-2 text-p-14-medium text-duyang-grey transition-colors hover:text-duyang-black"
                                onClick={onClose}
                            >
                                {resolveTitle(child.title, locale)}
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
    const [expandedMobileItem, setExpandedMobileItem] = useState<number | null>(
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

    const { url, props } = usePage();
    const appLocale = (props.appLocale as AppLocale) || CURRENT_LANGUAGE;
    const locale =
        (i18n.language as AppLocale) || appLocale || CURRENT_LANGUAGE;

    const headerMenu = props.menus.header;

    const selectedLanguage =
        LANGUAGES.find((item) => item.value === locale) ?? LANGUAGES[0];

    const handleLanguageChange = async (newLocale: AppLocale) => {
        router.visit(`/greeting/${newLocale}`, {
            method: 'get',
            preserveState: true,
            onSuccess: () => {
                i18n.changeLanguage(newLocale);
            },
        });
    };

    const handleMobileClose = () => setMobileMenuOpen(false);

    const toggleMobileItem = (id: number) =>
        setExpandedMobileItem((prev) => (prev === id ? null : id));

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
                                        {headerMenu.map((item) => (
                                            <MobileNavItem
                                                key={item.id}
                                                item={item}
                                                locale={locale}
                                                currentUrl={url}
                                                expanded={
                                                    expandedMobileItem ===
                                                    item.id
                                                }
                                                onToggle={() =>
                                                    toggleMobileItem(item.id)
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
                        {headerMenu.map((item) => (
                            <DesktopNavItem
                                key={item.id}
                                item={item}
                                locale={locale}
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

                            <DialogContent className="top-16! translate-y-0! rounded-none border border-duyang-grey-light/10 bg-duyang-white p-6 shadow-lg shadow-duyang-grey/30 sm:top-20! sm:max-w-4xl">
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
                            <DropdownMenuContent className="min-w-28 rounded-none border border-duyang-grey-light/40 bg-duyang-white shadow-lg shadow-black/5">
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
                                            {locale === item.value && (
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
