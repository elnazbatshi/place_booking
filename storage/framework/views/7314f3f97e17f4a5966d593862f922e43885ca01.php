<tr id="social_<?php echo e(@$info->id); ?>">

    <td><?php echo e(@$info->id); ?></td>
    <td><?php echo e(@$info->email); ?></td>
    <td><?php echo e(@$info->phoneNumber); ?></td>
    <td><?php echo e(@$info->address); ?></td>
    <td><?php echo excerpt(@$info->description,20); ?></td>
    <td><img style="height: 100px;border-radius: 5px" src="<?php echo e(@$info->image); ?>" alt=""></td>

    
    
    
    
    
    

    
</tr>

<?php /**PATH I:\Projects\booking2\resources\views/admin/manage/setting/ajax/table-info.blade.php ENDPATH**/ ?>