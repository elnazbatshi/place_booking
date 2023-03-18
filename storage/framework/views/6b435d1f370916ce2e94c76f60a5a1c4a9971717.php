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

        }


        var $disabledResults = $(".js-example-disabled-results");
        $disabledResults.select2();

        $( document ).ready(function() {
            jalaliDatepicker.startWatch();
        });

    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="main-content">
        <div class="page-content">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="filter-form"
                                  method="get"
                                  data-action="/">
                                <div class="row">

                                    <div   class="col-2">
                                        <label class="form-label">مکان: </label>
                                        <select name="loc" class="js-example-disabled-results  form-control select2"  >
                                            <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if($request->loc == $loc->id): ?> selected <?php endif; ?> value="<?php echo e($loc->id); ?>"><?php echo e($loc->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>

                                    </div>

                                    <div class="col-2">
                                        <label class="form-label">نام : </label>
                                        <input name="client" class="form-control" value="<?php echo e($request->client); ?>" type="text">
                                    </div>
                                    <div class="col-2">
                                        <label class="form-label">از تاریخ : </label>
                                        <input name="dateFrom" data-jdp class="form-control"  value="<?php echo e($request->dateFrom); ?>" type="text">
                                    </div>
                                    <div class="col-2">
                                        <label class="form-label">تا تاریخ : </label>
                                        <input name="dateTo" data-jdp class="form-control"  value="<?php echo e($request->dateTo); ?>" type="text">
                                    </div>
                                    <div class="col-2">
                                        <label class="form-label">کد پیگیری : </label>
                                        <input name="trackCode" class="form-control"  value="<?php echo e($request->trackCode); ?>" type="text">
                                    </div>
                                    <div class="col-2">
                                        <button id="filterPost" class="btn btn-success mt-4" type="submit">
                                            <i class="fa fa-filter"></i>
                                        </button>
                                        <button type="reset" id="removeFilter" class="btn btn-light mt-4">
                                            <span style="font-size: small">X</span>
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <!-- end select2 -->

                </div>


            </div>


            <div class="container-fluid">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">همه سفارشات
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="active-tab" data-bs-toggle="tab" data-bs-target="#active"
                                type="button" role="tab" aria-controls="active" aria-selected="false">سفارشات پذیرفته
                            شده
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending"
                                type="button" role="tab" aria-controls="pending" aria-selected="false">در حال بررسی
                            شده
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="decline-tab" data-bs-toggle="tab" data-bs-target="#decline"
                                type="button" role="tab" aria-controls="contact" aria-selected="false">رد شده ها
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
                                    <td>#</td>
                                    <td>مکان</td>
                                    <td>نام سفارش دهنده</td>
                                    <td>روز سفارش</td>
                                    <td>شروع</td>
                                    <td>پایان</td>
                                    <td>کدپیگیری</td>
                                    <td>وضعیت</td>
                                </tr>
                                </thead>
                                <tbody id="orders">
                                <?php echo $__env->make('admin.manage.orders.ajax.allOrder',['orders'=>$orders,'status'=>'all'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="active" role="tabpanel" aria-labelledby="active-tab">
                        <div class="container-fluid">
                            <table class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">مکان</th>
                                    <th scope="col">نام سفارش دهنده</th>
                                    <th scope="col">روز سفارش</th>
                                    <th scope="col">شروع</th>
                                    <th scope="col">پایان</th>
                                    <th scope="col">کدپیگیری</th>
                                    <th scope="col">وضعیت</th>
                                </tr>
                                </thead>
                                <tbody id="order_active">
                                <?php echo $__env->make('admin.manage.orders.ajax.allOrder',['orders'=>$orders,'status'=>'active'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                        <div class="container-fluid">
                            <table class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">مکان</th>
                                    <th scope="col">نام سفارش دهنده</th>
                                    <th scope="col">روز سفارش</th>
                                    <th scope="col">شروع</th>
                                    <th scope="col">پایان</th>
                                    <th scope="col">کدپیگیری</th>
                                    <th scope="col">وضعیت</th>
                                </tr>
                                </thead>
                                <tbody id="order_pending">
                                <?php echo $__env->make('admin.manage.orders.ajax.allOrder',['orders'=>$orders,'status'=>'pending'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="decline" role="tabpanel" aria-labelledby="decline-tab">
                        <div class="container-fluid">
                            <table class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">مکان</th>
                                    <th scope="col">نام سفارش دهنده</th>
                                    <th scope="col">روز سفارش</th>
                                    <th scope="col">شروع</th>
                                    <th scope="col">پایان</th>
                                    <th scope="col">کدپیگیری</th>
                                    <th scope="col">وضعیت</th>
                                </tr>
                                </thead>
                                <tbody id="order_decline">
                                <?php echo $__env->make('admin.manage.orders.ajax.allOrder',['orders'=>$orders,'status'=>'deactivate'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                    <label for="formrow-firstname-input" class="form-label">توضیحات </label>

                    <div class=" message-box ">
                        <span id="show-message">
                        </span>
                    </div>
                </div>
                <div class="mb-3 d-flex justify-content-between w-50 flex-wrap">





                </div>
            </div>

        </div>
    </div>
</div>
<div class="modal fade " id="showMessage" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ویرایش کردن کاربر</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3 col-12">
                    <label for="formrow-firstname-input" class="form-label">پیام </label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <button id="update-user-btn" data-update-role onclick="updateUser(this)"
                        data-action="" type="button"
                        class="btn btn-success w-md"> ارسال پیام
                </button>
                <hr>
                <h6>پیام های ارسال شده:</h6>
                <div class="allMessage ">
                    <div class="message-sended mb-2">
                       <p>باسلام درخواست شما تایید شده</p>
                    </div>
                    <div class="message-sended mb-2">
                        <p>باسلام درخواست شما تایید رخواست شما تایید رخواست شما تایید رخواست شما تایید رخواست شما تایید رخواست شما تایید شده</p>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                <div>
                    <button id="update-user-btn" data-update-role onclick="updateUser(this)"
                            data-action="" type="button"
                            class="btn btn-success w-md">ویرایش کردن
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH I:\Projects\booking2\resources\views/admin/manage/orders/index.blade.php ENDPATH**/ ?>