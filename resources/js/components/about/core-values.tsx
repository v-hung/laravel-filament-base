import { Icons } from '../shared/Icons';

const values = [
    {
        icon: Icons.ClockCountdown,
        title: 'Sản xuất chính xác',
        description:
            'Tập trung vào độ chính xác, tính ổn định và tiêu chuẩn kỹ thuật trong từng công đoạn sản xuất.',
    },
    {
        icon: Icons.SealCheck,
        title: 'Chất lượng bền vững',
        description:
            'Sử dụng vật liệu đạt chuẩn, kiểm soát chặt chẽ để đảm bảo sản phẩm bền, ổn định - đồng đều.',
    },
    {
        icon: Icons.Leaf,
        title: 'Cải tiến liên tục',
        description:
            'Không ngừng nâng cấp công nghệ, tối ưu quy trình và nâng cao hiệu quả sản xuất.',
    },
    {
        icon: Icons.UserFocus,
        title: 'Hợp tác lâu dài',
        description:
            'Lấy uy tín làm nền tảng, hướng đến mối quan hệ hợp tác bền vững và phát triển cùng đối tác.',
    },
];

export default function CoreValues() {
    return (
        <div className="flex flex-col gap-10 lg:flex-row lg:items-start lg:gap-20">
            <div className="shrink-0 lg:w-50">
                <h2 className="text-h-32-bold text-duyang-black lg:text-h-56-bold">
                    Giá Trị Cốt Lõi
                </h2>
            </div>

            <div className="flex grow flex-col">
                <div className="-mx-4 -mb-4 flex flex-wrap lg:*:border-b-0! [&>*:not(:last-child)]:border-b lg:[&>*:not(:nth-last-child(-n+2))]:border-b!">
                    {values.map((value) => (
                        <div className="flex w-full gap-4 border-duyang-grey-light/30 px-4 py-8 lg:w-1/2">
                            <div className="flex h-16 w-16 shrink-0 items-center justify-center bg-duyang-cream text-duyang-black lg:h-20 lg:w-20">
                                <value.icon className="h-7 w-7 lg:h-9 lg:w-9" />
                            </div>
                            <div className="flex flex-col gap-2">
                                <h3 className="text-h-20-semibold text-duyang-black lg:text-h-24-bold">
                                    {value.title}
                                </h3>
                                <p className="text-p-14-regular text-duyang-grey lg:text-p-16-regular">
                                    {value.description}
                                </p>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </div>
    );
}
