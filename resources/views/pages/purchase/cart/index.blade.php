<x-app-layout :cart="$cart" :cart_total="$cart_total">
  <!-- main body start -->
  <main>

    <!-- Breadcrumb section start -->
    <section class="breadcrumb_sec_1 position-relative">
      <div class="breadcrumb_wrap sec_space_mid_small"
        style="background-image: url({{ asset('assets/images/breadcrumb/breadcrumb1.png') }});">
        <div class="breadcrumb_cont text-center">
          <div class="breadcrumb_title">
            <h2 class="text-white">Giỏ hàng</h2>
          </div>
          <ul class="list-unstyled breadcrumb_item d-flex justify-content-center align-items-center text-white">
            <li><a href="{route('home')}"><i class="fas fa-home active"></i>Trang chủ</a></li>
            <li><i class="fas fa-chevron-right"></i>Giỏ hàng</li>
          </ul>
        </div>
      </div>
    </section>
    <!-- Breadcrumb section end -->

    <!-- cart_section - start -->
    <section class="cart_section sec_space_large" data-aos="fade-up" data-aos-duration="500">
      <div class="container">
        <div class="cart_table table-responsive position-relative">
          <table class="table align-middle">
            <thead class="text-uppercase">
              <tr>
                <th>Ảnh</th>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng cộng</th>
              </tr>
            </thead>
            <tbody>
              @if (count($cart) == 0)
                <tr>
                  <td colspan="5">Không có sản phẩm trong giỏ hàng. <a href="{{ route('shop') }}">Đến cửa hàng</a>
                  </td>
                </tr>
              @endif
              @foreach ($cart as $item)
                <tr>
                  <td>
                    <div class="cart_product position-relative" style="overflow: initial">
                      <div class="item_image">
                        <img src="{{ image_url($item['product']['images'][0]) }}" alt="image_not_found">
                      </div>
                      <form action="{{ route('cart.remove', ['id' => $item['product']['id']]) }}" method="POST"
                        class="d-inline remove-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="remove_btn position-absolute"><i
                            class="fas fa-times"></i></button>
                      </form>
                      {{-- <button type="button" class="remove_btn position-absolute">
                        <i class="fas fa-times"></i>
                      </button> --}}
                    </div>
                  </td>
                  <td>
                    <div class="item_content">
                      <a href="{{ route('products.detail', ['product_slug' => $item['product']['slug']]) }}">
                        <h4 class="item_title">{{ $item['product']['name'] }}</h4>
                      </a>
                      {{-- <span class="item_type">Shop groceries</span> --}}
                    </div>
                  </td>
                  <td>
                    @if ($item['product']['is_discounted'])
                      <span class="price_text"
                        style="font-size: 15px; text-decoration: line-through;">{{ format_currency($item['product']['compare_at_price']) }}</span>
                    @endif
                    <span class="price_text">{{ format_currency($item['product']['price']) }}</span>
                  </td>
                  <td>
                    <div class="quantity_input">
                      <form action="#">
                        <span class="input_number_decrement">–</span>
                        <input class="input_number" name="quantities[{{ $item['product']['id'] }}]"
                          form="update-cart-form" value="{{ $item['quantity'] }}" min="1"
                          max="{{ $item['product']['stock_quantity'] }}">
                        <span class="input_number_increment">+</span>
                      </form>
                    </div>
                  </td>
                  <td>
                    <span
                      class="total_price">{{ format_currency($item['product']['price'] * $item['quantity']) }}</span>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="coupon_wrap d-flex justify-content-between">
          <div class="coupon_form d-flex align-items-center">
            {{-- <div class="form_item mb-0 me-5">
              <input type="text" class="coupon rounded-pill" placeholder="Coupon Code">
            </div>
            <button type="submit"
              class="btn btn_coupon custom_btn text-white rounded-pill py-2 py-sm-3 px-3 px-sm-5 text-uppercase">Apply
              Coupon</button> --}}
          </div>
          <form id="update-cart-form" action="{{ route('cart.update') }}" method="POST">
            @csrf
            <button type="submit"
              class="btn coupon_update_btn text-white rounded-pill py-2 py-sm-3 px-3 px-sm-5 text-uppercase">Cập nhập
              giỏ hàng</button>
          </form>
        </div>

        <div class="row justify-content-lg-end">
          <div class="col col-lg-4 mt-5">
            <div class="cart_pricing_table text-uppercase">
              <h3 class="table_title text-center">Cart Total</h3>
              <ul class="ul_li_block clearfix">
                {{-- <li><span>Subtotal</span> <span>$197.99</span></li> --}}
                <li><span>Total</span> <span>{{ format_currency($cart_total) }}</span></li>
              </ul>
              <div class="btn_wrap pt-0 text-center">
                <a href="{{ route('checkout') }}" class="btn text-uppercase text-white rounded-pill">Thanh toán</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- cart_section - end -->

  </main>
  <!-- main body end -->

  @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      // Confirm xóa sản phẩm
      document.querySelectorAll('.remove-form').forEach(form => {
        form.addEventListener('submit', function(e) {
          e.preventDefault();
          Swal.fire({
            title: 'Bạn có chắc muốn xóa sản phẩm?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy'
          }).then((result) => {
            if (result.isConfirmed) {
              form.submit();
            }
          });
        });
      });

      // Confirm cập nhật giỏ hàng
      document.getElementById('update-cart-form').addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
          title: 'Cập nhật giỏ hàng?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Cập nhật',
          cancelButtonText: 'Hủy'
        }).then((result) => {
          if (result.isConfirmed) {
            e.target.submit();
          }
        });
      });
    </script>
  @endpush
</x-app-layout>
