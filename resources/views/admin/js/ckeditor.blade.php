@if($command =='all')
    <script>
        var theEditor;
    CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
        // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
        toolbar: {
            items: [
                'exportPDF','exportWord', '|',
                'findAndReplace', 'selectAll', '|',
                'heading', '|',
                'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                'bulletedList', 'numberedList', 'todoList', '|',
                'outdent', 'indent', '|',
                'undo', 'redo',
                '-',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                'alignment', '|',
                'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                'textPartLanguage', '|',
                'sourceEditing'
            ],
            shouldNotGroupWhenFull: true
        },
        // Changing the language of the interface requires loading the language file using the <script> tag.
        // language: 'es',
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
            ]
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
        placeholder: '',
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
        fontFamily: {
            options: [
                'default',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
        fontSize: {
            options: [ 10, 12, 14, 'default', 18, 20, 22 ],
            supportAllValues: true
        },
        // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
        // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
        htmlSupport: {
            allow: [
                {
                    name: /<i[^>]*><\/i>/g,
                    attributes: true,
                    classes: true,
                    styles: true
                }
            ]
        },
        // Be careful with enabling previews
        // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
        htmlEmbed: {
            showPreviews: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
        link: {
            decorators: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: {
                        download: 'file'
                    }
                }
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
        mention: {
            feeds: [
                {
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }
            ]
        },
        // The "super-build" contains more premium features that require additional configuration, disable them below.
        // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
        removePlugins: [
            // These two are commercial, but you can try them out without registering to a trial.
            // 'ExportPdf',
            // 'ExportWord',
            'CKBox',
            'CKFinder',
            'EasyImage',
            // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
            // Storing images as Base64 is usually a very bad idea.
            // Replace it on production website with other solutions:
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
            // 'Base64UploadAdapter',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
            // from a local file system (file://) - load this site via HTTP server if you enable MathType
            'MathType'
        ]
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
    var semicontentEditor;
    CKEDITOR.ClassicEditor.create(document.getElementById("semiContent"), {
        // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
        toolbar: {
            items: [
                'exportPDF','exportWord', '|',
                'findAndReplace', 'selectAll', '|',
                'heading', '|',
                'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                'bulletedList', 'numberedList', 'todoList', '|',
                'outdent', 'indent', '|',
                'undo', 'redo',
                '-',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                'alignment', '|',
                'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                'textPartLanguage', '|',
                'sourceEditing'
            ],
            shouldNotGroupWhenFull: true
        },
        // Changing the language of the interface requires loading the language file using the <script> tag.
        // language: 'es',
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
            ]
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
        placeholder: '',
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
        fontFamily: {
            options: [
                'default',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
        fontSize: {
            options: [ 10, 12, 14, 'default', 18, 20, 22 ],
            supportAllValues: true
        },
        // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
        // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
        htmlSupport: {
            allow: [
                {
                    name: /<i[^>]*><\/i>/g,
                    attributes: true,
                    classes: true,
                    styles: true
                }
            ]
        },
        // Be careful with enabling previews
        // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
        htmlEmbed: {
            showPreviews: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
        link: {
            decorators: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: {
                        download: 'file'
                    }
                }
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
        mention: {
            feeds: [
                {
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }
            ]
        },
        // The "super-build" contains more premium features that require additional configuration, disable them below.
        // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
        removePlugins: [
            // These two are commercial, but you can try them out without registering to a trial.
            // 'ExportPdf',
            // 'ExportWord',
            'CKBox',
            'CKFinder',
            // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
            // Storing images as Base64 is usually a very bad idea.
            // Replace it on production website with other solutions:
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
            // 'Base64UploadAdapter',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
            // from a local file system (file://) - load this site via HTTP server if you enable MathType
            'MathType'
        ]
    })
        .then(editor => {
            semicontentEditor = editor;
            semicontentEditor.keystrokes.set('space', (key, stop) => {
                semicontentEditor.execute('input', {text: '\u00a0'});
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
        });</script>
@elseif($command =='editor')
    <script>        var theEditor;
        CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
            // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
            toolbar: {
                items: [
                    'exportPDF','exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            // Changing the language of the interface requires loading the language file using the <script> tag.
            // language: 'es',
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
            placeholder: '',
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
            fontSize: {
                options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                supportAllValues: true
            },
            // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
            // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
            htmlSupport: {
                allow: [
                    {
                        name: /<i[^>]*><\/i>/g,
                        attributes: true,
                        classes: true,
                        styles: true
                    }
                ]
            },
            // Be careful with enabling previews
            // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
            htmlEmbed: {
                showPreviews: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
            mention: {
                feeds: [
                    {
                        marker: '@',
                        feed: [
                            '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                            '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                            '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                            '@sugar', '@sweet', '@topping', '@wafer'
                        ],
                        minimumCharacters: 1
                    }
                ]
            },
            // The "super-build" contains more premium features that require additional configuration, disable them below.
            // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
            removePlugins: [
                // These two are commercial, but you can try them out without registering to a trial.
                // 'ExportPdf',
                // 'ExportWord',
                'CKBox',
                'CKFinder',
                'EasyImage',
                // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                // Storing images as Base64 is usually a very bad idea.
                // Replace it on production website with other solutions:
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                // 'Base64UploadAdapter',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                // from a local file system (file://) - load this site via HTTP server if you enable MathType
                'MathType'
            ]
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
    @elseif($command =='menu')
    <script>
    var addDEs;
    //editorDescription
    CKEDITOR.ClassicEditor.create(document.getElementById("editorDescription"), {
    // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
    toolbar: {
    items: [
    'exportPDF','exportWord', '|',
    'findAndReplace', 'selectAll', '|',
    'heading', '|',
    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
    'bulletedList', 'numberedList', 'todoList', '|',
    'outdent', 'indent', '|',
    'undo', 'redo',
    '-',
    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
    'alignment', '|',
    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
    'textPartLanguage', '|',
    'sourceEditing'
    ],
    shouldNotGroupWhenFull: true
    },
    // Changing the language of the interface requires loading the language file using the <script> tag.
            // language: 'es',
            list: {
            properties: {
                styles: true,
                    startIndex: true,
                    reversed: true
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
            ]
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
        placeholder: '',
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
            fontFamily: {
            options: [
                'default',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif'
            ],
                supportAllValues: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
        fontSize: {
            options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                supportAllValues: true
        },
        // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
        // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
        htmlSupport: {
            allow: [
                {
                    name: /<i[^>]*><\/i>/g,
                    attributes: true,
                    classes: true,
                    styles: true
                }
            ]
        },
        // Be careful with enabling previews
        // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
        htmlEmbed: {
            showPreviews: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
        link: {
            decorators: {
                addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                    mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                        download: 'file'
                    }
                }
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
        mention: {
            feeds: [
                {
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }
            ]
        },
        // The "super-build" contains more premium features that require additional configuration, disable them below.
        // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
        removePlugins: [
            // These two are commercial, but you can try them out without registering to a trial.
            // 'ExportPdf',
            // 'ExportWord',
            'CKBox',
            'CKFinder',
            'EasyImage',
            // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
            // Storing images as Base64 is usually a very bad idea.
            // Replace it on production website with other solutions:
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
            // 'Base64UploadAdapter',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
            // from a local file system (file://) - load this site via HTTP server if you enable MathType
            'MathType'
        ]
        })
        .then(editor => {
            addDEs = editor;
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
        //ckEditor for edit
        var editDEs;
        //menuDescEdit
        CKEDITOR.ClassicEditor.create(document.getElementById("menuDescEdit"), {
            // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
            toolbar: {
                items: [
                    'exportPDF','exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            // Changing the language of the interface requires loading the language file using the <script> tag.
            // language: 'es',
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
            placeholder: '',
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
            fontSize: {
                options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                supportAllValues: true
            },
            // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
            // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
            htmlSupport: {
                allow: [
                    {
                        name: /<i[^>]*><\/i>/g,
                        attributes: true,
                        classes: true,
                        styles: true
                    }
                ]
            },
            // Be careful with enabling previews
            // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
            htmlEmbed: {
                showPreviews: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
            mention: {
                feeds: [
                    {
                        marker: '@',
                        feed: [
                            '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                            '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                            '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                            '@sugar', '@sweet', '@topping', '@wafer'
                        ],
                        minimumCharacters: 1
                    }
                ]
            },
            // The "super-build" contains more premium features that require additional configuration, disable them below.
            // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
            removePlugins: [
                // These two are commercial, but you can try them out without registering to a trial.
                // 'ExportPdf',
                // 'ExportWord',
                'CKBox',
                'CKFinder',
                'EasyImage',
                // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                // Storing images as Base64 is usually a very bad idea.
                // Replace it on production website with other solutions:
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                // 'Base64UploadAdapter',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                // from a local file system (file://) - load this site via HTTP server if you enable MathType
                'MathType'
            ]
        })
            .then(editor => {
                editDEs = editor;
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
@endif
