import { Icons } from '../shared/Icons';

const processFeatures = [
    { icon: Icons.Leaf, title: 'Vật liệu đầu vào kiểm soát' },
    { icon: Icons.Couch, title: 'Tối ưu cho sản xuất & sử dụng' },
    { icon: Icons.Hammer, title: 'Gia công chính xác' },
    { icon: Icons.Truck, title: 'Quản lý sản xuất & giao hàng' },
];

const Process = () => {
    return (
        <div className="flex flex-col gap-12 surface-page p-10 lg:gap-20 lg:p-16">
            <div className="flex flex-col gap-10 lg:flex-row lg:gap-20">
                <div className="flex flex-1 flex-col gap-6">
                    <h2 className="text-h-32-bold text-duyang-black lg:text-h-40-bold">
                        Quy Trình Sản Xuất Tuần Hoàn
                    </h2>
                    <p className="text-p-16-regular whitespace-pre-line text-duyang-grey">
                        {`Tại DUYANG VIETNAM, chúng tôi áp dụng quy trình sản xuất tối ưu nhằm sử dụng hiệu quả nguyên vật liệu, giảm thiểu lãng phí và duy trì tính ổn định trong sản xuất. Mỗi công đoạn đều được kiểm soát chặt chẽ từ nguyên liệu đầu vào, gia công, hoàn thiện đến đóng gói, đảm bảo sản phẩm đạt tiêu chuẩn chất lượng trước khi xuất xưởng.
Chúng tôi hướng đến mô hình sản xuất bền vững, tối ưu tài nguyên và nâng cao hiệu quả lâu dài, mang lại giá trị ổn định cho đối tác và thị trường.`}
                    </p>
                </div>
                <div className="flex-1 overflow-hidden rounded">
                    <img
                        src="/assets/images/partner/partner-about.jpg"
                        className="h-full min-h-80 w-full object-cover"
                    />
                </div>
            </div>

            {/* Process features row */}
            <div className="grid grid-cols-2 gap-8 lg:grid-cols-4">
                {processFeatures.map((feature, index) => {
                    const Icon = feature.icon;
                    return (
                        <div
                            key={index}
                            className="flex flex-col items-center gap-3 text-center lg:flex-row lg:gap-6 lg:text-start"
                        >
                            <div className="flex h-14 w-14 flex-none items-center justify-center rounded bg-duyang-white text-duyang-black">
                                <Icon size={28} />
                            </div>
                            <span className="text-p-14-medium text-duyang-black lg:text-p-18-medium">
                                {feature.title}
                            </span>
                        </div>
                    );
                })}
            </div>
        </div>
    );
};

export default Process;
