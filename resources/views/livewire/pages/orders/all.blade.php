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
        $this->dispatch('update-body-class', 'bg-secondary');
    }

    public function with(): array
    {
        $query = Auth::user()->driverOrders();

        $query->orderByDesc('created_at');

        $query->with([
        ]);

        return [
            'orders' => $query->paginate(10),
        ];
    }

    public function search(): void
    {
        $this->with();
    }
}; ?>

<div class="container-fluid">
    <div class="row mt-3">
        @foreach ($orders as $order)
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
                            <h4 class="mb-1">مبدا : {{ $order->cargo->originProvince->name . ' - ' .  $order->cargo->originCity->name }}</h4>

                            <div class="h4 mt-2">
                                <i class="fe-arrow-down" style="color: #598bc4;"></i>
                            </div>

                            <h4 class="mb-1">مقصد : {{ $order->cargo->destinationProvince->name . ' - ' .  $order->cargo->destinationCity->name }}</h4>
                            {{-- <p class="text-muted">بنیان گذار <span> | </span> <span> <a href="#" class="text-pink">websitename.com</a> </span></p> --}}
                        </div>

                        <p class="text-muted pt-4">
                            <b>ماشین</b> : {{ $order->cargo->carType->name }}
                            -
                            <b>باربر</b> : {{ $order->cargo->loaderType->name }}
                        </p>

                        <p class="text-muted pt-3">
                            <b>توضیحات</b> : {{ $order->cargo->description }}
                        </p>

                        <div class="mt-4">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mt-2 mb-1">
                                        <h4 class="mb-1">{{ number_format($order->cargo->price) }}</h4>
                                        <p class="mb-0 text-muted">قیمت</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mt-2">
                                        <h4 class="mb-1">{{ number_format($order->cargo->weight) }}</h4>
                                        <p class="mb-0 text-muted">وزن</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="alert alert-{{ $order->status->color }} col-12 d-flex justify-content-center mb-0"
                        >
                            {{ $order->status->description }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-12">
            {{ $orders->links() }}
        </div>
    </div>
</div>