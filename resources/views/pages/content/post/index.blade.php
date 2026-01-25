<x-app-layout :cart="$cart" :cart_total="$cart_total">
  <!-- main body start -->
  <main>
    <!-- Breadcrumb section start -->
    <section class="breadcrumb_sec_1 position-relative">
      <div class="breadcrumb_wrap sec_space_mid_small"
        style="background-image: url({{ asset('assets/images/breadcrumb/breadcrumb1.png') }});">
        <div class="breadcrumb_cont text-center">
          <div class="breadcrumb_title">
            <h2 class="text-white">Tin tức</h2>
          </div>
          <ul class="list-unstyled breadcrumb_item d-flex justify-content-center align-items-center text-white">
            <li><a href="{{ route('home') }}"><i class="fas fa-home active"></i>Trang chủ</a></li>
            <li><i class="fas fa-chevron-right"></i>Tin tức</li>
          </ul>
        </div>
      </div>
    </section>
    <!-- Breadcrumb section end -->

    <!-- blog grid section start -->
    <div class="blog_grid_sec sec_space_small blog_list_sec">
      <div class="blog_grid_wrap blog_list_wrap">
        <div class="container">
          <div class="row g-4">
            @foreach ($posts as $post)
              <div class="col-sm-6 col-md-4">
                <div class="blog_grid_cont blog_list_cont" data-aos="fade-up" data-aos-duration="1000">
                  <div class="grid_img d-flex blog_list_img">
                    <img src="{{ image_url($post->images[0]) }}" alt="image_not_found">
                  </div>
                  <div class="blog_grid_text">
                    <a href="{{ route('posts.show', ['post_slug' => $post->slug]) }}">
                      <h3 class="grid_title">{{ $post->title }}</h3>
                    </a>
                    <div class="grid_author_cont">
                      <div class="gallery_mid_author_content py-2 d-flex justify-content-between">
                        <div class="gallery_mid_author_title">
                          <span><i class="far fa-user pe-1"></i> Admin</span>
                        </div>
                        <div class="gallery_mid_author_time">
                          <span><i class="far fa-clock pe-1"></i> {{ $post->created_at->diffForHumans() }}</span>
                        </div>
                      </div>
                    </div>
                    <p class="grid_desc">{{ $post->description }}</p>
                  </div>
                </div>
              </div>
            @endforeach

            {{ $posts->links('vendor.pagination.custom') }}
          </div>
        </div>
      </div>
    </div>
    <!-- blog grid section end -->

  </main>
  <!-- main body end -->
</x-app-layout>
