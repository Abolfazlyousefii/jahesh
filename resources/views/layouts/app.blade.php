<!doctype html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'فروشگاه لوازم جانبی')</title>
  @vite(['resources/js/app.js'])
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-glass sticky-top">
    <div class="container py-2">

      <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ route('home') }}">
        <span class="brand-badge"></span>
        <span>کسری پلاس</span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="topNav">
        <div class="d-flex align-items-center gap-2 ms-0 me-auto w-100">
          <div class="dropdown d-none d-lg-block">
            <a class="btn btn-outline-secondary btn-pill" href="{{ route('products.index') }}">محصولات</a>
            
          </div>

          <div class="input-group search-pill w-100">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
            <input class="form-control" placeholder="جستجو کنید... مدل، برند، دسته">
          </div>
        </div>

        <div class="d-flex gap-2 mt-3 mt-lg-0">
          <a class="btn btn-outline-secondary btn-pill" href="#">
            <i class="bi bi-person ms-1"></i> ورود / ثبت‌نام
          </a>
          <a class="btn btn-primary btn-pill" href="#">
            <i class="bi bi-bag ms-1"></i> سبد خرید
          </a>
        </div>
      </div>
    </div>
  </nav>

  <main class="py-4">
    @yield('content')
  </main>

  <footer class="py-4 mt-5">
    <div class="container">
      <div class="text-center text-muted small">
        © {{ date('Y') }} - طراحی شده با Laravel + Bootstrap
      </div>
    </div>
  </footer>

</body>

</html>