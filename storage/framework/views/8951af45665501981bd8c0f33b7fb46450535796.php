<section class="tab-section">
    <div class="container-fluid">
        <div class="section-title">
            <h2>سالن های حوزه هنری </h2>
            <p>لورم ایپسوم ساختار چاپ و متن را در بر می گیرد. لورم ایپسوم استاندارد صنعت بوده است. لورم ایپسوم چاپ و
                متن را در بر می گیرد. لورم ایپسوم استاندارد صنعت بوده است.</p>
        </div>

        <div class="row align-items-center bg-style">
            <div class="col-lg-6 p-0">
                <div class="tab-video">
                    <div class="video-btn">
                        <a href="https://www.youtube.com/watch?v=dEkqfPc88LU" class="popup-youtube">
                            <i class="flaticon-play-button"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 ">
                <div class="tab tab-style-area">
                    <ul class="tabs-work">
                        <?php $__currentLoopData = $places; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $place): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="<?php echo e(route('single.place',['id'=>$place->id])); ?>"><?php echo e($place->name); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>

                    <div class="tab_content">
                        <?php $__currentLoopData = $places; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $place): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="tabs_item">
                                <div class="tab-inner-content">
                                <?php echo $place->desc; ?>

                                    <div class="tab-btn">
                                        <a href="<?php echo e(route('single.place',['id'=>$place->id])); ?>" class="button">بیشتر بدانید</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH I:\Projects\reservasion\resources\views/booking/home/places.blade.php ENDPATH**/ ?>