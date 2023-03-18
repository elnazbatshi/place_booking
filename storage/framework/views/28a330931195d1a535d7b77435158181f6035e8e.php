<?php $__env->startSection('styleCss'); ?>
    <style>
        .imageEdit {
            text-align: center;
            margin-top: 10px;
        }

        .imageEdit img {
            height: 80px;
            width: 80px;
            margin-inline: auto;
        }
    </style>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scriptPre'); ?>
    <?php echo $__env->make('admin.js.ckeditor',['command'=>'menu'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>

        //endCkeditor fot edit


        //load image
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#menuImageEdit').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                alert('select a file to see preview');
                $('#menuImageEdit').attr('src', '');
            }
        }

        $("#image_upload_edit").change(function () {
            readURL(this);
        });

        function editMenu(sender) {
            var srcImage = '/' + $(sender).data("imageSrc")
            $('#menuNameEdit').val($(sender).data("name-menu"));
            $('#menuImageEdit').attr('src', srcImage);
            editDEs.setData($(sender).data("description"))
            // $('#menuDescEdit').val();
            $('#updateMenu').attr('data-action', $(sender).data("action"));
        }
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
                            <h4 class="mb-sm-0 font-size-18">مدیریت منو</h4>

                            <div class="page-title-left">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">پنل</a></li>
                                    <li class="breadcrumb-item active">مدیریت منو</li>
                                </ol>
                                
                                

                                
                                
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create',\App\Models\Menu::class)): ?>
                                    <button class="btn btn-success  waves-effect waves-light" data-bs-toggle="modal"
                                            data-bs-target="#addMenu">اضافه کردن منو
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
                                            <th scope="col">لوگو</th>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check( 'update',\App\Models\Menu::class)): ?>
                                                <th scope="col">وضعیت</th>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(['delete','update'],\App\Models\Menu::class )): ?>
                                                <th scope="col">عملیات</th>
                                            <?php endif; ?>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <tr id="menu_<?php echo e($menu->id); ?>">
                                                <td>
                                                    <?php echo e($menu->id); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($menu->name); ?>

                                                </td>
                                                <td>

                                                    <img class="image_menu"
                                                         src="<?php echo e(asset($menu->logo_image)); ?>" alt="">

                                                </td>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update',\App\Models\Menu::class)): ?>
                                                    <td>

                                                        <div class="form-check form-switch">
                                                            <input onchange="changeStatus(this)"
                                                                   data-action="<?php echo e(route('menu.changeStatus',$menu->id)); ?>"
                                                                   data-status="<?php echo e($menu->status); ?>"
                                                                   <?php echo e($menu->status==1 ?  "checked" : " "); ?>

                                                                   class="form-check-input status_menu" type="checkbox"
                                                                   id="mySwitch"
                                                                   name="darkmode"
                                                                   value="1">
                                                        </div>

                                                    </td>
                                                <?php endif; ?>
                                                <td>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update',\App\Models\Menu::class)): ?>
                                                        <button type="button" class="btn btn-primary"
                                                                onclick="editMenu(this)"
                                                                data-name-menu="<?php echo e($menu->name); ?>"
                                                                data-image-src="<?php echo e($menu->logo_image); ?>"
                                                                data-action="<?php echo e(route('menu.update',$menu->id)); ?>"
                                                                data-description="<?php echo e($menu->description); ?>"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editMenu"
                                                                data-title="ویرایش نام منو "
                                                                data-toggle="tooltip">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                    <?php echo method_field('PUT'); ?>

                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete',\App\Models\Menu::class)): ?>
                                                        <button type="button" class="btn btn-danger"
                                                                data-toggle="tooltip"
                                                                data-title="حذف منو"
                                                                data-action="<?php echo e(route('menu.destroy',$menu->id)); ?>"
                                                                onclick="deleteMenu(this)">
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


    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    


    //add menue
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
                        <input id="menuName" name="" type="text" class="form-control ">
                    </div>
                    <div class="mb-3 col-12">
                        <label class="form-label">توضیحات خود را وارد کنید</label>
                        <div>
                            <div id="editorDescription">

                            </div>

                        </div>


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
    //edit menu
    <div class="modal fade " id="editMenu" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ویرایش منو</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3 col-12">
                        <label for="formrow-firstname-input" class="form-label">نام منو </label>
                        <input id="menuNameEdit" name="" type="text" class="form-control ">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">توضیحات خود را وارد کنید</label>
                        <div>
                            <div id="menuDescEdit">

                            </div>

                        </div>
                    </div>
                    <div class="form-group  mb-3 col-12">

                        <input type="file" id="image_upload_edit" name="photo" class="form-control">

                        <span class="text-danger" id="image-input-error"></span>
                        <div class="imageEdit">
                            <img id="menuImageEdit" src="" alt="">
                        </div>

                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    <div>
                        <button id="updateMenu" onclick="updateMenu(this)"
                                data-action="" type="button"
                                class="btn btn-primary btn-success updateMenu w-md">ویرایش کردن
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH I:\Projects\reservasion\resources\views/admin/manage/menu/index.blade.php ENDPATH**/ ?>