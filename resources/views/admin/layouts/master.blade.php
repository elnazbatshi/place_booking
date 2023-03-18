<!doctype html>
<html lang="en" style="direction: rtl;">

<head>

    <meta charset="utf-8">
    <title>سامانه رزواسیون حوزه هنری</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{ method_field('put') }}
<!-- App favicon -->
{{--    <link rel="shortcut icon" href="{{asset('/assets/images/sccmfav.ico')}}">--}}

<!-- Bootstrap Css -->
    <link href="{{asset('assets\css\bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="{{asset('assets\css\icons.min.css')}}" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="{{asset('assets\css\app-rtl.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/libs/toastr/build/toastr.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('assets/css/myStyle.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('packages/barryvdh/elfinder/css/elfinder.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('packages/barryvdh/elfinder/css/theme.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('packages/barryvdh/elfinder/css/elfinder.full.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/css/jquery-ui.min.css')}}"/>

    <link type="text/css" rel="stylesheet" href="{{asset('assets/libs/datepicker/jalalidatepicker.min.css')}}" />
    <style>
        .SelectRTL .selection .select2-selection {
            height: 42px;
        }

        .SelectRTL .select2-container {
            width: 100% !important;
        }

        .SelectRTL .selection .select2-selection span {
            text-align: right !important;
            padding-right: 12px;
            line-height: 40px;
        }

        .select2-results__option[aria-selected] {

            text-align: right;
        }

    </style>
    @yield('styleCss')
</head>

<body data-sidebar="dark">

<!-- <body data-layout="horizontal" data-topbar="dark"> -->

<!-- Begin page -->
<div id="layout-wrapper">
@include('admin.layouts.navbar')
<!-- ========== Left Sidebar Start ========== -->
@include('admin.layouts.sidebar')
<!-- Left Sidebar End -->
@yield('content')
<!-- end main content-->
</div>
<!-- END layout-wrapper -->
<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
<script src="{{asset('assets\libs\jquery\jquery.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets\libs\metismenu\metisMenu.min.js')}}"></script>
<script src="{{asset('assets\libs\simplebar\simplebar.min.js')}}"></script>
<script src="{{asset('assets\libs\node-waves\waves.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/sweetalert/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('assets/libs/toastr/build/toastr.min.js')}}"></script>
{{--<script src="{{asset('assets/libs/select2/fa.js')}}"></script>--}}
<script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>


<!-- apexcharts -->
{{--<script src="{{asset('assets\libs\apexcharts\apexcharts.min.js')}}"></script>--}}

<!-- dashboard init -->
{{--<script src="{{asset('assets\js\pages\dashboard.init.js')}}"></script>--}}

<!-- App js -->
<script src="{{asset('assets\js\app.js')}}"></script>
{{--<script src="{{asset('assets\datePicker\kamadatepicker.holidays.js')}}"></script>--}}

{{--<script src="{{asset('assets\datePicker\kamadatepicker.min.js')}}"></script>--}}
<script src="{{asset('assets\js\plugins\ckeditor5\ckeditor5.js')}}"></script>
{{--<script src="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>--}}
<script src="{{asset('packages/barryvdh/elfinder/js/elfinder.min.js')}}"></script>
<script src="{{asset('packages/barryvdh/elfinder/js/standalonepopup.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/libs/datepicker/jalalidatepicker.min.js')}}"></script>
@yield('scriptPre')
<script src="{{asset('assets/js/filterAjax/ajax.js')}}"></script>
@yield('script')

<script src="{{asset('assets/js/ajax.js')}}"></script>
</body>

</html>
