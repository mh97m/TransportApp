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
        $provinces = Province::query()->orderBy('name', 'asc')->get();
        // $cities = City::query()->orderBy('name', 'asc')->get();

        $query = Project::query();

        $sortField = request("sort_field", 'created_at');
        $sortDirection = request("sort_direction", "desc");

        if (request("name")) {
            $query->where("name", "like", "%" . request("name") . "%");
        }
        if (request("status")) {
            $query->where("status", request("status"));
        }

        $projects = $query->orderBy($sortField, $sortDirection)
            ->paginate(10)
            ->onEachSide(1);

        return inertia("Project/Index", [
            "projects" => ProjectResource::collection($projects),
            'queryParams' => request()->query() ?: null,
            'success' => session('success'),
        ]);

        $query = Cargo::query();
        $query->whereNull('completed_at');

        // if ($this->originProvince != '') {
        //     $query->where('origin_province_id', $this->originProvince);
        // }
        // if ($this->originCity != '') {
        //     $query->where('origin_city_id', $this->originCity);
        // }
        // if ($this->destinationProvince != '') {
        //     $query->where('destination_province_id', $this->destinationProvince);
        // }
        // if ($this->destinationCity != '') {
        //     $query->where('destination_city_id', $this->destinationCity);
        // }

        $query->orderByDesc('created_at');

        $query->with(['originProvince', 'destinationProvince', 'carType', 'loaderType']);

        // dd(
        //     $cargos
        // );

        // $this->logCargoViews($cargos);

        // dd([
        //     'provinces' => $provinces,
        //     'cargos' => $cargos,
        // ]);
        return Inertia::render('Cargos/List', [
            'provinces' => $provinces,
            'cargos' => $query->get(),
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
