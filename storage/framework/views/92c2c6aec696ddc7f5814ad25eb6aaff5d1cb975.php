<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ورود</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo e(asset('assetsSite/css/style.css')); ?>">
</head>
<body>
<style>
    .text-danger{
        color: red;
    }
</style>

<div id="wrapper" class="container-fluid">
    <div class="container">
        <?php if(isset($route)): ?>
            <form method="POST" action="<?php echo e($route); ?>">
                <?php else: ?>
                    <form method="POST" action="<?php echo e(route('login')); ?>">
                        <?php endif; ?>

                        <?php echo csrf_field(); ?>
                        <div class="login-col">
                            <div class="wrapper-logo">
                                <a class="header-logo" href="" title="">
                                    <img src="<?php echo e(asset('assetsSite/img/logo.png')); ?>">
                                </a>
                            </div><!-- .wrapper-logo -->
                            <div class="login-top">ورود</div>
                            <div class="login-form">
                                <label for="username">نام کاربری :</label>
                                <input type="text" name="personal_id" id="personal_id"
                                       placeholder="شماره پرسنلی خود را وارد کنید">
                                <?php $__errorArgs = ['personal_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div><!-- .login-form -->
                            <div class="login-form">
                                <label for="password">رمز عبور:</label>
                                <input type="password" name="password" id="password"
                                       placeholder=" کلمه عبور خود را وارد کنید">
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($message); ?></strong>
                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                <?php if($errors->any()): ?>
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong class="text-danger"> <?php echo e($errors->first()); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div><!-- .login-form -->
                            <div class="checkbox-login pull-right">
                                <input class="remember" name="remember" type="checkbox" id="remember"
                                       value="accept_rules">
                                <label class="remember" for="remember">
                                    <span >مرا به خاطر داشته باش</span>
                                </label>
                            </div><!-- .checkbox-login -->
                            
                            
                            
                            <div class="clearfix"></div>
                            <button type="submit" class="login-btn button">ورود</button>
                        </div>
                    </form>

                    <!-- .login-col-->
                    <div class="form-action">
                        <div class="switch-home">
                            <a href="<?php echo e(route('site.index')); ?>">بازگشت به صفحه اصلی</a>
                        </div><!-- .switch-home -->
                        <div class="clearfix"></div>
                    </div><!-- .form-action -->
    </div><!-- .container -->
</div><!-- #wrapper -->
</body>
</html>
<?php /**PATH I:\Projects\reservasion\resources\views/booking/auth/login.blade.php ENDPATH**/ ?>