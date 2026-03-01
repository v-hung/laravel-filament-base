import AppHead from '@/components/shared/app-head';
import Container from '@/components/shared/container';
import { Icons } from '@/components/shared/Icons';
import AppLayout from '@/layouts/app-layout';

const features = [
    { icon: Icons.Leaf, label: 'Vật liệu\nbền vững' },
    { icon: Icons.Couch, label: 'Thiết kế cho cuộc\nsống hàng ngày' },
    { icon: Icons.Hammer, label: 'Chế tác bởi đội ngũ\nchuyên gia' },
    { icon: Icons.Truck, label: 'Giao hàng & hỗ trợ\nthuận tiện' },
];

export default function Home() {
    return (
        <AppLayout>
            <AppHead />

            {/* About & Values */}
            <section className="surface-page py-16 lg:py-20">
                <Container>
                    <div className="grid grid-cols-1 items-center gap-12 md:grid-cols-2 md:gap-25">
                        {/* Factory image */}
                        <div className="overflow-hidden rounded-2xl">
                            <img
                                src="/images/factory.jpg"
                                alt="Nhà máy Duyang Vietnam"
                                className="h-full w-full object-cover"
                            />
                        </div>

                        {/* Content */}
                        <div className="flex flex-col gap-8">
                            <span className="text-p-16-regular text-duyang-grey lg:text-p-18-regular">
                                Về Chúng Tôi
                            </span>
                            <h2 className="text-h-32-bold text-duyang-black lg:text-h-40-bold">
                                Nền Tảng Chất Lượng – Tạo Nên Giá Trị Bền Vững
                            </h2>
                            <div className="flex flex-col gap-3 whitespace-pre-line">
                                <p className="text-p-14-regular text-duyang-grey lg:text-p-16-regular">
                                    {`Chúng tôi là nhà máy chuyên sản xuất các sản phẩm từ gỗ, nhựa và vật liệu công nghiệp, phục vụ thị trường trong nước và xuất khẩu. Với hệ thống máy móc hiện đại, quy trình sản xuất khép kín và đội ngũ kỹ thuật giàu kinh nghiệm, chúng tôi cam kết mang đến những sản phẩm đạt tiêu chuẩn cao về độ bền, tính chính xác và chất lượng hoàn thiện.
                                    Không ngừng cải tiến công nghệ và tối ưu quy trình, chúng tôi hướng đến việc cung cấp giải pháp sản xuất hiệu quả, ổn định và lâu dài cho đối tác, từ sản phẩm tiêu chuẩn đến gia công theo yêu cầu (OEM / ODM).`}
                                </p>
                            </div>
                        </div>
                    </div>

                    {/* Feature cards */}
                    <div className="mt-12 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                        {features.map(({ icon: Icon, label }) => (
                            <div
                                key={label}
                                className="flex items-center gap-5"
                            >
                                <div className="bg-duyang-white p-4">
                                    <Icon
                                        size={28}
                                        className="shrink-0 text-duyang-grey-mid"
                                    />
                                </div>
                                <span className="text-p-16-medium whitespace-pre-line text-duyang-black lg:text-p-18-medium">
                                    {label}
                                </span>
                            </div>
                        ))}
                    </div>
                </Container>
            </section>
        </AppLayout>
    );
}
