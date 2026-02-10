<?php

namespace App\Http\Controllers;

use App\Support\FakeProducts;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $filters = [
            'q' => trim((string) $request->string('q')),
            'min_price' => (int) $request->integer('min_price'),
            'max_price' => (int) $request->integer('max_price'),
            'brands' => array_values(array_filter((array) $request->input('brands', []))),
            'category' => trim((string) $request->string('category')),
            'subcategory' => trim((string) $request->string('subcategory')),
            'colors' => array_values(array_filter((array) $request->input('colors', []))),
            'sort' => trim((string) $request->string('sort', 'popular')),
        ];

        $products = collect(FakeProducts::all())
            ->when($filters['q'] !== '', function (Collection $items) use ($filters) {
                return $items->filter(function (array $item) use ($filters) {
                    $haystack = mb_strtolower($item['title'] . ' ' . $item['brand'] . ' ' . $item['category'] . ' ' . $item['subcategory']);

                    return str_contains($haystack, mb_strtolower($filters['q']));
                });
            })
            ->when($filters['min_price'] > 0, fn(Collection $items) => $items->where('price', '>=', $filters['min_price']))
            ->when($filters['max_price'] > 0, fn(Collection $items) => $items->where('price', '<=', $filters['max_price']))
            ->when(!empty($filters['brands']), fn(Collection $items) => $items->whereIn('brand', $filters['brands']))
            ->when($filters['category'] !== '', fn(Collection $items) => $items->where('category', $filters['category']))
            ->when($filters['subcategory'] !== '', fn(Collection $items) => $items->where('subcategory', $filters['subcategory']))
            ->when(!empty($filters['colors']), function (Collection $items) use ($filters) {
                return $items->filter(function (array $item) use ($filters) {
                    $productColors = collect($item['colors'])->pluck('name')->all();

                    return count(array_intersect($filters['colors'], $productColors)) > 0;
                });
            });

        $sorted = match ($filters['sort']) {
            'expensive' => $products->sortByDesc('price'),
            'cheap' => $products->sortBy('price'),
            'bestselling' => $products->sortByDesc('sold_count'),
            'most_viewed' => $products->sortByDesc('view_count'),
            default => $products->sortByDesc('sold_count')->sortByDesc('view_count'),
        };

        $sorted = $sorted->values();

        $perPage = 12;
        $currentPage = max(1, (int) $request->integer('page', 1));
        $total = $sorted->count();
        $items = $sorted->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $paginator = new LengthAwarePaginator(
            $items,
            $total,
            $perPage,
            $currentPage,
            [
                'path' => route($request->routeIs('products.archive') ? 'products.archive' : 'products.index'),
                'query' => $request->except('page'),
            ]
        );

        $viewData = [
            'products' => $items,
            'paginator' => $paginator,
            'filters' => $filters,
            'filterOptions' => FakeProducts::filterOptions(),
            'isArchive' => $request->routeIs('products.archive') || $filters['q'] !== '' || $filters['category'] !== '' || $filters['subcategory'] !== '',
            'seoText' => 'در این بخش آرشیو محصولات فروشگاه قرار دارد. این متن سئو فعلاً ثابت است و بعداً از پنل مدیریت به‌صورت داینامیک مدیریت خواهد شد.',
        ];

        if ($request->ajax() || $request->wantsJson() || $request->query('ajax') === '1') {
            return new JsonResponse([
                'html' => view('products.partials.results', $viewData)->render(),
                'total' => $total,
            ]);
        }

        return view('products.index', $viewData);
    }

    public function show(int $id)
    {
        $product = FakeProducts::find($id);

        abort_if(!$product, 404);

        return view('products.show', [
            'product' => $product,
        ]);
    }
}
