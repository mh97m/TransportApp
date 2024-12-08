<?php

use App\Models\Cargo;
use App\Models\City;
use App\Models\Province;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new #[Layout('layouts.app')] class extends Component {
    use WithPagination;

    public function mount()
    {
    }

    public function with(): array
    {
        $query = Auth::user()->cargos();

        $query->orderByDesc('created_at');

        $query->with([
            'originProvince',
            'destinationProvince',
            'carType',
            'loaderType',
            'orders',
        ]);

        return [
            'cargos' => $query->paginate(10),
        ];
    }

    public function loadCities($type, $value): void
    {
        $this->{"{$type}City"} = '';
        $this->{"{$type}Cities"} = City::query()
            ->where('province_id', $value)
            ->orderBy('name', 'asc')
            ->get();
    }

    public function search(): void
    {
        $this->with();
    }
}; ?>

<div>
    <div class="row mb-4 properties-listing sort-destination p-0">
        @foreach ($cargos as $cargo)
            <div class="col-md-12 col-lg-12 p-3 isotope-item">
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
                                        <strong>
                                            ماشین :
                                        </strong>
                                        {{ $cargo->carType->name }}
                                    </p>
                                    <p class="text-black">
                                        <strong>
                                            نوع باربر :
                                        </strong>
                                        {{ $cargo->loaderType->name }}
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
                                            {{ number_format($cargo->price) }} تومان
                                        </span>
                                    </li>
                                </ul>
                                <div class="thumb-info-inner text-3 pt-3">
                                    <p class="text-black">
                                        <strong class="accomodation-title">
                                            توضیحات :
                                        </strong>
                                        {{ $cargo->description }}
                                    </p>
                                </div>
                                <div class="thumb-info-inner text-3 pt-3">
                                    <p class="text-black">
                                        <strong class="accomodation-title">
                                            شماره همراه :
                                        </strong>
                                        {{ $cargo->mobile }}
                                    </p>
                                </div>
                            </div>
                            <div class="thumb-info-price bg-color-primary text-color-light text-4 p-2 pl-4 pr-4 d-flex justify-content-between" style="background-color: #333b487e !important;">
                                <a href="{{ route('cargos.index', ['cargo' => $cargo]) }}">
                                    <span class="ltr-text text-white">
                                        جزيیات بار
                                    </span>
                                </a>
                                <i class="icon-layers icons mx-4"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    {{ $cargos->links() }}
</div>