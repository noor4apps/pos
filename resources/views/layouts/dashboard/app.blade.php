<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

    {{--<!-- Bootstrap 3.3.7 -->--}}
    <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/skin-blue.min.css') }}">

    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('dashboard/css/font-awesome-rtl.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard/css/AdminLTE-rtl.min.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap-rtl.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard/css/rtl.css') }}">

        <style>
            body, h1, h2, h3, h4, h5, h6 {
                font-family: 'Cairo', sans-serif !important;
            }
            .form-control{
                padding: 2px 12px;
            }
        </style>
    @else
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="stylesheet" href="{{ asset('dashboard/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard/css/AdminLTE.min.css') }}">
    @endif


    {{--noty--}}
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/noty/noty.css') }}">
    <script src="{{ asset('dashboard/plugins/noty/noty.min.js') }}"></script>

    {{--<!-- iCheck -->--}}
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/icheck/all.css') }}">

    {{--select 2--}}
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/select2/select2-bootstrap.css') }}">
    @yield('styles')
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div id="app" class="wrapper">

    <!-- Main Header -->
    @include('layouts.dashboard._main-header')

    <!-- Left side column. contains the logo and sidebar -->
    @include('layouts.dashboard._main-sidebar')

        @yield('content')

    @include('partials._session')

    <!-- Main Footer -->
    @include('layouts.dashboard._main-footer')

</div>
<!-- ./wrapper -->

<!-- Scripts -->
{{--<script src="{{ asset('js/app.js') }}"></script>--}}

{{--<!-- jQuery 3 -->--}}
<script src="{{ asset('dashboard/js/jquery.min.js') }}"></script>
{{--<!-- Bootstrap 3.3.7 -->--}}
<script src="{{ asset('dashboard/js/bootstrap.min.js') }}"></script>

{{--icheck--}}
<script src="{{ asset('dashboard/plugins/icheck/icheck.min.js') }}"></script>

{{--<!-- FastClick -->--}}
<script src="{{ asset('dashboard/js/fastclick.js') }}"></script>

{{--<!-- AdminLTE App -->--}}
<script src="{{ asset('dashboard/js/adminlte.min.js') }}"></script>

{{--select2--}}
<script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>

{{--jquery number--}}
{{--<script src="{{ asset('dashboard/js/jquery.number.min.js') }}"></script>--}}

{{-- custom --}}
{{--<script src="{{ asset('dashboard/js/custom/image_preview.js') }}"></script>--}}
{{--<script src="{{ asset('dashboard/js/custom/order.js') }}"></script>--}}
{{--<script src="{{ asset('dashboard/js/printThis.js') }}"></script>--}}

<script>
    $(document).ready(function () {
        $('.sidebar-menu').tree();

        //icheck
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });

        // select 2
        $('.select2').select2({
            theme: "bootstrap"
        });
        {{--
        //delete
        $('.delete').click(function (e) {

            var that = $(this)

            e.preventDefault();

            var n = new Noty({
                text: "@lang('site.confirm_delete')",
                type: "warning",
                killer: true,
                buttons: [
                    Noty.button("@lang('site.yes')", 'btn btn-success mr-2', function () {
                        that.closest('form').submit();
                    }),

                    Noty.button("@lang('site.no')", 'btn btn-primary mr-2', function () {
                        n.close();
                    })
                ]
            });

            n.show();

        });//end of delete
--}}
    })
</script>
@stack('scripts')
</body>
</html>
