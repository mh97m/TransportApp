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
        $this->originProvinces = Province::query()->orderBy('name', 'asc')->get();
        $this->destinationProvinces = $this->originProvinces;
    }

    public function with(): array
    {
        $query = Cargo::query();
        $query->whereNull('completed_at');

        if ($this->originProvince != '') {
            $query->where('origin_province_id', $this->originProvince);
        }
        if ($this->originCity != '') {
            $query->where('origin_city_id', $this->originCity);
        }
        if ($this->destinationProvince != '') {
            $query->where('destination_province_id', $this->destinationProvince);
        }
        if ($this->destinationCity != '') {
            $query->where('destination_city_id', $this->destinationCity);
        }

        $query->orderByDesc('created_at');

        $cargos = $query->with(['originProvince', 'destinationProvince', 'carType', 'loaderType'])->paginate(10);

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
                            <select class="form-control text-uppercase text-2" wire:model="originProvince">
                                <option value="">استان مبدا</option>
                                @foreach ($originProvinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-6 mb-2">
                        <div class="form-control-custom">
                            <select class="form-control text-uppercase text-2" wire:model="destinationProvince">
                                <option value="">استان مقصد</option>
                                @foreach ($destinationProvinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-12 mb-2">
                        <input type="submit" value="جستجو" class="btn btn-lg btn-block text-uppercase text-2"
                            style="background-color: #598bc4;">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-3">
        @foreach ($cargos as $cargo)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                <div class="card" style="border-radius: 10px; box-shadow: 0px 0px 7px rgba(0, 0, 0, 0.342);">
                    <div class="card-body text-center">
                        <!-- Origin and Destination Section -->
                        <div class="d-flex flex-column align-items-center position-relative mb-3">
                            <!-- Distance -->
                            <div class="text-center">
                                <div class="small text-muted my-1">{{ $cargo->distance }} کیلومتر</div>
                            </div>

                            <!-- Arrow Section -->
                            <div class="w-100 position-relative mb-3" style="height: 14px; width: 70% !important;">
                                <div class="position-absolute w-100 d-flex align-items-center">
                                    <!-- Circle at the Start of Arrow -->
                                    {{-- <div class="rounded-circle bg-secondary" style="width: 12px; height: 12px; margin-left: -1px;"></div> --}}
                                    <svg width="30" height="30" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="vuesax/bold/gps">
                                            <path id="Vector"
                                                d="M14.6673 7.49992H13.3073C13.0673 4.95992 11.0407 2.92659 8.50065 2.69325V1.33325C8.50065 1.05992 8.27398 0.833252 8.00065 0.833252C7.72732 0.833252 7.50065 1.05992 7.50065 1.33325V2.69325C4.96065 2.93325 2.92732 4.95992 2.69398 7.49992H1.33398C1.06065 7.49992 0.833984 7.72659 0.833984 7.99992C0.833984 8.27325 1.06065 8.49992 1.33398 8.49992H2.69398C2.93398 11.0399 4.96065 13.0733 7.50065 13.3066V14.6666C7.50065 14.9399 7.72732 15.1666 8.00065 15.1666C8.27398 15.1666 8.50065 14.9399 8.50065 14.6666V13.3066C11.0407 13.0666 13.074 11.0399 13.3073 8.49992H14.6673C14.9407 8.49992 15.1673 8.27325 15.1673 7.99992C15.1673 7.72659 14.9407 7.49992 14.6673 7.49992ZM8.00065 10.0799C6.85398 10.0799 5.92065 9.14659 5.92065 7.99992C5.92065 6.85325 6.85398 5.91992 8.00065 5.91992C9.14732 5.91992 10.0807 6.85325 10.0807 7.99992C10.0807 9.14659 9.14732 10.0799 8.00065 10.0799Z"
                                                fill="#484B52"></path>
                                        </g>
                                    </svg>
                                    <!-- Thick Arrow Line -->
                                    {{-- <div class="flex-grow-1 bg-secondary" style="height: 4px; position: relative; margin-top: 1px;"></div> --}}
                                    <svg width="100%" height="22" viewBox="0 0 133 8" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path id="Line 1"
                                            d="M0.646447 3.64645C0.451184 3.84171 0.451184 4.15829 0.646447 4.35355L3.82843 7.53553C4.02369 7.7308 4.34027 7.7308 4.53553 7.53553C4.7308 7.34027 4.7308 7.02369 4.53553 6.82843L1.70711 4L4.53553 1.17157C4.7308 0.976311 4.7308 0.659729 4.53553 0.464466C4.34027 0.269204 4.02369 0.269204 3.82843 0.464466L0.646447 3.64645ZM1 4.5L2 4.5L2 3.5L1 3.5L1 4.5ZM4 4.5L6 4.5L6 3.5L4 3.5L4 4.5ZM8 4.5L10 4.5L10 3.5L8 3.5L8 4.5ZM12 4.5L14 4.5L14 3.5L12 3.5L12 4.5ZM16 4.5L18 4.5L18 3.5L16 3.5L16 4.5ZM20 4.5L22 4.5L22 3.5L20 3.5L20 4.5ZM24 4.5L26 4.5L26 3.5L24 3.5L24 4.5ZM28 4.5L30 4.5L30 3.5L28 3.5L28 4.5ZM32 4.5L34 4.5L34 3.5L32 3.5L32 4.5ZM36 4.5L38 4.5L38 3.5L36 3.5L36 4.5ZM40 4.5L42 4.5L42 3.5L40 3.5L40 4.5ZM44 4.5L46 4.5L46 3.5L44 3.5L44 4.5ZM48 4.5L50 4.5L50 3.5L48 3.5L48 4.5ZM52 4.5L54 4.5L54 3.5L52 3.5L52 4.5ZM56 4.5L58 4.5L58 3.5L56 3.5L56 4.5ZM60 4.5L62 4.50001L62 3.50001L60 3.5L60 4.5ZM64 4.50001L66 4.50001L66 3.50001L64 3.50001L64 4.50001ZM68 4.50001L70 4.50001L70 3.50001L68 3.50001L68 4.50001ZM72 4.50001L74 4.50001L74 3.50001L72 3.50001L72 4.50001ZM76 4.50001L78 4.50001L78 3.50001L76 3.50001L76 4.50001ZM80 4.50001L82 4.50001L82 3.50001L80 3.50001L80 4.50001ZM84 4.50001L86 4.50001L86 3.50001L84 3.50001L84 4.50001ZM88 4.50001L90 4.50001L90 3.50001L88 3.50001L88 4.50001ZM92 4.50001L94 4.50001L94 3.50001L92 3.50001L92 4.50001ZM96 4.50001L98 4.50001L98 3.50001L96 3.50001L96 4.50001ZM100 4.50001L102 4.50001L102 3.50001L100 3.50001L100 4.50001ZM104 4.50001L106 4.50001L106 3.50001L104 3.50001L104 4.50001ZM108 4.50001L110 4.50001L110 3.50001L108 3.50001L108 4.50001ZM112 4.50001L114 4.50001L114 3.50001L112 3.50001L112 4.50001ZM116 4.50001L118 4.50001L118 3.50001L116 3.50001L116 4.50001ZM120 4.50001L122 4.50001L122 3.50001L120 3.50001L120 4.50001ZM124 4.50001L126 4.50001L126 3.50001L124 3.50001L124 4.50001ZM128 4.50001L130 4.50001L130 3.50001L128 3.50001L128 4.50001ZM132 4.50001L133 4.50001L133 3.50001L132 3.50001L132 4.50001Z"
                                            fill="#262626"></path>
                                    </svg>
                                    <!-- Arrowhead (styled as triangle) -->
                                    <svg width="30" height="30" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="Bold/location">
                                            <path id="Vector"
                                                d="M13.7467 5.63341C13.0467 2.55341 10.3601 1.16675 8.00006 1.16675C8.00006 1.16675 8.00006 1.16675 7.9934 1.16675C5.64006 1.16675 2.94673 2.54675 2.24673 5.62675C1.46673 9.06675 3.5734 11.9801 5.48006 13.8134C6.18673 14.4934 7.0934 14.8334 8.00006 14.8334C8.90673 14.8334 9.8134 14.4934 10.5134 13.8134C12.4201 11.9801 14.5267 9.07341 13.7467 5.63341ZM8.00006 8.97341C6.84006 8.97341 5.90006 8.03341 5.90006 6.87341C5.90006 5.71341 6.84006 4.77341 8.00006 4.77341C9.16006 4.77341 10.1001 5.71341 10.1001 6.87341C10.1001 8.03341 9.16006 8.97341 8.00006 8.97341Z"
                                                fill="#484B52"></path>
                                        </g>
                                    </svg>
                                    {{-- <div class="arrowhead" style="
                                    width: 0;
                                    height: 0;
                                    border-left: 8px solid transparent;
                                    border-right: 8px solid transparent;
                                    border-bottom: 14px solid #6c757d;
                                    transform: rotate(270deg);
                                    margin-right: -5px;">
                                </div> --}}
                                </div>
                            </div>


                            <!-- Origin and Destination Section -->
                            <div class="d-flex justify-content-between w-100 h4">
                                <!-- Origin -->
                                <div class="text-center" style="margin-right: 65px;">
                                    <i class="fas fa-map-marker-alt fa-lg text-danger mb-1"></i>
                                    <div class="small text-muted">مبدا</div>
                                </div>

                                <!-- Destination -->
                                <div class="text-center" style="margin-left: 65px;">
                                    <i class="fas fa-map-signs fa-lg text-success mb-1"></i>
                                    <div class="small text-muted">مقصد</div>
                                </div>
                            </div>
                            <div class="row col-12 d-flex justify-content-between w-100 h4">
                                <!-- Origin -->
                                <div class="col-4 text-center">
                                    <h5 class="font-weight-bold mb-0">{{ $cargo->originProvince->title }}</h5>
                                    <small class="text-muted">{{ $cargo->originCity->title }}</small>
                                </div>

                                <!-- Destination -->
                                <div class="col-4 text-center">
                                    <h5 class="font-weight-bold mb-0">{{ $cargo->destinationProvince->title }}</h5>
                                    <small class="text-muted">{{ $cargo->destinationCity->title }}</small>
                                </div>
                            </div>
                        </div>

                        <!-- Arrow Below Origin and Destination -->
                        <div class="d-flex justify-content-center align-items-center my-4">
                            <div class="border-top border-primary" style="width: 100%;"></div>
                        </div>

                        <!-- Additional Info: ماشین and باربر in One Line -->
                        <div class="text-muted mt-3">
                            {{-- <p class="mb-2 d-flex justify-content-center">
                            <span class="pr-3"><i class="fas fa-truck fa-lg"></i> <strong>ماشین:</strong> {{ $cargo->carType->title }}</span>
                            <span class="pl-3"><i class="fas fa-box fa-lg"></i> <strong>باربر:</strong> {{ $cargo->loaderType->title }}</span>
                        </p> --}}
                            <p class="mb-2 pt-2 h4 d-flex justify-content-start align-items-center">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="mr-2">
                                    <g clip-path="url(#clip0_6076_7847)">
                                        <path opacity="0.965" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M23.9766 20.0396C23.9766 20.4076 23.9766 20.7756 23.9766 21.1436C23.6647 22.3274 22.9126 23.0714 21.7206 23.3756C18.4738 23.431 15.2258 23.455 11.9766 23.4476C8.7273 23.455 5.47933 23.431 2.23256 23.3756C1.04047 23.0714 0.288474 22.3274 -0.0234375 21.1436C-0.0234375 20.7756 -0.0234375 20.4076 -0.0234375 20.0396C0.982671 16.0952 1.98267 12.1432 2.97656 8.18357C3.33853 7.11759 4.06653 6.4536 5.16056 6.19157C6.47144 6.132 7.78343 6.10004 9.09656 6.09557C8.27178 4.84484 8.21581 3.55685 8.92856 2.23157C9.93027 0.766765 11.2983 0.246767 13.0326 0.671572C14.6053 1.24766 15.4373 2.37566 15.5286 4.05557C15.5199 4.80941 15.296 5.48938 14.8566 6.09557C16.0245 6.11156 17.1926 6.12759 18.3606 6.14357C19.6438 6.24336 20.5158 6.89136 20.9766 8.08757C21.9705 12.0794 22.9705 16.0634 23.9766 20.0396ZM11.5926 1.99157C12.8381 1.8976 13.6461 2.4416 14.0166 3.62357C14.1485 4.88866 13.6125 5.71268 12.4086 6.09557C11.1446 6.228 10.3207 5.69204 9.93656 4.48757C9.8073 3.19211 10.3593 2.36011 11.5926 1.99157ZM5.44856 7.60757C9.81661 7.59956 14.1846 7.60757 18.5526 7.63157C19.1046 7.79957 19.4646 8.15957 19.6326 8.71157C20.585 12.5694 21.545 16.4254 22.5126 20.2796C22.6126 21.112 22.2686 21.664 21.4806 21.9356C15.1446 21.9676 8.80856 21.9676 2.47256 21.9356C1.68453 21.664 1.34054 21.112 1.44056 20.2796C2.41656 16.4076 3.39256 12.5356 4.36856 8.66357C4.53442 8.10562 4.8944 7.75364 5.44856 7.60757Z"
                                            fill="#00B198"></path>
                                        <path opacity="0.967" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M9.19202 11.544C11.0481 11.536 12.9041 11.544 14.76 11.568C15.3199 11.8001 15.4719 12.192 15.216 12.744C15.1261 12.8501 15.0221 12.938 14.904 13.008C14.2513 13.0695 13.5953 13.1014 12.936 13.104C12.848 13.128 12.792 13.184 12.768 13.272C12.752 15 12.736 16.728 12.72 18.456C12.5232 18.9638 12.1632 19.1318 11.64 18.96C11.4328 18.8489 11.2968 18.6809 11.232 18.456C11.216 16.728 11.2 15 11.184 13.272C11.16 13.184 11.104 13.128 11.016 13.104C10.408 13.088 9.80004 13.072 9.19202 13.056C8.72777 12.8877 8.54378 12.5597 8.64002 12.072C8.757 11.8189 8.94103 11.6429 9.19202 11.544Z"
                                            fill="#00B198"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_6076_7847">
                                            <rect width="24" height="24" fill="white"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                                {{ $cargo->weight }} تن
                            </p>
                            <p class="mb-2 pt-2 h4 d-flex justify-content-start align-items-center">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="mr-2">
                                    <g id="group">
                                        <path id="Vector"
                                            d="M15 2V12C15 13.1 14.1 14 13 14H2V6C2 3.79 3.79 2 6 2H15Z"
                                            stroke="#00B198" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path id="Vector_2"
                                            d="M22 14V17C22 18.66 20.66 20 19 20H18C18 18.9 17.1 18 16 18C14.9 18 14 18.9 14 20H10C10 18.9 9.1 18 8 18C6.9 18 6 18.9 6 20H5C3.34 20 2 18.66 2 17V14H13C14.1 14 15 13.1 15 12V5H16.84C17.56 5 18.22 5.39001 18.58 6.01001L20.29 9H19C18.45 9 18 9.45 18 10V13C18 13.55 18.45 14 19 14H22Z"
                                            stroke="#00B198" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path id="Vector_3"
                                            d="M8 22C9.10457 22 10 21.1046 10 20C10 18.8954 9.10457 18 8 18C6.89543 18 6 18.8954 6 20C6 21.1046 6.89543 22 8 22Z"
                                            stroke="#00B198" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path id="Vector_4"
                                            d="M16 22C17.1046 22 18 21.1046 18 20C18 18.8954 17.1046 18 16 18C14.8954 18 14 18.8954 14 20C14 21.1046 14.8954 22 16 22Z"
                                            stroke="#00B198" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path id="Vector_5"
                                            d="M22 12V14H19C18.45 14 18 13.55 18 13V10C18 9.45 18.45 9 19 9H20.29L22 12Z"
                                            stroke="#00B198" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                                {{ $cargo->carType->title }} {{ $cargo->loaderType->title }}
                            </p>
                            <p class="mb-2 pt-2 h4 d-flex justify-content-start align-items-center">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="mr-2">
                                    <path
                                        d="M11.9991 13.2999C11.8691 13.2999 11.7391 13.2699 11.6191 13.1999L2.78911 8.08986C2.43911 7.87986 2.30911 7.41986 2.51911 7.05986C2.72911 6.69986 3.18911 6.57986 3.54911 6.78986L11.9991 11.6799L20.3991 6.81986C20.7591 6.60986 21.2191 6.73986 21.4291 7.08986C21.6391 7.44986 21.5091 7.90986 21.1591 8.11986L12.3891 13.1999C12.2591 13.2599 12.1291 13.2999 11.9991 13.2999Z"
                                        fill="#00B198"></path>
                                    <path
                                        d="M12 22.36C11.59 22.36 11.25 22.02 11.25 21.61V12.54C11.25 12.13 11.59 11.79 12 11.79C12.41 11.79 12.75 12.13 12.75 12.54V21.61C12.75 22.02 12.41 22.36 12 22.36Z"
                                        fill="#00B198"></path>
                                    <path
                                        d="M12.0006 22.75C11.1206 22.75 10.2506 22.56 9.56063 22.18L4.22062 19.21C2.77062 18.41 1.64062 16.48 1.64062 14.82V9.17C1.64062 7.51 2.77062 5.59 4.22062 4.78L9.56063 1.82C10.9306 1.06 13.0706 1.06 14.4406 1.82L19.7806 4.79C21.2306 5.59 22.3606 7.52 22.3606 9.18V14.83C22.3606 16.49 21.2306 18.41 19.7806 19.22L14.4406 22.18C13.7506 22.56 12.8806 22.75 12.0006 22.75ZM12.0006 2.75C11.3706 2.75 10.7506 2.88 10.2906 3.13L4.95062 6.1C3.99062 6.63 3.14063 8.07 3.14063 9.17V14.82C3.14063 15.92 3.99062 17.36 4.95062 17.9L10.2906 20.87C11.2006 21.38 12.8006 21.38 13.7106 20.87L19.0506 17.9C20.0106 17.36 20.8606 15.93 20.8606 14.82V9.17C20.8606 8.07 20.0106 6.63 19.0506 6.09L13.7106 3.12C13.2506 2.88 12.6306 2.75 12.0006 2.75Z"
                                        fill="#00B198"></path>
                                </svg>
                                {{ $cargo->cargoType->title }}
                            </p>
                            <p class="mb-2 pt-2 h4 d-flex justify-content-start align-items-center text-left">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="mr-2">
                                    <path
                                        d="M16 22.75H8C4.98 22.75 3.25 21.02 3.25 18V8.25C3.25 5.1 4.85 3.5 8 3.5C8.41 3.5 8.75 3.84 8.75 4.25C8.75 4.65 8.91 5.03 9.19 5.31C9.47 5.59 9.85 5.75 10.25 5.75H13.75C14.58 5.75 15.25 5.08 15.25 4.25C15.25 3.84 15.59 3.5 16 3.5C19.15 3.5 20.75 5.1 20.75 8.25V18C20.75 21.02 19.02 22.75 16 22.75ZM7.34998 5.02C5.76998 5.15 4.75 5.86 4.75 8.25V18C4.75 20.22 5.78 21.25 8 21.25H16C18.22 21.25 19.25 20.22 19.25 18V8.25C19.25 5.86 18.23 5.16 16.65 5.02C16.31 6.3 15.14 7.25 13.75 7.25H10.25C9.45 7.25 8.70001 6.94 8.13 6.37C7.75 5.99 7.48998 5.53 7.34998 5.02Z"
                                        fill="#00B198"></path>
                                    <path
                                        d="M13.75 7.25H10.25C9.45 7.25 8.7 6.94 8.13 6.37C7.56 5.79999 7.25 5.05 7.25 4.25C7.25 2.6 8.6 1.25 10.25 1.25H13.75C14.55 1.25 15.3 1.56 15.87 2.13C16.44 2.7 16.75 3.45 16.75 4.25C16.75 5.9 15.4 7.25 13.75 7.25ZM10.25 2.75C9.42 2.75 8.75 3.42 8.75 4.25C8.75 4.65 8.91 5.03 9.19 5.31C9.47 5.59 9.85 5.75 10.25 5.75H13.75C14.58 5.75 15.25 5.08 15.25 4.25C15.25 3.85 15.09 3.47 14.81 3.19C14.53 2.91 14.15 2.75 13.75 2.75H10.25Z"
                                        fill="#00B198"></path>
                                    <path
                                        d="M12 13.75H8C7.59 13.75 7.25 13.41 7.25 13C7.25 12.59 7.59 12.25 8 12.25H12C12.41 12.25 12.75 12.59 12.75 13C12.75 13.41 12.41 13.75 12 13.75Z"
                                        fill="#00B198"></path>
                                    <path
                                        d="M16 17.75H8C7.59 17.75 7.25 17.41 7.25 17C7.25 16.59 7.59 16.25 8 16.25H16C16.41 16.25 16.75 16.59 16.75 17C16.75 17.41 16.41 17.75 16 17.75Z"
                                        fill="#00B198"></path>
                                </svg>
                                {{ $cargo->description }}
                            </p>
                        </div>

                        <!-- Price and Weight -->
                        <div class="row mt-4 text-center">
                            <div class="col-12">
                                <h4 class="text-black" style="font-size: 22px;">
                                    <i class="fas fa-coins text-success fa-lg h4"></i> {{ number_format($cargo->price) }} تومان
                                </h4>
                            </div>
                        </div>
                    </div>

                    <!-- Full-Width Footer Button -->
                    <div class="card-footer0 p-0">
                        <a href="tel:{{ $cargo->mobile }}" wire:click="makeOrder({{ $cargo->id }})"
                            class="btn btn-primary btn-lg btn-block text-white text-uppercase"
                            style="border-radius: 10px;border-top-left-radius: 0px;border-top-right-radius: 0px;background-color: #598bc4;">
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
