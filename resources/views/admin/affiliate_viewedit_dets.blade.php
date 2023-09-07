
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


    $photo_file=$Affiliate->photo_file;
    $photo_filearray = json_decode($photo_file);
    $photos=$photo_filearray->photos;
    $photosval = json_decode(json_encode($photos),true);
    $totphotoimg = count($photosval);





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
                            <label for="ea_mobno" class="error"></label>
                            <div id="esmob-message"  class="text-center" style="display: none;"></div>
                        </div>
                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Email ID</label>
                            <input type="email" id="ea_email" name="ea_email" class="form-control form-control-lg"  maxlength="35"  placeholder="Email ID" required tabindex="4"  onchange="exstemilid(this.value,'2')" value="{{ $Affiliate->email }}"  />
                            <label for="ea_email" class="error"></label>
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
                                            <option value="{{ $country->id }}" @if($Affiliate->country == $country->id) selected @endif >{{ $country->country_name }}</option>
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
                            <input type="text" id="es_panno" name="es_panno"  maxlength="12"  value="{{ $Affiliate->pan_no }}"  class="form-control form-control-lg" placeholder="PAN Number" required  tabindex="21" />
                            <label for="es_panno" class="error"></label>
                        </div>

                        <div class="form-outline mb-3"><label class="regis_date" for="regis_date"> Registration Date</label>
                            <input type="date" id="es_registerdate" name="es_registerdate"  value="{{ $Affiliate->registration_date }}"  maxlength="10"  class="form-control form-control-lg" placeholder="Registration Date"  tabindex="24" />
                            <label for="es_registerdate" class="error"></label>
                        </div>

                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Aadhar card front & back</label>
                            <input type="file" id="ea_aadharphoto"  multiple=""  name="ea_aadharphoto[]" class="form-control form-control-lg" placeholder="Aadhar card front & back"  tabindex="19" accept="image/jpeg, image/png"  />
                            <label for="ea_aadharphoto" class="error"></label>
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
                                            {{-- <a href="#" data-toggle="modal" data-target="#myModals{{ $m }}"> --}}
                                                <img id="img-bufferm" src="{{ asset($fileval[$m]) }}" width="100" height="100">
                                                @php
                                                    $valen = $fileval[$m] . "#" . $Affiliate->id;
                                                    $deleencde = base64_encode($valen);
                                                @endphp
                                            {{-- </a> --}}
                                            <br>
                                            <button id="remv" type="button" name="remv" class="btn btn-danger" onClick="DeltAdharImag('{{ $deleencde }}');">X</button>
                                        </div>

                                        {{-- <div class="modal fade" id="myModals{{ $m }}" tabindex="-1" role="dialog" aria-labelledby="myModalsLabel" aria-hidden="true" style="width: 80%;">
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
                                        </div> --}}
                                    @endfor
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div id="aahar_gal-message"  class="text-center" style="display: none;"></div>
                        </div>


                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Passbook front & back</label>
                            <input type="file" id="ea_passbook"  multiple=""  name="ea_passbook[]" class="form-control form-control-lg" placeholder="Passbook front & back"  tabindex="19" accept="image/jpeg, image/png"  />
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
                                            {{-- <a href="#" data-toggle="modal" data-target="#myModalsp{{ $m }}"> --}}
                                                <img id="img-bufferm" src="{{ asset($passbook[$m]) }}" width="100" height="100">
                                                @php
                                                    $valen = $passbook[$m] . "#" . $Affiliate->id;
                                                    $deleencde = base64_encode($valen);
                                                @endphp
                                            {{-- </a> --}}
                                            <br>
                                            <button id="remv" type="button" name="remv" class="btn btn-danger" onClick="DeltPassbookImag('{{ $deleencde }}');">X</button>
                                        </div>

                                        {{-- <div class="modal fade" id="myModalsp{{ $m }}" tabindex="-1" role="dialog" aria-labelledby="myModalspLabel" aria-hidden="true" style="width: 80%;">
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
                                        </div> --}}
                                    @endfor
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div id="pass_gal-message"  class="text-center" style="display: none;"></div>
                        </div>








                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Upload Photo</label>
                            <input type="file" id="ea_uplodphoto"  name="ea_uplodphoto[]" class="form-control form-control-lg" placeholder="Passbook front & back"  tabindex="19" accept="image/jpeg, image/png"  />
                            <label for="ea_uplodphoto" class="error"></label>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" align="left">
                                    <div id="eimage-preview_photo" class="row"></div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group" align="center">
                                <div class="row">
                                    @for($m = 0; $m < $totphotoimg; $m++)
                                        <div class="col-md-3">
                                            {{-- <a href="#" data-toggle="modal" data-target="#myModalsph{{ $m }}"> --}}
                                                <img id="img-bufferm" src="{{ asset($photos[$m]) }}" width="100" height="100">
                                                @php
                                                    $valen = $photos[$m] . "#" . $Affiliate->id;
                                                    $deleencde = base64_encode($valen);
                                                @endphp
                                            {{-- </a> --}}
                                            <br>
                                            <button id="remv" type="button" name="remv" class="btn btn-danger" onClick="DeltPhotosImag('{{ $deleencde }}');">X</button>
                                        </div>

                                        {{-- <div class="modal fade" id="myModalsph{{ $m }}" tabindex="-1" role="dialog" aria-labelledby="myModalsphLabel" aria-hidden="true" style="width: 80%;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="{{ asset($photos[$m]) }}" class="img-fluid">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                    @endfor
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div id="photo_gal-message"  class="text-center" style="display: none;"></div>
                        </div>






                    </div>
                    <div class="col-md-4">

                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Direct Affiliate</label>
                            <input type="text" class="form-control form-control-lg" id="edirectafflte" name="edirectafflte" value="{{ $Affiliate->direct_affiliate }}" >
                            <label for="edirectafflte" class="error"></label>
                        </div>

                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Co-Ordinator</label>
                            <input type="text" class="form-control form-control-lg" id="ecoordinater" name="ecoordinater" value="{{ $Affiliate->aff_coordinator }}">
                            <label for="ecoordinater" class="error"></label>
                        </div>

                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Account Holder Name</label>
                            <input type="text" id="ea_accname" name="ea_accname"  maxlength="50"  class="form-control form-control-lg" placeholder="Account Holder Name"  tabindex="25" value="{{ $Affiliate->account_holder_name }}"/>
                            <label for="ea_accname" class="error"></label>
                        </div>

                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Account Number</label>
                            <input type="text" id="ea_accno" name="ea_accno"  maxlength="20"  class="form-control form-control-lg" placeholder="Account Number"  tabindex="26" value="{{ $Affiliate->account_no }}" />
                            <label for="ea_accno" class="error"></label>
                        </div>

                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Bank Name</label>
                            <select class="form-select form-control form-control-lg" name="ebank_name"  aria-label="Default select example" id="ebank_name" required  tabindex="27" >
                                <option value="">Select Bank Name</option>
                                    @foreach ($bank_types as $banktype)
                                        <option value="{{ $banktype->id }}"  @if($Affiliate->bank_type == $banktype->id) selected @endif>{{ $banktype->bank_name }}</option>
                                    @endforeach
                            </select>
                            <label for="bank_name" class="error"></label>
                        </div>

                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Bank Country</label>
                            <select class="form-select form-control form-control-lg" name="ebank_country"  aria-label="Default select example" id="ebank_country" required  tabindex="28" >
                                <option value="">Select country</option>
                                    @foreach ($countries as $bankcontry)
                                        <option value="{{ $bankcontry->id }}" @if($Affiliate->bank_country == $bankcontry->id) selected @endif>{{ $bankcontry->country_name }}</option>
                                    @endforeach
                            </select>
                            <label for="ebank_country" class="error"></label>
                        </div>

                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Bank State</label>
                            <select class="form-select form-control form-control-lg" name="ebank_state"  aria-label="Default select example" id="ebank_state" required  tabindex="27" >
                                <option value="">Select state</option>
                                    @foreach ($bankstates as $bankstate)
                                        <option value="{{ $bankstate->id }}" @if ($bankstate->id == $Affiliate->bank_state) selected @endif>{{ $bankstate->state_name }}</option>
                                    @endforeach
                            </select>
                            <label for="bank_state" class="error"></label>
                        </div>

                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Bank district</label>
                            <select class="form-select form-control form-control-lg" name="ebank_dist"  aria-label="Default select example" id="ebank_dist" required  tabindex="28" >
                                <option value="">Select district</option>
                                    @foreach ($bankdistricts as $bankdist)
                                    <option value="{{ $bankdist->id }}" @if (($bankdist->id == $Affiliate->bank_dist) && ($bankdist->state_id == $Affiliate->bank_state)) selected @endif>{{ $bankdist->district_name }}</option>
                                    @endforeach
                            </select>
                            <label for="bank_dist" class="error"></label>
                        </div>


                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Branch Name</label>
                            <select class="form-select form-control form-control-lg" name="ebranch_name"  aria-label="Default select example" id="ebranch_name" required  tabindex="29" >
                                <option value="">Select Branch</option>
                                    @foreach ($branchdetails as $bankbranch)
                                    <option value="{{ $bankbranch->id }}" @if ($bankbranch->id == $Affiliate->branch_code) selected @endif>{{ $bankbranch->branch_name }}</option>
                                    @endforeach

                            </select>
                            <label for="ebranch_name" class="error"></label>
                        </div>


                        <div class="form-outline mb-3"><label class="lblname" for="lblname">IFSC Code</label>
                            <input type="text" id="ebranchifsc" name="ebranchifsc" readonly  maxlength="20"  class="form-control form-control-lg" placeholder="IFSC Code" required  tabindex="26" value="{{ $Affiliate->ifsc_code }}" />
                            <label for="ebranchifsc" class="error"></label>
                        </div>


                        <div class="form-outline mb-3"><label class="lblname" for="lblname">Branch Address</label>
                            <textarea id="ebranchaddress" name="ebranchaddress" readonly placeholder="Branch Address" class="form-control form-control-lg"  tabindex="25" required >{{ $Affiliate->branch_address }}</textarea>
                            <label for="ebranchaddress" class="error"></label>
                        </div>







                        <div class="checkbox form-check-inline">
                            <input class="form-check-input" type="checkbox" id="es_termcondtn" name="es_termcondtn" value="1" required tabindex="26" {{ $Affiliate->terms_condition == 1 ? 'checked' : '' }}>
                            <label class="inlineCheckbox1" for="es_termcondtn"> Accept Terms & Conditions </label>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div style="float:right">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>




                    <div class="col-md-12">
                        <div id="affliterupdte-message"  class="text-center" style="display: none;"></div>
                    </div>


                 </div>
                </div>
                </form>

<!-- Modal Add new Close -->



<script>

        $('#ecountry').change(function () {
            $('#edistrict').empty();
            var countryId = $(this).val();
            if (countryId) {
                $.get("/getStates/" + countryId, function (data) {
                    $('#estate').empty().append('<option value="">Select State</option>');
                    $.each(data, function (index, state) {
                        $('#ebranch_name').empty();
                        $('#ebranchifsc').val('');
                        $('#ebranchaddress').val('');
                        $('#estate').append('<option value="' + state.id + '">' + state.state_name + '</option>');
                    });
                });
            }
        });

        $('#estate').change(function () {
            var stateId = $(this).val();
            if (stateId) {
                $.get("/getDistricts/" + stateId, function (data) {
                    $('#edistrict').empty().append('<option value="">Select District</option>');
                    $.each(data, function (index, district) {
                        $('#ebranch_name').empty();
                        $('#ebranchifsc').val('');
                        $('#ebranchaddress').val('');
                        $('#edistrict').append('<option value="' + district.id + '">' + district.district_name + '</option>');
                    });
                });
            }
        });

        $('#ebank_country').change(function () {
            $('#ebank_dist').empty();
            var countryId = $(this).val();
            if (countryId) {
                $.get("/getStates/" + countryId, function (data) {
                    $('#ebank_state').empty().append('<option value="">Select State</option>');
                    $.each(data, function (index, state) {
                        $('#ebranch_name').empty();
                        $('#ebranchifsc').val('');
                        $('#ebranchaddress').val('');
                        $('#ebank_state').append('<option value="' + state.id + '">' + state.state_name + '</option>');
                    });
                });
            }
        });

        $('#ebank_state').change(function () {
            var stateId = $(this).val();
            if (stateId) {
                $.get("/getDistricts/" + stateId, function (data) {
                    $('#ebank_dist').empty().append('<option value="">Select District</option>');
                    $.each(data, function (index, district) {
                        $('#ebranch_name').empty();
                        $('#ebranchifsc').val('');
                        $('#ebranchaddress').val('');
                        $('#ebank_dist').append('<option value="' + district.id + '">' + district.district_name + '</option>');
                    });
                });
            }
        });


        $('#ebank_dist').change(function () {
        var bankName = $('#ebank_name').val();
        var bankCountry = $('#ebank_country').val();
        var bankState = $('#ebank_state').val();
        var bankDist = $('#ebank_dist').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{ route("getBankBranches") }}',
                type: 'POST',
                data: {
                    bank_name: bankName,bank_country: bankCountry,bank_state: bankState,bank_dist: bankDist,_token: csrfToken
                },
                success: function (data) {
                    var branchSelect = $('#ebranch_name');
                    $('#ebranchifsc').val('');
                    $('#ebranchaddress').val('');
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


        $('#ebranch_name').change(function () {
            var branchId = $(this).val();
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            if (branchId) {
            $.ajax({
                url: '{{ route("getIFSCode") }}',
                type: 'POST',
                data: {
                    branchId: branchId,_token: csrfToken
                },
                success: function (data) {
                    $.each(data, function (index, bank_dets) {
                        $('#ebranchifsc').val(bank_dets.ifsc_code);
                        $('#ebranchaddress').val(bank_dets.branch_address);
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                    });
                },
                error: function () {
                    console.log('Error fetching branches');
                    $('#ebranchifsc').val('');
                    $('#ebranchaddress').val('');
                    $('#loading-image').fadeOut();
                    $('#loading-overlay').fadeOut();
                }
            });
        }
        else{
            $('#ebranchifsc').val('');
            $('#ebranchaddress').val('');
            $('#loading-image').fadeOut();
            $('#loading-overlay').fadeOut();

        }
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
                            var img = $('<img>').attr('src', event.target.result).addClass('img-responsive image img-thumbnail').attr('width', '100');
                            var removeBtn = $('<button>').addClass('btn btn-danger remove-btns').attr('title', 'Remove Image').append('X').attr('role', file.name);

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
                            var img = $('<img>').attr('src', event.target.result).addClass('img-responsive image img-thumbnail').attr('width', '100');
                            var removeBtn = $('<button>').addClass('btn btn-danger remove-btns-pass').attr('title', 'Remove Image').append('X').attr('role', file.name);

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
                            var img = $('<img>').attr('src', event.target.result).addClass('img-responsive image img-thumbnail').attr('width', '100');
                            var removeBtn = $('<button>').addClass('btn btn-danger remove-btns-uphoto').attr('title', 'Remove Image').append('X').attr('role', file.name);

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
                url: '{{ route("AdmAffiliateUpdate") }}',
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
                    $('#affliterupdte-message').text('Affiliate details successfully updated!').fadeIn();
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

