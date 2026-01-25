<div class="backtotop">
  <a href="javascript:void(0)" class="scroll">
    <i class="fas fa-arrow-up fw-bold"></i>
  </a>
</div>
<!-- back-to-top end -->

<!-- header section start -->
<header class="header_section header_1">
  <!-- top header start -->
  <div class="top_header_main d-none d-sm-block">
    <div class="container">
      <div class="header_top d-flex align-items-center justify-content-between">
        <div class="header_top_content d-flex pt-2">
          <div class="mail_text_content d-flex">
            <p class="mail_icon"><span><i class="far fa-envelope text-white pe-2"></i></span></p>
            <p class="mail_text">{{ setting('shop.site_email') }}</p>
          </div>
          <div class="address_text_content d-flex">
            <p class="mail_icon"><span><i class="fas fa-map-marker-alt text-white pe-2"></i></span></p>
            <p class="address_text">{{ setting('shop.site_address') }}</p>
          </div>
        </div>
        <div class="header_top_socials pt-2">
          {{-- <ul class="list-unstyled d-flex">
            <li><a href="javascript:void(0)"><i class="fab fa-facebook-f text-white pe-3"></i></a></li>
            <li><a href="javascript:void(0)"><i class="fab fa-twitter text-white pe-3"></i></a></li>
            <li><a href="javascript:void(0)"><i class="fab fa-instagram text-white pe-3"></i></a></li>
            <li><a href="javascript:void(0)"><i class="fab fa-linkedin-in text-white"></i></a></li>
          </ul> --}}
        </div>
      </div>
    </div>
  </div>
  <!-- top header end -->

  <!-- bottom header start -->
  <div class="header_bottom_main">
    <div class="container">
      <!-- web menubar start-->
      <div class="webMenu d-none d-lg-block position-relative">
        <nav class="navbar navbar-expand-lg navbar-light">
          <a class="navbar-brand position-relative" href="{{ route('home') }}"
            style="display: flex;height: 56px;width: 179px;justify-content: center;align-items: center;">
            <img src="{{ image_url(setting('shop.site_logo')) }}" alt="{{ setting('shop.site_name') }}"
              style="height: 56px">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav main_menu_list m-auto after_navbar">
              <li class="nav-item nav_item_has_child px-2">
                <a class="nav-link" href="{{ route('home') }}">Trang chủ</a>
              </li>
              <li class="nav-item nav_item_has_child px-2">
                <a class="nav-link" href="{{ route('about') }}">Về chúng tôi</a>
              </li>
              <li class="nav-item nav_item_has_child px-2">
                <a class="nav-link" href="{{ route('shop') }}">Cửa hàng</a>
              </li>
              <li class="nav-item nav_item_has_child px-2">
                <a class="nav-link" href="{{ route('blogs') }}">Tin tức</a>
              </li>
              <li class="nav-item nav_item_has_child px-2">
                <a class="nav-link" href="{{ route('contact') }}">Liên hệ</a>
              </li>
            </ul>
          </div>
          <div class="navbar_user me-2">
            <div class="navbar_user_icon">
              <ul class="list-unstyled d-flex mb-0">
                <li class="pe-3">
                  <button class="main_search_btn" data-bs-toggle="collapse" data-bs-target="#main_search_collapse"
                    aria-expanded="false" aria-controls="main_search_collapse">
                    <i class="search_icon fas fa-search"></i>
                    <i class="search_close fas fa-times"></i>
                  </button>
                </li>
                <li class="pe-2 position-relative">
                  <a href="#collapseExample" data-bs-toggle="collapse" href="#collapseExample" role="button"
                    aria-expanded="false" aria-controls="collapseExample"><i class="far fa-user" data-toggle="collapse"
                      role="button" data-target="#use_deropdown" aria-expanded="false"
                      aria-controls="use_deropdown"></i>
                  </a>
                  <!-- user profile start -->
                  <div id="collapseExample" class="collapse_dropdown collapse">
                    <div class="dropdown_content">
                      @auth
                        <div class="profile_info clearfix">
                          <div class="user_thumbnail">
                            <img src="{{ asset('assets/images/meta/meta2.png') }}" alt="image_not_found">
                          </div>
                          <div class="user_content">
                            <h4 class="user_name">{{ Auth::user()->name }}</h4>
                            <span class="user_title">Khách hàng</span>
                          </div>
                        </div>
                        <ul class="settings_options ul_li_block clearfix">
                          <li>
                            <a href="{{ route('profile') }}"><i class="fas fa-user-circle"></i> Trang cá nhân</a>
                          </li>
                          <li>
                            <form action="{{ route('logout') }}" method="POST">
                              @csrf
                              <a href="javascript:void(0)">
                                <button type="submit">
                                  <i class="fas fa-sign-out-alt"></i> Đăng xuất
                                </button>
                              </a>
                            </form>
                          </li>
                        </ul>
                      @else
                        <ul class="settings_options ul_li_block clearfix">
                          <li>
                            <a href="{{ route('login') }}"><i class="fas fa-user-circle"></i> Đăng nhập</a>
                          </li>
                          <li><a href="{{ route('register') }}"><i class="fas fa-user-circle"></i> Đăng ký</a></li>
                        </ul>
                      @endauth
                    </div>
                  </div>
                </li>
                {{-- <li class="pe-2"><a href="javascript:void(0)"><i class="far fa-heart"></i></a></li> --}}
                <li>
                  <a href="javascript:void(0)">
                    <i class="fas fa-shopping-bag position-relative" data-bs-toggle="offcanvas"
                      data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                      @if (count($cart) > 0)
                        <span
                          class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ count($cart) }}</span>
                      @endif
                    </i></a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- webmenu bottom shape -->
        <div class="webmenu_bottom_shape_left position-absolute">
          <img src="{{ asset('assets/images/shapes/shape1.png') }}" alt="image_not_found">
        </div>
      </div>
      <!-- mobile menubar start -->
      <div class="mobileMenu d-block d-lg-none">
        <nav class="navbar navbar-expand-lg navbar-light">
          <a class="navbar-brand" href="{{ route('home') }}"
            style="display: flex;height: 36px;align-items: center;justify-content: center;">
            <img src="{{ image_url(setting('shop.site_logo')) }}" alt="{{ setting('shop.site_name') }}"
              style="height: 36px">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
            id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header">
              <button type="button" class="btn-close mobile_menu_close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav main_menu_list m-auto">
                <li class="nav-item pe-5">
                  <a class="nav-link" href="{{ route('home') }}">Trang chủ</a>
                </li>
                <li class="nav-item pe-5">
                  <a class="nav-link" href="{{ route('about') }}">Về chúng tôi</a>
                </li>
                <li class="nav-item pe-5">
                  <a class="nav-link" href="{{ route('shop') }}">Cửa hàng</a>
                </li>
                <li class="nav-item pe-5">
                  <a class="nav-link" href="{{ route('blogs') }}">Tin tức</a>
                </li>
                <li class="nav-item pe-5">
                  <a class="nav-link" href="{{ route('contact') }}">Liên hệ</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="navbar_user me-2">
            <div class="navbar_user_icon">
              <ul class="list-unstyled d-flex mb-0">
                <li class="pe-3">
                  <button class="main_search_btn" data-bs-toggle="collapse" data-bs-target="#main_search_collapse"
                    aria-expanded="false" aria-controls="main_search_collapse">
                    <i class="search_icon fas fa-search"></i>
                    <i class="search_close fas fa-times"></i>
                  </button>
                </li>
                <li class="pe-2 position-relative">
                  <a href="#collapseExample" data-bs-toggle="collapse" href="#collapseExample" role="button"
                    aria-expanded="false" aria-controls="collapseExample"><i class="far fa-user"
                      data-toggle="collapse" role="button" data-target="#use_deropdown" aria-expanded="false"
                      aria-controls="use_deropdown"></i>
                  </a>
                  <!-- user profile start -->
                  <div id="collapseExample" class="collapse_dropdown collapse">
                    <div class="dropdown_content">
                      @auth
                        <div class="profile_info clearfix">
                          <div class="user_thumbnail">
                            <img src="{{ asset('assets/images/meta/meta2.png') }}" alt="image_not_found">
                          </div>
                          <div class="user_content">
                            <h4 class="user_name">{{ Auth::user()->name }}</h4>
                            <span class="user_title">Khách hàng</span>
                          </div>
                        </div>
                        <ul class="settings_options ul_li_block clearfix">
                          <li>
                            <a href="{{ route('profile') }}"><i class="fas fa-user-circle"></i> Trang cá nhân</a>
                          </li>
                          <li>
                            <form action="{{ route('logout') }}" method="POST">
                              @csrf
                              <a href="javascript:void(0)">
                                <button type="submit">
                                  <i class="fas fa-sign-out-alt"></i> Đăng xuất
                                </button>
                              </a>
                            </form>
                          </li>
                        </ul>
                      @else
                        <ul class="settings_options ul_li_block clearfix">
                          <li>
                            <a href="{{ route('login') }}"><i class="fas fa-user-circle"></i> Đăng nhập</a>
                          </li>
                          <li><a href="{{ route('register') }}"><i class="fas fa-user-circle"></i> Đăng ký</a></li>
                        </ul>
                      @endauth
                    </div>
                  </div>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <i class="fas fa-shopping-bag position-relative" data-bs-toggle="offcanvas"
                      data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                      @if (count($cart) > 0)
                        <span
                          class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ count($cart) }}</span>
                      @endif
                    </i></a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>
    <!-- collapse search - start -->
    <div class="main_search_collapse collapse" id="main_search_collapse">
      <div class="main_search_form position-relative card">
        <div class="container">
          <form action="/shop">
            <div class="form_item position-relative">
              <input type="search" class="form-control rounded-pill py-3" name="search"
                placeholder="Tìm kiếm sản phẩm...">
              <button type="submit" class="submit_btn"><i class="fas fa-search"></i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- collapse search - end -->
  </div>
</header>
