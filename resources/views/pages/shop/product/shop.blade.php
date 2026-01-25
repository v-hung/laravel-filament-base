@php
  $orderOptions = [
      \App\Enums\ProductOrderType::BEST_SELLING->value => 'Bán chạy',
      \App\Enums\ProductOrderType::FEATURED->value => 'Nổi bật',
      \App\Enums\ProductOrderType::LATEST->value => 'Mới nhất',
      \App\Enums\ProductOrderType::PRICE_ASC->value => 'Giá tăng',
      \App\Enums\ProductOrderType::PRICE_DESC->value => 'Giá giảm',
  ];
@endphp

<x-app-layout :cart="$cart" :cart_total="$cart_total">
  <!-- main body start -->
  <main>
    <!-- Breadcrumb section start -->
    <section class="breadcrumb_sec_1 position-relative">
      <div class="breadcrumb_wrap sec_space_mid_small"
        style="background-image: url(assets/images/breadcrumb/breadcrumb1.png);">
        <div class="breadcrumb_cont text-center">
          <div class="breadcrumb_title">
            <h2 class="text-white">Cửa hàng</h2>
          </div>
          <ul class="list-unstyled breadcrumb_item d-flex justify-content-center align-items-center text-white">
            <li><a href="{{ route('home') }}"><i class="fas fa-home active"></i>Trang chủ</a></li>
            <li><i class="fas fa-chevron-right"></i>Cửa hàng</li>
          </ul>
        </div>
      </div>
    </section>
    <!-- Breadcrumb section end -->

    <!-- shop list sidebar start -->
    <section class="shop_list_sidebar sec_space_large">
      <div class="shop_sidebar_wrap">
        <form method="GET" action="{{ route('shop') }}">
          <input type="hidden" name="price_min" id="price_min"
            value="{{ request()->input('price_min', $price_range['min']) }}">
          <input type="hidden" name="price_max" id="price_max"
            value="{{ request()->input('price_min', $price_range['max']) }}">

          <div class="container">
            <div class="row">
              <div class="col-lg-3">
                <div class="shop_sidebar_searchbar position-relative">
                  <input class="rounded-pill" type="search" name="search" value="{{ request()->input('search', '') }}"
                    placeholder="Tìm kiếm" style="padding-right: 55px">
                  <button type="submit" style="position: absolute;top: 50%;right: 30px;">
                    <i class="fas fa-search position-absolute" style="top: 0%;right: 0;"></i>
                  </button>
                </div>
                <!-- blog category start -->
                <div class="blog_category" data-aos="fade-up" data-aos-duration="1000">
                  <div class="blog_category_wrap">
                    <h3 class="blog_category_title py-3">Danh mục</h3>
                    <div class="blog_category_item">
                      <div class="row">
                        <div class="form-check">
                          @foreach ($collections as $collection)
                            <div class="col">
                              <input class="form-check-input" type="checkbox" name="collections[]"
                                value="{{ $collection->slug }}" id="{{ $collection->slug }}"
                                {{ in_array($collection->slug, request()->input('collections', [])) ? 'checked' : '' }}>
                              <label class="form-check-label ms-2" for="{{ $collection->slug }}">
                                {{ $collection->title }}
                              </label>
                            </div>
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- blog category end -->
                <!-- filter range start -->
                <div class="price-range-area mt-3" data-aos="fade-up" data-aos-duration="1000">
                  <h3 class="price_range_title mb-4">Lọc theo giá</h3>
                  <div id="slider-range" data-min="{{ $price_range['min'] }}" data-max="{{ $price_range['max'] }}"
                    class="slider-range ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                    <div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div>
                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"
                      style="left: 0%;"></span><span class="ui-slider-handle ui-state-default ui-corner-all"
                      tabindex="0" style="left: 100%;"></span>
                  </div>
                  <div class="price-text d-flex align-items-center mt-3">
                    <span class="text-uppercase">Filter <i class="fas fa-long-arrow-alt-right"></i></span>
                    <input type="text" id="amount" readonly="">
                  </div>
                </div>
                <!-- filter range end -->
                <!-- trending section start -->
                <section class="trending_sec mt-3" data-aos="fade-up" data-aos-duration="1000">
                  <div class="trending_sec_wrap">
                    <h3 class="trending_title mb-3">Sản phẩm bán chạy</h3>
                    @foreach ($best_selling_products as $product)
                      <div class="trending_item d-flex align-items-center">
                        <div class="trending_thumb d-flex justify-content-center align-items-center">
                          @if (count($product->images) > 0)
                            <img src="{{ image_url($product->images[0]) }}" alt="{{ $product->name }}">
                          @endif
                        </div>
                        <div class="trending_text">
                          <span>Mango Juices</span>
                          <div class="trending_price">
                            @if ($product->isDiscounted)
                              <del>{{ format_currency($product->compare_at_price) }}</del>
                            @endif
                            <font>{{ format_currency($product->price) }}</font>
                          </div>
                          <ul class="rating_star ul_li">
                            <li class="active"><i class="fas fa-star"></i></li>
                            <li class="active"><i class="fas fa-star"></i></li>
                            <li class="active"><i class="fas fa-star"></i></li>
                            <li class="active"><i class="far fa-star"></i></li>
                            <li class="active"><i class="far fa-star"></i></li>
                          </ul>
                        </div>
                      </div>
                    @endforeach
                    <div class="trending_btn mt-3">
                      <a href="{{ route('shop') }}"><button type="button" class="btn text-uppercase px-4">Xem thêm
                          <i class="fas fa-long-arrow-alt-right"></i></button></a>
                    </div>
                  </div>
                </section>
                <!-- trending section end -->
              </div>
              <div class="col-lg-9">
                <!-- shop list section start -->
                <section class="shop_list_sec" data-aos="fade-up" data-aos-duration="1000">
                  <div class="shop_list_wrap">
                    <div class="container">
                      <div class="filter_area d-flex justify-content-between align-items-center mb_30">
                        <ul class="nav layout_tab_nav ul_li" role="tablist">
                          <span class="show_result">
                            Hiển thị {{ $products->firstItem() }}–{{ $products->lastItem() }}
                            của {{ $products->total() }} sản phẩm
                          </span>
                        </ul>
                        <div class="sorting_from d-flex align-items-center">
                          <span class="sorting_from_title">Sắp xếp theo:</span>
                          <div class=" clearfix">
                            <select name="order_type">
                              @foreach ($orderOptions as $value => $label)
                                <option value="{{ $value }}"
                                  {{ request()->input('order_type', '') == $value ? 'selected' : '' }}>
                                  {{ $label }}
                                </option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="shop_product_list">
                        <div class="tab-content" id="pills-tabContent">
                          <div class="tab-pane fade show active" id="grid_layout" role="tabpanel"
                            aria-labelledby="pills-grid_layout-tab">
                            <div class="row g-4">
                              @foreach ($products as $product)
                                <div class="col-sm-6 col-lg-4">
                                  <x-product-card :product="$product" />
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                      {{ $products->links('vendor.pagination.custom') }}
                    </div>
                  </div>
                </section>
                <!-- shop list section end -->
              </div>
            </div>
          </div>
        </form>
      </div>
    </section>
    <!-- shop list sidebar end -->
  </main>
  <!-- main body end -->

</x-app-layout>
