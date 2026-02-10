@extends('layouts.app')

@section('title', $isArchive ? 'آرشیو محصولات' : 'صفحه محصولات')

@section('content')
<div class="container products-page">
  <div class="d-flex align-items-center justify-content-between mb-3">
    <div>
      <h1 class="h3 mb-1 fw-bold">{{ $isArchive ? 'آرشیو محصولات' : 'صفحه محصولات' }}</h1>
      <p class="text-muted mb-0">لیست محصولات به‌صورت ۱۲ تایی + فیلتر Ajax</p>
    </div>
    <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-pill">همه محصولات</a>
  </div>

  <div class="row g-4">
    <div class="col-lg-3 order-2 order-lg-1">
      <aside class="filters-sidebar" id="filtersSidebar">
        <form id="productsFilterForm" action="{{ $isArchive ? route('products.archive') : route('products.index') }}" method="get" class="filter-card p-3">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <h2 class="h6 m-0 fw-bold">فیلترها</h2>
            <button type="button" id="clearFilters" class="btn btn-sm btn-outline-danger">حذف فیلترها</button>
          </div>

          <div class="mb-3">
            <label class="form-label small fw-bold">جستجو</label>
            <input type="text" class="form-control" name="q" value="{{ $filters['q'] }}" placeholder="نام محصول یا برند">
          </div>

          <div class="mb-3">
            <label class="form-label small fw-bold">فیلتر قیمت</label>
            <div class="row g-2">
              <div class="col-6"><input type="number" class="form-control" name="min_price" value="{{ $filters['min_price'] ?: '' }}" placeholder="حداقل"></div>
              <div class="col-6"><input type="number" class="form-control" name="max_price" value="{{ $filters['max_price'] ?: '' }}" placeholder="حداکثر"></div>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label small fw-bold">فیلتر برند</label>
            @foreach($filterOptions['brands'] as $brand)
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="brands[]" value="{{ $brand }}" id="brand-{{ md5($brand) }}" @checked(in_array($brand, $filters['brands']))>
                <label class="form-check-label" for="brand-{{ md5($brand) }}">{{ $brand }}</label>
              </div>
            @endforeach
          </div>

          <div class="mb-3">
            <label class="form-label small fw-bold">فیلتر دسته‌بندی</label>
            <select name="category" id="categorySelect" class="form-select mb-2">
              <option value="">همه دسته‌ها</option>
              @foreach($filterOptions['categories'] as $category => $subcats)
                <option value="{{ $category }}" @selected($filters['category'] === $category)>{{ $category }}</option>
              @endforeach
            </select>
            <select name="subcategory" id="subcategorySelect" class="form-select">
              <option value="">همه زیر‌دسته‌ها</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label small fw-bold">فیلتر رنگ</label>
            <div class="d-flex flex-wrap gap-2">
              @foreach($filterOptions['colors'] as $color)
                <label class="chip-check">
                  <input type="checkbox" name="colors[]" value="{{ $color }}" @checked(in_array($color, $filters['colors']))>
                  <span>{{ $color }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <div class="mb-2">
            <label class="form-label small fw-bold">مرتب‌سازی</label>
            <select name="sort" class="form-select">
              @foreach($filterOptions['sorts'] as $key => $title)
                <option value="{{ $key }}" @selected($filters['sort'] === $key)>{{ $title }}</option>
              @endforeach
            </select>
          </div>
        </form>
      </aside>
    </div>

    <div class="col-lg-9 order-1 order-lg-2">
      <div id="productsResults">
        @include('products.partials.results')
      </div>
    </div>
  </div>
</div>

<script>
(() => {
  const form = document.getElementById('productsFilterForm');
  const results = document.getElementById('productsResults');
  const clearBtn = document.getElementById('clearFilters');
  const categorySelect = document.getElementById('categorySelect');
  const subcategorySelect = document.getElementById('subcategorySelect');
  const categoriesMap = @json($filterOptions['categories']);
  const currentSub = @json($filters['subcategory']);

  function buildSubcategories(selectedCategory, selectedSub = '') {
    subcategorySelect.innerHTML = '<option value="">همه زیر‌دسته‌ها</option>';
    (categoriesMap[selectedCategory] || []).forEach((sub) => {
      const option = document.createElement('option');
      option.value = sub;
      option.textContent = sub;
      if (sub === selectedSub) option.selected = true;
      subcategorySelect.appendChild(option);
    });
  }

  buildSubcategories(categorySelect.value, currentSub);

  categorySelect.addEventListener('change', () => {
    buildSubcategories(categorySelect.value);
    submitFilters(true);
  });

  subcategorySelect.addEventListener('change', () => submitFilters(true));

  let timer;
  form.querySelectorAll('input, select').forEach((el) => {
    const eventName = (el.type === 'text' || el.type === 'number') ? 'input' : 'change';
    el.addEventListener(eventName, () => {
      clearTimeout(timer);
      timer = setTimeout(() => submitFilters(true), 250);
    });
  });

  clearBtn.addEventListener('click', () => {
    form.reset();
    buildSubcategories('');
    submitFilters(true);
  });

  form.addEventListener('submit', (e) => {
    e.preventDefault();
    submitFilters(true);
  });

  results.addEventListener('click', (e) => {
    const link = e.target.closest('.pagination a');
    if (!link) return;
    e.preventDefault();
    submitFilters(false, new URL(link.href).searchParams.get('page') || 1);
  });

  async function submitFilters(resetPage = true, forcedPage = null) {
    const formData = new FormData(form);
    if (resetPage) {
      formData.delete('page');
    }
    if (forcedPage) {
      formData.set('page', forcedPage);
    }

    const params = new URLSearchParams(formData);
    params.set('ajax', '1');

    const targetUrl = `${form.action}?${params.toString()}`;
    history.replaceState(null, '', `${form.action}?${params.toString().replace('&ajax=1', '').replace('ajax=1', '')}`);

    const response = await fetch(targetUrl, {
      headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
    });
    const payload = await response.json();
    results.innerHTML = payload.html;
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }
})();
</script>
@endsection
