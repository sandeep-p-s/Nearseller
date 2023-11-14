@extends('user.user')
@section('title', 'Home')
@section('content')

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="banner_cont pt-5 mt-3">
                        <h1 class=" mb-20">Every purchase will be made with pleasure</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis laboriosam velit
                            doloremque exercitationem nesciunt voluptates provident illo odio accusantium porro eos
                            id
                            et quas numquam beatae consectetur, nam eum obcaecati.</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis laboriosam velit
                            doloremque exercitationem nesciunt voluptates provident illo odio accusantium porro eos
                            id
                            et quas numquam beatae consectetur, nam eum obcaecati.</p>

                        <button class="btn btn-default shop_now">Shop Now <i class="fa-solid fa-arrow-up"></i></button>
                    </div>
                </div>
                <div class="col-md-6 px-0">
                    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="10000">
                                <img src="{{ asset('img/slider_image.png') }}" class="d-block w-100" alt="slider1">
                                <div class="carousel-caption">
                                    <h4>New Arrival</h4>
                                    <h6>30% off</h6>
                                    <p class="text-light carousel_text">Lorem ipsum dolor sit amet consectetur
                                        adipisicing elit. Vero molestiae maxime consequuntur
                                        voluptatum ipsam quas quos minus et officia doloremque harum illo facere
                                        sunt.</p>
                                    <div class="banner_btn">
                                        <button type="button" class="btn btn-light my-2 px-5">Shop Now &nbsp;
                                            <i class="fa-solid fa-arrow-up"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item" data-bs-interval="2000">
                                <img src="{{ asset('img/slider_image.png') }}" class="d-block w-100" alt="slider2">
                                <div class="carousel-caption">
                                    <h4>New Arrival</h4>
                                    <h6>30% off</h6>
                                    <p class="text-light carousel_text">Lorem ipsum dolor sit amet consectetur
                                        adipisicing elit. Vero molestiae maxime consequuntur
                                        voluptatum ipsam quas quos minus et officia doloremque harum illo facere
                                        sunt.</p>
                                    <div class="banner_btn">
                                        <button type="button" class="btn btn-light my-2 px-5">Shop Now &nbsp;
                                            <i class="fa-solid fa-arrow-up"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('img/slider_image.png') }}" class="d-block w-100" alt="slider3">
                                <div class="carousel-caption">
                                    <h4>New Arrival</h4>
                                    <h6>30% off</h6>
                                    <p class="text-light carousel_text">Lorem ipsum dolor sit amet consectetur
                                        adipisicing elit. Vero molestiae maxime consequuntur
                                        voluptatum ipsam quas quos minus et officia doloremque harum illo facere
                                        sunt.</p>
                                    <div class="banner_btn">
                                        <button type="button" class="btn btn-light my-2 px-5">Shop Now &nbsp;
                                            <i class="fa-solid fa-arrow-up"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel_Next_Prev">
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                                data-bs-slide="prev">
                                <i class="fa fa-arrow-left"></i>
                                <!-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> -->
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                                data-bs-slide="next">
                                <i class="fa fa-arrow-right"></i>
                                <!-- <span class="carousel-control-next-icon" aria-hidden="true"></span> -->
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>

    <section class="product py-3 section_wrapper">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-8">
                    <div class="">
                        <h3>Product</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero molestiae maxime
                            consequuntur
                            voluptatum ipsam quas quos minus et officia doloremque harum illo facere sunt,
                            laudantium
                            soluta hic vitae non tenetur!</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="viewall_btn">
                        <button class="btn btn-default shop_now">View all products &nbsp;
                            <i class="fa-solid fa-arrow-up"></i></button>
                    </div>
                </div>
            </div>

            <div class="row mb-3 row-cols-12 row-cols-lg-12 g-2">
                @foreach ($product as $pr)
                    @php
                        $product_images = $pr->product_images;
                        $product_imagesarray = json_decode($product_images);
                        $fileval = $product_imagesarray->fileval;
                        $product_imagesval = json_decode(json_encode($fileval), true);
                        $totadarimg = count($product_imagesval);

                        $product_images = $pr->product_images;
                        $product_imagesarray = json_decode($product_images);
                        $gallery = $product_imagesarray->fileval;
                        if (!empty($gallery)) {
                            $firstImage = $gallery[0];
                        } else {
                            $firstImage = '';
                        }
                    @endphp
                    <div class="col-lg-1 col-md-3 col-sm-3 col-6">
                        <div class="card">
                            <a href="">
                                <img src="{{ asset($firstImage) }}" class="card-img-top" alt="...">

                                <div class="product_cont">
                                    <h6 class="text-center">{{ $pr->product_name }}</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>



        </div>
    </section>
    <!-- Product section ends -->

    <!-- Services section starts -->
    <section class="service py-3 section_wrapper">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-8">
                    <div class="">
                        <h3>Services</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero molestiae maxime
                            consequuntur
                            voluptatum ipsam quas quos minus et officia doloremque harum illo facere sunt,
                            laudantium
                            soluta hic vitae non tenetur!</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="viewall_btn">
                        <button class="btn btn-default shop_now">View all Services <i
                                class="fa-solid fa-arrow-up"></i></button>
                    </div>
                </div>
            </div>

            <div class="row mb-3 row-cols-12 row-cols-lg-12 g-2">
                @foreach ($services as $sr)
                    <div class="col-lg-1 col-md-3 col-sm-3 col-6">
                        <div class="card">
                            <a href="">
                                <img src="{{ asset('uploads/service_images/' . $sr->service_images) }}" class="card-img-top"
                                    alt="...">
                                <div class="product_cont">
                                    <h6 class="text-center">{{ $sr->service_name }}</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Services section ends -->

    <!-- Shops section starts -->
    <section class="shop py-3 section_wrapper">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-8">
                    <div class="">
                        <h3>Shops</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero molestiae maxime
                            consequuntur
                            voluptatum ipsam quas quos minus et officia doloremque harum illo facere sunt,
                            laudantium
                            soluta hic vitae non tenetur!</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="viewall_btn">
                        <button class="btn btn-default shop_now">View all Shops <i
                                class="fa-solid fa-arrow-up"></i></button>
                    </div>
                </div>
            </div>

            <div class="row mb-3 row-cols-12 row-cols-lg-12 g-2">
                @foreach ($shops as $sh)
                    @php
                        $shop_photo = $sh->shop_photo;
                        $shop_photoarray = json_decode($shop_photo);
                        $fileval = $shop_photoarray->fileval;
                        $shop_photoval = json_decode(json_encode($fileval), true);
                        $totadarimg = count($shop_photoval);

                        $shop_photo = $sh->shop_photo;
                        $shop_photoarray = json_decode($shop_photo);
                        $gallery = $shop_photoarray->fileval;
                        if (!empty($gallery)) {
                            $shopImage = $gallery[0];
                        } else {
                            $shopImage = '';
                        }
                    @endphp
                    <div class="col-lg-1 col-md-3 col-sm-3 col-6">
                        <div class="card">
                            <a href="">
                                <img src="{{ asset($shopImage) }}" class="card-img-top" alt="...">
                                <div class="product_cont">
                                    <h6 class="text-center">{{ $sh->shop_name }}</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                    {{-- <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="{{ asset('img/product_circle/veg.png') }}" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Grocery</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="{{ asset('img/product_circle/elec.png') }}" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Electronics</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="{{ asset('img/product_circle/medi.png') }}" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Medicines</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="{{ asset('img/product_circle/book.png') }}" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Stationary</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="{{ asset('img/product_circle/elec.png') }}" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Electronics</h6>
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
                        <img src="{{ asset('img/product_circle/medi.png') }}" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Medicines</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="{{ asset('img/product_circle/elec.png') }}" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Electronics</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3  col-6">
                    <div class="card">
                        <img src="{{ asset('img/product_circle/veg.png') }}" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Grocery</h6>
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
                        <img src="{{ asset('img/product_circle/book.png') }}" class="card-img-top" alt="...">
                        <div class="product_cont">
                            <h6 class="text-center">Stationary</h6>
                        </div>
                    </div>
                </div> --}}
                @endforeach
            </div>
        </div>
    </section>
    <!-- Shops section ends -->

    <!-- exclusive offer best deals starts -->
    <section class="exclusive_offer section_wrapper">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="exclusive_offer_heading">
                        <p>Exclusive Offers</p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="">
                        <h3>Best Deals. Best Deal of the month</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero molestiae maxime
                            consequuntur
                            voluptatum ipsam quas quos minus et officia doloremque harum illo facere sunt,
                            laudantium
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
            <div class="row mb-3 gy-3">
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="badge">New</div>
                        <div class="cart_badge"><i class="fa-regular fa-heart"></i></div>
                        <div class="product_card_img">
                            <img src="{{ asset('img/product1.png') }}">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Ladies Kurthis</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">&#8377; 500.000</span></div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa fa-bag-shopping shop_bag"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="badge">New</div>
                        <div class="cart_badge"><i class="fa-regular fa-heart"></i></div>
                        <div class="product_card_img">
                            <img src="{{ asset('img/product2.png') }}">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Nike Shoes</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">&#8377; 500.000</span></div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa fa-bag-shopping shop_bag"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="badge">New</div>
                        <div class="cart_badge"><i class="fa-regular fa-heart"></i></div>
                        <div class="product_card_img">
                            <img src="{{ asset('img/product3.png') }}">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Rayben Glasses</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">&#8377; 500.000</span></div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa fa-bag-shopping shop_bag"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="badge">New</div>
                        <div class="cart_badge"><i class="fa-regular fa-heart"></i></div>
                        <div class="product_card_img">
                            <img src="{{ asset('img/product4.png') }}">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Smart Watch</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">&#8377; 500.000</span></div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa fa-bag-shopping shop_bag"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="badge">New</div>
                        <div class="cart_badge"><i class="fa-regular fa-heart"></i></div>
                        <div class="product_card_img">
                            <img src="{{ asset('img/product5.png') }}">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Bags</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">&#8377; 500.000</span></div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa fa-bag-shopping shop_bag"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="badge">New</div>
                        <div class="cart_badge"><i class="fa-regular fa-heart"></i></div>
                        <div class="product_card_img">
                            <img src="{{ asset('img/product1.png') }}">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Ladies Kurthis</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">&#8377; 500.000</span></div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa fa-bag-shopping shop_bag"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="badge">New</div>
                        <div class="cart_badge"><i class="fa-regular fa-heart"></i></div>
                        <div class="product_card_img">
                            <img src="assets/img/product2.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Nike Shoes</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">&#8377; 500.000</span></div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa fa-bag-shopping shop_bag"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="badge">New</div>
                        <div class="cart_badge"><i class="fa-regular fa-heart"></i></div>
                        <div class="product_card_img">
                            <img src="assets/img/product1.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Ladies Kurthis</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">&#8377; 500.000</span></div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa fa-bag-shopping shop_bag"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="badge">New</div>
                        <div class="cart_badge"><i class="fa-regular fa-heart"></i></div>
                        <div class="product_card_img">
                            <img src="assets/img/product2.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Nike Shoes</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">&#8377; 500.000</span></div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa fa-bag-shopping shop_bag"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="badge">New</div>
                        <div class="cart_badge"><i class="fa-regular fa-heart"></i></div>
                        <div class="product_card_img">
                            <img src="assets/img/product3.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Rayben Glasses</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">&#8377; 500.000</span></div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa fa-bag-shopping shop_bag"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="badge">New</div>
                        <div class="cart_badge"><i class="fa-regular fa-heart"></i></div>
                        <div class="product_card_img">
                            <img src="assets/img/product4.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Smart Watch</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">&#8377; 500.000</span></div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa fa-bag-shopping shop_bag"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="badge">New</div>
                        <div class="cart_badge"><i class="fa-regular fa-heart"></i></div>
                        <div class="product_card_img">
                            <img src="assets/img/product5.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Bags</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">&#8377; 500.000</span></div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa fa-bag-shopping shop_bag"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
    <!-- exclusive offer best deals ends -->

    <!-- Bottom banner section starts -->
    <section class="bottom_banner_section py-5 section_wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="banner_img">
                    <img src="{{ asset('img/barber.png') }}">
                </div>
            </div>
            <div class="Bottom_banner ">
                <div class="row">

                    <div class="col-md-6">
                        <h2 class="text-white mb-4">Would you like any services?</h2>
                        <p class="text-white">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Rerum dicta
                            ipsam aperiam esse,
                            commodi iusto eos, cupiditate nemo suscipit dolor amet praesentium. Modi aliquam odio
                            animi
                            placeat earum a omnis.</p>
                    </div>
                    <div class="col-md-6">
                        <div class="Bottom_banner_btn viewall_btn">
                            <button type="button" class="btn btn-light m-auto ">Explore Services <i
                                    class="fa-solid fa-arrow-up"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bottom banner section starts -->

    <!-- Offer best deals starts -->
    <section class="exclusive_offer section_wrapper">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="exclusive_offer_heading">
                        <p>Exclusive Offers</p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="">
                        <h3>Best Deals. Best Deal of the month</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero molestiae maxime
                            consequuntur
                            voluptatum ipsam quas quos minus et officia doloremque harum illo facere sunt,
                            laudantium
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
            <div class="row mb-3 gy-3">
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="badge">New</div>
                        <div class="cart_badge"><i class="fa-regular fa-heart"></i></div>
                        <div class="product_card_img">
                            <img src="assets/img/product1.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Ladies Kurthis</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">&#8377; 500.000</span></div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa fa-bag-shopping shop_bag"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="badge">New</div>
                        <div class="cart_badge"><i class="fa-regular fa-heart"></i></div>
                        <div class="product_card_img">
                            <img src="assets/img/product2.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Nike Shoes</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">&#8377; 500.000</span></div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa fa-bag-shopping shop_bag"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="badge">New</div>
                        <div class="cart_badge"><i class="fa-regular fa-heart"></i></div>
                        <div class="product_card_img">
                            <img src="assets/img/product3.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Rayben Glasses</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">&#8377; 500.000</span></div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa fa-bag-shopping shop_bag"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="badge">New</div>
                        <div class="cart_badge"><i class="fa-regular fa-heart"></i></div>
                        <div class="product_card_img">
                            <img src="assets/img/product4.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Smart Watch</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">&#8377; 500.000</span></div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa fa-bag-shopping shop_bag"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="badge">New</div>
                        <div class="cart_badge"><i class="fa-regular fa-heart"></i></div>
                        <div class="product_card_img">
                            <img src="assets/img/product5.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Bags</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">&#8377; 500.000</span></div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa fa-bag-shopping shop_bag"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="badge">New</div>
                        <div class="cart_badge"><i class="fa-regular fa-heart"></i></div>
                        <div class="product_card_img">
                            <img src="assets/img/product1.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Ladies Kurthis</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">&#8377; 500.000</span></div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa fa-bag-shopping shop_bag"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="badge">New</div>
                        <div class="cart_badge"><i class="fa-regular fa-heart"></i></div>
                        <div class="product_card_img">
                            <img src="assets/img/product2.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Nike Shoes</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">&#8377; 500.000</span></div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa fa-bag-shopping shop_bag"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="badge">New</div>
                        <div class="cart_badge"><i class="fa-regular fa-heart"></i></div>
                        <div class="product_card_img">
                            <img src="assets/img/product1.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Ladies Kurthis</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">&#8377; 500.000</span></div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa fa-bag-shopping shop_bag"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="badge">New</div>
                        <div class="cart_badge"><i class="fa-regular fa-heart"></i></div>
                        <div class="product_card_img">
                            <img src="assets/img/product2.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Nike Shoes</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">&#8377; 500.000</span></div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa fa-bag-shopping shop_bag"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="badge">New</div>
                        <div class="cart_badge"><i class="fa-regular fa-heart"></i></div>
                        <div class="product_card_img">
                            <img src="assets/img/product3.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Rayben Glasses</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">&#8377; 500.000</span></div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa fa-bag-shopping shop_bag"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="badge">New</div>
                        <div class="cart_badge"><i class="fa-regular fa-heart"></i></div>
                        <div class="product_card_img">
                            <img src="assets/img/product4.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Smart Watch</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">&#8377; 500.000</span></div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa fa-bag-shopping shop_bag"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="product_card border rounded p-2">
                        <div class="badge">New</div>
                        <div class="cart_badge"><i class="fa-regular fa-heart"></i></div>
                        <div class="product_card_img">
                            <img src="assets/img/product5.png">
                        </div>
                        <div class="product_details p-2">
                            <div class="product_name">
                                <h6>Bags</h6>
                            </div>
                            <div class="product_offer">
                                <p>50% off</p>
                            </div>
                            <div class="pro_detail">
                                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </p>
                            </div>
                            <div class="product_card-footer">
                                <div class="wcf-left"><span class="price">&#8377; 500.000</span></div>
                                <div class="wcf-right">
                                    <a href="#" class="buy-btn">
                                        <i class="fa fa-bag-shopping shop_bag"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Offer best deals ends-->
@endsection
