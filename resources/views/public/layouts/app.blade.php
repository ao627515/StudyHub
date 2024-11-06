<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="An impressive and flawless site template that includes various UI elements and countless features, attractive ready-made blocks and rich pages, basically everything you need to create a unique and professional website.">
    <meta name="keywords"
        content="bootstrap 5, business, corporate, creative, gulp, marketing, minimal, modern, multipurpose, one page, responsive, saas, sass, seo, startup, html5 template, site template">
    <meta name="author" content="elemis">
    <title>Sandbox - Modern & Multipurpose Bootstrap 5 Template</title>
    {{-- <link rel="shortcut icon" href="./assets/img/favicon.png"> --}}
    <link rel="stylesheet" href="{{ asset('assets/public/css/plugins.css') }}">
    <link rel="stylesheet" href=" {{ asset('assets/public/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/public/css/colors/aqua.css') }}">
    <link rel="preload" href=" {{ asset('assets/public/fonts/thicccboi/thicccboi.css') }}" as="style"
        onload="this.rel='stylesheet'">
    @yield('styles')
</head>

<body>
    <div class="content-wrapper">
        @include('public.layouts.includes.header')
        <!-- /header -->
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    @include('public.layouts.includes.footer')
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <script src="{{ asset('assets/public/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/public/js/theme.js') }}"></script>
    <script src="{{ asset('assets/global/global.js') }}"></script>

    @yield('scripts')
</body>

</html>
