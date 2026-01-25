<x-app-layout :cart="$cart" :cart_total="$cart_total">
  <!-- main body start -->
  <main>

    <!-- Breadcrumb section start -->
    <section class="breadcrumb_sec_1 position-relative">
      <div class="breadcrumb_wrap sec_space_mid_small"
        style="background-image: url({{ asset('assets/images/breadcrumb/breadcrumb1.png') }});">
        <div class="breadcrumb_cont text-center">
          <div class="breadcrumb_title">
            <h2 class="text-white">{{ $product->name }}</h2>
          </div>
          <ul class="list-unstyled breadcrumb_item d-flex justify-content-center align-items-center text-white">
            <li><a href="{{ route('home') }}"><i class="fas fa-home active"></i>Trang chủ</a></li>
            <li><a href="{{ route('shop') }}"><i class="fas fa-chevron-right"></i>Cửa hàng</a></li>
            <li><i class="fas fa-chevron-right"></i>Chi tiết sản phẩm</li>
          </ul>
        </div>
      </div>
    </section>
    <!-- Breadcrumb section end -->


    <!-- product-10 section start -->
    <section class="product10_sec position-relative" data-aos="fade-up" data-aos-duration="500">
      <div class="product10_wrap sec_space_small"
        style="background-image: url({{ asset('assets/images/backgrounds/bg16.png') }})">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6">
              <!-- User this HTML for Slider -->
              <section class="banner-section">
                <div class="container">
                  <div class="vehicle-detail-banner banner-content clearfix">
                    <div class="banner-slider">
                      <div class="slider slider-nav thumb-image">
                        @foreach ($product->images as $image)
                          <div class="thumbnail-image">
                            <div class="thumbImg bg-white">
                              <a href="javascript:void(0)"><img src="{{ image_url($image) }}"
                                  alt="{{ $product->name }}"></a>
                            </div>
                          </div>
                        @endforeach
                      </div>

                      <div class="slider slider-for">
                        @foreach ($product->images as $image)
                          <div class="slider-banner-image img_moving_anim1 bg-white">
                            <img src="{{ image_url($image) }}" alt="{{ $product->name }}">
                          </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <!-- End User this HTML for Slider -->
            </div>
            <div class="col-lg-6">
              <div class="rating_wrap d-flex justify-content-between">
                <div class="rating_review_cont d-flex d-flex align-items-center">
                  <ul class="rating_star ul_li">
                    <li class="active"><i class="fas fa-star"></i></li>
                    <li class="active"><i class="fas fa-star"></i></li>
                    <li class="active"><i class="fas fa-star"></i></li>
                    <li class="active"><i class="fas fa-star"></i></li>
                    <li class="active"><i class="fas fa-star"></i></li>
                  </ul>
                </div>
                {{-- <div class="product_btn">
                  <a href="javascript:void(0)"><button type="button"
                      class="btn custom_btn rounded-pill px-4 text-white">Smoothies</button></a>
                </div> --}}
              </div>
              <h2 class="product_detail_title">{{ $product->name }}</h2>
              <p class="product_detail_desc py-2">{{ $product->description }}</p>
              {{-- <div class="row mt-5">
                <div class="col-8">
                  <div class="product10_value_content">
                    <h4 class="value_title mb-3">Nutritional Values:</h4>
                    <div class="product10_value_table bg-white shadow-lg">
                      <table class="table">
                        <tbody>
                          <tr>
                            <th scope="row">50G</th>
                            <td>Carbohydrates</td>
                          </tr>
                          <tr>
                            <th scope="row">10G</th>
                            <td>Protein, Engry</td>
                          </tr>
                          <tr>
                            <th scope="row">20G</th>
                            <td> Minerals, and vitamins</td>
                          </tr>
                          <tr>
                            <th scope="row">90G</th>
                            <td>Nutrient requirements</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div> --}}
              <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="product10_quantity_btn_wrap d-flex align-items-center">
                  <div class="quantity_input bg-white">
                    <span class="input_number_decrement">–</span>
                    <input class="input_number" value="1" name="quantity">
                    <span class="input_number_increment">+</span>
                  </div>
                  <a href="javascript:void(0)"><button type="submit"
                      class="btn custom_btn rounded-pill ms-3 px-5 py-3 text-white">Thêm vào giỏ hàng <i
                        class="fas fa-long-arrow-alt-right"></i></button></a>
                </div>
              </form>
              @if (count($product->collections) > 0)
                <div class="product_tags_wrap d-flex align-items-center mt-5">
                  <h6 class="product_tags_title text-uppercase">Danh mục:</h6>
                  <div class="tags_item d-flex align-items-center">
                    @foreach ($product->collections as $index => $collection)
                      <a href="{{ route('shop') }}?collections[]={{ $collection->slug }}"
                        @if ($index > 0) class="ms-1" @endif>{{ $collection->title }} @if ($index < count($product->collections) - 1)
                          ,
                        @endif
                      </a>
                    @endforeach
                  </div>
                </div>

              @endif
              <div class="product_social_links d-flex align-items-center">
                <h6 class="product_social_title text-uppercase">Chia sẻ:</h6>
                @php
                  $productUrl = urlencode(request()->url());
                  $productName = urlencode($product->name ?? '');
                @endphp
                <ul class="list-unstyled d-flex mb-0">
                  <!-- Facebook -->
                  <li>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $productUrl }}" target="_blank"
                      rel="noopener">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                  </li>

                  <!-- Twitter -->
                  <li>
                    <a href="https://twitter.com/intent/tweet?text={{ $productName }}&url={{ $productUrl }}"
                      target="_blank" rel="noopener">
                      <i class="fab fa-twitter"></i>
                    </a>
                  </li>

                  <!-- Pinterest -->
                  <li>
                    <a href="https://pinterest.com/pin/create/button/?url={{ $productUrl }}&description={{ $productName }}"
                      target="_blank" rel="noopener">
                      <i class="fab fa-pinterest-p"></i>
                    </a>
                  </li>

                  <!-- Gmail / Email -->
                  <li>
                    <a href="mailto:?subject={{ $productName }}&body=Check out this product: {{ $productUrl }}"
                      target="_blank" rel="noopener">
                      <i class="fas fa-envelope"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- product-10 side thumb-->
      <div class="product10_left_thumb3 position-absolute">
        <img src="{{ asset('assets/images/shapes/shape25.png') }}" alt="image_not_found">
      </div>
      <div class="product10_right_thumb4 position-absolute">
        <img src="{{ asset('assets/images/shapes/shape26.png') }}" alt="image_not_found">
      </div>
    </section>
    <!-- product-10 section end -->

    <!-- product-10 reviews section start -->
    <section class="product10_reviews sec_top_space_70" data-aos="fade-up" data-aos-duration="500">
      <div class="product10_reviews_wrap">
        <div class="container">
          <div class="d-flex justify-content-center justify-content-lg-start align-items-center">
            <ul class="product_tabnav_3 nav nav-pills my-5" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active shadow rounded-pill text-uppercase" id="pills-description-tab"
                  data-bs-toggle="pill" data-bs-target="#pills-description" type="button" role="tab"
                  aria-controls="pills-description" aria-selected="true">description</button>
              </li>
              {{-- <li class="nav-item" role="presentation">
                <button class="nav-link shadow rounded-pill text-uppercase" id="pills-Information-tab"
                  data-bs-toggle="pill" data-bs-target="#pills-Information" type="button" role="tab"
                  aria-controls="pills-Information" aria-selected="false">Additional
                  Information</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link shadow rounded-pill text-uppercase" id="pills-reviews-tab"
                  data-bs-toggle="pill" data-bs-target="#pills-reviews" type="button" role="tab"
                  aria-controls="pills-reviews" aria-selected="false">reviews (3)</button>
              </li> --}}
            </ul>
          </div>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-description" role="tabpanel"
              aria-labelledby="pills-description-tab">
              <div class="row mb_50">
                <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                  <div class="content_wrap ms-3">
                    <h3 class="title_text mb_15">Mô tả:</h3>
                    {!! $product->content !!}
                  </div>
                </div>
              </div>

            </div>
            {{-- <div class="tab-pane fade show" id="pills-Information" role="tabpanel"
              aria-labelledby="pills-Information-tab">
              <div class="row mb_50">
                <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                  <div class="content_wrap ms-3">
                    <h3 class="info_content_title">Why Choose Our Products?</h3>
                    <p class="mb_30">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                      veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                      commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                      velit esse cillum dolore eu fugiat nulla pariatur
                    </p>

                    <h4 class="list_title">Our Product Quality</h4>
                    <p class="mb_30">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                      veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                      commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                      velit esse cillum dolore eu fugiat nulla pariatur
                    </p>

                    <h4 class="list_title">Customar Feedback</h4>
                    <p class="mb_30">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                      veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                      commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                      velit esse cillum dolore eu fugiat nulla pariatur.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade show" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab">
              <div class="row">
                <div class="col-lg-6">
                  <div class="review_comment2 ms-3">
                    <h3 class="title_text">Reviews:</h3>
                    <ul class="review_comment_list2 ul_li_block">
                      <li class="review_comment_wrap2">
                        <h4 class="admin_name">John Doe <span class="comment_date">30 Mar
                            2022</span></h4>
                        <ul class="rating_star ul_li">
                          <li class="active"><i class="fas fa-star"></i></li>
                          <li class="active"><i class="fas fa-star"></i></li>
                          <li class="active"><i class="fas fa-star"></i></li>
                          <li class="active"><i class="fas fa-star"></i></li>
                          <li class="active"><i class="fas fa-star"></i></li>
                        </ul>
                        <p class="mb-0">
                          Duis ante magna, aliquet sit amet sagittis vitae, tristique at
                          lacus. Ut et accumsan turpis. Phasellus ornare, tortor ut congue
                          imperdiet, mauris magna condimentum nulla, non malesuada mauris
                          massa eu augue.
                        </p>
                      </li>
                      <li class="review_comment_wrap2">
                        <h4 class="admin_name">Smith Alex <span class="comment_date">25 Feb
                            2022</span></h4>
                        <ul class="rating_star ul_li">
                          <li class="active"><i class="fas fa-star"></i></li>
                          <li class="active"><i class="fas fa-star"></i></li>
                          <li class="active"><i class="fas fa-star"></i></li>
                          <li class="active"><i class="fas fa-star"></i></li>
                          <li class="active"><i class="fas fa-star"></i></li>
                        </ul>
                        <p class="mb-0">
                          Duis ante magna, aliquet sit amet sagittis vitae, tristique at
                          lacus. Ut et accumsan turpis. Phasellus ornare, tortor ut congue
                          imperdiet, mauris magna condimentum nulla, non malesuada mauris
                          massa eu augue.
                        </p>
                      </li>
                    </ul>
                  </div>

                  <div class="comment_form_area">
                    <form action="#">
                      <div class="row">
                        <h4 class="comment_title">Add New Comment</h4>
                        <div class="col-lg-6">
                          <div class="form_item">
                            <input class="rounded-pill" type="text" name="name" placeholder="Your Name*"
                              required>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form_item">
                            <input class="rounded-pill" type="text" name="name" placeholder="Your Name*"
                              required>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form_item">
                            <input class="rounded-pill" type="email" name="email" placeholder="Email Address*"
                              required>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form_item">
                            <input class="rounded-pill" type="text" name="name" placeholder="Website*"
                              required>
                          </div>
                        </div>
                      </div>
                      <div class="form_item">
                        <textarea name="comment" placeholder="your Comment*"></textarea>
                      </div>
                      <button type="submit" class="btn custom_btn rounded-pill py-3 text-white text-uppercase">Post
                        Comments <i class="fas fa-long-arrow-alt-right"></i></button>
                    </form>
                  </div>
                </div>
              </div>
            </div> --}}
          </div>
        </div>
      </div>
    </section>

    <!-- product section start -->
    @if (count($related_products) > 0)
      <section class="product_section sec_top_space_50 sec_inner_bottom_130" data-aos="fade-up"
        data-aos-duration="500">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="product_sec_content">
                <div class="product_sec_sub_title d-flex align-items-center pb-2">
                  <i class="far fa-circle"></i>
                  <i class="far fa-circle"></i>
                  <i class="far fa-circle"></i>
                  <span>Sản phẩm tươi mới</span>
                </div>
                <h2 class="product_sec_title pb-3">Sản phẩm liên quan</h2>
              </div>
            </div>
            {{-- <div class="col-lg-6 ul_li_right">
            <ul class="countdown_timer ul_li" data-countdown="2023/3/24"></ul>
          </div> --}}
          </div>

          <div class="row g-4">
            @foreach ($related_products as $product)
              <div class="col-sm-6 col-lg-3">
                <x-product-card :product="$product" />
              </div>
            @endforeach
          </div>
        </div>
      </section>
    @endif
    <!-- product section end -->
  </main>
  <!-- main body end -->
</x-app-layout>
