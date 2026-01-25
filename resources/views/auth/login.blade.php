<x-app-layout :cart="$cart" :cart_total="$cart_total">
  <main>

    <!-- Breadcrumb section start -->
    <section class="breadcrumb_sec_1 position-relative">
      <div class="breadcrumb_wrap sec_space_mid_small"
        style="background-image: url({{ asset('assets/images/breadcrumb/breadcrumb1.png') }});">
        <div class="breadcrumb_cont text-center">
          <div class="breadcrumb_title">
            <h2 class="text-white">Đăng nhập</h2>
          </div>
          <ul class="list-unstyled breadcrumb_item d-flex justify-content-center align-items-center text-white">
            <li><a href="{route('home')}"><i class="fas fa-home active"></i>Trang chủ</a></li>
            <li><i class="fas fa-chevron-right"></i>Đăng nhập</li>
          </ul>
        </div>
      </div>
    </section>
    <!-- Breadcrumb section end -->

    <section class="shop_list_sidebar sec_space_large">
      <div class="shop_sidebar_wrap">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6">
              <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email Address -->
                <div class="form_item">
                  <input class="rounded-pill @error('email') is-invalid @enderror" type="text" name="email"
                    placeholder="Email của bạn*" value="{{ old('email', '') }}" required>
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Password -->
                <div class="form_item">
                  <input class="rounded-pill @error('password') is-invalid @enderror" type="password" name="password"
                    placeholder="Mật khẩu của bạn*" required>
                  @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Remember Me -->
                <div class="checkbox_item mb_15">
                  <label for="remember_me"><input id="remember_me" name="remember_me" type="checkbox" checked> Ghi nhớ
                    tôi</label>
                </div>

                <div class="row mx-1">
                  <button type="submit" class="btn custom_btn rounded-pill py-3 text-white text-uppercase">Đăng nhập <i
                      class="fas fa-long-arrow-alt-right"></i></button>
                </div>
            </div>
            </form>
          </div>
        </div>
      </div>
      </div>
    </section>
  </main>
</x-app-layout>
