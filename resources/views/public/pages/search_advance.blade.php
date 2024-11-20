@extends('public.layouts.app')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/simple-datatables/style.css') }}">
@endsection


@section('content')
    {{-- @dd($resources) --}}
    <section class="wrapper bg-light">
        <div class="container pt-9 pt-md-10 pb-6 pb-md-8">
            <div class="row">
                <div class="offset-lg-8 col-lg-8 col-xl-7 col-xxl-6">
                    <h2 class="fs-16 text-uppercase text-line text-primary mb-3">Trouvez la ressource que vous cherchez</h2>
                </div>
                <!-- /column -->
            </div>
            <!--/.row -->
            <div class="row gy-10 gy-sm-13 gx-lg-3 align-items-center justify-content-center">
                @include('public.pages.includes.search_advance-form')
            </div>
            <!--/.row -->

            <div class="row gy-10 mb-16 gy-sm-13 gx-lg-3 align-items-center" id="ressources">
                <div class="col-12">
                    <h2 class="fs-16 text-uppercase text-line text-primary mb-3">Nos resources</h2>
                    {{-- <h3 class="display-4 mb-7">Découvrez les ressources les plus populaires et les plus téléchargées par nos
                        utilisateurs.</h3> --}}

                    <x:resources-layout :resources="$resources" :datatable="'simple_datable'" />
                </div>
                <!--/column -->
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/admin/js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/public/js/search_advance.js') }}"></script>
    <script>
        $(document).ready(function() {
            searchAdvance();
        });
    </script>
@endsection
