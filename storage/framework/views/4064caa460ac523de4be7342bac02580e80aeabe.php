
<?php $__env->startSection('styleCss'); ?>

    <style>
        .ck-editor__editable_inline {
            min-height: 150px;
        }
    </style>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>


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
                        for (var i = 0; i < file.length; i++) {
                            $("#my_image").append("<img style='max-height: 100px;' class='m-1' src=" + file[i] + ">");
                        }

                        $('.iconImageIndex').addClass('d-none');
                        //$('#elfinder').dialog('close');
                        $('#editor1').val(file.toString());
                        fm.hide();
                    },
                })
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


<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <form id="formGallery" method="post" enctype="multipart/form-data" class="custom-validation"
                      <?php if(isset($galleries)): ?> data-action="<?php echo e(route('gallery.update',$galleries->id)); ?>" data-type="update"
                      <?php else: ?> data-action="<?php echo e(route('gallery.store')); ?>" data-type="store" <?php endif; ?>>
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-12 text-start mb-2">
                            <div class="d-flex flex-wrap gap-2 float-end">
                                <?php if(isset($galleries)): ?>
                                    <button type="submit" class="btn btn-success waves-effect waves-s">
                                        ویرایش گالری
                                    </button>
                                <?php else: ?>
                                    <button type="submit" class="btn btn-success waves-effect waves-s">
                                        ثبت گالری
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-body">
                                    <?php if(isset($galleries)): ?>
                                        <h4 class="card-title">ویرایش گالری</h4>
                                        <p class="card-title-desc">در این قسمت گالری خود را ویرایش کنید</p>
                                    <?php else: ?>
                                        <h4 class="card-title">ساختن گالری جدید</h4>
                                        <p class="card-title-desc">در این قسمت گالری جدید خود را بسازید</p>
                                    <?php endif; ?>

                                    <div class="mb-3">
                                        <label class="form-label">عنوان گالری </label>
                                        <input value="<?php echo e(isset($galleries) ? $galleries->title:''); ?>" id="title"
                                               name="title"
                                               type="text"
                                               class="form-control" required=""
                                               placeholder="عنوان">
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

                                                            <h4 class="card-title">عکس های گالری </h4>
                                                            <div>
                                                                <div class="dropzone">
                                                                    <div class="dz-message needsclick">
                                                                        <?php if(!@$galleries->img_src): ?>
                                                                            <div class="mb-3 iconImageIndex">
                                                                                <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <div id="my_image">
                                                                            <?php if(@$galleries->img_src): ?> <?php $__currentLoopData = explode(',',$galleries->img_src); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <img style="height: 100px;"
                                                                                     src="<?php echo e(@$img); ?>"
                                                                                     alt="">
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?></div>
                                                                        <?php if(!@$galleries->img_src): ?>
                                                                            <h4>فایل های خود را در فایل منیجر انتخاب
                                                                                کنید</h4>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="text-center mt-4">
                                                                <div id="elfinder"></div>
                                                                <input value="<?php echo e(@$galleries->img_src); ?>" name="img_src"
                                                                       class="form-control"
                                                                       type="text" id="editor1"
                                                                       placeholder="برای باز شدن مدیریت فایل اینجا کلیک کنید">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
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



<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH I:\Projects\booking2\resources\views/admin/manage/gallery/create.blade.php ENDPATH**/ ?>