@extends('booking.layouts.master')
@section('script')
    <script>
        @if(\Session::has('success'))
            toastr["success"]('{{session()->get('success')}}');
        @endif
    </script>
@endsection
@section('content')
    <div id="form-profile" class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="sidebar-profile">
                        <div class="sidebar-heading">
                            <a href=""><img src="/assetsSite/img/profile-man.svg"></a>
                            <div class="sidebar-profile-name">

                                {{$user->name}}
                            </div><!-- .sidebar-profile-name -->
                        </div><!-- .sidebar-heading -->
                        <ul class="sidebar-profile-row">
{{--                            <li class="profile-edit">--}}
{{--                                <a href="">--}}
{{--                                    ویرایش رمز عبور--}}
{{--                                </a>--}}
{{--                            </li><!-- .profile-edit -->--}}
                            <li class="profile-exit">


                            </li><!-- .profile-exit -->
                        </ul><!-- .sidebar-profile-row -->
                        <ul class="sidebar-profile-item">
                            <li class="profile-sidebar-user">
                                <span id="profile" class="active-tab tab_panel" onclick="changeSide(this)"

                                      data-url="{{route('panel.getData',['type'=>'profile'])}}" data-type="profile"> پیشخوان</span>
                            </li>
                            <li class="profile-sidebar-order">
                                <i class="icon-list"></i>
                                <span id="orders" class="tab_panel" onclick="changeSide(this)"
                                      data-url="{{route('panel.getData',['type'=>'orders'])}}" data-type="orders">لیست سفارش ها</span>
                            </li>
{{--                            <li class="profile-sidebar-favorite">--}}
{{--                                <span id="favorite" class="tab_panel" onclick="changeSide(this)"--}}
{{--                                      data-url="{{route('panel.getData',['type'=>'favorite'])}}" data-type="favorite"> مورد علاقه ها</span>--}}
{{--                            </li>--}}
                            <li class="profile-sidebar-favorite">
                                <form action="{{ route('panel.customer.logout') }}" method="POST">
                                    @csrf
                                    <button class="btn-logout" type="submit">
                                        <i class="icon-log-out ml-3"></i>
                                        خروج
                                    </button>
                                </form>
                            </li>
                        </ul><!-- .sidebar-profile-item -->
                    </div>
                </div>
                <div class="col-lg-9" id="panelContent">
                    @include('booking.panel.profile')
                </div>
            </div>
        </div><!-- .container -->
    </div><!-- #profile -->



@endsection













