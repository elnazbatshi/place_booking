<section class="about-section">
    <div class="container">
        <div class="section-title">
            <h2>درباره ما</h2>
            <p><?php echo e($aboutUs->name); ?></p>
        </div>

        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-12">
                <div class="about-content">







                    <?php echo $aboutUs->content; ?>

                </div>
            </div>

            <div class="col-xl-6 col-lg-12">
                <div class="property-slider">
                    <?php $__currentLoopData = explode(',',$aboutUs->img_src); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item">
                            <img src="<?php echo e($img); ?>">
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH I:\Projects\reservasion\resources\views/booking/home/aboutUs.blade.php ENDPATH**/ ?>