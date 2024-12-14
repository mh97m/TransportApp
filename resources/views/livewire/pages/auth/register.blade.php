<?php

use App\Livewire\Forms\Auth\RegisterForm;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public RegisterForm $registerForm;

    /**
     * Handle an incoming registeration request.
     */
    public function register(): void
    {
        $this->validate([
            'registerForm.name' => ['required', 'string', 'max:255'],
            'registerForm.user_role' => ['required', 'string', 'in:1,2'],
            'registerForm.mobile' => ['required', 'string', 'regex:/^09\d{9}$/i', 'unique:' . User::class . ',mobile'],
            'registerForm.password' => ['required', 'string', 'confirmed', Rules\Password::min(4)],
        ]);

        $this->registerForm->registeration();

        $this->redirect(route('home', absolute: false), navigate: false);
    }
}; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card mb-0">
                <div class="card-body p-4">
                    <div class="account-box">
                        <div class="account-logo-box">
                            <div class="text-center">
                                <a href="index.html">
                                    <img src="assets/images/logo-dark.png" alt="" height="30">
                                </a>
                            </div>
                            <h5 class="text-uppercase mb-1 mt-4">{{ __('Register') }}</h5>
                            {{-- <p class="mb-0">ثبت نام کنید</p> --}}
                        </div>

                        <div class="account-content mt-4">
                            <form class="form-horizontal" wire:submit="login">
                                <div class="form-group row">
                                    <x-text-input
                                        :label="__('Mobile')"
                                        id="loginFormMobile"
                                        name="mobile"
                                        wire:model="loginForm.mobile"
                                        :errors="$errors->get('loginForm.mobile')"
                                        autocomplete="username"
                                    />
                                </div>

                                <div class="form-group row">
                                    <x-text-input
                                        :label="__('Name')"
                                        id="registerFormName"
                                        name="name"
                                        wire:model="registerForm.name"
                                        :errors="$errors->get('registerForm.name')"
                                        autocomplete="username"
                                    />
                                </div>

                                <div class="form-group row">
                                    <x-text-input
                                        :label="__('Password')"
                                        type="password"
                                        id="registerFormPassword"
                                        name="password"
                                        wire:model="registerForm.password"
                                        :errors="$errors->get('registerForm.password')"
                                        autocomplete="new-password"
                                    />
                                </div>

                                <div class="form-group row">
                                    <x-text-input
                                        :label="__('Confirm Password')"
                                        type="password"
                                        id="registerFormPasswordConfirmation"
                                        name="password_confirmation"
                                        wire:model="registerForm.password_confirmation"
                                        :errors="$errors->get('registerForm.password_confirmation')"
                                        autocomplete="new-password"
                                    />
                                </div>

                                <div class="form-group row">
                                    <div class="col-6">
                                        <div class="custom-control custom-checkbox pb-2">
                                            <input
                                                class="custom-control-input"
                                                type="radio"
                                                name="userRole"
                                                id="userRole1"
                                                value="1"
                                                wire:model="registerForm.user_role"
                                            />
                                            <label class="custom-control-label text-2" for="userRole1">
                                                راننده
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="custom-control custom-checkbox pb-2">
                                            <input
                                                class="custom-control-input"
                                                type="radio"
                                                name="userRole"
                                                id="userRole2"
                                                value="2"
                                                wire:model="registerForm.user_role"
                                            />
                                            <label class="custom-control-label text-2" for="userRole2">
                                                صاحب بار
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="form-group row">
                                    <div class="col-12">

                                        <div class="checkbox checkbox-success">
                                            <input id="remember" type="checkbox" checked="">
                                            <label for="remember">
                                                    من تمامی <a href="#"> قوانین و مقررات سایت را </a> میپذیرم
                                            </label>
                                        </div>

                                    </div>
                                </div> --}}
                                <div class="form-group row text-center mt-2">
                                    <x-button
                                        :label="__('Register')"
                                    />
                                </div>
                            </form>

                            <div class="row mt-4 pt-2">
                                <div class="col-sm-12 text-center">
                                    <p class="text-muted mb-0 ">حساب کاربری دارید؟ 
                                        <a href="{{ route('login') }}"class="text-dark ml-1">
                                            <b>ورود</b>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
