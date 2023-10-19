@extends('user.user')
@section('title', 'Services')
@section('content')
    <div class="dev3-2lvevpbewi200 section_wrapper">
        <div class="container-fluid">
            <nav class="dev3-25d3ticmqvls0  bg-orange ">
                <div class="dev3-243ztdnf8yww0 dev3-2gwcdwkqhmi00"><a href="#"><img src="assets/images/logo.png" alt></a>
                    <a href="#" class="dev3-di0jbv86i000"><i class="fa fa-times"></i></a>
                </div>
                <ul class="dev3-243ztdnf8yww0">
                    @foreach ($services as $sr)
                        <li class="dev3-3m8wtemb60w00 @if ($loop->first) active-blue @endif"><a href="">{{ $sr->service_name }}</a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>
    </header>


    <!-- Services near me starts -->
    <section class="exclusive_offer section_wrapper">
        <div class="container-fluid">
            <div class="row mb-3 mt-5">
                <div class="col-md-8">
                    <div class="">
                        <h3>{{ $service->service_name }} near you</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero molestiae maxime consequuntur
                            voluptatum ipsam quas quos minus et officia doloremque harum illo facere sunt, laudantium
                            soluta hic vitae non tenetur!</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="viewall_btn mt-5">
                        <select class="form-select control_filter" aria-label="Default select example">
                            <option selected="">Sort by</option>
                            <option value="1">Recomended</option>
                            <option value="2">New Arrival</option>
                            <option value="3">Best Deals</option>
                            <option value="2">Distance low to high</option>
                            <option value="3">Distance high to low</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    {{-- <h6 class="mt-5 filter_head">Filter</h6> --}}
                    <div class="filter mt-5">

                        <!-- Sidebar filter section -->
                        <section id="sidebar">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="all_tags d-flex">
                                        <ul class="tags">
                                            <li class="tag">
                                                <h4>2-4 Km</h4><a>X</a>
                                            </li>
                                            <li class="tag">
                                                <h4>3-5 Km</h4><a>X</a>
                                            </li>
                                        </ul>
                                        <a href="#" class="tag_link"> Clear All</a>
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">

                                    </div> -->
                            </div>
                            <!-- <p> Home | <b>All Breads</b></p>
                                <div class="border-bottom pb-2 ml-2">
                                    <h4 id="burgundy">Filters</h4>
                                </div>-->
                            <div class="py-2 border-bottom ml-3">
                                <h6 class="">Distance</h6>
                                <!-- <div id="orange"><span class="fa fa-minus"></span></div> -->
                                <form>
                                    <div class="form-group"> <label for="">0-2 km</label>
                                        <input type="checkbox" id="" class="float-end">
                                    </div>
                                    <div class="form-group"> <label for="">2-4 km</label>
                                        <input type="checkbox" id="" class="float-end">
                                    </div>
                                    <div class="form-group"> <label for="">4-6 km</label>
                                        <input type="checkbox" id="" class="float-end">
                                    </div>
                                    <div class="form-group"> <label for="">6-8 km</label>
                                        <input type="checkbox" id="" class="float-end">
                                    </div>
                                    <div class="form-group"> <label for="">More than 10 km</label>
                                        <input type="checkbox" id="" class="float-end">
                                    </div>
                                    <a href=""><div class="more">
                                        <p>More</p></a>
                                    </div>
                                </form>
                            </div>

                            <div class="py-2 ml-3">
                                <h6 class="font-weight-bold">Category</h6>
                                <!-- <div id="orange"><span class="fa fa-minus"></span></div> -->
                                <form>
                                    <div class="form-group"><label for="">Category 1</label>
                                        <input type="checkbox" id="" class="float-end">
                                    </div>
                                    <div class="form-group"> <label for="">Category 2</label>
                                        <input type="checkbox" id="" class="float-end">
                                    </div>
                                    <div class="form-group"> <label for="">Category 3</label>
                                        <input type="checkbox" id="" class="float-end">
                                    </div>
                                    <div class="form-group"> <label for="">Category 4</label>
                                        <input type="checkbox" id="" class="float-end">
                                    </div>
                                    <div class="form-group"> <label for="">Category 5</label>
                                        <input type="checkbox" id="" class="float-end">
                                    </div>
                                    <div class="more">
                                        <p>More</p>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="row mb-3 mt-5">
                        <!-- <div class="col-md-12">
                        <div class="exclusive_offer_heading">
                            <p>Exclusive Offers</p>
                        </div>
                    </div> -->


                        <div class="col-lg-3 col-md-4 col-sm-3 col-6 d-flex flex-wrap mb-3">
                            <div class="product_card border rounded p-2">


                                <div class="product_card_img">
                                    <img src="{{ asset('img/Saloon/saloon1.png') }}">
                                </div>
                                <div class="product_details p-2">
                                    <div class="product_name">
                                        <h6>ABC Saloon Shop</h6>
                                    </div>
                                    <div class="product_offer">
                                    </div>
                                    <div class="pro_detail">
                                        <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing
                                            elit.</p>
                                    </div>
                                    <div class="product_card-footer">
                                        <div class="wcf-left"><span class="price">> 2 Km</span></div>
                                        <div class="wcf-right">
                                            <a href="#" class="buy-btn">
                                                <i class="fa-regular fa-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-3 col-6 d-flex flex-wrap mb-3">
                            <div class="product_card border rounded p-2">


                                <div class="product_card_img">
                                    <img src="{{ asset('img/Saloon/saloon2.png') }}">
                                </div>
                                <div class="product_details p-2">
                                    <div class="product_name">
                                        <h6>Fair Saloon</h6>
                                    </div>
                                    <div class="product_offer">
                                    </div>
                                    <div class="pro_detail">
                                        <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing
                                            elit.</p>
                                    </div>
                                    <div class="product_card-footer">
                                        <div class="wcf-left"><span class="price">> 2 km</span></div>
                                        <div class="wcf-right">
                                            <a href="#" class="buy-btn">
                                                <i class="fa-regular fa-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-3 col-6 d-flex flex-wrap mb-3">
                            <div class="product_card border rounded p-2">

                                <div class="product_card_img">
                                    <img src="{{ asset('img/Saloon/saloon3.png') }}">
                                </div>
                                <div class="product_details p-2">
                                    <div class="product_name">
                                        <h6>Toni & guy</h6>
                                    </div>
                                    <div class="product_offer">
                                    </div>
                                    <div class="pro_detail">
                                        <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing
                                            elit.</p>
                                    </div>
                                    <div class="product_card-footer">
                                        <div class="wcf-left"><span class="price">> 2 km</span></div>
                                        <div class="wcf-right">
                                            <a href="#" class="buy-btn">
                                                <i class="fa-regular fa-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-3 col-6 d-flex flex-wrap mb-3">
                            <div class="product_card border rounded p-2">

                                <div class="product_card_img">
                                    <img src="{{ asset('img/Saloon/saloon4.png') }}">
                                </div>
                                <div class="product_details p-2">
                                    <div class="product_name">
                                        <h6>Naturals</h6>
                                    </div>
                                    <div class="product_offer">
                                        <p>50% off</p>
                                    </div>
                                    <div class="pro_detail">
                                        <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing
                                            elit.</p>
                                    </div>
                                    <div class="product_card-footer">
                                        <div class="wcf-left"><span class="price">> 2 km</span></div>
                                        <div class="wcf-right">
                                            <a href="#" class="buy-btn">
                                                <i class="fa-regular fa-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-3 col-6 d-flex flex-wrap mb-3">
                            <div class="product_card border rounded p-2">
                                <div class="product_card_img">
                                    <img src="{{ asset('img/Saloon/saloon5.png') }}">
                                </div>
                                <div class="product_details p-2">
                                    <div class="product_name">
                                        <h6>Super saloon</h6>
                                    </div>
                                    <div class="product_offer">
                                    </div>
                                    <div class="pro_detail">
                                        <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing
                                            elit.</p>
                                    </div>
                                    <div class="product_card-footer">
                                        <div class="wcf-left"><span class="price">> 2 km</span></div>
                                        <div class="wcf-right">
                                            <a href="#" class="buy-btn">
                                                <i class="fa-regular fa-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-3 col-6 d-flex flex-wrap mb-3">
                            <div class="product_card border rounded p-2">


                                <div class="product_card_img">
                                    <img src="{{ asset('img/Saloon/saloon6.png') }}">
                                </div>
                                <div class="product_details p-2">
                                    <div class="product_name">
                                        <h6>Fair shop</h6>
                                    </div>
                                    <div class="product_offer">
                                    </div>
                                    <div class="pro_detail">
                                        <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing
                                            elit.</p>
                                    </div>
                                    <div class="product_card-footer">
                                        <div class="wcf-left"><span class="price">> 2 km</span></div>
                                        <div class="wcf-right">
                                            <a href="#" class="buy-btn">
                                                <i class="fa-regular fa-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-3 col-6 mb-3">
                            <div class="product_card border rounded p-2">
                                <div class="product_card_img">
                                    <img src="{{ asset('img/Saloon/saloon1.png') }}">
                                </div>
                                <div class="product_details p-2">
                                    <div class="product_name">
                                        <h6>Finger touch</h6>
                                    </div>
                                    <div class="product_offer">
                                    </div>
                                    <div class="pro_detail">
                                        <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing
                                            elit.</p>
                                    </div>
                                    <div class="product_card-footer">
                                        <div class="wcf-left"><span class="price">> 3 km</span></div>
                                        <div class="wcf-right">
                                            <a href="#" class="buy-btn">
                                                <i class="fa-regular fa-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-3 col-6 mb-3">
                            <div class="product_card border rounded p-2">


                                <div class="product_card_img">
                                    <img src="{{ asset('img/Saloon/saloon2.png') }}">
                                </div>
                                <div class="product_details p-2">
                                    <div class="product_name">
                                        <h6>Naturals</h6>
                                    </div>
                                    <div class="product_offer">
                                    </div>
                                    <div class="pro_detail">
                                        <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing
                                            elit.</p>
                                    </div>
                                    <div class="product_card-footer">
                                        <div class="wcf-left"><span class="price">> 3 km</span></div>
                                        <div class="wcf-right">
                                            <a href="#" class="buy-btn">
                                                <i class="fa-regular fa-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-3 col-6 mb-3">
                            <div class="product_card border rounded p-2">


                                <div class="product_card_img">
                                    <img src="{{ asset('img/Saloon/saloon3.png') }}">
                                </div>
                                <div class="product_details p-2">
                                    <div class="product_name">
                                        <h6>Toni & guy</h6>
                                    </div>
                                    <div class="product_offer">
                                    </div>
                                    <div class="pro_detail">
                                        <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing
                                            elit.</p>
                                    </div>
                                    <div class="product_card-footer">
                                        <div class="wcf-left"><span class="price">> 3 km</span></div>
                                        <div class="wcf-right">
                                            <a href="#" class="buy-btn">
                                                <i class="fa-regular fa-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-3 col-6 mb-3">
                            <div class="product_card border rounded p-2">


                                <div class="product_card_img">
                                    <img src="{{ asset('img/Saloon/saloon4.png') }}">
                                </div>
                                <div class="product_details p-2">
                                    <div class="product_name">
                                        <h6>ABC saloon</h6>
                                    </div>
                                    <div class="product_offer">
                                    </div>
                                    <div class="pro_detail">
                                        <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing
                                            elit.</p>
                                    </div>
                                    <div class="product_card-footer">
                                        <div class="wcf-left"><span class="price">> 4 km</span></div>
                                        <div class="wcf-right">
                                            <a href="#" class="buy-btn">
                                                <i class="fa-regular fa-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-3 col-6 mb-3">
                            <div class="product_card border rounded p-2">


                                <div class="product_card_img">
                                    <img src="{{ asset('img/Saloon/saloon5.png') }}">
                                </div>
                                <div class="product_details p-2">
                                    <div class="product_name">
                                        <h6>Super saloon</h6>
                                    </div>
                                    <div class="product_offer">
                                    </div>
                                    <div class="pro_detail">
                                        <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing
                                            elit.</p>
                                    </div>
                                    <div class="product_card-footer">
                                        <div class="wcf-left"><span class="price">> 5 km</span></div>
                                        <div class="wcf-right">
                                            <a href="#" class="buy-btn">
                                                <i class="fa-regular fa-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-3 col-6 mb-3">
                            <div class="product_card border rounded p-2">


                                <div class="product_card_img">
                                    <img src="{{ asset('img/Saloon/saloon6.png') }}">
                                </div>
                                <div class="product_details p-2">
                                    <div class="product_name">
                                        <h6>VK saloon</h6>
                                    </div>
                                    <div class="product_offer">
                                    </div>
                                    <div class="pro_detail">
                                        <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing
                                            elit.</p>
                                    </div>
                                    <div class="product_card-footer">
                                        <div class="wcf-left"><span class="price">> 5 km</span></div>
                                        <div class="wcf-right">
                                            <a href="#" class="buy-btn">
                                                <i class="fa-regular fa-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-center"><a href="#" class="text-secondary">View More <i
                                    class="fa fa-angles-down"></i></a></p>
                        <!-- </div>
                        <div class="row mb-3"> -->

                    </div>
                </div>
            </div>
    </section>
    <!-- Products near me ends-->

    <!-- Fashion categories starts -->
    <section class="shop py-5 section_wrapper">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="">
                        <h3>Other Services</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero molestiae maxime consequuntur
                            voluptatum ipsam quas quos minus et officia doloremque harum illo facere sunt, laudantium
                            soluta hic vitae non tenetur!</p>
                    </div>
                </div>
                <!-- <div class="col-md-3">
                        <div class="float-end">
                            <button class="btn btn-default shop_now">View all Shops <i
                                    class="fa-solid fa-arrow-up"></i></button>
                        </div>
                    </div> -->
            </div>

            <div class="row mb-3 row-cols-12 row-cols-lg-12 g-2">
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="{{ asset('img/product_circle/fashion.png') }}" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Fashion</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="{{ asset('img/product_circle/fashion.png') }}" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Fashion</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="{{ asset('img/product_circle/fashion.png') }}" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Fashion</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="{{ asset('img/product_circle/fashion.png') }}" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Fashion</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="{{ asset('img/product_circle/fashion.png') }}" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Fashion</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="{{ asset('img/product_circle/fashion.png') }}" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Fashion</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="{{ asset('img/product_circle/fashion.png') }}" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Fashion</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="{{ asset('img/product_circle/fashion.png') }}" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Fashion</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="{{ asset('img/product_circle/fashion.png') }}" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Fashion</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="{{ asset('img/product_circle/fashion.png') }}" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Fashion</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="{{ asset('img/product_circle/fashion.png') }}" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Fashion</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="{{ asset('img/product_circle/fashion.png') }}" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Fashion</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- Fashion categories ends -->

    <!-- Best deals starts -->
    <section class="exclusive_offer section_wrapper">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="exclusive_offer_heading">
                        <p>Exclusive Offers for Tattoos</p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="">
                        <h3>Best Shops for tattoos</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero molestiae maxime consequuntur
                            voluptatum ipsam quas quos minus et officia doloremque harum illo facere sunt, laudantium
                            soluta hic vitae non tenetur!</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="viewall_btn">
                        <button class="btn btn-default shop_now">View all products <i
                                class="fa-solid fa-arrow-up"></i></button>
                    </div>
                </div>
            </div>
            <div class="row mb-3 gy-2">
                <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="product_card_img">
                            <img src="assets/img/Saloon/tatoos1.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Tattoos shop 1</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">
                                        < 2 km</span>
                                </div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                    <div class="product_card border rounded p-2">
                        <!-- <div class="badge">New</div> -->

                        <div class="product_card_img">
                            <img src="assets/img/Saloon/tattoos2.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Tattoos shop 2</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">
                                        < 2 km</span>
                                </div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                    <div class="product_card border rounded p-2">
                        <!-- <div class="badge">New</div> -->

                        <div class="product_card_img">
                            <img src="assets/img/Saloon/tattoos3.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Tattoos shop 3</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">
                                        < 2 km</span>
                                </div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="badge">New</div>

                        <div class="product_card_img">
                            <img src="assets/img/Saloon/tattoos4.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Tattoos shop 4</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">
                                        < 2 km</span>
                                </div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                    <div class="product_card border rounded p-2">
                        <!-- <div class="badge">New</div> -->

                        <div class="product_card_img">
                            <img src="assets/img/Saloon/tatoos5.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Tattoos shop 5</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">
                                        < 2 km</span>
                                </div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                    <div class="product_card border rounded p-2">
                        <!-- <div class="badge">New</div> -->

                        <div class="product_card_img">
                            <img src="assets/img/Saloon/tatoos6.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Tattoos shop 6</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">
                                        < 2 km</span>
                                </div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="badge">New</div>

                        <div class="product_card_img">
                            <img src="assets/img/Saloon/tatoos6.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Tattoos shop 1</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">
                                        < 2 km</span>
                                </div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                    <div class="product_card border rounded p-2">
                        <!-- <div class="badge">New</div> -->

                        <div class="product_card_img">
                            <img src="assets/img/Saloon/tatoos5.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Tattoos shop 2</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">
                                        < 2 km</span>
                                </div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                    <div class="product_card border rounded p-2">
                        <!-- <div class="badge">New</div> -->

                        <div class="product_card_img">
                            <img src="assets/img/Saloon/tattoos4.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Tattoos shop 3</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">
                                        < 2 km</span>
                                </div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="product_card_img">
                            <img src="assets/img/Saloon/tattoos3.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Tattoos shop 4</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">
                                        < 2 km</span>
                                </div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                    <div class="product_card border rounded p-2">
                        <!-- <div class="badge">New</div> -->

                        <div class="product_card_img">
                            <img src="assets/img/Saloon/tattoos2.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Tattoos shop 5</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">
                                        < 2 km</span>
                                </div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                    <div class="product_card border rounded p-2">
                        <!-- <div class="badge">New</div> -->

                        <div class="product_card_img">
                            <img src="assets/img/Saloon/tatoos1.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Tattoos shop 6</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">
                                        < 2 km</span>
                                </div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--Best deals ends -->

    <!-- Electronics brands categories starts -->
    <section class="shop py-5 section_wrapper">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="">
                        <h3>Electronics categories</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero molestiae maxime consequuntur
                            voluptatum ipsam quas quos minus et officia doloremque harum illo facere sunt, laudantium
                            soluta hic vitae non tenetur!</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="viewall_btn">
                        <button class="btn btn-default shop_now">View all Shops <i
                                class="fa-solid fa-arrow-up"></i></button>
                    </div>
                </div>
            </div>

            <div class="row mb-3 row-cols-12 row-cols-lg-12 g-2">
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="assets/img/product_circle/fashion.png" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Fashion</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="assets/img/product_circle/fashion.png" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Fashion</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="assets/img/product_circle/fashion.png" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Fashion</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="assets/img/product_circle/fashion.png" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Fashion</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="assets/img/product_circle/fashion.png" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Fashion</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="assets/img/product_circle/fashion.png" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Fashion</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="assets/img/product_circle/fashion.png" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Fashion</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="assets/img/product_circle/fashion.png" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Fashion</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="assets/img/product_circle/fashion.png" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Fashion</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="assets/img/product_circle/fashion.png" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Fashion</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="assets/img/product_circle/fashion.png" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Fashion</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="assets/img/product_circle/fashion.png" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Fashion</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Electronics brands categories ends -->

    <!-- New arrival banner starts -->
    <section class="bg-dark section_wrapper"
        style="background:url(https://freshcart.codescandy.com/assets/images/svg-graphics/pattern.svg)no-repeat; background-size: cover; background-position: center;border-radius: 20px;">
        <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="offset-lg-1 col-lg-10">

                    <div class="row align-items-center justify-content-center">
                        <!-- col -->
                        <div class="col-md-6">
                            <div class="text-white mt-8 mt-lg-0">
                                <h3 class="mb-3">Would you like to Buy something Fresh?</h3>

                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Est perferendis quae quo
                                    inventore quaerat nesciunt hic vel, harum rerum repellat similique maxime recusandae
                                    quibusdam nisi pariatur eius ipsa in deleniti!</p><br />

                                <button type="button" class="btn btn-light m-auto" style="padding: 8px 25px;">More
                                    Products</button>

                                <!-- form -->
                            </div>
                        </div>
                        <!-- col -->
                        <div class="col-md-6">
                            <div class="text-center">
                                <!-- img -->
                                <img src="{{ asset('img/girl2.png') }}" alt="" class="img-fluid">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- New arrival banner ends -->

    <!--  Best brands starts -->
    <section class="exclusive_offer section_wrapper mt-8">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="exclusive_offer_heading">
                        <p>Exclusive Offers</p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="">
                        <h3>Best Event Planners</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero molestiae maxime consequuntur
                            voluptatum ipsam quas quos minus et officia doloremque harum illo facere sunt, laudantium
                            soluta hic vitae non tenetur!</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="viewall_btn">
                        <button class="btn btn-default shop_now">View all products <i
                                class="fa-solid fa-arrow-up"></i></button>
                    </div>
                </div>
            </div>
            <div class="row mb-3 gy-2">
                <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="product_card_img">
                            <img src="assets/img/Saloon/event1.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Event Planner 1</h6>
                            </div>

                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">
                                        < 2 km</span>
                                </div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                    <div class="product_card border rounded p-2">
                        <!-- <div class="badge">New</div> -->

                        <div class="product_card_img">
                            <img src="assets/img/Saloon/event2.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Event Planner 2</h6>
                            </div>

                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">
                                        < 2 km</span>
                                </div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                    <div class="product_card border rounded p-2">
                        <!-- <div class="badge">New</div> -->

                        <div class="product_card_img">
                            <img src="assets/img/Saloon/event3.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Event Planner 3</h6>
                            </div>

                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">
                                        < 2 km</span>
                                </div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="product_card_img">
                            <img src="assets/img/Saloon/event4.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Event Planner 4</h6>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">
                                        < 2 km</span>
                                </div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                    <div class="product_card border rounded p-2">
                        <!-- <div class="badge">New</div> -->

                        <div class="product_card_img">
                            <img src="assets/img/Saloon/event5.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Event Planner 5</h6>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">
                                        < 2 km</span>
                                </div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                    <div class="product_card border rounded p-2">
                        <!-- <div class="badge">New</div> -->

                        <div class="product_card_img">
                            <img src="assets/img/Saloon/event1.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Event Planner 1</h6>
                            </div>

                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">
                                        < 2 km</span>
                                </div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="product_card_img">
                            <img src="assets/img/Saloon/event2.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Event Planner 1</h6>
                            </div>

                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">
                                        < 2 km</span>
                                </div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                    <div class="product_card border rounded p-2">
                        <!-- <div class="badge">New</div> -->

                        <div class="product_card_img">
                            <img src="assets/img/Saloon/event3.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Event Planner 2</h6>
                            </div>

                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">
                                        < 2 km</span>
                                </div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                    <div class="product_card border rounded p-2">
                        <!-- <div class="badge">New</div> -->

                        <div class="product_card_img">
                            <img src="assets/img/Saloon/event1.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Event Planner 3</h6>
                            </div>

                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">
                                        < 2 km</span>
                                </div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="product_card_img">
                            <img src="assets/img/Saloon/event5.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Event Planner 4</h6>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">
                                        < 2 km</span>
                                </div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                    <div class="product_card border rounded p-2">
                        <!-- <div class="badge">New</div> -->

                        <div class="product_card_img">
                            <img src="assets/img/Saloon/event4.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Event Planner 5</h6>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">
                                        < 2 km</span>
                                </div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                    <div class="product_card border rounded p-2">
                        <!-- <div class="badge">New</div> -->

                        <div class="product_card_img">
                            <img src="assets/img/Saloon/event3.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Event Planner 1</h6>
                            </div>

                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">
                                        < 2 km</span>
                                </div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </section>
    <!-- Best brands ends -->

    <!-- Bottom banner section starts -->
    <section class="section_wrapper girl_top_section" style="position: relative;margin-top: 22rem;">
        <img src="{{ asset('img/Saloon/banner_top1.png') }}"
            style=" position: absolute;top: -105%; right: 16px;font-size: 18px;z-index: 1;" class="topgirl">

        <div class="container-fluid"
            style="background:url({{ asset('img/banner.png') }})no-repeat; background-size: cover; background-position: center;border-radius: 20px;position: relative;">
            <div class="row">
                <div class="offset-lg-1 col-lg-10" style="margin-top: 4em; margin-bottom: 4em;">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="text-white mt-8 mt-lg-0">
                                <h3 class="mb-3">Would you like to know our best deals?</h3>
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Est perferendis quae
                                    quoinventore quaerat nesciunt hic vel, harum rerum repellat</p><br />
                                <button type="button" class="btn btn-light m-auto" style="padding: 8px 25px;">More
                                    Deals</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- Bottom banner section starts -->

@endsection
