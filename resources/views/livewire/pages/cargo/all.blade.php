<?php

use App\Models\City;
use App\Models\Province;
use Livewire\Volt\Component;

new class extends Component
{
    public $cargos;

    public function mount()
    {
        $this->cargos = [];
    }
}; ?>

<div>

    <x-slot name="header">
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
        <livewire:layout.search-bar :cargos="$cargos" />
    </x-slot>

    <div class="row mb-4 properties-listing sort-destination p-0">
        <div class="col-md-6 col-lg-4 p-3 isotope-item">
            <div class="listing-item">
                <a href="demo-real-estate-properties-detail.html" class="text-decoration-none">
                    <div class="thumb-info thumb-info-lighten border">
                        <div class="thumb-info-wrapper m-0">
                            <img src="img/demos/real-estate/listings/listing-1.jpg" class="img-fluid" alt="">
                            <div
                                class="thumb-info-listing-type bg-color-secondary text-uppercase text-color-light font-weight-semibold p-1 pl-3 pr-3">
                                برای فروش
                            </div>
                        </div>
                        <div class="thumb-info-price bg-color-primary text-color-light text-4 p-2 pl-4 pr-4">
                            530,000,000 تومان
                            <i class="fas fa-caret-right text-color-secondary float-right"></i>
                        </div>
                        <div class="custom-thumb-info-title b-normal p-4">
                            <div class="thumb-info-inner text-3">جنوب تبریز</div>
                            <ul class="accommodations text-uppercase font-weight-bold p-0 mb-0 text-2">
                                <li>
                                    <span class="accomodation-title">
                                        اتاق:
                                    </span>
                                    <span class="accomodation-value custom-color-1">
                                        3
                                    </span>
                                </li>
                                <li>
                                    <span class="accomodation-title">
                                        سرویس بهداشتی:
                                    </span>
                                    <span class="accomodation-value custom-color-1">
                                        2
                                    </span>
                                </li>
                                <li>
                                    <span class="accomodation-title">
                                        متراژ:
                                    </span>
                                    <span class="accomodation-value custom-color-1">
                                        500
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="row my-5">
        <div class="col">
            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-left"></i></a></li>
            </ul>
        </div>
    </div>

</div>