import CoreValues from '@/components/about/core-values';
import Process from '@/components/partner/process';
import Stats from '@/components/partner/stats';
import Container from '@/components/shared/container';
import HeroSection from '@/components/shared/hero-section';
import Section from '@/components/shared/section';
import Story from '@/components/shared/story';
import Story2 from '@/components/shared/story2';
import AppLayout from '@/layouts/app-layout';

const Partner = () => {
    return (
        <AppLayout>
            {/* Hero Section */}
            <HeroSection
                title="Vì sao lên chọn chúng tôi làm đơn vị sản xuất"
                description="Từ tầm nhìn đến thực tế, chúng tôi tạo ra những ngôi nhà phản ánh cá tính của bạn"
                image="/assets/images/banner/partner.jpg"
            />

            {/* SỰ ĐỔI MỚI */}
            <Section>
                <Container>
                    <Story
                        title="SỰ ĐỔI MỚI"
                        description={`Tại DUYANG VIETNAM, đổi mới là nền tảng trong quá trình phát triển và sản xuất. Chúng tôi không ngừng đầu tư vào công nghệ, máy móc hiện đại và cải tiến quy trình nhằm nâng cao hiệu quả sản xuất, độ chính xác và chất lượng sản phẩm.\nVới đội ngũ kỹ thuật giàu kinh nghiệm cùng tư duy cải tiến liên tục, chúng tôi hướng đến việc tạo ra các giải pháp sản xuất tối ưu, đáp ứng yêu cầu ngày càng cao của thị trường trong nước và quốc tế. Đổi mới không chỉ là chiến lược, mà là cam kết lâu dài của DUYANG VIETNAM trong việc mang đến giá trị bền vững cho đối tác.`}
                        image="/assets/images/partner/partner-story.jpg"
                    />
                </Container>
            </Section>

            {/* Stats */}
            <Section>
                <Container>
                    <Stats />
                </Container>
            </Section>

            {/* Định Hướng Phát Triển */}
            <Section>
                <Container>
                    <Story
                        title="Định Hướng Phát Triển"
                        description={`Tại DUYANG VIETNAM, chúng tôi tập trung xây dựng năng lực sản xuất bền vững thông qua việc đầu tư công nghệ, tối ưu quy trình và nâng cao chất lượng sản phẩm. Mọi hoạt động đều hướng đến mục tiêu tăng hiệu suất, đảm bảo độ chính xác và duy trì tính ổn định trong sản xuất quy mô lớn.
Chúng tôi không ngừng nghiên cứu vật liệu, cải tiến kỹ thuật và mở rộng khả năng gia công nhằm đáp ứng yêu cầu ngày càng cao của đối tác trong và ngoài nước. Với định hướng phát triển lâu dài, DUYANG VIETNAM cam kết mang đến giải pháp sản xuất hiệu quả, tin cậy và bền vững cho khách hàng.`}
                        image="/assets/images/partner/partner-vision.jpg"
                    />
                </Container>
            </Section>

            {/* Core Values Section */}
            <Section>
                <Container>
                    <CoreValues />
                </Container>
            </Section>

            {/* Thiết Kế & Phát Triển Sản Phẩm */}
            <Section>
                <Container>
                    <Story
                        title="Thiết Kế & Phát Triển Sản Phẩm"
                        description={`Tại DUYANG VIETNAM, chúng tôi tập trung vào thiết kế tối ưu cho sản xuất và ứng dụng thực tế. Đội ngũ kỹ thuật phối hợp chặt chẽ với khách hàng để phát triển sản phẩm phù hợp về kết cấu, vật liệu và tiêu chuẩn kỹ thuật.
Chúng tôi cung cấp giải pháp thiết kế và gia công theo yêu cầu (OEM / ODM), từ sản phẩm tiêu chuẩn đến tùy chỉnh riêng, đảm bảo tính đồng bộ, độ chính xác và khả năng sản xuất quy mô lớn. Mỗi sản phẩm đều được nghiên cứu kỹ nhằm tối ưu hiệu quả sử dụng, độ bền và chi phí sản xuất.`}
                        image="/assets/images/partner/partner-vision2.jpg"
                    />
                </Container>
            </Section>

            {/* Tinh Thần Cải Tiến */}
            <Section>
                <Container>
                    <Story2
                        title="Tinh Thần Cải Tiến"
                        description="Tại DUYANG VIETNAM, chúng tôi luôn hướng đến việc cải tiến không ngừng về nghề, tay nghề nghiệp, quy trình sản xuất, chất lượng tối ưu và yêu cầu chuẩn mực tốt nhất. Mục tiêu chúng tôi là xây dựng nhà sản xuất kết tinh, liên tục cải tiến quy trình sản xuất theo yêu cầu OEM/ODM và các tiêu chuẩn công nghiệp trong yêu cầu kinh doanh."
                        buttonText="Tìm hiểu năng lực sản xuất"
                        image="/assets/images/partner/partner-cta.jpg"
                    />
                </Container>
            </Section>

            {/* Vật liệu bền vững */}
            <Section>
                <Container>
                    <Story
                        title="Vật liệu bền vững"
                        description="Tại DUYANG VIETNAM, chúng tôi cam kết sử dụng các nguyên vật liệu đầu vào bền vững và kiểm định đạt chuẩn trong toàn bộ quy trình sản xuất. Mỗi nguồn vật liệu đều được lựa chọn kỹ càng, đáp ứng tiêu chí chất lượng, tính ổn định và thân thiện với môi trường.\nChúng tôi không ngừng đầu tư vào việc nghiên cứu và ứng dụng các giải pháp vật liệu mới, góp phần tối ưu hoá chất lượng sản phẩm, giảm thiểu lãng phí trong quá trình sản xuất, giúp đối tác phát triển sản phẩm bền vững và hiệu quả hơn."
                        image="/assets/images/partner/partner-vision3.jpg"
                        reverse
                    />
                </Container>
            </Section>

            {/* Quy Trình Sản Xuất Tuần Hoàn */}
            <Section className="mb-10 lg:mb-16">
                <Container>
                    <Process />
                </Container>
            </Section>
        </AppLayout>
    );
};

export default Partner;
