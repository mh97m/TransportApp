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
        $this->dispatch('update-body-class', 'bg-secondary');
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
    <div class="row mt-4 mb-2 mb-lg-0">
        <div class="col">
            <form wire:submit="search">
                <div class="form-row">
                    <div class="form-group col-lg-2 mb-0">
                        <div class="form-control-custom mb-3">
                            <select
                                class="form-control text-uppercase text-2"
                                wire:model="originProvince"
                                {{-- wire:change="loadCities('origin',$event.target.value)" --}}
                            >
                                <option value="">استان مبدا</option>
                                @foreach ($originProvinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- <div class="form-group col-lg-2 mb-0">
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
                    </div> --}}
                    <div class="form-group col-lg-2 mb-0">
                        <div class="form-control-custom mb-3">
                            <select
                                class="form-control text-uppercase text-2"
                                wire:model="destinationProvince"
                                {{-- wire:change="loadCities('destination',$event.target.value)" --}}
                            >
                                <option value="">استان مقصد</option>
                                @foreach ($destinationProvinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- <div class="form-group col-lg-2 mb-0">
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
                    </div> --}}
                    <div class="form-group col-lg-2 mb-0">
                        <input type="submit" value="جستجو" class="btn btn-lg btn-block text-uppercase text-2" style="background-color: #64c5b1;">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-3">
        @foreach ($cargos as $cargo)
            <div class="col-lg-4">
                <div class="text-center card-box border border-primary" style="border-radius: 8px;">
                    <div class="dropdown float-right">
                        <a href="#" class="dropdown-toggle card-drop arrow-none" data-toggle="dropdown" aria-expanded="false">
                            <div><i class="mdi mdi-dots-horizontal h3 m-0 text-muted"></i></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">گزارش تخلف</a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="member-card">
                        <div class="">
                            <h4 class="mb-1">مبدا : {{ $cargo->originProvince->name . ' - ' .  $cargo->originCity->name }}</h4>

                            <div class="h4 mt-2">
                                <i class="fe-arrow-down" style="color: #64c5b1;"></i>
                            </div>

                            <h4 class="mb-1">مقصد : {{ $cargo->destinationProvince->name . ' - ' .  $cargo->destinationCity->name }}</h4>
                            {{-- <p class="text-muted">بنیان گذار <span> | </span> <span> <a href="#" class="text-pink">websitename.com</a> </span></p> --}}
                        </div>

                        <p class="text-muted pt-4">
                            <b>ماشین</b> : {{ $cargo->carType->name }}
                            -
                            <b>باربر</b> : {{ $cargo->loaderType->name }}
                        </p>

                        <p class="text-muted pt-3">
                            <b>توضیحات</b> : {{ $cargo->description }}
                        </p>

                        <div class="mt-4">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mt-2 mb-1">
                                        <h4 class="mb-1">{{ number_format($cargo->price) }}</h4>
                                        <p class="mb-0 text-muted">قیمت</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mt-2">
                                        <h4 class="mb-1">{{ number_format($cargo->weight) }}</h4>
                                        <p class="mb-0 text-muted">وزن</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a
                            href="tel:{{ $cargo->mobile }}"
                            wire:click="makeOrder({{ $cargo->id }})"
                            type="button"
                            class="btn btn-outline-primary mt-3 btn-rounded btn-bordered waves-effect width-md waves-light ffiy"
                        >
                            تماس با صاحب بار
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