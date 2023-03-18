<div class="profile-col">
    <div class="profile-heading">اطلاعات شخصی</div>
    <form id="profile_form" method="POST" action="{{route('panel.update',$user->id)}}">
        @csrf
        @method('put')
        <div class="row profile-info">

            <div class="profile-info-item pull-right">
                <div class="profile-info-title">نام و نام خانوادگی:</div>
                <input name="name" class="form-style disable-input text-center" disabled="disabled"
                       value="{{$user->name}}" type="text">
            </div><!-- .profile-info-item-->
            <div class="profile-info-item pull-right">
                <div class="profile-info-title ">کد پرسنلی:</div>

                <input name="personal_id" class="form-style disable-input text-center" disabled="disabled"
                       value="{{$user->personal_id}}" type="text">
            </div><!-- .profile-info-item-->
            <div class="profile-info-item pull-right">
                <div class="profile-info-title"> شماره همراه:</div>
                <input name="mobile_number" class="form-style" value="{{$user->mobile_number}}" type="text">
            </div><!-- .profile-info-item-->

            <div class="profile-info-item pull-right">
                <div class="profile-info-title"> شماره داخلی:</div>
                <input name="phone" class="form-style" value="{{$user->phone}}" type="text">
            </div><!-- .profile-info-item-->
            <div class="profile-info-item pull-right">
                <div class="profile-info-title"> واحد :</div>
                <input name="department" class="form-style" value="{{$user->department}}" type="text">
            </div><!-- .profile-info-item-->
            <div class="profile-info-item pull-right">
                <div class="profile-info-title">پست الکترونیک:</div>
                <input name="email" class="form-style" value="{{$user->email}}" type="text">

            </div><!-- .profile-info-item-->
            <div class="clearfix"></div>

            <button type="submit" class="profile-info-edit">
                <i class="icon-edit-2"></i>
                ثبت
            </button>
            <!-- .profile-info-edit-->
        </div><!-- .profile-info -->
    </form>

    <div class="profile-lastOrder">
        <div class="profile-heading"> آخرین سفارش ها</div>
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
        <div class="row profile-lastOrder-row">
            <div class="col-sm-1 col-2">
                <ul class="profile-lastOrder-colnum ">
                    @foreach($latestOrder as $order)
                        <li class="lastOrder-num">{{ $loop->index+1 }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-sm-11 col-10">
                <div class="profile-lastOrder-col">
                    @foreach($latestOrder as $order)

                        <ul class="row profile-lastOrder-item">
                            <li class="pull-right">{{ $order->orderId }}</li>
                            <li class="pull-right font-12">{{ $order->day_fa }}</li>
                            <li class="pull-right">{{ $order->location->name }}</li>
                            <li class=" pull-right @if($order->status==\App\Models\Order::STATUS_ACTIVE) text-success @elseif($order->status==\App\Models\Order::STATUS_PENDING) text-warning @else error @endif ">{{trans('orders.'.$order->status)}} </li>
                            <li class="pull-right">{{ $order->startTime }}</li>
                            <li class="pull-right">{{ $order->endTime }}</li>
                            {{--                            <li class="lastOrder-detail pull-right">--}}
                            {{--                                <button data-toggle="modal" data-target="#exampleModalCenter" ><img src="/assetsSite/img/Icon-detail.svg"></button>--}}
                            {{--                            </li>--}}
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

