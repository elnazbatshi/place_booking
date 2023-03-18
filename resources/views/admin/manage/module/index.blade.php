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
                            <h4 class="mb-sm-0 font-size-18">مدیریت ماژول ها</h4>

                            <div class="page-title-left">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">پنل</a></li>
                                    <li class="breadcrumb-item active">مدیریت ماژول</li>
                                </ol>

                                @can('create',\App\Models\Module::class)
                                    <a href="{{route('module.create')}}">
                                        <button class="btn btn-success">اضافه کردن ماژول
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
                                            <th scope="col"> دسته بندی</th>
                                            <th scope="col">عکس شاخص</th>
                                            @can('update',\App\Models\Module::class)
                                                <th scope="col">وضعیت</th>
                                            @endcan
                                            @can(['delete','update'],\App\Models\Module::class)
                                                <th scope="col">عملیات</th>
                                            @endcan

                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($modules as $module)


                                            <tr id="post_{{$module->id}}">
                                                <td>
                                                    {{$module->id}}
                                                </td>
                                                <td>
                                                    {{ excerpt($module->name,15) }}
                                                </td>
                                                <td>
                                                    @foreach($module->categories as $category)
                                                        <span class="badge bg-success font-size-large">
                                                           {{$category->title}}
                                                    </span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <img style="width: 50px" src="{{explode(',',$module->img_src)[0]}}"
                                                         alt="">
                                                </td>

                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input onchange="changeStatus(this)"
                                                               data-action="{{route('module.changeStatus',$module->id)}}"
                                                               data-status="{{$module->status}}"
                                                               class="form-check-input status_menu" type="checkbox"
                                                               id="mySwitch"
                                                               {{$module->status==1 ?  "checked" : " "}}         name="darkmode"
                                                               value="1">
                                                    </div>
                                                </td>
                                                <td>
                                                    @can('update',\App\Models\Module::class)
                                                        <a href="{{route('module.edit',$module->id)}}">
                                                            <button type="button" class="btn btn-primary"
                                                                    onclick="editPost(this)"
                                                                    data-action="{{route('module.edit',$module->id)}}">

                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                        </a>
                                                    @endcan
                                                    @can('delete',\App\Models\Module::class)
                                                        <button type="button" class="btn btn-danger"
                                                                data-toggle="tooltip"
                                                                data-title="حذف ماژول"
                                                                data-action="{{route('module.destroy',$module->id)}}"

                                                                onclick="deleteModule(this)">
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
