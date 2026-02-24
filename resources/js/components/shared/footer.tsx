import { Link } from '@inertiajs/react';
import type { FC } from 'react';

import { cn } from '@/lib/utils/cn';
import { about, contact, posts as postsRoute, shop } from '@/routes';

import BrandLogo from './brand-logo';
import Container from './Container';
import DuButton from './du-button';

type FooterLink = {
    label: string;
    href: string;
    external?: boolean;
};

type FooterSectionData = {
    heading: string;
    links: FooterLink[];
};

const FOOTER_SECTIONS: FooterSectionData[] = [
    {
        heading: 'Sản Phẩm',
        links: [
            { label: 'Móc Treo Gỗ', href: shop().url },
            { label: 'Móc Treo Nhựa', href: shop().url },
            { label: 'Giá Kim Loại', href: shop().url },
        ],
    },
    {
        heading: 'Thông Tin',
        links: [
            { label: 'Về Chúng Tôi', href: about().url },
            { label: 'Năng Lực Sản Xuất', href: about().url },
            { label: 'Tin Tức Nhà Máy', href: postsRoute().url },
        ],
    },
    {
        heading: 'Hỗ Trợ',
        links: [
            { label: 'Liên Hệ', href: contact().url },
            { label: 'Câu Hỏi', href: '#' },
            { label: 'Chính Sách', href: '#' },
        ],
    },
    {
        heading: 'Kết Nối Với Chúng Tôi',
        links: [
            { label: 'Email', href: 'mailto:info@duyang.vn', external: true },
            { label: 'Facebook', href: '#', external: true },
            { label: 'WhatsApp', href: '#', external: true },
        ],
    },
];

function FooterSectionColumn({
    section,
    className,
}: {
    section: FooterSectionData;
    className?: string;
}) {
    return (
        <div className={cn('flex flex-col gap-6', className)}>
            <h4 className="text-h-22-bold text-duyang-white">
                {section.heading}
            </h4>
            <ul className="flex flex-wrap gap-5 md:flex-col md:flex-nowrap">
                {section.links.map((link) =>
                    link.external ? (
                        <li key={link.label}>
                            <a
                                href={link.href}
                                className="text-btn-16 text-duyang-grey-light hover:text-duyang-white transition-colors"
                            >
                                {link.label}
                            </a>
                        </li>
                    ) : (
                        <li key={link.label}>
                            <Link
                                href={link.href}
                                className="text-btn-16 text-duyang-grey-light hover:text-duyang-white transition-colors"
                            >
                                {link.label}
                            </Link>
                        </li>
                    ),
                )}
            </ul>
        </div>
    );
}

function NewsletterSection({ className }: { className?: string }) {
    const handleSubmit = (e: React.SubmitEvent) => {
        e.preventDefault();
    };

    return (
        <div className={cn('flex flex-col gap-4', className)}>
            <h4 className="text-h-22-bold text-duyang-white">
                Nhận Thông Tin Từ DUYANG VIETNAM
            </h4>
            <p className="text-p-16-regular text-duyang-grey-light">
                Đăng ký để nhận cập nhật về năng lực sản xuất, sản phẩm mới và
                thông tin hợp tác.
            </p>
            <form className="mt-6 flex items-end gap-3" onSubmit={handleSubmit}>
                <input
                    type="email"
                    placeholder="Email"
                    className="text-p-16-regular border-duyang-grey-light text-duyang-white placeholder:text-duyang-grey-light focus:border-duyang-white flex-1 border-b bg-transparent pb-2 outline-none transition-colors"
                />
                <DuButton type="submit" variant="solid" color="white">
                    Đăng Ký
                </DuButton>
            </form>
        </div>
    );
}

export const Footer: FC = () => {
    return (
        <footer className="bg-duyang-black">
            <Container>
                <div className="pb-12 pt-12 md:pb-14 md:pt-16">
                    {/* Mobile-only logo at top */}
                    <div className="mb-8 md:hidden">
                        <BrandLogo />
                    </div>
                    {/* Link columns + Newsletter */}
                    <div className="grid grid-cols-1 gap-8 md:grid-cols-2 md:gap-10 lg:grid-cols-8 xl:grid-cols-12">
                        {FOOTER_SECTIONS.map((section) => (
                            <FooterSectionColumn
                                key={section.heading}
                                section={section}
                                className="lg:col-span-2"
                            />
                        ))}
                        <NewsletterSection className="md:col-span-2 lg:col-span-8 xl:col-span-4" />
                    </div>
                </div>

                {/* Separator */}
                <div className="border-t border-white/10" />

                {/* Bottom bar */}
                <div className="py-6">
                    <div className="flex flex-col items-center gap-4 md:flex-row md:justify-between">
                        {/* Logo — desktop only (mobile logo is at top) */}
                        <div className="hidden lg:block">
                            <BrandLogo />
                        </div>
                        <div className="flex flex-wrap gap-8 md:gap-12">
                            <p className="text-p-16-semibold text-duyang-white text-center">
                                © {new Date().getFullYear()} DUYANG VIETNAM. All
                                Rights Reserved
                            </p>
                            <a
                                href="#"
                                className="text-p-16-regular text-duyang-grey-light hover:text-duyang-white transition-colors"
                            >
                                Chính Sách Bảo Mật
                            </a>
                            <a
                                href="#"
                                className="text-p-16-regular text-duyang-grey-light hover:text-duyang-white transition-colors"
                            >
                                Điều Khoản Sử Dụng
                            </a>
                        </div>
                    </div>
                </div>
            </Container>
        </footer>
    );
};

export default Footer;
