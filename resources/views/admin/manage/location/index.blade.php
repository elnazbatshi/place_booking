@extends('admin.layouts.master')
@section('styleCss')


@endsection
@section('script')
    {{--    <script>--}}
    {{--        @if(session()->has('post_flash'))--}}
    {{--            toastr["success"]('{{session()->get('post_flash')}}');--}}
    {{--        @endif--}}

    {{--    </script>--}}

@endsection
@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">مدیری مکان ها </h4>

                            <div class="page-title-left">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">پنل</a></li>
                                    <li class="breadcrumb-item active">مدیریت مکان ها</li>
                                </ol>
                                <a href="{{route('location.create')}}">
                                    <button class="btn btn-success">اضافه کردن مکان ها
                                    </button>
                                </a>
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
                                            <th scope="col">عنوان</th>
                                            <th scope="col">ظرفیت</th>
                                            <th scope="col">تلفن</th>
                                            <th scope="col"> دسته بندی</th>
                                            <th scope="col">عکس شاخص</th>
                                            <th scope="col">وضعیت</th>
                                            <th scope="col">عملیات</th>


                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($posts as $post)


                                            <tr id="location_{{$post->id}}">
                                                <td>
                                                    {{$post->id}}
                                                </td>
                                                <td>
                                                    {{$post->name}}
                                                </td>
                                                <td>
                                                    {{$post->index}}
                                                </td>
                                                <td>
                                                    {{$post->phone}}
                                                </td>
                                                <td>
                                                        <span class="badge bg-success font-size-large">
                                                               {{$post->categories->title}}
                                                        </span>
                                                </td>

                                                <td>

{{--                                                    @if(count($post->image) > 0)--}}
{{--                                                    @foreach(explode(',',$post->image) as $img)--}}
{{--                                                    <img style="width: 50px" src="{{$img}}" alt="">--}}
{{--                                                    @endforeach--}}
{{--                                                    @endif--}}
                                                </td>
                                                <td>
                                                    <select style="width: 85px"
                                                            onchange="changeStatusPost(this)"
                                                            data-action="{{route('location.changeStatus',$post->id)}}"
                                                            name="status" data-toggle="tooltip" data-placement="top"

                                                            class="form-select statusPost">
                                                        <option
                                                            @if(isset($post)) {{($post->status ==\App\Models\LocationInfo::STATUS_ACTIVE) ?'selected=selected':" "}}@endif  value="{{\App\Models\LocationInfo::STATUS_ACTIVE}}">
                                                            فعال
                                                        </option>
                                                        <option
                                                            @if(isset($post)) {{($post->status ==\App\Models\LocationInfo::STATUS_DEACTIVATE) ?'selected=selected':" "}}@endif  value="{{\App\Models\LocationInfo::STATUS_DEACTIVATE}}">
                                                            غیر فعال
                                                        </option>
                                                    </select>
                                                </td>

                                                <td>
                                                    <a>
                                                        <a href="{{route('location.edit',$post->id)}}">
                                                            <button type="button" class="btn btn-primary">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                        </a>
                                                    </a>
                                                    <button type="button" class="btn btn-danger"
                                                            data-toggle="tooltip"
                                                            data-title="حذف منو"
                                                            data-action="{{route('location.destroy',$post->id)}}"
                                                            onclick="deleteLocation(this)">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-warning"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#showLocation"
                                                            data-title="دیدن مکان"
                                                            onclick="showLocation(this)"
                                                            data-action="{{route('location.show',$post->id)}}">
                                                        <i class="fa fa-eye"></i>
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






    <div class="modal  fade " id="showLocation" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <h6>تصاویر</h6>
                                <div>
                                    <span>وضعیت:</span>
                                    <span class="badge set-status  font-size-large"></span>
                                </div>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">X</button>
                            </div>

                            <hr>
                            <div class=" mb-4">
                                <img class="mx-2" style="height: 100px"
                                     src="{{asset('assets/images/profile-img.png')}}">
                                <img class="mx-2" style="height: 100px"
                                     src="{{asset('assets/images/small/img-1.jpg')}}">
                            </div>
                        </div>
                        <hr>
                        <div class="col-12">
                            <h6>توضیحات</h6>
                            <hr>
                            <div class=" mb-4">
                                <h6 id="nameShow">

                                </h6>
                                <p id="descShow">

                                </p>
                            </div>
                        </div>

                        <div class="col-12">
                            <h6>فایل ها و ویدیو ها</h6>
                            <hr>
                            <div class="icons-dl mb-4">


                            </div>
                        </div>
                        <div class="row">

                            <hr>
                            <div class="col-6 mt-3 d-flex">
                                <h6 class="text-primary bold">
                                    آدرس :
                                </h6>
                                <span>
                                     حوزه هنری طبقه دوم
                                </span>
                            </div>
                            <div class="col-6 mt-3 d-flex">
                                <h6 class="text-primary bold">
                                    شماره تلفن :
                                </h6>
                                <span>
                                   02188893124
                                </span>
                            </div>
                            <div class="col-6 mt-3 d-flex">
                                <h6 class="text-primary bold">
                                    دسته بندی :
                                </h6>
                                <span>
                                    گالری
                                </span>
                            </div>
                            <div class="col-6 mt-3 d-flex">
                                <h6 class="text-primary bold">
                                    ظرفیت :
                                </h6>
                                <span>
                                 970 نفر
                                </span>
                            </div>

                        </div>


                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                </div>
            </div>
        </div>
    </div>






@endsection
