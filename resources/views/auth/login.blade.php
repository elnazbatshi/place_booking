<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>به سامانه رزواسیون حوزه هنری</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets\images\favicon.ico">

    <!-- Bootstrap Css -->
    <link href="{{asset('assets\css\bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="{{asset('assets\css\icons.min.css')}}" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="{{asset('assets\css\app.min.css')}}" id="app-style" rel="stylesheet" type="text/css">

</head>

<body>
<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="bg-primary bg-soft">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-primary p-4 m-auto text-center">
                                    <h5 class="text-primary">به سامانه رزواسیون حوزه هنری</h5>
                                    <p>خوش آمدید</p>
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
                                                <img src="{{asset('assets/images/logo/logo-222-site-hssssoze-honari.png')}}"
                                                     alt="" class="rounded-circle" height="34">
                                            </span>
                                </div>
                            </a>

                            <a href="index.html" class="auth-logo-dark">
                                <div class="avatar-md profile-user-wid mb-4">
                                            <span class="rounded-circle">
                                                <img style="height: 80px;width: 80px"
                                                     src="{{asset('/assets/images/logo/logo-222-site-hssssoze-honari.png')}}"
                                                     alt="" class="rounded-circle" height="34">
                                            </span>
                                </div>
                            </a>
                        </div>
                        <div class="p-2">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="username" class="form-label"> ایمیل </label>

                                    <input id="email" name="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>
                                </div>


                                <div class="mb-3">
                                    <label class="form-label">کلمه عبور</label>
                                    <div class="input-group auth-pass-inputgroup">
                                        <input id="password" name="password" type="password" class="form-control"
                                               aria-label="Password" aria-describedby="password-addon">
                                        <button class="btn btn-light " type="button" id="password-addon"><i
                                                class="mdi mdi-eye-outline"></i></button>
                                    </div>
                                </div>

                                <div class="form-check d-flex justify-content-between">
                                    <div>
                                        <input class="form-check-input" type="checkbox" id="remember-check">
                                        <label class="form-check-label" for="remember-check">
                                            مرا به خاطر بسپر
                                        </label>
                                    </div>
                                    <a class="register-btn" href="{{route('register')}}">
                                        <button type="button" class="btn btn-primary">ثبت نام</button>
                                    </a>

                                </div>

                                <div class="mt-3 d-grid">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">ورود</button>
                                </div>


                            </form>
                        </div>

                    </div>
                </div>
                <div class="mt-5 text-center">

                    {{--                    <div>--}}
                    {{--                        <p>اکانت ندارید ? <a href="{{route('register')}}" class="fw-medium text-primary"> ثبت نام کنید </a> </p>--}}

                    {{--                    </div>--}}
                </div>

            </div>
        </div>
    </div>
</div>
<!-- end account-pages -->

<!-- JAVASCRIPT -->
<script src="{{asset('assets\libs\jquery\jquery.min.js')}}"></script>
<script src="{{asset('assets\libs\bootstrap\js\bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets\libs\metismenu\metisMenu.min.js')}}"></script>
<script src="{{asset('assets\libs\simplebar\simplebar.min.js')}}"></script>
<script src="{{asset('assets\libs\node-waves\waves.min.js')}}"></script>

<!-- App js -->
<script src="{{asset('booking\js\app.js')}}"></script>
</body>
</html>
