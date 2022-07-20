<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title> @if(@$metaData['meta_title']!='') {{ @$metaData['meta_title'] }} @else {{ @$pageTitle }} @endif </title>

    <meta name="description" content="@if(@$metaData['meta_description']!='') {{ (@$metaData['meta_description']) }} @endif">
    @if(isset($metaData['meta_keyword']) AND $metaData['meta_keyword'] != null)
        <meta name="keywords" content="{{ $metaData['meta_keyword'] }}">
    @endif

    <meta name="author" content="zainiktheme">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta property="og:type" content="Web Template">
    <meta property="og:title" content="LMSZAI- LMSZAI is a Learning Management System">
    <meta property="og:description" content="LMSZAI- LMSZAI is a Learning Management System">
    <meta property="og:image" content="{{ getImageFile(get_option('app_logo')) }}">

    <meta name="twitter:card" content="zainiktheme">
    <meta name="twitter:title" content="LMSZAI- LMSZAI is a Learning Management System">
    <meta name="twitter:description" content="LMSZAI- LMSZAI is a Learning Management System">
    <meta name="twitter:image" content="{{ getImageFile(get_option('app_logo')) }}">

    <meta name="msapplication-TileImage" content="{{ getImageFile(get_option('app_logo')) }}">

    <meta name="msapplication-TileColor" content="rgba(103, 20, 222,.55)">
    <meta name="theme-color" content="#754FFE">

    @yield('meta')

    <title>{{ get_option('app_name') }} - {{ @$pageTitle }}</title>

    <!--=======================================
      All Css Style link
    ===========================================-->

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('frontend/assets/css/jquery-ui.min.css') }}" rel="stylesheet">

    <!-- Font Awesome for this template -->
    <link href="{{ asset('frontend/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Custom fonts for this template -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/assets/fonts/feather/feather.css') }}">

    <!-- Animate Css-->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/venobox.min.css') }}">

    <!-- Custom styles for this template -->
    <link href="{{ asset('frontend/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/extra.css') }}" rel="stylesheet">

    <!-- Responsive Css-->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">

    <!-- FAVICONS -->
    <link rel="icon" href="" type="image/png" sizes="16x16">
    <link rel="shortcut icon" href="{{ getImageFile(get_option('app_fav_icon')) }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ getImageFile(get_option('app_fav_icon')) }}">

    <link rel="apple-touch-icon-precomposed" type="image/x-icon" href="{{ getImageFile(get_option('app_fav_icon')) }}" sizes="72x72" />
    <link rel="apple-touch-icon-precomposed" type="image/x-icon" href="{{ getImageFile(get_option('app_fav_icon')) }}" sizes="114x114" />
    <link rel="apple-touch-icon-precomposed" type="image/x-icon" href="{{ getImageFile(get_option('app_fav_icon')) }}" sizes="144x144" />
    <link rel="apple-touch-icon-precomposed" type="image/x-icon" href="{{ getImageFile(get_option('app_fav_icon')) }}" />

    <link rel="stylesheet" href="{{asset('admin/sweetalert2/sweetalert2.css')}}">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @stack('style')
    @toastr_css
</head>

<body class="{{selectedLanguage()->rtl == 1 ? 'direction-rtl' : 'direction-ltr' }}">

<!-- Pre Loader Area start -->
<div id="preloader">
    <div id="status"><img src="{{ asset('frontend/assets/img/preloader.png') }}" alt="img" /></div>
</div>
<!-- Pre Loader Area End -->

<!--Main Menu/Navbar Area Start -->
@include('frontend.layouts.navbar')
<!--Main Menu/Navbar Area Start -->

<!-- Main Content Start-->
@yield('content')
<!-- Main Content End-->
<!-- Footer Start -->
@include('frontend.layouts.footer')
<!-- Footer End -->

<!--=======================================
    All Jquery Script link
===========================================-->
<!-- Bootstrap core JavaScript -->
<script src="{{ asset('frontend/assets/vendor/jquery/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/jquery/popper.min.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- ==== Plugin JavaScript ==== -->
<script src="{{ asset('frontend/assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<script src="{{ asset('frontend/assets/js/jquery-ui.min.js') }}"></script>

<!--WayPoints JS Script-->
<script src="{{ asset('frontend/assets/js/waypoints.min.js') }}"></script>

<!--Counter Up JS Script-->
<script src="{{ asset('frontend/assets/js/jquery.counterup.min.js') }}"></script>

<script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>

<!-- Range Slider -->
<script src="{{ asset('frontend/assets/js/price_range_script.js') }}"></script>

<!--Feather Icon-->
<script src="{{ asset('frontend/assets/js/feather.min.js') }}"></script>

<!--Iconify Icon-->
<script src="{{ asset('common/js/iconify.min.js') }}"></script>

<!--Venobox-->
<script src="{{ asset('frontend/assets/js/venobox.min.js') }}"></script>

<!-- Menu js -->
<script src="{{ asset('frontend/assets/js/menu.js') }}"></script>

<!-- Custom scripts for this template -->
<script src="{{ asset('frontend/assets/js/frontend-custom.js') }}"></script>


<script src="{{asset('admin/sweetalert2/sweetalert2.all.js')}}"></script>
<input type="hidden" id="base_url" value="{{url('/')}}">
<!-- Start:: Navbar Search  -->
<input type="hidden" class="search_route" value="{{ route('search-course.list') }}">
<script src="{{ asset('frontend/assets/js/custom/search-course.js') }}"></script>
<!-- End:: Navbar Search  -->

@stack('script')

@toastr_js
@toastr_render

@if (@$errors->any())
    <script>
        "use strict";
        @foreach ($errors->all() as $error)
        toastr.options.positionClass = 'toast-bottom-right';
        toastr.error("{{ $error }}")
        @endforeach
    </script>
@endif
</body>

</html>
