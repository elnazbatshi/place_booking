











<div
    id="menuItem_<?php echo e($menuItem->id); ?>"
    class="row">
    <div
        class="mb-3 col-lg-2">
        <label
            for="name">عنوان
            ایتم
            منو</label>
        <input
            type="text"
            value="<?php echo e($menuItem->title); ?>"
            name="title"

            class="form-control">
    </div>

    <div
        class="mb-3 col-lg-2">
        <label
            for="link">آدرس
            منو</label>
        <input
            type="text"
            value="<?php echo e($menuItem->link); ?>"
            name="link"
            class="form-control">
    </div>
    <div
        class="mb-3 col-lg-1">
        <label
            for="link">ایکون
            منو</label>
        <input
            type="text"
            value="<?php echo e($menuItem->icon); ?>"
            name="icon"
            class="form-control">
    </div>
    <div
        class="mb-3 col-lg-1">
        <label
            for="index">ترتیب
            قرارگیری</label>
        <input
            type="number"
            value="<?php echo e($menuItem->index); ?>"
            name="index"
            class="form-control ">
    </div>
    <div class="mb-3 col-3 ">
        <label for="formrow-firstname-input" class="form-label">ایتم ها </label>
        <br>
        <select data-select="<?php echo e($menuItem->title); ?>" data-menuItem-<?php echo e($menuItem->menu_id); ?>="" style="width: 100%;"
                name="parent_id" class="form-control">
            <option value="">مادر</option>
            <?php $__currentLoopData = $item->parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($parent->parent_id==Null): ?>
                    <option value="<?php echo e($parent->id); ?>" class="<?php echo e($parent->id==$menuItem->id ?' d-none  ': ''); ?>"
                            <?php if($parent->id == $menuItem->parent_id): ?> selected <?php endif; ?>><?php echo e($parent->title); ?></option><?php endif; ?>
                <?php if($parent->children): ?>
                    <?php $__currentLoopData = $parent->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <option value="<?php echo e($children->id); ?>"
                                class="<?php echo e($parent->id==$menuItem->parent_id ?' d-none  ': ''); ?>"
                                <?php if($children->id == $menuItem->parent_id): ?> selected <?php endif; ?>><?php echo e($parent->title .'=>'.$children->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>


            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div
        class="col-lg-2 align-self-center">
        <div class="d-flex gap-3 ">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update',\App\Models\MenuItem::class)): ?>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="mySwitch"
                           <?php echo e($menuItem->status==1 ?  "checked" : " "); ?>         name="darkmode" value="1">
                </div>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete',\App\Models\MenuItem::class)): ?>
                <button
                    onclick="deleteItemMenu(this)"
                    data-action="<?php echo e(route('menu.deleteItem',$menuItem->id)); ?>"
                    type="button"
                    data-toggle="tooltip"
                    class="btn btn-danger"
                    title="پاک کردن ایتم">
                    <i class="fa fa-trash"></i>
                </button>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update',\App\Models\MenuItem::class)): ?>
                <button
                    onclick="updateItemMenu(this,event)"
                    data-action="<?php echo e(route('menu.updateItem',$menuItem->id)); ?>"
                    type="button"
                    data-toggle="tooltip"
                    class="btn btn-primary"
                    title="اپدیت ایتم">
                    <i class="fa fa-edit"></i>
                </button>
            <?php endif; ?>

        </div>
    </div>
</div>
<?php if($menuItem->children->count()): ?>
    <div class="mx-4">
        <?php $__currentLoopData = $menuItem->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php echo $__env->make('admin.manage.menu.ajax.item-list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>

<?php /**PATH I:\Projects\reservasion\resources\views/admin/manage/menu/ajax/item-list.blade.php ENDPATH**/ ?>