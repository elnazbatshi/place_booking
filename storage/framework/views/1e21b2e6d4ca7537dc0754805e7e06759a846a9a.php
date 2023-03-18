<?php $__env->startSection('style'); ?>
    <style>
      .pending{
          background-color: #e18828  !important;
          opacity: 1!important;
          border-radius: 5px;
          margin: 1px !important;
          color: white !important;
      }
      .active{
          background-color: #1bd76d   !important;
          opacity: 1!important;
          border-radius: 5px;
          margin: 1px !important;
          color: white !important;
      }
      .deactivate{
          color: white !important;
          background-color: #ec4949     !important;
          opacity: 1!important;
          border-radius: 5px;
          margin: 1px !important;

      }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

    <script>

        var invalidDays = <?php echo json_encode($reserved_days, JSON_HEX_TAG); ?>;


        console.log(invalidDays.filter(function (item) {
            console.log(item)
            return false;
        }))

        $(document).ready(function () {
            jalaliDatepicker.startWatch({


                dayRendering: function (dayOptions, input) {
                    const invalidDay=invalidDays.find((item) => {
                        return parseInt(item.month) === dayOptions.month && parseInt(item.day) === dayOptions.day
                    })
                    if(invalidDay){
                        return {
                            isValid: false,
                            className:" "+invalidDay.className
                        };
                    }else {
                        return {
                            isValid: true,
                        };
                    }
                },

            })
        });


    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Start Contact section -->
    <section class="contact-section ptb-100">
        <div class="container">
            <h1 class="title"><?php echo e($place->name); ?></h1>
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-form">
                        <form action="<?php echo e(route('panel.storeOrder',['hall'=>(request()->hall)])); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="location_id" value="<?php echo e($place->id); ?>" type="text">
                            <div class="row">

                                <div class="form-group col-lg-3">
                                    <label>روز</label>
                                    <input onchange="getTimeDatepicher(this)" data-jdp-min-date="today"
                                           data-url="<?php echo e(route('getTimeOrder')); ?>" type="text" data-jdp
                                           class="form-control" name="day" placeholder="" id="name"
                                           data-error="">

                                    <?php $__errorArgs = ['day'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="help-block with-errors">
                                        <?php echo e($message); ?>

                                    </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                </div>
                                <div class="form-group col-lg-3">
                                    <label>از ساعت</label>
                                    <label class="form-label">شروع : </label>
                                    <select name="startTime" class="selectpicker form-control times" required>
                                    </select>
                                    <?php $__errorArgs = ['startTime'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="help-block with-errors">
                                        <?php echo e($message); ?>

                                    </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-group col-lg-3">
                                    <label class="form-label">پایان : </label>
                                    <select name="endTime" class="selectpicker form-control times" required>
                                    </select>
                                    <?php $__errorArgs = ['endTime'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="help-block with-errors">
                                        <?php echo e($message); ?>

                                    </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>


                                <div class="form-group col-lg-3">
                                    <label>واحد درخواست کننده</label>
                                    <input type="text" class="form-control" name="department" placeholder="نام شما"
                                           id="name" data-error="نام خود را وارد کنید">
                                    <div class="help-block with-errors"></div>
                                    <?php $__errorArgs = ['department'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="help-block with-errors">
                                        <?php echo e($message); ?>

                                    </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>


                                <div class="form-group col-lg-3">
                                    <label>تعداد ظرفیت</label>
                                    <input type="number" class="form-control" name="index" id="count"
                                           data-error="ظرفیت خود را وارد کنید">
                                    <small class="color-title">بیشترین حد ظرفیت <?php echo e($place->index); ?> نفر</small>
                                    <?php $__errorArgs = ['index'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="help-block with-errors">
                                        <?php echo e($message); ?>

                                    </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                </div>
                                <div class="form-group col-lg-3">
                                    <label>موضوع</label>
                                    <input type="text" class="form-control" name="subject"
                                           id="subject" data-error="موضوع  خود را وارد کنید">
                                    <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="help-block with-errors">
                                        <?php echo e($message); ?>

                                    </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-lg-3">
                                    <div class="products-details-title"> نیاز به پارکینگ دارید؟</div>
                                    <div class="parking">
                                        <input class="hidden radio-label" type="radio" name="parking"
                                               value="1"/>
                                        <label class="product-label" for="radio-yes">
                                            <div class="radio-number">بله</div>
                                        </label>
                                        <input class="hidden radio-label" type="radio" name="parking"
                                               value="0"/>
                                        <label class="product-label" for="radio-no">
                                            <div class="radio-number">خیر</div>
                                        </label>
                                    </div>
                                    <?php $__errorArgs = ['parking'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="help-block with-errors">
                                        <?php echo e($message); ?>

                                    </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-lg-3">
                                    <div class="catering-details-title"> نیاز به پذیرایی دارید؟</div>
                                    <div class="parking">
                                        <input class="hidden radio-label" type="radio" name="catering"
                                               value="1"
                                        />
                                        <label class="catering-label" for="radio-yes">
                                            <div class="radio-number">بله</div>
                                        </label>
                                        <input class="hidden radio-label" type="radio" name="catering"
                                               value="0"/>
                                        <label class="catering-label" for="radio-no">
                                            <div class="radio-number">خیر</div>
                                        </label>
                                    </div>
                                    <?php $__errorArgs = ['catering'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="help-block with-errors">
                                        <?php echo e($message); ?>

                                    </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-12">
                                    <label>توضیحات</label>
                                    <textarea name="desc" class="form-control" id="desc"
                                              placeholder="توضیحات تکمیلی خود را وارد کنید "
                                              cols="30" rows="7" data-error="پیام خود را بنویسید"></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <button type="submit" class="button">ثبت درخواست</button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>


                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Contact section -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('booking.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH I:\Projects\booking2\resources\views/booking/order/index.blade.php ENDPATH**/ ?>