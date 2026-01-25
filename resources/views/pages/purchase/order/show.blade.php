<x-app-layout :cart="$cart" :cart_total="$cart_total">
  <main>

    <!-- Breadcrumb section start -->
    <section class="breadcrumb_sec_1 position-relative">
      <div class="breadcrumb_wrap sec_space_mid_small"
        style="background-image: url({{ asset('assets/images/breadcrumb/breadcrumb1.png') }});">
        <div class="breadcrumb_cont text-center">
          <div class="breadcrumb_title">
            <h2 class="text-white">Chi tiết hóa đơn</h2>
          </div>
          <ul class="list-unstyled breadcrumb_item d-flex justify-content-center align-items-center text-white">
            <li><a href="{{ route('home') }}"><i class="fas fa-home active"></i>Trang chủ</a></li>
            <li><a href="{{ route('orders') }}"><i class="fas fa-chevron-right"></i>Hóa đơn</a></li>
            <li><i class="fas fa-chevron-right"></i>Chi tiết hóa đơn</li>
          </ul>
        </div>
      </div>
    </section>
    <!-- Breadcrumb section end -->

    <section class="order_details py-5">
      <div class="container">

        <div class="card shadow-sm p-4 blog_category">
          <h4 class="mb-4">Thông tin đơn hàng</h4>
          <div class="row g-3">
            <div class="col-md-6">
              <p><strong>Mã đơn hàng:</strong> <span class="text-secondary">#{{ $order->code }}</span></p>
              <p><strong>Ngày đặt:</strong> <span
                  class="text-secondary">{{ $order->created_at->format('d/m/Y H:i') }}</span></p>
              <p><strong>Trạng thái thanh toán:</strong>
                <span
                  class="badge bg-{{ match ($order->status) {
                      'pending' => 'secondary',
                      'paid' => 'success',
                      'failed' => 'danger',
                      default => 'info',
                  } }}">
                  {{ __("shop.payment.status.{$order->status}.label") }}
                </span>
              </p>
              <small class="text-muted">{{ __("shop.payment.status.{$order->status}.description") }}</small>
            </div>
            <div class="col-md-6">
              <p><strong>Khách hàng:</strong> <span class="text-secondary">{{ $order->name }}</span></p>
              <p><strong>Email:</strong> <span class="text-secondary">{{ $order->email }}</span></p>
              <p><strong>Điện thoại:</strong> <span class="text-secondary">{{ $order->phone }}</span></p>
            </div>
          </div>
        </div>

        <div class="card shadow-sm p-4 blog_category">
          <h4 class="mb-4">Sản phẩm trong đơn hàng</h4>
          <div class="table-responsive">
            <table class="table table-striped align-middle text-center mb-0">
              <thead class="table-dark text-uppercase">
                <tr>
                  <th>Ảnh</th>
                  <th>Sản phẩm</th>
                  <th>Giá</th>
                  <th>Số lượng</th>
                  <th>Tổng</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($order->items as $item)
                  <tr>
                    <td><img src="{{ image_url($item->product->images[0] ?? '') }}" alt="image_not_found"
                        style="width:50px; border-radius:5px;"></td>
                    <td class="text-start">{{ $item->product->name }}</td>
                    <td>{{ format_currency($item->price) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ format_currency($item->price * $item->quantity) }}</td>
                  </tr>
                @endforeach
                <tr>
                  <td colspan="4" class="text-end fw-bold">Tổng cộng:</td>
                  <td class="fw-bold">{{ format_currency($order->total) }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="card shadow-sm p-4 blog_category">
          <h4 class="mb-4">Phương thức thanh toán</h4>
          <p><strong>Phương thức:</strong> <span
              class="text-secondary">{{ __("shop.payment.method.{$order->payment_method}") }}</span></p>
          <p><strong>Trạng thái thanh toán:</strong>
            <span
              class="badge bg-{{ match ($order->payment_status) {
                  'pending' => 'secondary',
                  'paid' => 'success',
                  'failed' => 'danger',
                  default => 'info',
              } }}">
              {{ __("shop.payment.status.{$order->payment_status}.label") }}
            </span>
          </p>

          @if ($order->payment_method === 'bank_transfer')
            <div class="mt-3">
              <p class="mb-2 fw-bold">Thông tin ngân hàng:</p>
              <ul class="list-unstyled ps-3">
                @foreach (setting('shop.bank_info', []) as $info)
                  <li class="mb-1">{{ $info['key'] }}: {{ $info['value'] }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        </div>

      </div>
    </section>

  </main>
</x-app-layout>
