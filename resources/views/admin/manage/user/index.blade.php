@extends('admin.layouts.master')
@section('styleCss')


@endsection
@section('script')
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
@endsection
@section('content')
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
                                {{--                                <button class="btn btn-success waves-effect waves-light mt-2"--}}
                                {{--                                        data-bs-toggle="modal"--}}

                                {{--                                        data-bs-target=".bs-insert-modal-center">اضافه کردن منو--}}
                                {{--                                </button>--}}
                                @can('create',\App\Models\User::class)
                                    <button class="btn btn-success  waves-effect waves-light" data-bs-toggle="modal"
                                            data-bs-target="#addUser">اضافه کردن کاربر
                                    </button>
                                @endcan
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
                                            @can(['delete','update'],\App\Models\User::class)
                                                <th scope="col">عملیات</th>
                                            @endcan
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)


                                            <tr id="user_{{$user->id}}">
                                                <td>
                                                    {{$user->id}}
                                                </td>
                                                <td>
                                                    {{$user->name}}
                                                </td>
                                                <td>
                                                    {{$user->email}}
                                                </td>
                                                <td>
                                                    @foreach($user->getRoleNames() as $roleName)
                                                        <span class="badge bg-primary font-size-large">
                                                                  {{$roleName}}
                                                        </span>

                                                    @endforeach
                                                </td>


                                                <td>
                                                    @can('update',\App\Models\User::class)
                                                        <button type="button" class="btn btn-primary"
                                                                onclick="editUser(this)"
                                                                data-data="{{$user}}"
                                                                data-pass="{{$user->password}}"
                                                                data-action="{{route('user.update',$user->id)}}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#updateUser">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    @endcan
                                                    @can('delete',\App\Models\User::class)
                                                        <button type="button" class="btn btn-danger"
                                                                data-toggle="tooltip"
                                                                data-title="حذف منو"
                                                                data-action="{{route('user.destroy',$user->id)}}"

                                                                onclick="deleteUser(this)">
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
                    @can('create',\App\Models\Role::class)
                        <label for="roles" class="form-label">نقش ها </label>
                        <select name="roles" style="width: 100%" id="addRoleToUser" class="form-control" multiple>

                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    @endcan
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    <div>
                        <button data-update-role onclick="addUser(this)"
                                data-action="{{route('user.store')}}" type="button"
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

                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">
                                {{ $role->name }}
                            </option>
                        @endforeach
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

@endsection
