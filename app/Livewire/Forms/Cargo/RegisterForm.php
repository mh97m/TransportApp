<?php

namespace App\Livewire\Forms\Cargo;

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
        // 'exists:load_types',
    ])]
    public $loadType;

    #[Validate([
        'required',
        'integer',
    ])]
    public $loadWeight;

    #[Validate([
        'required',
        'integer',
    ])]
    public $loadPrice;


    public function register(): void
    {
        
    }
}
