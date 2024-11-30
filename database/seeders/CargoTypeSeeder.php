<?php

namespace Database\Seeders;

use App\Models\CargoType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CargoTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CargoType::truncate();

        $items = [
            'مواد غذایی',
            'مواد فاسدشدنی',
            'محصولات کشاورزی',
            'محصولات دامی',
            'مواد صنعتی',
            'لوازم الکتریکی',
            'ماشین‌آلات صنعتی',
            'مواد ساختمانی',
            'سنگ و سیمان',
            'پروفیل و آهن‌آلات',
            'مواد شیمیایی',
            'مواد خطرناک (مواد قابل اشتعال)',
            'دارو و محصولات پزشکی',
            'محصولات آرایشی و بهداشتی',
            'پوشاک و منسوجات',
            'کالاهای بسته‌بندی‌شده',
            'محصولات صادراتی',
            'لوازم منزل و اثاثیه',
            'کالاهای حجیم',
            'کالاهای سنگین',
            'کانتینری',
            'حیوانات زنده',
            'کالاهای یخچالی',
            'چوب و الوار',
            'کالاهای لوکس و گران‌بها',
            'محصولات کشاورزی فصلی',
            'خرده‌بار',
            'کالاهای مایع (تانکری)',
            'کالاهای گازی (سیلندری)',
            'محصولات پلاستیکی',
            'مواد بازیافتی',
        ];

        foreach ($items as $item) {
            CargoType::create([
                'name' => $item,
            ]);
        }
    }
}
