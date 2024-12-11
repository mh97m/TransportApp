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

    public function loadCities($type, $value): void
    {
        $this->{"{$type}City"} = '';
        $this->{"{$type}Cities"} = City::query()
            ->where('province_id', $value)
            ->orderBy('name', 'asc')
            ->get();
    }

    public function makeOrder($id)
    {
        if (
            Order::where([
                'cargo_id' => $id,
                'driver_id' => auth()->user()->id,
            ])->exists()
        ) {
            session()->flash('session-message', 'بار قبلا ثبت شده است.');
            session()->flash('session-title', ' خطا');
            session()->flash('session-color', 'danger');
            return redirect()->route('cargos.list');
        }
        $order = Order::create([
            'cargo_id' => $id,
            'driver_id' => auth()->user()->id,
            'order_status_id' => OrderStatus::where('slug', 'pending-decision')->first()->id,
        ]);

        session()->flash('order_created', $order->id);

        return redirect()->route('orders.set-status', ['order' => $order->ulid]);
    }

    public function search(): void
    {
        $this->with();
    }
}; ?>

<div>
    <section class="page-header page-header-modern bg-color-light-scale-1 page-header-md pt-1">
        <div class="container">
            <div class="row">
                <div class="col-md-8 order-2 order-md-1 align-self-center p-static mt-md-n2">
                    <h1 class="text-dark">بار ها </h1>
                    {{-- <p class="lead mb-0">لیست اعلام بار - 123 ملک</p> --}}
                </div>
                {{-- <div class="col-md-4 order-1 order-md-2 align-self-center mb-1 mb-md-0">
                    <ul class="breadcrumb d-block text-md-right">
                        <li><a href="demo-real-estate.html">خانه</a></li>
                        <li class="active">ملک ها</li>
                    </ul>
                </div> --}}
            </div>
            <div class="row mt-4 mb-2 mb-lg-0">
                <div class="col">
                    <form wire:submit="search">
                        <div class="form-row">
                            <div class="form-group col-lg-2 mb-0">
                                <div class="form-control-custom mb-3">
                                    <select
                                        class="form-control text-uppercase text-2"
                                        wire:model="originProvince"
                                        wire:change="loadCities('origin',$event.target.value)"
                                    >
                                        <option value="">استان مبدا</option>
                                        @foreach ($originProvinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-2 mb-0">
                                <div class="form-control-custom mb-3">
                                    <select
                                        class="form-control text-uppercase text-2"
                                        wire:model="originCity"
                                    >
                                        <option value="">شهر مبدا</option>
                                        @foreach ($originCities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-2 mb-0">
                                <div class="form-control-custom mb-3">
                                    <select
                                        class="form-control text-uppercase text-2"
                                        wire:model="destinationProvince"
                                        wire:change="loadCities('destination',$event.target.value)"
                                    >
                                        <option value="">استان مقصد</option>
                                        @foreach ($destinationProvinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-2 mb-0">
                                <div class="form-control-custom mb-3">
                                    <select
                                        class="form-control text-uppercase text-2"
                                        wire:model="destinationCity"
                                    >
                                        <option value="">شهر مقصد</option>
                                        @foreach ($destinationCities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-2 mb-0">
                                <input type="submit" value="جستجو" class="btn btn-secondary btn-lg btn-block text-uppercase text-2">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div class="row mb-4 properties-listing sort-destination p-0">
        @foreach ($cargos as $cargo)
            <div class="col-md-6 col-lg-6 p-3 isotope-item">
                <div class="listing-item">
                    <a href="#" class="text-decoration-none">
                        <div class="thumb-info thumb-info-lighten border" style="border: 1px solid rgba(0, 0, 0, 0.13) !important;">
                            {{-- <div class="thumb-info-wrapper m-0">
                                <img src="img/demos/real-estate/listings/listing-1.jpg" class="img-fluid" alt="">
                                <div
                                    class="thumb-info-listing-type bg-color-secondary text-uppercase text-color-light font-weight-semibold p-1 pl-3 pr-3">
                                    برای فروش
                                </div>
                            </div> --}}
                            <div class="thumb-info-price bg-color-primary text-color-light text-4 p-2 pl-4 pr-4 mb-2 d-flex justify-content-between">
                                مبدا : {{ $cargo->originProvince->name . ' - ' .  $cargo->originCity->name }}
                                <i class="icon-paper-plane icons mx-4"></i>
                            </div>
                            <div class="thumb-info-price bg-color-secondary text-color-light text-4 p-2 pl-4 pr-4 d-flex justify-content-between">
                                مقصد : {{ $cargo->destinationProvince->name . ' - ' .  $cargo->destinationCity->name }}
                                <i class="icon-drawer icons mx-4"></i>
                            </div>
                            <div class="custom-thumb-info-title b-normal p-4">
                                <div class="thumb-info-inner text-3">
                                    <p class="text-black">
                                        ماشین : {{ $cargo->carType->name }}
                                    </p>
                                    <p class="text-black">
                                        نوع باربر : {{ $cargo->loaderType->name }}
                                    </p>
                                </div>
                                <ul class="accommodations text-uppercase font-weight-bold p-0 mb-0 text-2">
                                    <li>
                                        <span class="accomodation-title">
                                            نوع:
                                        </span>
                                        <span class="accomodation-value custom-color-1">
                                            {{ $cargo->cargoType->name }}
                                        </span>
                                    </li>
                                    <li>
                                        <span class="accomodation-title">
                                            وزن:
                                        </span>
                                        <span class="accomodation-value custom-color-1">
                                            {{ number_format($cargo->weight) }}
                                        </span>
                                    </li>
                                    <li>
                                        <span class="accomodation-title">
                                            قیمت:
                                        </span>
                                        <span class="accomodation-value custom-color-1">
                                            {{ number_format($cargo->price) }}
                                        </span>
                                    </li>
                                </ul>
                                <div class="thumb-info-inner text-3 pt-3">
                                    <p class="text-black">
                                        توضیحات : {{ $cargo->description }}
                                    </p>
                                </div>
                            </div>
                            <div class="thumb-info-price bg-color-primary text-color-light text-4 p-2 pl-4 pr-4 d-flex justify-content-between" style="background-color: #ff8080 !important;">
                                <a
                                    href="tel:{{ $cargo->mobile }}"
                                    wire:click="makeOrder({{ $cargo->id }})"
                                >
                                    <span class="ltr-text text-white">{{ $cargo->mobile }}</span>
                                </a>
                                <i class="icon-phone icons mx-4"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    {{ $cargos->links() }}
</div>