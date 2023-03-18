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
        // gallery elfinder
        var fileSelect = [];

        $(document).ready(function () {
            $("#editor1").click(function (e) {
                $('#elfinder').show();
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
                        $("#my_image").attr("src", file[0]);
                        $('.iconImageIndex').addClass('d-none');
                        //$('#elfinder').dialog('close');
                        $('#editor1').val(file.toString());
                        fm.hide();
                    },
                })
            });

            $("#Videofile").click(function (e) {
                $('#elfinder3').show();
                var elfinder = $('#elfinder3').dialogelfinder({
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
                        //$('#elfinder').dialog('close');
                        $("#Videofile").val(file.toString());
                        fm.hide();
                    },
                })
            });

            const uploadTargetHash = 'l1_Lw';
            // elFinder connector URL
            const connectorUrl = '/uploads/connector';

            //files related to post


            fileSelect.push($('#fileRelated').val().split(','))

            $("#fileRelated").click(function (e) {
                $('#elfinder1').show();
                var filesArr = [];
                var elfinder = $('#elfinder1').dialogelfinder({
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
                        $('#fileRelated').val(file.toString());
                        fm.hide();
                        fileSelect.push(file);
                        html = '';
                        file.forEach(function (number) {
                            html += `  <div class="main-file">
                            <img style="height: 100px;" src="${number}" alt="">
                                <span onclick="deleteFile(this)" class="deleteFile">X</span>
                        </div>`;
                        });

                        $('.allFiles').append(html);

                    },
                })
            });
        });

        var imageSelect = [];
        imageSelect.push($('#imageIndex').val().split(','))
       // image index elfinder
        imageSelect.push($('#imageIndex').val().split(','))
        $(document).ready(function () {
            $("#imageIndex").click(function (e) {
                $('#elfinder1').show();
                $('#main_image').empty();
                var elfinder = $('#elfinder1').dialogelfinder({
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
                            $("#main_image").append("" +
                                ` <div class="imageGallery my-3">
                                    <input type='hidden' value="${file[i]}">
                                     <div onclick="deleteImage(this)" class="closeImage">x</div>
                                     <img
                                          src="${file[i]}"
                                          alt="">
                                 </div>`);
                        }
                        $('.iconImageIndex').addClass('d-none');
                        //$('#elfinder').dialog('close');
                        $('#imageIndex').val(file.toString());
                        fileSelect = ($('#imageIndex').val().split(','))
                        fm.hide();
                    },
                })
            });
        });




        //deleteFile selected
        function deleteFile(sender) {
            const parent = sender.closest('div');
            fileSelect = fileSelect.map(files => {
                return files.filter(function (file) {
                    return file != sender.previousElementSibling.value;
                });
            });
            document.querySelector('#fileRelated').value = fileSelect.map(files => {
                return files.map(file => {
                    return file;
                })
            })

            parent.remove();
        }

        // To create CKEditor 5 classic editor

        function deleteImage(sender) {
            const parent = sender.closest('.imageGallery');
            const src = parent.querySelector('img').getAttribute('src');
            console.log()
            document.querySelector('#imageIndex').value = fileSelect = fileSelect.filter(function (item) {
                return item !== src;
            });

            parent.remove();
        }
    </script>
    @include('admin.js.ckeditor',['command'=>'editor'])
    <script>

        $(".tags").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        })
        $('.cats').select2();
        $('.files').select2();

    </script>


@endsection
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <form id="formLocation" method="post" enctype="multipart/form-data" class="custom-validation"
                      @if(isset($post)) data-action="{{route('location.update',$post->id)}}" data-type="update"
                      @else data-action="{{route('location.store')}}" data-type="store" @endif>
                    @csrf
                    <div class="row">
                        <div class="col-12 text-start mb-2">
                            <div class="d-flex flex-wrap gap-2 float-end">
                                @if(isset($post))
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
                                    @if(isset($post))
                                        <h4 class="card-title">ویرایش </h4>
                                        <p class="card-title-desc">در این قسمت خود را ویرایش کنید</p>
                                    @else
                                        <h4 class="card-title">ساختن مکان جدید</h4>
                                        <p class="card-title-desc">در این قسمت جدید خود را بسازید</p>
                                    @endif

                                    <div class="mb-3">
                                        <label class="form-label">عنوان </label>
                                        <input value="{{ isset($post) ? $post->name:'' }}" id="name" name="name"
                                               type="text"
                                               class="form-control" required=""
                                               placeholder="عنوان">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">متن خود را وارد کنید</label>
                                        <div>
                                            <div id="editor">
                                                {!!isset($post) ? $post->desc:''!!}
                                            </div>

                                        </div>
                                    </div>
{{--                                    <div class="mb-3">--}}
{{--                                        <label class="form-label">آدرس </label>--}}
{{--                                        <input value=" {{isset($post) ? $post->address:''}}" name="address"--}}
{{--                                               type="text"--}}
{{--                                               class="form-control"--}}
{{--                                               placeholder="آدرس">--}}
{{--                                    </div>--}}
{{--                                    <div class="mb-3">--}}
{{--                                        <label class="form-label">شماره تلفن مربوطه </label>--}}
{{--                                        <input value=" {{isset($post) ? $post->phone:''}}" name="phone"--}}
{{--                                               type="text"--}}
{{--                                               class="form-control"--}}
{{--                                               placeholder="شماره تلفن">--}}
{{--                                    </div>--}}
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
                                                                    <div class="dz-message needsclick" id="main_image">
                                                                        @if(isset($post))
                                                                            @foreach($post->image as $img_src)
                                                                                <div class="imageGallery my-3">
                                                                                    <input type='hidden'
                                                                                           value="{{$img_src}}">
                                                                                    <div onclick="deleteImage(this)"
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
                                                                <div id="elfinder1"></div>
                                                                <input value="{{(isset($post   ))?implode(',',$post->image):''}}" name="image"
                                                                       class="form-control"
                                                                       type="text" id="imageIndex">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> <!-- end col -->
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">ظرفیت</label>
                                            <input value="{{isset($post) ? $post->index:''}}" name="index"
                                                   class="form-control" type="number">
                                        </div>
                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">دسته بندی ها</label>
                                            <div class="form-group">
                                                <select class="form-control" name="cat_id">

                                                    @foreach($categories as $cat)
                                                        <option
                                                            @if(isset($post)) {{($post->id==$cat->id) ?'selected=selected':" "}}@endif    value="{{$cat->id}}">
                                                            {{$cat->title}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">تگ ها</label>
                                            <br>
                                            <select name="tags[]" class="form-control tags" multiple="multiple">
                                                @if(isset($post) && !empty($post->tags))
                                                    @foreach($post->tags as $tag)
                                                        <option selected="selected" value="{{$tag}}">{{$tag}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">گالری عکس ها </label>
                                            <div id="elfinder1"></div>
                                            <input
                                                @if(isset($post)) value="{{ implode(',',$post->files) }}"
                                                @endif name="files" class="form-control" type="text" id="fileRelated">
                                            <div class="allFiles">
                                            </div>
                                            @if(isset($post))
                                                @foreach($post->files as $file)
                                                    <div class="main-file">
                                                        <img style="height: 100px;" src="{{$file}}" alt="">
                                                        <span onclick="deleteFile(this)" class="deleteFile">X</span>
                                                    </div>
                                                @endforeach
                                            @endif
                                            <label for="formrow-firstname-input" class="form-label">فایل ویدیویی</label>
                                            <div id="elfinder3"></div>
                                            <input
                                                @if(isset($post)) value="{{ implode(',',$post->video) }}"
                                                @endif name="video" class="form-control" type="text" id="Videofile">
                                        </div>


                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </form>


            </div>
        </div>

    </div>



@endsection
