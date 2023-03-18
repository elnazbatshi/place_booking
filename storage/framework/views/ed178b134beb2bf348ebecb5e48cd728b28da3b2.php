
<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($status == 'all'): ?>
        <tr id="">
            <th scope="row"><?php echo e($order->id); ?></th>
            <td><?php echo e($order->location->name); ?></td>
            <td><?php echo e($order->customer->name); ?></td>
            <td><?php echo e($order->day_fa); ?></td>
            <td><?php echo e($order->startTime); ?></td>
            <td><?php echo e($order->endTime); ?></td>
            <td><?php echo e($order->id); ?></td>
            <td>
                <select
                    onchange="changeStatusPost(this)"
                    data-action="<?php echo e(route('order.changeStatus',$order->id)); ?>"
                    name="status" data-toggle="tooltip" data-placement="top"

                    class="form-select statusPost">
                    <option
                        <?php echo e(($order->status ==\App\Models\Order::STATUS_ACTIVE) ?'selected=selected':" "); ?>  value="<?php echo e(\App\Models\Order::STATUS_ACTIVE); ?>">
                        فعال
                    </option>
                    <option
                        <?php echo e(($order->status ==\App\Models\Order::STATUS_PENDING) ?'selected=selected':" "); ?>  value="<?php echo e(\App\Models\Order::STATUS_PENDING); ?>">
                        در حال بررسی
                    </option>
                    <option
                        <?php echo e(($order->status ==\App\Models\Order::STATUS_DEACTIVATE) ?'selected=selected':" "); ?>  value="<?php echo e(\App\Models\Order::STATUS_DEACTIVATE); ?>">
                        غیر فعال
                    </option>
                </select>
            </td>
            <td class="text-right text-nowrap">
                <button type="button" class="btn btn-primary" data-toggle="tooltip"
                        data-action="<?php echo e(route('contactUs.show',$order->id)); ?>"
                        data-name="<?php echo e($order->customer->name); ?>"
                        data-phone-number="<?php echo e($order->customer->mobile_number); ?>"
                        data-email="<?php echo e($order->customer->email); ?>"
                        data-subject="<?php echo e($order->subject); ?>"
                        data-message="<?php echo e($order->desc); ?>"
                        data-status="<?php echo e($order->status); ?>"
                        data-bs-toggle="modal"
                        data-bs-target="#showMessageModal"
                        onclick="showMessage(this)">
                    <i class="fa fa-eye"></i>
                </button>
                <button type="button" class="btn btn-danger" data-toggle="tooltip"
                        data-action="<?php echo e(route('contactUs.destroy',$order->id)); ?>"
                        onclick="deleteMessage(this)">
                    <i class="fa fa-trash"></i>
                </button>
                <button type="button" class="btn btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#showMessage">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </button>
            </td>
        </tr>
    <?php elseif($status == 'active' && $order->status ==\App\Models\Order::STATUS_ACTIVE): ?>
        <tr id="">
            <th scope="row"><?php echo e($order->id); ?></th>
            <td><?php echo e($order->location->name); ?></td>
            <td><?php echo e($order->customer->name); ?></td>
            <td><?php echo e($order->day_fa); ?></td>
            <td><?php echo e($order->startTime); ?></td>
            <td><?php echo e($order->endTime); ?></td>
            <td><?php echo e($order->id); ?></td>
            <td>
                <select
                    onchange="changeStatusPost(this)"
                    data-action="<?php echo e(route('order.changeStatus',$order->id)); ?>"
                    name="status" data-toggle="tooltip" data-placement="top"

                    class="form-select statusPost">
                    <option
                        <?php echo e(($order->status ==\App\Models\Order::STATUS_ACTIVE) ?'selected=selected':" "); ?>  value="<?php echo e(\App\Models\Order::STATUS_ACTIVE); ?>">
                        فعال
                    </option>
                    <option
                        <?php echo e(($order->status ==\App\Models\Order::STATUS_PENDING) ?'selected=selected':" "); ?>  value="<?php echo e(\App\Models\Order::STATUS_PENDING); ?>">
                        در حال بررسی
                    </option>
                    <option
                        <?php echo e(($order->status ==\App\Models\Order::STATUS_DEACTIVATE) ?'selected=selected':" "); ?>  value="<?php echo e(\App\Models\Order::STATUS_DEACTIVATE); ?>">
                        غیر فعال
                    </option>
                </select>
            </td>
            <td class="text-right text-nowrap">
                <button type="button" class="btn btn-primary" data-toggle="tooltip"
                        data-action="<?php echo e(route('contactUs.show',$order->id)); ?>"
                        data-name="<?php echo e($order->customer->name); ?>"
                        data-phone-number="<?php echo e($order->customer->mobile_number); ?>"
                        data-email="<?php echo e($order->customer->email); ?>"
                        data-subject="<?php echo e($order->subject); ?>"
                        data-message="<?php echo e($order->desc); ?>"
                        data-status="<?php echo e($order->status); ?>"
                        data-bs-toggle="modal"
                        data-bs-target="#showMessageModal"
                        onclick="showMessage(this)">
                    <i class="fa fa-eye"></i>
                </button>
                <button type="button" class="btn btn-danger" data-toggle="tooltip"
                        data-action="<?php echo e(route('contactUs.destroy',$order->id)); ?>"
                        onclick="deleteMessage(this)">
                    <i class="fa fa-trash"></i>
                </button>
                <button type="button" class="btn btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#showMessage">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </button>

            </td>
        </tr>
    <?php elseif($status == 'pending' && $order->status ==\App\Models\Order::STATUS_PENDING): ?>
        <tr id="">
            <th scope="row"><?php echo e($order->id); ?></th>
            <td><?php echo e($order->location->name); ?></td>
            <td><?php echo e($order->customer->name); ?></td>
            <td><?php echo e($order->day_fa); ?></td>
            <td><?php echo e($order->startTime); ?></td>
            <td><?php echo e($order->endTime); ?></td>
            <td><?php echo e($order->id); ?></td>
            <td>
                <select
                    onchange="changeStatusPost(this)"
                    data-action="<?php echo e(route('order.changeStatus',$order->id)); ?>"
                    name="status" data-toggle="tooltip" data-placement="top"

                    class="form-select statusPost">
                    <option
                        <?php echo e(($order->status ==\App\Models\Order::STATUS_ACTIVE) ?'selected=selected':" "); ?>  value="<?php echo e(\App\Models\Order::STATUS_ACTIVE); ?>">
                        فعال
                    </option>
                    <option
                        <?php echo e(($order->status ==\App\Models\Order::STATUS_PENDING) ?'selected=selected':" "); ?>  value="<?php echo e(\App\Models\Order::STATUS_PENDING); ?>">
                        در حال بررسی
                    </option>
                    <option
                        <?php echo e(($order->status ==\App\Models\Order::STATUS_DEACTIVATE) ?'selected=selected':" "); ?>  value="<?php echo e(\App\Models\Order::STATUS_DEACTIVATE); ?>">
                        غیر فعال
                    </option>
                </select>
            </td>
            <td class="text-right text-nowrap">
                <button type="button" class="btn btn-primary" data-toggle="tooltip"
                        data-action="<?php echo e(route('contactUs.show',$order->id)); ?>"
                        data-name="<?php echo e($order->customer->name); ?>"
                        data-phone-number="<?php echo e($order->customer->mobile_number); ?>"
                        data-email="<?php echo e($order->customer->email); ?>"
                        data-subject="<?php echo e($order->subject); ?>"
                        data-message="<?php echo e($order->desc); ?>"
                        data-status="<?php echo e($order->status); ?>"
                        data-bs-toggle="modal"
                        data-bs-target="#showMessageModal"
                        onclick="showMessage(this)">
                    <i class="fa fa-eye"></i>
                </button>
                <button type="button" class="btn btn-danger" data-toggle="tooltip"
                        data-action="<?php echo e(route('contactUs.destroy',$order->id)); ?>"
                        onclick="deleteMessage(this)">
                    <i class="fa fa-trash"></i>
                </button>
                <button type="button" class="btn btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#showMessage">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </button>


            </td>
        </tr>
    <?php elseif($status == 'deactivate' && $order->status ==\App\Models\Order::STATUS_DEACTIVATE): ?>
        <tr id="">
            <th scope="row"><?php echo e($order->id); ?></th>
            <td><?php echo e($order->location->name); ?></td>
            <td><?php echo e($order->customer->name); ?></td>
            <td><?php echo e($order->day_fa); ?></td>
            <td><?php echo e($order->startTime); ?></td>
            <td><?php echo e($order->endTime); ?></td>
            <td><?php echo e($order->id); ?></td>
            <td>
                <select
                    onchange="changeStatusPost(this)"
                    data-action="<?php echo e(route('order.changeStatus',$order->id)); ?>"
                    name="status" data-toggle="tooltip" data-placement="top"

                    class="form-select statusPost">
                    <option
                        <?php echo e(($order->status ==\App\Models\Order::STATUS_ACTIVE) ?'selected=selected':" "); ?>  value="<?php echo e(\App\Models\Order::STATUS_ACTIVE); ?>">
                        فعال
                    </option>
                    <option
                        <?php echo e(($order->status ==\App\Models\Order::STATUS_PENDING) ?'selected=selected':" "); ?>  value="<?php echo e(\App\Models\Order::STATUS_PENDING); ?>">
                        در حال بررسی
                    </option>
                    <option
                        <?php echo e(($order->status ==\App\Models\Order::STATUS_DEACTIVATE) ?'selected=selected':" "); ?>  value="<?php echo e(\App\Models\Order::STATUS_DEACTIVATE); ?>">
                        غیر فعال
                    </option>
                </select>
            </td>
            <td class="text-right text-nowrap">
                <button type="button" class="btn btn-primary" data-toggle="tooltip"
                        data-action="<?php echo e(route('contactUs.show',$order->id)); ?>"
                        data-name="<?php echo e($order->customer->name); ?>"
                        data-phone-number="<?php echo e($order->customer->mobile_number); ?>"
                        data-email="<?php echo e($order->customer->email); ?>"
                        data-subject="<?php echo e($order->subject); ?>"
                        data-message="<?php echo e($order->desc); ?>"
                        data-status="<?php echo e($order->status); ?>"
                        data-bs-toggle="modal"
                        data-bs-target="#showMessageModal"
                        onclick="showMessage(this)">
                    <i class="fa fa-eye"></i>
                </button>
                <button type="button" class="btn btn-danger" data-toggle="tooltip"
                        data-action="<?php echo e(route('contactUs.destroy',$order->id)); ?>"
                        onclick="deleteMessage(this)">
                    <i class="fa fa-trash"></i>
                </button>

                <button type="button" class="btn btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#showMessage">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </button>


            </td>
        </tr>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



<?php /**PATH I:\Projects\booking2\resources\views/admin/manage/orders/ajax/allOrder.blade.php ENDPATH**/ ?>