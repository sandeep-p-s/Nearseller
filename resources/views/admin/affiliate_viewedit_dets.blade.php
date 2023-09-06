
@php
    $aadhar_file=$Affiliate->aadhar_file;
    $aadhar_filesarray = json_decode($aadhar_file);
    $fileval=$aadhar_filesarray->fileval;
    $aadhar_fileval = json_decode(json_encode($fileval),true);
    $totadarimg = count($aadhar_fileval);


    $passbook_file=$Affiliate->passbook_file;
    $passbook_filearray = json_decode($passbook_file);
    $passbook=$passbook_filearray->passbook;
    $passbook_fileval = json_decode(json_encode($passbook),true);
    $totpassimg = count($passbook_fileval);





@endphp



                <form id="AffilateRegFormEdit" enctype="multipart/form-data" method="POST">
                    <input type="hidden" id="affiliateidhid" name="affiliateidhid" value="{{ $Affiliate->id }}"  class="form-control form-control-lg" maxlength="50"  placeholder="Affiliate id" required  tabindex="1" />
                    <input type="hidden" id="affiliateuseridhid" name="affiliateuseridhid" value="{{ $Affiliate->user_id }}"  class="form-control form-control-lg" maxlength="50"  placeholder="User id" required  tabindex="1" />
                <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Affiliate Name</label>
                            <input type="text" id="ea_name" name="ea_name" class="form-control form-control-lg" maxlength="50"  placeholder="Affiliate Name" required  tabindex="1" value="{{ $Affiliate->name }}" />
                            <label for="ea_name" class="error"></label>
                        </div>
                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Mobile Number</label>
                            <input type="text" id="ea_mobno" name="ea_mobno" class="form-control form-control-lg"  maxlength="10"  placeholder="Mobile No" required tabindex="3"  onchange="exstmobno(this.value,'2')" value="{{ $Affiliate->mob_no }}"   />
                            <label for="a_mobno" class="error"></label>
                            <div id="esmob-message"  class="text-center" style="display: none;"></div>
                        </div>
                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Email ID</label>
                            <input type="email" id="a_email" name="a_email" class="form-control form-control-lg"  maxlength="35"  placeholder="Email ID" required tabindex="4"  onchange="exstemilid(this.value,'2')" value="{{ $Affiliate->email }}"  />
                            <label for="a_email" class="error"></label>
                            <div id="esemil-message"  class="text-center" style="display: none;"></div>
                        </div>
                        <div class="form-outline mb-3"><label class="w-100">Date of Birth</label>
                            <input type="date" id="ea_dob" name="ea_dob" class="form-control form-control-lg" placeholder="Date of birth" required tabindex="4" maxlength="10" max="{{ date('Y-m-d') }}"   value="{{ $Affiliate->dob }}" />
                            <label for="ea_dob" class="error"></label>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label><br>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="emale" name="egender" value="male" @if($Affiliate->gender === 'male') checked @endif>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="efemale" name="egender" value="female" @if($Affiliate->gender === 'female') checked @endif>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                        </div>


                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Referral ID</label>
                            <input type="text" id="es_refralid" name="es_refralid" class="form-control form-control-lg"  value="{{ $Affiliate->referal_id }}" maxlength="15"  placeholder="Referral ID" tabindex="5" readonly />
                            <div id="es_refralid-message"  class="text-center" style="display: none;"></div>
                        </div>
                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Professions</label>
                            <select class="form-select form-control form-control-lg" id="es_professions" name="es_professions"  required tabindex="6">
                                <option value="" >Professions</option><br/>
                                    @foreach ($professions as $profes)
                                        <option value="{{ $profes->id }}" @if($Affiliate->profession == $profes->id) selected @endif>{{ $profes->profession_name }}</option>
                                    @endforeach
                            </select>
                            <label for="es_professions" class="error"></label>
                        </div>
                        <div class="form-outline mb-3" @if($Affiliate->profession==3) style="display: block;" @else style="display: none;" @endif   id="eotherprofesn"><label class="lblname" for="lblname">Other Professions</label>
                            <input type="text" id="ea_otherprofesn" name="ea_otherprofesn" class="form-control form-control-lg" maxlength="50"  placeholder="Other Professions" required  tabindex="1"   value="{{ $Affiliate->other_profession }}" />
                            <label for="ea_otherprofesn" class="error"></label>
                        </div>

                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Marital Status</label>
                            <select class="form-select form-control form-control-lg" id="ea_marital" name="ea_marital" required tabindex="7">
                                <option value="">Marital Status</option><br/>
                                @foreach ($matstatus as $ma_status)
                                        <option value="{{ $ma_status->id }}" @if($Affiliate->marital_status == $ma_status->id) selected @endif>{{ $ma_status->mr_name }}</option>
                                    @endforeach
                            </select>
                            <label for="ea_marital" class="error"></label>
                        </div>
                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Religion</label>
                            <select class="form-select form-control form-control-lg" id="ea_religion" name="ea_religion" required tabindex="8" >
                                <option value="">Religion</option><br/>
                                    @foreach ($religions as $relgn)
                                        <option value="{{ $relgn->id }}"  @if($Affiliate->religion == $relgn->id) selected @endif>{{ $relgn->religion_name }}</option>
                                    @endforeach
                            </select>
                            <label for="ea_religion" class="error"></label>
                        </div>

                            <div class="form-outline mb-3"><label class="lblname" for="lblname">Aadhaar Number</label>
                                <input type="text" id="ea_aadharno" name="ea_aadharno" class="form-control form-control-lg" placeholder="Aadhaar Number" required tabindex="9" maxlength="12"  value="{{ $Affiliate->aadhar_no }}" />
                                <label for="ea_aadharno" class="error"></label>

                            </div>
                            <div class="form-outline mb-3"><label class="lblname" for="lblname">Locality</label>
                                <input type="text" id="ea_locality" name="ea_locality"  maxlength="100"  class="form-control form-control-lg"placeholder="Locality" required  tabindex="12"  value="{{ $Affiliate->locality }}" />
                                <label for="ea_locality" class="error"></label>
                            </div>
                            <div class="form-outline mb-3"><label class="lblname" for="lblname">Country</label>
                                <select class="form-select form-control form-control-lg" name="ecountry"  aria-label="Default select example" id="ecountry" required  tabindex="14" >
                                    <option value="">Select country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}" @if($Affiliate->country === $country->id) selected @endif >{{ $country->country_name }}</option>
                                        @endforeach
                                </select>
                                <label for="country" class="error"></label>
                            </div>
                            <div class="form-outline mb-3"><label class="lblname" for="lblname">State</label>
                                <select class="form-select form-control form-control-lg" name="estate" aria-label="Default select example" id="estate" required  tabindex="15">
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}" @if ($state->id == $Affiliate->state) selected @endif>{{ $state->state_name }}</option>
                                        @endforeach
                                    </select>
                                <label for="estate" class="error"></label>
                            </div>
                            <div class="form-outline mb-3"><label class="lblname" for="lblname">District</label>
                                <select class="form-select form-control form-control-lg" aria-label="Default select example" id="edistrict" name="edistrict" required  tabindex="16">
                                    @foreach ($districts as $dist)
                                    <option value="{{ $dist->id }}" @if (($dist->id == $Affiliate->district) && ($dist->state_id == $Affiliate->state)) selected @endif>{{ $dist->district_name }}</option>
                                    @endforeach
                                </select>
                                <label for="edistrict" class="error"></label>
                            </div>

                        </div>




                    <div class="col-md-4">
                        <div class="form-outline mb-3"><label class="lblname" for="lblname">PAN Number</label>
                            <input type="text" id="s_panno" name="s_panno"  maxlength="12"  value="{{ $Affiliate->pan_no }}"  class="form-control form-control-lg" placeholder="PAN Number" required  tabindex="21" />
                            <label for="s_panno" class="error"></label>
                        </div>

                        <div class="form-outline mb-3"><label class="regis_date" for="regis_date"> Registration Date</label>
                            <input type="date" id="s_registerdate" name="s_registerdate"  value="{{ $Affiliate->registration_date }}"  maxlength="10"  class="form-control form-control-lg" placeholder="Registration Date"  tabindex="24" />
                            <label for="s_registerdate" class="error"></label>
                        </div>

                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Aadhar card front & back</label>
                            <input type="file" id="a_aadharphoto"  multiple=""  name="a_aadharphoto[]" class="form-control form-control-lg" placeholder="Aadhar card front & back" required tabindex="19" accept="image/jpeg, image/png"  />
                            <label for="a_aadharphoto" class="error"></label>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" align="left">
                                    <div id="eimage-preview" class="row"></div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group" align="center">
                                <div class="row">
                                    @for($m = 0; $m < $totadarimg; $m++)
                                        <div class="col-md-3">
                                            <a href="#" data-toggle="modal" data-target="#myModals{{ $m }}">
                                                <img id="img-bufferm" src="{{ asset($fileval[$m]) }}" width="100" height="100">
                                                @php
                                                    $valen = $fileval[$m] . "#" . $Affiliate->id;
                                                    $deleencde = base64_encode($valen);
                                                @endphp
                                            </a><br>
                                            <button id="remv" type="button" name="remv" class="btn btn-danger" onClick="DeltAdharImag('{{ $deleencde }}');">X</button>
                                        </div>

                                        <div class="modal fade" id="myModals{{ $m }}" tabindex="-1" role="dialog" aria-labelledby="myModalsLabel" aria-hidden="true" style="width: 80%;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="{{ asset($fileval[$m]) }}" class="img-fluid">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>


                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Passbook front & back</label>
                            <input type="file" id="ea_passbook"  multiple=""  name="ea_passbook[]" class="form-control form-control-lg" placeholder="Passbook front & back" required tabindex="19" accept="image/jpeg, image/png"  />
                            <label for="ea_passbook" class="error"></label>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" align="left">
                                    <div id="eimage-preview_pass" class="row"></div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group" align="center">
                                <div class="row">
                                    @for($m = 0; $m < $totpassimg; $m++)
                                        <div class="col-md-3">
                                            <a href="#" data-toggle="modal" data-target="#myModalsp{{ $m }}">
                                                <img id="img-bufferm" src="{{ asset($passbook[$m]) }}" width="100" height="100">
                                                @php
                                                    $valen = $passbook[$m] . "#" . $Affiliate->id;
                                                    $deleencde = base64_encode($valen);
                                                @endphp
                                            </a><br>
                                            <button id="remv" type="button" name="remv" class="btn btn-danger" onClick="DeltPassbookImag('{{ $deleencde }}');">X</button>
                                        </div>

                                        <div class="modal fade" id="myModalsp{{ $m }}" tabindex="-1" role="dialog" aria-labelledby="myModalspLabel" aria-hidden="true" style="width: 80%;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="{{ asset($passbook[$m]) }}" class="img-fluid">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
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

                    </div>
                    <div class="col-md-4">

                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Direct Affiliate</label>
                            <input type="text" class="form-control form-control-lg" id="directafflte" name="directafflte">
                            <label for="directafflte" class="error"></label>
                        </div>

                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Co-Ordinator</label>
                            <input type="text" class="form-control form-control-lg" id="coordinater" name="coordinater">
                            <label for="coordinater" class="error"></label>
                        </div>

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
                            <label for="bank_name" class="error"></label>
                        </div>

                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Bank Country</label>
                            <select class="form-select form-control form-control-lg" name="bank_country"  aria-label="Default select example" id="bank_country" required  tabindex="28" >
                                <option value="">Select country</option>
                                    @foreach ($countries as $bankcontry)
                                        <option value="{{ $bankcontry->id }}">{{ $bankcontry->country_name }}</option>
                                    @endforeach
                            </select>
                            <label for="bank_country" class="error"></label>
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
                        <div id="afflitereg-message"  class="text-center" style="display: none;"></div>
                    </div>


                 </div>
                </div>
                </form>

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
        var bankName = $('#bank_name').val();
        var bankCountry = $('#bank_country').val();
        var bankState = $('#bank_state').val();
        var bankDist = $('#bank_dist').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{ route("getBankBranches") }}',
                type: 'POST',
                data: {
                    bank_name: bankName,bank_country: bankCountry,bank_state: bankState,bank_dist: bankDist,_token: csrfToken
                },
                success: function (data) {
                    var branchSelect = $('#branch_name');
                    branchSelect.empty().append('<option value="">Select Branch</option>');
                    $.each(data, function (index, branch) {
                        branchSelect.append('<option value="' + branch.id + '">' + branch.branch_name + '</option>');
                    });
                },
                error: function () {
                    console.log('Error fetching branches');
                }
            });
        });


        $('#es_professions').change(function () {
            var professions = $('#es_professions').val();
            if(professions==3)
            {
                $('#eotherprofesn').show();
            }
            else{
                $('#eotherprofesn').hide();
            }

        });








            var fileArrs = [];
            var totalFiless = 0;

            $("#a_aadharphoto").change(function(event) {
                var totalFileCount = $(this)[0].files.length;
                if (totalFiless + totalFileCount > 2) {
                    alert('Maximum 2 images allowed');
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
                document.getElementById('a_aadharphoto').files = new FileListItem(fileArrs);
                $(this).closest('.img-div').remove();
            });


            var fileArrs_p = [];
            var totalFiless_p = 0;

            $("#a_passbook").change(function(event) {
                var totalFileCount = $(this)[0].files.length;
                if (totalFiless_p + totalFileCount > 2) {
                    alert('Maximum 2 images allowed');
                    $(this).val('');
                    $('#image-preview_pass').html('');
                    return;
                }

                for (var i = 0; i < totalFileCount; i++) {
                    var file = $(this)[0].files[i];

                    if (file.size > 3145728) {
                        alert('File size exceeds the limit of 3MB');
                        $(this).val('');
                        $('#image-preview_pass').html('');
                        return;
                    }

                    fileArrs_p.push(file);
                    totalFiless_p++;

                    var reader = new FileReader();
                    reader.onload = (function(file) {
                        return function(event) {
                            var imgDiv = $('<div>').addClass('img-div col-md-3 img-container');
                            var img = $('<img>').attr('src', event.target.result).addClass('img-responsive image img-thumbnail').attr('width', '100');
                            var removeBtn = $('<button>').addClass('btn btn-danger remove-btns-pass').attr('title', 'Remove Image').append('X').attr('role', file.name);

                            imgDiv.append(img);
                            imgDiv.append($('<div>').addClass('middle').append(removeBtn));

                            $('#image-preview_pass').append(imgDiv);
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
                document.getElementById('a_passbook').files = new FileListItem(fileArrs_p);
                $(this).closest('.img-div').remove();
            });



            var fileArrs_up = [];
            var totalFiless_up = 0;

            $("#a_uplodphoto").change(function(event) {
                var totalFileCount = $(this)[0].files.length;
                if (totalFiless_up + totalFileCount > 1) {
                    alert('Maximum 1 images allowed');
                    $(this).val('');
                    $('#image-preview_photo').html('');
                    return;
                }

                for (var i = 0; i < totalFileCount; i++) {
                    var file = $(this)[0].files[i];

                    if (file.size > 3145728) {
                        alert('File size exceeds the limit of 3MB');
                        $(this).val('');
                        $('#image-preview_photo').html('');
                        return;
                    }

                    fileArrs_up.push(file);
                    totalFiless_up++;

                    var reader = new FileReader();
                    reader.onload = (function(file) {
                        return function(event) {
                            var imgDiv = $('<div>').addClass('img-div col-md-3 img-container');
                            var img = $('<img>').attr('src', event.target.result).addClass('img-responsive image img-thumbnail').attr('width', '100');
                            var removeBtn = $('<button>').addClass('btn btn-danger remove-btns-uphoto').attr('title', 'Remove Image').append('X').attr('role', file.name);

                            imgDiv.append(img);
                            imgDiv.append($('<div>').addClass('middle').append(removeBtn));

                            $('#image-preview_photo').append(imgDiv);
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
                document.getElementById('a_uplodphoto').files = new FileListItem(fileArrs_up);
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
                a_name: {
                    required: true,
                    pattern: /^[A-Za-z\s\.]+$/,
                },
                a_mobno: {
                    required: true,
                    digits: true,
                    minlength: 10,
                },
                a_email: {
                    required: true,
                    email: true,
                },
                a_dob: {
                    required: true,
                },
                s_professions: {
                    required: true,
                },
                a_marital: {
                    required: true,
                },
                a_religion: {
                    required: true,
                },
                a_aadharno: {
                    required: true,
                    digits: true,
                    minlength: 12,
                },
                a_locality: {
                    required: true,
                },
                country: {
                    required: true,
                },
                state: {
                    required: true,
                },
                district: {
                    required: true,
                },
                s_termcondtn: {
                    required: true,
                },
                s_panno: {
                    required: true,
                },
                s_registerdate: {
                    required: true,
                },
                s_termcondtn: {
                    required: true,
                },
                a_aadharphoto: {
                    required: true,
                    extension: 'jpg|jpeg|png',
                },
                a_passbook: {
                    required: true,
                    extension: 'jpg|jpeg|png',
                },
                a_uplodphoto: {
                    required: true,
                    extension: 'jpg|jpeg|png',
                },
                a_accname: {
                    required: true,
                },
                a_accno: {
                    required: true,
                    digits: true,
                },
                bank_name: {
                    required: true,
                },
                bank_country: {
                    required: true,
                },
                bank_state: {
                    required: true,
                },
                bank_dist: {
                    required: true,
                },
                branch_name: {
                    required: true,
                },
                gender: {
                    required: true,
                },


            },
            messages: {
                a_name: {
                    pattern: "Only characters, spaces, and dots are allowed.",
                },
                a_mobno: {
                    digits: "Please enter a valid mobile number.",
                },
                a_email: {
                    email: "Please enter a valid email address.",
                },
                a_aadharno: {
                    digits: "Please enter a valid aadhaar number.",
                },
                a_locality: {
                    required: "Please enter the locality.",
                    maxlength: "Locality must not exceed 100 characters."
                },

                s_professions: {
                    required: "Please select a profession."
                },
                a_marital: {
                    required: "Please select a marital status."
                },
                a_religion: {
                    required: "Please select a religion."
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
                s_panno: {
                    required: "Please enter the PAN number.",
                    maxlength: "PAN number must not exceed 12 characters."
                },
                s_registerdate: {
                    required: "Please select the registration date."
                },
                a_aadharphoto: {
                    extension: "Only JPG and PNG files are allowed.",
                },
                a_passbook: {
                    extension: "Only JPG and PNG files are allowed.",
                },
                a_uplodphoto: {
                    extension: "Only JPG and PNG files are allowed.",
                },
                a_accname: {
                    pattern: "Only characters, spaces, and dots are allowed.",
                },
                a_accno: {
                    pattern: "Please enter a valid account number.",
                },
                bank_name: {
                    pattern: "Please select a bank name.",
                },
                bank_country: {
                    pattern: "Please select a bank country.",
                },
                bank_state: {
                    pattern: "Please select a bank state.",
                },
                bank_dist: {
                    pattern: "Please select a bank district.",
                },
                branch_name: {
                    pattern: "Please select a bank branch name.",
                },
                gender: {
                    required: "Please select a gender.",
                },
            },
            });


            $('#s_name,#a_accname').on('input', function() {
            var value = $(this).val();
            value = value.replace(/[^A-Za-z\s\.]+/, '');
            $(this).val(value);
            });


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
                url: '{{ route("AdmAffiliateRegisteration") }}',
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
                    $('#afflitereg-message').text('Affiliate details successfully updated!').fadeIn();
                    $('#afflitereg-message').addClass('success-message');
                    $('#image-preview').empty();
                    $('#image-preview_pass').empty();
                    $('#image-preview_photo').empty();

                    setTimeout(function() {
                        $('#afflitereg-message').fadeOut();
                    }, 5000); // 5000 milliseconds = 5 seconds
                    $('#AffilateRegForm')[0].reset();
                    $('#loading-image').fadeOut();
                    $('#loading-overlay').fadeOut();
                    $('#ViewEditModal').modal('hide');
                    shwdets();


                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    $('#afflitereg-message').text('Updation failed.').fadeIn();
                    $('#afflitereg-message').addClass('error');
                    setTimeout(function() {
                        $('#afflitereg-message').fadeOut();
                    }, 5000);
                    $('#loading-image').fadeOut();
                    $('#loading-overlay').fadeOut();
                    $('#ViewEditModal').modal('show');

                }
            });
            }
            });

    </script>

