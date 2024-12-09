<?php

use App\Models\Cargo;
use App\Models\CargoType;
use App\Models\CarType;
use App\Models\City;
use App\Models\LoaderType;
use App\Models\Province;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;



Artisan::command('test', function () {
    Cargo::create([
        'mobile' => User::first()->mobile,

        'origin_province_id' => Province::inRandomOrder()->first()->id,
        'origin_city_id' => City::inRandomOrder()->first()->id,

        'destination_province_id' => Province::inRandomOrder()->first()->id,
        'destination_city_id' => City::inRandomOrder()->first()->id,

        'car_type_id' => CarType::inRandomOrder()->first()->id,
        'loader_type_id' => LoaderType::inRandomOrder()->first()->id,

        'cargo_type_id' => CargoType::inRandomOrder()->first()->id,

        'weight' => 100,

        'price' => 100000000,

        'description' => '$this->description',

        'user_id' => User::first()->id,
    ]);
});
