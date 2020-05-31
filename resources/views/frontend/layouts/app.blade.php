<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="DediF" />
    <meta name="keywords" content="eci, eci bisnis manajemen, expert club indonesia, expert, club, indoensia, consulting, bisnis" />
    <meta name="description" content="Expert Club  Indonesia" />

    <meta property="og:site_name" content="ECI Bisnis Manajemen">
    <meta property="og:url" content="{{ request()->fullUrl() }}"/>
    <meta property="og:title" content="Expert Club Indonesia"/>
    <meta property="og:description" content="Training & Consultant Center"/>
    <meta property="og:image" itemprop="image"  content="{{ asset('eci/logo/eci_logo_no_bg.png') }}"/>
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">
    <meta name=”robots” content="index, follow">

    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Stylesheets
    ============================================= -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Raleway:300,400,500,600,700|Crete+Round:400i" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="frontend/css/bootstrap.css" type="text/css" />

    <link rel="stylesheet" href="frontend/style.css" type="text/css" />

    <link rel="stylesheet" href="frontend/css/swiper.css" type="text/css" />

    <link rel="stylesheet" href="frontend/css/dark.css" type="text/css" />

    <link rel="stylesheet" href="frontend/css/font-icons.css" type="text/css" />

    <link rel="stylesheet" href="frontend/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="frontend/css/magnific-popup.css" type="text/css" />

    <link rel="stylesheet" href="frontend/css/responsive.css" type="text/css" />
    @stack('css')

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Document Title
    ============================================= -->
    <title>Expert Club Indonesia</title>
    <meta name="google-site-verification" content="JNAA_jhJoatZjJr4ccO_FTjZSNuLTu_dgUwrVbLZXNA" />
</head>

<body class="stretched">

<!-- Document Wrapper
============================================= -->
<div id="wrapper" class="clearfix">

    <!-- Header
    ============================================= -->
    <!-- <header id="header" class="transparent-header full-header" data-sticky-class="not-dark"> before -->
    <header id="header" class="transparent-header" data-sticky-class="not-dark">
        <div id="header-wrap">

            <div class="container clearfix">

                <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

                <!-- Logo
                ============================================= -->
                <div id="logo">
                    <a href="{{ route('front_main.index') }}" class="standard-logo" data-dark-logo="eci/logo/eci_logo_no_bg.png"><img src="eci/logo/eci_logo_no_bg.png" alt="ECI Logo"></a>
                    <a href="{{ route('front_main.index') }}" class="retina-logo" data-dark-logo="eci/logo/eci_logo_no_bg.png"><img src="eci/logo/eci_logo_no_bg.png" alt="ECI Logo"></a>
                </div><!-- #logo end -->

                <!-- Primary Navigation
                ============================================= -->
                <nav id="primary-menu" class="dark">
                    @if(request()->is('/') || request()->is('#'))
                        <ul class="one-page-menu" data-easing="easeInOutExpo" data-speed="1500">
                            <li><a href="#" data-href="#slider"><div>Home</div></a></li>
                            <li><a href="#" data-href="#section-news"><div>News</div></a></li>
                            <li><a href="#" data-href="#section-about" data-offset="60"><div>About</div></a></li>
                            <li><a href="#" data-href="#section-work" data-offset="60"><div>Work</div></a></li>
                            <li><a href="#" data-href="#section-blog" data-offset="10"><div>Blog</div></a></li>
                            <li><a href="#" data-href="#section-testimonials" data-offset="60"><div>Testimonials</div></a></li>
                            <li><a href="#" data-href="#section-team" data-offset="60"><div>Team</div></a></li>
                            <li><a href="#clients" data-href="#section-clients"><div>Clients</div></a></li>
                        </ul>
                    @else
                        <ul class="" data-easing="easeInOutExpo" data-speed="1500">
                            <li><a href="{{ route('front_main.index') }}" data-href=""><div>Home</div></a></li>
                        </ul>
                    @endif

                    <!-- Top Cart
                    ============================================= -->
{{--                    @include('frontend.layouts.menus.cart')--}}
                    <!-- #top-cart end -->

                    <!-- Top Search
                    ============================================= -->
{{--                    @include('frontend.layouts.menus.search')--}}
                    <!-- #top-search end -->

                </nav><!-- #primary-menu end -->

            </div>

        </div>

    </header><!-- #header end -->

    <!-- slider -->
    @stack('slider')
    <!-- end slider -->

    <!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap">

            @yield('body')

        </div>

    </section><!-- #content end -->

    <!-- Footer
    ============================================= -->
    <footer id="footer" class="dark">

        @include('frontend.layouts.menus.footer')

    </footer><!-- #footer end -->

</div><!-- #wrapper end -->

<!-- Go To Top
============================================= -->
<div id="gotoTop" class="icon-angle-up" data-mobile="true"></div>

<!-- External JavaScripts
============================================= -->
<script src="frontend/js/jquery.js"></script>
<script src="frontend/js/plugins.js"></script>

<!-- Footer Scripts
============================================= -->
<script src="frontend/js/functions.js"></script>

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.14.3/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.14.3/firebase-analytics.js"></script>

<script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "{!! config('google.firebase.api_key') !!}",
        authDomain: "{!! config('google.firebase.auth_domain') !!}",
        databaseURL: "{!! config('google.firebase.database_url') !!}",
        projectId: "{!! config('google.firebase.project_id') !!}",
        storageBucket: "{!! config('google.firebase.storage_bucket') !!}",
        messagingSenderId:" {!! config('google.firebase.messaging_sender_id') !!}",
        appId: "{!! config('google.firebase.app_id') !!}",
        measurementId: "{!! config('google.firebase.measurement_id') !!}"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{ config('google.firebase.measurement_id') }}"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '{!! config('google.firebase.measurement_id') !!}');
</script>

@stack('scripts')

</body>
</html>
