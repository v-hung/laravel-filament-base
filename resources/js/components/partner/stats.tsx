const stats = [
    { value: '500+', label: 'Sản phẩm đã phát triển & sản xuất' },
    { value: '20K+', label: 'Sản lượng sản xuất hàng tháng' },
    { value: '4.8/5', label: 'Đánh giá chất lượng & đáp ứng tổng thể' },
    {
        value: '7+',
        unit: 'years',
        label: 'Kinh nghiệm sản xuất & gia công công nghiệp',
    },
];

const Stats = () => {
    return (
        <div className="grid grid-cols-2 gap-x-10 gap-y-10 lg:grid-cols-4 lg:gap-x-12 lg:gap-y-0">
            {stats.map((stat, index) => (
                <div key={index} className="flex flex-col gap-4 lg:text-left">
                    <div className="text-h-40-bold text-duyang-black lg:text-h-56-semibold">
                        {stat.value}
                        {stat.unit && (
                            <span className="ml-1 text-p-18-semibold text-duyang-grey lg:text-h-24-semibold">
                                {stat.unit}
                            </span>
                        )}
                    </div>

                    <div className="border-t"></div>

                    <span className="text-p-14-regular text-duyang-grey lg:text-p-16-regular">
                        {stat.label}
                    </span>
                </div>
            ))}
        </div>
    );
};

export default Stats;
