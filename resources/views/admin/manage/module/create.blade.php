@extends('admin.layouts.master')
@section('styleCss')

    <style>
        .ck-editor__editable_inline {
            min-height: 150px;
        }
    </style>

@endsection
@section('script')
    <script>


        import {scripts} from "laravel-mix";

        var fileSelect = [];
        fileSelect = ($('#editor1').val().split(','))
        $(document).ready(function () {
            $("#editor1").click(function (e) {
                $('#elfinder').show();
                $('#my_image').empty();
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
                        //fm.log(file);
                        var urls = $.map(file, function (f) {
                            return f.url;
                        });
                        for (var i = 0; i < file.length; i++) {
                            $("#my_image").append("" +
                                ` <div class="imageGallery">
                                    <input type='hidden' value="${file[i]}">
                                     <div onclick="deleteFile(this)" class="closeImage">x</div>
                                     <img
                                          src="${file[i]}"
                                          alt="">
                                 </div>`);
                        }
                        $('.iconImageIndex').addClass('d-none');
                        //$('#elfinder').dialog('close');
                        $('#editor1').val(file.toString());
                        fileSelect = ($('#editor1').val().split(','))
                        fm.hide();
                    },
                })
            });
        });


</script>
    @include('admin.js.ckeditor',['command'=>'editor'])
    <script>


        function deleteFile(sender) {
            const parent = sender.closest('.imageGallery');
            const src = parent.querySelector('img').getAttribute('src');
            console.log()
            document.querySelector('#editor1').value = fileSelect = fileSelect.filter(function (item) {
                return item !== src;
            });

            parent.remove();
        }

        $('.cats').select2();
    </script>
@endsection
@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <form id="formModule" method="post" enctype="multipart/form-data" class="custom-validation"
                      @if(isset($module)) data-type="update" data-action="{{route('module.update',$module->id)}}"
                      @else data-type="store" data-action="{{route('module.store')}}" @endif >
                    @csrf
                    <div class="row">
                        <div class="col-12 text-start mb-2">
                            <div class="d-flex flex-wrap gap-2 float-end">
                                @if(isset($module))
                                    <button type="submit" class="btn btn-success waves-effect waves-s">
                                        ویرایش
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-success waves-effect waves-s">
                                        ثبت
                                    </button>
                                @endif
                            </div>
                        </div>

                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-body">
                                    @if(isset($module))
                                        <h4 class="card-title">ویرایش </h4>
                                        <p class="card-title-desc">در این قسمت ماژول خود را ویرایش کنید</p>
                                    @else
                                        <h4 class="card-title">ساختن ماژول جدید</h4>
                                        <p class="card-title-desc">در این قسمت ماژول جدید خود را بسازید</p>
                                    @endif

                                    <div class="mb-3">
                                        <label class="form-label">نام ماژول</label>
                                        <input value="{{ isset($module) ? $module->name:'' }}" id="name" name="name"
                                               type="text"
                                               class="form-control" required=""
                                               placeholder="نام ماژول مورد نظر را وارد کنید">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">ماژول مورد نظر</label>
                                        <div>
                                            <div id="editor">
                                                {!!isset($module) ? $module->content:''!!}
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">ویژگی های مرتبط</h4>

                                    <hr>
                                    <div class="custom-validation">
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-body">

                                                            <h4 class="card-title">عکس شاخص </h4>
                                                            <div>
                                                                <div class="dropzone">
                                                                    <div class="dz-message needsclick" id="my_image">
                                                                        @if(isset($module))
                                                                            @foreach(explode(',',$module->img_src) as $img_src)
                                                                                <div class="imageGallery">
                                                                                    <input type='hidden'
                                                                                           value="{{$img_src}}">
                                                                                    <div onclick="deleteFile(this)"
                                                                                         class="closeImage">x
                                                                                    </div>
                                                                                    <img
                                                                                        src="{{$img_src}}"
                                                                                        alt="">
                                                                                </div>
                                                                            @endforeach
                                                                        @else
                                                                            <div class="mb-3 iconImageIndex">
                                                                                <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                                                            </div>
                                                                            <h4>فایل خود را در فایل منیجر انتخاب
                                                                                کنید</h4>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="text-center mt-4">
                                                                <div id="elfinder"></div>
                                                                <input value="{{@$module->img_src}}" name="img_src"
                                                                       class="form-control"
                                                                       type="text" id="editor1">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
                                        </div>

                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">دسته بندی ها</label>
                                            <select name="categories[]" style=" width: 100%"
                                                    class="form-control cats" multiple>
                                                @if(isset($module))
                                                    @foreach($categories as $category)
                                                        @foreach($module->categories as $selectCat)
                                                            <option
                                                                {{$selectCat->id ==$category->id ?'selected':""}}    value="{{$category->id}}">{{$category->title}}
                                                            </option>
                                                        @endforeach
                                                    @endforeach

                                                @else
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                                    @endforeach
                                                @endif


                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div> <!-- end col -->

                    </div>
                </form><!-- end col -->
                <!-- end right side -->


            </div> <!-- container-fluid -->
        </div>

    </div>



@endsection
