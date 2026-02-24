import { Head, Link } from '@inertiajs/react';
import { about, contact, home, shop, posts as postsRoute } from '@/routes';
import { Footer } from '@/components/shared/footer';
import { detail as postDetail } from '@/routes/posts';
import { detail as productDetail } from '@/routes/products';

interface MediaItem {
    id: number;
    original_url: string;
    preview_url?: string;
}

interface Product {
    id: number;
    name: string;
    slug: string;
    price: string;
    compare_at_price: string | null;
    is_discounted: boolean;
    discount_percent: number;
    images: MediaItem[];
}

interface Post {
    id: number;
    title: string;
    slug: string;
    description: string;
    created_at: string;
    image: MediaItem | null;
}

interface Showcase {
    id: number;
    title: string;
    description: string;
    image: MediaItem | null;
}

interface PaginatedData<T> {
    data: T[];
    current_page: number;
    total: number;
}

interface HomeProps {
    products: PaginatedData<Product>;
    posts: PaginatedData<Post>;
    testimonials: PaginatedData<Showcase>;
    partners: PaginatedData<Showcase>;
}

// ── Navbar ──────────────────────────────────────────────────────────────────

function Navbar() {
    return (
        <header className="fixed top-0 right-0 left-0 z-50 border-b border-duyang-cream bg-duyang-white">
            <div className="mx-auto flex h-16 max-w-360 items-center justify-between px-13">
                <Link href={home().url} className="text-logo shrink-0">
                    DUYANG VIETNAM
                </Link>

                <nav className="hidden items-center gap-8 md:flex">
                    <Link
                        href={home().url}
                        className="text-body-sm text-duyang-black transition-colors hover:text-duyang-grey"
                    >
                        Trang Chủ
                    </Link>
                    <Link
                        href={about().url}
                        className="text-body-sm text-duyang-black transition-colors hover:text-duyang-grey"
                    >
                        Về Chúng Tôi
                    </Link>
                    <Link
                        href={shop().url}
                        className="text-body-sm text-duyang-black transition-colors hover:text-duyang-grey"
                    >
                        Sản Phẩm
                    </Link>
                    <Link
                        href={contact().url}
                        className="text-body-sm text-duyang-black transition-colors hover:text-duyang-grey"
                    >
                        Liên Hệ
                    </Link>
                </nav>

                <div className="flex items-center gap-4">
                    <button
                        className="icon-base flex items-center justify-center text-duyang-black transition-colors hover:text-duyang-grey"
                        aria-label="Tìm kiếm"
                    >
                        <svg
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            strokeWidth="2"
                            strokeLinecap="round"
                            strokeLinejoin="round"
                        >
                            <circle cx="11" cy="11" r="8" />
                            <path d="m21 21-4.35-4.35" />
                        </svg>
                    </button>
                    <button className="text-body-sm flex items-center gap-1.5 text-duyang-black">
                        <span className="rounded-duyang-sm inline-flex h-3.5 w-5 overflow-hidden">
                            <svg viewBox="0 0 36 24" width="20" height="14">
                                <rect width="36" height="24" fill="#DA251D" />
                                <polygon
                                    points="18,4 20.47,11.09 28,11.09 21.76,15.41 24.24,22.5 18,18.18 11.76,22.5 14.24,15.41 8,11.09 15.53,11.09"
                                    fill="#FFFF00"
                                />
                            </svg>
                        </span>
                        <span>VI</span>
                    </button>
                </div>
            </div>
        </header>
    );
}

// ── Hero ────────────────────────────────────────────────────────────────────

function Hero() {
    return (
        <section className="relative mt-16 h-155 overflow-hidden">
            <div
                className="absolute inset-0 bg-cover bg-center bg-no-repeat"
                style={{
                    backgroundImage:
                        "url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=1440&q=80')",
                }}
            />
            <div className="absolute inset-0 bg-duyang-black/30" />

            <div className="relative mx-auto flex h-full max-w-360 items-center justify-end px-13">
                <div className="rounded-duyang-card max-w-120 bg-duyang-black/70 p-12 backdrop-blur-sm">
                    <p className="text-body-sm mb-3 tracking-widest text-duyang-grey-light uppercase">
                        DUYANG VIETNAM
                    </p>
                    <h1
                        className="font-duyang-bold mb-6 text-duyang-white"
                        style={{
                            fontSize: '2.25rem',
                            fontWeight: 700,
                            lineHeight: 1.2,
                        }}
                    >
                        Nhà Sản Xuất
                        <br />
                        Hàng Đầu Việt Nam
                    </h1>
                    <p className="mb-8 text-sm leading-relaxed font-normal text-duyang-grey-light">
                        Chuyên sản xuất sản phẩm nội thất chất lượng cao phục vụ
                        thị trường trong nước và xuất khẩu.
                    </p>
                    <Link
                        href={about().url}
                        className="text-body-sm rounded-duyang-sm inline-flex items-center gap-2 bg-duyang-white px-6 py-3 font-semibold text-duyang-black transition-colors hover:bg-duyang-cream"
                    >
                        Tìm Hiểu Thêm
                        <svg
                            width="16"
                            height="16"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            strokeWidth="2.5"
                            strokeLinecap="round"
                            strokeLinejoin="round"
                        >
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </Link>
                </div>
            </div>
        </section>
    );
}

// ── About ───────────────────────────────────────────────────────────────────

const ABOUT_FEATURES = [
    {
        label: 'Tiêu biểu bền vững',
        icon: (
            <svg
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                strokeWidth="1.8"
                strokeLinecap="round"
                strokeLinejoin="round"
            >
                <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z" />
                <path d="m9 12 2 2 4-4" />
            </svg>
        ),
    },
    {
        label: 'Thiết kế đúng chuẩn tiêu dùng',
        icon: (
            <svg
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                strokeWidth="1.8"
                strokeLinecap="round"
                strokeLinejoin="round"
            >
                <circle cx="12" cy="12" r="3" />
                <path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83" />
            </svg>
        ),
    },
    {
        label: 'Đội ngũ kỹ thuật chuyên gia',
        icon: (
            <svg
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                strokeWidth="1.8"
                strokeLinecap="round"
                strokeLinejoin="round"
            >
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
        ),
    },
    {
        label: 'Tư vấn và hỗ trợ thuận tiện',
        icon: (
            <svg
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                strokeWidth="1.8"
                strokeLinecap="round"
                strokeLinejoin="round"
            >
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
            </svg>
        ),
    },
];

function About() {
    return (
        <section className="surface-page py-20">
            <div className="mx-auto max-w-360 px-13">
                <div className="grid grid-cols-1 items-center gap-16 lg:grid-cols-2">
                    <div className="rounded-duyang-card aspect-4/3 overflow-hidden">
                        <img
                            src="https://images.unsplash.com/photo-1565793979286-e7aa94eb6716?w=800&q=80"
                            alt="Nhà máy DUYANG"
                            className="h-full w-full object-cover"
                        />
                    </div>

                    <div className="flex flex-col gap-8">
                        <div className="flex flex-col gap-3">
                            <span className="text-body-sm tracking-widest text-duyang-grey-light uppercase">
                                Về Chúng Tôi
                            </span>
                            <h2 className="text-label">
                                Nền Tảng Chất Lượng –<br />
                                Tạo Nên Giá Trị Bền Vững
                            </h2>
                            <p className="text-muted">
                                Được thành lập với tiêu chí đặt chất lượng lên
                                hàng đầu, DUYANG VIETNAM không ngừng đầu tư vào
                                máy móc hiện đại và con người để tạo ra những
                                sản phẩm tốt nhất, là đối tác tin cậy của nhiều
                                thương hiệu trong và ngoài nước.
                            </p>
                        </div>

                        <div className="grid grid-cols-2 gap-6">
                            {ABOUT_FEATURES.map((feature) => (
                                <div
                                    key={feature.label}
                                    className="flex items-start gap-3"
                                >
                                    <div className="icon-base mt-0.5 shrink-0 text-duyang-black">
                                        {feature.icon}
                                    </div>
                                    <span className="text-body-sm">
                                        {feature.label}
                                    </span>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}

// ── Products ─────────────────────────────────────────────────────────────────

function ProductCard({ product }: { product: Product }) {
    const image = product.images?.[0]?.original_url;

    return (
        <Link
            href={productDetail({ product_slug: product.slug }).url}
            className="group flex flex-col gap-3"
        >
            <div className="rounded-duyang-card aspect-square overflow-hidden bg-duyang-cream">
                {image ? (
                    <img
                        src={image}
                        alt={product.name}
                        className="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                    />
                ) : (
                    <div className="flex h-full w-full items-center justify-center text-duyang-grey-light">
                        <svg
                            width="48"
                            height="48"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            strokeWidth="1.2"
                        >
                            <rect
                                x="3"
                                y="3"
                                width="18"
                                height="18"
                                rx="2"
                                ry="2"
                            />
                            <circle cx="8.5" cy="8.5" r="1.5" />
                            <polyline points="21 15 16 10 5 21" />
                        </svg>
                    </div>
                )}
            </div>
            <div className="flex flex-col gap-1">
                <p className="text-body-sm">{product.name}</p>
                <div className="flex items-center gap-2">
                    <span className="text-body-sm text-duyang-grey">
                        {Number(product.price).toLocaleString('vi-VN')}₫
                    </span>
                    {product.is_discounted && product.compare_at_price && (
                        <span className="text-muted line-through">
                            {Number(product.compare_at_price).toLocaleString(
                                'vi-VN',
                            )}
                            ₫
                        </span>
                    )}
                </div>
            </div>
        </Link>
    );
}

function Products({ products }: { products: PaginatedData<Product> }) {
    return (
        <section className="bg-duyang-white py-20">
            <div className="mx-auto max-w-360 px-13">
                <div className="grid grid-cols-1 items-start gap-16 lg:grid-cols-[300px_1fr]">
                    <div className="flex flex-col gap-6 lg:sticky lg:top-24">
                        <div className="flex flex-col gap-3">
                            <span className="text-body-sm tracking-widest text-duyang-grey-light uppercase">
                                Sản Phẩm
                            </span>
                            <h2 className="text-label">
                                Sản Phẩm Mới
                                <br />
                                Nhất Từ Nhà Máy
                            </h2>
                            <p className="text-muted">
                                Liên tục cập nhật danh mục sản phẩm với mẫu mã
                                mới nhất, đáp ứng xu hướng và nhu cầu đa dạng
                                của thị trường.
                            </p>
                        </div>
                        <Link
                            href={shop().url}
                            className="text-body-sm rounded-duyang-sm inline-flex w-fit items-center gap-2 border border-duyang-black px-6 py-3 text-duyang-black transition-colors hover:bg-duyang-black hover:text-duyang-white"
                        >
                            Xem tất cả sản phẩm
                            <svg
                                width="16"
                                height="16"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                strokeWidth="2.5"
                                strokeLinecap="round"
                                strokeLinejoin="round"
                            >
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </Link>
                    </div>

                    <div className="grid grid-cols-2 gap-8 md:grid-cols-3">
                        {products.data.map((product) => (
                            <ProductCard key={product.id} product={product} />
                        ))}
                    </div>
                </div>
            </div>
        </section>
    );
}

// ── Production Capacity ──────────────────────────────────────────────────────

const CAPACITY_STATS = [
    { value: '500+', label: 'Nhân viên' },
    { value: '10K+', label: 'Sản phẩm / tháng' },
    { value: '15+', label: 'Năm kinh nghiệm' },
    { value: '30+', label: 'Quốc gia xuất khẩu' },
];

function ProductionCapacity() {
    return (
        <section className="relative flex min-h-120 items-center overflow-hidden">
            <div
                className="absolute inset-0 bg-cover bg-center bg-no-repeat"
                style={{
                    backgroundImage:
                        "url('https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=1440&q=80')",
                }}
            />
            <div className="absolute inset-0 bg-duyang-black/65" />

            <div className="relative mx-auto w-full max-w-360 px-13 py-20">
                <div className="flex max-w-180 flex-col gap-6">
                    <span className="text-body-sm tracking-widest text-duyang-grey-light uppercase">
                        Năng Lực
                    </span>
                    <h2
                        className="text-duyang-white"
                        style={{
                            fontSize: '2.5rem',
                            fontWeight: 700,
                            lineHeight: 1.15,
                        }}
                    >
                        Năng Lực Sản Xuất
                        <br />
                        Quy Mô Lớn
                    </h2>
                    <p className="max-w-130 text-sm leading-relaxed font-normal text-duyang-grey-light">
                        Với dây chuyền sản xuất hiện đại và đội ngũ kỹ thuật
                        lành nghề, chúng tôi đáp ứng các đơn hàng lớn với tiêu
                        chuẩn chất lượng quốc tế, đảm bảo giao hàng đúng tiến
                        độ.
                    </p>
                    <div className="mt-4 flex flex-wrap gap-12">
                        {CAPACITY_STATS.map((stat) => (
                            <div
                                key={stat.label}
                                className="flex flex-col gap-1"
                            >
                                <span
                                    className="text-duyang-white"
                                    style={{
                                        fontSize: '2rem',
                                        fontWeight: 700,
                                    }}
                                >
                                    {stat.value}
                                </span>
                                <span className="text-body-sm text-duyang-grey-light">
                                    {stat.label}
                                </span>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </section>
    );
}

// ── Material Categories ──────────────────────────────────────────────────────

const MATERIAL_CATEGORIES = [
    {
        name: 'Sản Phẩm Nhựa',
        description:
            'Đa dạng mẫu mã, chất lượng cao, phù hợp nhiều ứng dụng trong nội thất và đời sống.',
        image: 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80',
        slug: 'nhua',
    },
    {
        name: 'Sản Phẩm Gỗ',
        description:
            'Sản phẩm gỗ tự nhiên và gỗ công nghiệp cao cấp, tinh tế trong từng đường nét thiết kế.',
        image: 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=600&q=80',
        slug: 'go',
    },
    {
        name: 'Sản Phẩm Kim Loại',
        description:
            'Khung thép, nhôm và các hợp kim bền chắc, được xử lý bề mặt chống oxy hóa hiện đại.',
        image: 'https://images.unsplash.com/photo-1586864387967-d02ef85d93e8?w=600&q=80',
        slug: 'kim-loai',
    },
];

function MaterialCategories() {
    return (
        <section className="surface-page py-20">
            <div className="mx-auto max-w-360 px-13">
                <div className="grid grid-cols-1 items-start gap-16 lg:grid-cols-[360px_1fr]">
                    <div className="flex flex-col gap-6 lg:sticky lg:top-24">
                        <div className="flex flex-col gap-3">
                            <span className="text-body-sm tracking-widest text-duyang-grey-light uppercase">
                                Danh Mục
                            </span>
                            <h2 className="text-label">
                                Danh Mục Sản Phẩm
                                <br />
                                Theo Vật Liệu
                            </h2>
                            <p className="text-muted">
                                Chuyên sản xuất sản phẩm từ nhiều loại vật liệu
                                khác nhau, đáp ứng nhu cầu đa dạng của khách
                                hàng trong và ngoài nước.
                            </p>
                        </div>
                    </div>

                    <div className="flex flex-col gap-6">
                        {MATERIAL_CATEGORIES.map((cat) => (
                            <div
                                key={cat.slug}
                                className="surface-card flex flex-col overflow-hidden sm:flex-row"
                            >
                                <div className="w-full shrink-0 overflow-hidden sm:w-52">
                                    <img
                                        src={cat.image}
                                        alt={cat.name}
                                        className="aspect-video h-full w-full object-cover sm:aspect-auto"
                                    />
                                </div>
                                <div className="flex flex-col justify-between gap-4 p-8">
                                    <div className="flex flex-col gap-2">
                                        <h3 className="text-body-lg">
                                            {cat.name}
                                        </h3>
                                        <p className="text-muted">
                                            {cat.description}
                                        </p>
                                    </div>
                                    <Link
                                        href={`${shop().url}?category=${cat.slug}`}
                                        className="text-body-sm rounded-duyang-sm inline-flex w-fit items-center gap-2 border border-duyang-black px-5 py-2.5 text-duyang-black transition-colors hover:bg-duyang-black hover:text-duyang-white"
                                    >
                                        Xem thêm
                                        <svg
                                            width="14"
                                            height="14"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            strokeWidth="2.5"
                                            strokeLinecap="round"
                                            strokeLinejoin="round"
                                        >
                                            <path d="M5 12h14M12 5l7 7-7 7" />
                                        </svg>
                                    </Link>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </section>
    );
}

// ── Why Choose Us ────────────────────────────────────────────────────────────

function WhyChooseUs() {
    return (
        <section className="relative flex min-h-120 items-center overflow-hidden">
            <div
                className="absolute inset-0 bg-cover bg-center bg-no-repeat"
                style={{
                    backgroundImage:
                        "url('https://images.unsplash.com/photo-1553413077-190dd305871c?w=1440&q=80')",
                }}
            />
            <div className="absolute inset-0 bg-duyang-black/55" />

            <div className="relative mx-auto w-full max-w-360 px-13 py-20">
                <div className="flex max-w-140 flex-col gap-6">
                    <h2
                        className="text-duyang-white"
                        style={{
                            fontSize: '2.5rem',
                            fontWeight: 700,
                            lineHeight: 1.2,
                        }}
                    >
                        Vi Sao Chọn Nhà
                        <br />
                        Máy Của Chúng Tôi
                    </h2>
                    <p className="text-sm leading-relaxed font-normal text-duyang-grey-light">
                        Cam kết mang đến sản phẩm chất lượng cao nhất với giá
                        cạnh tranh, đúng tiến độ và dịch vụ hỗ trợ chuyên nghiệp
                        từ khi đặt hàng đến khi giao hàng tận nơi.
                    </p>
                    <Link
                        href={about().url}
                        className="text-body-sm rounded-duyang-sm inline-flex w-fit items-center gap-2 bg-duyang-white px-6 py-3 font-semibold text-duyang-black transition-colors hover:bg-duyang-cream"
                    >
                        Xem Ngay
                        <svg
                            width="16"
                            height="16"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            strokeWidth="2.5"
                            strokeLinecap="round"
                            strokeLinejoin="round"
                        >
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </Link>
                </div>
            </div>
        </section>
    );
}

// ── Inspiration ──────────────────────────────────────────────────────────────

const INSPIRATION_PLACEHOLDERS = [
    'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=600&q=80',
    'https://images.unsplash.com/photo-1567016432779-094069958ea5?w=600&q=80',
    'https://images.unsplash.com/photo-1449247709967-d4461a6a6103?w=600&q=80',
    'https://images.unsplash.com/photo-1540518614846-7eded433c457?w=600&q=80',
    'https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?w=600&q=80',
    'https://images.unsplash.com/photo-1585128792020-803d29415281?w=600&q=80',
];

function Inspiration({
    testimonials,
}: {
    testimonials: PaginatedData<Showcase>;
}) {
    const items: Array<{ id: number; title: string; imageUrl: string }> =
        testimonials.data.length > 0
            ? testimonials.data.map((s) => ({
                  id: s.id,
                  title: s.title,
                  imageUrl:
                      s.image?.original_url ?? INSPIRATION_PLACEHOLDERS[0],
              }))
            : INSPIRATION_PLACEHOLDERS.map((src, i) => ({
                  id: i,
                  title: '',
                  imageUrl: src,
              }));

    return (
        <section className="bg-duyang-white py-20">
            <div className="mx-auto max-w-360 px-13">
                <div className="flex flex-col gap-12">
                    <div className="flex flex-col gap-2 text-center">
                        <span className="text-body-sm tracking-widest text-duyang-grey-light uppercase">
                            Showcase
                        </span>
                        <h2 className="text-label">Cảm Hứng Trang Trí</h2>
                    </div>

                    <div className="grid grid-cols-2 gap-4 md:grid-cols-3">
                        {items.slice(0, 6).map((item, idx) => (
                            <div
                                key={item.id}
                                className={`rounded-duyang-card overflow-hidden${idx === 0 ? 'row-span-2' : ''}`}
                            >
                                <img
                                    src={item.imageUrl}
                                    alt={item.title}
                                    className={`w-full object-cover${idx === 0 ? 'h-full' : 'aspect-square'}`}
                                />
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </section>
    );
}

// ── News ─────────────────────────────────────────────────────────────────────

function PostCard({ post }: { post: Post }) {
    const image = post.image?.original_url;
    const date = new Date(post.created_at).toLocaleDateString('vi-VN', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });

    return (
        <Link
            href={postDetail({ post_slug: post.slug }).url}
            className="group flex flex-col gap-4"
        >
            <div className="rounded-duyang-card aspect-video overflow-hidden bg-duyang-cream">
                {image ? (
                    <img
                        src={image}
                        alt={post.title}
                        className="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                    />
                ) : (
                    <div className="flex h-full w-full items-center justify-center text-duyang-grey-light">
                        <svg
                            width="48"
                            height="48"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            strokeWidth="1.2"
                        >
                            <rect
                                x="3"
                                y="3"
                                width="18"
                                height="18"
                                rx="2"
                                ry="2"
                            />
                            <circle cx="8.5" cy="8.5" r="1.5" />
                            <polyline points="21 15 16 10 5 21" />
                        </svg>
                    </div>
                )}
            </div>
            <div className="flex flex-col gap-2">
                <span className="text-muted">{date}</span>
                <h3 className="text-body-lg line-clamp-2 transition-colors group-hover:text-duyang-grey">
                    {post.title}
                </h3>
                {post.description && (
                    <p className="line-clamp-2 text-muted">
                        {post.description}
                    </p>
                )}
            </div>
        </Link>
    );
}

function News({ posts }: { posts: PaginatedData<Post> }) {
    return (
        <section className="surface-page py-20">
            <div className="mx-auto max-w-360 px-13">
                <div className="flex flex-col gap-12">
                    <div className="flex items-end justify-between">
                        <div className="flex flex-col gap-2">
                            <span className="text-body-sm tracking-widest text-duyang-grey-light uppercase">
                                Blog
                            </span>
                            <h2 className="text-label">Tin Tức</h2>
                        </div>
                        <Link
                            href={postsRoute().url}
                            className="text-body-sm flex items-center gap-1 text-duyang-grey transition-colors hover:text-duyang-black"
                        >
                            Xem tất cả
                            <svg
                                width="14"
                                height="14"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                strokeWidth="2.5"
                                strokeLinecap="round"
                                strokeLinejoin="round"
                            >
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </Link>
                    </div>

                    <div className="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                        {posts.data.slice(0, 3).map((post) => (
                            <PostCard key={post.id} post={post} />
                        ))}
                    </div>
                </div>
            </div>
        </section>
    );
}

// ── Page ─────────────────────────────────────────────────────────────────────

export default function Home({ products, posts, testimonials }: HomeProps) {
    return (
        <>
            <Head title="Trang Chủ" />
            <div className="surface-page font-duyang">
                <Navbar />
                <main>
                    <Hero />
                    <About />
                    <Products products={products} />
                    <ProductionCapacity />
                    <MaterialCategories />
                    <WhyChooseUs />
                    <Inspiration testimonials={testimonials} />
                    <News posts={posts} />
                </main>
                <Footer />
            </div>
        </>
    );
}
