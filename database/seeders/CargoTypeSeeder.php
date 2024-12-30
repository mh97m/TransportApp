<?php

namespace Database\Seeders;

use App\Models\CargoType;
use Illuminate\Database\Seeder;

class CargoTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // CargoType::truncate();
        $items = [
            'گوشت و فرآورده‌های گوشتی',
            'ماهی و غذاهای دریایی',
            'لبنیات (شیر، ماست، پنیر)',
            'سبزیجات تازه',
            'میوه‌های حساس به دما',
            'واکسن‌ها و داروهای حساس به دما',
            'مواد آزمایشگاهی و شیمیایی',
            'محصولات خون و پلاسمای خونی',
            'گل‌ها و گیاهان حساس به گرما',
            'محصولات ارگانیک حساس به فساد',
            'محصولات آرایشی حساس به دما (کرم‌ها، ماسک‌ها)',
            'شکلات‌ها و شیرینی‌های حساس به گرما',
            'مواد اولیه کیک و شیرینی (خامه، کره)',
            'بذرها و مواد اولیه کشاورزی',
            'رنگ‌ها و رزین‌های حساس به دما',
            'محصولات صادراتی کشاورزی (مانند انبه، توت‌فرنگی)',
        ];

        foreach ($items as $item) {
            CargoType::create([
                'title' => $item,
            ]);
        }
    }
}
