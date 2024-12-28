<?php

use App\Models\Province;
use App\Services\LocationServiceFacade;
use Illuminate\Support\Facades\Artisan;

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
