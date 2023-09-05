

@if($AffiliateCount > 0)
<table id="datatable" class="table table-striped table-bordered" >
        <thead>
            <tr>
                <th>SINO</th>
                <th>Reg. ID</th>
                <th>Shop Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Referral ID</th>
                {{-- <th>Address</th>
                <th>Business Type</th>
                <th>Service Type</th>
                <th>Executive Name</th>
                <th>Reg. Date</th> --}}
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($AffiliateDetails as $index => $AffDetails)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $AffDetails->affiliate_reg_id }}</td>
                    <td>{{ $AffDetails->name }}</td>
                    {{-- <td>{{ $sellerDetail->owner_name }}</td> --}}
                    <td>{{ $AffDetails->email }}</td>
                    <td>{{ $AffDetails->mob_no }}</td>
                    <td>{{ $AffDetails->referal_id }}</td>
                    {{-- <td>{{ $sellerDetail->house_name_no.','. $sellerDetail->locality.','. $sellerDetail->village.','.$sellerDetail->District->district_name.','.$sellerDetail->State->state_name.','. $sellerDetail->Country->country_name }}</td>
                    <td>{{ $sellerDetail->businessType->business_name }}</td>
                    <td>{{ $sellerDetail->serviceType->service_name }}</td>
                    <td>{{ $sellerDetail->executive->executive_name }}</td>
                    <td>{{ $sellerDetail->created_at }}</td> --}}
                    <td>
                        <div class="btn-group mb-2 mb-md-0">
                            <button type="button" class="btn view_btn dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                <i class="mdi mdi-chevron-down"></i></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item view_btn1" href="#" onclick="shopvieweditdet({{ $AffDetails->id }})">View/Edit</a>
                                <a class="dropdown-item approve_btn" href="#" onclick="shopapprovedet({{ $AffDetails->id }})">Approved</a>
                                <a class="dropdown-item delete_btn" href="#" onclick="shopdeletedet({{ $AffDetails->id }})">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <table>
        <tr><td colspan="13" align="center">
            <img src="{{ asset('backend/assets/images/notfoundimg.png') }}" alt="notfound" class="rounded-circle" style="width: 30%;" />
        </td></tr>
    </table>
@endif



<!-- Modal Add New -->
<div class="modal fade" id="addNewModal" tabindex="-1" aria-labelledby="addNewModalLabel" aria-hidden="true">
    <div class="modal-dialog custom-modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="addNewModalLabel">Add New Affiliate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Close">x</button>
            </div>
            <div class="modal-body">
                <form id="AffilateRegForm" enctype="multipart/form-data" method="POST">
                <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Affiliate Name</label>
                            <input type="text" id="a_name" name="a_name" class="form-control form-control-lg" maxlength="50"  placeholder="Affiliate Name" required  tabindex="1" />
                            <label for="a_name" class="error"></label>
                        </div>
                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Mobile Number</label>
                            <input type="text" id="a_mobno" name="a_mobno" class="form-control form-control-lg"  maxlength="10"  placeholder="Mobile No" required tabindex="3"  onchange="exstmobno(this.value,'3')" />
                            <label for="a_mobno" class="error"></label>
                            <div id="amob-message"  class="text-center" style="display: none;"></div>
                        </div>
                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Email ID</label>
                            <input type="email" id="a_email" name="a_email" class="form-control form-control-lg"  maxlength="35"  placeholder="Email ID" required tabindex="4"  onchange="exstemilid(this.value,'3')" />
                            <label for="a_email" class="error"></label>
                            <div id="semil-message"  class="text-center" style="display: none;"></div>
                        </div>
                        <div class="form-outline mb-3"><label class="w-100">Date of Birth</label>
                            <input type="date" id="a_dob" name="a_dob" class="form-control form-control-lg" placeholder="Date of birth" required tabindex="4" maxlength="10" max="{{ date('Y-m-d') }}" />
                            <label for="a_dob" class="error"></label>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Gender</label><br>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="gendrradio" id="gendrradio" value="M" >Male
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="gendrradio" id="gendrradio" value="F" >Female
                                    </label>
                                </div>
                        </div>
                        {{-- <div class="form-outline mb-3"><label class="lblname" for="lblname">Referral ID</label>
                            <input type="text" id="s_refralid" name="s_refralid" class="form-control form-control-lg"  maxlength="50"  placeholder="Referral ID" tabindex="5" onchange="checkrefrelno(this.value,'1')"/>
                            <div id="s_refralid-message"  class="text-center" style="display: none;"></div>
                        </div> --}}
                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Professions</label>
                            <select class="form-select form-control form-control-lg" id="s_professions" name="s_professions"  required tabindex="6">
                                <option value="" >Professions</option><br/>
                                    @foreach ($professions as $profes)
                                        <option value="{{ $profes->id }}">{{ $profes->profession_name }}</option>
                                    @endforeach
                            </select>
                            <label for="s_professions" class="error"></label>
                        </div>
                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Marital Status</label>
                            <select class="form-select form-control form-control-lg" id="a_marital" name="a_marital" required tabindex="7">
                                <option value="">Marital Status</option><br/>
                                @foreach ($matstatus as $ma_status)
                                        <option value="{{ $ma_status->id }}">{{ $ma_status->mr_name }}</option>
                                    @endforeach
                            </select>
                            <label for="a_marital" class="error"></label>
                        </div>
                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Religion</label>
                            <select class="form-select form-control form-control-lg" id="a_religion" name="v" required tabindex="8" >
                                <option value="">Religion</option><br/>
                                    @foreach ($religions as $relgn)
                                        <option value="{{ $relgn->id }}">{{ $relgn->religion_name }}</option>
                                    @endforeach
                            </select>
                            <label for="a_religion" class="error"></label>
                        </div>

                            <div class="form-outline mb-3"><label class="lblname" for="lblname">Aadhaar Number</label>
                                <input type="text" id="a_aadharno" name="a_aadharno" class="form-control form-control-lg" placeholder="Aadhaar Number" required tabindex="9" maxlength="12" />
                                <label for="a_aadharno" class="error"></label>

                            </div>
                            <div class="form-outline mb-3"><label class="lblname" for="lblname">Locality</label>
                                <input type="text" id="a_locality" name="a_locality"  maxlength="100"  class="form-control form-control-lg"placeholder="Locality" required  tabindex="12" />
                                <label for="a_locality" class="error"></label>
                            </div>
                            <div class="form-outline mb-3"><label class="lblname" for="lblname">Country</label>
                                <select class="form-select form-control form-control-lg" name="country"  aria-label="Default select example" id="country" required  tabindex="14" >
                                    <option value="">Select country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                        @endforeach
                                </select>
                                <label for="country" class="error"></label>
                            </div>
                            <div class="form-outline mb-3"><label class="lblname" for="lblname">State</label>
                                <select class="form-select form-control form-control-lg" name="state" aria-label="Default select example" id="state" required  tabindex="15">

                                </select>
                                <label for="state" class="error"></label>
                            </div>
                            <div class="form-outline mb-3"><label class="lblname" for="lblname">District</label>
                                <select class="form-select form-control form-control-lg" aria-label="Default select example" id="district" name="district" required  tabindex="16">

                                </select>
                                <label for="district" class="error"></label>
                            </div>

                        </div>




                    <div class="col-md-4">
                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Aadhar card front & back</label>
                            <input type="file" id="a_aadharphoto"  multiple=""  name="a_aadharphoto[]" class="form-control form-control-lg" placeholder="Aadhar card front & back" required tabindex="19" accept="image/jpeg, image/png"  />
                            <label for="a_aadharphoto" class="error"></label>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" align="left">
                                    <div id="image-preview" class="row"></div>
                            </div>
                        </div>

                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Passbook front & back</label>
                            <input type="file" id="a_passbook"  multiple=""  name="a_passbook[]" class="form-control form-control-lg" placeholder="Passbook front & back" required tabindex="19" accept="image/jpeg, image/png"  />
                            <label for="a_passbook" class="error"></label>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" align="left">
                                    <div id="image-preview_pass" class="row"></div>
                            </div>
                        </div>
                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Upload Photo</label>
                            <input type="file" id="a_uplodphoto"  name="a_uplodphoto[]" class="form-control form-control-lg" placeholder="Passbook front & back" required tabindex="19" accept="image/jpeg, image/png"  />
                            <label for="a_uplodphoto" class="error"></label>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" align="left">
                                    <div id="image-preview_photo" class="row"></div>
                            </div>
                        </div>
                        <div class="form-outline mb-3"><label class="lblname" for="lblname">PAN Number</label>
                            <input type="text" id="s_panno" name="s_panno"  maxlength="12"  class="form-control form-control-lg" placeholder="PAN Number" required  tabindex="21" />
                            <label for="s_panno" class="error"></label>
                        </div>

                        <div class="form-outline mb-3"><label class="regis_date" for="regis_date"> Registration Date</label>
                            <input type="date" id="s_registerdate" name="s_registerdate"  maxlength="10"  class="form-control form-control-lg" placeholder="Registration Date"  tabindex="24" />
                            <label for="s_registerdate" class="error"></label>
                        </div>
                    </div>
                    <div class="col-md-4">


                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Account Name</label>
                            <input type="text" id="a_accname" name="a_accname"  maxlength="50"  class="form-control form-control-lg" placeholder="Account Name"  tabindex="25" />
                            <label for="a_accname" class="error"></label>
                        </div>

                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Account Number</label>
                            <input type="text" id="a_accno" name="a_accno"  maxlength="20"  class="form-control form-control-lg" placeholder="Account Number"  tabindex="26" />
                            <label for="a_accno" class="error"></label>
                        </div>

                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Bank Name</label>
                            <select class="form-select form-control form-control-lg" name="bank_name"  aria-label="Default select example" id="bank_name" required  tabindex="27" >
                                <option value="">Select Bank Name</option>
                                    @foreach ($bank_types as $banktype)
                                        <option value="{{ $banktype->id }}">{{ $banktype->bank_name }}</option>
                                    @endforeach
                            </select>
                            <label for="a_accno" class="error"></label>
                        </div>

                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Bank Country</label>
                            <select class="form-select form-control form-control-lg" name="bank_country"  aria-label="Default select example" id="bank_country" required  tabindex="28" >
                                <option value="">Select country</option>
                                    @foreach ($countries as $bankcontry)
                                        <option value="{{ $bankcontry->id }}">{{ $bankcontry->country_name }}</option>
                                    @endforeach
                            </select>
                            <label for="a_accno" class="error"></label>
                        </div>

                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Bank State</label>
                            <select class="form-select form-control form-control-lg" name="bank_state"  aria-label="Default select example" id="bank_state" required  tabindex="27" >
                                <option value="">Select state</option>
                            </select>
                            <label for="bank_state" class="error"></label>
                        </div>

                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Bank district</label>
                            <select class="form-select form-control form-control-lg" name="bank_dist"  aria-label="Default select example" id="bank_dist" required  tabindex="28" >
                                <option value="">Select district</option>
                            </select>
                            <label for="bank_dist" class="error"></label>
                        </div>


                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Branch Name</label>
                            <select class="form-select form-control form-control-lg" name="branch_name"  aria-label="Default select example" id="branch_name" required  tabindex="29" >
                                <option value="">Select Branch</option>

                            </select>
                            <label for="branch_name" class="error"></label>
                        </div>


                        <div class="form-outline mb-3">


                        </div>


                        <div class="checkbox form-check-inline">
                            <input class="form-check-input" type="checkbox" id="s_termcondtn" name="s_termcondtn" value="1" required tabindex="26" >
                            <label class="inlineCheckbox1" for="s_termcondtn"> Accept Terms & Conditions </label>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div style="float:right">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div id="shopreg-message"  class="text-center" style="display: none;"></div>
                    </div>


                 </div>
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

        $('#country').change(function () {
            $('#district').empty();
            var countryId = $(this).val();
            if (countryId) {
                $.get("/getStates/" + countryId, function (data) {
                    $('#state').empty().append('<option value="">Select State</option>');
                    $.each(data, function (index, state) {
                        $('#state').append('<option value="' + state.id + '">' + state.state_name + '</option>');
                    });
                });
            }
        });

        $('#state').change(function () {
            var stateId = $(this).val();
            if (stateId) {
                $.get("/getDistricts/" + stateId, function (data) {
                    $('#district').empty().append('<option value="">Select District</option>');
                    $.each(data, function (index, district) {
                        $('#district').append('<option value="' + district.id + '">' + district.district_name + '</option>');
                    });
                });
            }
        });

        $('#bank_country').change(function () {
            $('#bank_dist').empty();
            var countryId = $(this).val();
            if (countryId) {
                $.get("/getStates/" + countryId, function (data) {
                    $('#bank_state').empty().append('<option value="">Select State</option>');
                    $.each(data, function (index, state) {
                        $('#bank_state').append('<option value="' + state.id + '">' + state.state_name + '</option>');
                    });
                });
            }
        });

        $('#bank_state').change(function () {
            var stateId = $(this).val();
            if (stateId) {
                $.get("/getDistricts/" + stateId, function (data) {
                    $('#bank_dist').empty().append('<option value="">Select District</option>');
                    $.each(data, function (index, district) {
                        $('#bank_dist').append('<option value="' + district.id + '">' + district.district_name + '</option>');
                    });
                });
            }
        });

        $('#bank_dist').change(function () {
            var stateId = $(this).val();
            if (stateId) {
                $.get("/getDistricts/" + stateId, function (data) {
                    $('#branch_name').empty().append('<option value="">Select Branch</option>');
                    $.each(data, function (index, district) {
                        $('#branch_name').append('<option value="' + district.id + '">' + district.district_name + '</option>');
                    });
                });
            }
        });






            var fileArrs = [];
            var totalFiless = 0;

            $("#s_photo").change(function(event) {
                var totalFileCount = $(this)[0].files.length;
                if (totalFiless + totalFileCount > 5) {
                    alert('Maximum 5 images allowed');
                    $(this).val('');
                    $('#image-preview').html('');
                    return;
                }

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

                    var reader = new FileReader();
                    reader.onload = (function(file) {
                        return function(event) {
                            var imgDiv = $('<div>').addClass('img-div col-md-3 img-container');
                            var img = $('<img>').attr('src', event.target.result).addClass('img-responsive image img-thumbnail').attr('width', '100');
                            var removeBtn = $('<button>').addClass('btn btn-danger remove-btns').attr('title', 'Remove Image').append('X').attr('role', file.name);

                            imgDiv.append(img);
                            imgDiv.append($('<div>').addClass('middle').append(removeBtn));

                            $('#image-preview').append(imgDiv);
                        };
                    })(file);

                    reader.readAsDataURL(file);
                }
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


        $("#AffilateRegForm").validate({

            rules: {
                s_name: {
                    required: true,
                    pattern: /^[A-Za-z\s\.]+$/,
                },
                s_ownername: {
                    required: true,
                    pattern: /^[A-Za-z\s\.]+$/,
                },
                s_mobno: {
                    required: true,
                    digits: true,
                    minlength: 10,
                },
                s_email: {
                    required: true,
                    email: true,
                },

                s_busnestype: {
                    required: true,

                },
                s_shopservice: {
                    required: true,

                },
                s_shopexectename: {
                    required: true,

                },
                s_lisence: {
                    required: true,
                },
                s_buldingorhouseno: {
                    required: true,
                },

                s_locality: {
                    required: true,
                },

                s_villagetown: {
                    required: true,
                },

                country: {
                    required: true,
                    // numericOnly: true
                },
                state: {
                    required: true,

                },
                district: {
                    required: true,

                },
                s_pincode: {
                    required: true,
                    digits: true,
                    minlength: 6,

                },
                s_googlelink: {
                    required: true,
                },
                s_gstno: {
                    required: true,
                },
                s_panno: {
                    required: true,
                },
                s_establishdate: {
                    required: true,
                },
                s_termcondtn: {
                    required: true,
                },
                s_photo: {
                    required: true,
                    extension: 'jpg|jpeg|png',
                },
                opentime: {
                    required: true,
                },
                closetime: {
                    required: true,
                },
                s_registerdate: {
                    required: true,
                },
                manufactringdets: {
                    required: true,
                },

                // s_paswd: {
                //     required: true,
                //     minlength: 6,
                //     strongPassword: true
                // },
                // s_rpaswd: {
                //     required: true,
                //     equalTo: "#s_paswd"
                // },

            },
            messages: {
                s_name: {
                    pattern: "Only characters, spaces, and dots are allowed.",
                },
                s_ownername: {
                    pattern: "Only characters, spaces, and dots are allowed.",
                },
                s_mobno: {
                    digits: "Please enter a valid mobile number.",
                },
                s_email: {
                    email: "Please enter a valid email address.",
                },
                s_photo: {
                    extension: "Only JPG and PNG files are allowed.",
                },
                s_lisence: {
                    required: "Please enter the license number.",
                    maxlength: "License number must not exceed 25 characters."
                },
                s_buldingorhouseno: {
                    required: "Please enter building/house name and number.",
                    maxlength: "Building/house name and number must not exceed 100 characters."
                },
                s_locality: {
                    required: "Please enter the locality.",
                    maxlength: "Locality must not exceed 100 characters."
                },
                s_villagetown: {
                    required: "Please enter village/town/municipality.",
                    maxlength: "Village/town/municipality must not exceed 100 characters."
                },
                country: {
                    required: "Please select a country."
                },
                state: {
                    required: "Please select a state."
                },
                district: {
                    required: "Please select a district."
                },
                s_pincode: {
                    required: "Please enter the pin code.",
                    maxlength: "Pin code must be 6 digits."
                },
                s_googlelink: {
                    required: "Please enter the Google map link location."
                },
                s_gstno: {
                    required: "Please enter the GST number.",
                    maxlength: "GST number must not exceed 25 characters."
                },
                s_panno: {
                    required: "Please enter the PAN number.",
                    maxlength: "PAN number must not exceed 12 characters."
                },
                s_establishdate: {
                    required: "Please select the establishment date."
                },
                s_termcondtn: {
                    required: "Please accept the terms and conditions."
                },
                opentime: {
                    required: "Please select open time."
                },
                closetime: {
                    required: "Please select close time."
                },
                s_registerdate: {
                    required: "Please select the registration date."
                }

            },
            });


            $('#s_name, #s_ownername').on('input', function() {
            var value = $(this).val();
            value = value.replace(/[^A-Za-z\s\.]+/, '');
            $(this).val(value);
            });

            // $.validator.addMethod("strongPassword", function(value, element) {
            // return this.optional(element) || /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}$/.test(value);
            // }, "Password must contain at least one letter, one number, and one special character.");


            $.validator.addMethod('maxSize', function(value, element, param) {
            return this.optional(element) || (element.files[0].size <= param);
            }, 'File size must be less than {0} KB');



            $('#AffilateRegForm').submit(function(e) {
            e.preventDefault();
            if ($(this).valid()) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            $.ajax({
                url: '{{ route("AdmsellerRegisteration") }}',
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                headers: {
                'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {

                    console.log(response);
                    $('#shopreg-message').text('Registration successful. Please verify email and login!').fadeIn();
                    $('#shopreg-message').addClass('success-message');
                    $('#image-preview').empty();
                    setTimeout(function() {
                        $('#shopreg-message').fadeOut();
                    }, 5000); // 5000 milliseconds = 5 seconds
                    $('#AffilateRegForm')[0].reset();
                    $('#loading-image').fadeOut();
                    $('#loading-overlay').fadeOut();
                    $('#addNewModal').modal('hide');
                    shwdets();


                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    $('#shopreg-message').text('Registration failed.').fadeIn();
                    $('#shopreg-message').addClass('error');
                    setTimeout(function() {
                        $('#shopreg-message').fadeOut();
                    }, 5000);
                    $('#loading-image').fadeOut();
                    $('#loading-overlay').fadeOut();
                    $('#addNewModal').modal('show');

                }
            });
            }
            });



            var mm = 1;
            $(document).ready(function(){
                $('#addMoreurls').click(function(event){
                    event.preventDefault();
                        mm++;
                        var recRowm = '<div class="row mb-5" id="addedfieldurl'+mm+'"><div class="col-md-3 fv-row fv-plugins-icon-container"><select class="form-select form-control form-control-lg" id="mediatype'+mm+'" name="mediatype['+mm+']"><option selected="">Choose...</option><option value="1">Facebook</option><option value="2">Instagram</option><option value="3">Linked In</option><option value="4">Web site URL</option><option value="5">Youtub Video URL</option></select></div><div class="col-md-9 fv-row fv-plugins-icon-container"><div class="input-group"><input type="text"  id="mediaurl'+mm+'" name="mediaurl['+mm+']" class="form-control form-control-lg" placeholder="https://"  value="" tabindex="22"  maxlength="60"/><div align="right"><button id="removeRowurl'+mm+'" type="button" name="add_fieldurl" class="btn btn-danger" onclick="removeRowurl('+mm+');" >-</button></div></div></div>';
                    $('#addedUrls').append(recRowm);
                });
            });

            function removeRowurl(rowNum){
                    $('#addedfieldurl'+rowNum).remove();
                }









    </script>

