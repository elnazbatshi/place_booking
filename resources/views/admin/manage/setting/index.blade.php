@extends('admin.layouts.master')
@section('styleCss')
@endsection
@section('script')
    <script>
        function editSocial(sender) {
            $name = $(sender).data("socialName");
            $value = $(sender).data("socialValue");
            $id = $(sender).data("socialId");
            console.log($name, $value)
            $('#update-name').val($name);
            $('#update-value').val($value);
            $('#id').val($id);
        }


        // image uploader
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
                        //$('#elfinder').dialog('close');
                        $('#editor1').val(file.toString());
                        fm.hide();
                    },
                })
            });
        });


    </script>
    <script>
        var aboutUsEditor;
        ClassicEditor.create(document.querySelector('#aboutContent'), {
            language: {
                // The UI will be English.
                ui: 'en',

                // But the content will be edited in Arabic.
                content: 'ar'
            },
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'imageUpload', 'ckfinder', 'blockQuote', 'insertTable', 'mediaEmbed', 'undo', 'redo']
        })
            .then(editor => {
                aboutUsEditor = editor;
                aboutUsEditor.keystrokes.set('space', (key, stop) => {
                    aboutUsEditor.execute('input', {text: '\u00a0'});
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


@endsection
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">تنظیمات شبکه های
                            اجتماعی
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">درباره ما
                        </button>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <form method="post" data-type="social" class="addSettingForm"
                              action="{{route('admin.storeSetting')}}">
                            <div class="form-group">
                                <label for="exampleInputEmail1">نام </label>
                                <input name="name" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="address">آدرس </label>
                                <input name="address" type="text" class="form-control" id="address"
                                       placeholder="آدرس را وارد کنید">
                            </div>

                            <button style="float: left;" type="submit" class="btn btn-primary my-3">ثبت</button>
                        </form>
                        <br>
                        <div class="container-fluid">
                            <table class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">نام</th>
                                    <th scope="col">آدرس</th>
                                    <th scope="col">عملیات</th>
                                </tr>
                                </thead>
                                <tbody id="social-table">
                                @include('admin.manage.setting.ajax.table-social')
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div>
                            <form method="post" data-type="info" id="addInfoForm"
                                  action="{{route('admin.storeInfo')}}" class=" form-contact ">
                                @csrf
                                <div class="form-row pt-4">
                                    <div class="form-group col-lg-6 col-md-6">
                                        <label for="email">ایمیل</label>
                                        <input value="{{isset($info) ? $info->email:''}}" name="email" type="email"
                                               class="form-control" id="email">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-6 col-md-6">
                                        <label for="phoneNumber">شماره همراه</label>
                                        <input value="{{isset($info) ? $info->phoneNumber:''}}" name="phoneNumber"
                                               type="text" class="form-control" id="phoneNumber">
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6">
                                        <label for="address"> آدرس</label>
                                        <input {{isset($info) ? $info->address:''}} name="address" type="text"
                                               class="form-control" id="address">
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6">
                                        <label for="address"> درباره ما</label>
                                        <div id="aboutContent">
                                            {!! isset($info) ? $info->description:'' !!}
                                        </div>
                                        <img style="height: 100px;" class="my-3" id="my_image"
                                             src="{!! isset($info) ? $info->image:'booking/images/upload-icon-15.png' !!}"
                                             alt="">
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6">
                                        <div id="elfinder">
                                        </div>
                                        <input value=" {!! isset($info) ? $info->image:'' !!}" name="image"
                                               class="form-control"
                                               type="text" id="editor1">
                                    </div>

                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary my-4 float-end"> بروز رسانی
                                        </button>
                                    </div>

                                </div>

                            </form>
                        </div>
                        <div class="container-fluid">
                            <table class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ایمیل</th>
                                    <th scope="col">آدرس</th>
                                    <th scope="col">شماره تلفن</th>
                                    <th scope="col">توضیحات</th>
                                    <th scope="col">عکس</th>

                                </tr>
                                </thead>
                                <tbody id="info-table">
                                @include('admin.manage.setting.ajax.table-info')
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<div class="modal fade " id="editSocialModal" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ویرایش شبکه اجتماعی</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label for="formrow-firstname-input" class="form-label">نام </label>
                    <input id="update-name" type="text" class="form-control ">
                </div>
                <div class="mb-3">
                    <label for="formrow-firstname-input" class="form-label">آدرس </label>
                    <input id="update-value" type="text" class="form-control ">
                </div>
                <input id="id" type="hidden">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                <div>
                    <button data-update-social onclick="updateSocial(this)"
                            data-action="{{route('admin.updateSocial')}}" type="button"
                            class="btn btn-primary w-md">ویرایش
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
