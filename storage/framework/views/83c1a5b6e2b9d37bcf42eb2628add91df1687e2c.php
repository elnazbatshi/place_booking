<?php $__currentLoopData = $socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <tr id="social_<?php echo e($social->id); ?>">

        <th scope="row"><?php echo e($social->id); ?></th>
        <td><?php echo e($social->name); ?></td>
        <td><?php echo e($social->value); ?></td>

        <td class="text-right text-nowrap">

            <button type="button" class="btn btn-primary mx-2"
                    onclick="editSocial(this)"
                    data-social-name="<?php echo e($social->name); ?>"
                    data-social-value="<?php echo e($social->value); ?>"
                    data-social-id="<?php echo e($social->id); ?>"
                    data-action="<?php echo e($social->name); ?>"
                    data-bs-toggle="modal"
                    data-bs-target="#editSocialModal"
                    data-toggle="tooltip">
                <i class="fa fa-edit"></i>
            </button>

            <button type="button" class="btn btn-danger" data-toggle="tooltip"
                    data-action="<?php echo e(route('admin.deleteSocial',$social->id)); ?>"
                    onclick="deleteSocial(this)">
                <i class="fa fa-trash"></i>
            </button>

        </td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH I:\Projects\booking2\resources\views/admin/manage/setting/ajax/table-social.blade.php ENDPATH**/ ?>