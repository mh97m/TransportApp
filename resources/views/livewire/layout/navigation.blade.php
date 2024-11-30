<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div x-data="{ open: false }" class="header-nav-features header-nav-features-no-border order-1 order-lg-2">
        @auth
            <div class="header-nav-feature header-nav-features-user d-inline-flex mx-2 pr-2">
                <a  @click="open = ! open" class="header-nav-features-toggle" style="color: white" href="#">
                    <i class="far fa-user"></i> {{ Auth::user()->name }}
                </a>
                <div :class="{'show': open, '': ! open }" class="header-nav-features-dropdown header-nav-features-dropdown-mobile-fixed header-nav-features-dropdown-force-right">
                    <div class="row">
                        <div class="col-8">
                            <p class="mb-0 pb-0 text-2 line-height-7">سلام</p>
                            <p><strong class="text-color-dark text-4">جان اسنو</strong></p>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-end">
                                {{-- <img class="rounded-circle" width="40" height="40" alt="" src="img/avatars/avatar.jpg"> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <ul class="nav nav-list-simple flex-column text-3">
                                <li class="nav-item"><a class="nav-link" href="/profile">پروفایل من</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">سفارشات من</a></li>
                                <li class="nav-item"><a class="nav-link" href="#" wire:click="logout">خروج</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="header-nav-feature header-nav-features-user d-inline-flex mx-2 pr-2">
                <a class="header-nav-features-toggle" style="color: white" href="/auth" wire:navigate>
                    <i class="far fa-user"></i> {{ __("Login") }}
                </a>
            </div>
        @endauth
</div>