<!-- footer section start -->
<footer class="footer_section position-relative">
  <div class="footer_section_wrap sec_top_space_50"
    style="background-image: url({{ asset('assets/images/footer/footer.png') }})">
    <div class="container">
      <div class="footer_top_content d-flex flex-column flex-lg-row justify-content-between align-items-center">
        <div class="footer_top_logo">
          <a href="{{ route('home') }}"><img src="{{ image_url(setting('shop.site_logo')) }}" alt="image_not_found"
              style="height: 70px"></a>
        </div>
        <div class="footer_top_subs position-relative">
          <form action="{{ route('contact') }}" method="GET">
            <input class="rounded-pill" type="search" name="phone" placeholder="Số điện thoại của bạn">
            <a href="javascript:void(0)"><button type="submit"
                class="btn custom_btn rounded-pill text-white position-absolute">Đăng ký ngay <i
                  class="fas fa-long-arrow-alt-right"></i></button></a>
          </form>
        </div>
        <div class="footer_top_social">
          @php
            $currentUrl = urlencode(request()->fullUrl());
            $siteName = urlencode(setting('shop.site_name', config('app.name')));
          @endphp
          <ul class="list-unstyled d-flex justify-content-end">
            <!-- Twitter -->
            <li class="me-3">
              <a href="https://twitter.com/intent/tweet?text={{ $siteName }}&url={{ $currentUrl }}"
                target="_blank" rel="noopener">
                <i class="fab fa-twitter"></i>
              </a>
            </li>

            <!-- Facebook -->
            <li class="me-3">
              <a href="https://www.facebook.com/sharer/sharer.php?u={{ $currentUrl }}" target="_blank" rel="noopener">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>

            <!-- LinkedIn -->
            <li class="me-3">
              <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ $currentUrl }}&title={{ $siteName }}"
                target="_blank" rel="noopener">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </li>

            <!-- WhatsApp -->
            <li>
              <a href="https://api.whatsapp.com/send?text={{ $siteName }}%20{{ $currentUrl }}" target="_blank"
                rel="noopener">
                <i class="fab fa-whatsapp"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>

      {{-- <div class="footer_inner_content sec_space_xs_70">
        <div class="footer_inner_content_wrap">
          <div class="row">
            <div class="col-md-6 col-lg-3">
              <div class="footer_inner_choose_content">
                <div class="footer_inner_choose_title">
                  <h4>
                    <a href="javascript:void(0)" class="text-white">Why People Like us</a>
                  </h4>
                </div>
                <div class="footer_inner_choose_desc pt-2">
                  <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip
                    ex ea
                    commodo. Build your online store with WooCommerce the most popular </p>
                </div>
                <div class="footer_inner_choose">
                  <a href="javascript:void(0)"><button type="button" class="btn custom_btn rounded-pill px-4 text-white">View More
                      <i class="fas fa-long-arrow-alt-right"></i></button></a>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-3">
              <div class="footer_inner_info_content">
                <div class="footer_inner_info_title">
                  <h4>
                    <a href="javascript:void(0)" class="text-white">Information</a>
                  </h4>
                </div>
                <div class="footer_inner_info_item pt-2">
                  <ul class="list-unstyled">
                    <li><a href="javascript:void(0)">About Us</a></li>
                    <li><a href="javascript:void(0)">Delivery Information</a></li>
                    <li><a href="javascript:void(0)">Privacy Policy</a></li>
                    <li><a href="javascript:void(0)">Terms & Conditions</a></li>
                    <li><a href="javascript:void(0)">Return Policy</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-3">
              <div class="footer_inner_acct_content">
                <div class="footer_inner_acct_title">
                  <h4>
                    <a href="javascript:void(0)" class="text-white">My Account</a>
                  </h4>
                </div>
                <div class="footer_inner_acct_item pt-2">
                  <ul class="list-unstyled">
                    <li><a href="javascript:void(0)">My Account</a></li>
                    <li><a href="javascript:void(0)">Shopping Cart</a></li>
                    <li><a href="javascript:void(0)">Wishlist</a></li>
                    <li><a href="javascript:void(0)">Order History</a></li>
                    <li><a href="javascript:void(0)">International Orders</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-3">
              <div class="footer_inner_cotc_content">
                <div class="footer_inner_ctc_title">
                  <h4>
                    <a href="javascript:void(0)" class="text-white">Contact Us</a>
                  </h4>
                </div>
                <div class="footer_inner_ctc_info pt-2 text-white">
                  <p>Address: <font>1429 Netus Rd, NY 48247</font>
                  </p>
                  <p>Email: <font>Organi@gmail.com</font>
                  </p>
                  <p>Phone: <font>(+87) 4886-4174</font>
                  </p>
                  <div class="footer_inner_payment_ctc">
                    <div class="footer_inner_payment_title">
                      <h5 class="text-white">Payment Accepted</h5>
                    </div>
                    <div class="footer_inner_payment_thumb pt-3">
                      <a href="javascript:void(0)"><img src="{{ asset('assets/images/payment/payment.png') }}"
                          alt="image_not_found"></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> --}}

      <div class="footer_bootom_content" style="margin-top: 77px;">
        <div class="footer_bootom_wrap">
          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <div class="footer_bootom_copyright">
                  <p>Copyright © 2020 <font>{{ setting('shop.site_name') }}</font> Inc. All rights reserved.</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="footer_bootom_privicy_cont d-flex justify-content-center align-items-center">
                  <div class="footer_bootom_privicy pe-5">
                    <p class="priv position-relative">Chính sách bảo mật</p>

                  </div>
                  <div class="footer_bootom_terms pe-5">
                    <p class="position-relative">
                      Điều khoản sử dụng</p>
                  </div>
                  <div class="footer_bootom_refunds" style="position: relative; overflow: hidden;">
                    <p>Bán hàng và hoàn tiền</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- footer section end -->
