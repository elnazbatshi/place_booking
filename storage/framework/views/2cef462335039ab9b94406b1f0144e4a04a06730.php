<div class="partner-section">
    <div class="container">
        <div class="section-title">
            <h2>دسته بندی</h2>

        </div>

        <div class="partner-slider owl-carousel owl-theme">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="partner-item">
                    <a href="<?php echo e(route('archive.place',['category'=>$category->id])); ?>"><img src="<?php echo e($category->img_src); ?>" alt="partner"></a>
                    <h1><?php echo e($category->title); ?></h1>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php /**PATH I:\Projects\booking2\resources\views/booking/home/category.blade.php ENDPATH**/ ?>