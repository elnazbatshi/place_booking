<header id="header">
    <div class="container">
        <div class="row">
            <div class="col-6 col-lg-2 d-flex align-items-center">
                <a class="header-logo" href="{{route('site.index')}}" title="">
                    @if(isset($menuHeader->logo_image))
                        <img src="{{asset($menuHeader->logo_image)}}" alt=""></a>
                @else
                    <img style="width: 70px;height: 70px" src="{{asset('booking/site/image/logoSite.png')}}"
                         alt=""></a>
                    @endif
                    </a>
            </div>
            <div class="col-4 col-lg-7 d-none d-lg-flex align-items-center">
                <div class="wrap-menu">
                    <ul class="header-menu">
                        @if($menuHeader->MenuItem->count())
                            @foreach($menuHeader->MenuItem as $menu)
                                @if($menu->children->count())
                                    <li class="nav-item dropdown ">
                                        <a class="nav-link dropdown-toggle" href="{{$menu->link}}" role="button"
                                           data-bs-toggle="dropdown">
                                            {{$menu->title}}
                                        </a>
                                        <ul class="sub-menu">
                                            @foreach($menu->children as $child)
                                                <a class="dropdown-item" href="{{$child->link}}">
                                                    {{$child->title}}
                                                </a>

                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{$menu->link}}">{{$menu->title}}</a>

                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>


            <div class="col-6 col-lg-3 d-flex align-items-center justify-content-end">
                @if (Auth::guard('customer')->check())
                    @if(\Route::currentRouteName()=='panel.index')
                        <a href="{{route('site.index')}}" class="button btn-h">رفتن به سایت</a>
                    @else
                        <a href="{{route('panel.index')}}" class="button btn-h">پنل کاربری</a>
                    @endif
                @else
                    <a href="{{route('customer.login-view')}}" class="button btn-h">ورود</a>
                @endif
                    <div class="search-pup-up">
                        <div class="fd-outer search-close">
                            <div class="fd-inner">
                                <label>بازگشت</label>
                            </div>
                        </div>
                        <div class="col-lg-8 mx-auto form-wrap">
                            <form class="search-form" method="get">
                                <input onkeyup="search_by_ajax(this)" data-action="{{route('site.search')}}"  id="search-text" type="search" name="s" placeholder="جستجو عبارت مورد نظر" autocomplete="off">
                            </form>

                                <div class="row search-bord">

                                    <div class="col-lg-3 col-md-6 d-none title-search ">
                                        <h5>رویداد ها </h5>
                                        <div class="event-bord">

                                        </div>


                                </div>


                        </div>
                    </div>
                <div class="header-search"><i class="icon-search"></i><span></span></div>
                <div class="header-mm"><i class="icon-menu"></i></div>
                <div id="mask"></div>
                <div id="menumobile">
                    <div class="title-mm">
                        <img src={{asset($menuHeader->logo_image)}}>
                        <span id="nomenumobile"><i class="icon-clear"></i></span>
                    </div>
                    <div class="button-mm">
                        @if (Auth::guard('customer')->check())
                            @if(\Route::currentRouteName()=='panel.index')

                                <a href="{{route('site.index')}}" class="button">رفتن به سایت</a>
                            @else
                                <a href="{{route('panel.index')}}" class="button">پنل کاربری</a>
                            @endif
                        @else
                            <a href="{{route('customer.login-view')}}" class="button">ورود</a>
                        @endif

                    </div>
                    <div class="wrap-menu">
                        <ul class="main-mm">
                            @if($menuHeader->MenuItem->count())
                                @foreach($menuHeader->MenuItem as $menu)
                                    <li class="nav-item dropdown active">
{{--                                        <a class="nav-link dropdown-toggle" href="#" role="button"--}}
{{--                                           data-bs-toggle="dropdown">--}}
{{--                                            {{$menu}}--}}
{{--                                        </a>--}}
                                        <a class="nav-link dropdown-toggle" href="{{$menu->link}}">{{$menu->title}}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
