<?php

namespace App\Support;

class FakeProducts
{
    public static function all(): array
    {
        $baseProducts = [
            ['title' => 'Poco C85', 'brand' => 'Xiaomi', 'category' => 'موبایل', 'subcategory' => 'اقتصادی'],
            ['title' => 'Redmi Note 13', 'brand' => 'Xiaomi', 'category' => 'موبایل', 'subcategory' => 'میان‌رده'],
            ['title' => 'Galaxy A25', 'brand' => 'Samsung', 'category' => 'موبایل', 'subcategory' => 'میان‌رده'],
            ['title' => 'Galaxy S24', 'brand' => 'Samsung', 'category' => 'موبایل', 'subcategory' => 'پرچمدار'],
            ['title' => 'iPhone 14', 'brand' => 'Apple', 'category' => 'موبایل', 'subcategory' => 'پرچمدار'],
            ['title' => 'iPhone 13', 'brand' => 'Apple', 'category' => 'موبایل', 'subcategory' => 'پرچمدار'],
            ['title' => 'GT Neo', 'brand' => 'Realme', 'category' => 'موبایل', 'subcategory' => 'میان‌رده'],
            ['title' => 'C67', 'brand' => 'Realme', 'category' => 'موبایل', 'subcategory' => 'اقتصادی'],
            ['title' => 'Nord CE', 'brand' => 'OnePlus', 'category' => 'موبایل', 'subcategory' => 'میان‌رده'],
            ['title' => '11R', 'brand' => 'OnePlus', 'category' => 'موبایل', 'subcategory' => 'پرچمدار'],
            ['title' => 'Watch 4', 'brand' => 'Samsung', 'category' => 'گجت پوشیدنی', 'subcategory' => 'ساعت هوشمند'],
            ['title' => 'Watch SE', 'brand' => 'Apple', 'category' => 'گجت پوشیدنی', 'subcategory' => 'ساعت هوشمند'],
            ['title' => 'Buds 3', 'brand' => 'Xiaomi', 'category' => 'صوتی', 'subcategory' => 'هندزفری'],
            ['title' => 'AirPods 3', 'brand' => 'Apple', 'category' => 'صوتی', 'subcategory' => 'هندزفری'],
            ['title' => 'Sound Max', 'brand' => 'Anker', 'category' => 'صوتی', 'subcategory' => 'اسپیکر'],
            ['title' => 'Boom 2', 'brand' => 'JBL', 'category' => 'صوتی', 'subcategory' => 'اسپیکر'],
            ['title' => 'Power 20K', 'brand' => 'Anker', 'category' => 'لوازم جانبی', 'subcategory' => 'پاوربانک'],
            ['title' => 'MagSafe 10K', 'brand' => 'Baseus', 'category' => 'لوازم جانبی', 'subcategory' => 'پاوربانک'],
            ['title' => 'Turbo Cable', 'brand' => 'Baseus', 'category' => 'لوازم جانبی', 'subcategory' => 'کابل'],
            ['title' => 'FastCharge C2C', 'brand' => 'Anker', 'category' => 'لوازم جانبی', 'subcategory' => 'کابل'],
            ['title' => 'Tab S9 FE', 'brand' => 'Samsung', 'category' => 'تبلت', 'subcategory' => 'اندرویدی'],
            ['title' => 'iPad Air', 'brand' => 'Apple', 'category' => 'تبلت', 'subcategory' => 'iPad'],
            ['title' => 'Pad 6', 'brand' => 'Xiaomi', 'category' => 'تبلت', 'subcategory' => 'اندرویدی'],
            ['title' => 'Tab M11', 'brand' => 'Lenovo', 'category' => 'تبلت', 'subcategory' => 'اندرویدی'],
        ];

        $palettes = [
            [
                ['name' => 'مشکی', 'hex' => '#111827'],
                ['name' => 'بنفش', 'hex' => '#7e22ce'],
                ['name' => 'سبز', 'hex' => '#166534'],
            ],
            [
                ['name' => 'آبی', 'hex' => '#1d4ed8'],
                ['name' => 'سفید', 'hex' => '#e5e7eb'],
                ['name' => 'طلایی', 'hex' => '#ca8a04'],
            ],
            [
                ['name' => 'خاکستری', 'hex' => '#4b5563'],
                ['name' => 'سبز', 'hex' => '#22c55e'],
                ['name' => 'صورتی', 'hex' => '#db2777'],
            ],
        ];

        $items = [];
        foreach ($baseProducts as $index => $item) {
            $id = $index + 1;
            $price = 5500000 + ($index * 840000);
            $oldPrice = $price + 900000;
            $colors = $palettes[$index % 3];

            $items[] = [
                'id' => $id,
                'title' => $item['title'] . ' ' . (64 + $id) . '/8GB',
                'subtitle' => 'ارسال سریع | گارانتی ۱۸ ماه شرکتی',
                'brand' => $item['brand'],
                'category' => $item['category'],
                'subcategory' => $item['subcategory'],
                'price' => $price,
                'old_price' => $oldPrice,
                'view_count' => 1300 + ($index * 89),
                'sold_count' => 140 + ($index * 13),
                'image' => "https://picsum.photos/seed/product-{$id}/500/500",
                'colors' => $colors,
                'offers' => [
                    ['seller' => 'کسری پلاس', 'price' => $price, 'warranty' => '۱۸ ماه گارانتی شرکتی'],
                    ['seller' => 'موبایل سنتر', 'price' => $price + 250000, 'warranty' => 'ارسال فوری + رجیستری'],
                ],
                'specs' => [
                    ['key' => 'برند', 'value' => $item['brand']],
                    ['key' => 'دسته‌بندی', 'value' => $item['category'] . ' / ' . $item['subcategory']],
                    ['key' => 'RAM', 'value' => '8 گیگابایت'],
                    ['key' => 'حافظه داخلی', 'value' => (64 + $id) . ' گیگابایت'],
                    ['key' => 'سیستم‌عامل', 'value' => 'اندروید 14'],
                ],
            ];
        }

        return $items;
    }

    public static function find(int $id): ?array
    {
        foreach (self::all() as $product) {
            if ($product['id'] === $id) {
                return $product;
            }
        }

        return null;
    }

    public static function sections(): array
    {
        $products = self::all();

        return [
            [
                'title' => 'محصولات ویژه امروز',
                'bg' => 'bg-soft-pink',
                'icon' => 'bi-fire',
                'items' => array_slice($products, 0, 6),
            ],
            [
                'title' => 'پر‌فروش‌ترین‌ها',
                'bg' => 'bg-soft-purple',
                'icon' => 'bi-stars',
                'items' => array_slice(array_reverse($products), 0, 6),
            ],
        ];
    }

    public static function filterOptions(): array
    {
        $items = self::all();

        $brands = array_values(array_unique(array_column($items, 'brand')));
        sort($brands);

        $categories = [];
        $colors = [];
        foreach ($items as $item) {
            $categories[$item['category']][] = $item['subcategory'];
            foreach ($item['colors'] as $color) {
                $colors[] = $color['name'];
            }
        }

        foreach ($categories as $category => $subcats) {
            $categories[$category] = array_values(array_unique($subcats));
        }

        return [
            'brands' => $brands,
            'categories' => $categories,
            'colors' => array_values(array_unique($colors)),
            'sorts' => [
                'popular' => 'پیش‌فرض',
                'expensive' => 'گران‌ترین',
                'cheap' => 'ارزان‌ترین',
                'bestselling' => 'پرفروش‌ترین',
                'most_viewed' => 'پربازدیدترین',
            ],
        ];
    }
}
