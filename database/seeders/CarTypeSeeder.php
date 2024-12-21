<?php

namespace Database\Seeders;

use App\Models\CarType;
use App\Models\LoaderType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // CarType::truncate();
        // LoaderType::truncate();

        $items = [
            'تریلی' => [
                'کفی',
                'بغلدار',
                'تیغه',
                'کمپرسی',
                'یخچالی',
                'چادری',
                'تانکر (مخزن دار)',
            ],
            'جفت' => [
                'روباز',
                'مسقف',
                'کمپرسی',
                'یخچالی',
            ],
            'تک' => [
                'روباز',
                'مسقف',
                'کمپرسی',
                'یخچالی',
            ],
            'خاور و کامیونت' => [
                'روباز',
                'مسقف',
                'کمپرسی',
                'یخچالی',
            ],
            'وانت و نیسان' => [
                'نیسان',
                'نیسان یخچالی',
                'وانت',
            ],
        ];

        foreach ($items as $key => $value) {
            $carType = CarType::create([
                'title' => $key,
            ]);

            // foreach ($value as $val) {
            //     LoaderType::create([
            //         'title' => $val,
            //         'car_type_id' => $carType->id,
            //     ]);
            // }
        }
    }
}
