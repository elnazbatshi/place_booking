<?php $__env->startSection('script'); ?>
    <script>
        <?php if(\Session::has('success')): ?>
            toastr["success"]('<?php echo e(session()->get('success')); ?>');
        <?php endif; ?>
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div id="form-profile" class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="sidebar-profile">
                        <div class="sidebar-heading">
                            <a href=""><img src="/assetsSite/img/profile-man.svg"></a>
                            <div class="sidebar-profile-name">

                                <?php echo e($user->name); ?>

                            </div><!-- .sidebar-profile-name -->
                        </div><!-- .sidebar-heading -->
                        <ul class="sidebar-profile-row">





                            <li class="profile-exit">


                            </li><!-- .profile-exit -->
                        </ul><!-- .sidebar-profile-row -->
                        <ul class="sidebar-profile-item">
                            <li class="profile-sidebar-user">
                                <span id="profile" class="active-tab tab_panel" onclick="changeSide(this)"

                                      data-url="<?php echo e(route('panel.getData',['type'=>'profile'])); ?>" data-type="profile"> پیشخوان</span>
                            </li>
                            <li class="profile-sidebar-order">
                                <i class="icon-list"></i>
                                <span id="orders" class="tab_panel" onclick="changeSide(this)"
                                      data-url="<?php echo e(route('panel.getData',['type'=>'orders'])); ?>" data-type="orders">لیست سفارش ها</span>
                            </li>




                            <li class="profile-sidebar-favorite">
                                <form action="<?php echo e(route('panel.customer.logout')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button class="btn-logout" type="submit">
                                        <i class="icon-log-out ml-3"></i>
                                        خروج
                                    </button>
                                </form>
                            </li>
                        </ul><!-- .sidebar-profile-item -->
                    </div>
                </div>
                <div class="col-lg-9" id="panelContent">
                    <?php echo $__env->make('booking.panel.profile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div><!-- .container -->
    </div><!-- #profile -->



<?php $__env->stopSection(); ?>














<?php echo $__env->make('booking.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH I:\Projects\booking2\resources\views/booking/panel/main.blade.php ENDPATH**/ ?>