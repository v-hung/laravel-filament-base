import { Link } from '@inertiajs/react';
import type { FC } from 'react';
import { useState } from 'react';

import { cn } from '@/lib/utils/cn';
import { about, home, shop } from '@/routes';
import {
    Dialog,
    DialogContent,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import {
    Sheet,
    SheetContent,
    SheetTitle,
    SheetTrigger,
} from '@/components/ui/sheet';
import { Input } from '@/components/ui/input';

import Container from './Container';
import { Icons } from './Icons';

type NavItem = {
    label: string;
    href: string;
    active?: boolean;
};

const NAV_ITEMS: NavItem[] = [
    { label: 'Trang chủ', href: home().url },
    { label: 'Đối Tác Tin Cậy', href: about().url },
    { label: 'Sản Phẩm', href: shop().url },
    { label: 'Về Chúng Tôi', href: about().url },
];

export type HeaderProps = {
    className?: string;
};

const Header: FC<HeaderProps> = ({ className }) => {
    const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
    const [searchPopupOpen, setSearchPopupOpen] = useState(false);

    return (
        <header
            className={cn(
                'border-b border-duyang-grey-light bg-duyang-white',
                className,
            )}
        >
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
                                                    item.active
                                                        ? 'text-duyang-black'
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
                            <Icons.List
                                size={24}
                                className="text-duyang-black"
                            />
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
                                    'text-p-16-semibold transition-colors',
                                    item.active
                                        ? 'border-b-2 border-duyang-black text-duyang-black'
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
                                <DialogHeader className="mb-2">
                                    <DialogTitle className="text-h-20-semibold text-left text-duyang-black">
                                        Tìm kiếm
                                    </DialogTitle>
                                </DialogHeader>

                                <div className="relative">
                                    <Icons.MagnifyingGlass
                                        size={20}
                                        className="pointer-events-none absolute top-1/2 left-3 -translate-y-1/2 text-duyang-grey-mid"
                                    />

                                    <Input
                                        autoFocus
                                        type="text"
                                        placeholder="Nhập từ khóa sản phẩm..."
                                        className="text-p-16-regular h-12 rounded-none border border-duyang-grey-light bg-transparent pl-10 text-duyang-black shadow-none placeholder:text-duyang-grey-mid focus-visible:border-duyang-grey focus-visible:ring-duyang-grey-light/50"
                                    />
                                </div>
                            </DialogContent>
                        </Dialog>

                        <button
                            type="button"
                            className="text-p-14-medium flex items-center gap-2 text-duyang-grey transition-colors hover:text-duyang-black"
                            aria-label="Change language"
                        >
                            🇻🇳
                        </button>
                    </div>
                </div>
            </Container>
        </header>
    );
};

export default Header;
