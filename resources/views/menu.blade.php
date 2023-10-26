<!-- Admin menus -->
{{-- <div class="menu-content h-100" data-simplebar  style="background-color: {{ isset($allsectdetails->colorpicks) ? $allsectdetails->colorpicks : '' }}"> --}}
<div class="menu-content h-100" data-simplebar>

    <!-- menu.blade.php -->
    <ul class="metismenu left-sidenav-menu">
        <li><a href="{{ route('admin.dashboard') }}"><i data-feather="hhh"
                    class="align-self-center menu-icon"></i><span>Dashboard</span></a></li>

        @php
            $countmenu = count($structuredMenu);
            $roleid = session('roleid');
            $roleIdsArray = explode(',', $roleid);
            $roleCount = count($roleIdsArray);
        @endphp
        @foreach ($userdetails as $userdts)
            @if (in_array('2', $roleIdsArray) && $userdts->approved != 'Y' && $selrdetails->busnes_type == 1)
                <li><a href="{{ route('admin.shopapprovalsadd', 1) }}"><i data-feather="hhh"
                            class="align-self-center menu-icon"></i><span>Shop Details</span></a></li>
                <li><a href="{{ route('user.changepassword') }}"><i data-feather="hhh"
                            class="align-self-center menu-icon"></i><span>Change Password</span></a></li>
            @endif
            @if (in_array('9', $roleIdsArray) && $userdts->approved != 'Y' && $selrdetails->busnes_type == 2)
                <li><a href="{{ route('admin.shopapprovalsadd', 2) }}"><i data-feather="hhh"
                            class="align-self-center menu-icon"></i><span>Service Details</span></a></li>
                <li><a href="{{ route('user.changepassword') }}"><i data-feather="hhh"
                            class="align-self-center menu-icon"></i><span>Change Password</span></a></li>
            @endif

            @if (in_array('2', $roleIdsArray) && $userdts->approved == 'Y' && $countmenu == 0 && $selrdetails->busnes_type == 1)
                <li><a href="{{ route('admin.shopapprovalsadd', 1) }}"><i data-feather="hhh"
                            class="align-self-center menu-icon"></i><span>Shop Details</span></a></li>
                <li><a href="{{ route('user.changepassword') }}"><i data-feather="hhh"
                            class="align-self-center menu-icon"></i><span>Change Password</span></a></li>
            @endif
            @if (in_array('9', $roleIdsArray) && $userdts->approved == 'Y' && $countmenu == 0 && $selrdetails->busnes_type == 2)
                <li><a href="{{ route('admin.shopapprovalsadd', 2) }}"><i data-feather="hhh"
                            class="align-self-center menu-icon"></i><span>Service Details</span></a></li>
                <li><a href="{{ route('user.changepassword') }}"><i data-feather="hhh"
                            class="align-self-center menu-icon"></i><span>Change Password</span></a></li>
            @endif
        @endforeach

        @foreach ($structuredMenu as $layer1 => $layer1Data)
            <li class="">

                <a href="{{ $layer1Data[0][1] ?? '#' }}" href="javascript:void(0);" aria-expanded="false">
                    @if (is_array($layer1Data[0]))
                        <span>
                            @foreach ($layer1Data[0] as $item)
                                @if (isset($item[0]))
                                    {{ is_array($item) ? $item[0] ?? '' : $item }}
                                @endif
                            @endforeach
                        </span>
                    @else
                        <span>{{ $layer1Data[0] ?? '' }}</span>
                    @endif
                    <span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span>
                </a>
                <ul class="nav-second-level mm-collapse" aria-expanded="false">
                    @foreach ($layer1Data as $layer2 => $layer2Data)
                        @if ($layer2 > 0)
                            @if (isset($layer2Data[0]) &&
                                    is_array($layer2Data[0]) &&
                                    isset($layer2Data[0][0]) &&
                                    is_string($layer2Data[0][0]) &&
                                    $layer2Data[0][0] != '')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url($layer2Data[0][1] ?? '#') }}"><i
                                            class="ti-control-record"></i>{{ $layer2Data[0][0] ?? '' }}</a>
                                </li>
                            @endif
                        @endif
                    @endforeach
                </ul>

            </li>
        @endforeach




















        {{--
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
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.shopapprovals', ['id' => 1]) }}"><i
                        class="ti-control-record"></i>Shop Approvals</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.shopapprovals', ['id' => 2]) }}"><i
                class="ti-control-record"></i>Services Approvals</a></li>



            <li class="nav-item"><a class="nav-link" href="products_approval_table.html"><i
                        class="ti-control-record"></i>Product Approvals</a></li>
            <li class="nav-item"><a class="nav-link" href="category_approval.html"><i
                        class="ti-control-record"></i>Category Approvals</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('user.shopproduct') }}"><i
                class="ti-control-record"></i>Add Shop Products</a></li>



        </ul>
    </li>
    <hr class="hr hr-menu">
    <li class="">
        <a href="javascript: void(0);" aria-expanded="false"><span>User Details</span><span class="menu-arrow"><i
                    class="mdi mdi-chevron-right"></i></span></a>
        <ul class="nav-second-level mm-collapse" aria-expanded="false">
            <li class="nav-item"><a class="nav-link" href="{{ route('add.role') }}"><i
                        class="ti-control-record"></i>Add Roles</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('get.roles') }}"><i
                        class="ti-control-record"></i>Manage Roles</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('user.usercreate') }}"><i
                        class="ti-control-record"></i>User Creation</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('user.usermenucreate') }}"><i
                    class="ti-control-record"></i>User Menu Mapping</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('user.rolemenucreate') }}"><i
                    class="ti-control-record"></i>Role Menu Mapping</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('user.userrolecreate') }}"><i
                class="ti-control-record"></i>User Role Menu Mapping</a></li>
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


@if (session('roleid') == '2')
<ul class="metismenu left-sidenav-menu">

    <li><a href="{{ route('seller.dashboard') }}"> <i data-feather="hhh"
                class="align-self-center menu-icon"></i><span>Dashboard</span><span
                class="menu-arrow"></span></a> </li>
    <hr class="hr hr-menu">
    <li><a href="{{ route('admin.shopapprovals', ['id' => 1]) }}"> <i data-feather="hhh"
                class="align-self-center menu-icon"></i><span>Home</span><span class="menu-arrow"></span></a>
    </li>
    <hr class="hr hr-menu">
    <li><a href="{{ route('new.attributes') }}"> <i data-feather="hhh"
        class="align-self-center menu-icon"></i><span>Attributes Types</span><span
        class="menu-arrow"></span></a> </li>
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
    <li><a href="{{ route('list.shop_offer') }}"> <i data-feather="hhh"
                class="align-self-center menu-icon"></i><span>Offers</span><span
                class="menu-arrow"></span></a> </li>
    <hr class="hr hr-menu">

</ul>
@endif

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
@endif --}}

        <!-- end affiliate menu -->






</div>

</div>
<!-- end left-sidenav-->
<div class="page-wrapper">
