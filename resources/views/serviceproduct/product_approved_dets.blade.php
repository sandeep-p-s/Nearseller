<form id="ProductRegFormApproved" enctype="multipart/form-data" method="POST">
    <input type="hidden" id="serprod_ids" name="serprod_ids" class="form-control" placeholder="Service ID"
        value="{{ $ServiceDetails->id }}" />
    <div class="row">

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    @php
                        $shopshowhide = session('roleid') == 1 || session('roleid') == 11 || session('roleid') == 3 ? 'style=display:block;' : 'style=display:none;';
                    @endphp


                    <div class="form-group d-none"><label>Service Provider Name<span
                                class="text-danger">*</span></label>
                        <input type="hidden" id="serviceprovider" name="serviceprovider" required tabindex="1"
                            value="{{ $ServiceDetails->service_provider_id }}">
                        <label for="shop_name" class="error"></label>
                    </div>


                    <div class="form-group"><label>Service Name<span class="text-danger">*</span></label>
                        <input type="text" id="prod_names" name="prod_names" class="form-control" maxlength="60"
                            placeholder="Service Name" required tabindex="1"
                            value="{{ $ServiceDetails->service_name }}" />
                        <label for="prod_names" class="error"></label>
                    </div>

                    <div class="form-outline mb-3"><label>Service Images<span class="text-danger">*</span></label>
                        <input type="file" id="s_photos" name="s_photos[]" class="form-control form-control-lg"
                            placeholder="Service Photo" tabindex="19" accept="image/jpeg, image/png" />
                        <label for="s_photos" class="error"></label>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" align="left">
                            <div id="image-previews" class="row"></div>
                        </div>
                    </div>



                    <div class="col-md-12"
                        style="{{ $ServiceDetails->service_images ? 'display: block;' : 'display: none;' }}">
                        <div class="form-group" align="center">
                            <div class="row">@php
                                $k = 1;
                            @endphp

                                <div class="col-md-3">
                                    <a href="#" data-toggle="modal" data-target="#myModalmm{{ $k }}">
                                        <img id="img-bufferms" class="img-responsive image new_thumpnail"
                                            src="{{ asset($ServiceDetails->service_images) }}" width="450"
                                            height="250">
                                        @php

                                            $valenl = $ServiceDetails->service_images . '#' . $ServiceDetails->id;
                                            $deleencdel = base64_encode($valenl);
                                        @endphp
                                    </a>
                                </div>

                                <div class="modal fade" id="myModalmm{{ $k }}" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabelmm" aria-hidden="true" style="width: 80%;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{ asset($ServiceDetails->service_images) }}"
                                                    class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>




                    <div class="form-group d-none"><label>Set Availability Dates<span
                                class="text-danger">*</span></label>
                        <select class="form-select form-control form-control-lg" id="setavailbledates"
                            name="setavailbledates" required tabindex="1">
                            <option value="{{ $ServiceAppointment->is_setdates }}"
                                @if ($ServiceAppointment->is_setdates == 1) selected @endif>Avialability Date</option><br />
                        </select>
                        <label for="setavailbledates" class="error"></label>
                    </div>
                    <div class="form-group"><label>Set Availability Dates<span class="text-danger">*</span></label>
                    </div>
                    {{-- style="display: {{ $ServiceAppointment->is_setdates == 1 ? 'block' : 'none' }};" --}}
                    <div class="form-group" id="dateFieldss">
                        <div class="input-group">
                            <div class="col-lg-5">
                                <label for="setavailblefromdates">From Date</label>
                                <input type="date" class="form-control form-control-lg" id="setavailblefromdates"
                                    name="setavailblefromdates" required tabindex="2"
                                    value="{{ $ServiceAppointment->available_from_date }}">
                            </div>
                            <div class="col-lg-4">
                                <label for="setavailbletodates">To Date</label>
                                <input type="date" class="form-control form-control-lg" id="setavailbletodates"
                                    name="setavailbletodates" required tabindex="3"
                                    value="{{ $ServiceAppointment->available_to_date }}">
                            </div>
                            <div class="col-lg-3"><label for="isnotavailables">Not Available</label>
                                <input class="form-control" type="checkbox" id="isnotavailables"
                                    name="isnotavailables" value="{{ $ServiceAppointment->is_not_available }}"
                                    style="width: 10%;"
                                    {{ $ServiceAppointment->is_not_available == 1 ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="singleDateFields"
                        style="{{ $ServiceAppointment->is_not_available == 1 ? 'block' : 'none' }};">
                        <fieldset>
                            <div class="repeater-default-dates">
                                <div data-repeater-list="notavailabledate_datas">
                                    <!-- Heading Row -->
                                    <div class="form-group row">
                                        <div class="col">
                                            <label class="control-label"> Not Available Date </label>
                                        </div>
                                    </div>
                                    <!-- Dynamic Rows -->
                                    @php
                                        $countnotavailabledates = count($notavailabledates);
                                    @endphp
                                    @if ($countnotavailabledates > 0)
                                        @foreach ($notavailabledates as $notavaildate)
                                            <div data-repeater-item="">
                                                <div class="form-group row d-flex align-items-end">
                                                    <div class="col">
                                                        <input type="date" class="form-control form-control-lg"
                                                            name="setavailblesingledates" tabindex="4"
                                                            value="{{ $notavaildate->not_available_date }}">
                                                        <div class="dateValidationMessages" style="color: red;"></div>
                                                    </div>
                                                    <div class="col">
                                                        <span data-repeater-delete="" class="btn btn-danger btn-sm">
                                                            <span class="far fa-trash-alt mr-1"></span> Delete
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    <div data-repeater-item="" id="notavailbledate_no" style="display: none;">
                                        <div class="form-group row d-flex align-items-end">
                                            <div class="col">
                                                <input type="date" class="form-control form-control-lg"
                                                    name="setavailblesingledates" tabindex="4">
                                                <div class="dateValidationMessages" style="color: red;"></div>
                                            </div>
                                            <div class="col">
                                                <span data-repeater-delete="" class="btn btn-danger btn-sm">
                                                    <span class="far fa-trash-alt mr-1"></span> Delete
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-0 row">
                                    <div class="col-sm-12 text-right">
                                        <span data-repeater-create="" class="btn btn-secondary btn-sm">
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
                        <label>Service Description <span class="text-danger"></span></label>
                        <textarea id="prod_descriptions" name="prod_descriptions" placeholder="Service Description" class="form-control"
                            maxlength="7000" tabindex="4"  rows="3">{{ $ServiceDetails->service_description }}</textarea>
                        <label for="prod_descriptions"></label>
                    </div>

                    <div class="form-group">
                        <fieldset>
                            <div class="repeater-default-questions">
                                <div data-repeater-list="setquestion_datas">
                                    <!-- Heading Row -->
                                    <div class="form-group row">
                                        <div class="col">
                                            <label class="control-label"> Set Question for Customer
                                            </label>
                                        </div>
                                    </div>
                                    <!-- Dynamic Rows -->
                                    @php
                                        $countsetquestions = count($setquestions);
                                    @endphp
                                    @if ($countsetquestions > 0)
                                        @foreach ($setquestions as $setqustn)
                                            <div data-repeater-item="">
                                                <div class="form-group row d-flex align-items-end">

                                                    <div class="col">
                                                        <textarea id="setquestions" name="setquestions" placeholder="Set Question" class="form-control" maxlength="250"
                                                            tabindex="6">{{ $setqustn->questions }}</textarea>
                                                        <label for="setquestions"></label>
                                                    </div>

                                                    <div class="col">
                                                        <span data-repeater-delete="" class="btn btn-danger btn-sm">
                                                            <span class="far fa-trash-alt mr-1"></span> Delete
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    <div data-repeater-item="" id="setquestion_no" style="display: none;">
                                        <div class="form-group row d-flex align-items-end">

                                            <div class="col">
                                                <textarea id="setquestions" name="setquestions" placeholder="Set Question" class="form-control" maxlength="250"
                                                    tabindex="6"></textarea>
                                                <label for="setquestions"></label>
                                            </div>

                                            <div class="col">
                                                <span data-repeater-delete="" class="btn btn-danger btn-sm">
                                                    <span class="far fa-trash-alt mr-1"></span> Delete
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group mb-0 row">
                                    <div class="col-sm-12 text-right">
                                        <span data-repeater-create="" class="btn btn-secondary btn-sm">
                                            <span class="fas fa-plus"></span> Add New Question
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <div class="form-group"><label>Suggestions</label>
                        <textarea id="sugections" name="sugections" placeholder="Suggestions" class="form-control" maxlength="500"
                            tabindex="6">{{ $ServiceAppointment->suggestion }}</textarea>
                        <label for="sugections" class="error"></label>
                    </div>

                    @php
                        $servicepoint = $ServiceAppointment->service_point;
                        $explodeservice = explode(',', $servicepoint);
                        $servicepointa = $explodeservice[0];
                        $servicepointb = $explodeservice[1];
                    @endphp



                    {{--  <div class="form-group mb-0 row">
                        <label class="col-md-3">Service Point </label>
                        <div class="col-md-9">
                            <div class="form-group">

                                <div class="form-check form-check-inline">
                                    <input class="form-control" type="checkbox" id="servicepointa"
                                        name="servicepointa" value="1"
                                        {{ $servicepointa == 1 ? 'checked' : '' }} style="width: 18%;">
                                    <label class="form-check-label" for="servicepointa">At
                                        Home</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-control" type="checkbox" id="servicepointb"
                                        name="servicepointb" value="1"
                                        {{ $servicepointb == 1 ? 'checked' : '' }} style="width: 19%;">
                                    <label class="form-check-label" for="servicepointb">At
                                        Shop</label>
                                </div>
                            </div>
                        </div>
                    </div>  --}}

                    <div class="form-group mb-0 row">
                        <label class="col-md-3 my-2 control-label">Service Point </label>
                        <div class="col-md-9">

                            <div class="form-check-inline my-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck6" name="servicepoint1" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                    <label class="custom-control-label" for="customCheck6">At Customer Location</label>
                                </div>
                            </div>
                            <div class="form-check-inline my-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck7" name="servicepoint2" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                    <label class="custom-control-label" for="customCheck7">At Service Provider Location</label>
                                </div>
                            </div>
                           
                        </div>
                    </div><!--end row--> 







                    <div class="form-group"><label>Service Status</label>
                        <select class="form-select form-control form-control-lg" name="productstatus"
                            id="productstatus" required tabindex="6">
                            <option value="">Select</option>
                            <option value="Y" @if ($ServiceDetails->service_status == 'Y') selected @endif>Available</option>
                            <option value="N" @if ($ServiceDetails->service_status == 'N') selected @endif>Not Available
                            </option>
                        </select>

                    </div>

                    <div class="form-group"><label>Approval Status</label>
                        <select class="form-select form-control form-control-lg" name="productapproval"
                            id="productapproval" required tabindex="6">
                            <option value="">Select</option>
                            <option value="Y" @if ($ServiceDetails->is_approved == 'Y') selected @endif>Approved</option>
                            <option value="N" @if ($ServiceDetails->is_approved == 'N') selected @endif>Not Approved
                            </option>
                            <option value="R" @if ($ServiceDetails->is_approved == 'R') selected @endif>Rejected</option>
                        </select>

                    </div>




                    <div class="col-md-12">
                        <div id="product_gal-message" class="text-center" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>





        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <fieldset>
                            <div class="repeater-default-times">
                                <div data-repeater-list="availabletime_datas">
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
                                    @php
                                        $countavialabletime = count($appointmentavailable);
                                    @endphp
                                    @if ($countavialabletime > 0)

                                        @foreach ($appointmentavailable as $availdatetime)
                                            <div data-repeater-item="">
                                                <div class="form-group row d-flex align-items-end">
                                                    <div class="col-md-2">
                                                        <input class="form-control" type="checkbox"
                                                            id="settimestatuss" name="settimestatuss" value="1"
                                                            style="width: 7%;"
                                                            {{ $availdatetime->is_set_time == 1 ? 'checked' : '' }}>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <select class="form-control" id="service_employe_ids"
                                                            name="service_employe_ids" tabindex="1">
                                                            <option value="">Select Employee</option><br />
                                                            @foreach ($serviceemployees as $emplye)
                                                                <option value="{{ $emplye->id }}"
                                                                    @if ($emplye->id == $availdatetime->employee_id) {{ 'selected' }} @endif>
                                                                    {{ $emplye->employee_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <select id="setdayss" name="setdayss"
                                                            class="day-select form-control">
                                                            <option value="0">Days</option>
                                                            <option value="Sunday"
                                                                @if ($availdatetime->appt_days == 'Sunday') selected @endif>
                                                                Sunday
                                                            </option>
                                                            <option value="Monday"
                                                                @if ($availdatetime->appt_days == 'Monday') selected @endif>
                                                                Monday
                                                            </option>
                                                            <option value="Tuesday"
                                                                @if ($availdatetime->appt_days == 'Tuesday') selected @endif>
                                                                Tuesday
                                                            </option>
                                                            <option value="Wednesday"
                                                                @if ($availdatetime->appt_days == 'Wednesday') selected @endif>
                                                                Wednesday
                                                            </option>
                                                            <option value="Thursday"
                                                                @if ($availdatetime->appt_days == 'Thursday') selected @endif>
                                                                Thursday
                                                            </option>
                                                            <option value="Friday"
                                                                @if ($availdatetime->appt_days == 'Friday') selected @endif>
                                                                Friday
                                                            </option>
                                                            <option value="Saturday"
                                                                @if ($availdatetime->appt_days == 'Saturday') selected @endif>
                                                                Saturday
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" id="setfrom_times" name="setfrom_times"
                                                            class="form-control timepicker-input"
                                                            value="{{ $availdatetime->from_time }}">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" id="setto_times" name="setto_times"
                                                            class="form-control timepicker-input"
                                                            value="{{ $availdatetime->to_time }}">
                                                    </div>
                                                    <div class="col-md-1">
                                                        <input class="form-control" type="text" id="gracetimes"
                                                            name="gracetimes" maxlength="10"
                                                            value="{{ $availdatetime->grace_time }}">
                                                    </div>
                                                    <div class="col-md-1">
                                                        <span data-repeater-delete="" class="btn btn-danger btn-sm">
                                                            <span class="far fa-trash-alt mr-1"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                    <div data-repeater-item="" id="availabletime_no" style="display: none;">
                                        <div class="form-group row d-flex align-items-end">
                                            <div class="col">
                                                <input class="form-control" type="checkbox" id="settimestatuss"
                                                    name="settimestatuss" value="1" style="width: 7%;">
                                            </div>
                                            <div class="col">
                                                <select class="form-control" id="service_employe_ids"
                                                    name="service_employe_ids">
                                                    <option value="">Select Employee</option><br />
                                                    @foreach ($serviceemployees as $emplye)
                                                        <option value="{{ $emplye->id }}">
                                                            {{ $emplye->employee_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <select id="setdayss" name="setdayss"
                                                    class="day-select form-control">
                                                    <option value="0">Days</option>
                                                    <option value="Sunday">Sunday</option>
                                                    <option value="Monday">Monday</option>
                                                    <option value="Tuesday">Tuesday</option>
                                                    <option value="Wednesday">Wednesday</option>
                                                    <option value="Thursday">Thursday</option>
                                                    <option value="Friday">Friday</option>
                                                    <option value="Saturday">Saturday</option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <input type="text" id="setfrom_times" name="setfrom_times"
                                                    class="form-control timepicker-input" value="">
                                            </div>
                                            <div class="col">
                                                <input type="text" id="setto_times" name="setto_times"
                                                    class="form-control timepicker-input" value="">
                                            </div>
                                            <div class="col">
                                                <input class="form-control" type="text" id="gracetimes"
                                                    name="gracetimes" maxlength="10" value="">
                                            </div>
                                            <div class="col">
                                                <span data-repeater-delete="" class="btn btn-danger btn-sm">
                                                    <span class="far fa-trash-alt mr-1"></span> Delete
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-0 row">
                                    <div class="col-sm-12 text-right">
                                        <span data-repeater-create="" class="btn btn-secondary btn-sm">
                                            <span class="fas fa-plus"></span> Add New Time
                                        </span>
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
                        {{--  <div class="form-group mb-0 row">
                            <label class="col-md-6 my-1 control-label">Do you want to select
                                attributes?</label>
                            <div class="col-md-6">
                                <div class="form-check-inline my-1">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="yesChecks" name="customRadios"
                                            class="custom-control-input" onclick="javascript:yesnoChecks();"
                                            tabindex="14" value="Y"
                                            {{ $ServiceDetails->is_attribute === 'Y' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="yesChecks">Yes</label>
                                    </div>
                                </div>
                                <div class="form-check-inline my-1">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="noChecks" name="customRadios"
                                            class="custom-control-input" onclick="javascript:yesnoChecks();"
                                            tabindex="15" value="N"
                                            {{ $ServiceDetails->is_attribute === 'N' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="noChecks">No</label>
                                    </div>
                                </div>

                            </div>
                        </div>  --}}
                        {{--  <hr>  --}}

                        <div id="ifYess"
                            {{--  style="display: {{ $ServiceDetails->is_attribute == 'Y' ? 'block' : 'none' }};">  --}}
                            <fieldset>
                                <div class="repeater-defaults">
                                    <div data-repeater-list="attributedatas">
                                        <!-- Heading Row -->
                                        <div class="form-group row">
                                            <div class="col">
                                                <label class="control-label"> Show status </label>
                                            </div>
                                        </div>
                                        <!-- Dynamic Rows -->
                                        @foreach ($productAttibutes as $attribte)
                                            <div data-repeater-item="">
                                                <div class="form-group row d-flex align-items-end">
                                                    <div class="col">
                                                        <input class="form-control" type="checkbox"
                                                            id="stockstatuss1" name="stockstatuss1" value="1"
                                                            style="width: 10%;"
                                                            {{ $attribte->show_status == 1 ? 'checked' : '' }}>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" id="attatibutes1" name="attatibutes1"
                                                            placeholder="Attribute1" class="form-control" 
                                                            value="{{ $attribte->attribute_1 }}">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" id="attatibutes2" name="attatibutes2"
                                                            placeholder="Attribute2" class="form-control" 
                                                            value="{{ $attribte->attribute_2 }}">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" id="attatibutes3" name="attatibutes3"
                                                            placeholder="Attribute3" class="form-control" 
                                                            value="{{ $attribte->attribute_3 }}">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" id="attatibutes4" name="attatibutes4"
                                                            placeholder="Attribute4" class="form-control"
                                                            value="{{ $attribte->attribute_4 }}">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" id="offerprices1" name="offerprices1"
                                                            maxlength="10" placeholder="Offer Price"
                                                            class="form-control" oninput="numberOnlyAllowedDot(this)"
                                                            value="{{ $attribte->offer_price }}">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" id="mrprices1" name="mrprices1"
                                                            maxlength="10" placeholder="MRP" class="form-control"
                                                            oninput="numberOnlyAllowedDot(this)"
                                                            value="{{ $attribte->mrp_price }}">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" id="attr_calshops1"
                                                            name="attr_calshops1" maxlength="10"
                                                            placeholder="Call Shop" class="form-control"
                                                            oninput="numberOnlyAllowed(this)"
                                                            value="{{ $attribte->call_shop }}">
                                                    </div>
                                                    <div class="col">
                                                        <span data-repeater-delete="" class="btn btn-danger btn-sm">
                                                            <span class="far fa-trash-alt mr-1"></span> Delete
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div data-repeater-item="" id="attribute_no" style="display: none;">
                                            <div class="form-group row d-flex align-items-end">
                                                <div class="col">
                                                    <input class="form-control" type="checkbox" id="stockstatuss1"
                                                        name="stockstatuss1" value="1" style="width: 10%;">
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="attatibutes1" name="attatibutes1"
                                                        placeholder="Attribute" class="form-control"  />
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="attatibutes2" name="attatibutes2"
                                                        placeholder="Attribute" class="form-control" />
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="attatibutes3" name="attatibutes3"
                                                        placeholder="Attribute" class="form-control" />
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="attatibutes4" name="attatibutes4"
                                                        placeholder="Attribute" class="form-control" />
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="offerprices1" name="offerprices1"
                                                        maxlength="10" placeholder="Offer Price" class="form-control"
                                                        oninput="numberOnlyAllowedDot(this)" />
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="mrprices1" name="mrprices1"
                                                        maxlength="10" placeholder="MRP" class="form-control"
                                                        oninput="numberOnlyAllowedDot(this)" />
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="attr_calshops1" name="attr_calshops1"
                                                        maxlength="10" placeholder="Call Shop" class="form-control"
                                                        oninput="numberOnlyAllowed(this)" />
                                                </div>
                                                <div class="col">
                                                    <span data-repeater-delete="" class="btn btn-danger btn-sm">
                                                        <span class="far fa-trash-alt mr-1"></span> Delete
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0 row">
                                        <div class="col-sm-12  text-right">
                                            <span data-repeater-create="" class="btn btn-secondary btn-sm">
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>


        <div class="col-md-12">
            <div id="productapproved-message" class="text-center" style="display: none;"></div>
        </div>



</form>




<script>
    $(document).ready(function() {

        function initializeTimepicker() {
            // Select all elements with the class '.timepicker-input' and initialize timepicker
            $('.timepicker-input').timepicker({
                showMeridian: true,
                defaultTime: '00:00 AM',
                minuteStep: 1,
                disableFocus: true,
                showInputs: false,
                format: 'hh:ii AA'
            });
        }

        // Initialize timepicker for the initial row
        initializeTimepicker();

        $('.repeater-default-times').repeater({
            show: function() {
                $(this).find('.day-select').val('Sunday');
                $(this).slideDown();
                updateFieldIdss($(this));

                // Initialize timepicker for the new row
                $(this).find('.timepicker-input').timepicker({
                    showMeridian: true,
                    defaultTime: '00:00 AM',
                    minuteStep: 1,
                    disableFocus: true,
                    showInputs: false,
                    format: 'hh:ii AA'
                });
            },
            hide: function(deleteElement) {
                if (confirm('Are you sure you want to delete this day time?')) {
                    $(this).slideUp(deleteElement);
                }
            },
        });



        $("#setavailbledates").on("change", function() {
            var selectedValue = $(this).val();
            if (selectedValue === "1") {
                $("#dateFieldss").show();
            } else {
                $("#dateFieldss").hide();
            }
        });
        $("#isnotavailables").on("change", function() {
            if ($(this).is(":checked")) {
                $("#singleDateFields").show();
            } else {
                $("#singleDateFields").hide();
            }
        });

        $(document).on("change", "input[name^='notavailabledate_datas'][name$='[setavailblesingledates]']",
            function() {
                var fromDateValue = new Date($("#setavailblefromdates").val());
                var toDateValue = new Date($("#setavailbletodates").val());
                var notAvailableDateValue = new Date($(this).val());
                var dateValidationMessage = $(this).closest('.form-group').find(".dateValidationMessages");

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

    $('.repeater-default-dates').repeater({
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


    $('.repeater-defaults').repeater({
        show: function() {
            $(this).slideDown();
            updateFieldIdss($(this));
        },
        hide: function(deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
            }
        },
    });






    var maxQuestions = 8;
    $('.repeater-default-questions').repeater({
        show: function() {
            var $list = $('[data-repeater-list="setquestion_datas"]');
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



    function yesnoChecks() {
        if (document.getElementById('yesChecks').checked) {
            document.getElementById('ifYess').style.display = 'block';
        } else {
            document.getElementById('ifYess').style.display = 'none';
            $('#errorstocks-message').hide();
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




    var fileArrs = [];
    var totalFiless = 0;

    $("#s_photos").change(function(event) {
        //$('#image-preview').html('');
        var totalFileCount = $(this)[0].files.length;


        for (var i = 0; i < totalFileCount; i++) {
            var file = $(this)[0].files[i];

            if (file.size > 3145728) {
                alert('File size exceeds the limit of 3MB');
                $(this).val('');
                $('#image-previews').html('');
                return;
            }

            fileArrs.push(file);
            totalFiless++;
            if (totalFiless > 1) {
                alert('Maximum 1 images allowed');
                $(this).val('');
                $('#image-previews').html('');
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
                        $('#image-previews').append(imgDiv);
                };
            })(file);

            reader.readAsDataURL(file);
        }
        document.getElementById('s_photos').files = new FileListItem([]);
        document.getElementById('s_photos').files = new FileListItem(fileArrs);

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

        document.getElementById('s_photos').files = new FileListItem(fileArrs);
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



    $("#ProductRegFormApproved").validate({

        rules: {
            productapproval: {
                required: true,
            },

        },
        messages: {
            productapproval: {
                required: "Please select service approval."
            },

        },
    });

    $.validator.addMethod('maxSize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param);
    }, 'File size must be less than {0} KB');


    $('#ProductRegFormApproved').submit(function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            $.ajax({
                url: '{{ route('AdmApprovedservice') }}',
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
                        $('#productapproved-message').text(response.mesge).fadeIn();
                        $('#productapproved-message').addClass('success-message');
                        $('#image-previews').empty();
                        setTimeout(function() {
                            $('#productapproved-message').fadeOut();
                        }, 5000);
                        $('#ProductRegFormApproved')[0].reset();
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#ProductApprovedModal').modal('hide');
                        shwdets();
                    } else if (response.result == 2) {
                        $('#productapproved-message').text(response.mesge).fadeIn();
                        $('#productapproved-message').addClass('error');
                        setTimeout(function() {
                            $('#productapproved-message').fadeOut();
                        }, 5000);
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#ProductApprovedModal').modal('show');

                    } else if (response.result == 3 || response.result == 4) {
                        $('#productapproved-message').text(response.mesge).fadeIn();
                        $('#productapproved-message').addClass('error');
                        setTimeout(function() {
                            $('#productapproved-message').fadeOut();
                        }, 5000);
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#ProductApprovedModal').modal('show');

                    } else {
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                    }
                }
            });
        }
    });
</script>
