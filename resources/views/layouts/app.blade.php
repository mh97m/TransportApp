<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="/assets/img/apple-touch-icon.png">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/assets/vendor/animate/animate.min.css">
    <link rel="stylesheet" href="/assets/vendor/simple-line-icons/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="/assets/vendor/owl.carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/vendor/owl.carousel/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="/assets/vendor/magnific-popup/magnific-popup.min.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="/assets/css/theme.css">
    <link rel="stylesheet" href="/assets/css/theme-elements.css">
    <link rel="stylesheet" href="/assets/css/theme-blog.css">
    <link rel="stylesheet" href="/assets/css/theme-shop.css">

    <!-- Current Page CSS -->
    <link rel="stylesheet" href="/assets/vendor/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="/assets/vendor/rs-plugin/css/layers.css">
    <link rel="stylesheet" href="/assets/vendor/rs-plugin/css/navigation.css">

    <!-- Demo CSS -->
    <link rel="stylesheet" href="/assets/css/demo-real-estate.css">

    <!-- Skin CSS -->
    <link rel="stylesheet" href="/assets/css/skin-real-estate.css">

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="/assets/css/custom.css">

    <!-- Head Libs -->
    <script src="/assets/vendor/modernizr/modernizr.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div class="body">
        <livewire:layout.header />
        <div role="main" class="main">
            @if (session('session-message'))
                <div class="row m-3">
                    <div class="col-lg-12">
                        <div class="alert alert-{{ session('session-color') }} alert-dismissible m-2" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <strong>{{ session('session-title') }}</strong> {{ session('session-message') }}
                        </div>
                    </div>
                </div>
            @endif

            {{-- @if (isset($slider))
                <livewire:layout.slider />
            @endif --}}

            <div class="container">
                {{ $slot }}
            </div>

            <livewire:layout.footer />
        </div>
    </div>

    <!-- Vendor -->
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/vendor/jquery.appear/jquery.appear.min.js"></script>
    <script src="/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="/assets/vendor/jquery.cookie/jquery.cookie.min.js"></script>
    <script src="/assets/vendor/popper/umd/popper.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/vendor/common/common.min.js"></script>
    <script src="/assets/vendor/jquery.validation/jquery.validate.min.js"></script>
    <script src="/assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="/assets/vendor/jquery.gmap/jquery.gmap.min.js"></script>
    <script src="/assets/vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
    <script src="/assets/vendor/isotope/jquery.isotope.min.js"></script>
    <script src="/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="/assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="/assets/vendor/vide/jquery.vide.min.js"></script>
    <script src="/assets/vendor/vivus/vivus.min.js"></script>

    <!-- Theme Base, Components and Settings -->
    <script src="/assets/js/theme.js"></script>

    <!-- Current Page Vendor and Views -->
    <script src="/assets/vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script src="/assets/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

    <!-- Current Page Vendor and Views -->
    <script src="/assets/js/view.contact.js"></script>

    <!-- Demo -->
    <script src="/assets/js/demo-real-estate.js"></script>

    <!-- Theme Custom -->
    <script src="/assets/js/custom.js"></script>

    <!-- Theme Initialization Files -->
    <script src="/assets/js/theme.init.js"></script>
</body>

</html>
