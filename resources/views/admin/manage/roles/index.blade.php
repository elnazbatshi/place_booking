@extends('admin.layouts.master')

@section('styleCss')


@endsection
@section('script')


    <script>
        $('.edit-permissions').select2();

        $('#addPermissionToRole').select2();

        function viewEditRoleModal(sender, permissions) {
            $('.edit-role').empty();

            $('[data-update-role]').attr('data-action', $(sender).data('action'));

            $roleName = $(sender).data("roleName");
            $roleId = $(sender).data("roleId");
            $('.edit-role').val($roleName);
            let selectedPermissions = [];
            permissions.forEach((permission) => {
                selectedPermissions.push(permission.id);
            });

            $('.edit-permissions').val(selectedPermissions);
            $('.edit-permissions').trigger("change");
        }


    </script>
@endsection

@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">لیست مجوز ها </h4>

                            <div class="page-title-left">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">داشبورد</a></li>
                                    <li class="breadcrumb-item active">لیست مجوز ها</li>
                                </ol>
                            </div>
                            @can('create',\App\Models\Role::class)
                                <div class="page-title-left">
                                    <button class="btn btn-success  waves-effect waves-light" data-bs-toggle="modal"
                                            data-bs-target="#addRole">اضافه کردن نقش
                                    </button>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">


                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                    <tr>
                                        <th>ردیف</th>
                                        <th>نام</th>
                                        <th>مجوزها</th>
                                        <th></th>
                                    </tr>
                                    </thead>


                                    <tbody>


                                    @foreach ($roles as $role)

                                        <tr id="role_{{ $role->id }}">
                                            <td>{{ $role->id }}</td>
                                            <td class="font-weight-bold text-nowrap">
                                                {{ $role->name }}
                                            </td>
                                            <td class="role-permissions-list">
                                                @foreach ($role->permissions as $permission)
                                                    <span
                                                        data_permissions="{{ $permission->id }}"
                                                        data-id="{{ $permission->id }}"
                                                        data-title="{{ __('permissions.' . $permission->name) }}"
                                                        data-toggle="tooltip"
                                                        class="badge bg-primary font-size-large"> {{ __('permissions.' . $permission->name) }}
                                                    </span>

                                                @endforeach
                                            </td>
                                            <td class="text-right text-nowrap">
                                                @can('update',\App\Models\Role::class)


                                                    <button type="button" class="btn btn-primary"
                                                            onclick="viewEditRoleModal(this,{{ $role->permissions }})"
                                                            data-role-name="{{ $role->name }}"
                                                            data-role-id="{{ $role->id }}"
                                                            data-action="{{route('admin.manage.roles.update', ['role' => $role->id])}}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editeRole"
                                                            data-title="ویرایش نقش ها"
                                                            data-toggle="tooltip">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                @endcan
                                                @can('delete',\App\Models\Role::class)
                                                    <button type="button" class="btn btn-danger" data-toggle="tooltip"
                                                            data-title="حذف نقش"
                                                            data-action="{{route('admin.manage.roles.delete', ['role' => $role->id])}}"
                                                            onclick="deleteRole(this)">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->


            </div> <!-- container-fluid -->
        </div>

        @can('update role')
            <div class="modal fade " id="editeRole" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ویرایش نقش ها</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="formrow-firstname-input" class="form-label">نقش </label>
                                <input id="role" name="role" type="text" class="form-control edit-role">
                            </div>
                            <div class="mb-3">
                                <label for="formrow-firstname-input" class="form-label">مجوز ها </label>
                                <select style="width: 100%" id="permission" class="form-control edit-permissions"
                                        multiple>
                                    @foreach ($permissions as $permission)
                                        <option value="{{ $permission->id }}">
                                            {{ trans('permissions.'.$permission->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                            <div>
                                <button data-update-role onclick="updateRole(this)" data-action="" type="button"
                                        class="btn btn-primary w-md">ویرایش
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan


        <div class="modal fade " id="addRole" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">اضافه کردن نقش ها</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3 col-12">
                            <label for="formrow-firstname-input" class="form-label">نقش </label>
                            <input id="roleName" name="roleName" type="text" class="form-control edit-role">
                        </div>
                        <div class="mb-3 col-12">
                            <label for="formrow-firstname-input" class="form-label">مجوز ها </label>
                            <br>
                            <select style="width: 100%" id="addPermissionToRole" class="form-control" multiple>

                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->id }}">
                                        {{ trans('permissions.'.$permission->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                        <div>
                            <button data-update-role data-action="{{route('admin.manage.roles.store')}}"
                                    onclick="addNewRole(this)" data-action="" type="button"
                                    class="btn btn-success w-md">اضافه کردن
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
