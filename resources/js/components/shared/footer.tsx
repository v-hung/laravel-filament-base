import { Link } from '@inertiajs/react';
import type { FC } from 'react';

import { cn } from '@/lib/utils/cn';
import { about, contact, posts as postsRoute, shop } from '@/routes';

import BrandLogo from './brand-logo';
import Container from './container';
import DuButton from './du-button';

type FooterLink = {
    label: string;
    href: string;
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
            { label: 'Email', href: 'mailto:info@duyang.vn' },
            { label: 'Facebook', href: '#' },
            { label: 'WhatsApp', href: '#' },
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
        <div
            className={cn(
                'flex flex-col gap-6 md:row-span-2 md:grid md:grid-rows-subgrid',
                className,
            )}
        >
            <h4 className="text-h-20-bold text-duyang-white lg:text-h-22-bold">
                {section.heading}
            </h4>
            <ul className="flex flex-wrap gap-5 md:flex-col md:flex-nowrap">
                {section.links.map((link) => (
                    <li key={link.label}>
                        <Link
                            href={link.href}
                            className="text-btn-14 text-duyang-grey-light transition-colors hover:text-duyang-white lg:text-btn-16"
                        >
                            {link.label}
                        </Link>
                    </li>
                ))}
            </ul>
        </div>
    );
}

function NewsletterSection({ className }: { className?: string }) {
    const handleSubmit = (e: React.SubmitEvent) => {
        e.preventDefault();
    };

    return (
        <div
            className={cn(
                'flex flex-col gap-4 md:row-span-2 md:grid md:grid-rows-subgrid',
                className,
            )}
        >
            <h4 className="text-h-20-bold text-duyang-white lg:text-h-22-bold">
                Nhận Thông Tin Từ DUYANG VIETNAM
            </h4>
            <div className="flex flex-col gap-4">
                <p className="text-p-14-regular text-duyang-grey-light lg:text-p-16-regular">
                    Đăng ký để nhận cập nhật về năng lực sản xuất, sản phẩm mới
                    và thông tin hợp tác.
                </p>
                <form
                    className="mt-6 flex items-end gap-3"
                    onSubmit={handleSubmit}
                >
                    <input
                        type="email"
                        placeholder="Email"
                        className="flex-1 border-b border-duyang-grey-light bg-transparent pb-2 text-p-14-regular text-duyang-white transition-colors outline-none placeholder:text-duyang-grey-light focus:border-duyang-white lg:text-p-16-regular"
                    />
                    <DuButton type="submit" variant="solid" color="white">
                        Đăng Ký
                    </DuButton>
                </form>
            </div>
        </div>
    );
}

export const Footer: FC = () => {
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
                            <BrandLogo white />
                        </div>
                        <div className="flex flex-wrap gap-4 md:gap-8 lg:gap-12">
                            <p className="text-p-14- text-center text-duyang-white lg:text-p-16-semibold">
                                © {new Date().getFullYear()} DUYANG VIETNAM. All
                                Rights Reserved
                            </p>
                            <a
                                href="#"
                                className="text-p-14-regular text-duyang-cream transition-colors hover:text-duyang-white lg:text-p-16-regular"
                            >
                                Chính Sách Bảo Mật
                            </a>
                            <a
                                href="#"
                                className="text-p-14-regular text-duyang-cream transition-colors hover:text-duyang-white lg:text-p-16-regular"
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
