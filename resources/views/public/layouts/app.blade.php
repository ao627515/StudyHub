<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="msvalidate.01" content="5FF8D283B9C90AD029C6B24A1F2A4CD1" />
    {!! SEO::generate() !!}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/global/svg/logo.svg') }}">
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
