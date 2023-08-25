@if($sellerCount > 0)
<table id="datatable" class="table table-striped table-bordered" >
        <thead>
            <tr>
                <th>SINO</th>
                <th>Reg. ID</th>
                <th>Shop Name</th>
                <th>Owner Name</th>
                <th>Email</th>
                <th>Mobile</th>
                {{-- <th>Address</th>
                <th>Referral ID</th>
                <th>Business Type</th>
                <th>Service Type</th>
                <th>Executive Name</th>
                <th>Reg. Date</th>--}}
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sellerDetails as $index => $sellerDetail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $sellerDetail->shop_reg_id }}</td>
                    <td>{{ $sellerDetail->shop_name }}</td>
                    <td>{{ $sellerDetail->owner_name }}</td>
                    <td>{{ $sellerDetail->shop_email }}</td>
                    <td>{{ $sellerDetail->shop_mobno }}</td>
                    {{-- <td>{{ $sellerDetail->house_name_no.','. $sellerDetail->locality.','. $sellerDetail->village.','.$sellerDetail->District->district_name.','.$sellerDetail->State->state_name.','. $sellerDetail->Country->country_name }}</td>
                    <td>{{ $sellerDetail->referal_id }}</td>
                    <td>{{ $sellerDetail->businessType->business_name }}</td>
                    <td>{{ $sellerDetail->serviceType->service_name }}</td>
                    <td>{{ $sellerDetail->executive->executive_name }}</td>
                    <td>{{ $sellerDetail->created_at }}</td>--}}
                    <td>
                        <div class="btn-group mb-2 mb-md-0">
                            <button type="button" class="btn view_btn dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                <i class="mdi mdi-chevron-down"></i></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item view_btn1" href="shop_approval_view.html">View</a>
                                <a class="dropdown-item approve_btn" href="#">Approve</a>
                                <a class="dropdown-item delete_btn" href="#">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <table>
        <tr><td colspan="13" align="center"><b><font color="red">No data Found...</font></b></td></tr>
    </table>
@endif
