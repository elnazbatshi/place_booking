<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>به سامانه رزواسیون حوزه هنری</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets\images\favicon.ico">

    <!-- Bootstrap Css -->
    <link href="<?php echo e(asset('assets\css\bootstrap.min.css')); ?>" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="<?php echo e(asset('assets\css\icons.min.css')); ?>" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="<?php echo e(asset('assets\css\app.min.css')); ?>" id="app-style" rel="stylesheet" type="text/css">

</head>

<body>
<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="bg-primary bg-soft">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-primary p-4 m-auto text-center">
                                    <h5 class="text-primary">به سامانه رزواسیون حوزه هنری</h5>
                                    <p>خوش آمدید</p>
                                </div>
                            </div>



                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="auth-logo">
                            <a href="index.html" class="auth-logo-light">
                                <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="<?php echo e(asset('assets/images/logo/logo-222-site-hssssoze-honari.png')); ?>"
                                                     alt="" class="rounded-circle" height="34">
                                            </span>
                                </div>
                            </a>

                            <a href="index.html" class="auth-logo-dark">
                                <div class="avatar-md profile-user-wid mb-4">
                                            <span class="rounded-circle">
                                                <img style="height: 80px;width: 80px"
                                                     src="<?php echo e(asset('/assets/images/logo/logo-222-site-hssssoze-honari.png')); ?>"
                                                     alt="" class="rounded-circle" height="34">
                                            </span>
                                </div>
                            </a>
                        </div>
                        <div class="p-2">
                            <form method="POST" action="<?php echo e(route('login')); ?>">
                                <?php echo csrf_field(); ?>

                                <div class="mb-3">
                                    <label for="username" class="form-label"> ایمیل </label>

                                    <input id="email" name="email" type="email"
                                           class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
                                </div>


                                <div class="mb-3">
                                    <label class="form-label">کلمه عبور</label>
                                    <div class="input-group auth-pass-inputgroup">
                                        <input id="password" name="password" type="password" class="form-control"
                                               aria-label="Password" aria-describedby="password-addon">
                                        <button class="btn btn-light " type="button" id="password-addon"><i
                                                class="mdi mdi-eye-outline"></i></button>
                                    </div>
                                </div>

                                <div class="form-check d-flex justify-content-between">
                                    <div>
                                        <input class="form-check-input" type="checkbox" id="remember-check">
                                        <label class="form-check-label" for="remember-check">
                                            مرا به خاطر بسپر
                                        </label>
                                    </div>
                                    <a class="register-btn" href="<?php echo e(route('register')); ?>">
                                        <button type="button" class="btn btn-primary">ثبت نام</button>
                                    </a>

                                </div>

                                <div class="mt-3 d-grid">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">ورود</button>
                                </div>


                            </form>
                        </div>

                    </div>
                </div>
                <div class="mt-5 text-center">





                </div>

            </div>
        </div>
    </div>
</div>
<!-- end account-pages -->

<!-- JAVASCRIPT -->
<script src="<?php echo e(asset('assets\libs\jquery\jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets\libs\bootstrap\js\bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets\libs\metismenu\metisMenu.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets\libs\simplebar\simplebar.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets\libs\node-waves\waves.min.js')); ?>"></script>

<!-- App js -->
<script src="<?php echo e(asset('booking\js\app.js')); ?>"></script>
</body>
</html>
<?php /**PATH I:\Projects\reservasion\resources\views/auth/login.blade.php ENDPATH**/ ?>
