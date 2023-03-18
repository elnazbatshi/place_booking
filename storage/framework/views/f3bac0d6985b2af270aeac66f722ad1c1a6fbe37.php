<!doctype html>
<html lang="en" style="direction: rtl;">

<head>

    <meta charset="utf-8">
    <title>سامانه رزواسیون حوزه هنری</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php echo e(method_field('put')); ?>

<!-- App favicon -->


<!-- Bootstrap Css -->
    <link href="<?php echo e(asset('assets\css\bootstrap-rtl.min.css')); ?>" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="<?php echo e(asset('assets\css\icons.min.css')); ?>" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="<?php echo e(asset('assets\css\app-rtl.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('assets/libs/toastr/build/toastr.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('assets/libs/select2/select2.min.css')); ?>" rel="stylesheet" type="text/css">

    <link href="<?php echo e(asset('assets/css/myStyle.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('assets/libs/dropzone/min/dropzone.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('packages/barryvdh/elfinder/css/elfinder.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('packages/barryvdh/elfinder/css/theme.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('packages/barryvdh/elfinder/css/elfinder.full.css')); ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css"
          href="<?php echo e(asset('assets/css/jquery-ui.min.css')); ?>"/>

    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('assets/libs/datepicker/jalalidatepicker.min.css')); ?>" />
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
    <?php echo $__env->yieldContent('styleCss'); ?>
</head>

<body data-sidebar="dark">

<!-- <body data-layout="horizontal" data-topbar="dark"> -->

<!-- Begin page -->
<div id="layout-wrapper">
<?php echo $__env->make('admin.layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- ========== Left Sidebar Start ========== -->
<?php echo $__env->make('admin.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Left Sidebar End -->
<?php echo $__env->yieldContent('content'); ?>
<!-- end main content-->
</div>
<!-- END layout-wrapper -->
<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
<script src="<?php echo e(asset('assets\libs\jquery\jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets\libs\metismenu\metisMenu.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets\libs\simplebar\simplebar.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets\libs\node-waves\waves.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/sweetalert/sweetalert2.all.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/toastr/build/toastr.min.js')); ?>"></script>

<script src="<?php echo e(asset('assets/libs/select2/select2.min.js')); ?>"></script>


<!-- apexcharts -->


<!-- dashboard init -->


<!-- App js -->
<script src="<?php echo e(asset('assets\js\app.js')); ?>"></script>



<script src="<?php echo e(asset('assets\js\plugins\ckeditor5\ckeditor5.js')); ?>"></script>

<script src="<?php echo e(asset('packages/barryvdh/elfinder/js/elfinder.min.js')); ?>"></script>
<script src="<?php echo e(asset('packages/barryvdh/elfinder/js/standalonepopup.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/libs/datepicker/jalalidatepicker.min.js')); ?>"></script>
<?php echo $__env->yieldContent('scriptPre'); ?>
<script src="<?php echo e(asset('assets/js/filterAjax/ajax.js')); ?>"></script>
<?php echo $__env->yieldContent('script'); ?>

<script src="<?php echo e(asset('assets/js/ajax.js')); ?>"></script>
</body>

</html>
<?php /**PATH I:\Projects\reservasion\resources\views/admin/layouts/master.blade.php ENDPATH**/ ?>