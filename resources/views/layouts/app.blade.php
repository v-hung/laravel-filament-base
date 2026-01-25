@props([
    'cart' => [],
    'cart_total' => 0,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title', setting('shop.site_name', config('app.name')))</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">

  <!-- Include fontawesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Include google fonts CDN -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap"
    rel="stylesheet">

  <!-- Include bootstrap CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

  <!-- Include aos CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">

  <!-- Include magnific-popup CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">

  <!-- Include nice-select CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">

  <!-- Include slick CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">

  <!-- Include slick-theme CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/slick-theme.css') }}">

  <!-- Include slick CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">

  <!-- Include stylesheet CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

  @include('layouts.routes')

  @livewireStyles
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @stack('styles')
</head>

<body>
  <div class="body-wrap overflow-hidden">
    @include('layouts.partials.header')

    @include('layouts.partials.sidebar')

    {{ $slot }}

    @include('layouts.partials.footer')

    <!-- quick-view start -->

    {{-- <div class="modal fade quick_view" id="product_quick_view" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content position-relative">
          <button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close"><i
              class="fas fa-times"></i></button>
          <div class="modal-body p-0">
            <div class="container-fluid-full product10_wrap sec_space_small"
              style="background-image: url(assets/images/backgrounds/bg17.png)">
              <div class="row justify-content-center p-5">
                <div class="col-lg-6">
                  <div class="product10_thumb_content d-flex flex-column">
                    <div class="product11_slide_item">
                      <div class="d-flex justify-content-center align-items-center position-relative overflow-hidden">
                        <img src="assets/images/product/product40.png" alt="image_not_found">
                      </div>
                      <div class="d-flex justify-content-center align-items-center position-relative overflow-hidden">
                        <img src="assets/images/product/product40.png" alt="image_not_found">
                      </div>
                      <div class="d-flex justify-content-center align-items-center position-relative overflow-hidden">
                        <img src="assets/images/product/product40.png" alt="image_not_found">
                      </div>
                    </div>

                    <div class="product10_thumb_item product11_slide_thumb">
                      <div class="thumb_item">
                        <a href="javascript:void(0)"><img src="assets/images/product/product6.png" alt="image_not_found"></a>
                      </div>
                      <div class="thumb_item">
                        <a href="javascript:void(0)"><img src="assets/images/product/product8.png" alt="image_not_found"></a>
                      </div>
                      <div class="thumb_item">
                        <a href="javascript:void(0)"><img src="assets/images/product/product23.png" alt="image_not_found"></a>
                      </div>
                      <div class="thumb_item">
                        <a href="javascript:void(0)"><img src="assets/images/product/product6.png" alt="image_not_found"></a>
                      </div>
                      <div class="thumb_item">
                        <a href="javascript:void(0)"><img src="assets/images/product/product8.png" alt="image_not_found"></a>
                      </div>
                      <div class="thumb_item">
                        <a href="javascript:void(0)"><img src="assets/images/product/product23.png" alt="image_not_found"></a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="rating_wrap d-flex justify-content-between">
                    <div class="rating_review_cont d-flex d-flex align-items-center">
                      <ul class="rating_star ul_li">
                        <li class="active"><i class="fas fa-star"></i></li>
                        <li class="active"><i class="fas fa-star"></i></li>
                        <li class="active"><i class="fas fa-star"></i></li>
                        <li class="active"><i class="fas fa-star"></i></li>
                        <li><i class="far fa-star"></i></li>
                      </ul>
                      <a href="javascript:void(0)" class="review">Read 3 Reviews</a>
                    </div>
                    <div class="product_btn">
                      <a href="#"><button type="button"
                          class="btn custom_btn rounded-pill px-4 text-white">Smoothies</button></a>
                    </div>
                  </div>
                  <h2 class="product_detail_title">Good Organic Products</h2>
                  <p class="product_detail_desc py-2">Morbi eget congue lectus. Donec eleifend
                    ultricies urna
                    et euismod. Sed consectetur tellus eget odio aliquet, vel vestibulum tellus
                    sollicitudin.
                    Morbi maximus metus eu eros tincidunt, vitae mollis ante imperdiet. Nulla
                    imperdiet at
                    mauris ut posuere. Nam at ultrices justo.</p>
                  <div class="product10_quantity_btn_wrap d-flex align-items-center">
                    <div class="quantity_input bg-white">
                      <form action="#">
                        <span class="input_number_decrement">–</span>
                        <input class="input_number" value="2KG">
                        <span class="input_number_increment">+</span>
                      </form>
                    </div>
                    <a href="#"><button type="button"
                        class="btn custom_btn rounded-pill ms-3 px-5 py-3 text-white">Order Now
                        <i class="fas fa-long-arrow-alt-right"></i></button></a>
                  </div>
                  <div class="product_tags_wrap d-flex align-items-center mt-5">
                    <h6 class="product_tags_title text-uppercase">tags:</h6>
                    <div class="tags_item d-flex align-items-center">
                      <a href="javascript:void(0)">T-shirt,</a>
                      <a class="ms-1" href="javascript:void(0)">Clothes,</a>
                      <a class="ms-1" href="javascript:void(0)">Fashion,</a>
                      <a class="ms-1" href="javascript:void(0)">Shop</a>
                    </div>
                  </div>
                  <div class="product_social_links d-flex align-items-center">
                    <h6 class="product_social_title text-uppercase">share:</h6>
                    <ul class="list-unstyled d-flex mb-0">
                      <li><a href="javascript:void(0)"><i class="fab fa-facebook-f"></i></a></li>
                      <li><a href="javascript:void(0)"><i class="fab fa-twitter"></i></a></li>
                      <li><a href="javascript:void(0)"><i class="fab fa-google-plus-g"></i></a></li>
                      <li><a href="javascript:void(0)"><i class="fab fa-pinterest-p"></i></a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> --}}

    <!-- quick-view end -->
  </div>

  <x-notifications />

  <!-- Include jquery js -->
  <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

  <!-- Include bootstrap-bundle js -->
  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Include aos js -->
  <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>

  <!-- Include aos js -->
  <script src="{{ asset('assets/js/aos.js') }}"></script>

  <!-- Include jquery-magnific-popup js -->
  <script src="{{ asset('assets/js/magnific-popup.min.js') }}"></script>

  <!-- Include nice-select js -->
  <script src="{{ asset('assets/js/nice-select.min.js') }}"></script>

  <!-- Include jquery-countdown js -->
  <script src="{{ asset('assets/js/countdown.min.js') }}"></script>

  <!-- Include slick js -->
  <script src="{{ asset('assets/js/slick.min.js') }}"></script>

  <!-- Include custom js -->
  <script src="{{ asset('assets/js/custom.js') }}"></script>

  @livewireScriptConfig
  @stack('scripts')
</body>

</html>
