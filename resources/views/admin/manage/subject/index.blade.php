@extends('admin.layouts.master')
@section('styleCss')


@endsection
@section('script')
    <script>
        function editCategory(sender) {
            $('#titleEdit').val($(sender).data("title"));
            $('#typeEdit').val($(sender).data("type-id"));
            $('#books_type_edit').val($(sender).data("data-book-type"));
            $('#books_edit').val($(sender).data("data-book"));
            $('#image_update').val($(sender).data("imageIndex"));
            $('#updateCategoryBtn').attr('data-action', $(sender).data("action"));
        }

        var subjectEditor;
        $(document).ready(function () {
            ClassicEditor.create(document.querySelector('#subjectContent'), {
                language: {
                    // The UI will be English.
                    ui: 'en',

                    // But the content will be edited in Arabic.
                    content: 'ar'
                },
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'imageUpload', 'ckfinder', 'blockQuote', 'insertTable', 'mediaEmbed', 'undo', 'redo']
            })
                .then(editor => {
                    subjectEditor = editor;
                    subjectEditor.keystrokes.set('space', (key, stop) => {
                        subjectEditor.execute('input', {text: '\u00a0'});
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
            var content_updateEditor;
            ClassicEditor.create(document.querySelector('#Content_update'), {
                language: {
                    // The UI will be English.
                    ui: 'en',

                    // But the content will be edited in Arabic.
                    content: 'ar'
                },
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'imageUpload', 'ckfinder', 'blockQuote', 'insertTable', 'mediaEmbed', 'undo', 'redo']
            })
                .then(editor => {
                    content_updateEditor = editor;
                    content_updateEditor.keystrokes.set('space', (key, stop) => {
                        content_updateEditor.execute('input', {text: '\u00a0'});
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
            $("#image").click(function (e) {
                $('#elfinder').show();
                $("#addCat").modal("hide");
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
                        // for(var i=0;i<file.length;i++){
                        //     $("#my_image").append("<img style='max-height: 100px;' class='m-1' src="+file[i]+">");
                        // }

                        // $('.iconImageIndex').addClass('d-none');
                        //$('#elfinder').dialog('close');
                        $('#image').val(file.toString());
                        fm.hide();
                        $("#addCat").modal("show");
                    },
                })
            });
            $("#image_update").click(function (e) {
                $('#elfinder2').show();
                $("#editCategory").modal("hide");
                var elfinder = $('#elfinder2').dialogelfinder({
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
                        // for(var i=0;i<file.length;i++){
                        //     $("#my_image").append("<img style='max-height: 100px;' class='m-1' src="+file[i]+">");
                        // }

                        // $('.iconImageIndex').addClass('d-none');
                        //$('#elfinder').dialog('close');
                        $('#image_update').val(file.toString());
                        fm.hide();
                        $("#editCategory").modal("show");
                    },
                })
            });
        });
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
                            <h4 class="mb-sm-0 font-size-18"> مدیریت فصل کتاب ها </h4>

                            <div class="page-title-left">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">پنل</a></li>
                                    <li class="breadcrumb-item active">مدیریت فصل کتاب ها</li>
                                </ol>
                                {{--                                <button class="btn btn-success waves-effect waves-light mt-2"--}}
                                {{--                                        data-bs-toggle="modal"--}}

                                {{--                                        data-bs-target=".bs-insert-modal-center">اضافه کردن منو--}}
                                {{--                                </button>--}}

                                <button class="btn btn-success  waves-effect waves-light" data-bs-toggle="modal"
                                        data-bs-target="#addCat">اضافه کردن فصل
                                </button>

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
                                            <th scope="col">نوع دسته بندی</th>
                                            <th scope="col">کتاب</th>
                                            <th scope="col">عملیات</th>

                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($subject as $sub)
                                            <tr id="subject_{{$sub->id}}">
                                                <td>
                                                    {{$sub->id}}
                                                </td>
                                                <td>
                                                    {{$sub->title}}
                                                </td>
                                                <td>
                                                    {{$sub->book->type->name}}
                                                </td>
                                                <td>
                                                    {{$sub->book->title}}
                                                </td>

                                                <td>
                                                    @can('update',\App\Models\Category::class)
                                                        <button type="button" class="btn btn-primary"
                                                                onclick="editCategory(this)"
                                                                data-title="{{$sub->title}}"
                                                                data-imageIndex="{{$sub->imageIndex}}"
                                                                data-book-type="{{$sub->book->type->id}}"
                                                                data-book="{{$sub->book->id}}"
                                                                data-action="{{route('category.update',$sub->id)}}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editCategory"
                                                                data-toggle="tooltip">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    @endcan
                                                    @method('PUT')

                                                    @can('delete',\App\Models\Category::class)
                                                        <button type="button" class="btn btn-danger"
                                                                data-toggle="tooltip"
                                                                data-title="حذف منو"
                                                                data-action="{{route('category.destroy',$sub->id)}}"
                                                                onclick="deleteCategory(this)">
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

    {{--    add User--}}
    <div class="modal fade " id="addCat" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافه کردن فصل کتاب</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="addSubject"
                      data-action="{{route('subject.store')}}" class=" form-contact ">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 col-12">
                            <label for="formrow-firstname-input" class="form-label">عنوان فصل</label>
                            <input id="title" name="title" type="text" class="form-control edit-role">
                        </div>
                        <div class="mb-3 col-12">
                            <label for="formrow-firstname-input" class="form-label">تگ مرتبط</label>
                            <input id="tag" name="tag" type="text" class="form-control edit-role">
                        </div>
                        <div class="mb-3 col-12">
                            <label for="formrow-firstname-input" class="form-label">عکس</label>
                            <div id="elfinder"></div>
                            <input id="image" name="imageIndex" type="text" class="form-control edit-role">
                        </div>
                        <div id="subjectContent">
                        </div>
                        <div class="mb-3 col-12">
                            <label for="formrow-firstname-input" class="form-label">نوع دسته بندی </label>
                            <select class="form-select" id="books_type">
                                <option disabled selected>نوع دسته بندی را انتخاب کنید</option>
                                @foreach($typeCat as $Tcat)
                                    <option onclick="getSubjectBook(this,'#book_id')"
                                            data-action="{{route('changeCategory.book')}}" data-type="{{$Tcat->id}}"
                                            value="{{$Tcat->id}}">{{$Tcat->name}}</option>
                                @endforeach
                            </select>
                            <label for="formrow-firstname-input" class="form-label">کتاب </label>
                            <select name="book_id" id="books" class="form-select">
                                <option disabled selected>نوع دسته بندی را انتخاب کنید</option>

                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                        <div>
                            <button
                                type="submit"
                                class="btn btn-success w-md">اضافه کردن
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
    {{--    edit editCategory--}}
    <div class="modal fade " id="editCategory" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ویرایش کردن فصل ها</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" id="update">

                    <div class="mb-3 col-12">
                        <label for="formrow-firstname-input" class="form-label">عنوان فصل</label>
                        <input id="titleEdit" name="" type="text" class="form-control edit-role">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="formrow-firstname-input" class="form-label">تگ مرتبط</label>
                        <input id="tagEdit" name="" type="text" class="form-control edit-role">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="formrow-firstname-input" class="form-label">عکس</label>
                        <div id="elfinder2"></div>
                        <input id="image_update" name="" type="text" class="form-control edit-role">
                    </div>
                    <div id="Content_update">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="formrow-firstname-input" class="form-label">نوع دسته بندی </label>
                        <select class="form-select" id="books_type_edit">
                            <option disabled selected>نوع دسته بندی را انتخاب کنید</option>
                            @foreach($typeCat as $Tcat)
                                <option onclick="getSubjectBook(this,'#books_edit')"
                                        data-action="{{route('changeCategory.book')}}" data-type="{{$Tcat->id}}"
                                        value="{{$Tcat->id}}">{{$Tcat->name}}</option>
                            @endforeach
                        </select>
                        <label for="formrow-firstname-input" class="form-label">کتاب </label>
                        <select id="books_edit" class="form-select">
                            <option disabled selected>نوع دسته بندی را انتخاب کنید</option>

                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    <div>
                        <button id="updateCategoryBtn" data-update-role onclick="updateCategory(this)"
                                data-action="" type="button"
                                class="btn btn-success w-md">ویرایش کردن
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
