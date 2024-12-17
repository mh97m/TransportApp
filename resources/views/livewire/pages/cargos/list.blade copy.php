<?php

use App\Models\Cargo;
use App\Models\CargoView;
use App\Models\City;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Province;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new #[Layout('layouts.app')] class extends Component {
    use WithPagination;

    public $originProvince = '';
    public $originCity = '';
    public $originProvinces = [];
    public $originCities = [];

    public $destinationProvince = '';
    public $destinationCity = '';
    public $destinationProvinces = [];
    public $destinationCities = [];

    public function mount()
    {
        // $this->dispatch('update-body-class', 'bg-secondary');
        $this->originProvinces = Province::query()
            ->orderBy('name', 'asc')
            ->get();
        $this->destinationProvinces = $this->originProvinces;
    }

    public function with(): array
    {
        $query = Cargo::query();
        $query->whereNull('completed_at');

        if ($this->originProvince != '') {
            $query->where(
                'origin_province_id', $this->originProvince
            );
        }
        if ($this->originCity != '') {
            $query->where(
                'origin_city_id', $this->originCity
            );
        }
        if ($this->destinationProvince != '') {
            $query->where(
                'destination_province_id', $this->destinationProvince
            );
        }
        if ($this->destinationCity != '') {
            $query->where(
                'destination_city_id', $this->destinationCity
            );
        }

        $query->orderByDesc('created_at');

        $cargos = $query->with([
            'originProvince',
            'destinationProvince',
            'carType',
            'loaderType',
        ])->paginate(10);

        $this->logCargoViews($cargos);

        return [
            'cargos' => $cargos,
        ];
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

    // public function loadCities($type, $value): void
    // {
    //     return;
    //     $this->{"{$type}City"} = '';
    //     $this->{"{$type}Cities"} = City::query()
    //         ->where('province_id', $value)
    //         ->orderBy('name', 'asc')
    //         ->get();
    // }

    public function makeOrder($id)
    {
        if (
            Order::where([
                'cargo_id' => $id,
                'driver_id' => auth()->user()->id,
            ])->exists()
        ) {
            $this->dispatch('swal', [
                'title' => 'بار قبلا ثبت شده است',
                'timer' => 3000,
                'type' => 'error',
                'confirmButtonText' => 'تایید',
            ]);
            return;
        }
        $order = Order::create([
            'cargo_id' => $id,
            'driver_id' => auth()->user()->id,
            'order_status_id' => OrderStatus::where('slug', 'pending-decision')->first()->id,
        ]);

        session()->put('order_created', $order->id);

        return redirect()->route('orders.set-status', ['order' => $order->ulid]);
    }

    public function search(): void
    {
        $this->with();
    }
}; ?>

<div class="container-fluid">
    <div class="row mt-4 mb-2">
        <div class="col">
            <form wire:submit.prevent="search">
                <div class="form-row">
                    <div class="form-group col-6 mb-2">
                        <div class="form-control-custom">
                            <select
                                class="form-control text-uppercase text-2"
                                wire:model="originProvince"
                            >
                                <option value="">استان مبدا</option>
                                @foreach ($originProvinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-6 mb-2">
                        <div class="form-control-custom">
                            <select
                                class="form-control text-uppercase text-2"
                                wire:model="destinationProvince"
                            >
                                <option value="">استان مقصد</option>
                                @foreach ($destinationProvinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-12 mb-2">
                        <input
                            type="submit"
                            value="جستجو"
                            class="btn btn-lg btn-block text-uppercase text-2"
                            style="background-color: #598bc4;"
                        >
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-3">
        @foreach ($cargos as $cargo)
        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
            <div class="card" style="border-radius: 10px; box-shadow: 0px 0px 7px rgba(0, 0, 0, 0.342);" >
                <div class="card-body text-center">
                    <!-- Origin and Destination Section -->
                    <div class="row d-flex justify-content-center align-items-center mb-3">
                        <div class="h5 font-weight-bold pr-3">
                            <i class="fas fa-map-marker-alt fa-lg text-primary"></i>
                            <span>مبدا:</span> 
                            <span>{{ $cargo->originProvince->title }} - {{ $cargo->originCity->title }}</span>
                        </div>
                        <div class="h5 font-weight-bold pl-3">
                            <i class="fas fa-map-signs fa-lg text-success"></i>
                            <span>مقصد:</span> 
                            <span>{{ $cargo->destinationProvince->title }} - {{ $cargo->destinationCity->title }}</span>
                        </div>
                    </div>
        
                    <!-- Arrow Below Origin and Destination -->
                    <div class="d-flex justify-content-center align-items-center my-4">
                        <div class="border-top border-primary" style="width: 100%;"></div>
                    </div>
        
                    <!-- Additional Info: ماشین and باربر in One Line -->
                    <div class="text-muted mt-3">
                        <p class="mb-2 d-flex justify-content-center">
                            <span class="pr-3"><i class="fas fa-truck fa-lg"></i> <strong>ماشین:</strong> {{ $cargo->carType->title }}</span>
                            <span class="pl-3"><i class="fas fa-box fa-lg"></i> <strong>باربر:</strong> {{ $cargo->loaderType->title }}</span>
                        </p>
                        <p class="mb-2 pt-2"><i class="fas fa-info-circle fa-lg"></i> <strong>توضیحات:</strong> {{ $cargo->description }}</p>
                    </div>
        
                    <!-- Price and Weight -->
                    <div class="row mt-4 text-center">
                        <div class="col-6">
                            <h5 class="text-warning">
                                <i class="fas fa-coins"></i> {{ number_format($cargo->price) }} تومان
                            </h5>
                            <p class="mb-0 text-muted">قیمت</p>
                        </div>
                        <div class="col-6">
                            <h5 class="text-secondary">
                                <i class="fas fa-weight"></i> {{ number_format($cargo->weight) }} کیلوگرم
                            </h5>
                            <p class="mb-0 text-muted">وزن</p>
                        </div>
                    </div>
                </div>
        
                <!-- Full-Width Footer Button -->
                <div class="card-footer0 p-0">
                    <a
                        href="tel:{{ $cargo->mobile }}"
                        wire:click="makeOrder({{ $cargo->id }})"
                        class="btn btn-primary btn-lg btn-block text-white text-uppercase"
                        style="border-radius: 10px;border-top-left-radius: 0px;border-top-right-radius: 0px;background-color: #598bc4;"
                    >
                        <i class="fas fa-phone-alt"></i> تماس با صاحب بار
                    </a>
                </div>
            </div>
        </div>
        
        
        @endforeach
    </div>

    <div class="row">
        <div class="col-12">
            {{ $cargos->links() }}
        </div>
    </div>
</div>
