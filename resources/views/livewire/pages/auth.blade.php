<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component {
    public LoginForm $form;

    // public string $name = '';
    // public string $email = '';
    // public string $password = '';
    // public string $password_confirmation = '';

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    // /**
    //  * Handle an incoming registration request.
    //  */
    // public function register(): void
    // {
    //     $validated = $this->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
    //         'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
    //     ]);

    //     $validated['password'] = Hash::make($validated['password']);

    //     event(new Registered(($user = User::create($validated))));

    //     Auth::login($user);

    //     $this->redirect(route('dashboard', absolute: false), navigate: true);
    // }
}; ?>

<div class="row">
    <div class="col">
        <div class="featured-boxes">
            <div class="row">
                <div class="col-md-6">
                    <div class="featured-box featured-box-primary text-left mt-5">
                        <div class="box-content">
                            {{-- <h4 class="color-primary font-weight-semibold text-4 text-uppercase mb-3">من مشتری ثابت شما هستم</h4> --}}

                            <x-session-status :message="session('status')" />

                            <form wire:submit="login">
                                <div class="form-row">
                                    <x-text-input
                                        :label="__('Mobile')"
                                        id="mobile"
                                        name="mobile"
                                        wire:model="form.mobile"
                                        :errors="$errors->get('form.mobile')"
                                        autocomplete="username"
                                    />
                                </div>
                                <div class="form-row">
                                    <x-text-input
                                        :label="__('Password')"
                                        type="password"
                                        id="password"
                                        name="password"
                                        wire:model="form.password"
                                        :errors="$errors->get('form.password')"
                                        autocomplete="current-password"
                                    >
                                        <a class="float-right" href="{{ route('password.request') }}" wire:navigate>
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    </x-text-input>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-6">
                                        <x-checkbox-input
                                            :label="__('Remember me')"
                                            wire:model="form.remember"
                                        />
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
                            <h4 class="color-primary font-weight-semibold text-4 text-uppercase mb-3">یک حساب ثبت کنید
                            </h4>
                            <form action="/" id="frmSignUp" method="post" class="needs-validation">
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label class="font-weight-bold text-dark text-2">آدرس ایمیل</label>
                                        <input type="text" value=""
                                            class="form-control form-control-lg text-left" dir="ltr" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-6">
                                        <label class="font-weight-bold text-dark text-2">رمز عبور</label>
                                        <input type="password" value=""
                                            class="form-control form-control-lg text-left" dir="ltr" required>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="font-weight-bold text-dark text-2">تکرار رمز عبور</label>
                                        <input type="password" value=""
                                            class="form-control form-control-lg text-left" dir="ltr" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-9">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="terms">
                                            <label class="custom-control-label text-2" for="terms">من <a
                                                    href="#">قوانین و مقررات</a> را خوانده و موافقم</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <input type="submit" value="ثبت نام"
                                            class="btn btn-primary btn-modern float-right"
                                            data-loading-text="در حال بارگذاری ...">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
