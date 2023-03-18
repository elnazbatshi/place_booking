@extends('admin.layouts.master')
@section('styleCss')


@endsection
@section('script')
    <script>
        function editCustomer(sender) {
            var data = $(sender).data('data');
            $('#name_edit').val(data.name);
            $('#email_edit').val(data.email);
            $('#mobile_edit').val(data.mobile_number);
            $('#phone_edit').val(data.phone);
            $('#personalId_edit').val(data.personal_id);
            $('#department_edit').val(data.department);
            $('#update-user-btn').attr('data-action', $(sender).data('action'));
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
                            <h4 class="mb-sm-0 font-size-18">مدیریت مشتریان</h4>

                            <div class="page-title-left">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">پنل</a></li>
                                    <li class="breadcrumb-item active">مدیریت مشتریان</li>
                                </ol>
                                {{--                                <button class="btn btn-success waves-effect waves-light mt-2"--}}
                                {{--                                        data-bs-toggle="modal"--}}

                                {{--                                        data-bs-target=".bs-insert-modal-center">اضافه کردن منو--}}
                                {{--                                </button>--}}
                                @can('create',\App\Models\User::class)
                                    <button class="btn btn-success  waves-effect waves-light" data-bs-toggle="modal"
                                            data-bs-target="#addCustomer">اضافه کردن مشتریان
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
                                            <th scope="col">شماره داخلی</th>
                                            <th scope="col">مبایل</th>
                                            <th scope="col">بخش</th>
                                            <th scope="col">عملیات</th>
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
                                                    {{$user->phone}}
                                                </td>
                                                <td>
                                                    {{$user->mobile_number}}
                                                </td>

                                                <td>
                                                    {{$user->department}}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary"
                                                            onclick="editCustomer(this)"
                                                            data-data="{{$user}}"
                                                            data-pass="{{$user->password}}"
                                                            data-action="{{route('customer.update',$user->id)}}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#updateCustomer">
                                                        <i class="fa fa-edit"></i>

                                                    </button>
                                                    <button type="button" class="btn btn-danger"
                                                            data-toggle="tooltip"
                                                            data-title="حذف منو"
                                                            data-action="{{route('customer.destroy',$user->id)}}"

                                                            onclick="deleteCustomer(this)">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
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
    <div class="modal fade " id="addCustomer" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافه کردن مشتری</h5>
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
                        <label for="personal_id" class="form-label">کد کاربری </label>
                        <input id="personal_id" name="personal_id" type="email" class="form-control edit-role">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="mobile_number" class="form-label">شماره مبایل </label>
                        <input id="mobile_number" name="mobile_number" type="text" class="form-control edit-role">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="phone" class="form-label">شماره تلفن </label>
                        <input id="phone" name="phone" type="text" class="form-control edit-role">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="department" class="form-label">واحد مربوطه</label>
                        <input id="department" name="department" type="text" class="form-control edit-role">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    <div>
                        <button data-update-role onclick="addCustomer(this)"
                                data-action="{{route('customer.store')}}" type="button"
                                class="btn btn-success w-md">اضافه کردن
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    //edit user
    <div class="modal fade " id="updateCustomer" aria-labelledby="exampleModalLabel"
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
                        <input id="name_edit" name="" type="text" class="form-control edit-role">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="email" class="form-label">ایمیل </label>
                        <input id="email_edit" name="email" type="email" class="form-control edit-role">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="personal_id" class="form-label">کد کاربری </label>
                        <input id="personalId_edit" name="personal_id" type="email" class="form-control edit-role">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="mobile_number" class="form-label">شماره مبایل </label>
                        <input id="mobile_edit" name="email_edite" type="text" class="form-control edit-role">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="phone" class="form-label">شماره تلفن </label>
                        <input id="phone_edit" name="phone" type="text" class="form-control edit-role">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="department" class="form-label">واحد مربوطه</label>
                        <input id="department_edit" name="department" type="text" class="form-control edit-role">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="password" class="form-label">پسورد </label>
                        <div style="flex-wrap: revert" class="input-group auth-pass-inputgroup d-flex">
                            <input id="password_edit" name="password" type="password" class="form-control"
                                   aria-label="Password" aria-describedby="password-addon">
                            <button class="btn btn-light " type="button" id="password-addon"><i
                                    class="mdi mdi-eye-outline"></i></button>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    <div>
                        <button id="update-user-btn" data-update-role onclick="updateCustomer(this)"
                                data-action="" type="button"
                                class="btn btn-success w-md">ویرایش کردن
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
