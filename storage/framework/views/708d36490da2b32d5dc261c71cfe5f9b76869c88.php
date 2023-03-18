
<?php $__env->startSection('styleCss'); ?>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        <?php if(session()->has('post_flash')): ?>
            toastr["success"]('<?php echo e(session()->get('post_flash')); ?>');
        <?php endif; ?>
        // function editPost(sender){
        //     var action=$(sender).attr("data-action");
        //
        //
        //     $.ajax({
        //         url: action,
        //         type: "get",
        //         dataType: "JSON",
        //         success(response) {
        //             console.log(response);
        //             if (response.status == true) {
        //              var post=response.post;
        //
        //
        //
        //
        //
        //             } else {
        //                 toastr["error"]('خطا در ارتباط با سرور! دوباره امتحان کنید')
        //             }
        //         },
        //         error(error) {
        //             if (error.status == 422) {
        //                 console.log(error);
        //             }
        //         },
        //     });
        //
        //
        // }

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
                            <h4 class="mb-sm-0 font-size-18">مدیریت اسلایدر ها</h4>

                            <div class="page-title-left">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">پنل</a></li>
                                    <li class="breadcrumb-item active">مدیریت اسلایدر ها</li>
                                </ol>


                                <a href="<?php echo e(route('slider.create')); ?>">
                                    <button class="btn btn-success">اضافه کردن اسلایدر
                                    </button>
                                </a>
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
                                            <th scope="col">عنوان</th>
                                            <th scope="col"> دسته بندی</th>
                                            <th scope="col">عکس شاخص</th>
                                            <th scope="col">عملیات</th>

                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                                            <tr id="slider_<?php echo e($slider->id); ?>">
                                                <td>
                                                    <?php echo e($slider->id); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($slider->title); ?>

                                                </td>
                                                <td>
                                                    <?php $__currentLoopData = $slider->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <span class="badge bg-success font-size-large">
                                                           <?php echo e($category->title); ?>

                                                    </span>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </td>
                                                <td>
                                                    <img style="width: 50px" src="<?php echo e($slider->img_src); ?>" alt="">
                                                </td>


                                                <td>
                                                    <a href="<?php echo e(route('slider.edit',$slider->id)); ?>">
                                                        <button type="button" class="btn btn-primary"
                                                                data-title="ویرایش اسلایدر"
                                                                data-action="<?php echo e(route('slider.edit',$slider->id)); ?>">

                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    </a>

                                                    <button type="button" class="btn btn-danger" data-toggle="tooltip"
                                                            data-title="حذف اسلایدر"
                                                            data-action="<?php echo e(route('slider.destroy',$slider->id)); ?>"

                                                            onclick="deleteSlider(this)">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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



<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH I:\Projects\booking2\resources\views/admin/manage/slider/index.blade.php ENDPATH**/ ?>