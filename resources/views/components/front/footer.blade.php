<?php

$front_logo = App\Models\Setting::where('id', '1')->first();
$front_logo = $front_logo->front_logo;

$admin = App\Models\User::where('id', '1')->first();
$adminEmail = $admin->email;
$adminPhone = $admin->mobile;

?>

<!-- Footer-Section start -->
<footer>
    <div class="top_footer" id="contact">
        <!-- animation line -->
        <div class="anim_line dark_bg">
            <span><img src="{{ asset('public/front/images/anim_line.png') }}" alt="anim_line"></span>
            <span><img src="{{ asset('public/front/images/anim_line.png') }}" alt="anim_line"></span>
            <span><img src="{{ asset('public/front/images/anim_line.png') }}" alt="anim_line"></span>
            <span><img src="{{ asset('public/front/images/anim_line.png') }}" alt="anim_line"></span>
            <span><img src="{{ asset('public/front/images/anim_line.png') }}" alt="anim_line"></span>
            <span><img src="{{ asset('public/front/images/anim_line.png') }}" alt="anim_line"></span>
            <span><img src="{{ asset('public/front/images/anim_line.png') }}" alt="anim_line"></span>
            <span><img src="{{ asset('public/front/images/anim_line.png') }}" alt="anim_line"></span>
            <span><img src="{{ asset('public/front/images/anim_line.png') }}" alt="anim_line"></span>
        </div>
        <!-- container start -->
        <div class="container z-1 position-relative ">
            <!-- row start -->
            <div class="row">
                <!-- footer link 1 -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="abt_side">
                        <div class="logo"> <img src="{{ asset('public/front/images/logo/' . $front_logo) }}" alt="image">
                        </div>
                        <ul>
                            <li><a href="#">{{$adminEmail}}</a></li>
                            <li><a href="#">{{ $adminPhone }}</a></li>
                        </ul>
                        <ul class="social_media">
                            <li><a class="d-flex justify-content-center align-items-center" href="#"><i
                                        class="icofont-facebook"></i></a></li>
                            <li><a class="d-flex justify-content-center align-items-center" href="#"><i
                                        class="icofont-twitter"></i></a></li>
                            <li><a class="d-flex justify-content-center align-items-center" href="#"><i
                                        class="icofont-instagram"></i></a></li>
                            <li><a class="d-flex justify-content-center align-items-center" href="#"><i
                                        class="icofont-pinterest"></i></a></li>
                        </ul>
                    </div>
                </div>

                <!-- footer link 2 -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="links">
                        <h3>Useful Links</h3>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#inquiry">Get Quote</a></li>
                        </ul>
                    </div>
                </div>

                <!-- footer link 3 -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="links">
                        <h3>Help & Suport</h3>
                        <ul>
                            <li><a href="#faq">FAQs</a></li>
                            <li><a href="#inquiry">Support</a></li>
                            <li><a href="#how_it_work">How it works</a></li>
                            <li><a href="{{ url('/term_&_condition') }}">Terms & conditions</a></li>
                            <li><a href="{{ url('/privacy_policy') }}">Privacy policy</a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <!-- row end -->
        </div>
        <!-- container end -->
    </div>

    <!-- last footer -->
    <div class="bottom_footer">
        <!-- container start -->
        <div class="container">
            <!-- row start -->
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>E-commerce Solution by Appwise All rights reserved © 2024</p>
                </div>
            </div>
            <!-- row end -->
        </div>
        <!-- container end -->
    </div>

    <!-- go top button -->
    <div class="go_top">

        <span><img src="{{ asset('public/front/images/go_top.png') }}" alt="image"></span>
    </div>
</footer>
<!-- Footer-Section end -->