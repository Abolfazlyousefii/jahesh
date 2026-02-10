@extends('layouts.app')

@section('title', 'خانه')

@section('content')
  @php
    $quickCategories = [
      ['title' => 'گوشی موبایل', 'icon' => 'bi-phone'],
      ['title' => 'ساعت', 'icon' => 'bi-smartwatch'],
      ['title' => 'هدفون و هندزفری', 'icon' => 'bi-earbuds'],
      ['title' => 'اسپیکر', 'icon' => 'bi-speaker'],
      ['title' => 'کنسول و گیم', 'icon' => 'bi-controller'],
      ['title' => 'لوازم خانگی برقی', 'icon' => 'bi-lightning-charge'],
      ['title' => 'پاوربانک', 'icon' => 'bi-battery-charging'],
      ['title' => 'فلش مموری', 'icon' => 'bi-usb-plug'],
    ];

    $makeProducts = function ($prefix, $count = 6) {
      $items = [];
      for ($i = 1; $i <= $count; $i++) {
        $price = rand(450000, 12500000);
        $old = $price + rand(150000, 900000);
        $discount = (int) round((($old - $price) / $old) * 100);
        $items[] = [
          'title' => "$prefix مدل $i",
          'sub' => 'گارانتی ۱۸ ماه | ارسال سریع',
          'price' => $price,
          'old' => $old,
          'discount' => $discount,
        ];
      }
      return $items;
    };

    $sections = [
      [
        'title' => 'موبایل، امسال بارتو ببند',
        'bg' => 'bg-soft-pink',
        'items' => $makeProducts('گوشی اقتصادی', 6),
        'icon' => 'bi-fire'
      ],
      [
        'title' => 'پر‌فروش‌ترین موبایل',
        'bg' => 'bg-soft-purple',
        'items' => $makeProducts('گوشی پرفروش', 6),
        'icon' => 'bi-stars'
      ],
      [
        'title' => 'پر‌فروش‌ترین اسپیکر',
        'bg' => 'bg-soft-blue',
        'items' => $makeProducts('اسپیکر', 6),
        'icon' => 'bi-volume-up'
      ],
      [
        'title' => 'ویژه همین هفته: ایرپاد و هندزفری',
        'bg' => 'bg-soft-orange',
        'items' => $makeProducts('هندزفری', 6),
        'icon' => 'bi-headphones'
      ],
    ];

    $money = fn($n) => number_format($n) . ' تومان';
  @endphp

  <div class="container">

      {{-- HERO + SLIDER --}}
      <div class="hero-wrap mb-4">
          <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">

                  <div class="carousel-item active">
                      <div class="hero-slide">
                          <div class="row align-items-center g-4 w-100">
                              <div class="col-lg-7 text-white">
                                  <div class="d-inline-flex align-items-center gap-2 mb-2">
                                      <span class="badge text-bg-light text-dark rounded-pill px-3 py-2 fw-bold">
                                          با کسری پلاس امسال بارت رو ببند!
                                      </span>
                                  </div>
                                  <h2 class="hero-title h3 mb-2">خرید همکاری + ارسال سریع + قیمت رقابتی</h2>
                                  <p class="hero-sub mb-3">بستر معتبر پخش عمده انواع کالاهای دیجیتال با شرایط همکاری ویژه.</p>

                                  <span class="hero-chip"><i class="bi bi-truck"></i> ارسال سریع</span>
                                  <span class="hero-chip"><i class="bi bi-shield-check"></i> تضمین اصالت</span>
                                  <span class="hero-chip"><i class="bi bi-credit-card"></i> خرید چکی</span>

                                  <div class="mt-3 d-flex gap-2 flex-wrap">
                                      <a class="btn btn-light btn-pill px-4" href="#">مشاهده پیشنهادها</a>
                                      <a class="btn btn-outline-light btn-pill px-4" href="#">درخواست همکاری</a>
                                  </div>
                              </div>

                              <div class="col-lg-5">
                                  <div class="hero-illu"></div>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="carousel-item">
                      <div class="hero-slide">
                          <div class="row align-items-center g-4 w-100">
                              <div class="col-lg-7 text-white">
                                  <h2 class="hero-title h3 mb-2">فروش ویژه لوازم جانبی</h2>
                                  <p class="hero-sub mb-3">کابل، شارژر، پاوربانک، گجت‌ها و… با تخفیف‌های روزانه.</p>
                                  <div class="mt-3 d-flex gap-2 flex-wrap">
                                      <a class="btn btn-light btn-pill px-4" href="#">دیدن تخفیف‌ها</a>
                                      <a class="btn btn-outline-light btn-pill px-4" href="#">دسته‌بندی‌ها</a>
                                  </div>
                              </div>
                              <div class="col-lg-5">
                                  <div class="hero-illu"></div>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="carousel-item">
                      <div class="hero-slide">
                          <div class="row align-items-center g-4 w-100">
                              <div class="col-lg-7 text-white">
                                  <h2 class="hero-title h3 mb-2">ویترین امروزت رو بچین</h2>
                                  <p class="hero-sub mb-3">محصولات پرفروش رو سریع انتخاب کن و با قیمت همکاری سفارش بده.</p>
                                  <div class="mt-3 d-flex gap-2 flex-wrap">
                                      <a class="btn btn-light btn-pill px-4" href="#">شروع خرید</a>
                                      <a class="btn btn-outline-light btn-pill px-4" href="#">پرفروش‌ها</a>
                                  </div>
                              </div>
                              <div class="col-lg-5">
                                  <div class="hero-illu"></div>
                              </div>
                          </div>
                      </div>
                  </div>

              </div>

              <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon"></span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                  <span class="carousel-control-next-icon"></span>
              </button>
          </div>
      </div>

      {{-- QUICK CATEGORIES --}}
      <div class="d-flex align-items-center justify-content-between mb-2">
          <div class="fw-bold"><i class="bi bi-lightning-charge ms-1 text-primary"></i> دسته‌بندی سریع</div>
          <a class="text-decoration-none small fw-bold" href="#">همه دسته‌ها <i class="bi bi-arrow-left-short"></i></a>
      </div>

      <div class="quick-cats mb-4">
          @foreach($quickCategories as $cat)
            <a class="cat-tile" href="#">
                <div class="cat-icon">
                    <i class="bi {{ $cat['icon'] }} fs-3 text-primary"></i>
                </div>
                <div class="small fw-bold text-center">{{ $cat['title'] }}</div>
            </a>
          @endforeach
      </div>

      {{-- FIRST SECTION (PINK) --}}
      @foreach($sections as $section)
        <div class="section-card {{ $section['bg'] }} mb-4">
            <div class="p-3 p-md-4">
                <div class="section-head mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge rounded-pill text-bg-light text-dark px-3 py-2 fw-bold">
                            <i class="bi {{ $section['icon'] }} ms-1"></i>
                            {{ $section['title'] }}
                        </span>
                    </div>

                    <a class="more-link text-danger" href="#">
                        مشاهده بیشتر <i class="bi bi-arrow-left-short fs-5"></i>
                    </a>
                </div>

                <div class="row g-3">
                    @foreach($section['items'] as $p)
                      <div class="col-12 col-md-6 col-lg-4">
                          <div class="product-card p-3">
                              <div class="d-flex gap-3">
                                  <div class="p-thumb">
                                      <i class="bi bi-box-seam"></i>
                                  </div>

                                  <div class="p-meta flex-grow-1">
                                      <div class="d-flex justify-content-between align-items-start gap-2">
                                          <h3 class="p-title">{{ $p['title'] }}</h3>
                                          <span class="badge badge-discount rounded-pill px-2 py-1">
                                              {{ $p['discount'] }}%
                                          </span>
                                      </div>

                                      <p class="p-sub">{{ $p['sub'] }}</p>

                                      <div class="d-flex align-items-end justify-content-between mt-2">
                                          <div>
                                              <div class="price text-dark">{{ $money($p['price']) }}</div>
                                              <div class="old-price">{{ $money($p['old']) }}</div>
                                          </div>

                                          <div class="d-flex gap-2">
                                              <button class="btn btn-outline-secondary btn-sm btn-pill">
                                                  <i class="bi bi-heart"></i>
                                              </button>
                                              <button class="btn btn-primary btn-sm btn-pill">
                                                  افزودن <i class="bi bi-bag-plus ms-1"></i>
                                              </button>
                                          </div>
                                      </div>

                                  </div>
                              </div>
                          </div>
                      </div>
                    @endforeach
                </div>

            </div>
        </div>

        {{-- PROMO BANNER AFTER FIRST SECTION --}}
        @if($loop->first)
          <div class="promo-banner mb-4">
              <div class="row align-items-center g-3">
                  <div class="col-lg-8">
                      <div class="fw-bold mb-1">ویترین امروز بچین</div>
                      <div class="h4 fw-black mb-0">۱۵ روز بعد پرداخت کن</div>
                      <div class="small opacity-75 mt-2">شرایط همکاری ویژه برای فروشندگان</div>
                  </div>
                  <div class="col-lg-4 text-lg-start">
                      <a class="btn btn-light btn-pill px-4" href="#">مشاهده شرایط</a>
                  </div>
              </div>
          </div>
        @endif
      @endforeach

      {{-- ABOUT / INFO --}}
      <div class="row g-3 mt-1">
          <div class="col-lg-6">
              <div class="footer-card p-4 h-100">
                  <div class="fw-bold mb-2"><i class="bi bi-info-circle ms-1 text-primary"></i> درباره ما</div>
                  <p class="text-muted mb-0">
                      اینجا می‌تونی متن معرفی فروشگاه، مدل همکاری، نحوه ارسال و مزیت‌ها رو بذاری.
                      ساختار طوریه که دقیقاً مثل نمونه، کارت‌های اطلاع‌رسانی پایین صفحه داشته باشیم.
                  </p>
              </div>
          </div>
          <div class="col-lg-6">
              <div class="footer-card p-4 h-100">
                  <div class="fw-bold mb-2"><i class="bi bi-headset ms-1 text-primary"></i> پشتیبانی و شرایط</div>
                  <ul class="mb-0 text-muted">
                      <li>ارسال سریع و پیگیری سفارش</li>
                      <li>تضمین اصالت کالا</li>
                      <li>پشتیبانی تلفنی و واتساپ</li>
                      <li>امکان خرید همکاری / چکی (در صورت فعال‌سازی)</li>
                  </ul>
              </div>
          </div>
      </div>

  </div>
@endsection
