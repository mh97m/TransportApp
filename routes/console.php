<?php

use App\Models\Cargo;
use App\Models\CargoType;
use App\Models\CarType;
use App\Models\City;
use App\Models\LoaderType;
use App\Models\Province;
use App\Models\User;
use App\Services\LocationServiceFacade;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

require __DIR__.'/general.php';


Artisan::command('test', function () {
    dd(
        fake()->address()
    );
    $originCity = Province::where('title', 'تهران')->first();
    $destinationCity = Province::where('title', 'قم')->first();

    $d = LocationServiceFacade::getDistance(
        $originCity,
        $destinationCity,
    );

    dd(
        $originCity->title,
        $destinationCity->title,
        $d,
    );
});
