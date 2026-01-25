<x-app-layout :cart="$cart" :cart_total="$cart_total">
  <!-- main body start -->
  <main>
    <!-- Breadcrumb section start -->
    <section class="breadcrumb_sec_1 position-relative">
      <div class="breadcrumb_wrap sec_space_mid_small"
        style="background-image: url({{ asset('assets/images/breadcrumb/breadcrumb1.png') }});">
        <div class="breadcrumb_cont text-center">
          <div class="breadcrumb_title">
            <h2 class="text-white">Về chúng tôi</h2>
          </div>
          <ul class="list-unstyled breadcrumb_item d-flex justify-content-center align-items-center text-white">
            <li><a href="{{ route('home') }}"><i class="fas fa-home active"></i>Trang chủ</a></li>
            <li><i class="fas fa-chevron-right"></i>Về chúng tôi</li>
          </ul>
        </div>
      </div>
    </section>
    <!-- Breadcrumb section end -->

    <!-- product section-2 start -->
    <section class="product_section_2 sec_space_small" data-aos="fade-up" data-aos-duration="1000">
      <div class="product_section_2_wrap">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="product_gallery d-flex justify-content-center align-items-center">
                <img src="{{ asset('assets/images/sales/sale9.png') }}" alt="image_not_found">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="product_section_content">
                <div class="product_sec_sub_title d-flex align-items-center pb-2">
                  <i class="far fa-circle"></i>
                  <i class="far fa-circle"></i>
                  <i class="far fa-circle"></i>
                  <span class="ps-1 text-uppercase organi">Chào mừng đến với {{ setting('shop.site_name') }}</span>
                </div>
                <div class="product_section_title py-2">
                  <h2>Thực phẩm hữu cơ tươi ngon, an toàn cho sức khỏe</h2>
                </div>
                <div class="product_section_desc product_about_desc">
                  <p>{{ setting('shop.site_description') }}</p>
                </div>
                <div class="product_services_cont d-flex flex-column my-5">
                  <span>100% nguyên liệu tự nhiên và hữu cơ.</span>
                  <span>Giao hàng nhanh chóng, tận nơi.</span>
                  <span>Sản phẩm luôn tươi ngon và đạt tiêu chuẩn chất lượng cao.</span>
                </div>
                <div class="product_section_btn">
                  <a href="{{ route('contact') }}"><button type="button"
                      class="btn custom_btn load_more_1 rounded-pill px-5 py-3 text-white">Liên hệ <i
                        class="fas fa-long-arrow-alt-right"></i></button></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- product section-2 end -->

    <!-- product-9 section start -->
    <section class="product9_sec mb_50 position-relative" data-aos="fade-up" data-aos-duration="1000">
      <div class="product9_sec_wrap sec_space_large"
        style="background-image: url({{ asset('assets/images/backgrounds/bg13.png') }});">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-10">
              <div class="row gx-5 justify-content-center align-items-center">
                <div class="col-lg-6">
                  <div class="product9_gallery img_moving_anim1 overflow-hidden shadow-lg">
                    <img src="{{ asset('assets/images/product/product31.png') }}" alt="image_not_found">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="product9_sec_cont">
                    <div class="product_sec_sub_title d-flex align-items-center pb-2">
                      <i class="far fa-circle"></i>
                      <i class="far fa-circle"></i>
                      <i class="far fa-circle"></i>
                      <span class="ps-1 text-uppercase organi">Chào mừng đến với {{ setting('shop.site_name') }}</span>
                    </div>
                    <div class="product9_section_title text-effect py-2">
                      <h2>Cam kết mang đến <br>
                        <font class="text-effect">
                          @foreach (mb_str_split('Thực phẩm sạch') as $char)
                            <span>{{ $char }}</span>
                          @endforeach
                        </font>
                      </h2>
                    </div>
                    <div class="product9_section_desc">
                      <p>{{ setting('shop.site_description') }}</p>
                    </div>
                    <div class="product9_inner_cont">
                      <div class="inner_item bg-white position-relative shadow-sm">
                        <span
                          class="item_num d-flex justify-content-center align-items-center rounded-pill text-white position-absolute">01</span>
                        <h6 class="item_title">Luôn tôn trọng và phục vụ khách hàng tận tình</h6>
                        <span class="item_subtitle text-uppercase">Sản phẩm hữu cơ cao cấp <i
                            class="fas fa-long-arrow-alt-right"></i></span>
                      </div>
                      <div class="inner_item bg-white position-relative shadow-sm">
                        <span
                          class="item_num d-flex justify-content-center align-items-center rounded-pill text-white position-absolute">02</span>
                        <h6 class="item_title">Giải thích rõ nguồn gốc và lợi ích sản phẩm</h6>
                        <span class="item_subtitle text-uppercase">100% tự nhiên <i
                            class="fas fa-long-arrow-alt-right"></i></span>
                      </div>
                      <div class="inner_item bg-white position-relative shadow-sm">
                        <span
                          class="item_num d-flex justify-content-center align-items-center rounded-pill text-white position-absolute">03</span>
                        <h6 class="item_title">Hỗ trợ khách hàng lựa chọn sản phẩm phù hợp</h6>
                        <span class="item_subtitle text-uppercase">Sản phẩm chọn lọc <i
                            class="fas fa-long-arrow-alt-right"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--  -->
      <img class="product9_right_thumb position-absolute" src="{{ asset('assets/images/product/product32.png') }}"
        alt="image_not_found">
    </section>
    <!-- product-9 section end -->

    <!-- testimonial-3 section start  -->
    <section class="testimonial3_sec sec_space_large sec_top_100" data-aos="fade-up" data-aos-duration="1000">
      <div class="testimonial3_sec_wrap">
        <div class="container-sm">
          <div class="testimonial3_content position-relative">
            <div class="row">
              <div class="col-xs-12">

                <div class="testimonial3_slider_thmb d-flex justify-content-center align-items-center">
                  @foreach ($testimonials as $testimonial)
                    <div class="slide_item">
                      <img src="{{ image_url($testimonial->image) }}" alt="image_not_found" style="object-fit: cover;">
                    </div>
                  @endforeach
                </div>

                <div class="testimonial3_slider_items col-lg-8 m-auto">
                  @foreach ($testimonials as $testimonial)
                    <div class="testimonial3_text">
                      <p class="testimonial_desc text-center">
                        {{ $testimonial->description }}
                      </p>
                      <div class="testimonial_author text-center">{{ $testimonial->title }}
                      </div>
                    </div>
                  @endforeach
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- testimonial-3 section end  -->

    <!-- facts section start -->
    <section class="fact_section" data-aos="fade-up" data-aos-duration="1000">
      <div class="fact_section_wrap">
        <div class="container-sm">
          <div class="facts_cont_wrap d-flex justify-content-between">
            <div class="fact_content d-flex flex-column" data-aos="fade-up" data-aos-duration="500">
              <span class="fact_number">1.250</span>
              <span class="fact_title text-uppercase">Sản phẩm tươi sống</span>
            </div>
            <div class="fact_content d-flex flex-column" data-aos="fade-up" data-aos-duration="1000">
              <span class="fact_number">3.480</span>
              <span class="fact_title text-uppercase">Khách hàng hài lòng</span>
            </div>
            <div class="fact_content d-flex flex-column" data-aos="fade-up" data-aos-duration="1500">
              <span class="fact_number">120</span>
              <span class="fact_title text-uppercase">Nhà cung cấp uy tín</span>
            </div>
            <div class="fact_content d-flex flex-column" data-aos="fade-up" data-aos-duration="1000">
              <span class="fact_number">5.600</span>
              <span class="fact_title text-uppercase">Đơn hàng mỗi tháng</span>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- facts section end -->


    <!-- product video section start -->
    <section class="product_video_sec">
      <div class="product_video_wrap overflow-hidden sec_space_xxxlarge"
        style="background-image: url({{ asset('assets/images/backgrounds/bg14.png') }});">
        <div class="product_video_player">
          <div class="product_video_slide_item d-flex justify-content-center align-items-center mx-5">
          </div>
        </div>
      </div>
    </section>
    <!-- product video section end -->
  </main>
  <!-- main body end -->
</x-app-layout>
