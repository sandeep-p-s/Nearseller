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
                                <h4 class="page-title">Edit Employee</h4>
                            </div>
                            <div class="col-auto align-self-center">
                                <a href="{{ route('list.service_employee', $service_emp->user_id) }}" class="btn btn-danger">Back</a>
                            </div><!--end col-->

                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div> <!--end row-->

            <form method="POST" action="{{ route('update.service_employee', $service_emp->id) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                @php
                                    $shopshowhide = session('roleid') == 1 || session('roleid') == 3 ? 'style=display:block;' : 'style=display:none;';
                                @endphp
                                {{-- <div class="form-group" {{ $shopshowhide }} style="display: none;">
                                    <label for="service_name">Service User <span class="text-danger">*</span></label>
                                    <select class="selectservice form-select form-control form-control-lg"
                                        id="serviceuser_name" name="serviceuser_name" required tabindex="1">
                                        <option value="">Select Service User</option><br />
                                        @foreach ($userservicedets as $serviceuser)
                                                    <option value="{{ $serviceuser->id }}" @if ($serviceuser->id == $service_emp->user_id) selected @endif>{{ $serviceuser->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('serviceuser_name')
                                        <div class="text-danger mb-2">{{ $message }}</div>
                                    @enderror
                                </div> --}}

                                <input type="hidden" class="form-control" id="Serviceproviderid"
                                        placeholder="Service Provider Name" name="Serviceproviderid"
                                        value="{{ $service_emp->user_id }}" >


                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Employee Name </label>
                                    <input type="text" class="form-control" id="employee_name"
                                        placeholder="Enter Employee Name" name="employee_name"
                                        value="{{ $service_emp->employee_name }}" >
                                    @error('employee_name')
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Employee ID</label>
                                    <input type="text" class="form-control" id="employee_id"
                                        placeholder="Enter employee id" name="employee_id"
                                        value="{{ $service_emp->employee_id }}" readonly>
                                    @error('employee_id')
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Designation/Skill</label>
                                    <input type="text" class="form-control" id="designation"
                                        placeholder="Enter Designation/Skill" name="designation"
                                        value="{{ $service_emp->designation }}">
                                    @error('designation')
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Joining Date</label>
                                    <input type="date" class="form-control" id="joining_date" placeholder="Enter date"
                                        name="joining_date" value="{{ $service_emp->joining_date }}">
                                    @error('joining_date')
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Aadhar Number</label>
                                    <input type="text" class="form-control" id="aadhar_no"
                                        placeholder="Enter aadhar number" name="aadhar_no"
                                        value="{{ $service_emp->aadhar_no }}">
                                    @error('aadhar_no')
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Permanent Address</label>
                                    <textarea class="form-control" id="permanent_address" name="permanent_address" cols="5" rows="5">{{ $service_emp->permanent_address }}</textarea>
                                    @error('permanent_address')
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Country</label>
                                    <select class="form-select form-control form-control-lg" name="country"
                                        aria-label="Default select example" id="country">
                                        <option value="">Select country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"
                                                @if ($country->id == $service_emp->country) selected @endif>
                                                {{ $country->country_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                        <div class="text-danger mb-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">State</label>
                                    <select class="form-control" aria-label="Default select example" id="state"
                                        name="state">
                                        <option value="">Select State</option>
                                        @foreach ($states as $st)
                                            <option value="{{ $st->id }}"
                                                @if ($st->id == $service_emp->state) selected @endif>{{ $st->state_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('state')
                                        <div class="text-danger mb-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">District</label>
                                    <select class="form-control" aria-label="Default select example" id="district"
                                        name="district">
                                        <option value="">Select State</option>
                                        @foreach ($districts as $dt)
                                            <option value="{{ $dt->id }}"
                                                @if ($dt->id == $service_emp->district) selected @endif>{{ $dt->district_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('district')
                                        <div class="text-danger mb-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Pincode/Zipcode</label>
                                    <input type="text" class="form-control" id="pincode" placeholder="Enter pincode"
                                        name="pincode" value="{{ $service_emp->pincode }}">
                                    @error('pincode')
                                        <div class="text-danger mb-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="horizontalCheckbox"
                                        data-parsley-multiple="groups" data-parsley-mincheck="2"
                                        onchange="copyPresentAddress()" name="is_same_permanent_address" @if ($service_emp->is_same_permanent_address) checked @endif>
                                    <label class="custom-control-label" for="horizontalCheckbox">Permanent Address same as
                                        Present Address</label>
                                </div>


                            </div><!--end card-body-->
                        </div><!--end card-->

                    </div> <!--end col-->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Present Address</label>
                                    <textarea class="form-control" id="present_address" name="present_address" cols="5" rows="5"
                                        @if ($service_emp->permanentSameAsPresent) readonly @endif>{{ $service_emp->present_address }}</textarea>
                                </div>
                                @error('present_address')
                                    <div class="text-danger mb-2">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Country</label>
                                    <select class="form-select form-control form-control-lg" name="present_country"
                                        aria-label="Default select example" id="present_country">
                                        <option value="">Select country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"
                                                @if ($country->id == $service_emp->present_country) selected @endif>
                                                {{ $country->country_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('present_country')
                                        <div class="text-danger mb-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">State</label>
                                    <select class="form-control" name="present_state" aria-label="Default select example"
                                        id="present_state">
                                        <option value="">Select State</option>
                                        @foreach ($states as $st)
                                            <option value="{{ $st->id }}"
                                                @if ($st->id == $service_emp->present_state) selected @endif>{{ $st->state_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('present_state')
                                        <div class="text-danger mb-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">District</label>
                                    <select class="form-control" aria-label="Default select example"
                                        id="present_district" name="present_district">
                                        <option value="">Select District</option>
                                        @foreach ($districts as $dt)
                                            <option value="{{ $dt->id }}"
                                                @if ($dt->id == $service_emp->present_district) selected @endif>{{ $dt->district_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('present_district')
                                        <div class="text-danger mb-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Pincode/Zipcode</label>
                                    <input type="text" class="form-control" id="present_pincode"
                                        placeholder="Enter pincode" name="present_pincode"
                                        value="{{ $service_emp->present_pincode }}">
                                    @error('present_pincode')
                                        <div class="text-danger mb-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Upload Image</label>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="card">
                                                <!--end card-header-->
                                                <div class="card-body">
                                                    <input type="file" id="input-file-now-custom-3" class="dropify"
                                                        data-default-file="{{ asset('uploads/service_employee/' . $service_emp->image) }}"
                                                        name="image" id="image" />

                                                </div><!--end card-body-->
                                            </div><!--end card-->
                                        </div>
                                    </div>
                                    {{-- @error('image')
                                        <div class="text-danger mb-2">{{ $message }}</div>
                                    @enderror --}}
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Status</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="status">
                                        <option value="select">Select</option>
                                        <option value="Active" @if($service_emp->status === 'Y') selected @endif>Active</option>
                                        <option value="Inactive" @if($service_emp->status === 'N') selected @endif>Inactive</option>
                                    </select>
                                </div>

                                <div class="form-group mt10">
                                    <button type="submit" class="btn view_btn">Update</button>

                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->

                    </div> <!--end col-->

                </div><!--end row-->

            </form>

            <!-- end page title end breadcrumb -->

        </div><!-- container -->

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>

            function copyPresentAddress() {
                if ($('#horizontalCheckbox').is(':checked')) {
                    var permanentAddress = $('#permanent_address').val();
                    $('#present_address').val(permanentAddress);

                    var country = $('#country').val();
                    $('#present_country').val(country);

                    var state = $('#state').val();
                    var district = $('#district').val();

                    fetchPresentStateAndDistrict(country, state, district);

                    var pincode = $('#pincode').val();
                    $('#present_pincode').val(pincode);
                } else {
                    $('#present_address').val('');
                    $('#present_country').val('');
                    $('#present_state').val('');
                    $('#present_district').val('');
                    $('#present_pincode').val('');
                }
            }


            function fetchPresentStateAndDistrict(countryId, selectedStateId, selectedDistrictId) {
                if (countryId) {
                    $.get("/getStates/" + countryId, function(data) {
                        $('#present_state').empty().append('<option value="">Select State</option>');
                        $.each(data, function(index, state) {
                            $('#present_state').append('<option value="' + state.id + '">' + state.state_name +
                                '</option>');
                        });

                        if (selectedStateId) {
                            $('#present_state').val(selectedStateId);
                        }

                        fetchPresentDistrict($('#present_state').val(), selectedDistrictId);
                    });
                }
            }

            function fetchPresentDistrict(stateId, selectedDistrictId) {
                if (stateId) {
                    $.get("/getDistricts/" + stateId, function(data) {
                        var presentDistrictDropdown = $('#present_district');
                        presentDistrictDropdown.empty().append('<option value="">Select District</option>');
                        $.each(data, function(index, district) {
                            presentDistrictDropdown.append($('<option>', {
                                value: district.id,
                                text: district.district_name
                            }));
                        });

                        if (selectedDistrictId) {
                            presentDistrictDropdown.val(selectedDistrictId);
                        }
                    });
                }
            }

            $(document).ready(function() {
                $('#country').change(function() {
                    $('#district').empty();
                    var countryId = $(this).val();
                    if (countryId) {
                        $.get("/getStates/" + countryId, function(data) {
                            $('#state').empty().append('<option value="">Select State</option>');
                            $.each(data, function(index, state) {
                                $('#state').append('<option value="' + state.id + '">' + state
                                    .state_name + '</option>');
                            });
                        });
                    }
                });

                $('#state').change(function() {
                    var stateId = $(this).val();
                    if (stateId) {
                        $.get("/getDistricts/" + stateId, function(data) {
                            $('#district').empty().append('<option value="">Select District</option>');
                            $.each(data, function(index, district) {
                                $('#district').append('<option value="' + district.id + '">' +
                                    district.district_name + '</option>');
                            });
                        });
                    }
                });

                $('#present_country').change(function() {
                    var countryId = $(this).val();
                    if (countryId) {
                        fetchPresentStateAndDistrict(countryId, null,
                            null);
                    }
                });

                $('#present_state').change(function() {
                    var stateId = $(this).val();
                    if (stateId) {
                        fetchPresentDistrict(stateId, null);
                    }
                });
                $('.selectservice').each(function() {
                    var $p = $(this).parent();
                    $(this).select2({
                        dropdownParent: $p
                    });
                });
            });
        </script>
    @endsection
