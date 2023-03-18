<?php $__env->startSection('styleCss'); ?>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>




<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">مدیریت ماژول ها</h4>

                            <div class="page-title-left">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">پنل</a></li>
                                    <li class="breadcrumb-item active">مدیریت ماژول</li>
                                </ol>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create',\App\Models\Module::class)): ?>
                                    <a href="<?php echo e(route('module.create')); ?>">
                                        <button class="btn btn-success">اضافه کردن ماژول
                                        </button>
                                    </a>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap table-hover">
                                        <thead class="table-light">
                                        <tr>

                                            <th scope="col">شناسه</th>
                                            <th scope="col">عنوان</th>
                                            <th scope="col"> دسته بندی</th>
                                            <th scope="col">عکس شاخص</th>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update',\App\Models\Module::class)): ?>
                                                <th scope="col">وضعیت</th>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(['delete','update'],\App\Models\Module::class)): ?>
                                                <th scope="col">عملیات</th>
                                            <?php endif; ?>

                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                                            <tr id="post_<?php echo e($module->id); ?>">
                                                <td>
                                                    <?php echo e($module->id); ?>

                                                </td>
                                                <td>
                                                    <?php echo e(excerpt($module->name,15)); ?>

                                                </td>
                                                <td>
                                                    <?php $__currentLoopData = $module->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <span class="badge bg-success font-size-large">
                                                           <?php echo e($category->title); ?>

                                                    </span>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </td>
                                                <td>
                                                    <img style="width: 50px" src="<?php echo e(explode(',',$module->img_src)[0]); ?>"
                                                         alt="">
                                                </td>

                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input onchange="changeStatus(this)"
                                                               data-action="<?php echo e(route('module.changeStatus',$module->id)); ?>"
                                                               data-status="<?php echo e($module->status); ?>"
                                                               class="form-check-input status_menu" type="checkbox"
                                                               id="mySwitch"
                                                               <?php echo e($module->status==1 ?  "checked" : " "); ?>         name="darkmode"
                                                               value="1">
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update',\App\Models\Module::class)): ?>
                                                        <a href="<?php echo e(route('module.edit',$module->id)); ?>">
                                                            <button type="button" class="btn btn-primary"
                                                                    onclick="editPost(this)"
                                                                    data-action="<?php echo e(route('module.edit',$module->id)); ?>">

                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete',\App\Models\Module::class)): ?>
                                                        <button type="button" class="btn btn-danger"
                                                                data-toggle="tooltip"
                                                                data-title="حذف ماژول"
                                                                data-action="<?php echo e(route('module.destroy',$module->id)); ?>"

                                                                onclick="deleteModule(this)">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div>

    </div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH I:\Projects\booking2\resources\views/admin/manage/module/index.blade.php ENDPATH**/ ?>