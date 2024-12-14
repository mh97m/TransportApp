<?php

use App\Livewire\Forms\Auth\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $loginForm;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate([
            'loginForm.mobile' => 'required|string',
            'loginForm.password' => 'required|string',
            'loginForm.remember' => 'boolean',
        ]);

        $this->loginForm->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: false);
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
                            <h5 class="text-uppercase mb-1 mt-4">ورود</h5>
                            {{-- <p class="mb-0">وارد حساب خود شوید</p> --}}
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
                                        :label="__('Password')"
                                        type="password"
                                        id="loginFormPassword"
                                        name="password"
                                        wire:model="loginForm.password"
                                        :errors="$errors->get('loginForm.password')"
                                        autocomplete="current-password"
                                    >
                                        <a class="float-right" href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    </x-text-input>
                                </div>

                                <div class="form-group row">
                                    <x-checkbox-input
                                        wire:model="loginForm.remember"
                                        id="loginFormRemember"
                                        name="loginFormRemember"
                                        label="{{ __('Remember me') }}"
                                    />
                                </div>

                                <div class="form-group row text-center mt-2">
                                    <x-button
                                        :label="__('Log in')"
                                    />
                                </div>
                            </form>

                            <div class="row mt-4 pt-2">
                                <div class="col-sm-12 text-center">
                                    <p class="text-muted mb-0 ">حساب کاربری ندارید؟ 
                                        <a href="{{ route('register') }}"class="text-dark ml-1">
                                            <b>ثبت نام</b>
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
