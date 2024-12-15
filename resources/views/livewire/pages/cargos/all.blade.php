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

<div class="container-fluid">
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

                        <p class="text-muted pt-3">
                            <b>شماره همراه</b> : {{ $cargo->mobile }}
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
                            href="{{ route('cargos.index', ['cargo' => $cargo]) }}"
                            type="button"
                            class="btn btn-outline-primary mt-3 btn-rounded btn-bordered waves-effect width-md waves-light ffiy"
                        >
                            جزيیات بار
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