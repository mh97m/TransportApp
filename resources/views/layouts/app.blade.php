<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

    <link href="/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <!-- C3 Chart css -->
    {{-- <link href="/assets/libs/c3/c3.min.css" rel="stylesheet" type="text/css" /> --}}

    <!-- App css -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/app-rtl.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div id="wrapper">
        <livewire:layout.header />
        {{-- <livewire:layout.sidebar /> --}}

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
    {{-- <script src="/assets/libs/d3/d3.min.js"></script> --}}
    {{-- <script src="/assets/libs/c3/c3.min.js"></script> --}}

    {{-- <script src="/assets/libs/echarts/echarts.min.js"></script> --}}

    {{-- <script src="/assets/js/pages/dashboard.init.js"></script> --}}

    <script src="/assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- App js -->
    {{-- <script src="/assets/js/app.min.js"></script> --}}

    <script>
        window.addEventListener('swal',function(e){
            const redirectUrl = e.detail[0].redirectUrl;

            delete e.detail[0].redirectUrl;

            Swal.fire(e.detail[0]).then((result) => {
                if (result.value) {
                    window.location.replace(redirectUrl);
                }
            });
        });
        window.addEventListener('update-body-class',function(e){
            document.body.className = e.detail[0];
        });
    </script>
</body>

</html>
