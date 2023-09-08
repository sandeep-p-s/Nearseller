@php
    $aadhar_file = $Affiliate->aadhar_file;
    $aadhar_filesarray = json_decode($aadhar_file);
    $fileval = $aadhar_filesarray->fileval;
    $aadhar_fileval = json_decode(json_encode($fileval), true);
    $totadarimg = count($aadhar_fileval);

    $passbook_file = $Affiliate->passbook_file;
    $passbook_filearray = json_decode($passbook_file);
    $passbook = $passbook_filearray->passbook;
    $passbook_fileval = json_decode(json_encode($passbook), true);
    $totpassimg = count($passbook_fileval);

    $photo_file = $Affiliate->photo_file;
    $photo_filearray = json_decode($photo_file);
    $photos = $photo_filearray->photos;
    $photosval = json_decode(json_encode($photos), true);
    $totphotoimg = count($photosval);

@endphp



<form id="AffilateRegFormEdit" enctype="multipart/form-data" method="POST">
    <input type="hidden" id="affiliateidhid" name="affiliateidhid" value="{{ $Affiliate->id }}"
        class="form-control form-control-lg" maxlength="50" placeholder="Affiliate id" required tabindex="1" />
    <input type="hidden" id="affiliateuseridhid" name="affiliateuseridhid" value="{{ $Affiliate->user_id }}"
        class="form-control form-control-lg" maxlength="50" placeholder="User id" required tabindex="1" />
        <div class="row">

            <div class="col-lg-4">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <label class="col-xl-6 ">Affiliate Name</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $Affiliate->name }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="row">
                            <label class="col-xl-6 ">Mobile Number</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $Affiliate->mob_no }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">Email ID</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $Affiliate->email }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">Date of Birth</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $Affiliate->email }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">Gender</label>
                            <div class="col-xl-6 align-self-center">
                                jghfxghfhgklfjghf
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">Referral ID</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $Affiliate->referal_id }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">Professions</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $Affiliate->referal_id }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="row">
                            <label class="col-xl-6 ">Other Professions</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $Affiliate->other_profession }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="row">
                            <label class="col-xl-6 ">Marital Status</label>
                            <div class="col-xl-6 align-self-center">
                                jghfxghfhgklfjghf
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">Religion</label>
                            <div class="col-xl-6 align-self-center">
                                jghfxghfhgklfjghf
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">

                    <div class="card-body">


                        <div class="form-group row">
                            <label class="col-xl-6 ">Aadhaar Number</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $Affiliate->aadhar_no }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">Locality</label>
                            <div class="col-xl-6 align-self-center">
                                 {{ $Affiliate->locality }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">Country</label>
                            <div class="col-xl-6 align-self-center">
                                jghfxghfhgklfjghf
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">State</label>
                            <div class="col-xl-6 align-self-center">
                                jghfxghfhgklfjghf
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">District</label>
                            <div class="col-xl-6 align-self-center">
                                jghfxghfhgklfjghf
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="row">
                            <label class="col-xl-6 ">PAN Number</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $Affiliate->pan_no }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="row">
                            <label class="col-xl-6 ">Registration Date</label>
                            <div class="col-xl-6 align-self-center">
                                jghfxghfhgklfjghf
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">Aadhar card front & back</label>
                            <div class="col-xl-6 align-self-center">
                                jghfxghfhgklfjghf
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">Passbook front & back</label>
                            <div class="col-xl-6 align-self-center">
                                jghfxghfhgklfjghf
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">

                    <div class="card-body">


                        <div class="form-group row">
                            <label class="col-xl-6 ">Upload Photo</label>
                            <div class="col-xl-6 align-self-center">
                                jghfxghfhgklfjghf
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">Direct Affiliate</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $Affiliate->direct_affiliate }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">Co-Ordinator</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $Affiliate->aff_coordinator }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">Account Holder Name</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $Affiliate->account_holder_name }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">Account Number</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $Affiliate->account_no }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">Bank Name</label>
                            <div class="col-xl-6 align-self-center">
                                jghfxghfhgklfjghf
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">Bank Country</label>
                            <div class="col-xl-6 align-self-center">
                                jghfxghfhgklfjghf
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">Bank State</label>
                            <div class="col-xl-6 align-self-center">
                                jghfxghfhgklfjghf
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">Bank district</label>
                            <div class="col-xl-6 align-self-center">
                                jghfxghfhgklfjghf
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">Branch Name</label>
                            <div class="col-xl-6 align-self-center">
                                jghfxghfhgklfjghf
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">IFSC Code</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $Affiliate->ifsc_code }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">Branch Address</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $Affiliate->branch_address }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
</form>

<!-- Modal Add new Close -->



<script>
    $('#ecountry').change(function() {
        $('#edistrict').empty();
        var countryId = $(this).val();
        if (countryId) {
            $.get("/getStates/" + countryId, function(data) {
                $('#estate').empty().append('<option value="">Select State</option>');
                $.each(data, function(index, state) {
                    $('#ebranch_name').empty();
                    $('#ebranchifsc').val('');
                    $('#ebranchaddress').val('');
                    $('#estate').append('<option value="' + state.id + '">' + state.state_name +
                        '</option>');
                });
            });
        }
    });

    $('#estate').change(function() {
        var stateId = $(this).val();
        if (stateId) {
            $.get("/getDistricts/" + stateId, function(data) {
                $('#edistrict').empty().append('<option value="">Select District</option>');
                $.each(data, function(index, district) {
                    $('#ebranch_name').empty();
                    $('#ebranchifsc').val('');
                    $('#ebranchaddress').val('');
                    $('#edistrict').append('<option value="' + district.id + '">' + district
                        .district_name + '</option>');
                });
            });
        }
    });

    $('#ebank_country').change(function() {
        $('#ebank_dist').empty();
        var countryId = $(this).val();
        if (countryId) {
            $.get("/getStates/" + countryId, function(data) {
                $('#ebank_state').empty().append('<option value="">Select State</option>');
                $.each(data, function(index, state) {
                    $('#ebranch_name').empty();
                    $('#ebranchifsc').val('');
                    $('#ebranchaddress').val('');
                    $('#ebank_state').append('<option value="' + state.id + '">' + state
                        .state_name + '</option>');
                });
            });
        }
    });

    $('#ebank_state').change(function() {
        var stateId = $(this).val();
        if (stateId) {
            $.get("/getDistricts/" + stateId, function(data) {
                $('#ebank_dist').empty().append('<option value="">Select District</option>');
                $.each(data, function(index, district) {
                    $('#ebranch_name').empty();
                    $('#ebranchifsc').val('');
                    $('#ebranchaddress').val('');
                    $('#ebank_dist').append('<option value="' + district.id + '">' + district
                        .district_name + '</option>');
                });
            });
        }
    });


    $('#ebank_dist').change(function() {
        var bankName = $('#ebank_name').val();
        var bankCountry = $('#ebank_country').val();
        var bankState = $('#ebank_state').val();
        var bankDist = $('#ebank_dist').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{ route('getBankBranches') }}',
            type: 'POST',
            data: {
                bank_name: bankName,
                bank_country: bankCountry,
                bank_state: bankState,
                bank_dist: bankDist,
                _token: csrfToken
            },
            success: function(data) {
                var branchSelect = $('#ebranch_name');
                $('#ebranchifsc').val('');
                $('#ebranchaddress').val('');
                branchSelect.empty().append('<option value="">Select Branch</option>');
                $.each(data, function(index, branch) {
                    branchSelect.append('<option value="' + branch.id + '">' + branch
                        .branch_name + '</option>');
                });
            },
            error: function() {
                console.log('Error fetching branches');
            }
        });
    });


    $('#ebranch_name').change(function() {
        var branchId = $(this).val();
        $('#loading-overlay').fadeIn();
        $('#loading-image').fadeIn();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        if (branchId) {
            $.ajax({
                url: '{{ route('getIFSCode') }}',
                type: 'POST',
                data: {
                    branchId: branchId,
                    _token: csrfToken
                },
                success: function(data) {
                    $.each(data, function(index, bank_dets) {
                        $('#ebranchifsc').val(bank_dets.ifsc_code);
                        $('#ebranchaddress').val(bank_dets.branch_address);
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                    });
                },
                error: function() {
                    console.log('Error fetching branches');
                    $('#ebranchifsc').val('');
                    $('#ebranchaddress').val('');
                    $('#loading-image').fadeOut();
                    $('#loading-overlay').fadeOut();
                }
            });
        } else {
            $('#ebranchifsc').val('');
            $('#ebranchaddress').val('');
            $('#loading-image').fadeOut();
            $('#loading-overlay').fadeOut();

        }
    });


    $('#es_professions').change(function() {
        var professions = $('#es_professions').val();
        if (professions == 3) {
            $('#eotherprofesn').show();
        } else {
            $('#eotherprofesn').hide();
        }

    });








    var fileArrs = [];
    var totalFiless = 0;

    $("#ea_aadharphoto").change(function(event) {
        var totalFileCount = $(this)[0].files.length;
        if (totalFiless + totalFileCount > 2) {
            alert('Maximum 2 images allowed');
            $(this).val('');
            $('#eimage-preview').html('');
            return;
        }

        for (var i = 0; i < totalFileCount; i++) {
            var file = $(this)[0].files[i];

            if (file.size > 3145728) {
                alert('File size exceeds the limit of 3MB');
                $(this).val('');
                $('#eimage-preview').html('');
                return;
            }

            fileArrs.push(file);
            totalFiless++;

            var reader = new FileReader();
            reader.onload = (function(file) {
                return function(event) {
                    var imgDiv = $('<div>').addClass('img-div col-md-3 img-container');
                    var img = $('<img>').attr('src', event.target.result).addClass(
                        'img-responsive image img-thumbnail').attr('width', '100');
                    var removeBtn = $('<button>').addClass('btn btn-danger remove-btns').attr(
                        'title', 'Remove Image').append('X').attr('role', file.name);

                    imgDiv.append(img);
                    imgDiv.append($('<div>').addClass('middle').append(removeBtn));

                    $('#eimage-preview').append(imgDiv);
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
        document.getElementById('ea_aadharphoto').files = new FileListItem(fileArrs);
        $(this).closest('.img-div').remove();
    });


    var fileArrs_p = [];
    var totalFiless_p = 0;

    $("#ea_passbook").change(function(event) {
        var totalFileCount = $(this)[0].files.length;
        if (totalFiless_p + totalFileCount > 2) {
            alert('Maximum 2 images allowed');
            $(this).val('');
            $('#eimage-preview_pass').html('');
            return;
        }

        for (var i = 0; i < totalFileCount; i++) {
            var file = $(this)[0].files[i];

            if (file.size > 3145728) {
                alert('File size exceeds the limit of 3MB');
                $(this).val('');
                $('#eimage-preview_pass').html('');
                return;
            }

            fileArrs_p.push(file);
            totalFiless_p++;

            var reader = new FileReader();
            reader.onload = (function(file) {
                return function(event) {
                    var imgDiv = $('<div>').addClass('img-div col-md-3 img-container');
                    var img = $('<img>').attr('src', event.target.result).addClass(
                        'img-responsive image img-thumbnail').attr('width', '100');
                    var removeBtn = $('<button>').addClass('btn btn-danger remove-btns-pass').attr(
                        'title', 'Remove Image').append('X').attr('role', file.name);

                    imgDiv.append(img);
                    imgDiv.append($('<div>').addClass('middle').append(removeBtn));

                    $('#eimage-preview_pass').append(imgDiv);
                };
            })(file);

            reader.readAsDataURL(file);
        }
    });

    $(document).on('click', '.remove-btns-pass', function() {
        var fileName = $(this).attr('role');

        for (var i = 0; i < fileArrs_p.length; i++) {
            if (fileArrs_p[i].name === fileName) {
                fileArrs_p.splice(i, 1);
                totalFiless_p--;
                break;
            }
        }
        document.getElementById('ea_passbook').files = new FileListItem(fileArrs_p);
        $(this).closest('.img-div').remove();
    });



    var fileArrs_up = [];
    var totalFiless_up = 0;

    $("#ea_uplodphoto").change(function(event) {
        var totalFileCount = $(this)[0].files.length;
        if (totalFiless_up + totalFileCount > 1) {
            alert('Maximum 1 images allowed');
            $(this).val('');
            $('#eimage-preview_photo').html('');
            return;
        }

        for (var i = 0; i < totalFileCount; i++) {
            var file = $(this)[0].files[i];

            if (file.size > 3145728) {
                alert('File size exceeds the limit of 3MB');
                $(this).val('');
                $('#eimage-preview_photo').html('');
                return;
            }

            fileArrs_up.push(file);
            totalFiless_up++;

            var reader = new FileReader();
            reader.onload = (function(file) {
                return function(event) {
                    var imgDiv = $('<div>').addClass('img-div col-md-3 img-container');
                    var img = $('<img>').attr('src', event.target.result).addClass(
                        'img-responsive image img-thumbnail').attr('width', '100');
                    var removeBtn = $('<button>').addClass('btn btn-danger remove-btns-uphoto')
                        .attr('title', 'Remove Image').append('X').attr('role', file.name);

                    imgDiv.append(img);
                    imgDiv.append($('<div>').addClass('middle').append(removeBtn));

                    $('#eimage-preview_photo').append(imgDiv);
                };
            })(file);

            reader.readAsDataURL(file);
        }
    });

    $(document).on('click', '.remove-btns-uphoto', function() {
        var fileName = $(this).attr('role');

        for (var i = 0; i < fileArrs_up.length; i++) {
            if (fileArrs_up[i].name === fileName) {
                fileArrs_up.splice(i, 1);
                totalFiless_up--;
                break;
            }
        }
        document.getElementById('ea_uplodphoto').files = new FileListItem(fileArrs_up);
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


    $("#AffilateRegFormEdit").validate({

        rules: {
            ea_name: {
                required: true,
                pattern: /^[A-Za-z\s\.]+$/,
            },
            ea_mobno: {
                required: true,
                digits: true,
                minlength: 10,
            },
            ea_email: {
                required: true,
                email: true,
            },
            ea_dob: {
                required: true,
            },
            es_professions: {
                required: true,
            },
            ea_marital: {
                required: true,
            },
            ea_religion: {
                required: true,
            },
            ea_aadharno: {
                required: true,
                digits: true,
                minlength: 12,
            },
            ea_locality: {
                required: true,
            },
            ecountry: {
                required: true,
            },
            estate: {
                required: true,
            },
            edistrict: {
                required: true,
            },
            es_termcondtn: {
                required: true,
            },
            es_panno: {
                required: true,
            },
            es_registerdate: {
                required: true,
            },
            es_termcondtn: {
                required: true,
            },
            ea_aadharphoto: {
                required: true,
                extension: 'jpg|jpeg|png',
            },
            ea_passbook: {
                required: true,
                extension: 'jpg|jpeg|png',
            },
            ea_uplodphoto: {
                required: true,
                extension: 'jpg|jpeg|png',
            },
            ea_accname: {
                required: true,
            },
            ea_accno: {
                required: true,
                digits: true,
            },
            ebank_name: {
                required: true,
            },
            ebank_country: {
                required: true,
            },
            ebank_state: {
                required: true,
            },
            ebank_dist: {
                required: true,
            },
            ebranch_name: {
                required: true,
            },
            egender: {
                required: true,
            },


        },
        messages: {
            ea_name: {
                pattern: "Only characters, spaces, and dots are allowed.",
            },
            ea_mobno: {
                digits: "Please enter a valid mobile number.",
            },
            ea_email: {
                email: "Please enter a valid email address.",
            },
            ea_aadharno: {
                digits: "Please enter a valid aadhaar number.",
            },
            ea_locality: {
                required: "Please enter the locality.",
                maxlength: "Locality must not exceed 100 characters."
            },

            es_professions: {
                required: "Please select a profession."
            },
            ea_marital: {
                required: "Please select a marital status."
            },
            ea_religion: {
                required: "Please select a religion."
            },

            ecountry: {
                required: "Please select a country."
            },
            estate: {
                required: "Please select a state."
            },
            edistrict: {
                required: "Please select a district."
            },
            es_panno: {
                required: "Please enter the PAN number.",
                maxlength: "PAN number must not exceed 12 characters."
            },
            es_registerdate: {
                required: "Please select the registration date."
            },
            ea_aadharphoto: {
                extension: "Only JPG and PNG files are allowed.",
            },
            ea_passbook: {
                extension: "Only JPG and PNG files are allowed.",
            },
            ea_uplodphoto: {
                extension: "Only JPG and PNG files are allowed.",
            },
            ea_accname: {
                pattern: "Only characters, spaces, and dots are allowed.",
            },
            ea_accno: {
                pattern: "Please enter a valid account number.",
            },
            ebank_name: {
                pattern: "Please select a bank name.",
            },
            ebank_country: {
                pattern: "Please select a bank country.",
            },
            ebank_state: {
                pattern: "Please select a bank state.",
            },
            ebank_dist: {
                pattern: "Please select a bank district.",
            },
            ebranch_name: {
                pattern: "Please select a bank branch name.",
            },
            egender: {
                required: "Please select a gender.",
            },
        },
    });


    $('#ea_name,#ea_accname').on('input', function() {
        var value = $(this).val();
        value = value.replace(/[^A-Za-z\s\.]+/, '');
        $(this).val(value);
    });


    $.validator.addMethod('maxSize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param);
    }, 'File size must be less than {0} KB');


    $('#AffilateRegFormEdit').submit(function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            $.ajax({
                url: '{{ route('AdmAffiliateUpdate') }}',
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {

                    console.log(response);
                    $('#affliterupdte-message').text('Affiliate details successfully updated!')
                        .fadeIn();
                    $('#affliterupdte-message').addClass('success-message');
                    $('#eimage-preview').empty();
                    $('#eimage-preview_pass').empty();
                    $('#eimage-preview_photo').empty();

                    setTimeout(function() {
                        $('#affliterupdte-message').fadeOut();
                    }, 5000); // 5000 milliseconds = 5 seconds
                    $('#AffilateRegFormEdit')[0].reset();
                    $('#loading-image').fadeOut();
                    $('#loading-overlay').fadeOut();
                    $('#ViewEditModal').modal('hide');
                    shwdets();


                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    $('#affliterupdte-message').text('Updation failed.').fadeIn();
                    $('#affliterupdte-message').addClass('error');
                    setTimeout(function() {
                        $('#affliterupdte-message').fadeOut();
                    }, 5000);
                    $('#loading-image').fadeOut();
                    $('#loading-overlay').fadeOut();
                    $('#ViewEditModal').modal('show');

                }
            });
        }
    });
</script>
