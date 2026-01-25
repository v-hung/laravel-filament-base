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
                  <li><a href="#profile" class="d-block py-2">Thông tin cá nhân</a></li>
                  <li><a href="{{ route('orders') }}" class="d-block py-2">Đơn hàng</a></li>
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
                        <input class="rounded-pill" type="text" name="name" value="{{ $user->name }}"
                          placeholder="Tên của bạn*" required="">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form_item">
                        <input class="rounded-pill" type="text" name="phone" value="{{ $user->phone }}"
                          placeholder="Số điện thoại của bạn*" required="">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form_item">
                        <input class="rounded-pill" disabled type="text" name="email" value="{{ $user->email }}"
                          placeholder="Địa chỉ email của bạn*" required="">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form_item">
                        <input class="rounded-pill" type="password" name="password" placeholder="Mật khẩu">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form_item">
                        <input class="rounded-pill" type="password" name="password_confirmation"
                          placeholder="Nhập lại mật khẩu">
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
