<?php

use App\Models\City;
use App\Models\CargoType;
use App\Models\CarType;
use App\Models\LoaderType;
use App\Models\Province;
use App\Models\User;
use App\Livewire\Forms\Cargo\RegisterForm;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component {
    public RegisterForm $form;

    public $originProvinces = [];
    public $originCities = [];

    public $destinationProvinces = [];
    public $destinationCities = [];

    public $carTypes = [];
    public $loaderTypes = [];

    public $cargoTypes = [];

    public function mount()
    {
        $this->form->mobile = Auth::user()->mobile;

        $this->originProvinces = Province::query()
            ->orderBy('name', 'asc')
            ->get();
        $this->destinationProvinces = $this->originProvinces;

        $this->carTypes = CarType::query()
            ->orderBy('name', 'asc')
            ->get();

        $this->cargoTypes = CargoType::query()
            ->orderBy('name', 'asc')
            ->get();
    }

    public function loadCities($type, $value): void
    {
        $this->form->{"{$type}City"} = '';
        $this->{"{$type}Cities"} = City::query()
            ->where('province_id', $value)
            ->orderBy('name', 'asc')
            ->get();
    }

    public function loadLoaderTypes($value): void
    {
        $this->form->loaderType = '';
        $this->loaderTypes = LoaderType::query()
            ->where('car_type_id', $value)
            ->orderBy('name', 'asc')
            ->get();
    }

    /**
     * Handle an incoming registeration request.
     */
    public function register(): void
    {
        $this->validate();

        $this->form->register();

        $this->redirect(route('cargos/all', absolute: false), navigate: true);
    }
}; ?>

<div class="row">
    <div class="col-lg-12 order-1 order-lg-2">
        
        <div class="mb-1">
            <h2 class="font-weight-normal text-7 mb-0">اعلام <strong class="font-weight-extra-bold">بار</strong></h2>
        </div>
        <div class="mb-4 pb-3">
            <p class="mb-0">لطفا مشخصات بار را وارد کنید</p>
        </div>

        <form wire:submit="register">
            <div class="form-group row">
                <x-text-input
                    :size="__('md')"
                    :lgLength="__('6')"
                    :label="__('Mobile')"
                    id="mobile"
                    name="mobile"
                    wire:model="form.mobile"
                    :errors="$errors->get('form.mobile')"
                    autocomplete="username"
                />
                <x-select-input
                    :size="__('md')"
                    :lgLength="__('6')"
                    :label="__('نوع بار')"
                    id="cargoType"
                    name="cargoType"
                    wire:model="form.cargoType"
                    :errors="$errors->get('form.cargoType')"
                    :options="$this->cargoTypes"
                />
            </div>

            <div class="form-group row">
                <x-select-input
                    :size="__('md')"
                    :lgLength="__('6')"
                    :label="__('استان مبدا')"
                    id="originProvince"
                    name="originProvince"
                    wire:change="loadCities('origin',$event.target.value)"
                    wire:model="form.originProvince"
                    :errors="$errors->get('form.originProvince')"
                    :options="$this->originProvinces"
                />
                <x-select-input
                    :size="__('md')"
                    :lgLength="__('6')"
                    :label="__('شهر مبدا')"
                    id="originCity"
                    name="originCity"
                    wire:model="form.originCity"
                    :errors="$errors->get('form.originCity')"
                    :options="$this->originCities"
                />
            </div>

            <div class="form-group row">
                <x-select-input
                    :size="__('md')"
                    :lgLength="__('6')"
                    :label="__('استان مقصد')"
                    id="destinationProvince"
                    name="destinationProvince"
                    wire:change="loadCities('destination',$event.target.value)"
                    wire:model="form.destinationProvince"
                    :errors="$errors->get('form.destinationProvince')"
                    :options="$this->destinationProvinces"
                />
                <x-select-input
                    :size="__('md')"
                    :lgLength="__('6')"
                    :label="__('شهر مقصد')"
                    id="destinationCity"
                    name="destinationCity"
                    wire:model="form.destinationCity"
                    :errors="$errors->get('form.destinationCity')"
                    :options="$this->destinationCities"
                />
            </div>

            <div class="form-group row">
                <x-select-input
                    :size="__('md')"
                    :lgLength="__('6')"
                    :label="__('نوع ماشین')"
                    id="carType"
                    name="carType"
                    wire:change="loadLoaderTypes($event.target.value)"
                    wire:model="form.carType"
                    :errors="$errors->get('form.carType')"
                    :options="$this->carTypes"
                />
                <x-select-input
                    :size="__('md')"
                    :lgLength="__('6')"
                    :label="__('نوع بارگیر')"
                    id="loaderType"
                    name="loaderType"
                    wire:model="form.loaderType"
                    :errors="$errors->get('form.loaderType')"
                    :options="$this->loaderTypes"
                />
            </div>

            {{-- <div class="form-row pb-3">
                <div class="col">
                    <x-checkbox-input
                        wire:model="loginForm.remember"
                    >
                        تناژ آزاد
                    </x-checkbox-input>
                </div>
            </div> --}}

            <div class="form-group row">
                <x-text-input
                    :size="__('md')"
                    :lgLength="__('6')"
                    :label="__('وزن (تن)')"
                    type="number"
                    id="weight"
                    name="weight"
                    wire:model="form.weight"
                    :errors="$errors->get('form.weight')"
                />
                <x-text-input
                    :size="__('md')"
                    :lgLength="__('6')"
                    :label="__('مبلغ')"
                    type="number"
                    id="price"
                    name="price"
                    wire:model="form.price"
                    :errors="$errors->get('form.price')"
                />
            </div>

            <div class="form-group row">
                <x-textarea-input
                    :size="__('md')"
                    :lgLength="__('12')"
                    :rows="__('6')"
                    :label="__('توضیحات')"
                    id="desc"
                    name="desc"
                    wire:model="form.desc"
                    :errors="$errors->get('form.desc')"
                />
            </div>

            <div class="form-group row mb-0">
                {{-- <div class="form-group col-lg-6"></div> --}}

                <x-button
                    :label="__('Save')"
                    :size="__('btn-block')"
                    :containerClass="__('form-group col-lg-12')"
                />
            </div>
        </form>

    </div>
</div>