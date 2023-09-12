<!-- Admin menus -->
<div class="menu-content h-100" data-simplebar>
    @if (session('roleid') == '1')
        <ul class="metismenu left-sidenav-menu">
            <li><a href="{{ route('admin.dashboard') }}"> <i data-feather="hhh"
                        class="align-self-center menu-icon"></i><span>Dashboard</span><span class="menu-arrow"></span></a>
            </li>
            <hr class="hr hr-menu">

            <li class="">
                <a href="javascript: void(0);" aria-expanded="false"><span>Approvals</span><span class="menu-arrow"><i
                            class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level mm-collapse" aria-expanded="false">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.affiliateapprovals') }}"><i
                                class="ti-control-record"></i>Affiliates Approvals</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.shopapprovals') }}"><i
                                class="ti-control-record"></i>Shop Approvals</a></li>
                    <li class="nav-item"><a class="nav-link" href="products_approval_table.html"><i
                                class="ti-control-record"></i>Product Approvals</a></li>
                    <li class="nav-item"><a class="nav-link" href="category_approval.html"><i
                                class="ti-control-record"></i>Category Approvals</a></li>
                </ul>
            </li>
            <hr class="hr hr-menu">
            <li class="">
                <a href="javascript: void(0);" aria-expanded="false"><span>Roles</span><span class="menu-arrow"><i
                            class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level mm-collapse" aria-expanded="false">
                    <li class="nav-item"><a class="nav-link" href="{{ route('add.role') }}"><i
                                class="ti-control-record"></i>Add Roles</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('get.roles') }}"><i
                                class="ti-control-record"></i>Manage Roles</a></li>
                </ul>
            </li>
            <hr class="hr hr-menu">
            <li class="">
                <a href="javascript: void(0);" aria-expanded="false"><span>Types</span><span class="menu-arrow"><i
                            class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level mm-collapse" aria-expanded="false">
                    <li class="nav-item"><a class="nav-link" href="{{ route('list.businesstype') }}"><i
                                class="ti-control-record"></i>Business Type</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('list.shoptype') }}"><i
                                class="ti-control-record"></i>Shop Type</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('list.servicetype') }}"><i
                                class="ti-control-record"></i>Service Type</a></li>
                </ul>
            </li>
            <hr class="hr hr-menu">
            <li class="">
                <a href="javascript: void(0);" aria-expanded="false"><span>Status</span><span class="menu-arrow"><i
                            class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level mm-collapse" aria-expanded="false">
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
            <hr class="hr hr-menu">
            <li><a href="{{ route('list.executive') }}"> <i data-feather="hhh"
                        class="align-self-center menu-icon"></i><span>Executives</span><span
                        class="menu-arrow"></span></a> </li>
            <hr class="hr hr-menu">
            <li><a href="order_placement.html"> <i data-feather="hhh"
                        class="align-self-center menu-icon"></i><span>Order
                        Placement</span><span class="menu-arrow"></span></a> </li>
            <hr class="hr hr-menu">
            <li><a href="{{ route('list.category') }}"> <i data-feather="hhh"
                        class="align-self-center menu-icon"></i><span>Category
                            </span><span class="menu-arrow"></span></a> </li>
            <hr class="hr hr-menu">
            <li class="">
                <a href="javascript: void(0);" aria-expanded="false"><span>Master Data</span><span
                        class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level mm-collapse" aria-expanded="false">
                    <li class="nav-item"><a class="nav-link" href="{{ route('list.country') }}"><i
                                class="ti-control-record"></i>Countries</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('list.state') }}"><i
                                class="ti-control-record"></i>States</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('list.district') }}"><i
                                class="ti-control-record"></i>Districts</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('list.profession') }}"><i
                                class="ti-control-record"></i>Professions</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('list.religion') }}"><i
                                class="ti-control-record"></i>Religions</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('list.bank') }}"><i
                                class="ti-control-record"></i>Banks</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('list.bank_branch') }}"><i
                                class="ti-control-record"></i>Bank Branches</a></li>
                </ul>
                <hr class="hr hr-menu">
            </li>
        </ul>
    @endif
    {{-- </div>

{{-- </div>
<!-- end admin menu -->





<!-- Seller menus -->
<div class="menu-content h-100" data-simplebar> --}}

    @if (session('roleid') == '2')
        <ul class="metismenu left-sidenav-menu">
            
            <li><a href="{{ route('seller.dashboard') }}"> <i data-feather="hhh"
                        class="align-self-center menu-icon"></i><span>Dashboard</span><span
                        class="menu-arrow"></span></a> </li>
            <hr class="hr hr-menu">
            <li><a href="{{ route('admin.shopapprovals') }}"> <i data-feather="hhh"
                        class="align-self-center menu-icon"></i><span>Home</span><span class="menu-arrow"></span></a>
            </li>
            <hr class="hr hr-menu">
            <li><a href="my_products.html"> <i data-feather="hhh" class="align-self-center menu-icon"></i><span>My
                        Products</span><span class="menu-arrow"></span></a> </li>
            <hr class="hr hr-menu">
            <li><a href="add_products.html"> <i data-feather="hhh" class="align-self-center menu-icon"></i><span>Add
                        Products</span><span class="menu-arrow"></span></a> </li>
            <hr class="hr hr-menu">
            <li><a href="category_table.html"> <i data-feather="hhh"
                        class="align-self-center menu-icon"></i><span>Add Categories</span><span
                        class="menu-arrow"></span></a> </li>
            <hr class="hr hr-menu">
            <li class="">
                <a href="javascript: void(0);" aria-expanded="false"> <i data-feather="hhh"
                        class="align-self-center menu-icon"></i> <span>Manage Orders</span><span class="menu-arrow"><i
                            class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level mm-collapse" aria-expanded="false" style="height: 0px;">
                    <li class="nav-item"><a class="nav-link" href="pending_orders.html"><i
                                class="ti-control-record"></i>Pending Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="completed_orders.html"><i
                                class="ti-control-record"></i>Completed Orders</a></li>
                </ul>
            </li>
            <hr class="hr hr-menu">
            <li><a href="offer_table.html"> <i data-feather="hhh"
                        class="align-self-center menu-icon"></i><span>Offers</span><span
                        class="menu-arrow"></span></a> </li>
            <hr class="hr hr-menu">

        </ul>
    @endif
<!-- end seller menu -->



<!-- Affiliate menus -->

    @if (session('roleid') == '3')
        <ul class="metismenu left-sidenav-menu">

            <li><a href="{{ route('affiliate.dashboard') }}"> <i data-feather="hhh"
                        class="align-self-center menu-icon"></i><span>Dashboard</span><span class="menu-arrow"></span></a>
            </li>
            <hr class="hr hr-menu">
            <li><a href="{{ route('admin.affiliateapprovals') }}"> <i data-feather="hhh"
                        class="align-self-center menu-icon"></i><span>Home</span><span class="menu-arrow"></span></a>
            </li>
            <hr class="hr hr-menu">
            <li><a href="{{ route('affiliate.affiliateslist') }}"> <i data-feather="hhh"
                        class="align-self-center menu-icon"></i><span>Affiliates</span><span
                        class="menu-arrow"></span></a> </li>
            <hr class="hr hr-menu">
            <li><a href="{{ route('affiliate.affliateshops') }}"> <i data-feather="hhh"
                        class="align-self-center menu-icon"></i><span>Shops</span><span class="menu-arrow"></span></a>
            </li>
            <hr class="hr hr-menu">
            <li><a href="wallet.html"> <i data-feather="hhh"
                        class="align-self-center menu-icon"></i><span>Wallets</span><span class="menu-arrow"></span></a>
            </li>
            <hr class="hr hr-menu">

        </ul>
    @endif

<!-- end affiliate menu -->






</div>

</div>
<!-- end left-sidenav-->
<div class="page-wrapper">
