<?php $__currentLoopData = $mainSlider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="main-banner" style="background-image:url(<?php echo e(asset($slide->img_src)); ?>);">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="hero-slider-content">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="get-appointment-form">
                                <h1><?php echo e($slide->title); ?></h1>
                                <?php echo $slide->content; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH I:\Projects\booking2\resources\views/booking/home/slider.blade.php ENDPATH**/ ?>