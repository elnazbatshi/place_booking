@extends('admin.layouts.master')
@section('styleCss')


@endsection
@section('script')
    <script>
        function editTypeCat(sender) {

            $('#titleEdit').val($(sender).data("title"));
            $('#typeEdit').val($(sender).data("type"));
            $('#imageEdit').attr("src", $(sender).data("image"));
            updateEditor.setData($(sender).data("desc"));
            $('#updateCatTypeForm').attr('data-action', $(sender).data("action"));
        }
    </script>
    <script>
        var catTextEditor;
        var updateEditor;
        $(document).ready(function () {
            ClassicEditor.create(document.querySelector('#catContent'), {
                language: {
                    // The UI will be English.
                    ui: 'en',

                    // But the content will be edited in Arabic.
                    content: 'ar'
                },
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'imageUpload', 'ckfinder', 'blockQuote', 'insertTable', 'mediaEmbed', 'undo', 'redo']
            })
                .then(editor => {
                    catTextEditor = editor;
                    catTextEditor.keystrokes.set('space', (key, stop) => {
                        catTextEditor.execute('input', {text: '\u00a0'});
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


            ClassicEditor.create(document.querySelector('#content_edit'), {
                language: {
                    // The UI will be English.
                    ui: 'en',

                    // But the content will be edited in Arabic.
                    content: 'ar'
                },
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'imageUpload', 'ckfinder', 'blockQuote', 'insertTable', 'mediaEmbed', 'undo', 'redo']
            })
                .then(editor => {
                    updateEditor = editor;
                    updateEditor.keystrokes.set('space', (key, stop) => {
                        updateEditor.execute('input', {text: '\u00a0'});
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


            ////upload image elfinder
            $("#image").click(function (e) {
                $('#elfinder').show();
                $("#addTypeCat").modal("hide");
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
                        $("#addTypeCat").modal("show");
                    },
                })
            });
            $("#image_edit").click(function (e) {
                $('#elfinder2').show();
                $("#editTypeCat").modal("hide");
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
                        $('#image_edit').val(file.toString());
                        fm.hide();
                        $("#editTypeCat").modal("show");
                        $("#imageEdit").attr("src", file[0]);
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
                            <h4 class="mb-sm-0 font-size-18">مدیریت انواع دسته بندی </h4>

                            <div class="page-title-left">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">پنل</a></li>
                                    <li class="breadcrumb-item active">مدیریت نوع دسته بندی ها</li>
                                </ol>
                                {{--                                <button class="btn btn-success waves-effect waves-light mt-2"--}}
                                {{--                                        data-bs-toggle="modal"--}}

                                {{--                                        data-bs-target=".bs-insert-modal-center">اضافه کردن منو--}}
                                {{--                                </button>--}}
                                @can('create',\App\Models\TypeCategory::class)
                                    <button class="btn btn-success  waves-effect waves-light" data-bs-toggle="modal"
                                            data-bs-target="#addTypeCat">اضافه کردن نوع دسته بندی
                                    </button>
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
                                            <th scope="col">نام</th>
                                            <th scope="col">نوع</th>
                                            <th scope="col">عکس</th>
                                            @canany(['delete','update'],\App\Models\TypeCategory::class)
                                                <th scope="col">عملیات</th>
                                            @endcan
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($typeCat as $cat)
                                            <tr id="catType_{{$cat->id}}">
                                                <td>
                                                    {{$cat->id}}
                                                </td>
                                                <td>
                                                    {{$cat->name}}
                                                </td>
                                                <td>
                                                    @if($cat->type)
                                                        <span class="badge bg-success font-size-large">
                                                               {{$cat->type}}
                                                    </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <img style="height:60px" src="{{$cat->image}}" alt="">
                                                </td>

                                                <td>
                                                    @can('update',\App\Models\TypeCategory::class)
                                                        <button type="button" class="btn btn-primary"
                                                                onclick="editTypeCat(this)"
                                                                data-title="{{$cat->name}}"
                                                                data-type="{{$cat->type}}"
                                                                data-image="{{$cat->image}}"
                                                                data-desc="{{$cat->desc}}"
                                                                data-action="{{route('typeCategory.update',$cat->id)}}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editTypeCat"
                                                                data-toggle="tooltip">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        @method('PUT')
                                                    @endcan

                                                    @can('delete',\App\Models\TypeCategory::class)
                                                        <button type="button" class="btn btn-danger"
                                                                data-toggle="tooltip"
                                                                data-title="حذف نوع دسته بندی"
                                                                data-action="{{route('typeCategory.destroy',$cat->id)}}"
                                                                onclick="deleteTypeCategory(this)">
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
            </div>
        </div>

    </div>


    <div class="modal fade " id="addTypeCat" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافه کردن دسته بندی</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="addTypeCatForm"
                      data-action="{{route('typeCategory.store')}}" class=" form-contact ">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3 col-12">
                            <label for="formrow-firstname-input" class="form-label">عنوان دسته بندی </label>
                            <input id="name" name="name" type="text" class="form-control edit-role">
                        </div>
                        <div class="mb-3 col-12">
                            <label for="formrow-firstname-input" class="form-label">نوع دسته بندی </label>
                            <input id="type" name="type" type="text" class="form-control edit-role">
                        </div>
                        <div id="catContent"></div>
                        <div class="mb-3 col-12">
                            <label for="formrow-firstname-input" class="form-label">عکس</label>
                            <div id="elfinder"></div>
                            <input id="image" name="image" type="text" class="form-control">
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
    <div class="modal fade " id="editTypeCat" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ویرایش دسته بندی</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateCatTypeForm"
                      data-action="" class=" form-contact ">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 col-12">
                            <label for="formrow-firstname-input" class="form-label">عنوان دسته بندی </label>
                            <input id="titleEdit" name="name" type="text" class="form-control edit-role">
                        </div>
                        <div class="mb-3 col-12">
                            <label for="formrow-firstname-input" class="form-label">نوع دسته بندی </label>
                            <input id="typeEdit" name="type" type="text" class="form-control edit-role">
                        </div>
                        <div class="mb-3 col-12">
                            <label for="formrow-firstname-input" class="form-label">عکس</label>
                            <div id="elfinder2"></div>
                            <input id="image_edit" name="image" type="text" class="form-control">
                        </div>
                        <div id="content_edit"></div>
                        <div class="my-3 col-12">
                            <img style="height: 60px" id="imageEdit" src="" alt="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                        <div>
                            <button type="submit"
                                    data-action="" type="button"
                                    class="btn btn-success w-md">ویرایش
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
