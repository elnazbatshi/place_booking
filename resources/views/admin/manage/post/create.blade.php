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

        var fileSelect = [];
        fileSelect.push($('#editor1').val().split(','))
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
                                     <div onclick="deleteFile(this)" class="closeImage">x</div>
                                     <img
                                          src="${file[i]}"
                                          alt="">
                                 </div>`);
                        }

                        $('.iconImageIndex').addClass('d-none');
                        //$('#elfinder').dialog('close');
                        $('#editor1').val(file.toString());
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

        // elfinder folder hash of the destination folder to be uploaded in this CKeditor 5
        const uploadTargetHash = 'l1_Lw';
        // elFinder connector URL
        const connectorUrl = '/uploads/connector';

        //files related to post

        var fileSelect = [];
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
                        html += `<div class="d-flex">
                                    <input value="${number}" class="addFile" />
                                    <span onclick="deleteFile(this)" class="deleteFile">X</span>
                                </div>`;
                    });
                    $('.allFiles').append(html);

                },
            })
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

    </script>
    @include('admin.js.ckeditor',['command'=>'all'])
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

                <form id="formPost" method="post" enctype="multipart/form-data" class="custom-validation"
                      @if(isset($post)) data-action="{{route('post.update',$post->id)}}" data-type="update"
                      @else data-action="{{route('post.store')}}" data-type="store" @endif>
                    @csrf
                    <div class="row">
                        <div class="col-12 text-start mb-2">
                            <div class="d-flex flex-wrap gap-2 float-end">
                                @if(isset($post))
                                    <button type="submit" class="btn btn-success waves-effect waves-s">
                                        ویرایش خبر
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-success waves-effect waves-s">
                                        ثبت خبر
                                    </button>
                                @endif
                            </div>
                        </div>

                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-body">
                                    @if(isset($post))
                                        <h4 class="card-title">ویرایش خبر</h4>
                                        <p class="card-title-desc">در این قسمت خبر خود را ویرایش کنید</p>
                                    @else
                                        <h4 class="card-title">ساختن خبر جدید</h4>
                                        <p class="card-title-desc">در این قسمت خبر جدید خود را بسازید</p>
                                    @endif

                                    <div class="mb-3">
                                        <label class="form-label">عنوان خبر </label>
                                        <input value="{{ isset($post) ? $post->title:'' }}" id="title" name="title"
                                               type="text"
                                               class="form-control" required=""
                                               placeholder="عنوان">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">متن خبر خود را وارد کنید</label>
                                        <div>
                                            <div id="editor">
                                                {!!isset($post) ? $post->content:''!!}
                                            </div>

                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"> خلاصه متن خبر خود را وارد کنید</label>
                                        <div>
                                            <div id="semiContent">
                                                {!!isset($post) ? $post->semiContent:''!!}
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

                                                            <h4 class="card-title">عکس شاخص خبر</h4>

                                                            <div>
                                                                <div class="dropzone">
                                                                    <div class="dz-message needsclick">
                                                                        @if(!@$post->imageIndex)
                                                                            <div
                                                                                class="mb-3 iconImageIndex">
                                                                                <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                                                            </div>
                                                                        @endif
                                                                        <div id="my_image">


                                                                            @if(@$post->imageIndex) @foreach(explode(',',$post->imageIndex) as $img)
                                                                                <div class="imageGallery">
                                                                                    <div
                                                                                        onclick="deleteFile(this)"
                                                                                        class="closeImage">x
                                                                                    </div>
                                                                                    <img
                                                                                        src="{{@$img}}"
                                                                                        alt="">
                                                                                </div>
                                                                            @endforeach @endif</div>
                                                                        @if(!@$post->imageIndex)
                                                                            <h4>فایل های خود را در فایل
                                                                                منیجر انتخاب
                                                                                کنید</h4>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="text-center mt-4">
                                                                <div id="elfinder"></div>
                                                                <input value="{{@$post->imageIndex}}"
                                                                       name="imageIndex"
                                                                       class="form-control"
                                                                       type="text" id="editor1"
                                                                       placeholder="برای باز شدن مدیریت فایل اینجا کلیک کنید">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
                                        </div>
                                        <div class="mb-3 text-start">
                                            <label class="form-label">وضعیت</label>
                                            <select name="status" class="form-select">
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
                                        </div>
                                        <div class="mb-3 text-start">
                                            <label class="form-label"> حریم خصوصی</label>
                                            <select name="privacy" class="form-select">
                                                <option
                                                    @if(isset($post)) {{($post->privacy ==\App\Models\Post::PRIVACY_PUBLIC) ?'selected=selected':""}}@endif     value="{{\App\Models\Post::PRIVACY_PUBLIC}}">
                                                    عمومی
                                                </option>
                                                <option
                                                    @if(isset($post)) {{($post->privacy ==\App\Models\Post::PRIVACY_PRIVATE) ?'selected=selected':""}}@endif  value="{{\App\Models\Post::PRIVACY_PRIVATE}}">
                                                    خصوصی
                                                </option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">تگ ها</label>
                                            <select name="tags[]" class="form-control tags" multiple="multiple">
                                                @if(isset($post) && !empty($post->tags))
                                                    @foreach($post->tags as $tag)
                                                        <option selected="selected" value="{{$tag}}">{{$tag}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">دسته بندی ها</label>
                                            <select name="categories[]" style=" width: 100%"
                                                    class="form-control cats" multiple>
                                                @if(isset($post))


                                                    @foreach($categories as $category)
                                                        @if(count($post->categories)>0)
                                                            @foreach($post->categories as $selectCat)
                                                                <option
                                                                    {{$selectCat->id ==$category->id ?'selected':""}}    value="{{$category->id}}">{{$category->title}}
                                                                </option>
                                                            @endforeach

                                                        @else

                                                            <option
                                                                value="{{$category->id}}">{{$category->title}}
                                                            </option>
                                                        @endif
                                                    @endforeach




                                                @else

                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                                    @endforeach
                                                @endif


                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label"> فایل مرتبط</label>
                                            <div id="elfinder1"></div>
                                            <input
                                                @if(isset($post)) value="{{ $post->files->pluck('url')->implode(',') }}"
                                                @endif name="files" class="form-control" type="text" id="fileRelated">
                                            <div class="allFiles">

                                            </div>
                                            @if(isset($post))
                                                @foreach($post->files as $file)
                                                    <div class="d-flex">
                                                        <input name="file_inputs[]" value="{{$file->url}}"
                                                               class="addFile"/>
                                                        <span onclick="deleteFile(this)"
                                                              class="deleteFile m-auto">X</span>
                                                    </div>

                                                @endforeach
                                            @endif


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
