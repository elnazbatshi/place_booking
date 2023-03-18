<?php $__env->startSection('styleCss'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        // $('#js-example-basic-hide-search-multi').select2();
        //
        // $('#js-example-basic-hide-search-multi').on('select2:opening select2:closing', function( event ) {
        //     var $searchfield = $(this).parent().find('.select2-search__field');
        //     $searchfield.prop('disabled', true);
        // });
        $('.tags').select2();
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">مدیریت تگ ها</h4>
                            <div class="d-flex">
                                <span>  انتخاب تگ های صفحه اصلی به صورت خودکار  </span>
                                <div class="form-check form-switch mx-3">
                                    <input data-action="<?php echo e(route('admin.changeStatusKeyword')); ?>"
                                           onchange="changeStatusKeyword(this)"
                                           class="form-check-input" type="checkbox"
                                           name="darkmode" data-status="<?php echo e($selected->name); ?>"
                                        <?php echo e($selected->name=='default' ?  "checked" : " "); ?> >
                                </div>
                            </div>
                            <div class="page-title-left">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">پنل</a></li>
                                    <li class="breadcrumb-item active">مدیریت تگ</li>
                                </ol>


                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <label for="formrow-firstname-input" class="form-label">تگ ها</label>
                        <select name="tags[]" style=" width: 100%"
                                class="form-control tags" id="tagsKeyword" multiple>

                            <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php echo e($selected_tag?(in_array($tag, json_decode($selected_tag)))?'selected="selected"' : " ":" "); ?> >
                                    <?php echo e($tag); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div>
                            <button onclick="updateKeyword(this)" data-action=<?php echo e(route('admin.storeTags')); ?> type="button"
                                    class="btn btn-success mt-4 float-end ">ثبت
                            </button>
                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div>

    </div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH I:\Projects\booking2\resources\views/admin/manage/tags/index.blade.php ENDPATH**/ ?>