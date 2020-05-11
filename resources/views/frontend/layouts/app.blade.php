<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="DediF" />
    <meta name="keywords" content="eci" />
    <meta name="description" content="training" />

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
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Document Title
    ============================================= -->
    <title>{{ config('app.name') }}</title>

</head>

<body class="stretched">

<!-- Document Wrapper
============================================= -->
<div id="wrapper" class="clearfix">

    <!-- Header
    ============================================= -->
    <header id="header" class="transparent-header full-header" data-sticky-class="not-dark">

        <div id="header-wrap">

            <div class="container clearfix">

                <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

                <!-- Logo
                ============================================= -->
                <div id="logo">
                    <a href="index.html" class="standard-logo" data-dark-logo="frontend/images/eci_logo_v1.png"><img src="frontend/images/eci_logo_v1.png" alt="ECI Logo"></a>
                    <a href="index.html" class="retina-logo" data-dark-logo="frontend/images/eci_logo@2x_v1.png"><img src="frontend/images/eci_logo@2x_v1.png" alt="ECI Logo"></a>
                </div><!-- #logo end -->

                <!-- Primary Navigation
                ============================================= -->
                <nav id="primary-menu" class="dark">

                    <ul class="one-page-menu" data-easing="easeInOutExpo" data-speed="1500">
                        <li><a href="#" data-href="#slider"><div>Home</div></a></li>
                        <li><a href="#" data-href="#section-news"><div>News</div></a></li>
                        <li><a href="#" data-href="#section-about" data-offset="60"><div>About</div></a></li>
                        <li><a href="#" data-href="#section-work" data-offset="60"><div>Work</div></a></li>
                        <li><a href="#" data-href="#section-blog" data-offset="60"><div>Blog</div></a></li>
                        <li><a href="#" data-href="#section-testimonials" data-offset="60"><div>Testimonials</div></a></li>
                        <li><a href="#" data-href="#section-team" data-offset="60"><div>Team</div></a></li>
                        <li><a href="#clients" data-href="#section-clients"><div>Clients</div></a></li>
                    </ul>

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
    @include('frontend.section.slider')
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
<div id="gotoTop" class="icon-angle-up"></div>

<!-- External JavaScripts
============================================= -->
<script src="frontend/js/jquery.js"></script>
<script src="frontend/js/plugins.js"></script>

<!-- Footer Scripts
============================================= -->
<script src="frontend/js/functions.js"></script>

</body>
</html>
