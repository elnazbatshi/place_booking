@extends('admin.layouts.master')
@section('styleCss')

@endsection
@section('script')

@endsection
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">مدیریت فایل</h4>
                            <a href="{{route('elfinder.index')}}">upload</a>
                            <div class="page-title-left">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">پنل</a></li>
                                    <li class="breadcrumb-item active">مدیریت فایل ها</li>
                                </ol>

                                <button class="btn btn-success  waves-effect waves-light" data-bs-toggle="modal"
                                        data-bs-target="#addFile">اضافه کردن فایل
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap table-hover">
                                        <thead class="table-light">
                                        <tr>

                                            <th scope="col">شناسه</th>
                                            <th scope="col">نام فایل</th>
                                            <th scope="col">عملیات</th>

                                        </tr>
                                        </thead>
                                        <tbody>


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
    <div class="modal fade " id="addFile" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافه کردن فایل</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3 col-12">
                        <label for="formrow-firstname-input" class="form-label">نام فایل </label>
                        <input id="name" name="" type="text" class="form-control edit-role">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="formrow-firstname-input" class="form-label">فایل </label>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title"></h4>
                                        <div>
                                            <form action="#" class="dropzone">
                                                <div class="fallback">
                                                    <input name="file" type="file" multiple="multiple">
                                                </div>
                                                <div class="dz-message needsclick">
                                                    <div class="mb-3">
                                                        <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                                    </div>

                                                    <h4>Drop files here or click to upload.</h4>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="text-center mt-4">
                                            <button type="button" class="btn btn-primary waves-effect waves-light">Send
                                                Files
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                    </div>


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


                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    <div>
                        <button data-update-role onclick="updateUser(this)"
                                data-action="" type="button"
                                class="btn btn-success w-md">ویرایش کردن
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
