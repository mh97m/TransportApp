<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getProvinces()
    {
        $query = Province::query();

        $query->select([
            'id',
            'title',
        ]);

        $query->orderBy('name', 'asc');

        $data = $query->get();

        return response()->json(
            data: $data,
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function getCities()
    {
        $query = City::query();

        if (request('province_id')) {
            $query->where([
                'province_id' => request('province_id'),
            ]);
        }

        $query->select([
            'id',
            'title',
        ]);

        $query->orderBy('name', 'asc');

        $data = $query->get();

        return response()->json(
            data: $data,
        );
    }
}
