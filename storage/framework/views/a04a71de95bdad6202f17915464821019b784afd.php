<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="HTML5,CSS3,HTML,Template,multi-page- Single Property HTML Template">
    <meta name="description" content="">

    <!--<link rel="stylesheet" href="/assetsSite/css/bootstrap.rtl.min.css">-->

    <link rel="stylesheet" href="<?php echo e(asset('assetsSite/css/animate.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assetsSite/css/icofont.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assetsSite/css/magnific-popup.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assetsSite/css/flaticon.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assetsSite/css/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assetsSite/css/owl.theme.default.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assetsSite/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assetsSite/css/responsive.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assetsSite/css/rtl.css')); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('assets/libs/datepicker/jalalidatepicker.min.css')); ?>"/>
    <link href="<?php echo e(asset('assets/libs/toastr/build/toastr.min.css')); ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css"
          href="<?php echo e(asset('assets/css/jquery-ui.min.css')); ?>"/>

    <link rel="icon" type="image/png" href="<?php echo e(asset('assetsSite/img/favicon.png')); ?>">
    <style>
        .owl-nav button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.93) !important;
            height: 50px;
            width: 32px;
        }

        .owl-nav button.owl-prev {
            left: 0;
        }

        .owl-nav button.owl-next {
            right: 0;
        }

        .owl-dots {
            text-align: center;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .owl-dots button.owl-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            background: #ccc;
            margin: 0 3px;
        }

        .owl-dots button.owl-dot.active {
            background-color: #009fa3;
        }

        .owl-dots button.owl-dot:focus {
            outline: none;
        }

        .owl-nav button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(240, 242, 240, 0.76) !important;
        }

        .owl-nav button:focus {
            outline: none;
        }

        .active-tab {
            font-weight: bold;
            color: #009fa3;
        }
        .disable-input{
            background-color: #8080804f;
            border: none;
        }
    </style>
    <?php echo $__env->yieldContent('style'); ?>

    <title>صفحه اصلی</title>
</head>
<body>
<?php echo $__env->make('booking.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Main Banner -->

<!-- End Main Banner -->
<?php echo $__env->yieldContent('content'); ?>

<?php echo $__env->make('booking.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script src="<?php echo e(asset('assetsSite/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('assetsSite/js/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('assetsSite/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('assetsSite/js/owl.carousel.min.js')); ?>"></script>
<script src="<?php echo e(asset('assetsSite/js/jquery.mixitup.min.js')); ?>"></script>
<script src="<?php echo e(asset('assetsSite/js/jquery.magnific-popup.min.js')); ?>"></script>
<script src="<?php echo e(asset('assetsSite/js/wow.min.js')); ?>"></script>
<script src="<?php echo e(asset('assetsSite/js/jquery.ajaxchimp.min.js')); ?>"></script>
<script src="<?php echo e(asset('assetsSite/js/form-validator.min.js')); ?>"></script>
<script src="<?php echo e(asset('assetsSite/js/contact-form-script.js')); ?>"></script>
<script src="<?php echo e(asset('assetsSite/js/main.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/toastr/build/toastr.min.js')); ?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo e(asset('assetsSite/js/custom.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assetsSite/js/ajax/ajax.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/libs/datepicker/jalalidatepicker.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assetsSite/js/ajax/search.js')); ?>"></script>
<?php echo $__env->yieldContent('script'); ?>
</body>
</html>
<?php /**PATH I:\Projects\booking2\resources\views/booking/layouts/master.blade.php ENDPATH**/ ?>