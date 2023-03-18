
    <div class="profile-col">
        <div class="profile-lastOrder">
            <div class="profile-heading"> لیست سفارش ها</div>
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
            <div class="profile-lastOrder-row row">
                <div class="col-sm-1 col-2">
                    <ul class="profile-lastOrder-colnum ">

                        @foreach($orders as $order)
                            <li class="lastOrder-num">{{ $loop->index+1 }}</li>
                        @endforeach
                    </ul><!-- .profile-lastOrder-colnum-->
                </div>
                <div class="col-sm-11 col-10">
                    <div class="profile-lastOrder-col">
                        @foreach($orders as $order)

                            <ul class="row profile-lastOrder-item">
                                <li class="pull-right">{{ $order->orderId }}</li>
                                <li class="pull-right font-12">{{ $order->day_fa }}</li>
                                <li class="pull-right">{{ $order->location->name }}</li>
                                <li class=" pull-right @if($order->status==\App\Models\Order::STATUS_ACTIVE) text-success @elseif($order->status==\App\Models\Order::STATUS_PENDING) text-warning @else error @endif ">{{trans('orders.'.$order->status)}} </li>
                                <li class="pull-right">{{ $order->strtTime }}</li>
                                <li class="pull-right">{{ $order->endTime }}</li>
{{--                                <li class="lastOrder-detail pull-right">--}}
{{--                                    <a href=""><img src="/assetsSite/img/Icon-detail.svg"></a>--}}
{{--                                </li>--}}
                            </ul>
                        @endforeach
                    </div><!-- .profile-lastOrder-col -->
                </div>
            </div><!-- .profile-lastOrder-row-->
{{--            <div class="profile-btn">--}}
{{--                <ul class="paging">--}}
{{--                    <li class="back-btn"><a href="#" class="button prev">صفحه بعد</a></li>--}}
{{--                    <li class="paging-row">--}}
{{--                        <a class="page-numbers" href="#">۵</a>--}}
{{--                        <a class="page-numbers" href="#">۴</a>--}}
{{--                        <a class="page-numbers" href="#">۳</a>--}}
{{--                        <a class="page-numbers" href="#">۲</a>--}}
{{--                        <a class="page-numbers" href="#">۱</a>--}}
{{--                    <li class="prev-btn"> <a href="#" class="button next">صفحه قبل</a></li>--}}
{{--                </ul>--}}
{{--            </div><!-- .profile-btn-->--}}
        </div><!-- .profile-lastOrder -->
    </div><!-- .profile-col -->

