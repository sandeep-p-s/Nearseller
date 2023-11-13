<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>NearSeller @yield('title')</title>
    <link href="{{ asset('img/favicon.png') }}" rel="shortcut icon" />
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name="viewport" content="width=device-width minimum-scale=1.0 maximum-scale=1.0 user-scalable=no" />
    <link rel='stylesheet' type='text/css' media='screen' href='{{ asset('css/bootstrap.css') }}'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;700;800;900&display=swap"
        rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='{{ asset('css/main.css') }}'>
    <link rel='stylesheet' type='text/css' media='screen' href='{{ asset('css/responsive.css') }}'>
    <link rel='stylesheet' type='text/css' media='screen' href='{{ asset('css/menu.css') }}'>
    <link rel='stylesheet' type='text/css' media='screen' href='{{ asset('css/mmenu.css') }}'>
    <link rel='stylesheet' type='text/css' media='screen' href='{{ asset('css/mobile.css') }}'>
    <script src='{{ asset('js/jquery.min.js') }}'></script>
    <script src='{{ asset('js/bootstrap.js') }}'></script>
    <script src='{{ asset('js/main.js') }}'></script>
    <script src='{{ asset('js/mmenu.js') }}'></script>

</head>

<body>


    <div id="page">
        <div id="headers">
            <a href="#menu"><span></span></a>
            <img src="{{ asset('img/header_logo.png') }}" class="mob_logo">
        </div>

        <nav id="menu">
            <div id="panel-menu">
                <ul>
                    <li> <a href="{{ route('Home') }}">Home</a></li>
                    <li> <a href="{{ route('user.products') }}">Products</a></li>
                    <li><a href="{{ route('user.services') }}">Services</a> </li>
                    <li><a href="#/">Shops</a> </li>
                    <li> <a href="#/">Best Deals</a></li>

                </ul>
            </div>

            <ul id="panel-account" data-mm-title="Account">
                <li><a href="#/">My profile</a></li>
                <li><a href="#/">Privacy settings</a></li>
                <li><a href="#/">Activity</a></li>
                <li><a href="#/">Sign out</a></li>
            </ul>

            <div id="panel-cart" data-mm-title="Cart">
                <p style="text-align: center; padding-top: 30px"> Your shoppingcart is empty.<br />
                    <a href="#/">Continue shopping.</a>
                </p>
            </div>
        </nav>


        <nav class="navbar navbar-expand-md bg-body-tertiary">
            <a class="navbar-brand" href="{{ route('Home') }}">
                <img src="{{ asset('img/header_logo.png') }}" alt="" class="web_logo">
            </a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="search-and-icons">
                    <select class="form-select " aria-label="Default select example">
                        <option selected>Location</option>
                        @foreach ($districts as $dist)
                            <option value="{{ $dist->id }}">{{ $dist->district_name }}
                            </option>
                        @endforeach

                    </select>
                    <form class="d-flex mb-2 me-2 search " role="search">
                        <input class="form-control me-2" type="search" aria-label="Search"
                            placeholder="Search here...">
                    </form>
                </div>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('user.products') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.services') }}">Services</a>
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
                        @php
                            $roleid = session('roleid');
                            $roleIdsArray = explode(',', $roleid);
                            if (is_array($userdetails) || is_countable($userdetails)) {
                                $cnts = count($userdetails);
                                if ($cnts > 0) {
                                    foreach ($userdetails as $key => $uservalue) {
                                        $username = $uservalue->name;
                                    }
                                }
                            }

                        @endphp
                        @if (in_array('4', $roleIdsArray))
                            <style>
                                .menu li ul {
                                    display: none;
                                }

                                .menu li:hover>ul {
                                    display: block;
                                }

                                .menu li ul {
                                    position: absolute;
                                }
                            </style>
                            @if ($cnts > 0)
                                <nav>
                                    <ul class="menu">
                                        <li class="dropdown" align="center">
                                            <a href="#"><i class="fa fa-user"
                                                    style="font-size: 40px;"></i></a><br>
                                            <font color="#ff9800">{{ $username }}</font>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">&nbsp;&nbsp;&nbsp;<i
                                                            class="fas fa-user"></i>&nbsp;&nbsp; My profile</a></li>
                                                <li><a href="#">&nbsp;&nbsp;&nbsp;<i
                                                            class="fas fa-shopping-bag"></i>&nbsp;&nbsp; My Cart</a>
                                                </li>
                                                <li><a href="{{ route('logout') }}">&nbsp;&nbsp;&nbsp;<i
                                                            class="fas fa-lock"></i>&nbsp;&nbsp; Sign out</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            @endif
                        @else
                            <div class="profile"><a href="{{ route('login') }}"><i class="fa fa-user"></i></a></div>
                            <div class="cart"><i class="fa-solid fa-bag-shopping"></i></div>
                        @endif



                    </div>
                </div>

            </div>
        </nav>
        <script>
            // document.querySelectorAll('.dropdown').forEach(function(elem) {
            //     elem.addEventListener('click', function(event) {
            //         event.preventDefault();
            //         var dropdownMenu = this.querySelector('.dropdown-menu');
            //         if (dropdownMenu.style.display === 'block') {
            //             dropdownMenu.style.display = 'none';
            //         } else {
            //             dropdownMenu.style.display = 'block';
            //         }
            //     });
            // });

            $(document).ready(function() {
                $('.dropdown').click(function() {
                    $(this).children('.dropdown-menu').toggle();
                });
            });
        </script>
