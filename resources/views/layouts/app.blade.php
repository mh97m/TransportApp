<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

    <!-- C3 Chart css -->
    <link href="/assets/libs/c3/c3.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/app-rtl.css" rel="stylesheet" type="text/css"  id="app-stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="enlarged" data-keep-enlarged="true">

    <div id="wrapper">
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

        <livewire:layout.header />
        <livewire:layout.sidebar />

        <div class="content-page">
            <div class="content">
                {{ $slot }}
            </div>

            <livewire:layout.footer />
        </div>

    </div>

    <!-- Vendor js -->
    <script src="/assets/js/vendor.min.js"></script>

    <!--C3 Chart-->
    <script src="/assets/libs/d3/d3.min.js"></script>
    <script src="/assets/libs/c3/c3.min.js"></script>

    <script src="/assets/libs/echarts/echarts.min.js"></script>

    <script src="/assets/js/pages/dashboard.init.js"></script>

    <!-- App js -->
    <script src="/assets/js/app.min.js"></script>
</body>

</html>
