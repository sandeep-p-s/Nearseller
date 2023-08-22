@extends('backendlayout')
@section('content')
    <div class="menu-content h-100" data-simplebar>
        <ul class="metismenu left-sidenav-menu">

            <li class="">
                <a href="javascript: void(0);" aria-expanded="false"><span>Approvals</span><span class="menu-arrow"><i
                            class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level mm-collapse" aria-expanded="false" style="height: 0px;">
                    <li class="nav-item"><a class="nav-link" href="index.html"><i class="ti-control-record"></i>Shop
                            Approvals</a></li>
                    <li class="nav-item"><a class="nav-link" href="affiliates_approval_table.html"><i
                                class="ti-control-record"></i>Affiliates Approvals</a></li>
                    <li class="nav-item"><a class="nav-link" href="products_approval_table.html"><i
                                class="ti-control-record"></i>Product Approvals</a></li>
                    <li class="nav-item"><a class="nav-link" href="category_approval.html"><i
                                class="ti-control-record"></i>Category Approvals</a></li>
                    <li class="nav-item"><a class="nav-link" href="service_approval_table.html"><i
                                class="ti-control-record"></i>Service Approvals</a></li>
                </ul>
            </li>
            <hr class="hr-dashed hr-menu">
            <li class="">
                <a href="javascript: void(0);" aria-expanded="false"><span>Edits</span><span class="menu-arrow"><i
                            class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level mm-collapse" aria-expanded="false" style="height: 0px;">
                    <li class="nav-item"><a class="nav-link" href="shop_edit_table.html"><i
                                class="ti-control-record"></i>Shop Edits</a></li>
                    <li class="nav-item"><a class="nav-link" href="affiliates_edit_table.html"><i
                                class="ti-control-record"></i>Affiliates Edits</a></li>
                </ul>
            </li>
            <hr class="hr-dashed hr-menu">
            <li class="">
                <a href="javascript: void(0);" aria-expanded="false"><span>Types</span><span class="menu-arrow"><i
                            class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level mm-collapse" aria-expanded="false" style="height: 0px;">
                    <li class="nav-item"><a class="nav-link" href="#"><i class="ti-control-record"></i>Business
                            Type</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('list.shoptype') }}"><i
                                class="ti-control-record"></i>Shop Type</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('list.servicetype') }}"><i
                                class="ti-control-record"></i>Service Type</a></li>
                </ul>
            </li>
            <hr class="hr-dashed hr-menu">
            <li class="">
                <a href="javascript: void(0);" aria-expanded="false"><span>Status</span><span class="menu-arrow"><i
                            class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level mm-collapse" aria-expanded="false" style="height: 0px;">
                    <li class="nav-item"><a class="nav-link" href="shop_approval_status_table.html"><i
                                class="ti-control-record"></i>Shop Approval Status</a></li>
                    <li class="nav-item"><a class="nav-link" href="shop_edit_status_table.html"><i
                                class="ti-control-record"></i>Shop Edit Status</a></li>
                    <li class="nav-item"><a class="nav-link" href="executive_status_table.html"><i
                                class="ti-control-record"></i>Executive Status</a></li>
                    <li class="nav-item"><a class="nav-link" href="category_status_table.html"><i
                                class="ti-control-record"></i>Category Status</a></li>
                    <li class="nav-item"><a class="nav-link" href="order_type_table.html"><i
                                class="ti-control-record"></i>Order Status</a></li>
                    <li class="nav-item"><a class="nav-link" href="order_status_user.html"><i
                                class="ti-control-record"></i>Order Status User</a></li>
                    <li class="nav-item"><a class="nav-link" href="offer_type_table.html"><i
                                class="ti-control-record"></i>Offer Status</a></li>
                    <li class="nav-item"><a class="nav-link" href="offer_type_status_table.html"><i
                                class="ti-control-record"></i>Offer Type Status</a></li>
                </ul>
            </li>
            <hr class="hr-dashed hr-menu">
            <li><a href="executive_type_table.html"> <i data-feather="hhh"
                        class="align-self-center menu-icon"></i><span>Executives</span><span
                        class="menu-arrow"></span></a> </li>
            <hr class="hr-dashed hr-menu">
            <li><a href="order_placement.html"> <i data-feather="hhh" class="align-self-center menu-icon"></i><span>Order
                        Placement</span><span class="menu-arrow"></span></a> </li>
            <hr class="hr-dashed hr-menu">
        </ul>

    </div>
    </div>
    <!-- end left-sidenav-->


    <div class="page-wrapper">
        <!-- Top Bar Start -->
        <div class="topbar">
            <!-- Navbar -->
            <nav class="navbar-custom">
                <ul class="list-unstyled topbar-nav float-right mb-0">


                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="ml-1 nav-user-name hidden-sm">Nick</span>
                            <img src="{{ asset('backend/assets/images/users/profile.png') }}" alt="profile-user"
                                class="rounded-circle" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i data-feather="user"
                                    class="align-self-center icon-xs icon-dual mr-1"></i> Profile</a>
                            <a class="dropdown-item" href="#"><i data-feather="settings"
                                    class="align-self-center icon-xs icon-dual mr-1"></i> Settings</a>
                            <div class="dropdown-divider mb-0"></div>
                            <a class="dropdown-item" href="#"><i data-feather="power"
                                    class="align-self-center icon-xs icon-dual mr-1"></i> Logout</a>
                        </div>
                    </li>
                </ul><!--end topbar-nav-->

                <ul class="list-unstyled topbar-nav mb-0">
                    <li>
                        <button class="nav-link button-menu-mobile">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-menu align-self-center topbar-icon">
                                <line x1="3" y1="12" x2="21" y2="12"></line>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <line x1="3" y1="18" x2="21" y2="18"></line>
                            </svg>
                        </button>
                    </li>
                    <li class="creat-btn">
                        <div class="nav-link">
                            <a class=" btn btn-sm btn-soft-primary" href="#" role="button">Welcome Admin</a>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- end navbar-->
        </div>
        <!-- Top Bar End -->

        <!-- Page Content-->
        <div class="page-content">
            <div class="container-fluid">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="row">
                                <div class="col">
                                    <h4 class="page-title">Business Type</h4>

                                </div>
                                <div class="col-auto align-self-center">
                                    <a href="{{ route('add.businesstype') }}"><button type="button"
                                            class="btn add_btn ">Add Business Type </button></a>
                                </div><!--end col-->


                            </div><!--end row-->
                        </div><!--end page-title-box-->
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div><!--end col-->
                </div><!--end row-->
                <!-- end page title end breadcrumb -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Business Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($businesstype as $bt)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $bt->business_name }}</td>
                                                <td>
                                                    <div class="btn-group mb-2 mb-md-0">
                                                        <button type="button" class="btn view_btn dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">Action <i
                                                                class="mdi mdi-chevron-down"></i></button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item view_btn1"
                                                                href="{{ route('edit.businesstype', $bt->id) }}">Edit</a>
                                                            <a class="dropdown-item delete_btn"
                                                                href="{{ route('delete.businesstype', $bt->id) }}"
                                                                onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div><!-- container -->
        @endsection
