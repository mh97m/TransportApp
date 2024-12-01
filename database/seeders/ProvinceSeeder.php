<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Province::truncate();

        $items = json_decode(
            Storage::get(
                'jsons/provinces.json'
            ),
            true,
        );
        Province::insert($items);
    }
}
