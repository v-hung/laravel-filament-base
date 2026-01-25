<x-app-layout :cart="$cart" :cart_total="$cart_total">
  <!-- main body start -->
  <main>

    <!-- banner section start -->
    <section class="banner_section_main position-relative banner_2">
      <div class="banner_section_item d-flex justify-content-center align-items-center sec_space_large"
        style="background-image: url({{ asset('assets/images/banner/banner2.png') }});">
        <div class="container">
          <div class="row">
            <div class="col-lg-7 ms-3">
              <div class="banner_sub_title2 position-relative">
                <h6 class="text-white text-uppercase position-absolute">100% Thực Phẩm Hữu Cơ</h6>
                <img class="sub_title_bg" src="{{ asset('assets/images/shapes/shape2.png') }}" alt="image_not_found">
              </div>
              <div class="banner_title2">
                <h1>
                  Rau củ hữu cơ & Thực phẩm
                  <font class="text-effect">
                    @foreach (mb_str_split('LÀNH MẠNH') as $char)
                      <span>{{ $char }}</span>
                    @endforeach
                  </font>
                </h1>
              </div>
              <div class="banner_desc py-3">
                <p>
                  Chúng tôi mang đến các loại rau củ sạch, an toàn và đạt chuẩn hữu cơ.
                  Thực phẩm tươi ngon mỗi ngày giúp bữa ăn của bạn trở nên trọn vẹn và tốt cho sức khỏe.
                </p>
              </div>
              <div class="banner_btn">
                <a href="{{ route('contact') }}"><button type="button"
                    class="btn custom_btn rounded-pill px-5 py-3 text-white">Liên hệ <i
                      class="fas fa-long-arrow-alt-right"></i></button></a>
              </div>
            </div>
            <div class="col-lg-5"></div>
          </div>
        </div>
      </div>
      <!-- header side thumb -->
      <img class="banner2_right_thumb position-absolute" src="{{ asset('assets/images/shapes/shape5.png') }}"
        alt="image_not_found">
    </section>
    <!-- banner section end -->

    <!-- service section start -->
    <section class="service_setion2" data-aos="fade-up" data-aos-duration="1000">
      <div class="service_content_wrap2">
        <div class="container">
          <div class="row services2_content d-flex justify-content-between">

            <div class="col-6 col-sm-4 col-lg-3">
              <div class="service_inner_content d-flex justify-content-center align-items-center" data-aos="fade-up"
                data-aos-duration="500">
                <div class="service_content_icon rounded-pill me-3">
                  <img src="{{ asset('assets/images/services/service1.png') }}" alt="image_not_found">
                </div>
                <h6 class="service_content_title">Sản phẩm từ nông trại hữu cơ</h6>
              </div>
            </div>

            <div class="col-6 col-sm-4 col-lg-3">
              <div class="service_inner_content d-flex justify-content-center align-items-center" data-aos="fade-up"
                data-aos-duration="1000">
                <div class="service_content_icon rounded-pill me-3">
                  <img src="{{ asset('assets/images/services/service2.png') }}" alt="image_not_found">
                </div>
                <h6 class="service_content_title">Giao hàng tận nhà miễn phí</h6>
              </div>
            </div>

            <div class="col-6 col-sm-4 col-lg-3">
              <div class="service_inner_content d-flex justify-content-center align-items-center" data-aos="fade-up"
                data-aos-duration="1500">
                <div class="service_content_icon rounded-pill me-3">
                  <img src="{{ asset('assets/images/services/service3.png') }}" alt="image_not_found">
                </div>
                <h6 class="service_content_title">Khuyến mãi trong tuần</h6>
              </div>
            </div>

            <div class="col-6 col-sm-4 col-lg-3">
              <div class="service_inner_content d-flex justify-content-center align-items-center" data-aos="fade-up"
                data-aos-duration="2000">
                <div class="service_content_icon rounded-pill me-3">
                  <img src="{{ asset('assets/images/services/service4.png') }}" alt="image_not_found">
                </div>
                <h6 class="service_content_title">Giảm 10% cho tất cả rau củ</h6>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
    <!-- service section end -->

    <!-- product section-2 start -->
    <section class="product_section_2 sec_space_xms_60" data-aos="fade-up" data-aos-duration="1000">
      <div class="product_section_2_wrap">
        <div class="container">
          <div class="row align-items-center">

            <div class="col-md-6">
              <div class="product_gallery" data-aos="fade-up" data-aos-duration="1000">
                <img src="{{ asset('assets/images/sales/sale8.png') }}" alt="image_not_found">
              </div>
            </div>

            <div class="col-md-6">
              <div class="product_section_content" data-aos="fade-up" data-aos-duration="1000">

                <div class="product_sec_sub_title d-flex align-items-center pb-2">
                  <i class="far fa-circle"></i>
                  <i class="far fa-circle"></i>
                  <i class="far fa-circle"></i>
                  <span class="ps-1">TƯƠI NGON TỪ NÔNG TRẠI CỦA CHÚNG TÔI</span>
                </div>

                <div class="product_section_title py-2">
                  <h2>Cửa hàng thực phẩm hữu cơ đáng tin cậy</h2>
                </div>

                <div class="product_section_subtitle position-relative">
                  <p class="pb-0">
                    Chúng tôi cung cấp các sản phẩm hữu cơ sạch, chất lượng cao, được nuôi trồng tự nhiên và an toàn cho
                    sức khỏe.
                  </p>
                </div>

                <div class="product_section_desc">
                  <p>
                    Rau củ được thu hoạch trực tiếp từ nông trại, đảm bảo độ tươi ngon. Mỗi sản phẩm đều trải qua quá
                    trình kiểm định nghiêm ngặt để mang đến sự an tâm tuyệt đối cho gia đình bạn.
                  </p>
                </div>

                <div class="product_section_btn">
                  <a href="{{ route('contact') }}"><button type="button"
                      class="btn custom_btn load_more_1 rounded-pill px-5 py-3 text-white">Liên hệ<i
                        class="fas fa-long-arrow-alt-right"></i>
                    </button></a>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
    <!-- product section-2 end -->


    <!-- trend section start -->
    <section class="trend_section position-relative sec_top_space_70" data-aos="fade-up" data-aos-duration="1000">
      <div class="trend_section_wrap position-relative overflow-hidden sec_space_xlarge"
        style="background-image: url({{ asset('assets/images/trends/trend1.png') }})">
        <div class="container">
          <div class="trend_top_content">
            <div class="trend_sub_title d-flex align-items-center justify-content-center">
              <i class="far fa-circle"></i>
              <i class="far fa-circle"></i>
              <i class="far fa-circle"></i>
              <span class="text-uppercase px-3">TƯƠI NGON TỪ TRANG TRẠI CỦA CHÚNG TÔI</span>
              <i class="far fa-circle"></i>
              <i class="far fa-circle"></i>
              <i class="far fa-circle"></i>
            </div>
            <div class="trend_top_title text-center pb-4">
              <h2>Xu hướng tốt nhất</h2>
            </div>
          </div>
          <div class="row justify-content-center text-center">
            <div class="col-sm-6 col-lg-4">
              <div class="trend_inner_content position-relative" data-aos="fade-right" data-aos-duration="1500">
                <div class="trend_thumb">
                  <img src="{{ asset('assets/images/trends/trend4.png') }}" alt="image_not_found">
                </div>
                <div class="trend_inner_text position-absolute">
                  <h4 class="text-white">Nhận mọi loại rau bạn cần</h4>
                  <a href="{{ route('shop') }}" class="text-white">Mua sắm ngay <i
                      class="fas fa-long-arrow-alt-right text-white"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-4">
              <div class="trend_inner_content position-relative" data-aos="fade-up" data-aos-duration="1500">
                <div class="trend_thumb">
                  <img src="{{ asset('assets/images/trends/trend5.png') }}" alt="image_not_found">
                </div>
                <div class="trend_inner_text position-absolute">
                  <h4 class="text-white">Mọi loại thực phẩm đầy đủ cho gia đình</h4>
                  <a href="{{ route('shop') }}" class="text-white">Mua sắm ngay <i
                      class="fas fa-long-arrow-alt-right text-white"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-4">
              <div class="trend_inner_content position-relative" data-aos="fade-left" data-aos-duration="1500">
                <div class="trend_thumb">
                  <img src="{{ asset('assets/images/trends/trend6.png') }}" alt="image_not_found">
                </div>
                <div class="trend_inner_text position-absolute">
                  <h4 class="text-white">Thực phẩm sạch cho bữa ăn hạnh phúc</h4>
                  <a href="{{ route('shop') }}" class="text-white">Mua sắm ngay <i
                      class="fas fa-long-arrow-alt-right text-white"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- trend section end -->

    <!-- sale2 section start -->
    <section class="sale2_section" data-aos="fade-up" data-aos-duration="1000">
      <div class="sale2_section_wrap sec_space_xxlarge d-flex justify-content-center align-items-center"
        style="background-image: url(assets/images/backgrounds/bg20.png)">
        <div class="container">
          <div class="row">
            <div class="col-lg-6"></div>
            <div class="col-lg-6">
              <div class="sale2_content_wrap ps-3">
                <div class="sale2_sub_title pb-3 position-relative">
                  <img class="sub_title_bg" src="assets/images/shapes/shape2.png" alt="image_not_found">
                  <h6 class="text-white text-uppercase position-absolute">SỐNG HỮU CƠ. SỐNG KHỎE MẠNH.</h6>
                </div>
                <div class="sale2_title py-2">
                  <h2>Giảm 10% <br> Tất cả <font class="text-effect">
                      Sản phẩm trái cây
                    </font>
                  </h2>
                </div>
                <div class="sale2_desc">
                  <p>Khám phá các sản phẩm hữu cơ tươi ngon, an toàn cho sức khỏe của bạn và gia đình.
                    Các loại rau củ được chăm sóc tự nhiên, giữ trọn hương vị và dinh dưỡng.
                    Mua ngay để nhận ưu đãi đặc biệt chỉ trong thời gian giới hạn!</p>
                </div>
                <div class="sale2_btn load_more_3">
                  <a href="{{ route('shop') }}">
                    <button type="button" class="btn custom_btn rounded-pill px-5 py-3 text-white">Mua sắm ngay <i
                        class="fas fa-long-arrow-alt-right"></i></button>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- sale2 section end -->


    <!-- product section start -->
    <section class="product_section home2_product_sec" data-aos="fade-up" data-aos-duration="1000">
      <div class="container">

        <div class="row">
          <div class="col-lg-6">
            <div class="product_sec_content">
              <div class="product_sec_sub_title d-flex align-items-center pb-2">
                <i class="far fa-circle"></i>
                <i class="far fa-circle"></i>
                <i class="far fa-circle"></i>
                <span class="ps-1">TƯƠI NGON TỪ NÔNG TRẠI</span>
              </div>
              <h2 class="product_sec_title pb-3">Sản Phẩm Hữu Cơ Chất Lượng</h2>
            </div>
          </div>
          <div class="col-lg-6 text-center text-lg-end">
            <a href="{{ route('shop') }}"><button type="button"
                class="btn custom_btn rounded-pill px-4 py-2 text-white">Khám
                Phá Thêm <i class="fas fa-long-arrow-alt-right"></i></button></a>
          </div>
        </div>

        <div class="row g-4">
          @foreach ($products as $product)
            <div class="col-sm-6 col-md-6 col-xl-3">
              <x-product-card :product="$product" />
            </div>
          @endforeach
        </div>
      </div>
    </section>
    <!-- product section end -->

    <!-- blog section start -->
    <section class="blog_section sec_space_xlarge position-relative" data-aos="fade-up" data-aos-duration="1000">
      <div class="blog_section_wrap">
        <div class="container-fluid-full ">
          <div class="quality_top_content text-center">
            <div class="quality_sub_title d-flex justify-content-center align-items-center pb-2">
              <i class="far fa-circle"></i>
              <i class="far fa-circle"></i>
              <i class="far fa-circle"></i>
              <span class="px-2">TƯƠI NGON TỪ NÔNG TRẠI</span>
              <i class="far fa-circle"></i>
              <i class="far fa-circle"></i>
              <i class="far fa-circle"></i>
            </div>
            <div class="blog_top_title pb-5">
              <h2>Bài Viết Mới Nhất</h2>
            </div>
          </div>

          @foreach ($posts->chunk(2) as $rowIndex => $row)
            <div class="row p-0">
              @foreach ($row as $postIndex => $post)
                @php
                  $firstIsThumb = $rowIndex % 2;

                  $blocks = $firstIsThumb ? ['thumb', 'content'] : ['content', 'thumb'];
                @endphp

                @foreach ($blocks as $type)
                  @if ($type === 'thumb')
                    <div class="col-md-6 col-xl-3 p-0 @if ($firstIsThumb) order-2 order-md-0 @endif">
                      <a class="d-block" href="{{ route('posts.show', ['post_slug' => $post->slug]) }}"
                        style="height: 100%; min-height: 450px">
                        <div class="blog_content_thumb"
                          style="background-image: url({{ image_url($post->images[0]) }}); width: 100%; height: 100%;object-fit: cover;"
                          data-aos="fade-right" data-aos-duration="1000">
                        </div>
                      </a>
                    </div>
                  @else
                    <div class="col-md-6 col-xl-3 p-0 @if ($firstIsThumb) order-1 order-md-0 @endif">
                      <div
                        class="blog_content_text d-flex flex-column justify-content-center align-items-center text-center"
                        data-aos="fade-right" data-aos-duration="1500">

                        <div class="blog_subtitle text-uppercase d-inline-block">
                          <h6 class="text-white">{{ optional($post->categories->first())->title ?? 'Chưa phân loại' }}
                          </h6>
                        </div>

                        <div class="blog_title pt-3">
                          <a href="{{ route('posts.show', ['post_slug' => $post->slug]) }}">
                            <h2>{{ $post->title }}</h2>
                          </a>
                        </div>

                        <div class="blog_icon">
                          <img src="{{ asset('assets/images/shapes/shape20.png') }}" alt="image_not_found">
                        </div>

                        <div class="blog_desc py-3">
                          <p>{{ $post->description }}</p>
                        </div>
                      </div>
                    </div>
                  @endif
                @endforeach
              @endforeach
            </div>
          @endforeach
        </div>
      </div>
    </section>
    <!-- blog section end -->

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
                      <img src="{{ image_url($testimonial->image) }}" alt="image_not_found"
                        style="object-fit: cover;">
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

          {{-- <div class="row g-4">
            <div class="offer_delivery_wrap sec_space_xs_70 mt-5">
              <div class="offer_delivery_content inner_p_all_70 d-flex align-items-center justify-content-between"
                style="background-image: url({{ asset('assets/images/offer/offer5.png') }})">
                <div class="offer_delivery_title">
                  <span>100% <font>An toàn</font> Không Tiếp Xúc Trực Tiếp</span>
                </div>
                <div class="offer_delivery_btn">
                  <a href="{{ route('shop') }}" target="_blank" class="custom_btn rounded-pill">
                    <button type="button" class="btn text-white">Mua sắm ngay <span><i
                          class="fas fa-long-arrow-alt-right"></i></span></button>
                  </a>
                </div>
              </div>
            </div>
          </div> --}}
        </div>
      </div>
    </section>
    <!-- testimonial-3 section end  -->

    <!-- instagram section start -->
    <section class="instagram_section instagram_style_1 instagram_2 position-relative sec_space_xs_70"
      data-aos="fade-up" data-aos-duration="1000"
      style="background-image: url({{ asset('assets/images/gallery/gallery1.png') }})">
      <div class="container">
        <div class="product_sec_sub_title d-flex justify-content-center align-items-center pb-2">
          <i class="far fa-circle"></i>
          <i class="far fa-circle"></i>
          <i class="far fa-circle"></i>
          <span class="px-2 text-uppercase">Đối tác</span>
          <i class="far fa-circle"></i>
          <i class="far fa-circle"></i>
          <i class="far fa-circle"></i>
        </div>
        <h2 class="instagram_title pb-5 text-center">Đối tác của chúng tôi</h2>

        <style>
          .slideshow4_slider .slick-slide {
            margin: 0 10px;
          }

          .slideshow4_slider .slick-list {
            margin: 0 -10px;
          }

          .slideshow4_slider a {
            border-radius: 10px;
            overflow: hidden;
          }

          .slideshow4_slider img {
            width: 100%;
            height: 180px;
            object-fit: contain;
            display: block;
          }

          .zoom-gallery a span {
            top: 50%
          }

          .zoom-gallery a {
            background-color: #fff;
          }

          .zoom-gallery a:hover img {
            opacity: 1;
          }
        </style>

        <ul class="zoom-gallery instagram_image_content slideshow4_slider">
          @foreach ($partners as $partner)
            <li>
              <a href="{{ $partner->description }}" target="_blank">
                <img src="{{ image_url($partner->image) }}" alt="{{ $partner->title }}">
              </a>
            </li>
          @endforeach
          @foreach ($partners as $partner)
            <li>
              <a href="{{ $partner->description }}" target="_blank">
                <img src="{{ image_url($partner->image) }}" alt="{{ $partner->title }}">
              </a>
            </li>
          @endforeach
        </ul>
      </div>
    </section>
    <!-- instagram section end -->

  </main>
  <!-- main body end -->
</x-app-layout>
