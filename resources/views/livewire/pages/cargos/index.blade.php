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

    public $cargo;

    public function mount(Cargo $cargo)
    {
        abort_if(!$cargo->user()->is(auth()->user()), 404);
        $this->cargo = $cargo;
    }
}; ?>

<div>

    <div class="row pb-5 pt-3">
        <div class="col-lg-12">

            <div class="row">
                <div class="col-lg-12 mt-4 mt-lg-0">

                    <table class="table table-striped">
                        <colgroup>
                            <col width="35%">
                            <col width="65%">
                        </colgroup>
                        <tbody>
                            <tr>
                                <td class="bg-color-primary text-light align-middle">
                                    شناسه بار
                                </td>
                                <td class="text-4 font-weight-bold align-middle bg-color-primary text-light">
                                    {{ $cargo->id }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    مبدا
                                </td>
                                <td>{{ $cargo->originProvince->name . ' - ' .  $cargo->originCity->name }}</td>
                            </tr>
                            <tr>
                                <td>
                                    مقصد
                                </td>
                                <td>{{ $cargo->destinationProvince->name . ' - ' .  $cargo->destinationCity->name }}</td>
                            </tr>
                            <tr>
                                <td>
                                    شماره همراه
                                </td>
                                <td>
                                    {{ $cargo->mobile }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    شماره همراه
                                </td>
                                <td>
                                    {{ $cargo->mobile }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    قیمت
                                </td>
                                <td>
                                    {{ number_format($cargo->price) }} تومان
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    ماشین
                                </td>
                                <td>{{ $cargo->carType->name }}</td>
                            </tr>
                            <tr>
                                <td>
                                    نوع باربر
                                </td>
                                <td>{{ $cargo->loaderType->name }}</td>
                            </tr>
                            <tr>
                                <td>
                                    وزن
                                </td>
                                <td>
                                    {{ number_format($cargo->weight) }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    توضیحات
                                </td>
                                <td>
                                    {{ $cargo->description }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="row">
                <div class="col">

                    <h4 class="mt-4 mb-3">توافقات</h4>
                    @foreach ($cargo->orders as $order)
                        <div class="row agent-item">
                            <div class="col-lg-12">
                                <div class="row col-lg-12 d-flex justify-content-between">
                                    <h4 class="primary-font line-height-7 my-1">{{ $order->driver->name }}</h4>
                                    <span class="badge badge-success badge-md my-1">{{ $order->driver->status }}</span>
                                </div>
                                <div class="thumb-info-inner text-3">
                                    <p class="text-black">
                                        <strong>
                                            شماره همراه :
                                        </strong>
                                        {{ $order->driver->mobile }}
                                    </p>
                                    <p class="text-black">
                                        <strong>
                                            نوع باربر :
                                        </strong>
                                        {{ $order->driver->driver_details->carType }}
                                    </p>
                                </div>
                                <a class="btn btn-secondary btn-sm mt-2" href="#">مشاهده پروفایل</a>
                            </div>
                        </div>
                    @endforeach

                    <hr class="solid my-5">

                </div>
            </div>

        </div>
    </div>

</div>
