<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from kalanidhithemes.com/live-preview/landing-page/apper/all-demo/01-app-landing-page-defoult/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Dec 2024 05:01:08 GMT -->

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appwise</title>

    <link rel="stylesheet" href="{{ asset('public/front/css/icofont.min.css') }}">

    <!-- Owl-Carosal-Style-link -->
    <link rel="stylesheet" href="{{ asset('public/front/css/owl.carousel.min.css') }}">
    <!-- Bootstrap-Style-link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Aos-Style-link -->
    <link rel="stylesheet" href="{{ asset('public/front/css/aos.css') }}">
    <!-- Coustome-Style-link -->
    <link rel="stylesheet" href="{{ asset('public/front/css/style.css') }}">
    <!-- Responsive-Style-link -->
    <link rel="stylesheet" href="{{ asset('public/front/css/responsive.css') }}">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('public/front/images/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('public/parsleyjs/parsleycss.css')}}">

    @yield('styles')
</head>

<body>

    <!-- Page-wrapper-Start -->
    <div class="page_wrapper">

        <!-- Preloader -->
        <div id="preloader">
            <div id="loader"></div>
        </div>

        @include('components.front.header')

        @yield('content')

        @include('components.front.footer')

        <!-- VIDEO MODAL -->
        <div class="modal fade youtube-video" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button id="close-video" type="button" class="button btn btn-default text-right" data-dismiss="modal">
                        <i class="icofont-close-line-circled"></i>
                    </button>
                    <div class="modal-body">
                        <div id="video-container" class="video-container">
                            <iframe id="youtubevideo" src="#" width="640" height="360" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>

        <div class="purple_backdrop"></div>

    </div>
    <!-- Page-wrapper-End -->

    <!-- Jquery-js-Link -->
    <script src="{{ asset('public/front/js/jquery.js') }}"></script>
    <!-- owl-js-Link -->
    <script src="{{ asset('public/front/js/owl.carousel.min.js') }}"></script>
    <!-- bootstrap-js-Link -->
    <script src="{{ asset('public/front/js/bootstrap.min.js') }}"></script>
    <!-- aos-js-Link -->
    <script src="{{ asset('public/front/js/aos.js') }}"></script>
    <!-- main-js-Link -->
    <script src="{{ asset('public/front/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('public/parsleyjs/parsley.min.js')}}"></script>


</body>


<!-- Mirrored from kalanidhithemes.com/live-preview/landing-page/apper/all-demo/01-app-landing-page-defoult/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Dec 2024 05:01:50 GMT -->

</html>