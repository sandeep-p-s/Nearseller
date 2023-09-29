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
                                <h4 class="page-title">Add Employee</h4>
                            </div>

                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div> <!--end row-->

            <form method="POST" action="{{ route('store.service_employee') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Employee Name </label>
                                    <input type="text" class="form-control" id="employee_name"
                                        placeholder="Enter Employee Name" name="employee_name"
                                        value="{{ old('employee_name') }}">
                                    @error('employee_name')
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Employee ID</label>
                                    <input type="text" class="form-control" id="employee_id"
                                        placeholder="Enter employee id" name="employee_id" value="{{ old('employee_id') }}">
                                    @error('employee_id')
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Designation/Skill</label>
                                    <input type="text" class="form-control" id="designation"
                                        placeholder="Enter Designation/Skill" name="designation"
                                        value="{{ old('designation') }}">
                                    @error('designation')
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Joining Date</label>
                                    <input type="date" class="form-control" id="exampleFormControlInput1"
                                        placeholder="Enter date" name="joining_date" value="{{ old('joining_date') }}">
                                    @error('joining_date')
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Aadhar Number</label>
                                    <input type="text" class="form-control" id="aadhar_no"
                                        placeholder="Enter aadhar number" name="aadhar_no" value="{{ old('aadhar_no') }}">
                                    @error('aadhar_no')
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Permanent Address</label>
                                    <textarea class="form-control" id="permanent_address" name="permanent_address" cols="5" rows="5">{{ old('permanent_address') }}</textarea>
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
                                            <option value="{{ $country->id }}" @if(old('country') == $country->id) selected @endif>{{ $country->country_name }}</option>
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
                                    </select>
                                    @error('state')
                                        <div class="text-danger mb-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">District</label>
                                    <select class="form-control" aria-label="Default select example" id="district"
                                        name="district">
                                    </select>
                                    @error('district')
                                        <div class="text-danger mb-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Pincode/Zipcode</label>
                                    <input type="text" class="form-control" id="pincode" placeholder="Enter pincode"
                                        name="pincode">
                                    @error('pincode')
                                        <div class="text-danger mb-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="horizontalCheckbox"
                                        data-parsley-multiple="groups" data-parsley-mincheck="2"
                                        onchange="copyPresentAddress()" name="is_same_permanent_address">
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
                                    <textarea class="form-control" id="present_address" name="present_address" cols="5" rows="5"></textarea>
                                    @error('present_address')
                                        <div class="text-danger mb-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Country</label>
                                    <select class="form-select form-control form-control-lg" name="present_country"
                                        aria-label="Default select example" id="present_country">
                                        <option value="">Select country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->country_name }}</option>
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
                                    </select>
                                    @error('present_state')
                                        <div class="text-danger mb-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">District</label>
                                    <select class="form-control" aria-label="Default select example"
                                        id="present_district" name="present_district">
                                    </select>
                                    @error('present_district')
                                        <div class="text-danger mb-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Pincode/Zipcode</label>
                                    <input type="text" class="form-control" id="present_pincode"
                                        placeholder="Enter pincode" name="present_pincode">
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
                                                        data-default-file="" name="image" id="image" />
                                                </div><!--end card-body-->
                                            </div><!--end card-->
                                        </div>
                                    </div>
                                    @error('image')
                                        <div class="text-danger mb-2">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="form-group mt10">
                                    <button type="submit" class="btn view_btn">Submit</button>

                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->

                    </div> <!--end col-->

                </div><!--end row-->

            </form>

            <!-- end page title end breadcrumb -->

        </div><!-- container -->

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
            });
        </script>
    @endsection
