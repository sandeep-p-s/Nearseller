@extends('backendlayout')
@section('content')
    @include('menu')
    @include('topnav')


    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="row">
                            <div class="col">
                                <h4 class="page-title">Affiliate Panel</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Nearseller</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div><!--end col-->
                            <div class="col-auto align-self-center">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-3">
                  <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-1 font-weight-semibold">Affiliates</p>
                                <h3 class="my-2">{{$countAffiliate}}</h3>
                                {{-- <p class="mb-0 text-truncate text-muted"><span class="text-success"><i class="mdi mdi-trending-up"></i>8.5%</span> New Sessions Today</p> --}}
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
                                  {{-- <p class="mb-0 text-truncate text-muted"><span class="text-success"><i class="mdi mdi-trending-up"></i>8.5%</span> New Sessions Today</p> --}}
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
                                {{-- <p class="mb-0 text-truncate text-muted"><span class="text-success"><i class="mdi mdi-trending-up"></i>8.5%</span> New Sessions Today</p> --}}
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









            <div class="row" style="display: none;">
                <div class="col-12">
                    <div class="card">
                        <div class="row">
                            <div class="col-lg-6">
                            tytrytr
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    @endsection
