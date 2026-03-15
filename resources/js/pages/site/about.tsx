import CoreValues from '@/components/about/core-values';
import TeamCarousel from '@/components/about/team-carousel';
import Container from '@/components/shared/container';
import HeroSection from '@/components/shared/hero-section';
import Section from '@/components/shared/section';
import Story from '@/components/shared/story';
import Story2 from '@/components/shared/story2';
import AppLayout from '@/layouts/app-layout';
import { useTranslation } from 'react-i18next';

export default function About() {
    const { t } = useTranslation();

    return (
        <AppLayout>
            {/* Hero Section */}
            <HeroSection
                title="Về chúng tôi"
                description="From vision to reality, we craft homes that mirror
                            your personality"
                image="/assets/images/banner/about.jpg"
            />

            {/* Company Overview, Vision, Mission Section */}
            <Section>
                <Container className="flex flex-col gap-10 lg:gap-20">
                    <Story
                        title="Chúng tôi là ai"
                        description={`DUYANG VIETNAM là nhà máy chuyên sản xuất và gia công các sản phẩm từ gỗ, kim loại và nhựa, phục vụ thị trường trong nước và xuất khẩu. Với hệ thống sản xuất hiện đại, quy trình khép kín và đội ngũ kỹ thuật giàu kinh nghiệm, chúng tôi cung cấp các giải pháp sản xuất ổn định, chính xác và phù hợp cho sản xuất quy mô lớn cũng như gia công theo yêu cầu (OEM / ODM).
                        Chúng tôi cam kết mang đến sản phẩm đạt tiêu chuẩn chất lượng, độ bền cao và tính đồng đều trong từng đơn hàng.`}
                        image="/assets/images/about/about-story.jpg"
                        imageAlt={t('about.factoryAlt')}
                    />
                    <Story
                        title="Tầm Nhìn"
                        description={`Tầm nhìn của DUYANG VIETNAM là trở thành nhà máy sản xuất và gia công các sản phẩm từ gỗ, kim loại và nhựa uy tín, chuyên nghiệp và phát triển bền vững tại khu vực. Chúng tôi hướng đến việc xây dựng một hệ thống sản xuất hiện đại, ổn định và linh hoạt, có khả năng đáp ứng đa dạng nhu cầu của thị trường trong nước cũng như quốc tế.
                        Thông qua việc không ngừng đầu tư vào công nghệ, cải tiến quy trình và nâng cao chất lượng nguồn nhân lực, DUYANG VIETNAM mong muốn trở thành đối tác sản xuất lâu dài và đáng tin cậy của các doanh nghiệp, thương hiệu và nhà phân phối toàn cầu. Chúng tôi cam kết mang đến các giải pháp sản xuất hiệu quả, tối ưu chi phí, đảm bảo chất lượng và phù hợp với xu hướng phát triển bền vững của ngành công nghiệp hiện đại.
                        Trong tương lai, DUYANG VIETNAM tiếp tục mở rộng năng lực sản xuất, nâng cao tiêu chuẩn chất lượng, tối ưu hệ thống quản lý và phát triển các dòng sản phẩm có giá trị cao, góp phần khẳng định vị thế của doanh nghiệp trong lĩnh vực sản xuất công nghiệp và chuỗi cung ứng toàn cầu.`}
                        image="/assets/images/about/about-vision.jpg"
                        imageAlt={t('about.factoryAlt')}
                        reverse
                    />
                    <Story
                        title="Sứ Mệnh"
                        description={`Sứ mệnh của DUYANG VIETNAM là mang đến các giải pháp sản xuất ổn định, hiệu quả và đáng tin cậy cho đối tác trong và ngoài nước. Chúng tôi tập trung xây dựng hệ thống sản xuất hiện đại, kiểm soát chặt chẽ từng công đoạn nhằm đảm bảo sản phẩm đạt tiêu chuẩn kỹ thuật cao, độ bền ổn định và tính đồng đều trong mọi đơn hàng.
                        Chúng tôi không ngừng tối ưu quy trình sản xuất, cải tiến công nghệ và nâng cao năng suất nhằm giúp đối tác tối ưu chi phí, rút ngắn thời gian sản xuất và nâng cao hiệu quả kinh doanh. Với năng lực gia công linh hoạt theo yêu cầu (OEM / ODM), DUYANG VIETNAM đồng hành cùng khách hàng trong việc phát triển sản phẩm, hoàn thiện thiết kế và đưa vào sản xuất quy mô lớn một cách hiệu quả và chính xác.
                        Bên cạnh đó, chúng tôi đề cao uy tín, trách nhiệm và sự minh bạch trong hợp tác. Mục tiêu của DUYANG VIETNAM không chỉ là cung cấp sản phẩm, mà còn xây dựng mối quan hệ hợp tác lâu dài, bền vững và cùng phát triển với đối tác trong chuỗi cung ứng toàn cầu.`}
                        image="/assets/images/about/about-mission.jpg"
                        imageAlt={t('about.factoryAlt')}
                    />
                </Container>
            </Section>

            {/* Team Carousel Section */}
            <Section>
                <Container>
                    <TeamCarousel />
                </Container>
            </Section>

            {/* Core Values Section */}
            <Section>
                <Container>
                    <CoreValues />
                </Container>
            </Section>

            {/* Development Section */}
            <Section className="mb-10 lg:mb-16">
                <Container>
                    <Story2
                        title="Sự Phát Triển"
                        description="Từ nền tảng sản xuất ban đầu, DUYANG VIETNAM không ngừng đầu tư vào công nghệ, máy móc và cải tiến quy trình nhằm nâng cao năng lực sản xuất. Chúng tôi mở rộng danh mục sản phẩm, tối ưu chất lượng và từng bước khẳng định vị thế trong lĩnh vực sản xuất công nghiệp.\nVới định hướng phát triển dài hạn, chúng tôi tiếp tục nâng cao tiêu chuẩn sản xuất, mở rộng thị trường và mang đến các giải pháp sản xuất hiệu quả, ổn định cho đối tác trong tương lai."
                        image="/assets/images/about/about-cta.jpg"
                    />
                </Container>
            </Section>
        </AppLayout>
    );
}
