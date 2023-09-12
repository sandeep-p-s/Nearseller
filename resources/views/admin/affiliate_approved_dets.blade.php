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

@foreach ($userdets as $affapp)
@php
    $affiliteapp=$affapp->approved;
    $userstus=$affapp->user_status;
@endphp
@endforeach



<form id="AffilateRegFormApproved" enctype="multipart/form-data" method="POST">
    <input type="hidden" id="aaffiliateidhid" name="aaffiliateidhid" value="{{ $Affiliate->id }}" class="form-control form-control-lg" maxlength="50" placeholder="Affiliate id" required tabindex="1" />
    <input type="hidden" id="aaffiliateuseridhid" name="aaffiliateuseridhid" value="{{ $Affiliate->user_id }}" class="form-control form-control-lg" maxlength="50" placeholder="User id" required tabindex="1" />
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
                                {{ $Affiliate->dob }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">Gender</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $Affiliate->gender }}
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
                                {{ $Affiliate->profession_name }}
                            </div>
                        </div>
                        <hr class="new_hr">

                        @if($Affiliate->profession==3)
                        <div class="row">
                            <label class="col-xl-6 ">Other Professions</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $Affiliate->other_profession }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        @endif
                        <div class="row">
                            <label class="col-xl-6 ">Marital Status</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $Affiliate->mr_name }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">Religion</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $Affiliate->religion_name }}
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
                            <label class="col-xl-6 ">District</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $Affiliate->district_name }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">State</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $Affiliate->state_name }}
                            </div>
                        </div>

                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">Country</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $Affiliate->country_name }}
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
                                {{ $Affiliate->registration_date }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">

                    <div class="card-body">



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
                                {{ $Affiliate->bank_name }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">Bank district</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $Affiliate->bank_district_name }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">Bank State</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $Affiliate->bank_state_name }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">Bank Country</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $Affiliate->bank_country_name }}
                            </div>
                        </div>



                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6 ">Branch Name</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $Affiliate->branch_name }}
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


                        <hr class="new_hr"><div class="form-group row">
                            <label class="col-xl-6">Accept Terms & Conditions</label>
                            <div class="col-xl-6 align-self-center">
                                <span class="badge  p-2 {{$Affiliate->terms_condition == '1' ? 'badge badge-success' : 'badge badge-danger' }}">
                                    {{ $Affiliate->terms_condition== '1' ? 'Accepted' : 'No' }}
                                </span>
                            </div>
                        </div>



                        <hr class="new_hr"><div class="form-group row">
                            <label class="col-xl-6">User Status</label>
                            <div class="col-xl-6 align-self-center">
                                <span class="badge  p-2 {{ $userstus === 'Y' ? 'badge badge-success' : 'badge badge-danger' }}">
                                    {{ $userstus === 'Y' ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </div>

                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6">Approved</label>
                            <div class="form-outline mb-3">
                                <select class="form-select form-control form-control-lg" name="approvedstatus"  id="approvedstatus" required  tabindex="1" >
                                    <option value="">Select</option>
                                    <option value="Y"  @if ($affiliteapp=='Y') selected @endif>Approved</option>
                                    <option value="N"  @if ($affiliteapp=='N') selected @endif>Not Approved</option>

                                </select>
                                <label for="approvedstatus" class="error"></label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <!-- Aadhar Image Slider -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div id="aadharImageSlider" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @for ($i = 0; $i < $totadarimg; $i++)
                                    <div class="carousel-item @if ($i === 0) active @endif">
                                        <img src="{{ asset($aadhar_fileval[$i]) }}" class="d-block w-100" alt="Aadhar Image {{ $i }}">
                                    </div>
                                @endfor
                            </div>
                            <a class="carousel-control-prev" href="#aadharImageSlider" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#aadharImageSlider" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

                <!-- Passbook Image Slider -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div id="passbookImageSlider" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @for ($i = 0; $i < $totpassimg; $i++)
                                        <div class="carousel-item @if ($i === 0) active @endif">
                                            <img src="{{ asset($passbook_fileval[$i]) }}" class="d-block w-100" alt="Passbook Image {{ $i }}">
                                        </div>
                                    @endfor
                                </div>
                                <a class="carousel-control-prev" href="#passbookImageSlider" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#passbookImageSlider" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Photo Image Slider -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div id="photoImageSlider" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @for ($i = 0; $i < $totphotoimg; $i++)
                                        <div class="carousel-item @if ($i === 0) active @endif">
                                            <img src="{{ asset($photosval[$i]) }}" class="d-block w-100" alt="Photo Image {{ $i }}">
                                        </div>
                                    @endfor
                                </div>
                                <a class="carousel-control-prev" href="#photoImageSlider" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#photoImageSlider" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
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
            <div id="appaffiliatereg-message"  class="text-center" style="display: none;"></div>
        </div>
</form>

<!-- Modal Add new Close -->



<script>
            $("#AffilateRegFormApproved").validate({

            rules: {

                approvedstatus: {
                    required: true,

                },



            },
            messages: {
                approvedstatus: {
                    required: "Please select an approved status."
                },

            },
            });



            $('#AffilateRegFormApproved').submit(function(e) {
            e.preventDefault();
            if ($(this).valid()) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var approvedstatus= $('#approvedstatus').val();
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            $.ajax({
                url: '{{ route("AdmsAffiliateApproved") }}',
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
                    if(approvedstatus=='Y')
                    {
                        var approve="Successfully Approved!";
                    }
                    else{
                        var approve="Not Approved!";
                    }
                    $('#appaffiliatereg-message').text(approve).fadeIn();
                    $('#appaffiliatereg-message').addClass('success-message');
                    setTimeout(function() {
                        $('#appaffiliatereg-message').fadeOut();
                    }, 5000); // 5000 milliseconds = 5 seconds
                    $('#AffilateRegFormApproved')[0].reset();
                    $('#loading-image').fadeOut();
                    $('#loading-overlay').fadeOut();
                    $('#AffiliateApprovedModal').modal('hide');
                    shwdets();


                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    $('#appaffiliatereg-message').text('Inactive User. So not be approved.').fadeIn();
                    $('#appaffiliatereg-message').addClass('error');
                    setTimeout(function() {
                        $('#appaffiliatereg-message').fadeOut();
                    }, 5000);
                    $('#loading-image').fadeOut();
                    $('#loading-overlay').fadeOut();
                    $('#AffiliateApprovedModal').modal('show');

                }
            });
            }
            });


            $(document).ready(function () {

                var slideIndexAadhar = 1;
                var slideIndexPassbook = 1;
                var slideIndexPhoto = 1;

                showDivs(slideIndexAadhar, 'aadharImageSlider');
                showDivs(slideIndexPassbook, 'passbookImageSlider');
                showDivs(slideIndexPhoto, 'photoImageSlider');

                function plusDivs(n, sliderId) {
                    if (sliderId === 'aadharImageSlider') {
                        showDivs(slideIndexAadhar += n, sliderId);
                    } else if (sliderId === 'passbookImageSlider') {
                        showDivs(slideIndexPassbook += n, sliderId);
                    } else if (sliderId === 'photoImageSlider') {
                        showDivs(slideIndexPhoto += n, sliderId);
                    }
                }
                function currentDiv(n, sliderId) {
                    if (sliderId === 'aadharImageSlider') {
                        showDivs(slideIndexAadhar = n, sliderId);
                    } else if (sliderId === 'passbookImageSlider') {
                        showDivs(slideIndexPassbook = n, sliderId);
                    } else if (sliderId === 'photoImageSlider') {
                        showDivs(slideIndexPhoto = n, sliderId);
                    }
                }

                function showDivs(n, sliderId) {
                    var i;
                    var x = document.getElementById(sliderId).getElementsByClassName('carousel-item');
                    if (n > x.length) { n = 1 }
                    if (n < 1) { n = x.length }
                    for (i = 0; i < x.length; i++) {
                        x[i].style.display = 'none';
                    }
                    x[n - 1].style.display = 'block';
                }
                $('.carousel-control-prev').on('click', function () {
                    var sliderId = $(this).attr('href').substring(1);
                    plusDivs(-1, sliderId);
                });

                $('.carousel-control-next').on('click', function () {
                    var sliderId = $(this).attr('href').substring(1);
                    plusDivs(1, sliderId);
                });
            });








</script>
