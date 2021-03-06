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
                            <img src="http://wadas.co.id/wp-content/uploads/2020/12/cropped-wds-highress-trs-1024x1024-1-100x100.png" style="height: 100px; width: 150px;" >
                        </a>
                    </div>
                    @yield('body_content')
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
