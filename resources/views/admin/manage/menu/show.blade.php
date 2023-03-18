@extends('admin.layouts.master')

@section('script')
    <script src="{{asset('assets\libs\jquery.repeater\jquery.repeater.min.js')}}"></script>

    <script src="{{asset('assets\js\pages\form-repeater.int.js')}}"></script>


    {{--    <script>--}}
    {{--        $('.parents').select2();--}}
    {{--    </script>--}}


@endsection
@section('content')


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                @can('create',\App\Models\Menu::class)
                                    <div class="text-end">
                                        <button class="btn btn-success  waves-effect waves-light" data-bs-toggle="modal"
                                                data-bs-target="#addMenu">اضافه کردن منو
                                        </button>
                                    </div>
                                @endcan
                                <h4 class="card-title mb-0">منو ها</h4>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="mt-4">
                                            @foreach($menu as $item)

                                                <div class="accordion" id="accordion_{{$item->id}}"
                                                     data-id="{{$item->id}}">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="heading_{{$item->id}}">
                                                            <button class="accordion-button fw-medium collapsed"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#collapse_{{$item->id}}"
                                                                    aria-expanded="false"
                                                                    aria-controls="collapse_{{$item->id}}">
                                                                {{$item->name}}
                                                            </button>
                                                        </h2>
                                                        <div id="collapse_{{$item->id}}"
                                                             class="accordion-collapse collapse"
                                                             aria-labelledby="heading_{{$item->id}}"
                                                             data-bs-parent="#accordion1">
                                                            <div class="accordion-body">
                                                                <div class="text-muted">
                                                                    <div class="row">
                                                                        <div class="col-12">

                                                                            <div class="card">
                                                                                <div class="card-body">

                                                                                    <form data-add-menu-item
                                                                                          class="repeater"
                                                                                          action="{{route('menu.addItem',$item->id)}}"
                                                                                          method="post"
                                                                                          enctype="multipart/form-data">
                                                                                        <div class="js-items-list">
                                                                                            @include('admin.manage.menu.ajax.items-list',['items_list'=>$item->MenuItem])
                                                                                        </div>
                                                                                        <br>
                                                                                        @can('create',\App\Models\MenuItem::class)
                                                                                            <h6 class="text-primary">زیر
                                                                                                منو
                                                                                                جدید را اضافه کنید</h6>
                                                                                            <hr>

                                                                                            <div
                                                                                                data-repeater-list="group-{{ $item->id}}">
                                                                                                <div
                                                                                                    data-repeater-item="{{ $item->id }}"
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
                                                                                                                data-menuItem="{{$item->id}}"
                                                                                                                style="width: 100%;"
                                                                                                                name="parent_id"
                                                                                                                class="form-control ">
                                                                                                                <option
                                                                                                                    value="">
                                                                                                                    مادر
                                                                                                                </option>
                                                                                                                @foreach($item->parents as $parent)
                                                                                                                    <option
                                                                                                                        value="{{ $parent->id }}">
                                                                                                                        {{ $parent->title }}</option>
                                                                                                                @endforeach
                                                                                                            </select>
                                                                                                        </div>
                                                                                                        @can('delete',\App\Models\MenuItem::class)
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
                                                                                                        @endcan
                                                                                                    </div>
                                                                                                </div>

                                                                                            </div>
                                                                                            @csrf
                                                                                            <button
                                                                                                class=" btn btn-primary waves-effect waves-light "
                                                                                                type="submit">ثبت آیتم
                                                                                            </button>

                                                                                            <input
                                                                                                data-repeater-create="{{ $item->id }}"
                                                                                                type="button"
                                                                                                class="btn btn-success mt-3 mt-lg-0"
                                                                                                value="اضافه کردن ایتم">
                                                                                        @endcan
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
                                        @endforeach



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
                        <button data-update-role data-action="{{route('menu.store')}}" onclick="addNewMenu(this)"
                                data-action="" type="button"
                                class="btn btn-success w-md">اضافه کردن
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
