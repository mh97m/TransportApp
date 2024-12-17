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
        $this->dispatch('update-body-class', 'bg-secondary');
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

<div class="container">
    <div class="row mt-4 mb-2 mb-lg-0">
        <div class="col-12">
            <div class="card-box">
                <div class="clearfix">
                    <h3 class="m-0 d-print-none">مشخصات بار</h3>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table mt-4 table-centered">
                                <tbody>
                                    <tr>
                                        <td>شناسه بار</td>
                                        <td>
                                            {{ $cargo->ulid }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>تعداد بازدید</td>
                                        <td>
                                            {{ $cargo->viewsCount }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>مبدا</td>
                                        <td>
                                            {{ $cargo->originProvince->title . ' - ' . $cargo->originCity->title }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>مقصد</td>
                                        <td>
                                            {{ $cargo->destinationProvince->title . ' - ' . $cargo->destinationCity->title }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>قیمت</td>
                                        <td>
                                            {{ number_format($cargo->price) }} تومان
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ماشین</td>
                                        <td>
                                            {{ $cargo->carType->title }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>نوع باربر</td>
                                        <td>
                                            {{ $cargo->loaderType->title }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>وزن</td>
                                        <td>
                                            {{ number_format($cargo->weight) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>توضیحات</td>
                                        <td>
                                            {{ $cargo->description }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="clearfix">
                    <h4 class="m-0 d-print-none">مشخصات راننده</h4>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="clearfix pt-3">
                                    <h4 class="text-muted">نام : {{ $cargo->orders->first()->driver->title }}</h4>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="clearfix pt-3">
                                    <p class="text-muted">شماره همراه : {{ $cargo->orders->first()->driver->mobile }}</p>
                                    <p class="text-muted">نوع ماشین : {{ $cargo->orders->first()->driver->details?->carType?->title }}</p>
                                    <p class="text-muted">نوع باربر : {{ $cargo->orders->first()->driver->details?->loaderType?->title }}</p>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="text-md-right">
                                    <p><b>زیرمجموع :</b> 42,540,450</p>
                                    <p><b>مالیات بر ارزش افزوده (12.5):</b> 8,540,450</p>
                                    <h3>49,540,450 تومان</h3>
                                </div>
                                <div class="clearfix"></div>
                            </div> --}}
                        </div>
                    
                        <div class="hidden-print mt-4">
                            <div class="text-right d-print-none">
                                @if ($cargo->orders->first()->owner_status == null)
                                    <a
                                        class="btn btn-success waves-effect waves-light text-white"
                                        style="cursor: pointer;"
                                        wire:click="changeOrderStatus({{ $cargo->orders->first()->id }}, true)"
                                    >
                                        {{-- <i class="fa fa-print mr-1"></i> --}}
                                        قبول درخواست
                                    </a>
                                    <a
                                        class="btn btn-danger waves-effect waves-light text-white"
                                        style="cursor: pointer;"
                                        wire:click="changeOrderStatus({{ $cargo->orders->first()->id }}, false)"
                                    >
                                        رد درخواست
                                    </a>
                                @else
                                    <div
                                        class="alert alert-success col-12 d-flex justify-content-center"
                                    >
                                        تایید شده است
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>