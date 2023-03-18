@extends('admin.layouts.master')
@section('styleCss')
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

@endsection
@section('scriptPre')
    @include('admin.js.ckeditor',['command'=>'menu'])
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

@endsection
@section('content')
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
                                {{--                                <button class="btn btn-success waves-effect waves-light mt-2"--}}
                                {{--                                        data-bs-toggle="modal"--}}

                                {{--                                        data-bs-target=".bs-insert-modal-center">اضافه کردن منو--}}
                                {{--                                </button>--}}
                                @can('create',\App\Models\Menu::class)
                                    <button class="btn btn-success  waves-effect waves-light" data-bs-toggle="modal"
                                            data-bs-target="#addMenu">اضافه کردن منو
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
                                            <th scope="col">لوگو</th>
                                            @can( 'update',\App\Models\Menu::class)
                                                <th scope="col">وضعیت</th>
                                            @endcan
                                            @can(['delete','update'],\App\Models\Menu::class )
                                                <th scope="col">عملیات</th>
                                            @endcan
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($menus as $menu)

                                            <tr id="menu_{{$menu->id}}">
                                                <td>
                                                    {{$menu->id}}
                                                </td>
                                                <td>
                                                    {{$menu->name}}
                                                </td>
                                                <td>

                                                    <img class="image_menu"
                                                         src="{{asset($menu->logo_image)}}" alt="">

                                                </td>
                                                @can('update',\App\Models\Menu::class)
                                                    <td>

                                                        <div class="form-check form-switch">
                                                            <input onchange="changeStatus(this)"
                                                                   data-action="{{route('menu.changeStatus',$menu->id)}}"
                                                                   data-status="{{$menu->status}}"
                                                                   {{$menu->status==1 ?  "checked" : " "}}
                                                                   class="form-check-input status_menu" type="checkbox"
                                                                   id="mySwitch"
                                                                   name="darkmode"
                                                                   value="1">
                                                        </div>

                                                    </td>
                                                @endcan
                                                <td>
                                                    @can('update',\App\Models\Menu::class)
                                                        <button type="button" class="btn btn-primary"
                                                                onclick="editMenu(this)"
                                                                data-name-menu="{{$menu->name}}"
                                                                data-image-src="{{$menu->logo_image}}"
                                                                data-action="{{route('menu.update',$menu->id)}}"
                                                                data-description="{{$menu->description}}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editMenu"
                                                                data-title="ویرایش نام منو "
                                                                data-toggle="tooltip">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    @endcan
                                                    @method('PUT')

                                                    @can('delete',\App\Models\Menu::class)
                                                        <button type="button" class="btn btn-danger"
                                                                data-toggle="tooltip"
                                                                data-title="حذف منو"
                                                                data-action="{{route('menu.destroy',$menu->id)}}"
                                                                onclick="deleteMenu(this)">
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


    {{--    <div class="modal fade bs-insert-modal-center" tabindex="-1" role="dialog" aria-hidden="true">--}}
    {{--        <div class="modal-dialog modal-dialog-centered">--}}
    {{--            <div class="modal-content">--}}
    {{--                <div class="modal-header">--}}
    {{--                    <h5 class="modal-title">منوی تازه</h5>--}}
    {{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
    {{--                </div>--}}
    {{--                <div class="modal-body">--}}
    {{--                    <div class="row mb-4">--}}
    {{--                        <label for="horizontal-fname-input" class="col-sm-3 col-form-label">نام منو</label>--}}
    {{--                        <div class="col-sm-9">--}}
    {{--                            <input type="text" class="form-control" id="horizontal-name-input">--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="row mb-4">--}}
    {{--                        <label for="horizontal-link-input" class="col-sm-3 col-form-label">لینک</label>--}}
    {{--                        <div class="col-sm-9">--}}
    {{--                            <input type="text" class="form-control" id="horizontal-link-input">--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="row mb-4">--}}
    {{--                        <label for="horizontal-index-input" class="col-sm-3 col-form-label">ترتیب</label>--}}
    {{--                        <div class="col-sm-9">--}}
    {{--                            <input type="text" class="form-control" id="horizontal-index-input">--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="row mb-4">--}}
    {{--                        <label for="horizontal-icon-input" class="col-sm-3 col-form-label">آیکون</label>--}}
    {{--                        <div class="col-sm-9">--}}
    {{--                            <input type="text" class="form-control" id="horizontal-icon-input">--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="row mb-4">--}}
    {{--                        <label for="horizontal-parent-input" class="col-sm-3 col-form-label">والد</label>--}}
    {{--                        <div class="col-sm-9">--}}
    {{--                            <select class="form-control" id="horizontal-parent-input">--}}
    {{--                                <option value="">نمونه</option>--}}
    {{--                            </select>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}

    {{--                    <div class="row justify-content-end">--}}
    {{--                        <div class="col-sm-9">--}}
    {{--                            <div class="text-end">--}}
    {{--                                <button type="submit" class="btn btn-success w-md ">اضافه کردن منو جدید</button>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div><!-- /.modal-content -->--}}
    {{--        </div><!-- /.modal-dialog -->--}}
    {{--    </div><!-- /.modal -->--}}


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
                        <button data-update-role data-action="{{route('menu.store')}}" onclick="addNewMenu(this)"
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

@endsection
