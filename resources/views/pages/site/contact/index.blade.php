<x-app-layout :cart="$cart" :cart_total="$cart_total">
  @push('styles')
    <style>
      .map_section {
        width: 100% !important;
        height: calc(100% - 100px);
        max-height: 615px;
        min-height: 500px;
      }

      .map_section iframe {
        width: 100% !important;
        height: 100% !important;
      }
    </style>
  @endpush

  <!-- main body start -->
  <main>

    <!-- Breadcrumb section start -->
    <section class="breadcrumb_sec_1 position-relative">
      <div class="breadcrumb_wrap sec_space_mid_small"
        style="background-image: url({{ asset('assets/images/breadcrumb/breadcrumb1.png') }});">
        <div class="breadcrumb_cont text-center">
          <div class="breadcrumb_title">
            <h2 class="text-white">Liên hệ chúng tôi</h2>
          </div>
          <ul class="list-unstyled breadcrumb_item d-flex justify-content-center align-items-center text-white">
            <li><a href="{{ route('home') }}"><i class="fas fa-home active"></i>Trang chủ</a></li>
            <li><i class="fas fa-chevron-right"></i>Liên hệ</li>
          </ul>
        </div>
      </div>
    </section>
    <!-- Breadcrumb section end -->

    <!-- contact-us section start -->
    <section class="contact_us_sec sec_space_small" data-aos="fade-up" data-aos-duration="1000">
      <div class="contact_us_wrap">
        <div class="container">
          <div class="contact_top_cont">
            <div class="row">
              <div class="col-lg-6">
                <div class="contact_us_tetimonial d-flex flex-column" data-aos="fade-right" data-aos-duration="1000">
                  <span class="tetimonial_desc">Từ trang trại đến bàn ăn, chúng tôi kết nối trực tiếp người tiêu dùng
                    với nông dân, mang đến thực phẩm tươi ngon, an toàn và minh bạch.</span>
                </div>
              </div>
              <div class="col-lg-6">
                <p class="contact_top_desc" data-aos="fade-left" data-aos-duration="1000">Chúng tôi mang đến nguồn thực
                  phẩm tươi sạch từ nông trại uy tín, được xử lý và giao nhanh trong ngày, giúp bạn ăn khỏe mỗi ngày và
                  đồng hành cùng nông dân Việt.</p>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- contact-us section end -->

    <!-- contact-info section start -->

    <section class="contact_us_info position-relative" data-aos="fade-up" data-aos-duration="1000"
      style="background-image: url({{ asset('assets/images/backgrounds/bg15.png') }})">
      <div class="comment_area_wrap">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 sec_space_small position-relative">
              <div class="trend_sub_title d-flex align-items-center pb-3">
                <i class="far fa-circle"></i>
                <i class="far fa-circle"></i>
                <i class="far fa-circle"></i>
                <span class="text-uppercase px-3 text-dark">chúng tôi muốn lắng nghe từ bạn</span>
              </div>
              <h3 class="comment_area_title mb-5">Để lại bình luận</h3>
              <div class="comment_form_area">
                <form action="#">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form_item">
                        <input class="rounded-pill" type="text" name="name" placeholder="Tên của bạn*"
                          class="@error('name') is-invalid @enderror" required>
                        @error('name')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form_item">
                        <input class="rounded-pill" type="phone" name="phone"
                          value="{{ request()->input('phone', '') }}" placeholder="Số điện thoại của bạn*"
                          class="@error('phone') is-invalid @enderror" required>
                        @error('phone')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form_item">
                        <input class="rounded-pill" type="email" name="email" placeholder="Địa chỉ email của bạn*"
                          class="@error('email') is-invalid @enderror" required>
                        @error('email')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="form_item">
                    <textarea name="comment" placeholder="Bình luận của bạn*" class="@error('comment') is-invalid @enderror"></textarea>
                    @error('comment')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <button type="submit" class="btn custom_btn rounded-pill py-3 text-white text-uppercase">Gửi <i
                      class="fas fa-long-arrow-alt-right"></i></button>
                </form>
              </div>
              <!-- contact-info-right side thumb -->
              <img class="contact_info_thumb_right position-absolute"
                src="{{ asset('assets/images/product/product36.png') }}" alt="image_not_found">
            </div>
            <div class="col-lg-6 pb-4">
              <div class="map_section clearfix">
                {!! setting('shop.site_map') !!}
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- contact-info-left side thumb -->
      <img class="contact_info_thumb_left position-absolute" src="{{ asset('assets/images/shapes/shape22.png') }}"
        alt="image_not_found">

    </section>
    <!-- contact-info section end -->

    <!-- address-section start -->
    <section class="address_sec sec_space_small" data-aos="fade-up" data-aos-duration="1000">
      <div class="address_sec_wrap">
        <div class="container-sm">
          <div class="row g-5 justify-content-center align-items-center">
            <div class="col-md-6 col-lg-4 text-center">
              <div class="address_sec_cont d-flex flex-column position-relative" data-aos="fade-right"
                data-aos-duration="1000">
                <div class="address_author bg-white position-absolute">
                  <i class="fas fa-user-tie"></i>
                </div>
                <div class="trend_sub_title d-flex align-items-center justify-content-center pb-2">
                  <i class="far fa-circle"></i>
                  <i class="far fa-circle"></i>
                  <i class="far fa-circle"></i>
                  <span class="text-uppercase px-3">Tìm hiểu</span>
                  <i class="far fa-circle"></i>
                  <i class="far fa-circle"></i>
                  <i class="far fa-circle"></i>
                </div>
                <h4 class="address_title">Về chúng tôi</h4>
                <p class="address_desc">{{ setting('shop.site_description') }}</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-4 text-center">
              <div class="address_sec_cont d-flex flex-column position-relative" data-aos="fade-up"
                data-aos-duration="1000">
                <div class="address_author bg-white position-absolute">
                  <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="trend_sub_title d-flex align-items-center justify-content-center pb-2">
                  <i class="far fa-circle"></i>
                  <i class="far fa-circle"></i>
                  <i class="far fa-circle"></i>
                  <span class="text-uppercase px-3">Ghé thăm</span>
                  <i class="far fa-circle"></i>
                  <i class="far fa-circle"></i>
                  <i class="far fa-circle"></i>
                </div>
                <h4 class="address_title">Địa chỉ của chúng tôi</h4>
                <p class="address_desc">{{ setting('shop.site_address') }}</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-4 text-center">
              <div class="address_sec_cont d-flex flex-column position-relative" data-aos="fade-left"
                data-aos-duration="1000">
                <div class="address_author2 bg-white position-absolute">
                  <i class="fas fa-phone-volume"></i>
                </div>
                <div class="address_author3 bg-white position-absolute">
                  <i class="far fa-envelope"></i>
                </div>
                <div class="trend_sub_title d-flex align-items-center justify-content-center pb-2">
                  <i class="far fa-circle"></i>
                  <i class="far fa-circle"></i>
                  <i class="far fa-circle"></i>
                  <span class="text-uppercase px-3">Call or write</span>
                  <i class="far fa-circle"></i>
                  <i class="far fa-circle"></i>
                  <i class="far fa-circle"></i>
                </div>
                <h4 class="address_title">Liên hệ</h4>
                <p class="address_desc">{{ setting('shop.site_phone') }} {{ setting('shop.site_email') }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- address-section end -->

  </main>
  <!-- main body end -->
</x-app-layout>
