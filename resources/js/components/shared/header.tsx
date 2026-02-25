import { Link } from '@inertiajs/react';
import type { FC } from 'react';
import { useState } from 'react';

import { cn } from '@/lib/utils/cn';
import { about, home, posts, shop } from '@/routes';

import Container from './Container';
import { Icons } from './Icons';

type NavItem = {
    label: string;
    href: string;
    active?: boolean;
};

const NAV_ITEMS: NavItem[] = [
    { label: 'Trang chủ', href: home().url },
    { label: 'Đội Tác Tin Cậy', href: about().url },
    { label: 'Sản Phẩm', href: shop().url },
    { label: 'Về Chúng Tôi', href: about().url },
];

export type HeaderProps = {
    className?: string;
};

const Header: FC<HeaderProps> = ({ className }) => {
    const [mobileMenuOpen, setMobileMenuOpen] = useState(false);

    return (
        <header
            className={cn(
                'bg-duyang-white border-duyang-grey-light border-b',
                className,
            )}
        >
            <Container>
                <div className="flex items-center justify-between py-4">
                    {/* Left: Menu Icon + Logo */}
                    <div className="flex items-center gap-4">
                        <button
                            onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
                            className="text-duyang-black hover:text-duyang-grey transition-colors lg:hidden"
                            aria-label="Toggle menu"
                        >
                            <Icons.List size={24} />
                        </button>

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
                                        ? 'text-duyang-black border-duyang-black border-b-2'
                                        : 'text-duyang-grey hover:text-duyang-black',
                                )}
                            >
                                {item.label}
                            </Link>
                        ))}
                    </nav>

                    {/* Right: Search + Language */}
                    <div className="flex items-center gap-4">
                        <button
                            className="text-duyang-black hover:text-duyang-grey transition-colors"
                            aria-label="Search"
                        >
                            <Icons.MagnifyingGlass size={24} />
                        </button>

                        <button
                            className="text-p-14-medium text-duyang-grey hover:text-duyang-black flex items-center gap-2 transition-colors"
                            aria-label="Change language"
                        >
                            🇻🇳
                        </button>
                    </div>
                </div>

                {/* Mobile Menu */}
                {mobileMenuOpen && (
                    <nav className="border-duyang-grey-light border-t py-4 lg:hidden">
                        <div className="flex flex-col gap-4">
                            {NAV_ITEMS.map((item) => (
                                <Link
                                    key={item.label}
                                    href={item.href}
                                    className={cn(
                                        'text-p-16-semibold py-2 transition-colors',
                                        item.active
                                            ? 'text-duyang-black'
                                            : 'text-duyang-grey hover:text-duyang-black',
                                    )}
                                    onClick={() => setMobileMenuOpen(false)}
                                >
                                    {item.label}
                                </Link>
                            ))}
                        </div>
                    </nav>
                )}
            </Container>
        </header>
    );
};

export default Header;
