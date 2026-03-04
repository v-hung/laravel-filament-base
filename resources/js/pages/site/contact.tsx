import Container from '@/components/shared/container';
import DuButton from '@/components/shared/du-button';
import DuInput from '@/components/shared/du-input';
import {
    Collapsible,
    CollapsibleContent,
    CollapsibleTrigger,
} from '@/components/ui/collapsible';
import AppLayout from '@/layouts/app-layout';
import { contact } from '@/routes';
import { useForm, usePage } from '@inertiajs/react';
import { ChevronDownIcon } from 'lucide-react';
import { type FormEvent, useId, useState } from 'react';

const FACTORY_IMAGE = '/storage/images/factory.jpg';

const FAQ_ITEMS = [
    {
        question: 'Nhà máy có nhận sản xuất theo yêu cầu không?',
        answer: 'Có. DUYANG VIETNAM nhận sản xuất theo yêu cầu riêng của khách hàng (OEM/ODM), bao gồm thiết kế, chất liệu, kích thước và bao bì.',
    },
    {
        question: 'Số lượng đặt hàng tối thiểu là bao nhiêu?',
        answer: 'Số lượng đặt hàng tối thiểu (MOQ) tùy thuộc vào loại sản phẩm và yêu cầu kỹ thuật. Vui lòng liên hệ để được tư vấn cụ thể.',
    },
    {
        question: 'Thời gian sản xuất bao lâu?',
        answer: 'Thời gian sản xuất thường từ 15–45 ngày tùy theo số lượng và độ phức tạp của sản phẩm. Chúng tôi luôn cam kết giao hàng đúng tiến độ.',
    },
    {
        question: 'Nhà máy có kiểm soát chất lượng sản phẩm không?',
        answer: 'Có. Mỗi lô hàng đều được kiểm tra chất lượng nghiêm ngặt qua nhiều công đoạn trước khi xuất xưởng, đảm bảo đạt tiêu chuẩn xuất khẩu.',
    },
    {
        question: 'Nhà máy có hỗ trợ đóng gói và xuất khẩu không?',
        answer: 'Có. Chúng tôi cung cấp giải pháp đóng gói, kiểm tra, đóng container và hỗ trợ vận chuyển theo yêu cầu của khách hàng trong và ngoài nước.',
    },
];

export default function Contact() {
    const formId = useId();
    const [openFaq, setOpenFaq] = useState<number | null>(null);
    const { flash } = usePage<{ flash: { success?: string } }>().props;
    const { data, setData, post, processing, reset, errors } = useForm({
        name: '',
        email: '',
        content: '',
    });

    const handleSubmit = (e: FormEvent) => {
        e.preventDefault();
        post(contact().url, {
            onSuccess: () => reset(),
        });
    };

    return (
        <AppLayout>
            {/* Contact Form Section */}
            <Container className="grid min-h-150 grid-cols-1 lg:grid-cols-2">
                {/* Left — Factory image */}
                <div className="relative hidden lg:block">
                    <img
                        src={FACTORY_IMAGE}
                        alt="Nhà máy DUYANG VIETNAM"
                        className="absolute inset-0 h-full w-full object-cover"
                    />
                </div>

                {/* Right — Contact form */}
                <div className="flex flex-col justify-center bg-duyang-cream px-6 py-12 md:px-12 lg:px-16 lg:py-16">
                    <h2 className="text-h-40 text-duyang-black">
                        Liên Hệ Với Chúng Tôi
                    </h2>

                    <p className="mt-6 max-w-xl text-p-18-regular text-duyang-grey">
                        DUYANG VIETNAM luôn sẵn sàng hỗ trợ và tư vấn giải pháp
                        sản xuất phù hợp với nhu cầu của bạn. Hãy gửi thông tin,
                        đội ngũ của chúng tôi sẽ phản hồi nhanh chóng và cung
                        cấp chi tiết về sản phẩm, năng lực sản xuất cũng như hợp
                        tác OEM / ODM.
                    </p>

                    {flash?.success && (
                        <p className="mt-8 max-w-xl border-l-2 border-duyang-black py-1 pl-4 text-p-16-regular text-duyang-black">
                            {flash.success}
                        </p>
                    )}

                    <form
                        id={formId}
                        onSubmit={handleSubmit}
                        className="mt-10 flex max-w-xl flex-col gap-8"
                    >
                        <div className="flex flex-col gap-1">
                            <DuInput
                                label="Họ Và Tên"
                                placeholder="Nhập họ và tên của bạn"
                                value={data.name}
                                onChange={(e) =>
                                    setData('name', e.target.value)
                                }
                                required
                            />
                            {errors.name && (
                                <p className="text-p-14-regular text-red-600">
                                    {errors.name}
                                </p>
                            )}
                        </div>

                        <div className="flex flex-col gap-1">
                            <DuInput
                                label="Email"
                                type="email"
                                placeholder="Nhập địa chỉ email liên hệ"
                                value={data.email}
                                onChange={(e) =>
                                    setData('email', e.target.value)
                                }
                                required
                            />
                            {errors.email && (
                                <p className="text-p-14-regular text-red-600">
                                    {errors.email}
                                </p>
                            )}
                        </div>

                        {/* Textarea styled like DuInput */}
                        <div className="flex w-full flex-col gap-1">
                            <div className="flex flex-col">
                                <label className="text-p-14-semibold text-duyang-black lg:text-p-16-semibold">
                                    Nội Dung
                                </label>
                                <textarea
                                    rows={3}
                                    placeholder="Nhập yêu cầu, thông tin sản phẩm hoặc nhu cầu sản xuất của bạn"
                                    value={data.content}
                                    onChange={(e) =>
                                        setData('content', e.target.value)
                                    }
                                    required
                                    className="resize-y rounded-none border-0 border-b border-duyang-grey-light bg-transparent px-0 pt-0 pb-2 text-p-14-semibold text-duyang-black placeholder:text-duyang-grey-mid focus:border-duyang-grey focus:ring-0 focus:outline-none lg:text-p-16-regular"
                                />
                            </div>
                            {errors.content && (
                                <p className="text-p-14-regular text-red-600">
                                    {errors.content}
                                </p>
                            )}
                        </div>

                        <div className="mt-2">
                            <DuButton
                                type="submit"
                                color="black"
                                variant="solid"
                                size="lg"
                                disabled={processing}
                            >
                                Gửi Yêu Cầu Liên Hệ
                            </DuButton>
                        </div>
                    </form>
                </div>
            </Container>

            {/* Contact Information Section */}
            <Container className="py-16 lg:py-20">
                <h2 className="text-h-40 text-duyang-black">
                    Thông Tin Liên Hệ
                </h2>

                <div className="mt-10 grid grid-cols-1 gap-10 lg:grid-cols-3 lg:gap-12">
                    {/* Column 1 — Address, Tax, Representative */}
                    <div className="flex flex-col gap-8">
                        <div className="flex flex-col gap-2">
                            <h3 className="text-h-20 text-duyang-black">
                                Địa Chỉ Trụ Sở & Nhà Máy
                            </h3>
                            <p className="text-p-16-regular text-duyang-grey">
                                Số 1236 Đường Nguyễn Văn Linh, Phường Thượng
                                Hồng, Tỉnh Hưng Yên, Việt Nam
                            </p>
                        </div>

                        <div className="flex flex-col gap-2">
                            <h3 className="text-h-20 text-duyang-black">
                                Mã Số Thuế
                            </h3>
                            <p className="text-p-16-regular text-duyang-grey">
                                0901196968
                            </p>
                        </div>

                        <div className="flex flex-col gap-2">
                            <h3 className="text-h-20 text-duyang-black">
                                Người Đại Diện
                            </h3>
                            <p className="text-p-16-regular text-duyang-grey">
                                Ông Thạch Công Đồng
                            </p>
                        </div>
                    </div>

                    {/* Column 2 — Phone, Industry, Email */}
                    <div className="flex flex-col gap-8">
                        <div className="flex flex-col gap-2">
                            <h3 className="text-h-20 text-duyang-black">
                                Điện Thoại
                            </h3>
                            <p className="text-p-16-regular text-duyang-grey">
                                0878 989 999
                            </p>
                        </div>

                        <div className="flex flex-col gap-2">
                            <h3 className="text-h-20 text-duyang-black">
                                Ngành Nghề Sản Xuất
                            </h3>
                            <p className="text-p-16-regular text-duyang-grey">
                                Sản xuất các sản phẩm từ gỗ, tre, nứa, rơm, rạ
                                và vật liệu liên quan phục vụ công nghiệp và
                                tiêu dùng.
                            </p>
                        </div>

                        <div className="flex flex-col gap-2">
                            <h3 className="text-h-20 text-duyang-black">
                                Email
                            </h3>
                            <p className="text-p-16-regular text-duyang-grey">
                                duyangvietnam@gmail.com
                            </p>
                        </div>
                    </div>

                    {/* Column 3 — Working Hours card */}
                    <div className="bg-duyang-black px-8 py-10 lg:px-10 lg:py-12">
                        <h3 className="text-h-24-bold text-duyang-white">
                            Giờ Làm Việc
                        </h3>

                        <div className="mt-8 flex flex-col gap-5">
                            <div className="flex items-baseline justify-between border-b border-white/15 pb-5">
                                <span className="text-p-16-semibold text-duyang-white">
                                    Thứ Hai – Thứ Sáu
                                </span>
                                <span className="text-p-16-regular text-duyang-white">
                                    08:00 – 17:00
                                </span>
                            </div>

                            <div className="flex items-baseline justify-between border-b border-white/15 pb-5">
                                <span className="text-p-16-semibold text-duyang-white">
                                    Thứ Bảy
                                </span>
                                <span className="text-p-16-regular text-duyang-white">
                                    08:00 – 12:00
                                </span>
                            </div>

                            <div className="flex items-baseline justify-between">
                                <span className="text-p-16-semibold text-duyang-white">
                                    Chủ Nhật
                                </span>
                                <span className="text-p-16-regular text-duyang-white">
                                    Nghỉ
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </Container>

            {/* FAQ Section */}
            <Container className="py-16 lg:py-20">
                <div className="grid grid-cols-1 items-start gap-10 lg:grid-cols-12 lg:gap-16">
                    {/* Left — Title & description */}
                    <div className="lg:col-span-4">
                        <h2 className="text-h-40 text-duyang-black">
                            Thông Tin Cần Biết Trước Khi Hợp Tác
                        </h2>
                        <p className="mt-6 text-p-16-regular text-duyang-grey">
                            Giải đáp các câu hỏi phổ biến về sản xuất, gia công,
                            đóng gói và xuất hàng tại DUYANG VIETNAM.
                        </p>
                    </div>

                    {/* Right — Accordion */}
                    <div className="lg:col-span-8">
                        {FAQ_ITEMS.map((item, index) => {
                            const isOpen = openFaq === index;
                            return (
                                <Collapsible
                                    key={index}
                                    open={isOpen}
                                    onOpenChange={(open) =>
                                        setOpenFaq(open ? index : null)
                                    }
                                >
                                    <div
                                        className={`border-b border-duyang-grey-light/30 transition-colors ${isOpen ? 'bg-duyang-cream' : ''}`}
                                    >
                                        <CollapsibleTrigger className="flex w-full cursor-pointer items-center justify-between px-6 py-6 text-left">
                                            <div className="flex items-center gap-6">
                                                <span className="text-p-16-regular text-duyang-grey-light">
                                                    {String(index + 1).padStart(
                                                        2,
                                                        '0',
                                                    )}
                                                </span>
                                                <span className="text-p-18-semibold text-duyang-black">
                                                    {item.question}
                                                </span>
                                            </div>
                                            <ChevronDownIcon
                                                className={`size-5 shrink-0 text-duyang-black transition-transform duration-200 ${isOpen ? 'rotate-180' : ''}`}
                                            />
                                        </CollapsibleTrigger>
                                        <CollapsibleContent>
                                            <div className="px-6 pt-0 pb-6 pl-18">
                                                <p className="text-p-16-regular text-duyang-grey">
                                                    {item.answer}
                                                </p>
                                            </div>
                                        </CollapsibleContent>
                                    </div>
                                </Collapsible>
                            );
                        })}
                    </div>
                </div>
            </Container>

            {/* Map Section */}
            <div></div>
        </AppLayout>
    );
}
