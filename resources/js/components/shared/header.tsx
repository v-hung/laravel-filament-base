import { Link, usePage } from '@inertiajs/react';
import { CheckIcon } from 'lucide-react';
import type { FC } from 'react';
import { useState } from 'react';

import { cn } from '@/lib/utils/cn';
import { about, home, shop } from '@/routes';
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

import Container from './Container';
import { Icons } from './Icons';
import DuInput from './du-input';

type NavItem = {
    label: string;
    href: string;
    active?: boolean;
};

type Language = {
    value: 'vi' | 'en' | 'jp';
    label: string;
    icon: FC<{ size?: number; className?: string }>;
};

const NAV_ITEMS: NavItem[] = [
    { label: 'Trang chủ', href: home().url },
    { label: 'Đối Tác Tin Cậy', href: 'asd' },
    { label: 'Sản Phẩm', href: shop().url },
    { label: 'Về Chúng Tôi', href: about().url },
];

const LANGUAGES: Language[] = [
    { value: 'vi', label: 'VI', icon: Icons.Vi },
    { value: 'en', label: 'EN', icon: Icons.En },
    { value: 'jp', label: 'JP', icon: Icons.Jp },
];

export type HeaderProps = {
    className?: string;
};

const Header: FC<HeaderProps> = ({ className }) => {
    const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
    const [searchPopupOpen, setSearchPopupOpen] = useState(false);
    const [language, setLanguage] = useState<Language['value']>('vi');

    const { url, component } = usePage();

    const selectedLanguage =
        LANGUAGES.find((item) => item.value === language) ?? LANGUAGES[0];

    return (
        <header className={cn('bg-duyang-white', className)}>
            <Container>
                <div className="flex items-center justify-between py-4">
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
                                    aria-label="Mở menu điều hướng"
                                >
                                    <Icons.List size={24} />
                                </button>
                            </SheetTrigger>

                            <SheetContent
                                side="left"
                                className="w-[85%] max-w-xs border-r border-duyang-grey-light bg-duyang-white p-0 shadow-none"
                            >
                                <div className="p-6">
                                    <SheetTitle className="text-h-20-semibold mb-6 text-duyang-black">
                                        Menu
                                    </SheetTitle>

                                    <nav className="flex flex-col gap-4">
                                        {NAV_ITEMS.map((item) => (
                                            <Link
                                                key={item.label}
                                                href={item.href}
                                                className={cn(
                                                    'text-p-16-semibold border-duyang-grey-light py-2 transition-colors',
                                                    url == item.href
                                                        ? 'border-b text-duyang-black'
                                                        : 'text-duyang-grey hover:text-duyang-black',
                                                )}
                                                onClick={() =>
                                                    setMobileMenuOpen(false)
                                                }
                                            >
                                                {item.label}
                                            </Link>
                                        ))}
                                    </nav>
                                </div>
                            </SheetContent>
                        </Sheet>

                        <Link
                            href={home().url}
                            className="flex items-center gap-2"
                        >
                            <span className="text-h-20-semibold text-duyang-black">
                                DUYANG VIETNAM
                            </span>
                        </Link>
                    </div>

                    {/* Center: Navigation Menu (Desktop) */}
                    <nav className="hidden items-center gap-8 lg:flex">
                        {NAV_ITEMS.map((item) => (
                            <Link
                                key={item.label}
                                href={item.href}
                                className={cn(
                                    'text-btn-16 px-1.5 py-2.5',
                                    url == item.href
                                        ? 'border-b border-duyang-grey-light text-duyang-black'
                                        : 'text-duyang-grey hover:text-duyang-black',
                                )}
                            >
                                {item.label}
                            </Link>
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
                                        label="Tìm kiếm"
                                        placeholder="Nhập từ khóa sản phẩm..."
                                    />
                                </div>
                            </DialogContent>
                        </Dialog>

                        <DropdownMenu>
                            <DropdownMenuTrigger asChild>
                                <button
                                    type="button"
                                    aria-label="Chọn ngôn ngữ"
                                    className="rounded-none border-0 bg-transparent px-0 py-0 focus-visible:outline-none"
                                >
                                    <selectedLanguage.icon size={24} />
                                </button>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent>
                                {LANGUAGES.map((item) => (
                                    <DropdownMenuItem
                                        key={item.value}
                                        onClick={() => setLanguage(item.value)}
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
