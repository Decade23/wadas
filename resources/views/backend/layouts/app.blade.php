<!DOCTYPE html>

<html lang="en" >
<!-- begin::Head -->


{{--<meta http-equiv="content-type" content="text/html;charset=UTF-8" />--}}
<head>
    <meta charset="utf-8"/>

    <title>ECI Console</title>
    <meta name="description" content="Updates and statistics">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">        <!--end::Fonts -->

    <!--begin::Page Vendors Styles(used by this page) -->
    <link href="{{ url('themes/eci/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles -->


    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="{{ url('themes/eci/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('themes/eci/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->

    <link href="{{ url('themes/eci/css/skins/header/base/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('themes/eci/css/skins/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('themes/eci/css/skins/brand/dark.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('themes/eci/css/skins/aside/dark.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Layout Skins -->

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
{{--    </script>    --}}
    @stack('css')
</head>
<!-- end::Head -->

<!-- begin::Body -->
<body  class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading"  >

<!-- begin:: Page -->
<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed " >
    <div class="kt-header-mobile__logo">
        <a href="#">
{{--            <img alt="Logo" src="{{ asset('themes/eci/media/logos/logo-light.png') }}">--}}
            <span style="color: #9de0f6;">ECI Console</span>
{{--        {{ url('themes/eci/media/logos/logo-light.png') }}    --}}
        </a>
    </div>
    <div class="kt-header-mobile__toolbar">
        <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>

        <button class="kt-header-mobile__toggler" id="kt_header_mobile_toggler"><span></span></button>

        <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
    </div>
</div>
<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

        <!-- begin:: Aside -->

        <!-- Uncomment this to display the close button of the panel
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
-->

        <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
            <!-- begin:: Aside -->
            <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
                <div class="kt-aside__brand-logo">
                    <a href="#">
{{--                        <img alt="Logo" src="{{url('themes/eci/media/logos/logo-light.png')}}" >--}}
                        <span style="color: #9de0f6;">ECI Console</span>
{{--                     {{url('themes/eci/media/logos/logo-light.png')}}   --}}
                    </a>
                </div>

                <div class="kt-aside__brand-tools">
                    <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
				<span>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"/>
                            <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) "/>
                            <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) "/>
                        </g>
                    </svg>
                </span>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                        <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"/>
                                        <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "/>
                                    </g>

                            </svg>
                        </span>
                    </button>
                    <!--
			<button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left" id="kt_aside_toggler"><span></span></button>
			-->
                </div>
            </div>
            <!-- end:: Aside -->	<!-- begin:: Aside Menu -->
            <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">

                <div
                    id="kt_aside_menu"
                    class="kt-aside-menu "
                    data-ktmenu-vertical="1"
                    data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500"
                >

                    <ul class="kt-menu__nav ">
                        {{-- sidebar --}}
                        @include('backend.layouts.menus.sidebar.dashboard')
{{--                        @include('backend.layouts.menus.sidebar.others')--}}
                        @include('backend.layouts.menus.sidebar.acl')
                        {{-- end sidebar --}}
                    </ul>
                </div>
            </div>
            <!-- end:: Aside Menu -->
        </div>
        <!-- end:: Aside -->

        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
            <!-- begin:: Header -->
            <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " >

                <!-- begin:: Header Menu -->
                <!-- Uncomment this to display the close button of the panel
<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
-->

                <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
                    <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default "  >
                        {{-- header left--}}
                        <ul class="kt-menu__nav ">
{{--                            @include('backend.layouts.menus.header.header_left.pages')--}}
                        </ul>
                    </div>
                </div>
                    <!-- end:: Header Menu -->
                    <!-- begin:: Header Topbar -->
                    <div class="kt-header__topbar">
                        <!--begin: Search -->

                        <!--end: Search -->
                        {{-- header right --}}
                        @include('backend.layouts.menus.header.header_right.pages')
                        {{-- end header right --}}
                        <!--end: User Bar -->
                    </div>
                <!-- end:: Header Topbar --></div>
            <!-- end:: Header -->
            <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                <!-- begin:: Content Head -->
{{--                @include('backend.layouts.menus.header.header_left.pages')--}}
                <!-- end:: Content Head -->
                <!-- begin:: Content -->
                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                    <!--Begin::Dashboard 1-->
                    @include('backend.layouts.menus.header.sub_header.list')
                    <!--Begin::Row-->
                    @yield('body')
                    <!--End::Row-->
                    <!--End::Dashboard 1-->
                </div>
                <!-- end:: Content -->
            </div>

                <!-- begin:: Footer -->
                <div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
                    <div class="kt-container  kt-container--fluid ">
                        <div class="kt-footer__copyright">
                            {{ date('Y') }}&nbsp;&copy;&nbsp;<a href="http://keenthemes.com/metronic" target="_blank" class="kt-link">ECI</a>
                        </div>
                            {{-- footer --}}
{{--                        <div class="kt-footer__menu">--}}
{{--                            <a href="#" target="_blank" class="kt-footer__menu-link kt-link">About</a>--}}
{{--                            <a href="#" target="_blank" class="kt-footer__menu-link kt-link">Team</a>--}}
{{--                            <a href="#" target="_blank" class="kt-footer__menu-link kt-link">Contact</a>--}}
{{--                        </div>--}}
                        {{-- end footer --}}
                    </div>
                </div>
                <!-- end:: Footer -->
            </div>
    </div>
</div>
<!-- end:: Page -->

<!--begin::RemoveModal-->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="flaticon-warning"></i> Attention</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form action="" method="post" id="remove-form">
                {!! csrf_field() !!}

                <input name="_method" type="hidden" id="method" value="DELETE">

                <div class="remove-form-list"></div>
                <div class="modal-body">
                    <div class="alert alert-solid-danger alert-bold" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text"><span id="message"></span></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::RemoveModal-->

<!--begin::AlertModal-->
<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="flaticon-warning"></i> Attention</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <p id="modal-text"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--end::AlertModal-->


<!-- begin::Quick Panel -->
<!-- end::Quick Panel -->


<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>
<!-- end::Scrolltop -->

<!-- begin::Sticky Toolbar -->

<!-- end::Sticky Toolbar -->

<!-- begin::Demo Panel -->

<!-- end::Demo Panel -->



<!--Begin:: Chat-->
<!--ENd:: Chat-->

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
<script src="{{ url('themes/eci/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
<script src="{{ url('themes/eci/js/scripts.bundle.js') }}" type="text/javascript"></script>
<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->
<script src="{{ url('themes/eci/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}" type="text/javascript"></script>
{{--<script src="http://maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>--}}
<script src="{{ url('themes/eci/plugins/custom/gmaps/gmaps.js') }}" type="text/javascript"></script>
<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
{{--<script src="{{ url('themes/eci/js/pages/dashboard.js') }}" type="text/javascript"></script>--}}
<!--end::Page Scripts -->

<!-- tooltip -->
<script>

    (function () {
        window.alert = function () {
            $('#alertModal #modal-text').text(arguments[0]);
            $('#alertModal').modal('show');
        };
    })();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function () {
        $('[data-tooltip-custom="tooltip"]').tooltip({ boundary: 'window' })
    })

    $(document).keypress(function(event){
        if (event.which == '13') {
            event.preventDefault();
        }
    });

    $('#delete').on('show.bs.modal', function (e) {
        var removedLinkFull = $(e.relatedTarget).data('href');
        var message         = $(e.relatedTarget).data('message');
        var title           = $(e.relatedTarget).data('title');
        var method          = $(e.relatedTarget).data('method');

        $('#title').text(title);
        $('#message').text(message);

        if(typeof method != 'undefined'){
            $('#method').val(method);
        }

        $('#remove-form').attr('action', removedLinkFull);
    });
</script>
<!-- end tooltip -->

@stack('scripts')
</body>
<!-- end::Body -->

</html>
