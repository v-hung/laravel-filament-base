<x-app-layout :cart="$cart" :cart_total="$cart_total">
  <!-- main body start -->
  <main>

    <!-- Breadcrumb section start -->
    <section class="breadcrumb_sec_1 position-relative">
      <div class="breadcrumb_wrap sec_space_mid_small"
        style="background-image: url({{ asset('assets/images/breadcrumb/breadcrumb1.png') }});">
        <div class="breadcrumb_cont text-center">
          <div class="breadcrumb_title">
            <h2 class="text-white">Checkout Page</h2>
          </div>
          <ul class="list-unstyled breadcrumb_item d-flex justify-content-center align-items-center text-white">
            <li><a href="{{ route('home') }}"><i class="fas fa-home active"></i>Trang chủ</a></li>
            <li><i class="fas fa-chevron-right"></i>Thanh toán</li>
          </ul>
        </div>
      </div>
    </section>
    <!-- Breadcrumb section end -->

    <section class="cart_section clearfix" data-aos="fade-up" data-aos-duration="500">
      <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="container">
          <!-- Billing info start -->
          <div class="billing_form mb_50">
            <h3 class="form_title mb_30">Billing details</h3>
            <div>
              <div class="form_wrap">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form_item">
                      <span class="input_title">Họ và tên<sup>*</sup></span>
                      <input type="text" name="name" class="@error('name') is-invalid @enderror"
                        value="{{ old('name') }}" required>
                      @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form_item">
                      <span class="input_title">Số điện thoại<sup>*</sup></span>
                      <input type="text" name="phone" class="@error('phone') is-invalid @enderror"
                        value="{{ old('phone') }}" required>
                      @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="form_item">
                  <span class="input_title">Địa chỉ email<sup>*</sup></span>
                  <input type="email" name="email" class="@error('email') is-invalid @enderror"
                    value="{{ old('email') }}" required>
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form_item" style="height: 40px">
                  <span class="input_title">Tỉnh / Thành phố<sup>*</sup></span>
                  <div>
                    <select id="province_select" class="@error('province_id') is-invalid @enderror" name="province_id"
                      required>
                      @foreach ($provinces as $province)
                        <option value="{{ $province->id }}"
                          {{ old('province_id') == $province->id ? 'selected' : '' }}>
                          {{ $province->name }}
                        </option>
                      @endforeach
                    </select>
                    @error('province_id')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form_item" style="height: 40px">
                  <span class="input_title">Xã / Phường<sup>*</sup></span>
                  <select id="ward_select" name="ward_id" class="@error('ward_id') is-invalid @enderror" required>
                    <option value="">Chọn phường/xã</option>
                  </select>
                  @error('ward_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form_item">
                  <span class="input_title">Địa chỉ chi tiết<sup>*</sup></span>
                  <input type="text" name="address" value="{{ old('address') }}"
                    class="@error('address') is-invalid @enderror">
                  @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form_item mb_0">
                  <span class="input_title">Ghi chú</span>
                  <textarea name="note" value="{{ old('note') }}" class="@error('address') is-invalid @enderror"
                    placeholder="Note about your order, eg. special notes fordelivery."></textarea>
                  @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <div class="billing_form" data-aos="fade-up" data-aos-duration="500">
            <h3 class="form_title mb_30">Your order</h3>
            <div class="form_wrap">
              <div class="checkout_table table-responsive">
                <table class="table text-center mb_50">
                  <thead class="text-uppercase text-uppercase">
                    <tr>
                      <th>Sản phẩm</th>
                      <th>Giá</th>
                      <th>Số lượng</th>
                      <th>Tổng cộng</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($cart as $item)
                      <tr>
                        <td>
                          <div class="cart_product">
                            <div class="item_image">
                              <img src="{{ image_url($item['product']['images'][0]) }}" alt="image_not_found">
                            </div>
                            <div class="item_content">
                              <h4 class="item_title mb_0">{{ $item['product']['name'] }}</h4>
                            </div>
                          </div>
                        </td>
                        <td>
                          <span class="price_text">{{ format_currency($item['product']['price']) }}</span>
                        </td>
                        <td>
                          <span class="quantity_text">{{ $item['quantity'] }}</span>
                        </td>
                        <td><span
                            class="total_price">{{ format_currency($item['product']['price'] * $item['quantity']) }}</span>
                        </td>
                      </tr>
                    @endforeach
                    {{-- <tr>
                          <td></td>
                          <td></td>
                          <td>
                            <span class="subtotal_text">Subtotal</span>
                          </td>
                          <td><span class="total_price">{{ format_currency($cart_total) }}</span></td>
                        </tr> --}}
                    {{-- <tr>
                          <td></td>
                          <td></td>
                          <td>
                            <span class="subtotal_text">Shipping</span>
                          </td>
                          <td class="text-left">
                            <div class="checkbox_item mb_15">
                              <label for="shipping_checkbox"><input id="shipping_checkbox" type="checkbox" checked> Free
                                Shipping</label>
                            </div>
                            <div class="checkbox_item mb_15">
                              <label for="flatrate_checkbox"><input id="flatrate_checkbox" type="checkbox"> Flat rate:
                                $15.00</label>
                            </div>
                            <div class="checkbox_item">
                              <label for="localpickup_checkbox"><input id="localpickup_checkbox" type="checkbox"> Local
                                Pickup:
                                $8.00</label>
                            </div>
                          </td>
                        </tr> --}}
                    <tr>
                      <td class="text-left">
                        <span class="subtotal_text">Tổng cộng</span>
                      </td>
                      <td></td>
                      <td></td>
                      <td>
                        <span class="total_price">{{ format_currency($cart_total) }}</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="billing_payment_mathod">
                <ul class="ul_li_block clearfix">
                  <li>
                    <div class="checkbox_item mb_15 pl-0">
                      <input class="form-check-input" type="radio" name="payment_method" id="bank_transfer_radio"
                        value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'checked' : '' }}>
                      <label class="form-check-label fw-bold" for="bank_transfer_radio">
                        Chuyển khoản ngân hàng trực tiếp
                      </label>
                    </div>
                    <div class="payment-details mt-2" id="bank_transfer_info">
                      <p class="mb-1">
                        Vui lòng thanh toán trực tiếp vào tài khoản ngân hàng của chúng tôi.
                        Vui lòng sử dụng <strong>Mã đơn hàng</strong> của bạn làm tham chiếu thanh toán.
                        Đơn hàng của bạn sẽ không được giao cho đến khi tiền được chuyển vào tài khoản của chúng tôi.
                      </p>
                      <p class="mb-0"><strong>Thông tin ngân hàng:</strong></p>
                      <ul class="mb-0">
                        <style>
                          li {
                            margin-bottom: 5px !important;
                            padding-bottom: 5px !important;
                            border-bottom: 0px !important;
                          }
                        </style>
                        <div style="margin-top: 10px"></div>
                        @foreach (setting('shop.bank_info', []) as $info)
                          <li>{{ $info['key'] }}: {{ $info['value'] }}</li>
                        @endforeach
                      </ul>
                    </div>
                  </li>
                  <li>
                    <div class="checkbox_item mb_0 pl-0">
                      <input class="form-check-input" type="radio" name="payment_method" id="cash_delivery_radio"
                        value="cash_delivery" {{ old('payment_method') == 'cash_delivery' ? 'checked' : '' }}>
                      <label class="form-check-label fw-bold" for="cash_delivery_radio">
                        Thanh toán khi nhận hàng
                      </label>
                    </div>
                    <div class="payment-details mt-2 d-none" id="cash_delivery_info">
                      <p class="mb-0">Bạn sẽ thanh toán khi nhận hàng tại địa chỉ của bạn.</p>
                    </div>
                  </li>
                </ul>
                <button type="submit" class="custom_btn bg_default_red">Đặt hàng</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </section>

  </main>
  <!-- main body end -->

  @push('scripts')
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        const bankRadio = document.getElementById("bank_transfer_radio");
        const cashRadio = document.getElementById("cash_delivery_radio");

        const bankInfo = document.getElementById("bank_transfer_info");
        const cashInfo = document.getElementById("cash_delivery_info");

        function togglePaymentDetails() {
          if (bankRadio.checked) {
            bankInfo.classList.remove("d-none");
            cashInfo.classList.add("d-none");
          } else if (cashRadio.checked) {
            bankInfo.classList.add("d-none");
            cashInfo.classList.remove("d-none");
          }
        }

        bankRadio.addEventListener("change", togglePaymentDetails);
        cashRadio.addEventListener("change", togglePaymentDetails);

        togglePaymentDetails();


        const provinceSelect = document.getElementById('province_select');
        const wardSelect = document.getElementById('ward_select');

        // Tất cả ward
        const wards = @json($wards);

        $('#province_select').on('change', function() {
          const provinceId = $(this).val();

          // Xóa tất cả option hiện tại
          $('#ward_select').html('<option value="">Chọn phường/xã</option>');

          // Lọc ward theo province_id
          const filtered = wards.filter(ward => ward.province_id == provinceId);

          filtered.forEach(ward => {
            $('#ward_select').append(`<option value="${ward.id}">${ward.name}</option>`);
          });

          // Cập nhật Nice Select
          $('#ward_select').niceSelect('update');
        });
      });
    </script>
  @endpush
</x-app-layout>
