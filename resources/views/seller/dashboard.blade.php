@extends('backendlayout')
@section('content')
    @include('menu')
    @include('topnav')
    <!-- Page Content-->
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="row">
                            <div class="col">
                                <h4 class="page-title">Shop Details</h4>
                            </div>
                            <div class="col-auto align-self-center">
                                <a href="edit_shop_detail.html"><button type="button" class="btn add_btn ">Edit Shop details</button></a>
                              </div>

                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div> <!--end row-->

            <form>
            <div class="row">



                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Name</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1"  value="Peethamparan" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Phone Number</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" value="+91 85969 85967" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Email Address</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" value="vk@gmail.com" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Shop Address </label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" value="XYZ Shop, Kazhakkuttam,Trivandrum,Kerala,India,691001." readonly>
                                </div>
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class=""></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="2" class=""></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active carousel-item-left">
                                            <img src="../assets/images/shop/shop1.jpeg" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item carousel-item-next carousel-item-left">
                                            <img src="../assets/images/shop/shop2.jpg" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../assets/images/shop/shop3.jpg" class="d-block w-100" alt="...">
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                        </div><!--end card-body-->
                    </div><!--end card-->

                </div> <!--end col-->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Google Map</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value="https://goo.gl/maps/pAoQxSPeZUxG1suQ8" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Social Media</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <button type="button" class="btn btn-primary" style="margin-right: 15px;"><i class="fab fa-facebook-f"></i></button>
                                    <button type="button" class="btn btn-info"><i class="fab fa-instagram"></i></button>
                                    </span>


                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlInput1">Shop Details </label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value="LICENSE - A2/339/5955, GST - 32DOEPS7021P1SM, PAN - DOEPS7021P1, Est. On - 08/10/2009." readonly>
                            </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Open - Close Time</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" value="10 AM to 10 PM" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Registration Date </label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" value="21-07-2023" readonly>
                                </div>


                        </div><!--end card-body-->
                    </div><!--end card-->

                </div>  <!--end col-->

            </div><!--end row-->

        </form>

            <!-- end page title end breadcrumb -->

     </div><!-- container -->
@endsection
