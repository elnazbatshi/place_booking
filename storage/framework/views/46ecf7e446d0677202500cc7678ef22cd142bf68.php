<?php $__env->startSection('script'); ?>
    <script>

        <?php if(session()->has('set_order')): ?>
            toastr["success"]('<?php echo e(session()->get('set_order')); ?>');
        <?php endif; ?>
        $('.owl-single-image').owlCarousel({
            loop: true,
            autoplay: false,
            nav: true,
            rtl: true,
            center: true,
            margin: 30,
            smartSpeed: 1000,
            mouseDrag: true,
            autoplayHoverPause: true,
            responsiveClass: true,
            dots: true,
            navText: ["<i class='flaticon-left-arrow-key'></i>", "<i class='flaticon-keyboard-right-arrow-button'></i>"],
            navText: ["<i class='flaticon-left-arrow-key'></i>", "<i class='flaticon-keyboard-right-arrow-button'></i>"],
            responsive: {
                0: {
                    items: 1,
                },
                768: {
                    items: 1,
                },
                1200: {
                    items: 1,
                }
            }
        });
    </script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <!-- Page banner -->
    <section class="page-banner">
        <div class="container">
            <div class=" d-flex justify-content-between">

                <p><a href="<?php echo e(route('site.index')); ?>">صفحه اصلی</a> /<?php echo e($place->name); ?></p>

            </div>
        </div>
    </section>
    <!-- End Page banner -->
    <!-- Blog section -->
    <div class="blog-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="blog-details">

                        <div class="owl-carousel   owl-single-image">
                            <?php $__currentLoopData = $place->image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item">
                                    <img src="<?php echo e($image); ?>" alt="">
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <div class="blog-details-content">
                            <div class="d-flex justify-content-between">
                                <h3 class="heading"><?php echo e($place->name); ?></h3>
                                <a href="<?php echo e(route('panel.setOrder',['hall'=>$place->id])); ?>" class="button btn-h">رزو سالن</a>
                            </div>

                            <ul class="blog-list">
                                <li>
                                    <a href="#">
                                        <i class="icofont-user-alt-4"></i>
                                        <?php echo e($place->categories->title); ?>

                                    </a>
                                </li>
                                <li>
                                    <i class="icofont-calendar"></i>
                                    <span>
                                          <span>نفر</span>
                                        <span><?php echo e($place->index); ?></span>
                                     </span>
                                </li>
                            </ul>

                            <div class="blog-details-text">
                                <?php echo $place->desc; ?>

                            </div>

                            <div class="post-tag-media">
                                <ul class="tag">
                                    <li><span>برچسب ها:</span></li>

                                    <?php if($place->tags): ?>
                                    <?php $__currentLoopData = $place->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a href="<?php echo e(route('site.archive.tag',['tags'=>$tag])); ?>"># <?php echo e($tag); ?></a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                        <section class="testimonials-section pt-0">
                            <div class="container">
                                <div class="section-title">
                                    <h2>گالری عکس ها</h2>
                                </div>
                                <div class="testimonials-slider">
                                    <?php $__currentLoopData = $place->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="single_blog">
                                            <div class="blog-image">
                                                <a>
                                                    <img src="<?php echo e($img); ?>" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </section>
                        <section class="testimonials-section pt-0">
                            <div class="container">
                                <div class="section-title">
                                    <h2>تالار های مشابه</h2>
                                </div>
                                <div class="testimonials-slider">
                                    <?php $__currentLoopData = $related_loc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r_loc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="single_blog">
                                            <div class="blog-image">
                                                <a href="<?php echo e(route('single.place',$r_loc->id)); ?>">
                                                    <img src="<?php echo e($r_loc->image[0]); ?>" alt="">
                                                </a>
                                            </div>
                                            <div class="blog-item">
                                                <a href="<?php echo e(route('single.place',$r_loc->id)); ?>"><h3><?php echo e($r_loc->name); ?></h3>
                                                </a>
                                                <a href="<?php echo e(route('single.place',$r_loc->id)); ?>" class="button">مشاهده
                                                    بیشتر</a>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Blog section -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('booking.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH I:\Projects\reservasion\resources\views/booking/single/placeSingle.blade.php ENDPATH**/ ?>