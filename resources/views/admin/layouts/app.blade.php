<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Components / Accordion - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    {{-- <link href="{{ mix('css/app.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/vendor/bootstrap-icons/bootstrap-icons.min.css') }} " rel="stylesheet">
    <link href=" {{ asset('assets/admin/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link href=" {{ asset('assets/admin/css/style.css') }}" rel="stylesheet">

    {{-- <link rel="stylesheet" href="{{ asset('fonts/vendor/bootstrap-icons/bootstrap-icons.woff') }}">
    <link rel="stylesheet" href="{{ asset('fonts/vendor/bootstrap-icons/bootstrap-icons.woff2') }}"> --}}

    @yield('styles')

</head>

<body>

    <!-- ======= Header ======= -->
    @include('admin.layouts.includes.header')
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    @include('admin.layouts.includes.sidebar')
    <!-- End Sidebar-->

    <main id="main" class="main">
        @yield('content')
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('admin.layouts.includes.footer')
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


    {{-- <script src="{{ mix('js/app.min.js') }}"></script> --}}
    <script src="{{ asset('assets/admin/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/main.js') }}"></script>
    <script src="{{ asset('assets/global/global.js') }}"></script>


    @yield('scripts')

</body>

</html>
