<!-- sidebar section start -->

<section class="sidebar_section">
  <div class="sidebar_content_wrap">
    <div class="container">
      <div class="row">
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
          <div class="offcanvas-header align-items-center">
            <h5 class="mb_0">Giỏ hàng</h5>
            <button type="button" class="btn-close text-reset text-end" data-bs-dismiss="offcanvas"
              aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            @if (count($cart) > 0)
              @foreach ($cart as $item)
                <div class="prdc_ctg_product_content mt-1 d-flex align-items-center">
                  <div class="prdc_ctg_product_img d-flex justify-content-center align-items-center me-3">
                    <img src="{{ image_url($item['product']['images'][0]) }}" alt="image_not_found">
                  </div>
                  <div class="prdc_ctg_product_text">
                    <div class="prdc_ctg_product_title my-2">
                      <h5>{{ $item['product']['name'] }}</h5>
                    </div>
                    <div class="prdc_ctg_product_price mt-1 product_price">
                      <span class="sale_price pe-1">{{ format_currency($item['product']['price']) }}</span>
                      @if ($item['product']['is_discounted'])
                        <del>{{ format_currency($item['product']['compare_at_price']) }}</del>
                      @endif
                    </div>
                  </div>
                </div>
              @endforeach

              <div class="total_price">
                <ul class="ul_li_block mb_30 clearfix">
                  {{-- <li>
                    <span>Subtotal:</span>
                    <span>$215</span>
                    </li>
                    <li>
                    <span>Vat 5%:</span>
                    <span>$10.75</span>
                    </li>
                    <li>
                    <span>Discount 15%:</span>
                    <span>- $32.25</span>
                    </li> --}}
                  <li>
                    <span>Tổng tiền:</span>
                    <span>{{ format_currency($cart_total) }}</span>
                  </li>
                </ul>
              </div>
              <div class="sidebar_btns">
                <ul class="btns_group ul_li_block clearfix">
                  <li><a href="{{ route('cart') }}">Xem giỏ hàng</a></li>
                  <li><a href="{{ route('checkout') }}">Thanh toán</a></li>
                </ul>
              </div>
            @else
              <div class="empty_cart text-center py-5">
                <h5 class="mb-2">Giỏ hàng của bạn đang trống</h5>
                <p>Hãy thêm sản phẩm yêu thích vào giỏ hàng để tiếp tục mua sắm.</p>
                <a href="{{ route('shop') }}" class="btn custom_btn rounded-pill px-5 py-3 text-white">Tiếp tục mua
                  sắm</a>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- sidebar section end -->
