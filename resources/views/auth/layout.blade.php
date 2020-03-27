<!doctype html>

<html lang="{{ app()->getLocale() }}" >

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="UTF-8">

    <title>{{ config('app.name') }}</title>
    <meta name="keywords" content="Keywords" />
    <meta name="description" content="description">
    <meta name="author" content="Ramadhan">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Meta --}}
    <meta name="csrf_token" content="{{ csrf_token() }}">

    <!--begin::Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
    <!--end::Fonts -->


    <!--begin::Page Custom Styles(used by this page) -->
    <link href="{{url('themes/eci/css/pages/login/login-3.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="{{url('themes/eci/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('themes/eci/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->

    <link href="{{url('themes/eci/css/skins/header/base/light.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('themes/eci/css/skins/header/menu/light.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('themes/eci/css/skins/brand/dark.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('themes/eci/css/skins/aside/dark.css')}}" rel="stylesheet" type="text/css" />

    <!--end::Layout Skins -->

    {{--  favicon  --}}
    <link rel="shortcut icon" href="https://keenthemes.com/metronic/themes/metronic/theme/default/demo1/dist/assets/media/logos/favicon.ico" />

    <!-- Hotjar Tracking Code for keenthemes.com -->
{{--    <script>--}}
{{--        (function(h,o,t,j,a,r){--}}
{{--            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};--}}
{{--            h._hjSettings={hjid:1070954,hjsv:6};--}}
{{--            a=o.getElementsByTagName('head')[0];--}}
{{--            r=o.createElement('script');r.async=1;--}}
{{--            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;--}}
{{--            a.appendChild(r);--}}
{{--        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');--}}
{{--    </script>--}}
    <!-- Global site tag (gtag.js) - Google Analytics -->
{{--    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-37564768-1"></script>--}}
{{--    <script>--}}
{{--        window.dataLayer = window.dataLayer || [];--}}
{{--        function gtag(){dataLayer.push(arguments);}--}}
{{--        gtag('js', new Date());--}}
{{--        gtag('config', 'UA-37564768-1');--}}
{{--    </script>--}}
    @stack('css')
</head>
<!-- end::Head -->

<!-- begin::Body -->
<body  class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading"  >

<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root">
    <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url({{url('themes/eci/media/bg/bg-3.jpg')}});">
            <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                <div class="kt-login__container">
                    <div class="kt-login__logo">
                        <a href="#">
                            <img src="{{url('eci/logo/eci_logo.jpeg')}}" style="height: 100px; width: 150px;" >
                        </a>
                    </div>
                    @yield('body_content')
{{--                    <div class="kt-login__signup">--}}
{{--                        <div class="kt-login__head">--}}
{{--                            <h3 class="kt-login__title">Sign Up</h3>--}}
{{--                            <div class="kt-login__desc">Enter your details to create your account:</div>--}}
{{--                        </div>--}}
{{--                        <form class="kt-form" action="#">--}}
{{--                            <div class="input-group">--}}
{{--                                <input class="form-control" type="text" placeholder="Fullname" name="fullname">--}}
{{--                            </div>--}}
{{--                            <div class="input-group">--}}
{{--                                <input class="form-control" type="text" placeholder="Email" name="email" autocomplete="off">--}}
{{--                            </div>--}}
{{--                            <div class="input-group">--}}
{{--                                <input class="form-control" type="password" placeholder="Password" name="password">--}}
{{--                            </div>--}}
{{--                            <div class="input-group">--}}
{{--                                <input class="form-control" type="password" placeholder="Confirm Password" name="rpassword">--}}
{{--                            </div>--}}
{{--                            <div class="row kt-login__extra">--}}
{{--                                <div class="col kt-align-left">--}}
{{--                                    <label class="kt-checkbox">--}}
{{--                                        <input type="checkbox" name="agree">I Agree the <a href="#" class="kt-link kt-login__link kt-font-bold">terms and conditions</a>.--}}
{{--                                        <span></span>--}}
{{--                                    </label>--}}
{{--                                    <span class="form-text text-muted"></span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="kt-login__actions">--}}
{{--                                <button id="kt_login_signup_submit" class="btn btn-brand btn-elevate kt-login__btn-primary">Sign Up</button>&nbsp;&nbsp;--}}
{{--                                <button id="kt_login_signup_cancel" class="btn btn-light btn-elevate kt-login__btn-secondary">Cancel</button>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                    <div class="kt-login__forgot">--}}
{{--                        <div class="kt-login__head">--}}
{{--                            <h3 class="kt-login__title">Forgotten Password ?</h3>--}}
{{--                            <div class="kt-login__desc">Enter your email to reset your password:</div>--}}
{{--                        </div>--}}
{{--                        <form class="kt-form" action="#">--}}
{{--                            <div class="input-group">--}}
{{--                                <input class="form-control" type="text" placeholder="Email" name="email" id="kt_email" autocomplete="off">--}}
{{--                            </div>--}}
{{--                            <div class="kt-login__actions">--}}
{{--                                <button id="kt_login_forgot_submit" class="btn btn-brand btn-elevate kt-login__btn-primary">Request</button>&nbsp;&nbsp;--}}
{{--                                <button id="kt_login_forgot_cancel" class="btn btn-light btn-elevate kt-login__btn-secondary">Cancel</button>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                    <div class="kt-login__account">--}}
{{--					<span class="kt-login__account-msg">--}}
{{--						Don't have an account yet ?--}}
{{--					</span>--}}
{{--                        &nbsp;&nbsp;--}}
{{--                        <a href="javascript:;" id="kt_login_signup" class="kt-login__account-link">Sign Up!</a>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: Page -->


<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": [
                    "#c5cbe3",
                    "#a1a8c3",
                    "#3d4465",
                    "#3e4466"
                ],
                "shape": [
                    "#f0f3ff",
                    "#d9dffa",
                    "#afb4d4",
                    "#646c9a"
                ]
            }
        }
    };
</script>
<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{url('themes/eci/plugins/global/plugins.bundle.js')}}" type="text/javascript"></script>
<script src="{{url('themes/eci/js/scripts.bundle.js')}}" type="text/javascript"></script>
<!--end::Global Theme Bundle -->


<!--begin::Page Scripts(used by this page) -->
<script src="{{url('themes/eci/js/pages/custom/login/login-general.js')}}" type="text/javascript"></script>
<!--end::Page Scripts -->

@stack('scripts')
</body>
<!-- end::Body -->

</html>
