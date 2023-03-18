<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ورود</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assetsSite/css/style.css')}}">
</head>
<body>
<style>
    .text-danger{
        color: red;
    }
</style>

<div id="wrapper" class="container-fluid">
    <div class="container">
        @isset($route)
            <form method="POST" action="{{ $route }}">
                @else
                    <form method="POST" action="{{ route('login') }}">
                        @endisset

                        @csrf
                        <div class="login-col">
                            <div class="wrapper-logo">
                                <a class="header-logo" href="" title="">
                                    <img src="{{asset('assetsSite/img/logo.png')}}">
                                </a>
                            </div><!-- .wrapper-logo -->
                            <div class="login-top">ورود</div>
                            <div class="login-form">
                                <label for="username">نام کاربری :</label>
                                <input type="text" name="personal_id" id="personal_id"
                                       placeholder="شماره پرسنلی خود را وارد کنید">
                                @error('personal_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div><!-- .login-form -->
                            <div class="login-form">
                                <label for="password">رمز عبور:</label>
                                <input type="password" name="password" id="password"
                                       placeholder=" کلمه عبور خود را وارد کنید">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                                @enderror

                                @if($errors->any())
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong class="text-danger"> {{$errors->first()}}</strong>
                                    </span>
                                @endif
                            </div><!-- .login-form -->
                            <div class="checkbox-login pull-right">
                                <input class="remember" name="remember" type="checkbox" id="remember"
                                       value="accept_rules">
                                <label class="remember" for="remember">
                                    <span >مرا به خاطر داشته باش</span>
                                </label>
                            </div><!-- .checkbox-login -->
                            {{--                <div class="lost-password pull-right">--}}
                            {{--                    <a href="">رمز عبور خود را فراموش کرده اید؟</a>--}}
                            {{--                </div><!-- .lost-password -->--}}
                            <div class="clearfix"></div>
                            <button type="submit" class="login-btn button">ورود</button>
                        </div>
                    </form>

                    <!-- .login-col-->
                    <div class="form-action">
                        <div class="switch-home">
                            <a href="{{route('site.index')}}">بازگشت به صفحه اصلی</a>
                        </div><!-- .switch-home -->
                        <div class="clearfix"></div>
                    </div><!-- .form-action -->
    </div><!-- .container -->
</div><!-- #wrapper -->
</body>
</html>
