
    <div class="profile-col">
        <div class="profile-lastOrder">
            <div class="profile-heading"> لیست سفارش ها</div>
            <div class="overx">
                <ul class="profile-lastOrder-box">
                    <li class="pull-right"> شماره سفارش</li>
                    <li class="pull-right">تاریخ ثبت</li>
                    <li class="pull-right">تالار</li>
                    <li class="pull-right">وضعیت</li>
                    <li class="pull-right">از ساعت</li>
                    <li class="pull-right">تا ساعت</li>
                </ul><!-- .profile-lastOrder-box-->
            </div>
            <div class="profile-lastOrder-row row">
                <div class="col-sm-1 col-2">
                    <ul class="profile-lastOrder-colnum ">

                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="lastOrder-num"><?php echo e($loop->index+1); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul><!-- .profile-lastOrder-colnum-->
                </div>
                <div class="col-sm-11 col-10">
                    <div class="profile-lastOrder-col">
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <ul class="row profile-lastOrder-item">
                                <li class="pull-right"><?php echo e($order->orderId); ?></li>
                                <li class="pull-right font-12"><?php echo e($order->day_fa); ?></li>
                                <li class="pull-right"><?php echo e($order->location->name); ?></li>
                                <li class=" pull-right <?php if($order->status==\App\Models\Order::STATUS_ACTIVE): ?> text-success <?php elseif($order->status==\App\Models\Order::STATUS_PENDING): ?> text-warning <?php else: ?> error <?php endif; ?> "><?php echo e(trans('orders.'.$order->status)); ?> </li>
                                <li class="pull-right"><?php echo e($order->strtTime); ?></li>
                                <li class="pull-right"><?php echo e($order->endTime); ?></li>



                            </ul>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div><!-- .profile-lastOrder-col -->
                </div>
            </div><!-- .profile-lastOrder-row-->












        </div><!-- .profile-lastOrder -->
    </div><!-- .profile-col -->

<?php /**PATH I:\Projects\booking2\resources\views/booking/panel/orders.blade.php ENDPATH**/ ?>