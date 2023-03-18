<header id="header">
    <div class="container">
        <div class="row">
            <div class="col-6 col-lg-2 d-flex align-items-center">
                <a class="header-logo" href="<?php echo e(route('site.index')); ?>" title="">
                    <?php if(isset($menuHeader->logo_image)): ?>
                        <img src="<?php echo e(asset($menuHeader->logo_image)); ?>" alt=""></a>
                <?php else: ?>
                    <img style="width: 70px;height: 70px" src="<?php echo e(asset('booking/site/image/logoSite.png')); ?>"
                         alt=""></a>
                    <?php endif; ?>
                    </a>
            </div>
            <div class="col-4 col-lg-7 d-none d-lg-flex align-items-center">
                <div class="wrap-menu">
                    <ul class="header-menu">
                        <?php if($menuHeader->MenuItem->count()): ?>
                            <?php $__currentLoopData = $menuHeader->MenuItem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($menu->children->count()): ?>
                                    <li class="nav-item dropdown ">
                                        <a class="nav-link dropdown-toggle" href="<?php echo e($menu->link); ?>" role="button"
                                           data-bs-toggle="dropdown">
                                            <?php echo e($menu->title); ?>

                                        </a>
                                        <ul class="sub-menu">
                                            <?php $__currentLoopData = $menu->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a class="dropdown-item" href="<?php echo e($child->link); ?>">
                                                    <?php echo e($child->title); ?>

                                                </a>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </li>
                                <?php else: ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo e($menu->link); ?>"><?php echo e($menu->title); ?></a>

                                    </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>


            <div class="col-6 col-lg-3 d-flex align-items-center justify-content-end">
                <?php if(Auth::guard('customer')->check()): ?>
                    <?php if(\Route::currentRouteName()=='panel.index'): ?>
                        <a href="<?php echo e(route('site.index')); ?>" class="button btn-h">رفتن به سایت</a>
                    <?php else: ?>
                        <a href="<?php echo e(route('panel.index')); ?>" class="button btn-h">پنل کاربری</a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="<?php echo e(route('customer.login-view')); ?>" class="button btn-h">ورود</a>
                <?php endif; ?>
                    <div class="search-pup-up">
                        <div class="fd-outer search-close">
                            <div class="fd-inner">
                                <label>بازگشت</label>
                            </div>
                        </div>
                        <div class="col-lg-8 mx-auto form-wrap">
                            <form class="search-form" method="get">
                                <input onkeyup="search_by_ajax(this)" data-action="<?php echo e(route('site.search')); ?>"  id="search-text" type="search" name="s" placeholder="جستجو عبارت مورد نظر" autocomplete="off">
                            </form>

                                <div class="row search-bord">

                                    <div class="col-lg-3 col-md-6 d-none title-search ">
                                        <h5>رویداد ها </h5>
                                        <div class="event-bord">

                                        </div>


                                </div>


                        </div>
                    </div>
                <div class="header-search"><i class="icon-search"></i><span></span></div>
                <div class="header-mm"><i class="icon-menu"></i></div>
                <div id="mask"></div>
                <div id="menumobile">
                    <div class="title-mm">
                        <img src=<?php echo e(asset($menuHeader->logo_image)); ?>>
                        <span id="nomenumobile"><i class="icon-clear"></i></span>
                    </div>
                    <div class="button-mm">
                        <?php if(Auth::guard('customer')->check()): ?>
                            <?php if(\Route::currentRouteName()=='panel.index'): ?>

                                <a href="<?php echo e(route('site.index')); ?>" class="button">رفتن به سایت</a>
                            <?php else: ?>
                                <a href="<?php echo e(route('panel.index')); ?>" class="button">پنل کاربری</a>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="<?php echo e(route('customer.login-view')); ?>" class="button">ورود</a>
                        <?php endif; ?>

                    </div>
                    <div class="wrap-menu">
                        <ul class="main-mm">
                            <?php if($menuHeader->MenuItem->count()): ?>
                                <?php $__currentLoopData = $menuHeader->MenuItem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item dropdown active">




                                        <a class="nav-link dropdown-toggle" href="<?php echo e($menu->link); ?>"><?php echo e($menu->title); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<?php /**PATH I:\Projects\reservasion\resources\views/booking/layouts/header.blade.php ENDPATH**/ ?>