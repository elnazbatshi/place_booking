@extends('admin.layouts.master')
@section('styleCss')


@endsection
@section('script')
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

@endsection
@section('content')

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
                                {{--                                <button class="btn btn-success waves-effect waves-light mt-2"--}}
                                {{--                                        data-bs-toggle="modal"--}}

                                {{--                                        data-bs-target=".bs-insert-modal-center">اضافه کردن منو--}}
                                {{--                                </button>--}}
                                @can('create',\App\Models\Category::class)
                                    <button class="btn btn-success  waves-effect waves-light" data-bs-toggle="modal"
                                            data-bs-target="#addCat">اضافه کردن دسته بندی
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
                                            <th scope="col">نوع دسته بندی</th>
                                            <th scope="col">عکس</th>
                                            @canany(['delete','update'],\App\Models\Category::class )
                                                <th scope="col">عملیات</th>
                                            @endcan
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($category as $cat)
                                            <tr id="cat_{{$cat->id}}">
                                                <td>
                                                    {{$cat->id}}
                                                </td>
                                                <td>
                                                    {{$cat->title}}
                                                </td>
                                                <td>
                                                    {{$cat->type->name}}
                                                </td>

                                                <td>
                                                    <img style="max-width:70px;" src="{{@$cat->img_src}}" alt="">
                                                </td>
                                                <td>
                                                    @can('update',\App\Models\Category::class)
                                                        <button type="button" class="btn btn-primary"
                                                                onclick="editCategory(this)"
                                                                data-title="{{$cat->title}}"
                                                                data-type-id="{{$cat->type_id}}"
                                                                data-img-src="{{$cat->img_src}}"
                                                                data-action="{{route('category.update',$cat->id)}}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editCategory"
                                                                data-toggle="tooltip">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    @endcan
                                                    @method('PUT')

                                                    @can('delete',\App\Models\Category::class)
                                                        <button type="button" class="btn btn-danger"
                                                                data-toggle="tooltip"
                                                                data-title="حذف منو"
                                                                data-action="{{route('category.destroy',$cat->id)}}"
                                                                onclick="deleteCategory(this)">
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

    {{--    add User--}}
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
                            @foreach($typeCat as $Tcat)
                                <option value="{{$Tcat->id}}">{{$Tcat->name}}</option>

                            @endforeach
                        </select>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    <div>
                        <button data-update-role onclick="addCategoryPost(this)"
                                data-action="{{route('category.store')}}" type="button"
                                class="btn btn-success w-md">اضافه کردن
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    edit editCategory--}}
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
                            @foreach($typeCat as $Tcat)
                                <option value="{{$Tcat->id}}">{{$Tcat->name}}</option>
                            @endforeach
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

@endsection
