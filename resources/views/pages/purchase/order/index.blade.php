<x-app-layout :cart="$cart" :cart_total="$cart_total">
  @push('styles')
    <style>
      .cart_table tr th:first-child,
      .cart_table tr td:first-child {
        padding: 25px !important;
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
                <th>Mã đơn hàng</th>
                <th>Ảnh</th>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng cộng</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($orders as $order)
                @foreach ($order->items as $index => $item)
                  <tr>
                    <td>
                      @if ($index === 0)
                        <a href="{{ route('orders.show', ['code' => $order->code]) }}">{{ $order->code }}</a>
                      @endif
                    </td>
                    <td>
                      <div class="cart_product position-relative" style="overflow: initial">
                        <div class="item_image">
                          <img src="{{ image_url($item->product->images[0] ?? null) }}" alt="image_not_found">
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="item_content">
                        <a href="{{ route('products.detail', ['product_slug' => $item->product->slug]) }}">
                          <h4 class="item_title">{{ $item->product->name }}</h4>
                        </a>
                      </div>
                    </td>
                    <td>
                      <span class="price_text">{{ format_currency($item->price) }}</span>
                    </td>
                    <td>
                      <span class="ps-3">{{ $item->quantity }}</span>
                    </td>
                    <td>
                      <span class="total_price">{{ format_currency($item->price * $item->quantity) }}</span>
                    </td>
                  </tr>
                @endforeach

                <tr class="table-secondary">
                  <td colspan="5" class="text-end"><strong>Tổng đơn hàng:</strong></td>
                  <td>{{ format_currency($order->total) }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="6">Không có hóa đơn nào. <a href="{{ route('shop') }}">Về trang chủ</a></td>
                </tr>
              @endforelse
            </tbody>
          </table>

          {{ $orders->links('vendor.pagination.custom') }}
        </div>
      </div>
    </section>
    <!-- cart_section - end -->

  </main>
  <!-- main body end -->
</x-app-layout>
