<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;

new class extends Component {

}; ?>

<header id="header" class="header-transparent-dark-bottom-border"
    data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyChangeLogo': false, 'stickyStartAt': 53, 'stickySetTop': '-53px'}">
    <div class="header-body bg-color-primary border-color-dark border-top-0">
        <div class="header-top header-top-borders header-top-light-borders">
            <div class="container h-100">
                <div class="header-row h-100">
                    <div class="header-column justify-content-start">
                        <div class="header-row">
                            <nav class="header-nav-top">
                                <ul class="nav nav-pills">
                                    <li class="nav-item nav-item-borders py-2 d-none d-sm-inline-flex">
                                        <span class="pl-0"><i class="far fa-dot-circle text-4 text-color-light"
                                                style="top: 1px;"></i> تهران</span>
                                    </li>
                                    <li class="nav-item nav-item-borders py-2">
                                        <a href="tel:123-456-7890"><i class="fab fa-whatsapp text-4 text-color-light"
                                                style="top: 0;"></i> <span class="ltr-text">09121234567</span></a>
                                    </li>
                                    <li class="nav-item nav-item-borders py-2 d-none d-md-inline-flex">
                                        <a href="mailto:transport@domain.com"><i
                                                class="far fa-envelope text-4 text-color-light" style="top: 1px;"></i>
                                            transport@domain.com</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-container header-container-height-sm container">
            <div class="header-row">
                <div class="header-column">
                    <div class="header-row">
                        <div class="header-logo">
                            <a href="demo-real-estate.html">
                                <img alt="Porto" width="80" height="80"
                                    src="/assets/img/demos/real-estate/logo-symbol-light.png">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="header-column justify-content-end">
                    {{-- <div class="header-row">
                        <div
                            class="header-nav header-nav-stripe header-nav-force-light-text header-nav-dropdowns-dark header-nav-no-space-dropdown order-2 order-lg-1">
                            <div
                                class="header-nav-main header-nav-main-mobile-dark header-nav-main-square header-nav-main-dropdown-no-borders header-nav-main-effect-2 header-nav-main-sub-effect-1">
                                <nav class="collapse">
                                    <ul class="nav nav-pills" id="mainNav">
                                        <li class="dropdown-full-color dropdown-quaternary">
                                            <a class="nav-link active" href="demo-real-estate.html">
                                                خانه
                                            </a>
                                        </li>
                                        <li class="dropdown-full-color dropdown-quaternary">
                                            <a class="nav-link" href="demo-real-estate-properties.html">
                                                ملک ها
                                            </a>
                                        </li>

                                        <li class="dropdown dropdown-full-color dropdown-quaternary">
                                            <a class="nav-link dropdown-toggle" href="demo-real-estate-who-we-are.html">
                                                درباره
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item"
                                                        href="demo-real-estate-agents.html">نمایندگان</a></li>
                                                <li><a class="dropdown-item" href="demo-real-estate-who-we-are.html">ما
                                                        چه کسی هستیم</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-full-color dropdown-quaternary">
                                            <a class="nav-link" href="demo-real-estate-contact.html">
                                                تماس
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <button class="btn header-btn-collapse-nav" data-toggle="collapse"
                                data-target=".header-nav-main nav">
                                <i class="fas fa-bars"></i>
                            </button>
                        </div>
                    </div> --}}
                </div>
                <div class="header-nav-features header-nav-features-no-border order-1 order-lg-2">
                    <div class="header-nav-feature header-nav-features-user d-inline-flex mx-2 pr-2 signin" id="headerAccount">
                        @auth
                            <a class="header-nav-features-toggle" style="color: white" href="/profile" wire:navigate>
                                <i class="far fa-user"></i> {{ Auth::user()->name }}
                            </a>
                        @else
                            <a class="header-nav-features-toggle" style="color: white" href="/auth" wire:navigate>
                                <i class="far fa-user"></i> {{ __("Login") }}
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
