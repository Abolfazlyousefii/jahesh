@extends('layouts.app')

@section('title', $product['title'])

@section('content')
  @php
    $money = fn($n) => number_format($n) . ' تومان';
    $priceRangeMin = min(array_column($product['offers'], 'price'));
    $priceRangeMax = max(array_column($product['offers'], 'price'));
  @endphp

  <div class="container">
    <div class="row g-4 product-layout">
      <div class="col-lg-8">
        <section class="single-product-card p-3 p-md-4 h-100">
          <div class="d-flex align-items-center justify-content-between gap-2 border rounded-4 bg-white p-3 mb-4">
            <h1 class="h3 m-0 fw-bold">{{ $product['title'] }}</h1>
            <a class="btn btn-outline-secondary btn-sm btn-pill" href="{{ route('home') }}">بازگشت</a>
          </div>

          <div class="d-flex align-items-center gap-2 fs-4 mb-3">
            @foreach($product['colors'] as $index => $color)
              <button class="color-dot {{ $index === 0 ? 'is-active' : '' }}"
                      type="button"
                      data-color-name="{{ $color['name'] }}"
                      data-color-hex="{{ $color['hex'] }}"
                      aria-label="{{ $color['name'] }}"
                      style="--dot: {{ $color['hex'] }}"></button>
            @endforeach
          </div>

          <div class="text-muted mb-4">تنوع‌های موجود این کالا: <strong id="colorName">{{ $product['colors'][0]['name'] }}</strong></div>

          <div class="d-flex align-items-center gap-2 mb-4 price-range">
            <span>از</span>
            <span class="badge rounded-pill border border-primary-subtle text-primary px-3 py-2">{{ $money($priceRangeMin) }}</span>
            <span>تا</span>
            <span class="badge rounded-pill border border-danger-subtle text-danger px-3 py-2">{{ $money($priceRangeMax) }}</span>
          </div>

          <div class="d-grid gap-3">
            @foreach($product['offers'] as $offer)
              <article class="offer-card p-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <div class="fw-bold">فروشگاه: <span class="text-primary">{{ $offer['seller'] }}</span></div>
                  <div class="small text-muted">{{ $offer['warranty'] }}</div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="h5 m-0">{{ $money($offer['price']) }}</div>
                  <button class="btn btn-outline-primary btn-pill">افزودن +</button>
                </div>
              </article>
            @endforeach
          </div>
        </section>
      </div>

      <div class="col-lg-4">
        <section class="single-product-card p-3 mb-4 text-center">
          <img src="{{ $product['image'] }}" alt="{{ $product['title'] }}" class="img-fluid product-photo mb-3">
          <div class="text-muted small">رنگ انتخاب‌شده: <span id="colorLabel" class="fw-bold">{{ $product['colors'][0]['name'] }}</span></div>
        </section>

        <section class="single-product-card p-3">
          <h2 class="h5 mb-3">جزئیات محصول</h2>
          <div class="spec-table">
            @foreach($product['specs'] as $spec)
              <div class="spec-row">
                <div class="spec-key">{{ $spec['key'] }}</div>
                <div class="spec-value">{{ $spec['value'] }}</div>
              </div>
            @endforeach
          </div>
        </section>
      </div>
    </div>
  </div>

  <script>
    document.querySelectorAll('.color-dot').forEach((button) => {
      button.addEventListener('click', () => {
        document.querySelectorAll('.color-dot').forEach((item) => item.classList.remove('is-active'));
        button.classList.add('is-active');
        document.getElementById('colorName').textContent = button.dataset.colorName;
        document.getElementById('colorLabel').textContent = button.dataset.colorName;
      });
    });
  </script>
@endsection
