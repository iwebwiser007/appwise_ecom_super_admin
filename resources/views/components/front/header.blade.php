<?php

$front_logo = App\Models\Setting::where('id', '1')->first();
$front_logo = $front_logo->front_logo;

?>
<header>
    <!-- container start -->
    <div class="container">
        <!-- navigation bar -->
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="{{ url('home') }}">
                <img src="{{ asset('public/front/images/logo/' . $front_logo) }}" alt="image">
            </a>
            <button class="navbar-toggler p-1" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pricing">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#how_it_work">How it works</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link white_btn" href="https://123ecommerce.co.za/" target="_blank">View Demo Store</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dark_btn" href="#inquiry">GET Quote</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- navigation end -->

    </div>

    
    <!-- container end -->
</header>