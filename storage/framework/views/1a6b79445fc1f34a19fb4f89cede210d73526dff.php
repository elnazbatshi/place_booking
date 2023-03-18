
<?php $__env->startSection('styleCss'); ?>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        function editCategory(sender) {


            $('#titleEdit').val($(sender).data("title"));
            $('#typeEdit').val($(sender).data("type-id"));
            $('#img_src_edit').val($(sender).data("img-src"));
            $('#updateCategoryBtn').attr('data-action', $(sender).data("action"));
        }

        $(document).ready(function () {
            $("#img_src").click(function (e) {
                $('#elfinder').show();
                $("#addCat").modal("hide");
                var elfinder = $('#elfinder').dialogelfinder({
                    url: '/uploads/connector',
                    commandsOptions: {
                        getfile: {
                            onlyURL: true,
                            multiple: true,
                            folders: false,
                            oncomplete: ''
                        }
                    },
                    getFileCallback: function (file, fm) {
                        var urls = $.map(file, function (f) {
                            return f.url;
                        });
                        $('#img_src').val(file.toString());
                        $("#addCat").modal("show");
                        fm.hide();
                    },
                })
            });
            $("#img_src_edit").click(function (e) {
                $("#editCategory").modal("hide");
                $('#elfinder2').show();
                var elfinder = $('#elfinder2').dialogelfinder({
                    url: '/uploads/connector',
                    commandsOptions: {
                        getfile: {
                            onlyURL: true,
                            multiple: true,
                            folders: false,
                            oncomplete: ''
                        }
                    },
                    getFileCallback: function (file, fm) {
                        var urls = $.map(file, function (f) {
                            return f.url;
                        });
                        $('#img_src_edit').val(file.toString());
                        $("#editCategory").modal("show");
                        fm.hide();
                    },
                })
            });
        });
    </script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18"> مدیریت دسته بندی ها </h4>

                            <div class="page-title-left">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">پنل</a></li>
                                    <li class="breadcrumb-item active">مدیریت دسته بندی ها</li>
                                </ol>
                                
                                

                                
                                
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create',\App\Models\Category::class)): ?>
                                    <button class="btn btn-success  waves-effect waves-light" data-bs-toggle="modal"
                                            data-bs-target="#addCat">اضافه کردن دسته بندی
                                    </button>
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
                                            <th scope="col">نام</th>
                                            <th scope="col">نوع دسته بندی</th>
                                            <th scope="col">عکس</th>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['delete','update'],\App\Models\Category::class )): ?>
                                                <th scope="col">عملیات</th>
                                            <?php endif; ?>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr id="cat_<?php echo e($cat->id); ?>">
                                                <td>
                                                    <?php echo e($cat->id); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($cat->title); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($cat->type->name); ?>

                                                </td>

                                                <td>
                                                    <img style="max-width:70px;" src="<?php echo e(@$cat->img_src); ?>" alt="">
                                                </td>
                                                <td>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update',\App\Models\Category::class)): ?>
                                                        <button type="button" class="btn btn-primary"
                                                                onclick="editCategory(this)"
                                                                data-title="<?php echo e($cat->title); ?>"
                                                                data-type-id="<?php echo e($cat->type_id); ?>"
                                                                data-img-src="<?php echo e($cat->img_src); ?>"
                                                                data-action="<?php echo e(route('category.update',$cat->id)); ?>"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editCategory"
                                                                data-toggle="tooltip">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                    <?php echo method_field('PUT'); ?>

                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete',\App\Models\Category::class)): ?>
                                                        <button type="button" class="btn btn-danger"
                                                                data-toggle="tooltip"
                                                                data-title="حذف منو"
                                                                data-action="<?php echo e(route('category.destroy',$cat->id)); ?>"
                                                                onclick="deleteCategory(this)">
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

    
    <div class="modal fade " id="addCat" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافه کردن دسته بندی</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3 col-12">
                        <label for="formrow-firstname-input" class="form-label">عنوان دسته بندی </label>
                        <input id="title" name="" type="text" class="form-control edit-role">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="formrow-firstname-input" class="form-label">عکس دسته بندی </label>
                        <div id="elfinder"></div>
                        <input id="img_src" name="" type="text" name="img_src" class="form-control edit-role">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="formrow-firstname-input" class="form-label">نوع دسته بندی </label>

                        <select id="type" class="form-select">
                            <option disabled selected>نوع دسته بندی را انتخاب کنید</option>
                            <?php $__currentLoopData = $typeCat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Tcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($Tcat->id); ?>"><?php echo e($Tcat->name); ?></option>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    <div>
                        <button data-update-role onclick="addCategoryPost(this)"
                                data-action="<?php echo e(route('category.store')); ?>" type="button"
                                class="btn btn-success w-md">اضافه کردن
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade " id="editCategory" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ویرایش کردن دسته بندی</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3 col-12">
                        <label for="formrow-firstname-input" class="form-label">عنوان دسته بندی </label>
                        <input id="titleEdit" name="" type="text" class="form-control edit-role">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="formrow-firstname-input" class="form-label">عکس دسته بندی </label>
                        <div id="elfinder2"></div>
                        <input id="img_src_edit" name="" type="text" name="img_src" class="form-control edit-role">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="formrow-firstname-input" class="form-label">نوع دسته بندی </label>

                        <select id="typeEdit" class="form-select">
                            <option disabled selected>نوع دسته بندی را انتخاب کنید</option>
                            <?php $__currentLoopData = $typeCat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Tcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($Tcat->id); ?>"><?php echo e($Tcat->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    <div>
                        <button id="updateCategoryBtn" data-update-role onclick="updateCategory(this)"
                                data-action="" type="button"
                                class="btn btn-success w-md">ویرایش کردن
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH I:\Projects\booking2\resources\views/admin/manage/category/index.blade.php ENDPATH**/ ?>