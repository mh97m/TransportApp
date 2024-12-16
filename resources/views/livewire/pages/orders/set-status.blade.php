<?php

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\City;
use App\Models\Province;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new #[Layout('layouts.app')] class extends Component {
    use WithPagination;

    public $order;
    public $orderStatuses;
    public $cargo;

    public function mount(Order $order)
    {
        $this->dispatch('update-body-class', 'bg-secondary');
        abort_if(!$order->driver()->is(auth()->user()), 404);
        $this->order = $order;
        $this->cargo = $order->cargo;
        $this->orderStatuses = OrderStatus::get();
    }

    public function changeOrderStatus($id)
    {
        $this->order->update([
            'order_status_id' => $id,
        ]);

        session()->forget('order_created');

        $this->dispatch('swal', [
            'title' => 'بار با موفقیت ثبت شد',
            // 'timer' => 3000,
            'type' => 'success',
            'confirmButtonText' => 'تایید',
            'redirectUrl' => '/cargos/list',
        ]);

        // return redirect()->route('cargos.list');
    }

    public function search(): void
    {
        $this->with();
    }
}; ?>

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-lg-12">
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
                            <i class="fe-arrow-down" style="color: #598bc4;"></i>
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

                    <div class="row pt-4">
                        @foreach ($orderStatuses as $orderStatus)
                            <div
                                class="alert alert-{{ $orderStatus->color }} col-12 d-flex justify-content-center"
                                style="cursor: pointer;"
                                wire:click="changeOrderStatus({{ $orderStatus->id }})"
                            >
                                {{ $orderStatus->description }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>