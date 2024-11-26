<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {}; ?>

<footer id="footer" class="m-0 custom-bg-color-1 py-4">
    <div class="container">
        <div class="row py-4 mt-3">
            <div class="col-md-4 col-lg-3">
                <h4 class="mb-3">مشاور املاک پورتو</h4>
                <p class="custom-color-2 mb-0">
                    فلکه دانشگاه، برج بلور، طبقه 456<br>
                    تبریز، ایران<br>
                    تلفن : <span class="ltr-text">123 456 7890</span><br>
                    ایمیل : <a class="text-color-secondary" href="mailto:mail@example.com">mail@example.com</a>
                </p>
            </div>
            <div class="col-md-2 mt-4 pt-3 mt-md-0 pt-md-0">
                <h4 class="mb-3">ملک ها</h4>
                <nav class="nav-footer">
                    <ul class="custom-list-style-1 mb-0">
                        <li>
                            <a href="demo-real-estate-properties.html" class="custom-color-2 text-decoration-none">
                                برای فروش
                            </a>
                        </li>
                        <li>
                            <a href="demo-real-estate-properties.html" class="custom-color-2 text-decoration-none">
                                برای اجاره
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-2 mt-4 pt-3 mt-md-0 pt-md-0">
                <h4 class="mb-3">لینک ها</h4>
                <nav class="nav-footer">
                    <ul class="custom-list-style-1 mb-0">
                        <li>
                            <a href="demo-real-estate-agents.html" class="custom-color-2 text-decoration-none">
                                نمایندگان
                            </a>
                        </li>
                        <li>
                            <a href="demo-real-estate-who-we-are.html" class="custom-color-2 text-decoration-none">
                                ما چه کسی هستیم
                            </a>
                        </li>
                        <li>
                            <a href="demo-real-estate-contact.html" class="custom-color-2 text-decoration-none">
                                تماس
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-4 col-lg-5 mt-4 pt-3 mt-md-0 pt-md-0">
                <h4 class="mb-3">آخرین توییت ها</h4>
                <div id="tweet" class="twitter" data-plugin-tweets
                    data-plugin-options="{'username': '', 'count': 1}">
                    <p>لطفا منتظر باشید ...</p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright custom-bg-color-1 pb-0">
        <div class="container">
            <div class="row pt-3 pb-4">
                <div class="col-lg-12 left m-0 pb-3">
                    <p>ارائه شده در وب‌سایت راست‌چین</p>
                </div>
            </div>
        </div>
    </div>
</footer>
