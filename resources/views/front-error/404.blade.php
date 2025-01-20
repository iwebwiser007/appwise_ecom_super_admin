<!DOCTYPE html>
<html dir="ltr" lang="zxx">

<!-- Mirrored from uomo-html.flexkitux.com/Demo3/404.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 31 Jul 2024 05:18:49 GMT -->

<head>
    <meta charset="UTF-8">
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">

    {{-- Static And Dynamic SEO (HTML meta tags): Check the HTML <meta> tags and <title> tag in public/front/layout/layout.blade.php. Check index() method in public/front/IndexController.php, listing() method in public/front/ProductsController.php, detail() method in public/front/ProductsController.php and cart() method in public/front/ProductsController.php     --}}
    @if (!empty($meta_description))
    <meta name="description" content="{{ $meta_description }}">
    @endif

    @if (!empty($meta_keywords))
    <meta name="keywords" content="{{ $meta_keywords }}">
    @endif

    <title>

        {{-- Static And Dynamic SEO (HTML meta tags): Check the HTML <meta> tags and <title> tag in public/front/layout/layout.blade.php. Check index() method in public/front/IndexController.php, listing() method in public/front/ProductsController.php, detail() method in public/front/ProductsController.php and cart() method in public/front/ProductsController.php     --}}
        @if (!empty($meta_title))
        {{ $meta_title }}
        @else
        E-commerce - By Appwsie E-commerce
        @endif

    </title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/gif/x-icon/png" sizes="16x16">
    <!-- Base Google Font for Web-app -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <!-- Google Fonts for Banners only -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,800" rel="stylesheet">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('public/front/css/plugins/swiper.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/front/css/plugins/jquery.fancybox.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/front/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('public/front/css/bootstrap.min.css') }}">


</head>

<body class="not-found-page">


    <main>
        <section class="page-not-found">
            <div class="content container">
                <h2 class="mb-3">OOPS!</h2>
                <h3 class="mb-3">Page not found</h3>
                <p class="mb-3">Sorry, we couldn't find the page you where looking for. We suggest that you return to
                    home page.</p>
                <a href="{{ url('/home') }}" class="btn btn-primary">GO To Home</a>
            </div>
        </section>
    </main>



    <!-- External JavaScripts -->
    <script src="{{ asset('public/front/js/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('public/front/js/plugins/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/front/js/plugins/bootstrap-slider.min.js') }}"></script>

    <script src="{{ asset('public/front/js/plugins/swiper.min.js') }}"></script>
    <script src="{{ asset('public/front/js/plugins/countdown.js') }}"></script>
    <script src="{{ asset('public/front/js/plugins/jquery.fancybox.js') }}"></script>

    <!-- Footer Scripts -->
    <script src="{{ asset('public/front/js/theme.js') }}"></script>

</body>


<!-- Mirrored from uomo-html.flexkitux.com/Demo3/404.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 31 Jul 2024 05:18:49 GMT -->

</html>