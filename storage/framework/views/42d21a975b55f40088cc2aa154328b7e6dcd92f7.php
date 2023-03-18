

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets\libs\jquery.repeater\jquery.repeater.min.js')); ?>"></script>

    <script src="<?php echo e(asset('assets\js\pages\form-repeater.int.js')); ?>"></script>


    
    
    


<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create',\App\Models\Menu::class)): ?>
                                    <div class="text-end">
                                        <button class="btn btn-success  waves-effect waves-light" data-bs-toggle="modal"
                                                data-bs-target="#addMenu">اضافه کردن منو
                                        </button>
                                    </div>
                                <?php endif; ?>
                                <h4 class="card-title mb-0">منو ها</h4>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="mt-4">
                                            <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <div class="accordion" id="accordion_<?php echo e($item->id); ?>"
                                                     data-id="<?php echo e($item->id); ?>">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="heading_<?php echo e($item->id); ?>">
                                                            <button class="accordion-button fw-medium collapsed"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#collapse_<?php echo e($item->id); ?>"
                                                                    aria-expanded="false"
                                                                    aria-controls="collapse_<?php echo e($item->id); ?>">
                                                                <?php echo e($item->name); ?>

                                                            </button>
                                                        </h2>
                                                        <div id="collapse_<?php echo e($item->id); ?>"
                                                             class="accordion-collapse collapse"
                                                             aria-labelledby="heading_<?php echo e($item->id); ?>"
                                                             data-bs-parent="#accordion1">
                                                            <div class="accordion-body">
                                                                <div class="text-muted">
                                                                    <div class="row">
                                                                        <div class="col-12">

                                                                            <div class="card">
                                                                                <div class="card-body">

                                                                                    <form data-add-menu-item
                                                                                          class="repeater"
                                                                                          action="<?php echo e(route('menu.addItem',$item->id)); ?>"
                                                                                          method="post"
                                                                                          enctype="multipart/form-data">
                                                                                        <div class="js-items-list">
                                                                                            <?php echo $__env->make('admin.manage.menu.ajax.items-list',['items_list'=>$item->MenuItem], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                                        </div>
                                                                                        <br>
                                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create',\App\Models\MenuItem::class)): ?>
                                                                                            <h6 class="text-primary">زیر
                                                                                                منو
                                                                                                جدید را اضافه کنید</h6>
                                                                                            <hr>

                                                                                            <div
                                                                                                data-repeater-list="group-<?php echo e($item->id); ?>">
                                                                                                <div
                                                                                                    data-repeater-item="<?php echo e($item->id); ?>"
                                                                                                    class="row">

                                                                                                    <div
                                                                                                        class="row">
                                                                                                        <div
                                                                                                            class="mb-3 col-lg-2">
                                                                                                            <label
                                                                                                                for="name">عنوان
                                                                                                                ایتم
                                                                                                                منو</label>
                                                                                                            <input
                                                                                                                type="text"
                                                                                                                value=""
                                                                                                                name="menuName"

                                                                                                                class="form-control">
                                                                                                        </div>

                                                                                                        <div
                                                                                                            class="mb-3 col-lg-2">
                                                                                                            <label
                                                                                                                for="email">آدرس
                                                                                                                منو</label>
                                                                                                            <input
                                                                                                                type="text"
                                                                                                                value=""
                                                                                                                name="linkMenu"
                                                                                                                class="form-control">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="mb-3 col-lg-1">
                                                                                                            <label
                                                                                                                for="icon">ایکون
                                                                                                                منو</label>
                                                                                                            <input
                                                                                                                type="text"
                                                                                                                value=""
                                                                                                                name="icon"
                                                                                                                class="form-control">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="mb-3 col-lg-1">
                                                                                                            <label
                                                                                                                for="index">ترتیب
                                                                                                                قرارگیری</label>
                                                                                                            <input
                                                                                                                type="number"
                                                                                                                value=""
                                                                                                                name="indexMenu"
                                                                                                                class="form-control">
                                                                                                        </div>

                                                                                                        <div
                                                                                                            class="mb-3 col-3">
                                                                                                            <label
                                                                                                                for="formrow-firstname-input"
                                                                                                                class="form-label">ایتم
                                                                                                                های
                                                                                                                اصلی</label>
                                                                                                            <br>
                                                                                                            <select
                                                                                                                data-menuItem="<?php echo e($item->id); ?>"
                                                                                                                style="width: 100%;"
                                                                                                                name="parent_id"
                                                                                                                class="form-control ">
                                                                                                                <option
                                                                                                                    value="">
                                                                                                                    مادر
                                                                                                                </option>
                                                                                                                <?php $__currentLoopData = $item->parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                                    <option
                                                                                                                        value="<?php echo e($parent->id); ?>">
                                                                                                                        <?php echo e($parent->title); ?></option>
                                                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete',\App\Models\MenuItem::class)): ?>
                                                                                                            <div
                                                                                                                class="col-lg-2 align-self-center">
                                                                                                                <div
                                                                                                                    class="d-grid">
                                                                                                                    <input
                                                                                                                        data-repeater-delete=""
                                                                                                                        type="button"
                                                                                                                        class="btn btn-danger"
                                                                                                                        value="پاک کردن">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        <?php endif; ?>
                                                                                                    </div>
                                                                                                </div>

                                                                                            </div>
                                                                                            <?php echo csrf_field(); ?>
                                                                                            <button
                                                                                                class=" btn btn-primary waves-effect waves-light "
                                                                                                type="submit">ثبت آیتم
                                                                                            </button>

                                                                                            <input
                                                                                                data-repeater-create="<?php echo e($item->id); ?>"
                                                                                                type="button"
                                                                                                class="btn btn-success mt-3 mt-lg-0"
                                                                                                value="اضافه کردن ایتم">
                                                                                        <?php endif; ?>
                                                                                    </form>

                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                        <!-- end accordion -->
                                        </div>
                                    </div>

                                </div>
                                <!-- end row -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->
        </div>


    </div> <!-- container-fluid -->


    <div class="modal fade " id="addMenu" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافه کردن منو</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3 col-12">
                        <label for="formrow-firstname-input" class="form-label">نام منو </label>
                        <input id="menuName" name="roleName" type="text" class="form-control ">
                    </div>
                    <div class="form-group  mb-3 col-12">
                        <input type="file" name="file" class="form-control" id="image-input">
                        <span class="text-danger" id="image-input-error"></span>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    <div>
                        <button data-update-role data-action="<?php echo e(route('menu.store')); ?>" onclick="addNewMenu(this)"
                                data-action="" type="button"
                                class="btn btn-success w-md">اضافه کردن
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH I:\Projects\reservasion\resources\views/admin/manage/menu/show.blade.php ENDPATH**/ ?>