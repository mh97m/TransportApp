<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: false);
    }
}; ?>


<div class="navbar-custom">
    @auth
        <ul class="list-unstyled topnav-menu float-right mb-0">

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle  waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="dripicons-bell noti-icon"></i>
                    <span class="badge badge-pink rounded-circle noti-icon-badge">4</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-lg mt-1">

                    <div class="dropdown-header noti-title">
                        <h5 class="text-overflow m-0"><span class="float-right">
                            <span class="badge badge-danger float-right ffiy">5</span>
                            </span>نتیفیکیشن</h5>
                    </div>

                    <div class="slimscroll noti-scroll">

                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-success"><i class="mdi mdi-comment-account-outline"></i></div>
                            <p class="notify-details">محمد فلاح, مدیر جدید بخش طراحی<small class="text-muted">3 دقیقه پیش</small></p>
                        </a>

                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-primary">
                                <i class="mdi mdi-settings-outline"></i>
                            </div>
                            <p class="notify-details">تنظیمات جدید
                                <small class="text-muted">امکانات جدید در تنظیمات قابل دسترسی</small>
                            </p>
                        </a>

                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-warning">
                                <i class="mdi mdi-bell-outline"></i>
                            </div>
                            <p class="notify-details">آپدیت ها
                                <small class="text-muted">دو تا آپدیت جدید قابل دسترسی هست</small>
                            </p>
                        </a>

                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon">
                                {{-- <img src="assets/images/users/avatar-4.jpg" class="img-fluid rounded-circle" alt="" /> --}}
                            </div>
                            <p class="notify-details">امید حسین آبادی</p>
                            <p class="text-muted mb-0 user-msg">
                                <small>اووو ! این مدیر طراحی خوب و عالی به نظر می رسد</small>
                            </p>
                        </a>

                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-danger">
                                <i class="mdi mdi-account-plus"></i>
                            </div>
                            <p class="notify-details">کاربر جدید
                                <small class="text-muted">شما 10 پیام خوانده نشده دارید</small>
                            </p>
                        </a>

                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-info">
                                <i class="mdi mdi-comment-account-outline"></i>
                            </div>
                            <p class="notify-details">علی سهیلی در مورد مدیر نظر داد
                                <small class="text-muted">4 روز پیش</small>
                            </p>
                        </a>

                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-secondary">
                                <i class="mdi mdi-heart"></i>
                            </div>
                            <p class="notify-details">هومن شلیلوند لایک کرد
                                <b>مدیر</b>
                                <small class="text-muted">13 روز پیش</small>
                            </p>
                        </a>
                    </div>

                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                        مشاهده همه
                        <i class="fi-arrow-right"></i>
                    </a>

                </div>
            </li>

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="/assets/images/users/user.jpg" alt="user-image" class="rounded-circle">
                    <span class="pro-user-name ml-1">
                        {{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown mt-1" style="width: 200px">
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">خوش آمدید !</h6>
                    </div>

                    <a href="{{ route('profile') }}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>پروفایل</span>
                    </a>

                    @hasrole('driver')
                        <a href="{{ route('orders.all') }}" class="dropdown-item notify-item">
                            <i class="fe-settings"></i>
                            <span>تاریخچه بار های من</span>
                        </a>
                    @else
                        <a href="{{ route('cargos.all') }}" class="dropdown-item notify-item">
                            <i class="fe-settings"></i>
                            <span>تاریخچه اعلام بار های من</span>
                        </a>
                    @endhasrole

                    <div class="dropdown-divider"></div>

                    <a href="javascript:void(0);" class="dropdown-item notify-item" wire:click="logout">
                        <i class="fe-log-out"></i>
                        <span>خروج</span>
                    </a>

                </div>
            </li>

            @hasanyrole('owner')
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle  waves-effect waves-light" href="{{ route('cargos.create') }}">
                        <button type="button" class="btn btn-secondary btn-rounded width-md waves-effect waves-light">اعلام بار</button>
                    </a>
                </li>
            @endhasanyrole

        </ul>
    @endauth

    {{-- <div class="logo-box">
        <a href="index.html" class="logo text-center">
            <span class="logo-lg">
                <img src="/assets/images/logo-light.png" alt="" height="25">
            </span>
            <span class="logo-sm">
                <img src="/assets/images/logo-sm.png" alt="" height="28">
            </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile waves-effect waves-light">
                <i class="fe-menu"></i>
            </button>
        </li>
    </ul> --}}
</div>
