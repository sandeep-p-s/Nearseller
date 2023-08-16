<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>NEARSELLER - @yield('title')</title>
    <link href="{{ asset('img/favicon.png')}}" rel="shortcut icon"/>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='{{ asset('css/bootstrap.css')}}'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;700;800;900&display=swap"
        rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='{{ asset('css/main.css') }}'>
    <link rel='stylesheet' type='text/css' media='screen' href='{{ asset('css/responsive.css') }}'>
    <script src='{{ asset('js/jquery.min.js') }}'></script>
    <script src='{{ asset('js/bootstrap.js') }}'></script>
    <script src='{{ asset('js/main.js') }}'></script>
</head>

<body>
    <nav class="navbar navbar-expand-md bg-body-tertiary">
        <div class="container-fluid" style="padding: 0;">

            <a class="navbar-brand" href="index.html">
                <img src="{{ asset('img/header_logo.png') }}" alt="">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <i class="fa fa-bars"></i>
                </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="search-and-icons">
                    <select class="form-select " aria-label="Default select example">
                        <option selected>Location</option>
                        <option value="1">Trivandrum</option>
                        <option value="2">Kollam</option>
                        <option value="3">pathanamthitta</option>
                    </select>
                    <form class="d-flex mb-2 me-2 search " role="search">
                        <input class="form-control me-2" type="search" aria-label="Search" placeholder="search here...">
                    </form>
                </div>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="product.html">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.html">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shops.html">Shops</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="bestdeals.html">Best Deals</a>
                    </li>
                </ul>
                <div class="user_cart">
                    <div class="user-icons d-flex mb-2 justify-content-center m-style">
                        <div class="profile"><a href="{{ route('login') }}"><i class="fa fa-user"></i></a></div>
                        <div class="cart"><i class="fa-solid fa-bag-shopping"></i></div>
                        <!-- <div class="cart"><i class="bi bi-cart3"></i></div> -->
                    </div>
                </div>
            </div>
        </div>
    </nav>
