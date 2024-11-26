<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-8 order-2 order-md-1 align-self-center p-static mt-md-n2">
                <h1 class="text-dark">ملک ها </h1><p class="lead mb-0">لیست ملک های فروشی و اجاره ای - 123 ملک</p>
            </div>
            <div class="col-md-4 order-1 order-md-2 align-self-center mb-1 mb-md-0">
                <ul class="breadcrumb d-block text-md-right">
                    <li><a href="demo-real-estate.html">خانه</a></li>
                    <li class="active">ملک ها</li>
                </ul>
            </div>
        </div>
        <div class="row mt-4 mb-2 mb-lg-0">
            <div class="col">
                <form id="propertiesForm" action="demo-real-estate-properties.html" method="POST">
                    <div class="form-row">
                        <div class="form-group col-lg-2 mb-0">
                            <div class="form-control-custom mb-3">
                                <select class="form-control text-uppercase text-2" name="propertiesPropertyType" data-msg-required="وارد کردن این قسمت الزامی است." id="propertiesPropertyType2" required="">
                                    <option value="">نوع ملک</option>
                                    <option value="1">آپارتمان</option>
                                    <option value="2">خانه</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-2 mb-0">
                            <div class="form-control-custom mb-3">
                                <select class="form-control text-uppercase text-2" name="propertiesLocation" data-msg-required="وارد کردن این قسمت الزامی است." id="propertiesLocation2" required="">
                                    <option value="">موقعیت</option>
                                    <option value="1">رشت</option>
                                    <option value="2">تبریز</option>
                                    <option value="3">تهران</option>
                                    <option value="4">اصفهان</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-2 mb-0">
                            <div class="form-control-custom mb-3">
                                <select class="form-control text-uppercase text-2" name="propertiesMinBeds" data-msg-required="وارد کردن این قسمت الزامی است." id="propertiesMinBeds2" required="">
                                    <option value="">اتاق خواب</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-2 mb-0">
                            <div class="form-control-custom mb-3">
                                <select class="form-control text-uppercase text-2" name="propertiesMinPrice" data-msg-required="وارد کردن این قسمت الزامی است." id="propertiesMinPrice2" required="">
                                    <option value="">حداقل قیمت</option>
                                    <option value="150000000">150,000,000 تومان</option>
                                    <option value="200000000">200,000,000 تومان</option>
                                    <option value="250000000">250,000,000 تومان</option>
                                    <option value="300000000">300,000,000 تومان</option>
                                    <option value="350000000">350,000,000 تومان</option>
                                    <option value="400000000">400,000,000 تومان</option>
                                    <option value="450000000">450,000,000 تومان</option>
                                    <option value="500000000">500,000,000 تومان</option>
                                    <option value="550000000">550,000,000 تومان</option>
                                    <option value="600000000">600,000,000 تومان</option>
                                    <option value="650000000">650,000,000 تومان</option>
                                    <option value="700000000">700,000,000 تومان</option>
                                    <option value="750000000">750,000,000 تومان</option>
                                    <option value="800000000">800,000,000 تومان</option>
                                    <option value="850000000">850,000,000 تومان</option>
                                    <option value="900000000">900,000,000 تومان</option>
                                    <option value="950000000">950,000,000 تومان</option>
                                    <option value="1000000000">1,000,000,000 تومان</option>
                                    <option value="1250000000">1,250,000,000 تومان</option>
                                    <option value="1500000000">1,500,000,000 تومان</option>
                                    <option value="1750000000">1,750,000,000 تومان</option>
                                    <option value="2000000000">2,000,000,000 تومان</option>
                                    <option value="2250000000">2,250,000,000 تومان</option>
                                    <option value="2500000000">2,500,000,000 تومان</option>
                                    <option value="2750000000">2,750,000,000 تومان</option>
                                    <option value="3000000000">3,000,000,000 تومان</option>
                                    <option value="3250000000">3,250,000,000 تومان</option>
                                    <option value="3500000000">3,500,000,000 تومان</option>
                                    <option value="3750000000">3,750,000,000 تومان</option>
                                    <option value="4000000000">4,000,000,000 تومان</option>
                                    <option value="4250000000">4,250,000,000 تومان</option>
                                    <option value="4500000000">4,500,000,000 تومان</option>
                                    <option value="4750000000">4,750,000,000 تومان</option>
                                    <option value="5000000000">5,000,000,000 تومان</option>
                                    <option value="6000000000">6,000,000,000 تومان</option>
                                    <option value="7000000000">7,000,000,000 تومان</option>
                                    <option value="8000000000">8,000,000,000 تومان</option>
                                    <option value="9000000000">9,000,000,000 تومان</option>
                                    <option value="10000000000">10,000,000,000 تومان</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-2 mb-0">
                            <div class="form-control-custom mb-3">
                                <select class="form-control text-uppercase text-2" name="propertiesMaxPrice" data-msg-required="وارد کردن این قسمت الزامی است." id="propertiesMaxPrice2" required="">
                                    <option value="">حداکثر قیمت</option>
                                    <option value="150000000">150,000,000 تومان</option>
                                    <option value="200000000">200,000,000 تومان</option>
                                    <option value="250000000">250,000,000 تومان</option>
                                    <option value="300000000">300,000,000 تومان</option>
                                    <option value="350000000">350,000,000 تومان</option>
                                    <option value="400000000">400,000,000 تومان</option>
                                    <option value="450000000">450,000,000 تومان</option>
                                    <option value="500000000">500,000,000 تومان</option>
                                    <option value="550000000">550,000,000 تومان</option>
                                    <option value="600000000">600,000,000 تومان</option>
                                    <option value="650000000">650,000,000 تومان</option>
                                    <option value="700000000">700,000,000 تومان</option>
                                    <option value="750000000">750,000,000 تومان</option>
                                    <option value="800000000">800,000,000 تومان</option>
                                    <option value="850000000">850,000,000 تومان</option>
                                    <option value="900000000">900,000,000 تومان</option>
                                    <option value="950000000">950,000,000 تومان</option>
                                    <option value="1000000000">1,000,000,000 تومان</option>
                                    <option value="1250000000">1,250,000,000 تومان</option>
                                    <option value="1500000000">1,500,000,000 تومان</option>
                                    <option value="1750000000">1,750,000,000 تومان</option>
                                    <option value="2000000000">2,000,000,000 تومان</option>
                                    <option value="2250000000">2,250,000,000 تومان</option>
                                    <option value="2500000000">2,500,000,000 تومان</option>
                                    <option value="2750000000">2,750,000,000 تومان</option>
                                    <option value="3000000000">3,000,000,000 تومان</option>
                                    <option value="3250000000">3,250,000,000 تومان</option>
                                    <option value="3500000000">3,500,000,000 تومان</option>
                                    <option value="3750000000">3,750,000,000 تومان</option>
                                    <option value="4000000000">4,000,000,000 تومان</option>
                                    <option value="4250000000">4,250,000,000 تومان</option>
                                    <option value="4500000000">4,500,000,000 تومان</option>
                                    <option value="4750000000">4,750,000,000 تومان</option>
                                    <option value="5000000000">5,000,000,000 تومان</option>
                                    <option value="6000000000">6,000,000,000 تومان</option>
                                    <option value="7000000000">7,000,000,000 تومان</option>
                                    <option value="8000000000">8,000,000,000 تومان</option>
                                    <option value="9000000000">9,000,000,000 تومان</option>
                                    <option value="10000000000">10,000,000,000 تومان</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-2 mb-0">
                            <input type="submit" value="جستجو" class="btn btn-secondary btn-lg btn-block text-uppercase text-2">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="row mb-4 properties-listing sort-destination p-0">
        <div class="col-md-6 col-lg-4 p-3 isotope-item">
            <div class="listing-item">
                <a href="demo-real-estate-properties-detail.html" class="text-decoration-none">
                    <div class="thumb-info thumb-info-lighten border">
                        <div class="thumb-info-wrapper m-0">
                            <img src="img/demos/real-estate/listings/listing-1.jpg" class="img-fluid" alt="">
                            <div
                                class="thumb-info-listing-type bg-color-secondary text-uppercase text-color-light font-weight-semibold p-1 pl-3 pr-3">
                                برای فروش
                            </div>
                        </div>
                        <div class="thumb-info-price bg-color-primary text-color-light text-4 p-2 pl-4 pr-4">
                            530,000,000 تومان
                            <i class="fas fa-caret-right text-color-secondary float-right"></i>
                        </div>
                        <div class="custom-thumb-info-title b-normal p-4">
                            <div class="thumb-info-inner text-3">جنوب تبریز</div>
                            <ul class="accommodations text-uppercase font-weight-bold p-0 mb-0 text-2">
                                <li>
                                    <span class="accomodation-title">
                                        اتاق:
                                    </span>
                                    <span class="accomodation-value custom-color-1">
                                        3
                                    </span>
                                </li>
                                <li>
                                    <span class="accomodation-title">
                                        سرویس بهداشتی:
                                    </span>
                                    <span class="accomodation-value custom-color-1">
                                        2
                                    </span>
                                </li>
                                <li>
                                    <span class="accomodation-title">
                                        متراژ:
                                    </span>
                                    <span class="accomodation-value custom-color-1">
                                        500
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 p-3 isotope-item">
            <div class="listing-item">
                <a href="demo-real-estate-properties-detail.html" class="text-decoration-none">
                    <div class="thumb-info thumb-info-lighten border">
                        <div class="thumb-info-wrapper m-0">
                            <img src="img/demos/real-estate/listings/listing-2.jpg" class="img-fluid" alt="">
                            <div
                                class="thumb-info-listing-type bg-color-secondary text-uppercase text-color-light font-weight-semibold p-1 pl-3 pr-3">
                                برای فروش
                            </div>
                        </div>
                        <div class="thumb-info-price bg-color-primary text-color-light text-4 p-2 pl-4 pr-4">
                            320,000,000 تومان
                            <i class="fas fa-caret-right text-color-secondary float-right"></i>
                        </div>
                        <div class="custom-thumb-info-title b-normal p-4">
                            <div class="thumb-info-inner text-3">شرق تهران</div>
                            <ul class="accommodations text-uppercase font-weight-bold p-0 mb-0 text-2">
                                <li>
                                    <span class="accomodation-title">
                                        اتاق:
                                    </span>
                                    <span class="accomodation-value custom-color-1">
                                        3
                                    </span>
                                </li>
                                <li>
                                    <span class="accomodation-title">
                                        سرویس بهداشتی:
                                    </span>
                                    <span class="accomodation-value custom-color-1">
                                        2
                                    </span>
                                </li>
                                <li>
                                    <span class="accomodation-title">
                                        متراژ:
                                    </span>
                                    <span class="accomodation-value custom-color-1">
                                        500
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 p-3 isotope-item">
            <div class="listing-item">
                <a href="demo-real-estate-properties-detail.html" class="text-decoration-none">
                    <div class="thumb-info thumb-info-lighten border">
                        <div class="thumb-info-wrapper m-0">
                            <img src="img/demos/real-estate/listings/listing-3.jpg" class="img-fluid" alt="">
                            <div
                                class="thumb-info-listing-type bg-color-secondary text-uppercase text-color-light font-weight-semibold p-1 pl-3 pr-3">
                                برای اجاره
                            </div>
                        </div>
                        <div class="thumb-info-price bg-color-primary text-color-light text-4 p-2 pl-4 pr-4">
                            300,000 تومان / ماهانه
                            <i class="fas fa-caret-right text-color-secondary float-right"></i>
                        </div>
                        <div class="custom-thumb-info-title b-normal p-4">
                            <div class="thumb-info-inner text-3">رشت</div>
                            <ul class="accommodations text-uppercase font-weight-bold p-0 mb-0 text-2">
                                <li>
                                    <span class="accomodation-title">
                                        اتاق:
                                    </span>
                                    <span class="accomodation-value custom-color-1">
                                        3
                                    </span>
                                </li>
                                <li>
                                    <span class="accomodation-title">
                                        سرویس بهداشتی:
                                    </span>
                                    <span class="accomodation-value custom-color-1">
                                        2
                                    </span>
                                </li>
                                <li>
                                    <span class="accomodation-title">
                                        متراژ:
                                    </span>
                                    <span class="accomodation-value custom-color-1">
                                        500
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 p-3 isotope-item">
            <div class="listing-item">
                <a href="demo-real-estate-properties-detail.html" class="text-decoration-none">
                    <div class="thumb-info thumb-info-lighten border">
                        <div class="thumb-info-wrapper m-0">
                            <img src="img/demos/real-estate/listings/listing-4.jpg" class="img-fluid" alt="">
                            <div
                                class="thumb-info-listing-type bg-color-secondary text-uppercase text-color-light font-weight-semibold p-1 pl-3 pr-3">
                                برای فروش
                            </div>
                        </div>
                        <div class="thumb-info-price bg-color-primary text-color-light text-4 p-2 pl-4 pr-4">
                            730,000,000 تومان
                            <i class="fas fa-caret-right text-color-secondary float-right"></i>
                        </div>
                        <div class="custom-thumb-info-title b-normal p-4">
                            <div class="thumb-info-inner text-3">تبریز، خیابان آبرسان</div>
                            <ul class="accommodations text-uppercase font-weight-bold p-0 mb-0 text-2">
                                <li>
                                    <span class="accomodation-title">
                                        اتاق:
                                    </span>
                                    <span class="accomodation-value custom-color-1">
                                        3
                                    </span>
                                </li>
                                <li>
                                    <span class="accomodation-title">
                                        سرویس بهداشتی:
                                    </span>
                                    <span class="accomodation-value custom-color-1">
                                        2
                                    </span>
                                </li>
                                <li>
                                    <span class="accomodation-title">
                                        متراژ:
                                    </span>
                                    <span class="accomodation-value custom-color-1">
                                        500
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 p-3 isotope-item">
            <div class="listing-item">
                <a href="demo-real-estate-properties-detail.html" class="text-decoration-none">
                    <div class="thumb-info thumb-info-lighten border">
                        <div class="thumb-info-wrapper m-0">
                            <img src="img/demos/real-estate/listings/listing-5.jpg" class="img-fluid" alt="">
                            <div
                                class="thumb-info-listing-type bg-color-secondary text-uppercase text-color-light font-weight-semibold p-1 pl-3 pr-3">
                                برای فروش
                            </div>
                        </div>
                        <div class="thumb-info-price bg-color-primary text-color-light text-4 p-2 pl-4 pr-4">
                            435,000,000 تومان
                            <i class="fas fa-caret-right text-color-secondary float-right"></i>
                        </div>
                        <div class="custom-thumb-info-title b-normal p-4">
                            <div class="thumb-info-inner text-3">تهران، سعادت آباد</div>
                            <ul class="accommodations text-uppercase font-weight-bold p-0 mb-0 text-2">
                                <li>
                                    <span class="accomodation-title">
                                        اتاق:
                                    </span>
                                    <span class="accomodation-value custom-color-1">
                                        3
                                    </span>
                                </li>
                                <li>
                                    <span class="accomodation-title">
                                        سرویس بهداشتی:
                                    </span>
                                    <span class="accomodation-value custom-color-1">
                                        2
                                    </span>
                                </li>
                                <li>
                                    <span class="accomodation-title">
                                        متراژ:
                                    </span>
                                    <span class="accomodation-value custom-color-1">
                                        500
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 p-3 isotope-item">
            <div class="listing-item">
                <a href="demo-real-estate-properties-detail.html" class="text-decoration-none">
                    <div class="thumb-info thumb-info-lighten border">
                        <div class="thumb-info-wrapper m-0">
                            <img src="img/demos/real-estate/listings/listing-6.jpg" class="img-fluid" alt="">
                            <div
                                class="thumb-info-listing-type bg-color-secondary text-uppercase text-color-light font-weight-semibold p-1 pl-3 pr-3">
                                برای فروش
                            </div>
                        </div>
                        <div class="thumb-info-price bg-color-primary text-color-light text-4 p-2 pl-4 pr-4">
                            490,000,000 تومان
                            <i class="fas fa-caret-right text-color-secondary float-right"></i>
                        </div>
                        <div class="custom-thumb-info-title b-normal p-4">
                            <div class="thumb-info-inner text-3">خیابان تجریش</div>
                            <ul class="accommodations text-uppercase font-weight-bold p-0 mb-0 text-2">
                                <li>
                                    <span class="accomodation-title">
                                        اتاق:
                                    </span>
                                    <span class="accomodation-value custom-color-1">
                                        3
                                    </span>
                                </li>
                                <li>
                                    <span class="accomodation-title">
                                        سرویس بهداشتی:
                                    </span>
                                    <span class="accomodation-value custom-color-1">
                                        2
                                    </span>
                                </li>
                                <li>
                                    <span class="accomodation-title">
                                        متراژ:
                                    </span>
                                    <span class="accomodation-value custom-color-1">
                                        500
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>

    <div class="row my-5">
        <div class="col">
            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-left"></i></a></li>
            </ul>
        </div>
    </div>

</x-app-layout>
