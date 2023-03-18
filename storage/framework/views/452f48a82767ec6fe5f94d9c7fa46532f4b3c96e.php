<?php $__env->startSection('styleCss'); ?>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>

        $('#addRoleToUser').select2();
        $('#editRoleToUser').select2();

        function editUser(sender) {
            $data = $(sender).data('data');
            $('#nameEdit').val($data['name']);
            $('#emailEdit').val($data['email']);
            let selectedRole = [];
            $data['roles'].forEach((roles) => {
                selectedRole.push(roles.id);
            });
            $('#update-user-btn').attr('data-action', $(sender).data('action'));
            $('.rolesEdit').val(selectedRole);
            $('.rolesEdit').trigger("change");

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
                            <h4 class="mb-sm-0 font-size-18">مدیریت کاربران</h4>

                            <div class="page-title-left">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">پنل</a></li>
                                    <li class="breadcrumb-item active">مدیریت کاربران</li>
                                </ol>
                                
                                

                                
                                
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create',\App\Models\User::class)): ?>
                                    <button class="btn btn-success  waves-effect waves-light" data-bs-toggle="modal"
                                            data-bs-target="#addUser">اضافه کردن کاربر
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
                                            <th scope="col">ایمیل</th>
                                            <th scope="col">نقش</th>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(['delete','update'],\App\Models\User::class)): ?>
                                                <th scope="col">عملیات</th>
                                            <?php endif; ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                                            <tr id="user_<?php echo e($user->id); ?>">
                                                <td>
                                                    <?php echo e($user->id); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($user->name); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($user->email); ?>

                                                </td>
                                                <td>
                                                    <?php $__currentLoopData = $user->getRoleNames(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roleName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <span class="badge bg-primary font-size-large">
                                                                  <?php echo e($roleName); ?>

                                                        </span>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </td>


                                                <td>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update',\App\Models\User::class)): ?>
                                                        <button type="button" class="btn btn-primary"
                                                                onclick="editUser(this)"
                                                                data-data="<?php echo e($user); ?>"
                                                                data-pass="<?php echo e($user->password); ?>"
                                                                data-action="<?php echo e(route('user.update',$user->id)); ?>"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#updateUser">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete',\App\Models\User::class)): ?>
                                                        <button type="button" class="btn btn-danger"
                                                                data-toggle="tooltip"
                                                                data-title="حذف منو"
                                                                data-action="<?php echo e(route('user.destroy',$user->id)); ?>"

                                                                onclick="deleteUser(this)">
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

    //add User
    <div class="modal fade " id="addUser" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">اضافه کردن کاربر</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3 col-12">
                        <label for="formrow-firstname-input" class="form-label">نام </label>
                        <input id="name" name="" type="text" class="form-control edit-role">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="email" class="form-label">ایمیل </label>
                        <input id="email" name="email" type="email" class="form-control edit-role">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="password" class="form-label">پسورد </label>
                        <div style="flex-wrap: revert" class="input-group auth-pass-inputgroup d-flex">
                            <input id="password" name="password" type="password" class="form-control"
                                   aria-label="Password" aria-describedby="password-addon">
                            <button class="btn btn-light " type="button" id="password-addon"><i
                                    class="mdi mdi-eye-outline"></i></button>
                        </div>

                    </div>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create',\App\Models\Role::class)): ?>
                        <label for="roles" class="form-label">نقش ها </label>
                        <select name="roles" style="width: 100%" id="addRoleToUser" class="form-control" multiple>

                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($role->id); ?>">
                                    <?php echo e($role->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    <div>
                        <button data-update-role onclick="addUser(this)"
                                data-action="<?php echo e(route('user.store')); ?>" type="button"
                                class="btn btn-success w-md">اضافه کردن
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    //edit user
    <div class="modal fade " id="updateUser" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ویرایش کردن کاربر</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3 col-12">
                        <label for="formrow-firstname-input" class="form-label">نام </label>
                        <input id="nameEdit" name="" type="text" class="form-control edit-role">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="email" class="form-label">ایمیل </label>
                        <input id="emailEdit" name="email" type="email" class="form-control edit-role">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="password" class="form-label">پسورد </label>
                        <div style="flex-wrap: revert" class="input-group auth-pass-inputgroup d-flex">
                            <input id="passwordEdit" name="password" type="password" class="form-control"
                                   aria-label="Password" aria-describedby="password-addon">
                            <button class="btn btn-light " type="button" id="password-addon"><i
                                    class="mdi mdi-eye-outline"></i></button>
                        </div>

                    </div>
                    <label for="roles" class="form-label">نقش ها </label>
                    <select name="rolesEdit" style="width: 100%" id="editRoleToUser" class="form-control   rolesEdit"
                            multiple>

                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($role->id); ?>">
                                <?php echo e($role->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    <div>
                        <button id="update-user-btn" data-update-role onclick="updateUser(this)"
                                data-action="" type="button"
                                class="btn btn-success w-md">ویرایش کردن
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH I:\Projects\booking2\resources\views/admin/manage/user/index.blade.php ENDPATH**/ ?>