<div class="vertical-menu">

    <div data-simplebar="" class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(array_merge(\App\Models\Permission::MENUITEM_PERMISSIONS,\App\Models\Permission::MENU_PERMISSIONS))): ?>
                    <li>
                        <a href="javascript: void(0);" class="waves-effect">
                            <i class="bx bx-dock-top"></i>
                            <span key="t-dashboards"> مدیریت منو ها</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(\App\Models\Permission::MENUITEM_PERMISSIONS)): ?>
                                <li><a href="<?php echo e(route('menu.indexItem')); ?>" key="t-default">اضافه کردن ایتمهای منو </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(\App\Models\Permission::MENU_PERMISSIONS)): ?>
                                <li><a href="<?php echo e(route('menu.index')); ?>" key="t-saas">لیست جایگاه منو ها</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(array_merge(\App\Models\Permission::TYPE_CATEGORY_PERMISSIONS,\App\Models\Permission::CATEGORY_PERMISSIONS))): ?>
                    <li>
                        <a href="javascript: void(0);" class="waves-effect">
                            <i class="bx bx-grid-alt"></i>
                            <span key="t-dashboards">  دسته بندی   </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(\App\Models\Permission::TYPE_CATEGORY_PERMISSIONS)): ?>
                                <li><a href="<?php echo e(route('typeCategory.index')); ?>">مدیریت نوع دسته بندی
                                        ها </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(\App\Models\Permission::CATEGORY_PERMISSIONS)): ?>
                                <li><a href="<?php echo e(route('category.index')); ?>">مدیریت دسته بندی ها </a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                
                
                
                
                
                
                
                
                
                
                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(\App\Models\Permission::MODULE_PERMISSIONS)): ?>
                    <li>
                        <a href="javascript: void(0);" class="waves-effect">
                            <i class="bx bx-dialpad"></i>
                            <span key="t-dashboards"> مدیریت ماژول ها </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create',\App\Models\Module::class)): ?>
                                <li><a href="<?php echo e(route('module.create')); ?>" key="t-default">ساختن ماژول </a></li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view',\App\Models\Module::class)): ?>
                                <li><a href="<?php echo e(route('module.index')); ?>" key="t-default"> ماژول ها</a></li>
                            <?php endif; ?>

                        </ul>
                    </li>
                <?php endif; ?>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="bx bx-code-block"></i>
                        <span key="t-dashboards"> مدیریت اسلایدر ها </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo e(route('slider.index')); ?>" key="t-default"> اسلایدر ها </a></li>
                        <li><a href="<?php echo e(route('slider.create')); ?>" key="t-default">ساختن اسلاید </a></li>
                    </ul>
                </li>
                <li>



























                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="bx bx-code-block"></i>
                        <span key="t-dashboards">مدیریت سالن ها </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo e(route('location.index')); ?>" key="t-default"> سالن ها </a></li>
                        <li><a href="<?php echo e(route('location.create')); ?>" key="t-default">ساختن سالن </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="bx bx-code-block"></i>
                        <span key="t-dashboards">مدیریت سفارشات</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo e(route('order.index')); ?>" key="t-default">سفارشات</a></li>
                    </ul>
                </li>

                <li>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(\App\Models\Permission::USER_PERMISSIONS)): ?>
                        <a href="javascript: void(0);" class="waves-effect">
                            <i class="bx bx-group"></i>
                            <span key="t-dashboards"> مدیریت کاربران </span>
                        </a>

                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="<?php echo e(route('user.index')); ?>" key="t-default">لیست مدیران </a></li>
                            <li><a href="<?php echo e(route('customer.index')); ?>" key="t-default">لیست مشتریان </a></li>

                        </ul>
                    <?php endif; ?>
                </li>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(\App\Models\Permission::ROLE_PERMISSIONS)): ?>
                    <li>
                        <a href="javascript: void(0);" class="waves-effect">
                            <i class="bx bxs-user-rectangle "></i>
                            <span key="t-dashboards">دسترسی ها</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view',\Spatie\Permission\Models\Role::class)): ?>
                                <li><a href="<?php echo e(route('admin.manage.permissions.index')); ?>" key="t-default">لیست دسترسی
                                        ها</a>
                                </li>
                            <?php endif; ?>
                            <li><a href="<?php echo e(route('admin.manage.roles.getRole')); ?>" key="t-saas"> لیست نقش ها و مجوز
                                    ها</a></li>
                        </ul>
                    </li>
                <?php endif; ?>















            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<?php /**PATH I:\Projects\reservasion\resources\views/admin/layouts/sidebar.blade.php ENDPATH**/ ?>