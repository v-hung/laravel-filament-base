<x-app-layout :cart="$cart" :cart_total="$cart_total">
  <main>

    <!-- Breadcrumb section start -->
    <section class="breadcrumb_sec_1 position-relative">
      <div class="breadcrumb_wrap sec_space_mid_small"
        style="background-image: url({{ asset('assets/images/breadcrumb/breadcrumb1.png') }});">
        <div class="breadcrumb_cont text-center">
          <div class="breadcrumb_title">
            <h2 class="text-white">Thông tin cá nhân</h2>
          </div>
          <ul class="list-unstyled breadcrumb_item d-flex justify-content-center align-items-center text-white">
            <li><a href="{route('home')}"><i class="fas fa-home active"></i>Trang chủ</a></li>
            <li><i class="fas fa-chevron-right"></i>Thông tin cá nhân</li>
          </ul>
        </div>
      </div>
    </section>
    <!-- Breadcrumb section end -->

    <section class="shop_list_sidebar sec_space_large">
      <div class="shop_sidebar_wrap">
        <div class="container">
          <div class="row">
            <!-- Sidebar Left -->
            <div class="col-lg-3 mb-4 mb-lg-0">
              <div class="card shadow-sm p-3 blog_category">
                <h5 class="mb-3">Tài khoản</h5>
                <ul class="list-unstyled">
                  <li><a href="javascript:void(0)" class="d-block py-2"
                      style="color: #7cc000; text-decoration: underline"><strong>Thông tin cá
                        nhân</strong></a></li>
                  <li><a href="{{ route('orders') }}" class="d-block py-2"
                      style="color: #7cc000; text-decoration: underline"><strong>Đơn
                        hàng</a></strong></li>
                </ul>
              </div>
            </div>
            <!-- Main Content -->
            <div class="col-lg-9">
              <div class="card shadow-sm p-4 blog_category">
                <h4 class="mb-4">Cập nhật thông tin</h4>
                <form action="{{ route('profile.update') }}" method="POST">
                  @csrf
                  @method('patch')
                  <div class="row g-3">
                    <div class="col-md-6">
                      <div class="form_item">
                        <input class="rounded-pill @error('name') is-invalid @enderror" type="text" name="name"
                          value="{{ old('name', $user->name) }}" placeholder="Tên của bạn*" required>
                        @error('name')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form_item">
                        <input class="rounded-pill @error('phone') is-invalid @enderror" type="text" name="phone"
                          value="{{ old('phone', $user->phone) }}" placeholder="Số điện thoại của bạn*" required>
                        @error('phone')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form_item">
                        <input class="rounded-pill @error('email') is-invalid @enderror" type="text" name="email"
                          value="{{ old('email', $user->email) }}" placeholder="Địa chỉ email của bạn*" required>
                        @error('email')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form_item">
                        <input class="rounded-pill @error('password') is-invalid @enderror" type="password"
                          name="password" placeholder="Mật khẩu">
                        @error('password')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form_item">
                        <input class="rounded-pill @error('password_confirmation') is-invalid @enderror" type="password"
                          name="password_confirmation" placeholder="Nhập lại mật khẩu">
                        @error('password_confirmation')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="mt-4 text-end">
                    <button type="submit" class="btn custom_btn rounded-pill px-5 py-3 text-white">Cập nhật thông
                      tin</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</x-app-layout>
