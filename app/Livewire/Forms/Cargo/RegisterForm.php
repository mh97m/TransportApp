<?php

namespace App\Livewire\Forms\Cargo;

use App\Models\Cargo;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
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

    #[Validate([
        'required',
        'string',
        // 'exists:provinces',
    ])]
    public $originProvince;

    #[Validate([
        'required',
        'string',
        // 'exists:cities',
    ])]
    public $originCity;

    #[Validate([
        'required',
        'string',
        // 'exists:provinces',
    ])]
    public $destinationProvince;

    #[Validate([
        'required',
        'string',
        // 'exists:cities',
    ])]
    public $destinationCity;

    #[Validate([
        'required',
        'string',
        // 'exists:car_types',
    ])]
    public $carType;

    #[Validate([
        'required',
        'string',
        // 'exists:loader_types',
    ])]
    public $loaderType;

    #[Validate([
        'required',
        'string',
        // 'exists:cargo_types',
    ])]
    public $cargoType;

    #[Validate([
        'required',
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
        Cargo::create([
            'mobile' => $this->mobile,

            'origin_province_id' => $this->originProvince,
            'origin_city_id' => $this->originCity,

            'destination_province_id' => $this->destinationProvince,
            'destination_city_id' => $this->destinationCity,

            'car_type_id' => $this->carType,
            'loader_type_id' => $this->loaderType,

            'cargo_type_id' => $this->cargoType,

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
