@extends('backendlayout')
@section('content')
    @include('menu')
    @include('topnav')








<div class="page-content" >
        @php
        $roleid=session('roleid');
        $roleIdsArray = explode(',', $roleid);
       @endphp
        @if (in_array('1', $roleIdsArray))
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="row">
                            <div class="col">
                                <h4 class="page-title">Admin Panel</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Nearsellers</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                            <div class="col-auto align-self-center">
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6 col-lg-3">
                  <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-1 font-weight-semibold">Users</p>
                                <h3 class="my-2">{{ $countUsers }}</h3>
                                <a href="#" class="badge p-2 badge badge-info" >View All</a>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="report-main-icon bg-light-alt">
                                  <i class="fa-solid fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-md-6 col-lg-3">
                  <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-1 font-weight-semibold">Affiliates</p>
                                <h3 class="my-2">{{$countAffiliate}}</h3>
                                <a href="#" class="badge p-2 badge badge-info" >View All</a>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="report-main-icon bg-light-alt">
                                  <i class="fa-solid fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card report-card">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col">
                                  <p class="text-dark mb-1 font-weight-semibold">Total Shops</p>
                                  <h3 class="my-2">{{$countShops}}</h3>
                                  <a href="{{ route('admin.shopapprovals',1) }}" class="badge p-2 badge badge-info" >View All</a>
                                </div>
                                <div class="col-auto align-self-center">
                                  <div class="report-main-icon bg-light-alt">
                                    <i class="fa-solid fa-shop"></i>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card report-card">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col">
                                  <p class="text-dark mb-1 font-weight-semibold">Inactive Shops</p>
                                  <h3 class="my-2">{{$countInactiveShops}}</h3>
                                  <a href="{{ route('admin.shopapprovalsinactive',1) }}" class="badge p-2 badge badge-info" >View All</a>
                                </div>
                                <div class="col-auto align-self-center">
                                  <div class="report-main-icon bg-light-alt">
                                    <i class="fa-solid fa-shop"></i>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-md-6 col-lg-3">
                    <div class="card report-card">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col">
                                  <p class="text-dark mb-1 font-weight-semibold">Total Services</p>
                                  <h3 class="my-2">{{$countservices}}</h3>
                                  <a href="{{ route('admin.shopapprovals',2) }}" class="badge p-2 badge badge-info" >View All</a>
                                </div>
                                <div class="col-auto align-self-center">
                                  <div class="report-main-icon bg-light-alt">
                                    <i class="fa-solid fa-shop"></i>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card report-card">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col">
                                  <p class="text-dark mb-1 font-weight-semibold">Inactive Services</p>
                                  <h3 class="my-2">{{$countInactiveservices}}</h3>
                                  <a href="{{ route('admin.shopapprovalsinactive',2) }}" class="badge p-2 badge badge-info" >View All</a>
                                </div>
                                <div class="col-auto align-self-center">
                                  <div class="report-main-icon bg-light-alt">
                                    <i class="fa-solid fa-shop"></i>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-md-6 col-lg-3">
                  <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-1 font-weight-semibold">Wallets</p>
                                <h3 class="my-2">0</h3>
                                <a href="#" class="badge p-2 badge badge-info" >View All</a>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="report-main-icon bg-light-alt">
                                  <i class="fa-solid fa-wallet"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        @endif

        @if (in_array('2', $roleIdsArray))
        <div class="container-fluid">
            {{-- <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="row">
                            <div class="col">
                                <h4 class="page-title">Sellers Panel</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Nearsellers</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                            <div class="col-auto align-self-center">
                            </div>

                        </div>
                    </div>
                </div>
            </div> --}}


            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="card report-card">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col">
                                  <p class="text-dark mb-1 font-weight-semibold">Shops Products</p>
                                  <h3 class="my-2">{{$countproductuser}}</h3>

                                </div>
                                <div class="col-auto align-self-center">
                                  <div class="report-main-icon bg-light-alt">
                                    <i class="fa-solid fa-shop"></i>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                  <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-1 font-weight-semibold">Shops Wallets</p>
                                <h3 class="my-2">0</h3>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="report-main-icon bg-light-alt">
                                  <i class="fa-solid fa-wallet"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        @endif


        @if (in_array('9', $roleIdsArray))
        <div class="container-fluid">
            {{-- <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="row">
                            <div class="col">
                                <h4 class="page-title">Service Panel</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Nearsellers</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                            <div class="col-auto align-self-center">
                            </div>

                        </div>
                    </div>
                </div>
            </div> --}}


            <div class="row">


                <div class="col-md-6 col-lg-3">
                    <div class="card report-card">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col">
                                  <p class="text-dark mb-1 font-weight-semibold">Services Product</p>
                                  <h3 class="my-2">{{$countserviceuser}}</h3>

                                </div>
                                <div class="col-auto align-self-center">
                                  <div class="report-main-icon bg-light-alt">
                                    <i class="fa-solid fa-shop"></i>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                  <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-1 font-weight-semibold">Service Wallets</p>
                                <h3 class="my-2">0</h3>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="report-main-icon bg-light-alt">
                                  <i class="fa-solid fa-wallet"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        @endif


        @if (in_array('3', $roleIdsArray))
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="row">
                            <div class="col">
                                <h4 class="page-title">Admin Panel</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Nearseller</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                            <div class="col-auto align-self-center">
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6 col-lg-3">
                  <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-1 font-weight-semibold">Users</p>
                                <h3 class="my-2">{{ $countUsers }}</h3>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="report-main-icon bg-light-alt">
                                  <i class="fa-solid fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-md-6 col-lg-3">
                  <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-1 font-weight-semibold">Affiliates</p>
                                <h3 class="my-2">{{$countAffiliate}}</h3>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="report-main-icon bg-light-alt">
                                  <i class="fa-solid fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card report-card">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col">
                                  <p class="text-dark mb-1 font-weight-semibold">Shops</p>
                                  <h3 class="my-2">{{$countShops}}</h3>

                                </div>
                                <div class="col-auto align-self-center">
                                  <div class="report-main-icon bg-light-alt">
                                    <i class="fa-solid fa-shop"></i>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                  <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-1 font-weight-semibold">Wallets</p>
                                <h3 class="my-2">0</h3>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="report-main-icon bg-light-alt">
                                  <i class="fa-solid fa-wallet"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        @endif
    @endsection
