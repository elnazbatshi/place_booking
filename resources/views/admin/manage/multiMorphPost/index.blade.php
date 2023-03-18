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
    @switch($ctype)
        @case(4)
        <?php $ctypestr = 'برآیند'; ?>
        @break
        @case(5)
        <?php $ctypestr = 'نشست'; ?>
        @break
        @case(6)
        <?php $ctypestr = 'گفتمان'; ?>
        @break
        @case(7)
        <?php $ctypestr = 'اسناد پشتیبان'; ?>
        @break
        @case(8)
        <?php $ctypestr = 'رسانه'; ?>
        @break
        @default
        <?php $ctypestr = 'پست'; ?>
    @endswitch
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">مدیریت {{$ctypestr}} ها</h4>

                            <div class="page-title-left">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">پنل</a></li>
                                    <li class="breadcrumb-item active">مدیریت {{$ctypestr}}</li>
                                </ol>

                                @can('create',\App\Models\Post::class)
                                    <a href="{{route('multiMorphPost.create',['type'=>$ctype])}}">
                                        <button class="btn btn-success">اضافه کردن {{$ctypestr}}
                                        </button>
                                    </a>
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
                                            <th scope="col">عنوان</th>

                                            <th scope="col">تگ ها</th>
                                            <th scope="col"> دسته بندی</th>
                                            <th scope="col">عکس شاخص</th>
                                            <th scope="col"> حریم شخصی</th>
                                            <th scope="col">وضعیت</th>
                                            @can(['update','delete'],\App\Models\Post::class)
                                                <th scope="col">عملیات</th>
                                            @endcan

                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($posts as $post)


                                            <tr id="post_{{$post->id}}">
                                                <td>
                                                    {{$post->id}}
                                                </td>
                                                <td>
                                                    {{(strlen($post->title) > 20) ? mb_substr($post->title,0,20). "..." : mb_substr($post->title,0,20)  }}

                                                </td>

                                                <td>

                                                    @empty(!$post->tags)
                                                        @foreach($post->tags as $tag)
                                                            <span class="badge bg-primary font-size-large">
                                                                {{$tag}}
                                                            </span>
                                                        @endforeach
                                                    @endempty
                                                </td>
                                                <td>
                                                    @foreach($post->categories as $category)
                                                        <span class="badge bg-success font-size-large">
                                                           {{$category->title}}
                                                    </span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <img style="width: 50px" src="{{explode(',',$post->imageIndex)[0]}}"
                                                         alt="">
                                                </td>
                                                <td>
                                                    <select style="width: 85px"
                                                            onchange="changePrivacyMultiMorphformPost(this)"
                                                            data-action="{{route('post.changePrivacyPost',$post->id)}}"
                                                            id="privacy" name="privacy" data-toggle="tooltip"
                                                            data-placement="top"
                                                            title="{{ trans('posts.'.$post->privacy) }}"
                                                            class="form-select">
                                                        <option
                                                            @if(isset($post)) {{($post->privacy ==\App\Models\Post::PRIVACY_PUBLIC) ?'selected=selected':""}}@endif     value="{{\App\Models\Post::PRIVACY_PUBLIC}}">
                                                            عمومی
                                                        </option>
                                                        <option
                                                            @if(isset($post)) {{($post->privacy ==\App\Models\Post::PRIVACY_PRIVATE) ?'selected=selected':""}}@endif  value="{{\App\Models\Post::PRIVACY_PRIVATE}}">
                                                            خصوصی
                                                        </option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select style="width: 85px"
                                                            onchange="changeStatusMultiMorphformPost(this)"
                                                            data-action="{{route('post.changeStatusPost',$post->id)}}"
                                                            name="status" data-toggle="tooltip" data-placement="top"
                                                            title="{{ trans('posts.'.$post->status) }}"
                                                            class="form-select statusPost">
                                                        <option
                                                            @if(isset($post)) {{($post->status ==\App\Models\Post::STATUS_ACTIVE) ?'selected=selected':" "}}@endif  value="{{\App\Models\Post::STATUS_ACTIVE}}">
                                                            فعال
                                                        </option>
                                                        <option
                                                            @if(isset($post)) {{($post->status ==\App\Models\Post::STATUS_DEACTIVATE) ?'selected=selected':" "}}@endif  value="{{\App\Models\Post::STATUS_DEACTIVATE}}">
                                                            غیر فعال
                                                        </option>
                                                        <option
                                                            @if(isset($post)) {{($post->status ==\App\Models\Post::STATUS_CHOICE_ADMIN) ?'selected=selected':" "}}@endif  value="{{\App\Models\Post::STATUS_CHOICE_ADMIN}}">
                                                            انتخاب سردبیر
                                                        </option>
                                                    </select>
                                                </td>

                                                <td>
                                                    @can('update',\App\Models\Post::class)
                                                        <a href="{{route('multiMorphPost.edit',$post->id)}}?type={{$ctype}}">
                                                            <button type="button" class="btn btn-primary"
                                                                    onclick="editPost(this)"
                                                                    data-action="{{route('multiMorphPost.edit',$post->id)}}">

                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                        </a>
                                                    @endcan
                                                    @can('delete',\App\Models\Post::class)
                                                        <button type="button" class="btn btn-danger"
                                                                data-toggle="tooltip"
                                                                data-title="حذف منو"
                                                                data-action="{{route('multiMorphPost.destroy',$post->id)}}"

                                                                onclick="deleteMultiMorphformPost(this)">
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



@endsection
