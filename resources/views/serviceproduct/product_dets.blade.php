@if ($ProductCount > 0)
    {{-- <style>
        tfoot {
            display: table-header-group;
        }

        tfoot input {
            width: 100%;
            padding: 3px;
            box-sizing: border-box;
        }
    </style> --}}
    <input type="hidden" id="hidroleid" name="hidroleid" value="{{ session('roleid') }}" />
    @if (session('roleid') == '1' || session('roleid') == '11')
        <div class="text-center">
            <span class="badge badge-soft-info p-2">
                Total Available Services : {{ $approvedproductcounts->prod_status_y_count }}
            </span>
            <span class="badge badge-soft-danger p-2">
                Total Not Available Services : {{ $approvedproductcounts->prod_status_not_y_count }}
            </span>

            <span class="badge badge-soft-info p-2">
                Total Approved Services : {{ $approvedproductcounts->approved_y_count }}
            </span>
            <span class="badge badge-soft-danger p-2">
                Total Not Approved Services : {{ $approvedproductcounts->approved_not_y_count }}
            </span>
            <span class="badge badge-soft-danger p-2">
                Total Rejected Services : {{ $approvedproductcounts->approved_reject_y_count }}
            </span>


        </div>
    @endif
    <table id="datatable3" class="table table-striped table-bordered" style="width: 100%">
        {{-- <tfoot>
            <tr>
                @if (session('roleid') == '1' || session('roleid') == '11')
                    <th style="border: 0px solid #eaf0f7"></th>
                @endif
                <th style="border: 0px solid #eaf0f7"></th>
                <th style="border: 0px solid #eaf0f7">Service ID</th>
                <th style="border: 0px solid #eaf0f7">Service Name</th>
                <th style="border: 0px solid #eaf0f7">Service Provider Name</th>
                <th style="border: 0px solid #eaf0f7">Active Status</th>
                <th style="border: 0px solid #eaf0f7">Approval Status</th>
                <th style="border: 0px solid #eaf0f7"></th>
            </tr>
        </tfoot> --}}
        <thead>
            <tr>
                {{-- <th>Approved all<input type='checkbox' name='checkbox1' id='checkbox1' onclick='check();' /></th> --}}
                @if (session('roleid') == '1' || session('roleid') == '11')
                    <th width="5px" data-sorting="true" class="checkboxcol"><input type='checkbox' name='checkbox1'
                            id='checkbox1' class="selectAll" onclick='' /></th>
                @endif
                <th>S.No.</th>
                <th>Service ID</th>
                <th>Service Name</th>
                <th>Service Provider Name</th>
                <th>Active Status</th>
                <th>Approval Status</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($ServiceDetails as $index => $prodDetails)
                <tr>
                    @if (session('roleid') == '1' || session('roleid') == '11')
                        <td class="checkboxcol"><input name="productid[]" type="checkbox"
                                id="productid{{ $index + 1 }}" value="{{ $prodDetails->id }}"
                                {{ $prodDetails->is_approved === 'Y' ? 'checked' : '' }} />
                        </td>
                    @endif
                    <td>{{ $index + 1 }}</td>
                    <td>SER{{ str_pad($prodDetails->id, 9, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $prodDetails->service_name }}</td>
                    <td>{{ $prodDetails->shopname }}</td>
                    <td>
                        {{-- <span
                            class="badge p-2 {{ $prodDetails->service_status === 'Y' ? 'badge badge-success' : 'badge badge-danger' }}">
                            {{ $prodDetails->service_status === 'Y' ? 'Available' : 'Not Available' }}
                        </span> --}}
                        @if ($prodDetails->service_status === 'Y')
                            @php
                                $prtatus = 'Available';
                            @endphp
                        @else
                            @php
                                $prtatus = 'Not Available';
                            @endphp
                        @endif
                        {{ $prtatus }}

                    </td>
                    <td>
                        {{-- <span
                            class="badge p-2 {{ $prodDetails->is_approved === 'Y' ? 'badge badge-success' : ($prodDetails->is_approved === 'N' ? 'badge badge-info' : 'badge badge-danger') }}">
                            {{ $prodDetails->is_approved === 'Y' ? 'Yes' : ($prodDetails->is_approved === 'N' ? 'No' : 'Rejected') }}
                        </span> --}}
                        @if ($prodDetails->is_approved === 'Y')
                            @php
                                $praprvtatus = 'Yes';
                            @endphp
                        @else
                            @php
                                $praprvtatus = 'No';
                            @endphp
                        @endif
                        {{ $praprvtatus }}
                    </td>
                    <td>
                        <div class="btn-group mb-2 mb-md-0">
                            <button type="button" class="btn view_btn dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Action
                                <i class="mdi mdi-chevron-down"></i></button>
                            <div class="dropdown-menu">

                                @if (session('roleid') == '1' || session('roleid') == '11')
                                    <a class="dropdown-item view_btn1 d-none" id="viewbtn" href="#"
                                        onclick="productvieweditdet({{ $prodDetails->id }})">View/Edit</a>
                                    <a class="dropdown-item approve_btn" href="#"
                                        onclick="productapprovedet({{ $prodDetails->id }})"
                                        id="aprvbtn">Activation/Approval</a>
                                    <a class="dropdown-item delete_btn" href="#" id="delbtn"
                                        onclick="productdeletedet({{ $prodDetails->id }})">Delete</a>
                                @else
                                    <a class="dropdown-item view_btn1" href="#"
                                        onclick="productvieweditdet({{ $prodDetails->id }})">View/Edit</a>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <input type="hidden" value="{{ $index + 1 }}" id="totalproductcnt">
@else
    <table>
        <tr>
            <td colspan="13" align="center">
                <img src="{{ asset('backend/assets/images/notfoundimg.png') }}" alt="notfound" class="rounded-circle"
                    style="width: 30%;" />
            </td>
        </tr>
    </table>
@endif
@if (session('roleid') == '1' || session('roleid') == '11')
    @if ($ProductCount > 0)
        <div class="col text-center">
            <button class="btn btn-primary" style="cursor:pointer" onclick="productapprovedall();"
                id="approveAllBtn">Approve All</button>
        </div>
    @endif
@endif


<!-- Modal Add New -->
<div class="modal fade p-5" id="addNewModal" tabindex="-1" aria-labelledby="addNewModalLabel" aria-hidden="true">
    <div class="modal-dialog custom-modal-dialog" style="overflow-y: scroll;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="addNewModalLabel">Add New Services</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    title="Close">x</button>
            </div>
            <div class="modal-body">
                <form id="ProductAddForm" enctype="multipart/form-data" method="POST">
                    <input type="hidden" id="selectedProductId" name="selectedProductId">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    @php
                                        $shopshowhide = session('roleid') == 1 || session('roleid') == 11 || session('roleid') == 3 ? 'style=display:block;' : 'style=display:none;';
                                    @endphp


                                    <div class="form-group d-none"><label>Service Provider Name<span
                                                class="text-danger">*</span></label>
                                        <input type="hidden" id="shop_name" name="shop_name" required tabindex="1"
                                            value="{{ $userservicedets }}">
                                        <div for="shop_name" class="error"></div>
                                    </div>


                                    <div class="form-group"><label>Service Name<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="prod_name" name="prod_name"
                                            class="enterproduct form-control" maxlength="60"
                                            placeholder="Service Name" required tabindex="1" />
                                        <div for="prod_name" class="error"></div>
                                    </div>

                                    <div class="form-group"><label>Service Image<span
                                                class="text-danger">*</span></label>
                                        <input type="file" id="s_photo" name="s_photo[]" class="form-control"
                                            placeholder="Service Photo" tabindex="5" required
                                            accept="image/jpeg, image/png" />
                                        <div for="s_photo" class="error"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group" align="left">
                                            <div id="image-preview" class="row"></div>
                                        </div>
                                    </div>

                                    <div class="form-group d-none"><label>Set Availability Dates<span
                                                class="text-danger">*</span></label>
                                        <select class="form-select form-control form-control-lg" id="setavailbledate"
                                            name="setavailbledate" required tabindex="1">
                                            {{-- <option value="">Select</option><br /> --}}
                                            <option value="1">Avialability Date</option><br />
                                        </select>
                                        <div for="setavailbledate" class="error"></div>
                                    </div>
                                    <div class="form-group"><label>Set Availability Dates<span
                                                class="text-danger">*</span></label>

                                    </div>
                                    {{-- style="display: none;" --}}
                                    <div class="form-group" id="dateFields">
                                        <div class="input-group">
                                            <div class="col-lg-5">
                                                <label for="setavailblefromdate">From Date</label>
                                                <input type="date" class="form-control form-control-lg"
                                                    id="setavailblefromdate" name="setavailblefromdate" required
                                                    tabindex="2">
                                            </div>
                                            <div class="col-lg-4">
                                                <label for="setavailbletodate">To Date</label>
                                                <input type="date" class="form-control form-control-lg"
                                                    id="setavailbletodate" name="setavailbletodate" required
                                                    tabindex="3" min="{{ date('Y-m-d') }}">
                                            </div>
                                            <div class="col-lg-3"><label for="isnotavailable">Not Available</label>
                                                <input class="form-control" type="checkbox" id="isnotavailable"
                                                    name="isnotavailable" value="1" style="width: 10%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="singleDateField" style="display: none;">
                                        <fieldset>
                                            <div class="repeater-default-date">
                                                <div data-repeater-list="notavailabledate_data">
                                                    <!-- Heading Row -->
                                                    <div class="form-group row">
                                                        <div class="col">
                                                            <label class="control-label"> Not Available Date </label>
                                                        </div>
                                                    </div>
                                                    <!-- Dynamic Rows -->
                                                    <div data-repeater-item="">
                                                        <div class="form-group row d-flex align-items-end">
                                                            <div class="col">
                                                                <input type="date"
                                                                    class="form-control form-control-lg"
                                                                    name="setavailblesingledate" tabindex="4">
                                                                <div class="dateValidationMessage"
                                                                    style="color: red;"></div>
                                                            </div>
                                                            <div class="col">
                                                                <span data-repeater-delete=""
                                                                    class="btn btn-danger btn-sm">
                                                                    <span class="far fa-trash-alt mr-1"></span> Delete
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0 row">
                                                    <div class="col-sm-12 text-right">
                                                        <span data-repeater-create=""
                                                            class="btn btn-secondary btn-sm">
                                                            <span class="fas fa-plus"></span> Add not available dates
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>

                        </div>



                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Service Description <span class="text-danger">*</span></label>
                                        <textarea id="prod_description" name="prod_description" placeholder="Service Description" class="form-control"
                                            maxlength="7000" tabindex="4" required rows="3"></textarea>
                                        <label for="prod_description"></label>
                                    </div>
                                    <div class="form-group">
                                        <fieldset>
                                            <div class="repeater-default-question">
                                                <div data-repeater-list="setquestion_data">
                                                    <!-- Heading Row -->
                                                    <div class="form-group row">
                                                        <div class="col">
                                                            <label class="control-label"> Set Question for Customer
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <!-- Dynamic Rows -->
                                                    <div data-repeater-item="">
                                                        <div class="form-group row d-flex align-items-end">

                                                            <div class="col">
                                                                <textarea id="setquestion" name="setquestion" placeholder="Set Question" class="form-control" maxlength="250"
                                                                    tabindex="6" rows="2" cols="5"></textarea>
                                                                <label for="setquestion"></label>
                                                            </div>

                                                            <div class="col">
                                                                <span data-repeater-delete=""
                                                                    class="btn btn-danger btn-sm">
                                                                    <span class="far fa-trash-alt mr-1"></span> Delete
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0 row">
                                                    <div class="col-sm-12 text-right">
                                                        <span data-repeater-create=""
                                                            class="btn btn-secondary btn-sm">
                                                            <span class="fas fa-plus"></span> Add New Question
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">




                                    {{-- <div class="form-group"><label>Service Required?<span
                                                class="text-danger">*</span></label>
                                        <select class="selectservicetype form-select form-control form-control-lg"
                                            id="service_type_id" name="service_type_id" required tabindex="1">
                                            <option value="">Select Services</option><br />
                                            @foreach ($servicedetails as $shps)
                                                <option value="{{ $shps->id }}">{{ $shps->service_name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="service_type_id" class="error"></label>
                                    </div>

                                    <div class="form-group d-none"><label>Preffered Employee<span
                                                class="text-danger">*</span></label>
                                        <select class="selectserviceemploye form-select form-control form-control-lg"
                                            id="service_employe_id" name="service_employe_id" tabindex="1">
                                            <option value="">Select Employee</option><br />
                                            @foreach ($serviceemployees as $emplye)
                                                <option value="{{ $emplye->id }}">{{ $emplye->employee_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="service_employe_id" class="error"></label>
                                    </div> --}}

                                    <div class="form-group"><label>Suggestions</label>
                                        <textarea id="sugection" name="sugection" placeholder="Suggestions" class="form-control" maxlength="500"
                                            tabindex="6"></textarea>
                                        <label for="sugection" class="error"></label>
                                    </div>

                                    <div class="form-group mb-0 row">
                                        <label class="col-md-3">Service Point </label>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <div class="form-check form-check-inline">

                                                    <input class="form-control" type="checkbox" id="servicepoint1"
                                                        name="servicepoint1" value="1" style="width: 18%;">
                                                    <label class="form-check-label" for="servicepoint1">At
                                                        Home</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-control" type="checkbox" id="servicepoint2"
                                                        name="servicepoint2" value="1" style="width: 19%;">
                                                    <label class="form-check-label" for="servicepoint2">At
                                                        Shop</label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>




                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="form-group">
                                        <fieldset>
                                            <div class="repeater-default-time">
                                                <div data-repeater-list="availabletime_data">
                                                    <!-- Heading Row -->
                                                    <div class="form-group row">
                                                        <div class="col-md-2">
                                                            <label class="control-label"> Set Available time </label>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="control-label"> Employees </label>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="control-label"> Day </label>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="control-label"> From Time </label>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="control-label"> To Time </label>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <label class="control-label"> Grace Time </label>
                                                        </div>

                                                    </div>
                                                    <!-- Dynamic Rows -->
                                                    <div data-repeater-item="">
                                                        <div class="form-group row d-flex align-items-end">
                                                            <div class="col-md-2">
                                                                <input class="form-control" type="checkbox"
                                                                    id="settimestatus" name="settimestatus"
                                                                    value="1" style="width: 7%;">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <select class="form-control" id="service_employe_id"
                                                                    name="service_employe_id" tabindex="1">
                                                                    <option value="">Select Employee</option>
                                                                    <br />
                                                                    @foreach ($serviceemployees as $emplye)
                                                                        <option value="{{ $emplye->id }}">
                                                                            {{ $emplye->employee_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>


                                                            <div class="col-md-2">
                                                                <select id="setdays" name="setdays"
                                                                    class="day-select form-control">

                                                                    <option value="Sunday">Sunday</option>
                                                                    <option value="Monday">Monday</option>
                                                                    <option value="Tuesday">Tuesday</option>
                                                                    <option value="Wednesday">Wednesday</option>
                                                                    <option value="Thursday">Thursday</option>
                                                                    <option value="Friday">Friday</option>
                                                                    <option value="Saturday">Saturday</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="text" id="setfrom_time"
                                                                    name="setfrom_time"
                                                                    class="form-control timepicker-input">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="text" id="setto_time"
                                                                    name="setto_time"
                                                                    class="form-control timepicker-input">
                                                            </div>
                                                            <div class="col-md-1">
                                                                <input class="form-control" type="text"
                                                                    id="gracetime" name="gracetime" maxlength="10">
                                                            </div>
                                                            <div class="col-md-1">
                                                                <span data-repeater-delete=""
                                                                    class="btn btn-danger btn-sm">
                                                                    <span class="far fa-trash-alt mr-1"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0 row">
                                                    <div class="col-sm-12 text-right">
                                                        <span data-repeater-create=""
                                                            class="btn btn-secondary btn-sm">
                                                            <span class="fas fa-plus"></span> Add New Time
                                                        </span>
                                                        {{-- @if (session('roleid') == '1' || session('roleid') == '11') --}}
                                                        <button type="button" id="addSameTiming"
                                                            class="btn btn-primary btn-sm">
                                                            Add Same Timing for All Days
                                                        </button>
                                                        {{-- @endif --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>

                                </div>
                            </div>
                        </div>






                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="form-group mb-0 row">
                                            <label class="col-md-6 my-1 control-label">Do you want to select
                                                attributes?</label>
                                            <div class="col-md-6">
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="yesCheck" name="customRadio"
                                                            class="custom-control-input"
                                                            onclick="javascript:yesnoCheck();" tabindex="14"
                                                            value="Y">
                                                        <label class="custom-control-label" for="yesCheck">Yes</label>
                                                    </div>
                                                </div>
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="noCheck" name="customRadio"
                                                            class="custom-control-input"
                                                            onclick="javascript:yesnoCheck();" tabindex="15"
                                                            value="N">
                                                        <label class="custom-control-label" for="noCheck">No</label>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <hr>
                                        <div id="ifYes" style="display:none">
                                            <fieldset>
                                                <div class="repeater-default">
                                                    <div data-repeater-list="attributedata">
                                                        <!-- Heading Row -->
                                                        <div class="form-group row">
                                                            <div class="col">
                                                                <label class="control-label"> Show status </label>
                                                            </div>

                                                        </div>
                                                        <!-- Dynamic Rows -->
                                                        <div data-repeater-item="">
                                                            <div class="form-group row d-flex align-items-end">
                                                                <div class="col">
                                                                    <input class="form-control" type="checkbox"
                                                                        id="stockstatus1" name="stockstatus1"
                                                                        value="1" style="width: 10%;">
                                                                </div>
                                                                <div class="col">
                                                                    <input type="text" id="attatibute1"
                                                                        name="attatibute1" placeholder="Attribute1"
                                                                        required class="form-control">
                                                                </div>
                                                                <div class="col">
                                                                    <input type="text" id="attatibute2"
                                                                        name="attatibute2" placeholder="Attribute2"
                                                                        required class="form-control">
                                                                </div>
                                                                <div class="col">
                                                                    <input type="text" id="attatibute3"
                                                                        name="attatibute3" placeholder="Attribute3"
                                                                        required class="form-control">
                                                                </div>
                                                                <div class="col">
                                                                    <input type="text" id="attatibute4"
                                                                        name="attatibute4" placeholder="Attribute4"
                                                                        class="form-control">
                                                                </div>
                                                                <div class="col">
                                                                    <input type="text" id="offerprice1"
                                                                        name="offerprice1" placeholder="Offer Price"
                                                                        maxlength="10" class="form-control"
                                                                        oninput="numberOnlyAllowedDot(this)">
                                                                </div>
                                                                <div class="col">
                                                                    <input type="text" id="mrprice1"
                                                                        name="mrprice1" placeholder="MRP"
                                                                        maxlength="10" class="form-control"
                                                                        oninput="numberOnlyAllowedDot(this)">
                                                                </div>
                                                                <div class="col">
                                                                    <input type="text" id="attr_calshop1"
                                                                        name="attr_calshop1" placeholder="Call Shop"
                                                                        maxlength="10" class="form-control"
                                                                        oninput="numberOnlyAllowed(this)">
                                                                </div>
                                                                <div class="col">
                                                                    <span data-repeater-delete=""
                                                                        class="btn btn-danger btn-sm">
                                                                        <span class="far fa-trash-alt mr-1"></span>
                                                                        Delete
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-0 row">
                                                        <div class="col-sm-12  text-right">
                                                            <span data-repeater-create=""
                                                                class="btn btn-secondary btn-sm">
                                                                <span class="fas fa-plus"></span> Add New
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>


                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div style="float:right">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger" id="resetButton">Reset</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div id="productsub-message" class="text-center" style="display: none;"></div>
                        </div>

                        <div class="col-md-12">
                            <div id="product_del-message" class="text-center" style="display: none;"></div>
                        </div>



                </form>
            </div>
        </div>
    </div>




</div>

</div>
</div>
</div>
<!-- Modal Add new Close -->



<script>
    $(document).ready(function() {
        var currentPagePath = window.location.pathname;
        //console.log("Current Page URL:", currentPageUrl);

        // Check if the current page is the "listshopproduct" page
        var urlParts = currentPagePath.split('/');
        var serviceName = urlParts[1];
        if (serviceName === "listallserviceapp") {
            $(".view_btn1").addClass("d-none");
            $(".approve_btn, .delete_btn").removeClass("d-none");
            $(".checkboxcol").removeClass("d-none");
            $("#approveAllBtn").removeClass("d-none");
        } else if (serviceName === "listallservice") {
            $(".view_btn1").removeClass("d-none");
            $(".approve_btn").addClass("d-none");
            $(".checkboxcol").addClass("d-none");
            $("#approveAllBtn").addClass("d-none");
        }
    });

    function yesnoCheck() {
        if (document.getElementById('yesCheck').checked) {
            document.getElementById('ifYes').style.display = 'block';
        } else {
            document.getElementById('ifYes').style.display = 'none';
            $('#errorstock-message').hide();
        }

    }

    function numberOnlyAllowed(inputElement) {
        let value = inputElement.value.replace(/\D/g, '');
        if (value.length > 10) {
            value = value.slice(0, 10);
        }
        inputElement.value = value;
    }

    function numberOnlyAllowedDot(inputElement) {
        let value = inputElement.value.replace(/[^0-9.]/g, '');
        if (value.length > 10) {
            value = value.slice(0, 10);
        }
        inputElement.value = value;
    }

    $(document).ready(function() {

        // var table = $('#datatable3').DataTable({
        //     initComplete: function() {
        //         this.api()
        //             .columns()
        //             .every(function() {
        //                 let column = this;
        //                 let title = column.footer().textContent;
        //                 if (title == "")
        //                     return;
        //                 // Create input element
        //                 let input = document.createElement('input');
        //                 input.className = "form-control form-control-lg";
        //                 input.type = "text";
        //                 input.placeholder = title;
        //                 column.footer().replaceChildren(input);

        //                 // Event listener for user input
        //                 input.addEventListener('keyup', () => {
        //                     if (column.search() !== this.value) {
        //                         column.search(input.value).draw();
        //                     }
        //                 });
        //             });
        //     },
        //     "columnDefs": [{
        //         "targets": 0,
        //         "orderable": false
        //     }]
        // });
        function cbDropdown(column) {
            return $('<ul>', {
                'class': 'cb-dropdown form-control'
            }).appendTo($('<div>', {
                'class': 'cb-dropdown-wrap '
            }).appendTo(column));
        }

        $('#datatable3').DataTable({
            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;
                    var colIndex = column[0][0];
                    var hidroleid = $('#hidroleid').val();
                    if (hidroleid == 1 || hidroleid == 11) {
                        var excludeColumns = [0, 1, 7];
                        var textColumns = [2, 3, 4];
                    } else {
                        var excludeColumns = [0, 6];
                        var textColumns = [1,2,3];

                    }

                    // var excludeColumns = [0, 1, 7];
                    // var textColumns = [2, 3, 4];
                    if (jQuery.inArray(colIndex, excludeColumns) !== -1)
                        return;

                    if (jQuery.inArray(colIndex, textColumns) !== -1) {

                        var mainDiv = $('<div>', {
                            'class': 'cb-textBox-wrap'
                        }).appendTo($(column.header()));

                        let input = $('<input placeholder="Search" class="form-control">');
                        input.className = "";
                        input.type = "text";
                        mainDiv.append(input);

                        input.on('keyup', () => {
                            if (column.search() !== this.value) {
                                column.search(input.val()).draw();
                            }
                        });
                        return;

                    }

                    var ddmenu = cbDropdown($(column.header()))
                        .on('change', ':checkbox', function() {
                            var active;
                            var vals = $(':checked', ddmenu).map(function(index,
                                element) {
                                active = true;
                                return $.fn.dataTable.util.escapeRegex($(
                                    element).val());
                            }).toArray().join('|');

                            column
                                .search(vals.length > 0 ? '^(' + vals + ')$' : '', true,
                                    false)
                                .draw();

                            // Highlight the current item if selected.
                            if (this.checked) {
                                $(this).closest('li').addClass('active');
                            } else {
                                $(this).closest('li').removeClass('active');
                            }

                            // Highlight the current filter if selected.
                            var active2 = ddmenu.parent().is('.active');
                            if (active && !active2) {
                                ddmenu.parent().addClass('active');
                            } else if (!active && active2) {
                                ddmenu.parent().removeClass('active');
                            }
                        });

                    column.data().unique().sort().each(function(d, j) {
                        var
                            $label = $('<label>'),
                            $text = $('<span>', {
                                text: d
                            }),
                            $cb = $('<input>', {
                                type: 'checkbox',
                                value: d
                            });

                        $text.appendTo($label);
                        $cb.appendTo($label);


                        ddmenu.append($('<li>').append($label));
                    });
                });
            },
            "columnDefs": [{
                "targets": 0,
                "orderable": true
            }]
        });



        $(".selectAll").on("click", function(event) {
            var isChecked = $(this).is(":checked");
            $("#datatable3 tbody input[type='checkbox']").prop("checked", isChecked);
        });


        $('#resetButton').click(function() {
            $('#ProductAddForm input, #ProductAddForm select, #ProductAddForm textarea').val('');
            $('#ProductAddForm .error').text('');
            $('#image-preview').html('');
            $('#ProductAddForm input[type="file"]').val('');
            $('#ProductAddForm .selectpicker').selectpicker('val', '');
        });
    });


    $(document).ready(function() {
        $('.repeater-default').repeater({
            show: function() {
                $(this).slideDown();
                updateFieldIds($(this));
            },
            hide: function(deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            },
        });



        function updateFieldIds(row) {
            var rowIndex = row.index() + 1;
            row.find('[id]').each(function() {
                var currentId = $(this).attr('id');
                var newId = currentId + rowIndex;
                $(this).attr('id', newId);
            });
        }

        $('#addNewModal .selectshops').each(function() {
            var $p = $(this).parent();
            $(this).select2({
                dropdownParent: $p
            });
        });


    });







    var fileArrs = [];
    var totalFiless = 0;

    $("#s_photo").change(function(event) {
        //$('#image-preview').html('');
        var totalFileCount = $(this)[0].files.length;

        for (var i = 0; i < totalFileCount; i++) {
            var file = $(this)[0].files[i];

            if (file.size > 3145728) {
                alert('File size exceeds the limit of 3MB');
                $(this).val('');
                $('#image-preview').html('');
                return;
            }

            fileArrs.push(file);
            totalFiless++;
            if (totalFiless > 1) {
                alert('Maximum 1 images allowed');
                $(this).val('');
                $('#image-preview').html('');
                totalFiless = 0;
                fileArrs = [];
                return;
            }


            var reader = new FileReader();
            reader.onload = (function(file) {
                return function(event) {
                    var imgDiv = $('<div>').addClass('img-div col-md-3 img-container');
                    var img = $('<img>').attr('src', event.target.result).addClass(
                        'img-responsive image new_thumpnail').attr('width', '100');
                    var removeBtn = $('<button>').addClass('btn btn-danger remove-btns').attr(
                        'title', 'Remove Image').append('Remove').attr('role', file.name);

                    imgDiv.append(img);
                    imgDiv.append($('<div>').addClass('middle').append(removeBtn));
                    if (fileArrs.length > 0)
                        $('#image-preview').append(imgDiv);
                };
            })(file);

            reader.readAsDataURL(file);
        }
        document.getElementById('s_photo').files = new FileListItem([]);
        document.getElementById('s_photo').files = new FileListItem(fileArrs);

    });

    $(document).on('click', '.remove-btns', function() {
        var fileName = $(this).attr('role');

        for (var i = 0; i < fileArrs.length; i++) {
            if (fileArrs[i].name === fileName) {
                fileArrs.splice(i, 1);
                totalFiless--;
                break;
            }
        }

        document.getElementById('s_photo').files = new FileListItem(fileArrs);
        $(this).closest('.img-div').remove();
    });




    function FileListItem(file) {
        file = [].slice.call(Array.isArray(file) ? file : arguments);
        var b = file.length;
        var d = true;
        for (var c; b-- && d;) {
            d = file[b] instanceof File;
        }
        if (!d) {
            throw new TypeError('Expected argument to FileList is File or array of File objects');
        }
        var clipboardData = new ClipboardEvent('').clipboardData || new DataTransfer();
        for (b = d = file.length; b--;) {
            clipboardData.items.add(file[b]);
        }
        return clipboardData.files;
    }





    $("#ProductAddForm").validate({

        rules: {
            shop_name: {
                required: true,
            },
            prod_name: {
                required: true,
            },
            prod_description: {
                required: true,
            },
            customRadio: {
                required: true,
            },
            setavailbledate: "required",
            setavailblefromdate: {
                required: function() {
                    return $("#setavailbledate").val() !== '';
                },
                date: true
            },
            setavailbletodate: {
                required: function() {
                    return $("#setavailbledate").val() !== '';
                },
                date: true
            },
            "notavailabledate_data[][setavailblesingledate]": {
                required: function() {
                    return $("#isnotavailable").is(":checked");
                },
                date: true
            },
            setquestion: "required",

        },
        messages: {
            shop_name: {
                required: "Please select shop name",
            },
            prod_name: {
                required: "Please enter services name",
            },
            prod_description: {
                required: "Please enter service description",
            },
            customRadio: {
                required: "Please select attribute",
            },
            setavailbledate: "Availability date is mandatory.",
            setavailblefromdate: {
                required: "From date is mandatory when Set Availability Dates is selected.",
                date: "Please enter a valid date."
            },
            setavailbletodate: {
                required: "To date is mandatory when Set Availability Dates is selected.",
                date: "Please enter a valid date."
            },
            "notavailabledate_data[][setavailblesingledate]": {
                required: "Not available date is mandatory if not available.",
                date: "Please enter a valid date."
            },
            setquestion: "Question for the customer is mandatory.",
            //service_type_id: "Service Required is mandatory."

        },
        errorPlacement: function(error, element) {
            if (element.attr("name") === "notavailabledate_data[][setavailblesingledate]") {
                if ($("#isnotavailable").is(":checked") && $("[name^='notavailabledate_data[']").length >
                    0) {
                    error.insertAfter(element.closest(".form-group"));
                }
            } else {
                error.insertAfter(element);
            }
        }
    });


    $.validator.addMethod('maxSize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param);
    }, 'File size must be less than {0} KB');


    $('#ProductAddForm').submit(function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            $.ajax({
                url: '{{ route('AdmNewServiceAdd') }}',
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {


                    if (response.result == 1) {
                        $('#productsub-message').text(response.mesge).fadeIn();
                        $('#productsub-message').addClass('success-message');
                        $('#image-preview').empty();
                        setTimeout(function() {
                            $('#productsub-message').fadeOut();
                        }, 5000);
                        $('#ProductAddForm')[0].reset();
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#addNewModal').modal('hide');
                        shwdets();
                    } else if (response.result == 2) {
                        $('#productsub-message').text(response.mesge).fadeIn();
                        $('#productsub-message').addClass('error');
                        setTimeout(function() {
                            $('#productsub-message').fadeOut();
                        }, 5000);
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#addNewModal').modal('show');

                    } else if (response.result == 3) {
                        $('#productsub-message').text(response.mesge).fadeIn();
                        $('#productsub-message').addClass('error');
                        setTimeout(function() {
                            $('#productsub-message').fadeOut();
                        }, 5000);
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#addNewModal').modal('show');

                    } else {
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                    }
                }
            });
        }
    });






















    $(document).ready(function() {

        function initializeTimepicker(element) {
            element.timepicker({
                showMeridian: true,
                defaultTime: '00:00 AM',
                minuteStep: 1,
                disableFocus: true,
                showInputs: false,
                format: 'hh:ii AA'
            });
        }

        initializeTimepicker($('.timepicker-input'));

        var repeater = $('.repeater-default-time');
        repeater.repeater({
            show: function() {
                var row = $(this);
                row.find('.day-select').val('Sunday');
                row.slideDown();
                updateFieldIdss(row);
                initializeTimepicker(row.find('.timepicker-input'));
            },
            hide: function(deleteElement) {
                if (confirm('Are you sure you want to delete this day time?')) {
                    $(this).slideUp(deleteElement);
                }
            },
        });

        $('#addSameTiming').on('click', function() {
            var firstDayTimingRow = repeater.find('[data-repeater-item]').first();
            var timing = {
                from: firstDayTimingRow.find('[id^="setfrom_time"]').val(),
                to: firstDayTimingRow.find('[id^="setto_time"]').val()
            };

            repeater.find('[data-repeater-item]').not(':first').each(function() {
                $(this).find('[id^="setfrom_time"]').val(timing.from);
                $(this).find('[id^="setto_time"]').val(timing.to);
            });
        });




        $("#setavailbledate").on("change", function() {
            var selectedValue = $(this).val();
            if (selectedValue === "1") {
                $("#dateFields").show();
            } else {
                $("#dateFields").hide();
            }
        });
        $("#isnotavailable").on("change", function() {
            if ($(this).is(":checked")) {
                $("#singleDateField").show();
            } else {
                $("#singleDateField").hide();
            }
        });

        $(document).on("change", "input[name^='notavailabledate_data'][name$='[setavailblesingledate]']",
            function() {
                var fromDateValue = new Date($("#setavailblefromdate").val());
                var toDateValue = new Date($("#setavailbletodate").val());
                var notAvailableDateValue = new Date($(this).val());
                var dateValidationMessage = $(this).closest('.form-group').find(".dateValidationMessage");

                if (!isNaN(notAvailableDateValue) &&
                    notAvailableDateValue >= fromDateValue &&
                    notAvailableDateValue <= toDateValue) {
                    dateValidationMessage.text("");
                } else {
                    dateValidationMessage.text(
                        "Not Available Date must be within the range of From Date and To Date.");
                    $(this).val("");
                }
            });


    });

    $('.repeater-default-date').repeater({
        show: function() {
            $(this).slideDown();
            updateFieldIdss($(this));
        },
        hide: function(deleteElement) {
            if (confirm('Are you sure you want to delete this not available date?')) {
                $(this).slideUp(deleteElement);
            }
        },
    });



    var maxQuestions = 7;
    $('.repeater-default-question').repeater({
        show: function() {
            var $list = $('[data-repeater-list="setquestion_data"]');
            var currentCount = $list.children('[data-repeater-item]').length;
            if (currentCount < maxQuestions) {
                $(this).slideDown();
                $list.find('[data-repeater-create]').trigger('click');

                currentCount = $list.children('[data-repeater-item]').length;
            } else {
                alert("You can add a maximum of 6 questions.");
            }

            updateFieldIdss($(this));
        },
        hide: function(deleteElement) {
            if (confirm('Are you sure you want to delete the question?')) {
                $(this).slideUp(deleteElement);
            }
        },
    });



    function updateFieldIdss(row) {
        var rowIndex = row.index() + 1;
        row.find('[id]').each(function() {
            var currentId = $(this).attr('id');
            var newId = currentId + rowIndex;
            $(this).attr('id', newId);
        });
    }
</script>
