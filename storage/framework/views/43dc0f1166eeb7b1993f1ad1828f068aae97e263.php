<section class="gallery-section">
    <div class="container">
        <div class="section-title">
            <h2>گالری عکس</h2>
        </div>
        <ul class="filter-menu">
            <li class="filter active" data-filter="all">همه</li>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $place): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <li class="filter" data-filter=".hall_<?php echo e($place->id); ?>"> <?php echo e($place->title); ?></li>
                
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

        <div id="Container" class="row">
            <?php $__currentLoopData = $places; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $place): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="col-lg-4 col-sm-6 mix hall_<?php echo e($place->categories->id); ?>">

                    <div class="single-work">
                        <div class="work-image">
                            <img src="<?php echo e($place->image[0]); ?>" alt="gallery">
                            <a href="<?php echo e(route('single.place',['id'=>$place->id])); ?>"
                               class="popup-btn"><?php echo e($place->name); ?></a>
                        </div>
                    </div>

                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        </div>



    </div>
</section>
<?php /**PATH I:\Projects\reservasion\resources\views/booking/home/gallery.blade.php ENDPATH**/ ?>