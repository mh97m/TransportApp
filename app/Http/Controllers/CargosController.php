<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\CargoView;
use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CargosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $query = Cargo::query();

        $query->whereNull('completed_at');

        $sortField = request('sort_field', 'created_at');
        $sortDirection = request('sort_direction', 'desc');

        if (request('originProvinceId')) {
            $query->where([
                'origin_province_id' => request('originProvinceId'),
            ]);
        }

        if (request('destinationProvinceId')) {
            $query->where([
                'destination_province_id' => request('destinationProvinceId'),
            ]);
        }

        $query->with([
            'originProvince',
            'destinationProvince',
            'originCity',
            'destinationCity',
            'carType',
            'loaderType',
        ]);

        $query->orderBy($sortField, $sortDirection);

        $data = $query->get();
            // ->paginate(10)
            // ->onEachSide(1);

        // $this->logCargoViews($data);

        return inertia('Cargos/List', [
            'provinces' => fn () => Province::select([
                'id',
                'title',
            ])->get(),
            'cargos' => $data,
            'queryParams' => request()->query() ?: null,
            // 'success' => session('success'),
        ]);
    }

    private function logCargoViews($cargos)
    {
        $driver_id = auth()->user()->id;
        foreach ($cargos as $cargo) {
            CargoView::firstOrCreate([
                'cargo_id' => $cargo->id,
                'driver_id' => $driver_id,
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
