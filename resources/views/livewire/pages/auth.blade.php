<?php

use App\Models\User;
use App\Livewire\Forms\Auth\LoginForm;
use App\Livewire\Forms\Auth\RegisterForm;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component {
    public LoginForm $loginForm;
    public RegisterForm $registerForm;

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

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: false);
    }

    /**
     * Handle an incoming registeration request.
     */
    public function register(): void
    {
        $this->validate([
            'registerForm.name' => ['required', 'string', 'max:255'],
            'registerForm.mobile' => ['required', 'string', 'regex:/^09\d{9}$/i', 'unique:' . User::class . ',mobile'],
            'registerForm.password' => ['required', 'string', 'confirmed', Rules\Password::min(4)],
        ]);

        $this->registerForm->registeration();

        $this->redirect(route('dashboard', absolute: false), navigate: false);
    }
}; ?>

<div class="row">
    <div class="col">
        <x-session-status :message="session('status')" />
        <div class="featured-boxes">
            <div class="row">
                <div class="col-md-6">
                    <div class="featured-box featured-box-primary text-left mt-5">

                        <div class="box-content">
                            <h4 class="color-primary font-weight-semibold text-4 text-uppercase mb-3">
                                ورود
                            </h4>

                            <form wire:submit="login">
                                <div class="form-row">
                                    <x-text-input
                                        :label="__('Mobile')"
                                        id="loginFormMobile"
                                        name="mobile"
                                        wire:model="loginForm.mobile"
                                        :errors="$errors->get('loginForm.mobile')"
                                        autocomplete="username"
                                    />
                                </div>
                                <div class="form-row">
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
                                <div class="form-row">
                                    <div class="form-group col-lg-6">
                                        <x-checkbox-input
                                            wire:model="loginForm.remember"
                                        >
                                            {{ __('Remember me') }}
                                        </x-checkbox-input>
                                    </div>
                                    <x-button
                                        :label="__('Log in')"
                                    />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="featured-box featured-box-primary text-left mt-5">
                        <div class="box-content">
                            <h4 class="color-primary font-weight-semibold text-4 text-uppercase mb-3">
                                ثبت نام
                            </h4>
                            <form wire:submit="register">
                                <div class="form-row">
                                    <x-text-input
                                        :label="__('Mobile')"
                                        id="registerFormMobile"
                                        name="mobile"
                                        wire:model="registerForm.mobile"
                                        :errors="$errors->get('registerForm.mobile')"
                                        autocomplete="username"
                                    />
                                    <x-text-input
                                        :label="__('Name')"
                                        id="registerFormName"
                                        name="name"
                                        wire:model="registerForm.name"
                                        :errors="$errors->get('registerForm.name')"
                                        autocomplete="username"
                                    />
                                </div>
                                <div class="form-row">
                                    <x-text-input
                                        :label="__('Password')"
                                        type="password"
                                        id="registerFormPassword"
                                        name="password"
                                        wire:model="registerForm.password"
                                        :errors="$errors->get('registerForm.password')"
                                        autocomplete="new-password"
                                    />
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
                                <div class="form-row">
                                    <div class="form-group col-lg-9">
                                        <x-checkbox-input
                                            :label="__('Remember me')"
                                            wire:model="loginForm.remember"
                                        >
                                            من <a href="#">قوانین و مقررات</a> را خوانده و موافقم
                                        </x-checkbox-input>
                                    </div>
                                    <x-button
                                        :containerClass="__('form-group col-lg-3')"
                                        :label="__('Register')"
                                    />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
