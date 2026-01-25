{{-- resources/views/components/product-card.blade.php --}}
@props(['product'])

<div class="product_layout_1 overflow-hidden position-relative">
  <div class="product_layout_content bg-white position-relative">
    <div class="product_image_wrap">
      <a class="product_image d-flex justify-content-center align-items-center"
        href="{{ route('products.detail', ['product_slug' => $product->slug]) }}">
        @if (count($product->images) > 0)
          <img class="pic-1" src="{{ image_url($product->images[0]) }}" alt="{{ $product->name }}">
          <img class="pic-2" src="{{ image_url($product->images[1] ?? $product->images[0]) }}"
            alt="{{ $product->name }}">
        @endif
      </a>

      {{-- Badge giảm giá --}}
      @if ($product->isDiscounted)
        <ul class="product_badge_group ul_li_block">
          <li>
            <span class="product_badge badge_discount position-absolute rounded-pill">
              -{{ $product->discountPercent }}%
            </span>
          </li>
        </ul>
      @endif

      {{-- Action buttons --}}
      <ul class="product_action_btns ul_li_block d-flex">
        <li>
          <a class="tooltips" data-bs-toggle="modal" data-bs-target="#product_quick_view">
            <i class="fas fa-search"></i>
          </a>
        </li>
        <li>
          <a class="tooltips btn-add-to-cart" data-product-id="{{ $product->id }}" title="Thêm vào giỏ hàng"
            href="javascript:void(0)">
            <i class="fas fa-shopping-bag"></i>
          </a>
        </li>
      </ul>
    </div>

    {{-- Rating --}}
    <div class="rating_wrap d-flex">
      <ul class="rating_star ul_li">
        <li class="active"><i class="fas fa-star"></i></li>
        <li class="active"><i class="fas fa-star"></i></li>
        <li class="active"><i class="fas fa-star"></i></li>
        <li class="active"><i class="fas fa-star"></i></li>
        <li class="active"><i class="far fa-star"></i></li>
      </ul>
      <span class="shop_review_text">( 5.0 )</span>
    </div>

    {{-- Content --}}
    <div class="product_content">
      <h3 class="product_title">
        <a href="{{ route('products.detail', ['product_slug' => $product->slug]) }}">
          {{ $product->name }}
        </a>
      </h3>
      <div class="product_price">
        <span class="sale_price pe-1">{{ format_currency($product->price) }}</span>
        @if ($product->isDiscounted)
          <del>{{ format_currency($product->compare_at_price) }}</del>
        @endif
      </div>
    </div>
  </div>
</div>
