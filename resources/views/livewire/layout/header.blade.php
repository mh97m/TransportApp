<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {}; ?>

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
                                                style="top: 1px;"></i> فلکه دانشگاه، برج بلور، طبقه 456</span>
                                    </li>
                                    <li class="nav-item nav-item-borders py-2">
                                        <a href="tel:123-456-7890"><i class="fab fa-whatsapp text-4 text-color-light"
                                                style="top: 0;"></i> <span class="ltr-text">123 456 7890</span></a>
                                    </li>
                                    <li class="nav-item nav-item-borders py-2 d-none d-md-inline-flex">
                                        <a href="mailto:mail@domain.com"><i
                                                class="far fa-envelope text-4 text-color-light" style="top: 1px;"></i>
                                            mail@domain.com</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="header-column justify-content-end">
                        <div class="header-row">
                            <nav class="header-nav-top">
                                <ul class="nav nav-pills">
                                    <li class="nav-item nav-item-borders py-2 d-none d-lg-inline-flex">
                                        <a href="#">بلاگ</a>
                                    </li>
                                    <li class="nav-item nav-item-borders py-2 pr-0 dropdown">
                                        <a class="nav-link" href="#" role="button" id="dropdownLanguage"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="/assets/img/blank.gif" class="flag flag-ir" alt="Farsi"> فارسی
                                            <i class="fas fa-angle-down p-relative top-1"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownLanguage">
                                            <a class="dropdown-item" href="#"><img src="/assets/img/blank.gif"
                                                    class="flag flag-us" alt="English"> انگلیسی</a>
                                            <a class="dropdown-item" href="#"><img src="/assets/img/blank.gif"
                                                    class="flag flag-es" alt="English"> اسپانیایی</a>
                                            <a class="dropdown-item" href="#"><img src="/assets/img/blank.gif"
                                                    class="flag flag-fr" alt="English"> فرانسوی</a>
                                        </div>
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
                                <img alt="Porto" width="143" height="40"
                                    src="/assets/img/demos/real-estate/logo-real-estate.png">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="header-column justify-content-end">
                    <div class="header-row">
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
                                        <li class="dropdown dropdown-full-color dropdown-quaternary dropdown-mega"
                                            id="headerSearchProperties">
                                            <a class="nav-link dropdown-toggle" href="#">
                                                جستجو <i class="fas fa-search ml-2"></i>
                                            </a>
                                            <ul class="dropdown-menu custom-fullwidth-dropdown-menu ml-0">
                                                <li>
                                                    <div class="dropdown-mega-content mt-3 mt-lg-0">
                                                        <form id="propertiesFormHeader"
                                                            action="demo-real-estate-properties.html" method="POST">
                                                            <div class="container p-0">
                                                                <div class="form-row">
                                                                    <div class="form-group col-lg-2 mb-2 mb-lg-0">
                                                                        <div class="form-control-custom">
                                                                            <select
                                                                                class="form-control text-uppercase text-2"
                                                                                name="propertiesPropertyType"
                                                                                data-msg-required="وارد کردن این قسمت الزامی است."
                                                                                id="propertiesPropertyType"
                                                                                required="">
                                                                                <option value="">نوع ملک</option>
                                                                                <option value="1">آپارتمان
                                                                                </option>
                                                                                <option value="2">خانه</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-lg-2 mb-2 mb-lg-0">
                                                                        <div class="form-control-custom">
                                                                            <select
                                                                                class="form-control text-uppercase text-2"
                                                                                name="propertiesLocation"
                                                                                data-msg-required="وارد کردن این قسمت الزامی است."
                                                                                id="propertiesLocation"
                                                                                required="">
                                                                                <option value="">موقعیت</option>
                                                                                <option value="1">رشت</option>
                                                                                <option value="2">تبریز</option>
                                                                                <option value="3">تهران</option>
                                                                                <option value="4">اصفهان</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-lg-2 mb-2 mb-lg-0">
                                                                        <div class="form-control-custom">
                                                                            <select
                                                                                class="form-control text-uppercase text-2"
                                                                                name="propertiesMinBeds"
                                                                                data-msg-required="وارد کردن این قسمت الزامی است."
                                                                                id="propertiesMinBeds" required="">
                                                                                <option value="">اتاق خواب
                                                                                </option>
                                                                                <option value="1">1</option>
                                                                                <option value="2">2</option>
                                                                                <option value="3">3</option>
                                                                                <option value="4">4</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-lg-2 mb-2 mb-lg-0">
                                                                        <div class="form-control-custom">
                                                                            <select
                                                                                class="form-control text-uppercase text-2"
                                                                                name="propertiesMinPrice"
                                                                                data-msg-required="وارد کردن این قسمت الزامی است."
                                                                                id="propertiesMinPrice"
                                                                                required="">
                                                                                <option value="">حداقل قیمت
                                                                                </option>
                                                                                <option value="150000000">150,000,000
                                                                                    تومان</option>
                                                                                <option value="200000000">200,000,000
                                                                                    تومان</option>
                                                                                <option value="250000000">250,000,000
                                                                                    تومان</option>
                                                                                <option value="300000000">300,000,000
                                                                                    تومان</option>
                                                                                <option value="350000000">350,000,000
                                                                                    تومان</option>
                                                                                <option value="400000000">400,000,000
                                                                                    تومان</option>
                                                                                <option value="450000000">450,000,000
                                                                                    تومان</option>
                                                                                <option value="500000000">500,000,000
                                                                                    تومان</option>
                                                                                <option value="550000000">550,000,000
                                                                                    تومان</option>
                                                                                <option value="600000000">600,000,000
                                                                                    تومان</option>
                                                                                <option value="650000000">650,000,000
                                                                                    تومان</option>
                                                                                <option value="700000000">700,000,000
                                                                                    تومان</option>
                                                                                <option value="750000000">750,000,000
                                                                                    تومان</option>
                                                                                <option value="800000000">800,000,000
                                                                                    تومان</option>
                                                                                <option value="850000000">850,000,000
                                                                                    تومان</option>
                                                                                <option value="900000000">900,000,000
                                                                                    تومان</option>
                                                                                <option value="950000000">950,000,000
                                                                                    تومان</option>
                                                                                <option value="1000000000">
                                                                                    1,000,000,000 تومان</option>
                                                                                <option value="1250000000">
                                                                                    1,250,000,000 تومان</option>
                                                                                <option value="1500000000">
                                                                                    1,500,000,000 تومان</option>
                                                                                <option value="1750000000">
                                                                                    1,750,000,000 تومان</option>
                                                                                <option value="2000000000">
                                                                                    2,000,000,000 تومان</option>
                                                                                <option value="2250000000">
                                                                                    2,250,000,000 تومان</option>
                                                                                <option value="2500000000">
                                                                                    2,500,000,000 تومان</option>
                                                                                <option value="2750000000">
                                                                                    2,750,000,000 تومان</option>
                                                                                <option value="3000000000">
                                                                                    3,000,000,000 تومان</option>
                                                                                <option value="3250000000">
                                                                                    3,250,000,000 تومان</option>
                                                                                <option value="3500000000">
                                                                                    3,500,000,000 تومان</option>
                                                                                <option value="3750000000">
                                                                                    3,750,000,000 تومان</option>
                                                                                <option value="4000000000">
                                                                                    4,000,000,000 تومان</option>
                                                                                <option value="4250000000">
                                                                                    4,250,000,000 تومان</option>
                                                                                <option value="4500000000">
                                                                                    4,500,000,000 تومان</option>
                                                                                <option value="4750000000">
                                                                                    4,750,000,000 تومان</option>
                                                                                <option value="5000000000">
                                                                                    5,000,000,000 تومان</option>
                                                                                <option value="6000000000">
                                                                                    6,000,000,000 تومان</option>
                                                                                <option value="7000000000">
                                                                                    7,000,000,000 تومان</option>
                                                                                <option value="8000000000">
                                                                                    8,000,000,000 تومان</option>
                                                                                <option value="9000000000">
                                                                                    9,000,000,000 تومان</option>
                                                                                <option value="10000000000">
                                                                                    10,000,000,000 تومان</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-lg-2 mb-2 mb-lg-0">
                                                                        <div class="form-control-custom">
                                                                            <select
                                                                                class="form-control text-uppercase text-2"
                                                                                name="propertiesMaxPrice"
                                                                                data-msg-required="وارد کردن این قسمت الزامی است."
                                                                                id="propertiesMaxPrice"
                                                                                required="">
                                                                                <option value="">حداکثر قیمت
                                                                                </option>
                                                                                <option value="150000000">150,000,000
                                                                                    تومان</option>
                                                                                <option value="200000000">200,000,000
                                                                                    تومان</option>
                                                                                <option value="250000000">250,000,000
                                                                                    تومان</option>
                                                                                <option value="300000000">300,000,000
                                                                                    تومان</option>
                                                                                <option value="350000000">350,000,000
                                                                                    تومان</option>
                                                                                <option value="400000000">400,000,000
                                                                                    تومان</option>
                                                                                <option value="450000000">450,000,000
                                                                                    تومان</option>
                                                                                <option value="500000000">500,000,000
                                                                                    تومان</option>
                                                                                <option value="550000000">550,000,000
                                                                                    تومان</option>
                                                                                <option value="600000000">600,000,000
                                                                                    تومان</option>
                                                                                <option value="650000000">650,000,000
                                                                                    تومان</option>
                                                                                <option value="700000000">700,000,000
                                                                                    تومان</option>
                                                                                <option value="750000000">750,000,000
                                                                                    تومان</option>
                                                                                <option value="800000000">800,000,000
                                                                                    تومان</option>
                                                                                <option value="850000000">850,000,000
                                                                                    تومان</option>
                                                                                <option value="900000000">900,000,000
                                                                                    تومان</option>
                                                                                <option value="950000000">950,000,000
                                                                                    تومان</option>
                                                                                <option value="1000000000">
                                                                                    1,000,000,000 تومان</option>
                                                                                <option value="1250000000">
                                                                                    1,250,000,000 تومان</option>
                                                                                <option value="1500000000">
                                                                                    1,500,000,000 تومان</option>
                                                                                <option value="1750000000">
                                                                                    1,750,000,000 تومان</option>
                                                                                <option value="2000000000">
                                                                                    2,000,000,000 تومان</option>
                                                                                <option value="2250000000">
                                                                                    2,250,000,000 تومان</option>
                                                                                <option value="2500000000">
                                                                                    2,500,000,000 تومان</option>
                                                                                <option value="2750000000">
                                                                                    2,750,000,000 تومان</option>
                                                                                <option value="3000000000">
                                                                                    3,000,000,000 تومان</option>
                                                                                <option value="3250000000">
                                                                                    3,250,000,000 تومان</option>
                                                                                <option value="3500000000">
                                                                                    3,500,000,000 تومان</option>
                                                                                <option value="3750000000">
                                                                                    3,750,000,000 تومان</option>
                                                                                <option value="4000000000">
                                                                                    4,000,000,000 تومان</option>
                                                                                <option value="4250000000">
                                                                                    4,250,000,000 تومان</option>
                                                                                <option value="4500000000">
                                                                                    4,500,000,000 تومان</option>
                                                                                <option value="4750000000">
                                                                                    4,750,000,000 تومان</option>
                                                                                <option value="5000000000">
                                                                                    5,000,000,000 تومان</option>
                                                                                <option value="6000000000">
                                                                                    6,000,000,000 تومان</option>
                                                                                <option value="7000000000">
                                                                                    7,000,000,000 تومان</option>
                                                                                <option value="8000000000">
                                                                                    8,000,000,000 تومان</option>
                                                                                <option value="9000000000">
                                                                                    9,000,000,000 تومان</option>
                                                                                <option value="10000000000">
                                                                                    10,000,000,000 تومان</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-lg-2 mb-2 mb-lg-0">
                                                                        <input type="submit" value="جستجو"
                                                                            class="btn btn-secondary btn-lg btn-block text-uppercase text-2">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <button class="btn header-btn-collapse-nav" data-toggle="collapse"
                                data-target=".header-nav-main nav">
                                <i class="fas fa-bars"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
