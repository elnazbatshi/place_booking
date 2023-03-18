<div class="vertical-menu">

    <div data-simplebar="" class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                @canany(array_merge(\App\Models\Permission::MENUITEM_PERMISSIONS,\App\Models\Permission::MENU_PERMISSIONS))
                    <li>
                        <a href="javascript: void(0);" class="waves-effect">
                            <i class="bx bx-dock-top"></i>
                            <span key="t-dashboards"> مدیریت منو ها</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @canany(\App\Models\Permission::MENUITEM_PERMISSIONS)
                                <li><a href="{{route('menu.indexItem')}}" key="t-default">اضافه کردن ایتمهای منو </a>
                                </li>
                            @endcan
                            @canany(\App\Models\Permission::MENU_PERMISSIONS)
                                <li><a href="{{route('menu.index')}}" key="t-saas">لیست جایگاه منو ها</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @canany(array_merge(\App\Models\Permission::TYPE_CATEGORY_PERMISSIONS,\App\Models\Permission::CATEGORY_PERMISSIONS))
                    <li>
                        <a href="javascript: void(0);" class="waves-effect">
                            <i class="bx bx-grid-alt"></i>
                            <span key="t-dashboards">  دسته بندی   </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @canany(\App\Models\Permission::TYPE_CATEGORY_PERMISSIONS)
                                <li><a href="{{route('typeCategory.index')}}">مدیریت نوع دسته بندی
                                        ها </a>
                                </li>
                            @endcan
                            @canany(\App\Models\Permission::CATEGORY_PERMISSIONS)
                                <li><a href="{{route('category.index')}}">مدیریت دسته بندی ها </a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                {{--                @can(\App\Models\Permission::VIEW_FILES)--}}
                {{--                    <li>--}}
                {{--                        <a href="javascript: void(0);" class="waves-effect">--}}
                {{--                            <i class="bx bx-photo-album"></i>--}}
                {{--                            <span key="t-dashboards"> مدیریت فایل ها </span>--}}
                {{--                        </a>--}}
                {{--                        <ul class="sub-menu" aria-expanded="false">--}}
                {{--                            <li><a href="{{route('elfinder.index')}}">مدیریت فایل ها</a></li>--}}
                {{--                        </ul>--}}
                {{--                    </li>--}}
                {{--                @endcan--}}
                @canany(\App\Models\Permission::MODULE_PERMISSIONS)
                    <li>
                        <a href="javascript: void(0);" class="waves-effect">
                            <i class="bx bx-dialpad"></i>
                            <span key="t-dashboards"> مدیریت ماژول ها </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('create',\App\Models\Module::class)
                                <li><a href="{{route('module.create')}}" key="t-default">ساختن ماژول </a></li>
                            @endcan
                            @can('view',\App\Models\Module::class)
                                <li><a href="{{route('module.index')}}" key="t-default"> ماژول ها</a></li>
                            @endcan

                        </ul>
                    </li>
                @endCan
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="bx bx-code-block"></i>
                        <span key="t-dashboards"> مدیریت اسلایدر ها </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('slider.index')}}" key="t-default"> اسلایدر ها </a></li>
                        <li><a href="{{route('slider.create')}}" key="t-default">ساختن اسلاید </a></li>
                    </ul>
                </li>
                <li>
{{--                    <a href="javascript: void(0);" class="waves-effect">--}}
{{--                        <i class="bx bx-code-block"></i>--}}
{{--                        <span key="t-dashboards"> مدیریت گالری ها </span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="{{route('gallery.index')}}" key="t-default"> گالری ها </a></li>--}}
{{--                        <li><a href="{{route('gallery.create')}}" key="t-default">ساختن گالری </a></li>--}}

{{--                    </ul>--}}
{{--                </li>--}}
{{--                @canany(\App\Models\Permission::POST_PERMISSIONS)--}}
{{--                    <li>--}}
{{--                        <a href="javascript: void(0);" class="waves-effect">--}}
{{--                            <i class="bx bx-box"></i>--}}
{{--                            <span key="t-dashboards"> مدیریت اخبار </span>--}}
{{--                        </a>--}}
{{--                        <ul class="sub-menu" aria-expanded="false">--}}
{{--                            @can('create',\App\Models\Post::class)--}}
{{--                                <li><a href="{{route('post.create')}}" key="t-default">ساختن خبر جدید </a></li>--}}
{{--                            @endcan--}}
{{--                            @can('create',\App\Models\Post::class)--}}
{{--                                <li><a href="{{route('post.index')}}" key="t-default">لیست اخبار </a></li>--}}
{{--                            @endcan--}}

{{--                        </ul>--}}
{{--                    </li>--}}
{{--                @endcan--}}
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="bx bx-code-block"></i>
                        <span key="t-dashboards">مدیریت سالن ها </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('location.index')}}" key="t-default"> سالن ها </a></li>
                        <li><a href="{{route('location.create')}}" key="t-default">ساختن سالن </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="bx bx-code-block"></i>
                        <span key="t-dashboards">مدیریت سفارشات</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('order.index')}}" key="t-default">سفارشات</a></li>
                    </ul>
                </li>

                <li>
                    @canany(\App\Models\Permission::USER_PERMISSIONS)
                        <a href="javascript: void(0);" class="waves-effect">
                            <i class="bx bx-group"></i>
                            <span key="t-dashboards"> مدیریت کاربران </span>
                        </a>

                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('user.index')}}" key="t-default">لیست مدیران </a></li>
                            <li><a href="{{route('customer.index')}}" key="t-default">لیست مشتریان </a></li>

                        </ul>
                    @endcanany
                </li>
                @canany(\App\Models\Permission::ROLE_PERMISSIONS)
                    <li>
                        <a href="javascript: void(0);" class="waves-effect">
                            <i class="bx bxs-user-rectangle "></i>
                            <span key="t-dashboards">دسترسی ها</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('view',\Spatie\Permission\Models\Role::class)
                                <li><a href="{{route('admin.manage.permissions.index')}}" key="t-default">لیست دسترسی
                                        ها</a>
                                </li>
                            @endcan
                            <li><a href="{{route('admin.manage.roles.getRole')}}" key="t-saas"> لیست نقش ها و مجوز
                                    ها</a></li>
                        </ul>
                    </li>
                @endcan

{{--                <li>--}}
{{--                    <a href="{{route('contactUs.index')}}" class="waves-effect">--}}
{{--                        <i class="bx bxs-user-rectangle "></i>--}}
{{--                        <span key="t-dashboards">تماس با ما </span>--}}
{{--                    </a>--}}

{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="{{route('admin.setting')}}" class="waves-effect">--}}
{{--                        <i class="bx bxs-user-rectangle "></i>--}}
{{--                        <span key="t-dashboards">تنظیمات </span>--}}
{{--                    </a>--}}

{{--                </li>--}}
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
