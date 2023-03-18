@extends('booking.layouts.master')
@section('style')
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
@endsection
@section('script')

    <script>

        var invalidDays = {!! json_encode($reserved_days, JSON_HEX_TAG) !!};


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
@endsection

@section('content')
    <!-- Start Contact section -->
    <section class="contact-section ptb-100">
        <div class="container">
            <h1 class="title">{{$place->name}}</h1>
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-form">
                        <form action="{{route('panel.storeOrder',['hall'=>(request()->hall)])}}" method="post">
                            @csrf
                            <input type="hidden" name="location_id" value="{{$place->id}}" type="text">
                            <div class="row">

                                <div class="form-group col-lg-3">
                                    <label>روز</label>
                                    <input onchange="getTimeDatepicher(this)" data-jdp-min-date="today"
                                           data-url="{{route('getTimeOrder')}}" type="text" data-jdp
                                           class="form-control" name="day" placeholder="" id="name"
                                           data-error="">

                                    @error('day')
                                    <div class="help-block with-errors">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="form-group col-lg-3">
                                    <label>از ساعت</label>
                                    <label class="form-label">شروع : </label>
                                    <select name="startTime" class="selectpicker form-control times" required>
                                    </select>
                                    @error('startTime')
                                    <div class="help-block with-errors">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-3">
                                    <label class="form-label">پایان : </label>
                                    <select name="endTime" class="selectpicker form-control times" required>
                                    </select>
                                    @error('endTime')
                                    <div class="help-block with-errors">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>


                                <div class="form-group col-lg-3">
                                    <label>واحد درخواست کننده</label>
                                    <input type="text" class="form-control" name="department" placeholder="نام شما"
                                           id="name" data-error="نام خود را وارد کنید">
                                    <div class="help-block with-errors"></div>
                                    @error('department')
                                    <div class="help-block with-errors">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>


                                <div class="form-group col-lg-3">
                                    <label>تعداد ظرفیت</label>
                                    <input type="number" class="form-control" name="index" id="count"
                                           data-error="ظرفیت خود را وارد کنید">
                                    <small class="color-title">بیشترین حد ظرفیت {{$place->index}} نفر</small>
                                    @error('index')
                                    <div class="help-block with-errors">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="form-group col-lg-3">
                                    <label>موضوع</label>
                                    <input type="text" class="form-control" name="subject"
                                           id="subject" data-error="موضوع  خود را وارد کنید">
                                    @error('subject')
                                    <div class="help-block with-errors">
                                        {{ $message }}
                                    </div>
                                    @enderror
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
                                    @error('parking')
                                    <div class="help-block with-errors">
                                        {{ $message }}
                                    </div>
                                    @enderror
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
                                    @error('catering')
                                    <div class="help-block with-errors">
                                        {{ $message }}
                                    </div>
                                    @enderror
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

@endsection
