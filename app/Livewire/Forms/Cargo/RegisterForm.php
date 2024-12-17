<?php

namespace App\Livewire\Forms\Cargo;

use App\Models\Cargo;
use App\Models\City;
use App\Services\LocationServiceFacade;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;

class RegisterForm extends Form
{
    #[Validate([
        'required',
        'string',
        'regex:/^09\d{9}$/i',
    ])]
    public string $mobile = '';

    // #[Validate([
    //     'required',
    //     'string',
    //     // 'exists:provinces',
    // ])]
    // public $originProvince;

    #[Validate([
        'required',
        'string',
        // 'exists:cities',
    ])]
    public $originCityId;

    // #[Validate([
    //     'required',
    //     'string',
    //     // 'exists:provinces',
    // ])]
    // public $destinationProvince;

    #[Validate([
        'required',
        'string',
        // 'exists:cities',
    ])]
    public $destinationCityId;

    #[Validate([
        'required',
        'string',
        // 'exists:car_types',
    ])]
    public $carTypeId;

    #[Validate([
        'required',
        'string',
        // 'exists:loader_types',
    ])]
    public $loaderTypeId;

    #[Validate([
        'required',
        'string',
        // 'exists:cargo_types',
    ])]
    public $cargoTypeId;

    #[Validate([
        // 'required',
        'integer',
    ])]
    public $weight;

    #[Validate([
        'required',
        'integer',
    ])]
    public $price;

    #[Validate([
        'required',
        'string',
    ])]
    public $description;


    public function register(): void
    {
        $originCity = City::where('id', $this->originCityId)->first();
        $destinationCity = City::where('id', $this->destinationCityId)->first();

        Cargo::create([
            'mobile' => $this->mobile,

            'origin_province_id' => $originCity?->province_id,
            'origin_city_id' => $this->originCityId,

            'destination_province_id' => $destinationCity?->province_id,
            'destination_city_id' => $this->destinationCityId,

            'distance' => LocationServiceFacade::getDistance(
                $originCity,
                $destinationCity,
            ),

            'car_type_id' => $this->carTypeId,
            'loader_type_id' => $this->loaderTypeId,

            'cargo_type_id' => $this->cargoTypeId,

            'weight' => $this->weight,

            'price' => $this->price,

            'description' => $this->description,

            'user_id' => Auth::user()->id,
        ]);

        session()->flash('session-message', 'بار با موفقیت ثبت شد.');
        session()->flash('session-title', ' عالیه');
        session()->flash('session-color', 'success');
    }
}
