@extends('user.user')
@section('title','Home')
@section('content')


<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="banner_cont pt-5 mt-3">
                    <h1 class=" mb-20">Every purchase will be made with pleasure</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis laboriosam velit
                        doloremque exercitationem nesciunt voluptates provident illo odio accusantium porro eos id
                        et quas numquam beatae consectetur, nam eum obcaecati.</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis laboriosam velit
                            doloremque exercitationem nesciunt voluptates provident illo odio accusantium porro eos id
                            et quas numquam beatae consectetur, nam eum obcaecati.</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis laboriosam velit
                                doloremque exercitationem nesciunt voluptates provident illo odio accusantium porro eos id
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
                                <p class="text-light">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Voluptate officia quis repellendus autem nihil assumenda voluptatibus.</p>
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
                                <p class="text-light">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Voluptate officia quis repellendus autem nihil assumenda voluptatibus.</p>
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
                                <p class="text-light">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Voluptate officia quis repellendus autem nihil assumenda voluptatibus.</p>
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
                <!-- <div id="carouselExampleInterval" class="carousel slide" data-mdb-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-mdb-interval="10000">
                            <img src="assets/img/slider_image.png" class="d-block w-100" alt="Wild Landscape" />
                        </div>
                        <div class="carousel-item" data-mdb-interval="2000">
                            <img src="https://mdbcdn.b-cdn.net/img/new/slides/042.webp" class="d-block w-100"
                                alt="Camera" />
                        </div>
                        <div class="carousel-item">
                            <img src="https://mdbcdn.b-cdn.net/img/new/slides/043.webp" class="d-block w-100"
                                alt="Exotic Fruits" />
                        </div>
                    </div>
                    <button class="carousel-control-prev" data-mdb-target="#carouselExampleInterval" type="button"
                        data-mdb-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" data-mdb-target="#carouselExampleInterval" type="button"
                        data-mdb-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div> -->
            </div>
        </div>
    </div>

</section>
<!-- slider section ends -->

<!-- Product section starts -->
<section class="product py-5 section_wrapper">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-8">
                <div class="">
                    <h3>Product</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero molestiae maxime consequuntur
                        voluptatum ipsam quas quos minus et officia doloremque harum illo facere sunt, laudantium
                        soluta hic vitae non tenetur!</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="float-end">
                    <button class="btn btn-default shop_now">View all products &nbsp;
                        <i class="fa-solid fa-arrow-up"></i></button>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="{{ asset('img/circle1.png') }}">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Fashion</h6>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="{{ asset('img/circle2.png') }}">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Electronics</h6>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="{{ asset('img/circle3.png') }}">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Stationary</h6>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="{{ asset('img/circle4.png') }}">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Sports</h6>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="{{ asset('img/circle5.png') }}">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Medicines</h6>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="{{ asset('img/circle1.png') }}">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Fashion</h6>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="{{ asset('img/circle2.png') }}">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Electronics</h6>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="{{ asset('img/circle3.png') }}">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Stationary</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="{{ asset('img/circle2.png') }}">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Electronics</h6>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="{{ asset('img/circle1.png') }}">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Fashion</h6>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="{{ asset('img/circle4.png') }}">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Sports</h6>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="{{ asset('img/circle3.png') }}">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Stationary</h6>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="{{ asset('img/circle1.png') }}">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Fashion</h6>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="{{ asset('img/circle5.png') }}">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Medicines</h6>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="{{ asset('img/circle1.png') }}">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Fashion</h6>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="{{ asset('img/circle2.png') }}">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Electronics</h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="row">
            <div class="d-flex flex-row bd-highlight mb-3 justify-content-between">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/circle1.png">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Fashion</h6>
                    </div>
                </div>
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/circle2.png">
                    </div>
                </div>
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/circle3.png">
                    </div>
                </div>
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/circle4.png">
                    </div>
                </div>
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/circle5.png">
                    </div>
                </div>
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/circle2.png">
                    </div>
                </div>
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/circle4.png">
                    </div>
                </div>
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/circle3.png">
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</section>
<!-- Product section ends -->

<!-- Services section starts -->
<section class="service py-5 section_wrapper">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-8">
                <div class="">
                    <h3>Services</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero molestiae maxime consequuntur
                        voluptatum ipsam quas quos minus et officia doloremque harum illo facere sunt, laudantium
                        soluta hic vitae non tenetur!</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="float-end">
                    <button class="btn btn-default shop_now">View all Services <i
                            class="fa-solid fa-arrow-up"></i></button>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service1.png">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Events Planner</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service2.png">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Saloon</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service3.png">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Tattoos</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service1.png">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Events Planner</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service4.png">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Vk Tourism</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service2.png">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Saloon</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service3.png">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Tattoos</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service5.png">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Travels</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service3.png">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Tattoos</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service5.png">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Travels</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service2.png">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Saloon</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service4.png">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Vk Tourism</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service1.png">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Events Planner</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service3.png">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Tattoos</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service5.png">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Travels</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service4.png">
                    </div>
                    <div class="product_cont">
                        <h6 class="text-center">Vk Tourism</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services section ends -->

<!-- Shops section starts -->
<section class="shop py-5 section_wrapper">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-8">
                <div class="">
                    <h3>Shops</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero molestiae maxime consequuntur
                        voluptatum ipsam quas quos minus et officia doloremque harum illo facere sunt, laudantium
                        soluta hic vitae non tenetur!</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="float-end">
                    <button class="btn btn-default shop_now">View all Shops <i
                            class="fa-solid fa-arrow-up"></i></button>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service1.png">
                    </div>
                    <div class="shop_cont">
                        <h6 class="text-center">Events Planner</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service2.png">
                    </div>
                    <div class="shop_cont">
                        <h6 class="text-center">Saloon</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service3.png">
                    </div>
                    <div class="shop_cont">
                        <h6 class="text-center">Tattoos</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service1.png">
                    </div>
                    <div class="shop_cont">
                        <h6 class="text-center">Events Planner</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service4.png">
                    </div>
                    <div class="shop_cont">
                        <h6 class="text-center">Vk Tourism</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service2.png">
                    </div>
                    <div class="shop_cont">
                        <h6 class="text-center">Saloon</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service3.png">
                    </div>
                    <div class="shop_cont">
                        <h6 class="text-center">Tattoos</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service5.png">
                    </div>
                    <div class="shop_cont">
                        <h6 class="text-center">Travels</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service3.png">
                    </div>
                    <div class="shop_cont">
                        <h6 class="text-center">Tattoos</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service5.png">
                    </div>
                    <div class="shop_cont">
                        <h6 class="text-center">Travels</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service2.png">
                    </div>
                    <div class="shop_cont">
                        <h6 class="text-center">Saloon</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service4.png">
                    </div>
                    <div class="shop_cont">
                        <h6 class="text-center">Vk Tourism</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service1.png">
                    </div>
                    <div class="shop_cont">
                        <h6 class="text-center">Events Planner</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service3.png">
                    </div>
                    <div class="shop_cont">
                        <h6 class="text-center">Tattoos</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service5.png">
                    </div>
                    <div class="shop_cont">
                        <h6 class="text-center">Travels</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 bd-highlight border rounded">
                    <div class="circle_img">
                        <img src="assets/img/service4.png">
                    </div>
                    <div class="shop_cont">
                        <h6 class="text-center">Vk Tourism</h6>
                        <p class="text-center">Pattom, Trivandrum</p>
                    </div>
                </div>
            </div>
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
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero molestiae maxime consequuntur
                        voluptatum ipsam quas quos minus et officia doloremque harum illo facere sunt, laudantium
                        soluta hic vitae non tenetur!</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="float-end">
                    <button class="btn btn-default shop_now">View all products <i
                            class="fa-solid fa-arrow-up"></i></button>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-2 col-md-3 col-sm-3 col-6">
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
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
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
            <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                <div class="product_card border rounded p-2">
                    <!-- <div class="badge">New</div> -->
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
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                        </div>
                        <div class="product_card-footer">
                            <div class="wcf-left"><span class="price">&#8377; 500.000</span></div>
                            <div class="wcf-right">
                                <a href="#" class="buy-btn">
                                    <i class="fa fa-bag-shopping shop_bag"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                <div class="product_card border rounded p-2">
                    <!-- <div class="badge">New</div> -->
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
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
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
            <div class="col-lg-2 col-md-3 col-sm-3 col-6">
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
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
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
            <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                <div class="product_card border rounded p-2">
                    <!-- <div class="badge">New</div> -->
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
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
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
            <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                <div class="product_card border rounded p-2">
                    <!-- <div class="badge">New</div> -->
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
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
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
        <div class="row mb-3">
            <div class="col-lg-2 col-md-3 col-sm-3 col-6">
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
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
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
            <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                <div class="product_card border rounded p-2">
                    <!-- <div class="badge">New</div> -->
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
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
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
            <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                <div class="product_card border rounded p-2">
                    <!-- <div class="badge">New</div> -->
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
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
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
            <div class="col-lg-2 col-md-3 col-sm-3 col-6">
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
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
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
            <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                <div class="product_card border rounded p-2">
                    <!-- <div class="badge">New</div> -->
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
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
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
            <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                <div class="product_card border rounded p-2">
                    <!-- <div class="badge">New</div> -->
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
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
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
                        commodi iusto eos, cupiditate nemo suscipit dolor amet praesentium. Modi aliquam odio animi
                        placeat earum a omnis.</p>
                </div>
                <div class="col-md-6">
                    <div class="Bottom_banner_btn">
                        <button type="button" class="btn btn-light m-auto">Explore Services <i
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
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero molestiae maxime consequuntur
                        voluptatum ipsam quas quos minus et officia doloremque harum illo facere sunt, laudantium
                        soluta hic vitae non tenetur!</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="float-end">
                    <button class="btn btn-default shop_now">View all products <i
                            class="fa-solid fa-arrow-up"></i></button>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-2 col-md-2 col-sm-3 col-6">
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
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
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
            <div class="col-lg-2 col-md-2 col-sm-3 col-6">
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
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
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
            <div class="col-lg-2 col-md-2 col-sm-3 col-6">
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
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
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
            <div class="col-lg-2 col-md-2 col-sm-3 col-6">
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
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
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
            <div class="col-lg-2 col-md-2 col-sm-3 col-6">
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
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
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
            <div class="col-lg-2 col-md-2 col-sm-3 col-6">
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
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
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
        <div class="row mb-3">
            <div class="col-lg-2 col-md-2 col-sm-3 col-6">
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
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
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
            <div class="col-lg-2 col-md-2 col-sm-3 col-6">
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
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
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
            <div class="col-lg-2 col-md-2 col-sm-3 col-6">
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
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
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
            <div class="col-lg-2 col-md-2 col-sm-3 col-6">
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
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
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
            <div class="col-lg-2 col-md-2 col-sm-3 col-6">
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
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
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
            <div class="col-lg-2 col-md-2 col-sm-3 col-6">
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
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
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
