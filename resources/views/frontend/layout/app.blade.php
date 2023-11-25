<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="CodePixar">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Karma Shop</title>
    <!--
  CSS
  ============================================= -->
    <link rel="stylesheet" href="{{ asset('front/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/ion.rangeSlider.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/css/ion.rangeSlider.skinFlat.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/main.css') }}">
</head>

<body id="{{ request()->routeIs('shop') ? 'category' : '' }}">

    <!-- Start Header Area -->
    @include('frontend.layout.partials.navbar')
    <!-- End Header Area -->


    @yield('content')


    <!-- start footer Area -->
    @include('frontend.layout.partials.footer')
    <!-- End footer Area -->

    {{-- scripts --}}
    @include('frontend.layout.partials.scripts')
    {{-- end scripts --}}

</body>

</html>
