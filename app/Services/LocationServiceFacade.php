<?php

namespace App\Services;

use Illuminate\Support\Facades\Facade;

class LocationServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return LocationService::class;
    }
}
