<?php if($items_list): ?>
    <?php $__currentLoopData = $items_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <?php echo $__env->make('admin.manage.menu.ajax.item-list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH I:\Projects\reservasion\resources\views/admin/manage/menu/ajax/items-list.blade.php ENDPATH**/ ?>