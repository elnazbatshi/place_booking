
<?php $__env->startSection('styleCss'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        function showMessage(sender) {

            $('#show-name').val($(sender).data('name'));
            $('#show-phoneNumber').val($(sender).data('phoneNumber'));
            $('#show-email').val($(sender).data('email'));
            $('#show-subject').val($(sender).data('subject'));
            $('#show-message').append($(sender).data('message'));
            console.log($(sender).data('status'))
            if ($(sender).data('status') == 'pending') {
                $('#show-status').text('بدون پاسخ');
                $('#show-status').addClass('pending');
                $('#show-status').removeClass('answered');
            } else {
                $('#show-status').text('پاشخ داده شده');
                $('#show-status').addClass('answered');
                $('#show-status').removeClass('pending');
            }
        }
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">همه ی پیام ها
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">پیام های خوانده
                            نشده
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                type="button" role="tab" aria-controls="contact" aria-selected="false">پیام های خوانده
                            شده
                        </button>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="container-fluid">
                            <table class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">نام</th>
                                    <th scope="col">شماره تماس</th>
                                    <th scope="col">ایمیل</th>
                                    <th scope="col">موضوع</th>
                                    <th scope="col">متن</th>
                                    <th scope="col">پاسخ داده شده</th>
                                    <th scope="col">عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr id="contact_<?php echo e($message->id); ?>">
                                        <th scope="row"><?php echo e($message->id); ?></th>
                                        <td><?php echo e($message->name); ?></td>
                                        <td><?php echo e($message->phoneNumber); ?></td>
                                        <td><?php echo e($message->email); ?></td>
                                        <td><?php echo e($message->subject); ?></td>
                                        <td><?php echo e(excerpt($message->message,'15')); ?></td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input onchange="changeStatus(this)"
                                                       data-action="<?php echo e(route('contactUs.changeStatus',$message->id)); ?>"
                                                       data-status="<?php echo e($message->status); ?>"
                                                       <?php echo e($message->status==\App\Models\ContactUs::STATUS_ANSWERED ?  "checked" : " "); ?>

                                                       class="form-check-input status_menu" type="checkbox"
                                                       id="mySwitch"
                                                       name="darkmode"
                                                       value="1">
                                            </div>
                                        </td>
                                        <td class="text-right text-nowrap">
                                            <button type="button" class="btn btn-primary" data-toggle="tooltip"
                                                    data-name="<?php echo e($message->name); ?>"
                                                    data-phone-number="<?php echo e($message->phoneNumber); ?>"
                                                    data-email="<?php echo e($message->email); ?>"
                                                    data-subject="<?php echo e($message->subject); ?>"
                                                    data-message="<?php echo e($message->message); ?>"
                                                    data-status="<?php echo e($message->status); ?>"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#showMessageModal"
                                                    onclick="showMessage(this)">
                                                <i class="fa fa-eye"></i>
                                            </button>

                                            <button type="button" class="btn btn-danger" data-toggle="tooltip"
                                                    data-action="<?php echo e(route('contactUs.destroy',$message->id)); ?>"
                                                    onclick="deleteMessage(this)">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="container-fluid">
                            <table class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">نام</th>
                                    <th scope="col">شماره تماس</th>
                                    <th scope="col">ایمیل</th>
                                    <th scope="col">موضوع</th>
                                    <th scope="col">متن</th>
                                    <th scope="col">عملیات</th>
                                </tr>
                                </thead>
                                <tbody id="">
                                <?php if($message_not_answered->count()>0): ?>
                                    <?php $__currentLoopData = $message_not_answered; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message_a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr id="social_<?php echo e($message_a->id); ?>">
                                            <th scope="row"><?php echo e($message_a->id); ?></th>
                                            <td><?php echo e($message_a->name); ?></td>
                                            <td><?php echo e($message_a->phoneNumber); ?></td>
                                            <td><?php echo e($message_a->email); ?></td>
                                            <td><?php echo e($message_a->subject); ?></td>
                                            <td><?php echo e(excerpt($message_a->message,'15')); ?></td>
                                            <td class="text-right text-nowrap">
                                                <button type="button" class="btn btn-primary" data-toggle="tooltip"
                                                        data-action="<?php echo e(route('contactUs.show',$message_a->id)); ?>"
                                                        data-name="<?php echo e($message_a->name); ?>"
                                                        data-phone-number="<?php echo e($message_a->phoneNumber); ?>"
                                                        data-email="<?php echo e($message_a->email); ?>"
                                                        data-subject="<?php echo e($message_a->subject); ?>"
                                                        data-message="<?php echo e($message_a->message); ?>"
                                                        data-status="<?php echo e($message_a->status); ?>"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#showMessageModal"
                                                        onclick="showMessage(this)"
                                                >
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger" data-toggle="tooltip"
                                                        data-action="<?php echo e(route('contactUs.destroy',$message_a->id)); ?>"
                                                        onclick="deleteMessage(this)">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="container-fluid">
                            <table class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">نام</th>
                                    <th scope="col">شماره تماس</th>
                                    <th scope="col">ایمیل</th>
                                    <th scope="col">موضوع</th>
                                    <th scope="col">متن</th>
                                    <th scope="col">عملیات</th>
                                </tr>
                                </thead>
                                <tbody id="">
                                <?php if($message_answered->count()>0): ?>
                                    <?php $__currentLoopData = $message_answered; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message_p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr id="social_<?php echo e($message_p->id); ?>">
                                            <th scope="row"><?php echo e($message_p->id); ?></th>
                                            <td><?php echo e($message_p->name); ?></td>
                                            <td><?php echo e($message_p->phoneNumber); ?></td>
                                            <td><?php echo e($message_p->email); ?></td>
                                            <td><?php echo e($message_p->subject); ?></td>
                                            <td><?php echo e(excerpt($message_p->message,'15')); ?></td>
                                            <td class="text-right text-nowrap">
                                                <button type="button" class="btn btn-primary" data-toggle="tooltip"
                                                        data-action="<?php echo e(route('contactUs.show',$message_p->id)); ?>"
                                                        data-name="<?php echo e($message_p->name); ?>"
                                                        data-phone-number="<?php echo e($message_p->phoneNumber); ?>"
                                                        data-email="<?php echo e($message_p->email); ?>"
                                                        data-subject="<?php echo e($message_p->subject); ?>"
                                                        data-message="<?php echo e($message_p->message); ?>"
                                                        data-status="<?php echo e($message_p->status); ?>"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#showMessageModal"
                                                        onclick="showMessage(this)">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                
                                                
                                                
                                                
                                                
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<div class="modal fade " id="showMessageModal" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">نمایش پیام </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body container ">
                <div class="mb-3">
                    <label for="formrow-firstname-input" class="form-label">نام </label>
                    <input id="show-name" disabled type="text" class="form-control ">
                </div>
                <div class="mb-3">
                    <label for="show-phoneNumber" class="form-label">شماره همراه </label>
                    <input id="show-phoneNumber" disabled type="text" class="form-control ">
                </div>
                <div class="mb-3">
                    <label for="formrow-firstname-input" class="form-label">ایمیل </label>
                    <input id="show-email" disabled type="text" class="form-control ">
                </div>
                <div class="mb-3">
                    <label for="formrow-firstname-input" class="form-label">موضوع </label>
                    <input id="show-subject" disabled type="text" class="form-control ">
                </div>
                <div class="mb-3">
                    <label for="formrow-firstname-input" class="form-label">پیامک </label>

                    <div class=" message-box ">
                        <span id="show-message">
                        </span>
                    </div>
                </div>
                <div class="mb-3 d-flex justify-content-between w-50 flex-wrap">
                    <label for="formrow-firstname-input" class="form-label">وضعیت </label>
                    <div>
                        <span id="show-status">
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH I:\Projects\booking2\resources\views/admin/manage/contactUs/index.blade.php ENDPATH**/ ?>