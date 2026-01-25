<x-app-layout :cart="$cart" :cart_total="$cart_total">
  <!-- main body start -->
  <main>

    <!-- Breadcrumb section start -->
    <section class="breadcrumb_sec_1 position-relative">
      <div class="breadcrumb_wrap sec_space_mid_small"
        style="background-image: url({{ asset('assets/images/breadcrumb/breadcrumb1.png') }});">
        <div class="breadcrumb_cont text-center">
          <div class="breadcrumb_title">
            <h2 class="text-white">Chi tiết bài viết</h2>
          </div>
          <ul class="list-unstyled breadcrumb_item d-flex justify-content-center align-items-center text-white">
            <li><a href="{{ route('home') }}"><i class="fas fa-home active"></i>Trang chủ</a></li>
            <li><i class="fas fa-chevron-right"></i>Chi tiết bài viết</li>
          </ul>
        </div>
      </div>
    </section>
    <!-- Breadcrumb section end -->

    <!-- blog details start -->
    <section class="blog_details sec_space_xs_70">
      <div class="container-sm">
        <div class="row justify-content-center">
          <div class="col-md-9">
            <div class="blog_details_cont">
              <span class="blog_date">{{ $post->updated_at->format('d F') }}</span>
              <h2 class="blog_title text-capitalize">{{ $post->title }}</h2>
              <div class="blog_author_cont d-flex align-items-center py-3">
                <span class="author_name me-5">
                  <font>Đăng bởi</font> Admin
                </span>
                <span class="author_position me-5">
                  <font>Danh mục:</font>
                  @foreach ($post->categories as $index => $category)
                    @if ($index > 0)
                      ,
                    @endif
                    {{ $category->title }}
                  @endforeach
                </span>
              </div>
              <p class="blog_desc py-3">{{ $post->description }}</p>
            </div>
          </div>
          <div class="col">
            <div class="blog_image">
              <img src="{{ image_url($post->images[0]) }}" alt="image_not_found">
            </div>
          </div>
          <div class="col-md-10 py-3">
            {!! $post->content !!}
          </div>
        </div>
      </div>
    </section>
    <!-- blog details end -->
  </main>
  <!-- main body end -->
</x-app-layout>
