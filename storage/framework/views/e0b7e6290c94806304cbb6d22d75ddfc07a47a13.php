<?php $__env->startSection('styleCss'); ?>

    <style>
        .ck-editor__editable_inline {
            min-height: 150px;
        }
    </style>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
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
    <?php echo $__env->make('admin.js.ckeditor',['command'=>'editor'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                <form id="formLocation" method="post" enctype="multipart/form-data" class="custom-validation"
                      <?php if(isset($post)): ?> data-action="<?php echo e(route('location.update',$post->id)); ?>" data-type="update"
                      <?php else: ?> data-action="<?php echo e(route('location.store')); ?>" data-type="store" <?php endif; ?>>
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-12 text-start mb-2">
                            <div class="d-flex flex-wrap gap-2 float-end">
                                <?php if(isset($post)): ?>
                                    <button type="submit" class="btn btn-success waves-effect waves-s">
                                        ویرایش
                                    </button>
                                <?php else: ?>
                                    <button type="submit" class="btn btn-success waves-effect waves-s">
                                        ثبت
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-body">
                                    <?php if(isset($post)): ?>
                                        <h4 class="card-title">ویرایش </h4>
                                        <p class="card-title-desc">در این قسمت خود را ویرایش کنید</p>
                                    <?php else: ?>
                                        <h4 class="card-title">ساختن مکان جدید</h4>
                                        <p class="card-title-desc">در این قسمت جدید خود را بسازید</p>
                                    <?php endif; ?>

                                    <div class="mb-3">
                                        <label class="form-label">عنوان </label>
                                        <input value="<?php echo e(isset($post) ? $post->name:''); ?>" id="name" name="name"
                                               type="text"
                                               class="form-control" required=""
                                               placeholder="عنوان">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">متن خود را وارد کنید</label>
                                        <div>
                                            <div id="editor">
                                                <?php echo isset($post) ? $post->desc:''; ?>

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
                                                                    <div class="dz-message needsclick" id="main_image">
                                                                        <?php if(isset($post)): ?>
                                                                            <?php $__currentLoopData = $post->image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img_src): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <div class="imageGallery my-3">
                                                                                    <input type='hidden'
                                                                                           value="<?php echo e($img_src); ?>">
                                                                                    <div onclick="deleteImage(this)"
                                                                                         class="closeImage">x
                                                                                    </div>
                                                                                    <img
                                                                                        src="<?php echo e($img_src); ?>"
                                                                                        alt="">
                                                                                </div>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php else: ?>
                                                                            <div class="mb-3 iconImageIndex">
                                                                                <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                                                            </div>
                                                                            <h4>فایل خود را در فایل منیجر انتخاب
                                                                                کنید</h4>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="text-center mt-4">
                                                                <div id="elfinder1"></div>
                                                                <input value="<?php echo e((isset($post   ))?implode(',',$post->image):''); ?>" name="image"
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
                                            <input value="<?php echo e(isset($post) ? $post->index:''); ?>" name="index"
                                                   class="form-control" type="number">
                                        </div>
                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">دسته بندی ها</label>
                                            <div class="form-group">
                                                <select class="form-control" name="cat_id">

                                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option
                                                            <?php if(isset($post)): ?> <?php echo e(($post->id==$cat->id) ?'selected=selected':" "); ?><?php endif; ?>    value="<?php echo e($cat->id); ?>">
                                                            <?php echo e($cat->title); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">تگ ها</label>
                                            <br>
                                            <select name="tags[]" class="form-control tags" multiple="multiple">
                                                <?php if(isset($post) && !empty($post->tags)): ?>
                                                    <?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option selected="selected" value="<?php echo e($tag); ?>"><?php echo e($tag); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">گالری عکس ها </label>
                                            <div id="elfinder1"></div>
                                            <input
                                                <?php if(isset($post)): ?> value="<?php echo e(implode(',',$post->files)); ?>"
                                                <?php endif; ?> name="files" class="form-control" type="text" id="fileRelated">
                                            <div class="allFiles">
                                            </div>
                                            <?php if(isset($post)): ?>
                                                <?php $__currentLoopData = $post->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="main-file">
                                                        <img style="height: 100px;" src="<?php echo e($file); ?>" alt="">
                                                        <span onclick="deleteFile(this)" class="deleteFile">X</span>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                            <label for="formrow-firstname-input" class="form-label">فایل ویدیویی</label>
                                            <div id="elfinder3"></div>
                                            <input
                                                <?php if(isset($post)): ?> value="<?php echo e(implode(',',$post->video)); ?>"
                                                <?php endif; ?> name="video" class="form-control" type="text" id="Videofile">
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



<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH I:\Projects\booking2\resources\views/admin/manage/location/create.blade.php ENDPATH**/ ?>