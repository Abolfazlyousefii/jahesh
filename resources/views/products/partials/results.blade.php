@php
  $money = fn($n) => number_format($n) . ' تومان';
@endphp

<div class="d-flex align-items-center justify-content-between mb-3">
  <div class="text-muted">{{ number_format($paginator->total()) }} محصول پیدا شد</div>
</div>

<div class="row g-3">
  @forelse($products as $product)
    <div class="col-12 col-md-6 col-lg-3">
      <a class="product-card p-2 d-block text-decoration-none text-dark h-100" href="{{ route('products.show', $product['id']) }}">
        <img src="{{ $product['image'] }}" alt="{{ $product['title'] }}" class="img-fluid rounded-4 mb-2 w-100 product-list-thumb">
        <h3 class="p-title mb-1">{{ $product['title'] }}</h3>
        <div class="small text-muted mb-2">{{ $product['brand'] }} | {{ $product['category'] }}</div>
        <div class="d-flex flex-wrap gap-1 mb-2">
          @foreach($product['colors'] as $color)
            <span class="mini-color" style="--dot: {{ $color['hex'] }}" title="{{ $color['name'] }}"></span>
          @endforeach
        </div>
        <div class="fw-bold text-primary">{{ $money($product['price']) }}</div>
        <div class="old-price">{{ $money($product['old_price']) }}</div>
      </a>
    </div>
  @empty
    <div class="col-12">
      <div class="alert alert-warning rounded-4">محصولی با این فیلتر پیدا نشد.</div>
    </div>
  @endforelse
</div>

@if($paginator->hasPages())
  <div class="mt-4 d-flex justify-content-center">
    {!! $paginator->onEachSide(1)->links('pagination::bootstrap-5') !!}
  </div>
@endif

<div class="seo-box mt-4">
  <h2 class="h6 fw-bold mb-2">متن سئو صفحه محصولات</h2>
  <p class="m-0 text-muted">{{ $seoText }}</p>
</div>
