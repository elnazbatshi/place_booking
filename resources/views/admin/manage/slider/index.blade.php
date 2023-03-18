@extends('admin.layouts.master')
@section('styleCss')


@endsection
@section('script')
    <script>
        @if(session()->has('post_flash'))
            toastr["success"]('{{session()->get('post_flash')}}');
        @endif
        // function editPost(sender){
        //     var action=$(sender).attr("data-action");
        //
        //
        //     $.ajax({
        //         url: action,
        //         type: "get",
        //         dataType: "JSON",
        //         success(response) {
        //             console.log(response);
        //             if (response.status == true) {
        //              var post=response.post;
        //
        //
        //
        //
        //
        //             } else {
        //                 toastr["error"]('خطا در ارتباط با سرور! دوباره امتحان کنید')
        //             }
        //         },
        //         error(error) {
        //             if (error.status == 422) {
        //                 console.log(error);
        //             }
        //         },
        //     });
        //
        //
        // }

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
                            <h4 class="mb-sm-0 font-size-18">مدیریت اسلایدر ها</h4>

                            <div class="page-title-left">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">پنل</a></li>
                                    <li class="breadcrumb-item active">مدیریت اسلایدر ها</li>
                                </ol>


                                <a href="{{route('slider.create')}}">
                                    <button class="btn btn-success">اضافه کردن اسلایدر
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
                                            <th scope="col"> دسته بندی</th>
                                            <th scope="col">عکس شاخص</th>
                                            <th scope="col">عملیات</th>

                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($sliders as $slider)


                                            <tr id="slider_{{$slider->id}}">
                                                <td>
                                                    {{$slider->id}}
                                                </td>
                                                <td>
                                                    {{$slider->title}}
                                                </td>
                                                <td>
                                                    @foreach($slider->categories as $category)
                                                        <span class="badge bg-success font-size-large">
                                                           {{$category->title}}
                                                    </span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <img style="width: 50px" src="{{$slider->img_src}}" alt="">
                                                </td>


                                                <td>
                                                    <a href="{{route('slider.edit',$slider->id)}}">
                                                        <button type="button" class="btn btn-primary"
                                                                data-title="ویرایش اسلایدر"
                                                                data-action="{{route('slider.edit',$slider->id)}}">

                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    </a>

                                                    <button type="button" class="btn btn-danger" data-toggle="tooltip"
                                                            data-title="حذف اسلایدر"
                                                            data-action="{{route('slider.destroy',$slider->id)}}"

                                                            onclick="deleteSlider(this)">
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



@endsection
