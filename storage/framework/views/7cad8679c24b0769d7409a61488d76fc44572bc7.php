<?php $__env->startSection('content'); ?>
    <section class="page-banner">
        <div class="container">
            <?php if(request()->tags): ?>
                <p><a href="<?php echo e(route('site.index')); ?>">صفحه اصلی</a>/ کلید واژه <?php echo e(request()->tags); ?> </p>
            <?php else: ?>
                <p><a href="<?php echo e(route('site.index')); ?>">صفحه اصلی</a> /  تالارها</p>
            <?php endif; ?>
            <div class="page-banner-content">
                <?php if(request()->tags): ?>
                    <h2> #<?php echo e(request()->tags); ?></h2>
                <?php else: ?>
                    <?php if(request()->category): ?>
                        <h2>همه سالن ها</h2>
                    <?php else: ?>
                        <h2><?php echo e(request()->category); ?></h2>
                    <?php endif; ?>

                <?php endif; ?>
            </div>
        </div>
    </section>
    <div class="blog-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="blog-sidebar">
                        <?php if(!request()->tags): ?>
                            <div class="widget widget_categories">
                                <h3 class="title">دسته بندی ها</h3>
                                <ul>
                                    <li>
                                        <a class="<?php echo e((request()->category==NULL)?'color-title' : ""); ?>"
                                           href="<?php echo e(route('archive.place')); ?>">همه ی تالار ها</a>
                                    </li>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a class="<?php echo e((request()->category==$category->id)?'color-title' : ""); ?>"
                                               href="<?php echo e(route('archive.place',$category->id)); ?>"><?php echo e($category->title); ?></a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>

                            <div class="widget widget_tags">
                                <h3 class="title">برچسب ها</h3>
                                <ul>

                                    <?php $__currentLoopData = $allTags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($tag!==null): ?>
                                        <li>
                                            <a href="<?php echo e(route('site.archive.tag',['tags'=>$tag])); ?>"><?php echo e($tag); ?></a>
                                        </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if(request()->tags): ?>
                <div class="col-lg-12">
                    <?php else: ?>
                        <div class="col-lg-9">
                    <?php endif; ?>
                    <div class="row">

                        <?php $__currentLoopData = $places; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $place): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-4 col-md-6">
                                <div class="single_blog">
                                    <div class="blog-image">
                                        <a href="#">
                                            <img src="<?php echo e($place->image[0]); ?>" alt="">
                                        </a>
                                    </div>
                                    <div class="blog-item">
                                        <a href="<?php echo e(route('single.place',$place->id)); ?>"><h3><?php echo e($place->name); ?></h3></a>
                                        <a href="<?php echo e(route('single.place',$place->id)); ?>" class="button">مشاهده بیشتر</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('booking.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH I:\Projects\booking2\resources\views/booking/archive/placeArchive.blade.php ENDPATH**/ ?>