<?php

use App\Models\Cargo;
use App\Models\City;
use App\Models\Order;
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

    public function changeOrderStatus($id, $is_accepted = false)
    {
        $order = Order::query()
            ->where([
                'id' => $id,
            ])
            ->first();

        abort_if(!$order?->cargo?->user()->is(auth()->user()), 404);

        $update_arr = [
            'changed_at' => now(),
        ];
        if ($is_accepted) {
            $update_arr['owner_status'] = true;
            $order->cargo()->update([
                'completed_at' => now(),
            ]);
        } else {
            $update_arr['owner_status'] = false;
        }
        $order?->update($update_arr);

        session()->flash('session-message', 'وضعیت با موفقیت ثبت شد.');
        session()->flash('session-title', ' عالیه');
        session()->flash('session-color', 'success');
    }
}; ?>

<div class="row pb-5 pt-3">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12 mt-4 mt-lg-0">
                <table class="table table-striped text-2">
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
                                {{ $cargo->ulid }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                تعداد بازدید
                            </td>
                            <td>
                                {{ $cargo->viewsCount }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                مبدا
                            </td>
                            <td>{{ $cargo->originProvince->title . ' - ' . $cargo->originCity->title }}</td>
                        </tr>
                        <tr>
                            <td>
                                مقصد
                            </td>
                            <td>{{ $cargo->destinationProvince->title . ' - ' . $cargo->destinationCity->title }}</td>
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
                            <td>{{ $cargo->carType->title }}</td>
                        </tr>
                        <tr>
                            <td>
                                نوع باربر
                            </td>
                            <td>{{ $cargo->loaderType->title }}</td>
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
                        <div class="col-lg-6">
                            <div class="row col-lg-12 d-flex justify-content-between">
                                <h4 class="primary-font line-height-7 my-1">نام : {{ $order->driver->title }}</h4>
                                <span class="badge badge-success badge-md my-1">{{ $order->driver->status }}</span>
                            </div>
                            <div class="thumb-info-inner text-4">
                                <p class="text-black">
                                    <strong>
                                        شماره همراه :
                                    </strong>
                                    {{ $order->driver->mobile }}
                                </p>
                                <p class="text-black">
                                    <strong>
                                        نوع ماشین :
                                    </strong>
                                    {{ $order->driver->details?->carType?->title }}
                                    -
                                    <strong>
                                        نوع باربر :
                                    </strong>
                                    {{ $order->driver->details?->loaderType?->title }}
                                </p>
                            </div>
                            <a class="btn btn-secondary btn-sm mt-2" href="#">مشاهده پروفایل</a>
                        </div>
                        <div class="col-lg-6 pt-4">
                            <div class="thumb-info-inner text-3">
                                <div
                                    class="alert alert-{{ $order->status->color }} col-12 d-flex justify-content-center"
                                >
                                    {{ $order->status->description }}
                                </div>
                            </div>
                            @if ($order->status->slug == 'agreed')
                                @if ($order->owner_status == null)
                                    <div class="col-12 d-flex justify-content-between">
                                        <button
                                            class="btn btn-success btn-sm mt-2 col-5"
                                            style="cursor: pointer;"
                                            wire:click="changeOrderStatus({{ $order->id }}, true)"
                                        >
                                            قبول درخواست
                                        </button>
                                        <button
                                            class="btn btn-danger btn-sm mt-2 col-5"
                                            style="cursor: pointer;"
                                            wire:click="changeOrderStatus({{ $order->id }}, false)"
                                        >
                                            رد درخواست
                                        </button>
                                    </div>
                                @else
                                    <div
                                        class="alert alert-{{ $order->status->color }} col-12 d-flex justify-content-center"
                                    >
                                        تایید شده است
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
                <hr class="solid my-5">
            </div>
        </div>
    </div>
</div>
