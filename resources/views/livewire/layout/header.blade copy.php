<?php

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
                            <a href="{{ route('home') }}">
                                <img alt="Porto" width="80" height="80"
                                    src="/assets/img/demos/real-estate/logo-symbol-light.png">
                            </a>
                        </div>
                    </div>
                </div>
                <livewire:layout.navigation />
            </div>
        </div>
    </div>
</header>
