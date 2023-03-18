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


        $(document).ready(function () {
            $("#editor1").click(function (e) {
                var elfinder = $('#elfinder').elfinder({
                    url: '/uploads/connector',
                    resizable: false,
                    getfile: {
                        onlyURL: true,
                        multiple: false,
                        folders: false,
                        oncomplete: ''
                    },
                    handlers: {
                        dblclick: function (event, elfinderInstance) {
                            fileInfo = elfinderInstance.file(event.data.file);

                            if (fileInfo.mime != 'directory') {
                                $("#editor1").val(elfinderInstance.url(event.data.file));
                                $("#my_image").attr("src", elfinderInstance.url(event.data.file));
                                $('.iconImageIndex').addClass('d-none');
                                elfinderInstance.destroy();
                                //$('#elfinder').dialog('close');
                                return false; // stop elfinder
                            }
                        },
                        destroy: function (event, elfinderInstance) {
                            elfinder.dialog('close');

                        }
                    }
                }).dialog({
                    title: 'filemanager',
                    resizable: true,
                    width: '50%',
                    height: 500
                });
            });
        });


        // elfinder folder hash of the destination folder to be uploaded in this CKeditor 5
        const uploadTargetHash = 'l1_Lw';
        // elFinder connector URL
        const connectorUrl = '/uploads/connector';

        //files related to post


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
        var theEditor;
        ClassicEditor.create(document.querySelector('#editor'), {
            language: {
                // The UI will be English.
                ui: 'en',
                // But the content will be edited in Arabic.
                content: 'ar'
            },
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'imageUpload', 'ckfinder', 'blockQuote', 'insertTable', 'mediaEmbed', 'undo', 'redo']
        })

            .then(editor => {
                theEditor = editor;
                editor.keystrokes.set('space', (key, stop) => {
                    editor.execute('input', {text: '\u00a0'});
                    stop();
                });
                const ckf = editor.commands.get('ckfinder'),
                    fileRepo = editor.plugins.get('FileRepository'),
                    ntf = editor.plugins.get('Notification'),
                    i18 = editor.locale.t,
                    // Insert images to editor window
                    insertImages = urls => {
                        const imgCmd = editor.commands.get('imageUpload');
                        if (!imgCmd.isEnabled) {
                            ntf.showWarning(i18('Could not insert image at the current position.'), {
                                title: i18('Inserting image failed'),
                                namespace: 'ckfinder'
                            });
                            return;
                        }
                        editor.execute('imageInsert', {source: urls});
                    },
                    // To get elFinder instance
                    getfm = open => {
                        return new Promise((resolve, reject) => {
                            // Execute when the elFinder instance is created
                            const done = () => {
                                if (open) {
                                    // request to open folder specify
                                    if (!Object.keys(_fm.files()).length) {
                                        // when initial request
                                        _fm.one('open', () => {
                                            _fm.file(open) ? resolve(_fm) : reject(_fm, 'errFolderNotFound');
                                        });
                                    } else {
                                        // elFinder has already been initialized
                                        new Promise((res, rej) => {
                                            if (_fm.file(open)) {
                                                res();
                                            } else {
                                                // To acquire target folder information
                                                _fm.request({cmd: 'parents', target: open}).done(e => {
                                                    _fm.file(open) ? res() : rej();
                                                }).fail(() => {
                                                    rej();
                                                });
                                            }
                                        }).then(() => {
                                            // Open folder after folder information is acquired
                                            _fm.exec('open', open).done(() => {
                                                resolve(_fm);
                                            }).fail(err => {
                                                reject(_fm, err ? err : 'errFolderNotFound');
                                            });
                                        }).catch((err) => {
                                            reject(_fm, err ? err : 'errFolderNotFound');
                                        });
                                    }
                                } else {
                                    // show elFinder manager only
                                    resolve(_fm);
                                }
                            };

                            // Check elFinder instance
                            if (_fm) {
                                // elFinder instance has already been created
                                done();
                            } else {
                                // To create elFinder instance
                                _fm = $('<div/>').dialogelfinder({
                                    // dialog title
                                    title: 'File Manager',
                                    // connector URL
                                    url: connectorUrl,
                                    // start folder setting
                                    startPathHash: open ? open : void (0),
                                    // Set to do not use browser history to un-use location.hash
                                    useBrowserHistory: false,
                                    // Disable auto open
                                    autoOpen: false,
                                    // elFinder dialog width
                                    width: '50%',
                                    // set getfile command options
                                    commandsOptions: {
                                        getfile: {
                                            oncomplete: 'close',
                                            multiple: true
                                        }
                                    },
                                    // Insert in CKEditor when choosing files
                                    getFileCallback: (files, fm) => {
                                        let imgs = [];
                                        fm.getUI('cwd').trigger('unselectall');
                                        $.each(files, function (i, f) {
                                            if (f && f.mime.match(/^image\//i)) {
                                                imgs.push(fm.convAbsUrl(f.url));
                                            } else {
                                                editor.execute('link', fm.convAbsUrl(f.url));
                                            }
                                        });
                                        if (imgs.length) {
                                            insertImages(imgs);
                                        }
                                    }
                                }).elfinder('instance');
                                done();
                            }
                        });
                    };

                // elFinder instance
                let _fm;

                if (ckf) {
                    // Take over ckfinder execute()
                    ckf.execute = () => {
                        getfm().then(fm => {
                            fm.getUI().dialogelfinder('open');
                        });
                    };
                }

                // Make uploader
                const uploder = function (loader) {
                    let upload = function (file, resolve, reject) {
                        getfm(uploadTargetHash).then(fm => {
                            let fmNode = fm.getUI();
                            fmNode.dialogelfinder('open');
                            fm.exec('upload', {files: [file], target: uploadTargetHash}, void (0), uploadTargetHash)
                                .done(data => {
                                    if (data.added && data.added.length) {
                                        fm.url(data.added[0].hash, {async: true}).done(function (url) {
                                            resolve({
                                                'default': fm.convAbsUrl(url)
                                            });
                                            fmNode.dialogelfinder('close');
                                        }).fail(function () {
                                            reject('errFileNotFound');
                                        });
                                    } else {
                                        reject(fm.i18n(data.error ? data.error : 'errUpload'));
                                        fmNode.dialogelfinder('close');
                                    }
                                })
                                .fail(err => {
                                    const error = fm.parseError(err);
                                    reject(fm.i18n(error ? (error === 'userabort' ? 'errAbort' : error) : 'errUploadNoFiles'));
                                });
                        }).catch((fm, err) => {
                            const error = fm.parseError(err);
                            reject(fm.i18n(error ? (error === 'userabort' ? 'errAbort' : error) : 'errUploadNoFiles'));
                        });
                    };

                    this.upload = function () {
                        return new Promise(function (resolve, reject) {
                            if (loader.file instanceof Promise || (loader.file && typeof loader.file.then === 'function')) {
                                loader.file.then(function (file) {
                                    upload(file, resolve, reject);
                                });
                            } else {
                                upload(loader.file, resolve, reject);
                            }
                        });
                    };
                    this.abort = function () {
                        _fm && _fm.getUI().trigger('uploadabort');
                    };
                };

                // Set up image uploader
                fileRepo.createUploadAdapter = loader => {
                    return new uploder(loader);
                };
            })
            .catch(error => {
                console.error(error);
            });
    </script>

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

                <form id="formSlide" method="post" enctype="multipart/form-data" class="custom-validation"
                      @if(isset($slider)) data-action="{{route('slider.update',$slider->id)}}" data-type="update"
                      @else data-action="{{route('slider.store')}}" data-type="store" @endif>
                    @csrf
                    <div class="row">
                        <div class="col-12 text-start mb-2">
                            <div class="d-flex flex-wrap gap-2 float-end">
                                @if(isset($slider))
                                    <button type="submit" class="btn btn-success waves-effect waves-s">
                                        ویرایش اسلایدر
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-success waves-effect waves-s">
                                        ثبت اسلایدر
                                    </button>
                                @endif
                            </div>
                        </div>

                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-body">
                                    @if(isset($slider))
                                        <h4 class="card-title">ویرایش اسلایدر</h4>
                                        <p class="card-title-desc">در این قسمت اسلایدر خود را ویرایش کنید</p>
                                    @else
                                        <h4 class="card-title">ساختن اسلایدر جدید</h4>
                                        <p class="card-title-desc">در این قسمت اسلایدر جدید خود را بسازید</p>
                                    @endif

                                    <div class="mb-3">
                                        <label class="form-label">عنوان اسلایدر </label>
                                        <input value="{{ isset($slider) ? $slider->title:'' }}" id="title" name="title"
                                               type="text"
                                               class="form-control" required=""
                                               placeholder="عنوان">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">متن اسلایدر خود را وارد کنید</label>
                                        <div>
                                            <div id="editor">
                                                {!!isset($slider) ? $slider->content:''!!}
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

                                                            <h4 class="card-title">عکس شاخص پست</h4>
                                                            <div>
                                                                <div class="dropzone">
                                                                    <div class="dz-message needsclick">
                                                                        @if(!@$slider->imageIndex)
                                                                            <div class="mb-3 iconImageIndex">
                                                                                <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                                                            </div>
                                                                        @endif
                                                                        <img style="height: 100px;" id="my_image"
                                                                             src="{{@$slider->imageIndex}}"
                                                                             alt="">
                                                                        @if(!@$slider->imageIndex)
                                                                            <h4>فایل خود را در فایل منیجر انتخاب
                                                                                کنید</h4>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="text-center mt-4">
                                                                <div id="elfinder"></div>
                                                                <input value="{{@$slider->img_src}}" name="img_src"
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
                                            <select name="categories[]" style=" width: 100%" id="categories"
                                                    class="form-control cats" multiple>
                                                @if(isset($slider))
                                                    @foreach($categories as $category)

                                                        @foreach($slider->categories as $selectCat)
                                                            <option
                                                                {{$selectCat->id ==$category->id ?'selected':""}}    value="{{$category->id}}">{{$category->title}}</option>
                                                        @endforeach
                                                    @endforeach

                                                @else
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                                    @endforeach
                                                @endif


                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">آدرس اسلاید</label>
                                            <input value=" {{@$slider->url}} " name="url" class="form-control"
                                                   type="text">
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
