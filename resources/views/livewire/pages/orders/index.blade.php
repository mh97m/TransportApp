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

        session()->flash('session-message', 'وضعیت با موفقیت ثبت شد.');
        session()->flash('session-title', ' عالیه');
        session()->flash('session-color', 'success');

        return redirect()->route('cargos.list');
    }

    public function search(): void
    {
        $this->with();
    }
}; ?>

<div class="row pb-5 pt-3">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12 mt-4 mt-lg-0">
                <div class="col pb-3">
                    <h4>گزارش تماس با صاحب بار</h4>
                    <div class="row progress-bars my-4">
                        <div class="progress col-12 mb-2">
                            <span class="text-2">{{ $cargo->originProvince->name . ' - ' .  $cargo->originCity->name }}</span>
                            <div class="progress-bar progress-bar-primary progress-bar-striped progress-bar-animated active mx-1" style="width: 100%;"></div>
                            <span class="text-2">{{ $cargo->destinationProvince->name . ' - ' .  $cargo->destinationCity->name }}</span>
                        </div>
                    </div>
                    <div class="row pt-4">
                        @foreach ($orderStatuses as $orderStatus)
                            <div
                                class="alert alert-{{ $orderStatus->color }} col-12 d-flex justify-content-center" style="cursor: pointer;"
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