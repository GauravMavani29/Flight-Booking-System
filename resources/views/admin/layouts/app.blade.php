<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>FlightBooking Dashboard </title>
    <link rel="icon" href="" type="image/x-icon">
    <!-- Favicon-->

    <!-- plugin css file  -->
    <link rel="stylesheet" href="{{ asset('admin/assets/plugin/datatables/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/plugin/datatables/dataTables.bootstrap5.min.css') }}">

    <!-- project css file  -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/ebazar.style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/flight-style.css') }}">
    @stack('link')
    @stack('css')
</head>

<body>
    <div id="ebazar-layout" class="theme-blue">

        <!-- sidebar -->
        @include('admin.layouts.sidebar')

        <!-- main body area -->
        <div class="main px-lg-4 px-md-4" style="padding: 0 !important;">

            <!-- Body: Header -->
            @include('admin.layouts.header')

            <!-- Body: Body -->
            <div class="body d-flex pb-3">
                <div class="container-xxl">
                    @yield('content')
                </div>
            </div>


        </div>

    </div>

    <!-- Jquery Core Js -->
    <script src="{{ asset('admin/assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

    <!-- Plugin Js -->
    {{-- <script src="{{ asset('admin/assets/bundles/apexcharts.bundle.js') }}"></script> --}}
    <script src="{{ asset('admin/assets/bundles/dataTables.bundle.js') }}"></script>

    <!-- Jquery Page Js -->
    <script src="{{ asset('admin/assets/js/template.js') }}"></script>
    <script src="{{ asset('admin/assets/js/page/index.js') }}"></script>
    @stack('script')
    <script src="{{ asset('assets/js/flight-core.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        var APP_URL = {!! json_encode(url('/')) !!};
        $('#myDataTable')
            .addClass('nowrap')
            .dataTable({
                responsive: false,
                columnDefs: [{
                    targets: [-1, -3],
                    className: 'dt-body-right'
                }]
            });
    </script>
    @stack('js')
</body>

</html>
