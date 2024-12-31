<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\CargoType;
use App\Models\CargoView;
use App\Models\CarType;
use App\Models\City;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Province;
use App\Services\LocationServiceFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $query->where('car_type_id', auth()->user()->driverDetails->car_type_id);

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

        $cargos = $query->paginate(20);

        $this->logCargoViews($cargos);

        return Inertia::render('Cargos/List', [
            'provinces' => fn () => $this->searchSelectCollection(Province::get()),
            'cargos' => $cargos,
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
     * Show the form for creating a new resource.
     */
    public function createOrder(Cargo $cargo)
    {
        if (
            Order::where([
                'cargo_id' => $cargo->id,
                'driver_id' => auth()->user()->id,
            ])->exists()
        ) {
            return $this->flashAlert(
                icon: 'error',
                text: 'بار قبلا ثبت شده است',
                timer: 3000,
                confirmButtonText: 'تایید',
            );
        }

        $order = Order::create([
            'cargo_id' => $cargo->id,
            'driver_id' => auth()->user()->id,
            'order_status_id' => OrderStatus::where('slug', 'pending-decision')->first()->id,
        ]);

        return redirect()->route('cargos.editOrderStatus', ['order' => $order->ulid]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function editOrderStatus(Order $order)
    {
        abort_if(! $order->driver()->is(auth()->user()), 404);

        $cargo = $order->cargo()->with([
            'originProvince',
            'originCity',
            'destinationProvince',
            'destinationCity',
        ])->first();

        return Inertia::render('Cargos/EditOrderStatus', [
            'orderStatuses' => fn () => OrderStatus::select([
                'ulid',
                'color',
                'slug',
                'description',
            ])->get(),
            'cargo' => $cargo,
            'order' => $order,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function updateOrderStatus(Request $request)
    {
        $order = Order::where([
            'ulid' => $request->orderId,
        ])->first();

        $orderStatus = OrderStatus::where([
            'ulid' => $request->orderStatusId,
        ])->first();

        $abortCondition = ! $order ||
            ! $orderStatus ||
            ! $order->driver()->is(auth()->user());

        abort_if(
            $abortCondition,
            404,
        );

        $order->update([
            'order_status_id' => $orderStatus->id,
        ]);

        return $this->flashAlert(
            icon: 'success',
            text: 'بار با موفقیت ثبت شد',
            timer: 3000,
            confirmButtonText: 'تایید',
            route: route('cargos.list'),
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        return Inertia::render('Cargos/Create', [
            'cities' => fn () => $this->searchSelectCollection(City::get()),
            'carTypes' => fn () => $this->searchSelectCollection(CarType::get()),
            'cargoTypes' => fn () => $this->searchSelectCollection(CargoType::get()),
        ]);
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'mobile' => ['required', 'string', 'regex:/^09\d{9}$/i'],
            'cargoTypeId' => ['required', 'exists:cargo_types,id'],
            'carTypeId' => ['required', 'exists:car_types,id'],
            'originCityId' => ['required', 'exists:cities,id'],
            'destinationCityId' => ['required', 'exists:cities,id'],
            'weight' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'description' => ['required', 'string'],
            'temperatureRange' => ['required', 'array', 'min:2', 'max:2'],
        ]);

        // Get origin and destination cities
        $originCity = City::find($validated['originCityId']);
        $destinationCity = City::find($validated['destinationCityId']);

        // Calculate distance using the LocationService
        $distance = LocationServiceFacade::getDistance($originCity, $destinationCity);

        // Create a new cargo entry in the database
        Cargo::create([
            'mobile' => $validated['mobile'],
            'origin_province_id' => $originCity?->province_id,
            'origin_city_id' => $validated['originCityId'],
            'destination_province_id' => $destinationCity?->province_id,
            'destination_city_id' => $validated['destinationCityId'],
            'distance' => $distance,
            'car_type_id' => $validated['carTypeId'],
            'cargo_type_id' => $validated['cargoTypeId'],
            'weight' => $validated['weight'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'temperature_min' => $validated['temperatureRange'][0],
            'temperature_max' => $validated['temperatureRange'][1],
            'user_id' => Auth::id(),
        ]);

        // Redirect or return a success message
        return $this->flashAlert(
            icon: 'success',
            text: 'ثبت بار با موفقیت ثبت شد',
            timer: 3000,
            confirmButtonText: 'تایید',
            route: route('cargos.all'),
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function all()
    {
        $query = Cargo::query();

        $query->where('user_id', auth()->user()->id);

        $query->with([
            'originProvince',
            'destinationProvince',
            'originCity',
            'destinationCity',
            'carType',
            'loaderType',
        ]);

        $query->orderBy('created_at', 'desc');

        $cargos = $query->paginate(20);

        $this->logCargoViews($cargos);

        return Inertia::render('Cargos/All', [
            'cargos' => $cargos,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Cargo $cargo)
    {
        abort_if(!$cargo->user()->is(auth()->user()), 404);

        // Eager load only the necessary relationships and fields
        $cargo = $cargo->load([
            'originProvince:id,title',
            'originCity:id,title',
            'destinationProvince:id,title',
            'destinationCity:id,title',
            'carType:id,title',
            'orders.driver:id,name,mobile',
            'orders.driver.driverDetails:id,user_id,driver_id,car_type_id',
            'orders.driver.driverDetails.carType:id,title',
            'orders.status:id,order_status_id,color,description',
        ]);

        $cargoData = [
            'id' => $cargo->ulid,
            'viewsCount' => $cargo->views_count,
            'originProvince' => $cargo->originProvince->title ?? 'N/A',
            'originCity' => $cargo->originCity->title ?? 'N/A',
            'destinationProvince' => $cargo->destinationProvince->title ?? 'N/A',
            'destinationCity' => $cargo->destinationCity->title ?? 'N/A',
            'carType' => $cargo->carType->title ?? 'N/A',
            'price' => number_format($cargo->price),
            'weight' => number_format($cargo->weight),
            'description' => $cargo->description->full,
        ];

        $orders = $cargo->orders->map(function ($order) {
            return [
                'ulid' => $order->ulid,
                'driver' => [
                    'name' => $order->driver->name ?? 'ناموجود',
                    'mobile' => $order->driver->mobile ?? 'ناموجود',
                ],
                'driverDetails' => [
                    'carType' => $order->driver->driverDetails->carType->title ?? 'ناموجود',
                ],
                'orderStatus' => $order->status,
                'ownerStatus' => $order->owner_status,
                'isSetOwnerStatus' => $order->owner_status === null,
            ];
        });

        return Inertia::render('Cargos/Index', [
            'cargo' => $cargoData,
            'orders' => $orders,
        ]);
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
