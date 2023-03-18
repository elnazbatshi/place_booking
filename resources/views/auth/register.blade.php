<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>Register | Skote - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets\images\favicon.ico')}}">

    <!-- Bootstrap Css -->
    <link href="{{asset('assets\css\bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="{{asset('assets\css\icons.min.css')}}" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="{{asset('assets\css\app.min.css')}}" id="app-style" rel="stylesheet" type="text/css">

</head>

<body style="direction: rtl">

<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="bg-primary bg-soft">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary">ثبت نام</h5>

                                </div>
                            </div>
                            {{--                            <div class="col-5 align-self-end">--}}
                            {{--                                <img src="assets\images\profile-img.png" alt="" class="img-fluid">--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="auth-logo">
                            <a href="index.html" class="auth-logo-light">
                                <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="{{asset('assets/images/logo.png')}}" alt=""
                                                     class="rounded-circle" height="34">
                                            </span>
                                </div>
                            </a>

                            <a href="index.html" class="auth-logo-dark">
                                <div class="avatar-md profile-user-wid mb-4">
                                            <span class="rounded-circle">
                                                <img style="height: 80px;width: 80px"
                                                     src="{{asset('assets/images/logo.png')}}" alt=""
                                                     class="rounded-circle" height="34">
                                            </span>
                                </div>
                            </a>
                        </div>
                        <div class="p-2">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="useremail" class="form-label">نام کاربری</label>
                                    <input id="name" class="form-control  @error('name') is-invalid @enderror"
                                           name="name" value="{{ old('name') }}" id="useremail" required="">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="username" class="form-label">ایمیل </label>

                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="userpassword" class="form-label">رمز عبور</label>
                                    {{--                                    <input type="password" class="form-control" id="userpassword"  required="">--}}
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">
                                    <div class="invalid-feedback">

                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="userpassword" class="form-label">تکرار رمز عبور</label>

                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">

                                    <div class="invalid-feedback">

                                    </div>
                                </div>

                                <div class="mt-4 d-grid">

                                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                                        ثبت نام
                                    </button>
                                </div>

                                {{--                                <div class="mt-4 text-center">--}}
                                {{--                                    <h5 class="font-size-14 mb-3">Sign up using</h5>--}}

                                {{--                                    <ul class="list-inline">--}}
                                {{--                                        <li class="list-inline-item">--}}
                                {{--                                            <a href="javascript::void()" class="social-list-item bg-primary text-white border-primary">--}}
                                {{--                                                <i class="mdi mdi-facebook"></i>--}}
                                {{--                                            </a>--}}
                                {{--                                        </li>--}}
                                {{--                                        <li class="list-inline-item">--}}
                                {{--                                            <a href="javascript::void()" class="social-list-item bg-info text-white border-info">--}}
                                {{--                                                <i class="mdi mdi-twitter"></i>--}}
                                {{--                                            </a>--}}
                                {{--                                        </li>--}}
                                {{--                                        <li class="list-inline-item">--}}
                                {{--                                            <a href="javascript::void()" class="social-list-item bg-danger text-white border-danger">--}}
                                {{--                                                <i class="mdi mdi-google"></i>--}}
                                {{--                                            </a>--}}
                                {{--                                        </li>--}}
                                {{--                                    </ul>--}}
                                {{--                                </div>--}}


                            </form>
                        </div>

                    </div>
                </div>
                <div class="mt-5 text-center">

                    <div>
                        <p>آیا قبلا اکانت ساخته اید ? <a href="{{route('login')}}" class="fw-medium text-primary">
                                ورود</a></p>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- JAVASCRIPT -->
<script src="{{asset('assets\libs\jquery\jquery.min.js')}}"></script>
<script src="{{asset('assets\libs\bootstrap\js\bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets\libs\metismenu\metisMenu.min.js')}}"></script>
<script src="{{asset('assets\libs\simplebar\simplebar.min.js')}}"></script>
<script src="{{asset('assets\libs\node-waves\waves.min.js')}}"></script>

<!-- validation init -->
<script src="{{asset('assets\js\pages\validation.init.js')}}"></script>

<!-- App js -->
<script src="{{asset('assets\js\app.js')}}"></script>

</body>
</html>
