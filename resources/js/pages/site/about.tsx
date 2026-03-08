import CoreValues from '@/components/about/core-values';
import TeamCarousel from '@/components/about/team-carousel';
import Container from '@/components/shared/container';
import Section from '@/components/shared/section';
import AppLayout from '@/layouts/app-layout';
import { useTranslation } from 'react-i18next';

export default function About() {
    const { t } = useTranslation();

    return (
        <AppLayout>
            <Section className="pt-0 lg:pt-0">
                <Container>
                    <div className="flex items-center justify-between py-8 lg:py-14">
                        <h2 className="text-h-56-bold">Về chúng tôi</h2>
                        <p className="max-w-80 text-p-16-regular text-duyang-grey">
                            From vision to reality, we craft homes that mirror
                            your personality
                        </p>
                    </div>
                    <img
                        src="/images/about.jpg"
                        alt="About Us"
                        className="h-60 w-full bg-duyang-cream md:h-90 lg:h-125"
                    />
                </Container>
            </Section>

            <Section>
                <Container className="flex flex-col gap-10 lg:gap-20">
                    <div className="grid grid-cols-1 gap-10 lg:grid-cols-2 lg:gap-20">
                        <div className="overflow-hidden rounded">
                            <img
                                src="/images/about.jpg"
                                alt={t('about.factoryAlt')}
                                className="h-full min-h-80 w-full bg-duyang-cream object-cover"
                            />
                        </div>
                        <div className="flex flex-col gap-6">
                            <h2 className="text-h-32-bold text-duyang-black lg:text-h-40-bold">
                                Chúng tôi là ai
                            </h2>
                            <p className="text-p-16-regular whitespace-pre-line text-duyang-grey">
                                {`DUYANG VIETNAM là nhà máy chuyên sản xuất và gia công các sản phẩm từ gỗ, kim loại và nhựa, phục vụ thị trường trong nước và xuất khẩu. Với hệ thống sản xuất hiện đại, quy trình khép kín và đội ngũ kỹ thuật giàu kinh nghiệm, chúng tôi cung cấp các giải pháp sản xuất ổn định, chính xác và phù hợp cho sản xuất quy mô lớn cũng như gia công theo yêu cầu (OEM / ODM).
                                Chúng tôi cam kết mang đến sản phẩm đạt tiêu chuẩn chất lượng, độ bền cao và tính đồng đều trong từng đơn hàng.`}
                            </p>
                        </div>
                    </div>

                    <div className="grid grid-cols-1 gap-10 lg:grid-cols-2 lg:gap-20">
                        <div className="flex flex-col gap-6">
                            <h2 className="text-h-32-bold text-duyang-black lg:text-h-40-bold">
                                Tầm Nhìn
                            </h2>
                            <p className="text-p-16-regular whitespace-pre-line text-duyang-grey">
                                {`Tầm nhìn của DUYANG VIETNAM là trở thành nhà máy sản xuất và gia công các sản phẩm từ gỗ, kim loại và nhựa uy tín, chuyên nghiệp và phát triển bền vững tại khu vực. Chúng tôi hướng đến việc xây dựng một hệ thống sản xuất hiện đại, ổn định và linh hoạt, có khả năng đáp ứng đa dạng nhu cầu của thị trường trong nước cũng như quốc tế.
                                Thông qua việc không ngừng đầu tư vào công nghệ, cải tiến quy trình và nâng cao chất lượng nguồn nhân lực, DUYANG VIETNAM mong muốn trở thành đối tác sản xuất lâu dài và đáng tin cậy của các doanh nghiệp, thương hiệu và nhà phân phối toàn cầu. Chúng tôi cam kết mang đến các giải pháp sản xuất hiệu quả, tối ưu chi phí, đảm bảo chất lượng và phù hợp với xu hướng phát triển bền vững của ngành công nghiệp hiện đại.
                                Trong tương lai, DUYANG VIETNAM tiếp tục mở rộng năng lực sản xuất, nâng cao tiêu chuẩn chất lượng, tối ưu hệ thống quản lý và phát triển các dòng sản phẩm có giá trị cao, góp phần khẳng định vị thế của doanh nghiệp trong lĩnh vực sản xuất công nghiệp và chuỗi cung ứng toàn cầu.`}
                            </p>
                        </div>

                        <div className="overflow-hidden rounded">
                            <img
                                src="/images/about.jpg"
                                alt={t('about.factoryAlt')}
                                className="h-full min-h-80 w-full bg-duyang-cream object-cover"
                            />
                        </div>
                    </div>

                    <div className="grid grid-cols-1 gap-10 lg:grid-cols-2 lg:gap-20">
                        <div className="overflow-hidden rounded">
                            <img
                                src="/images/about.jpg"
                                alt={t('about.factoryAlt')}
                                className="h-full min-h-80 w-full bg-duyang-cream object-cover"
                            />
                        </div>

                        <div className="flex flex-col gap-6">
                            <h2 className="text-h-32-bold text-duyang-black lg:text-h-40-bold">
                                Sứ Mệnh
                            </h2>
                            <p className="text-p-16-regular whitespace-pre-line text-duyang-grey">
                                {`Sứ mệnh của DUYANG VIETNAM là mang đến các giải pháp sản xuất ổn định, hiệu quả và đáng tin cậy cho đối tác trong và ngoài nước. Chúng tôi tập trung xây dựng hệ thống sản xuất hiện đại, kiểm soát chặt chẽ từng công đoạn nhằm đảm bảo sản phẩm đạt tiêu chuẩn kỹ thuật cao, độ bền ổn định và tính đồng đều trong mọi đơn hàng.
                                Chúng tôi không ngừng tối ưu quy trình sản xuất, cải tiến công nghệ và nâng cao năng suất nhằm giúp đối tác tối ưu chi phí, rút ngắn thời gian sản xuất và nâng cao hiệu quả kinh doanh. Với năng lực gia công linh hoạt theo yêu cầu (OEM / ODM), DUYANG VIETNAM đồng hành cùng khách hàng trong việc phát triển sản phẩm, hoàn thiện thiết kế và đưa vào sản xuất quy mô lớn một cách hiệu quả và chính xác.
                                Bên cạnh đó, chúng tôi đề cao uy tín, trách nhiệm và sự minh bạch trong hợp tác. Mục tiêu của DUYANG VIETNAM không chỉ là cung cấp sản phẩm, mà còn xây dựng mối quan hệ hợp tác lâu dài, bền vững và cùng phát triển với đối tác trong chuỗi cung ứng toàn cầu.`}
                            </p>
                        </div>
                    </div>
                </Container>
            </Section>

            <Section>
                <Container>
                    <TeamCarousel />
                </Container>
            </Section>

            <Section>
                <Container>
                    <CoreValues />
                </Container>
            </Section>

            <Section className="mb-10 lg:mb-16">
                <Container>
                    <div className="grid grid-cols-1 overflow-hidden rounded bg-duyang-white lg:grid-cols-2">
                        <div className="flex flex-col gap-6 bg-duyang-cream p-10 lg:p-16">
                            <h2 className="text-h-40-bold text-duyang-black lg:text-h-56-bold">
                                Sự Phát Triển
                            </h2>
                            <p className="text-p-16-regular whitespace-pre-line text-duyang-grey">
                                {`Từ nền tảng sản xuất ban đầu, DUYANG VIETNAM không ngừng đầu tư vào công nghệ, máy móc và cải tiến quy trình nhằm nâng cao năng lực sản xuất. Chúng tôi mở rộng danh mục sản phẩm, tối ưu chất lượng và từng bước khẳng định vị thế trong lĩnh vực sản xuất công nghiệp.\nVới định hướng phát triển dài hạn, chúng tôi tiếp tục nâng cao tiêu chuẩn sản xuất, mở rộng thị trường và mang đến các giải pháp sản xuất hiệu quả, ổn định cho đối tác trong tương lai.`}
                            </p>
                        </div>
                        <div className="min-h-80 lg:min-h-0">
                            <img
                                src="/images/about.jpg"
                                alt="Sự phát triển của DUYANG VIETNAM"
                                className="h-full w-full bg-duyang-cream object-cover"
                            />
                        </div>
                    </div>
                </Container>
            </Section>
        </AppLayout>
    );
}
