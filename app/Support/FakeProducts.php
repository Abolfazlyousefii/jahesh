<?php

namespace App\Support;

class FakeProducts
{
    public static function all(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Poco C85 4G 128/6GB',
                'subtitle' => 'ارسال سریع | گارانتی ۱۸ ماه',
                'price' => 18500000,
                'old_price' => 19200000,
                'image' => 'https://fdn2.gsmarena.com/vv/pics/xiaomi/xiaomi-poco-c65-1.jpg',
                'colors' => [
                    ['name' => 'بنفش', 'hex' => '#7e22ce'],
                    ['name' => 'مشکی', 'hex' => '#111111'],
                    ['name' => 'سبز', 'hex' => '#3f7d32'],
                ],
                'offers' => [
                    ['seller' => 'سورن پلاس', 'price' => 18500000, 'warranty' => '۱۸ ماه گارانتی شرکتی'],
                    ['seller' => 'گوشی سنتر', 'price' => 18400000, 'warranty' => '۱۸ ماه گارانتی شرکتی'],
                ],
                'specs' => [
                    ['key' => 'مقاومت در آب و گرد و غبار', 'value' => 'گواهی IP54'],
                    ['key' => 'ابعاد / وزن', 'value' => '8.1 × 77.8 × 168 میلی‌متر / 205 گرم'],
                    ['key' => 'سیستم‌عامل', 'value' => 'اندروید 14'],
                    ['key' => 'نوع پردازنده - CPU', 'value' => 'MediaTek Helio G81 Ultra'],
                    ['key' => 'RAM', 'value' => '6 گیگابایت'],
                    ['key' => 'حافظه داخلی', 'value' => '128 گیگابایت'],
                ],
            ],
            [
                'id' => 2,
                'title' => 'Samsung A25 5G 256/8GB',
                'subtitle' => 'موجود در انبار | رجیستر شده',
                'price' => 22400000,
                'old_price' => 23800000,
                'image' => 'https://fdn2.gsmarena.com/vv/pics/samsung/samsung-galaxy-a25-5g-1.jpg',
                'colors' => [
                    ['name' => 'آبی', 'hex' => '#1d4ed8'],
                    ['name' => 'زرد', 'hex' => '#fbbf24'],
                    ['name' => 'مشکی', 'hex' => '#0f172a'],
                ],
                'offers' => [
                    ['seller' => 'دیجیتال گستر', 'price' => 22400000, 'warranty' => '۱۸ ماه گارانتی شرکتی'],
                    ['seller' => 'موبایل مارکت', 'price' => 22600000, 'warranty' => 'گارانتی + رجیستری'],
                ],
                'specs' => [
                    ['key' => 'اندازه صفحه', 'value' => '6.5 اینچ Super AMOLED'],
                    ['key' => 'سیستم‌عامل', 'value' => 'اندروید 14'],
                    ['key' => 'پردازنده', 'value' => 'Exynos 1280'],
                    ['key' => 'RAM', 'value' => '8 گیگابایت'],
                    ['key' => 'حافظه داخلی', 'value' => '256 گیگابایت'],
                ],
            ],
            [
                'id' => 3,
                'title' => 'Redmi Note 13 256/8GB',
                'subtitle' => 'گارانتی معتبر | ارسال امروز',
                'price' => 19800000,
                'old_price' => 21000000,
                'image' => 'https://fdn2.gsmarena.com/vv/pics/xiaomi/xiaomi-redmi-note-13-4g-1.jpg',
                'colors' => [
                    ['name' => 'سبز', 'hex' => '#15803d'],
                    ['name' => 'سفید', 'hex' => '#e2e8f0'],
                    ['name' => 'مشکی', 'hex' => '#111827'],
                ],
                'offers' => [
                    ['seller' => 'کسری پلاس', 'price' => 19800000, 'warranty' => '۱۸ ماه گارانتی شرکتی'],
                    ['seller' => 'بازار موبایل', 'price' => 20000000, 'warranty' => '۱۸ ماه گارانتی'],
                ],
                'specs' => [
                    ['key' => 'نمایشگر', 'value' => 'AMOLED 120Hz'],
                    ['key' => 'پردازنده', 'value' => 'Snapdragon 685'],
                    ['key' => 'RAM', 'value' => '8 گیگابایت'],
                    ['key' => 'حافظه داخلی', 'value' => '256 گیگابایت'],
                ],
            ],
        ];
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
                'title' => 'موبایل، امسال بارتو ببند',
                'bg' => 'bg-soft-pink',
                'icon' => 'bi-fire',
                'items' => $products,
            ],
            [
                'title' => 'پر‌فروش‌ترین موبایل',
                'bg' => 'bg-soft-purple',
                'icon' => 'bi-stars',
                'items' => array_reverse($products),
            ],
        ];
    }
}
