@php
    //$open_close_time = $sellerDetails->open_close_time;
    $open_close_time = $sellerDetails->open_close_time;
    if ($open_close_time == '' || $open_close_time == 'NULL') {
        $opentime = '';
        $closetime = '';
    } else {
        $expldopenclose = explode('-', $open_close_time);
        $opentime = $expldopenclose[0];
        $closetime = $expldopenclose[1];
    }

    $gallery_dets = $sellerDetails->shop_photo;
    $qrgallerydetsarray = json_decode($gallery_dets);
    $qrgallery = $qrgallerydetsarray->fileval;
    $qrqrgalleryval = json_decode(json_encode($qrgallery), true);
    $totimg = count($qrqrgalleryval);

    $socialmedia = $sellerDetails->socialmedia;
    $qrsocialmediaarray = json_decode($socialmedia);
    $qrsocialmedia = $qrsocialmediaarray->mediadets;
    $qrsocialmediaval = json_decode(json_encode($qrsocialmedia), true);
    $tcondition = $sellerDetails->term_condition;

@endphp

@foreach ($userstus as $shopapp)
    @php
        $sellerapproved = $shopapp->approved;
        $userstus = $shopapp->user_status;
    @endphp
@endforeach

@if ($tcondition != '1')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <label class="col-xl-12 text-center error">{{ $shoporservice }}  - Registration not completed</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <form id="SellerRegFormApproved" enctype="multipart/form-data" method="POST">
        <input type="hidden" id="shopidhidapp" name="shopidhidapp" value="{{ $sellerDetails->user_id }}"
            class="form-control form-control-lg" maxlength="50" placeholder="Shop User id" required tabindex="1" />

        <input type="hidden" id="shopidhidselapp" name="shopidhidselapp" value="{{ $sellerDetails->id }}"
            class="form-control form-control-lg" maxlength="50" placeholder="Shop Seller id" required tabindex="1" />




        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    {{-- <div class="card-header " id="headingOne" style="background-color: #6374ff;">
                                    <a href="" class="text-light d-flex justify-content-between" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <span class="align-self-center">Personal Details </span> </a>
                                </div> --}}
                    <div class="card-body">
                        <div class="row">
                            <label class="col-xl-6">{{ $shoporservice }} Name</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $sellerDetails->shop_name }}
                            </div>
                        </div>


                        <hr class="new_hr">
                        <div class="row">
                            <label class="col-xl-6">{{ $shoporservice }} Owner Name</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $sellerDetails->owner_name }}
                            </div>
                        </div>


                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6">Mobile No</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $sellerDetails->shop_mobno }}
                            </div>
                        </div>
                        @if ($sellerDetails->shop_email != '')
                            <hr class="new_hr">
                            <div class="form-group row">
                                <label class="col-xl-6">Email ID</label>
                                <div class="col-xl-6 align-self-center">
                                    {{ $sellerDetails->shop_email }}
                                </div>
                            </div>
                        @endif
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6">Referral ID</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $sellerDetails->referal_id }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6">Business Type</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $sellerDetails->business_name }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6">{{ $shoporservice }} category Type</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $sellerDetails->service_category_name }}
                            </div>
                        </div>
                        {{-- <hr class="new_hr">
                    <div class="form-group row">
                        <label class="col-xl-6">{{ $shoporservice }} Sub Category Type</label>
                        <div class="col-xl-6 align-self-center">
                            {{ $sellerDetails->sub_category_name }}
                        </div>
                    </div> --}}

                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6">{{ $shoporservice }} Type</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $sellerDetails->service_name }}
                            </div>
                        </div>

                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6">{{ $shoporservice }} Executive Name</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $executives->name }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6">Social Media</label>

                            <div class="col-xl-6 align-self-center">
                                @php
                                    $qrsocialmediaval = json_decode(json_encode($qrsocialmedia), true);
                                    $mediaUrlcnt = count($qrsocialmedia);
                                @endphp

                                @if ($mediaUrlcnt > 0)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="icons">
                                                @foreach ($qrsocialmediaval as $mediaItem)
                                                    @php
                                                        $titurl = '';
                                                        $media = '';
                                                        switch ($mediaItem['mediatype']) {
                                                            case 1:
                                                                $titurl = 'facebook';
                                                                $media = '<i class="fa-brands fa-facebook" style="font-size: 25px;"></i>';
                                                                break;
                                                            case 2:
                                                                $titurl = 'instagram';
                                                                $media = '<i class="fa-brands fa-instagram" style="font-size: 25px;"></i>';
                                                                break;
                                                            case 3:
                                                                $titurl = 'linkedin';
                                                                $media = '<i class="fa-brands fa-linkedin" style="font-size: 25px;"></i>';
                                                                break;
                                                            case 4:
                                                                $titurl = 'website';
                                                                $media = '<i class="fa fa-globe" style="font-size: 25px;"></i>';
                                                                break;
                                                            case 5:
                                                                $titurl = 'youtube';
                                                                $media = '<i class="fa-brands fa-youtube" style="font-size: 25px;"></i>';
                                                                break;
                                                        }
                                                    @endphp

                                                    @if (!empty($mediaItem['mediaurl']))
                                                        <a href="{{ $mediaItem['mediaurl'] }}" class="btn btn-primary"
                                                            target="_blank" title="{{ $titurl }}">
                                                            {!! $media !!}
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>




                        <hr>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    {{-- <div class="card-header " id="headingOne" style="background-color: #6374ff;">
                                    <a href="" class="text-light d-flex justify-content-between" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <span class="align-self-center">Address</span> </a>
                                </div> --}}
                    <div class="card-body">
                        <div class="row">
                            <label class="col-xl-6">Building/House Name & Number</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $sellerDetails->house_name_no }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="row">
                            <label class="col-xl-6">Locality</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $sellerDetails->locality }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6">Village/Town/Municipality</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $sellerDetails->village }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6">Pincode</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $sellerDetails->pincode }}
                            </div>
                        </div>

                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6">District</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $sellerDetails->district_name }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6">State</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $sellerDetails->state_name }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6">Country</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $sellerDetails->country_name }}
                            </div>
                        </div>


                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6">Latitude (Google map location)</label>
                            <div class="col-xl-6 align-self-center">{{ $sellerDetails->latitude }}
                                {{-- <a href="{{ $sellerDetails->latitude }}" target="_blank"
                                title="Google map link location" class="success-message">Click Here</a> --}}
                            </div>
                        </div>


                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6">longitude (Google map location)</label>
                            <div class="col-xl-6 align-self-center">{{ $sellerDetails->longitude }}
                                {{-- <a href="{{ $sellerDetails->googlemap }}" target="_blank"
                                title="Google map link location" class="success-message">Click Here</a> --}}
                            </div>
                        </div>






                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6">Direct Affiliate</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $sellerDetails->direct_affiliate }}
                            </div>
                        </div>

                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6">Second Affiliate</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $sellerDetails->second_affiliate }}
                            </div>
                        </div>

                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6">{{ $shoporservice }} Co-Ordinator</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $sellerDetails->shop_coordinator }}
                            </div>
                        </div>




                        <hr>
                    </div>
                </div>
            </div>


            <div class="col-lg-4">
                <div class="card">
                    {{-- <div class="card-header " id="headingOne" style="background-color: #6374ff;">
                                    <a href="" class="text-light d-flex justify-content-between" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <span class="align-self-center">header</span> </a>
                                </div> --}}
                    <div class="card-body">
                        <div class="row">
                            <label class="col-xl-6">{{ $shoporservice }} License Number</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $sellerDetails->shop_licence }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="row">
                            <label class="col-xl-6">GST Number</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $sellerDetails->shop_gstno }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6">PAN Number</label>
                            <div class="col-xl-6 align-self-center">
                                {{ $sellerDetails->shop_panno }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6">Establishment Date</label>
                            <div class="col-xl-6 align-self-center">
                                {{ date('d-m-Y', strtotime($sellerDetails->establish_date)) }}
                            </div>
                        </div>
                        <hr class="new_hr">
                        <div class="form-group row">
                            <div class="col-xl-12 align-self-center"><label>Open and Close Time</label><br>
                                @if ($shopavailable->count() > 0)
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Days</th>
                                                <th>Open Time</th>
                                                <th>Close Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($shopavailable as $openclosetime)
                                                <tr>
                                                    <td>{{ $openclosetime->open_close_days }}</td>
                                                    <td>{{ $openclosetime->from_time }}</td>
                                                    <td>{{ $openclosetime->to_time }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <table>
                                        <tr>
                                            <td colspan="3" align="center">Not Found Open and Close Time</td>
                                        </tr>
                                    </table>
                                @endif
                            </div>
                        </div>

                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6">Registration Date</label>
                            <div class="col-xl-6 align-self-center">
                                {{ date('d-m-Y H:i:s', strtotime($sellerDetails->created_at)) }}
                            </div>
                        </div>
                        {{-- <hr class="new_hr">
                    <div class="form-group row">
                        <label class="col-xl-6">Manufacturing Details</label>
                        <div class="content-container">
                            <p class="content">
                                {{ $sellerDetails->manufactoring_details }}
                            </p>
                        </div>
                    </div> --}}



                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6">Accept Terms & Conditions</label>
                            <div class="col-xl-6 align-self-center">
                                <span
                                    class="badge  p-2 {{ $sellerDetails->term_condition == '1' ? 'badge badge-success' : 'badge badge-danger' }}">
                                    {{ $sellerDetails->term_condition == '1' ? 'Accepted' : 'No' }}
                                </span>
                            </div>
                        </div>

                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6">User Status</label>
                            <div class="col-xl-6 align-self-center">
                                <span
                                    class="badge  p-2 {{ $userstus === 'Y' ? 'badge badge-success' : 'badge badge-danger' }}">
                                    {{ $userstus === 'Y' ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </div>


                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6">Approved</label>
                            <div class="form-outline mb-3">
                                <select class="form-select form-control form-control-lg" name="approvedstatus"
                                    id="approvedstatus" required tabindex="1">
                                    <option value="">Select</option>
                                    <option value="Y" @if ($sellerapproved == 'Y') selected @endif>Approved
                                    </option>
                                    <option value="N" @if ($sellerapproved == 'N') selected @endif>Not
                                        Approved
                                    </option>

                                </select>
                                <label for="approvedstatus" class="error"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                @if ($totimg > 0)
                    <div class="card">
                        {{-- <div class="card-header " id="headingOne" style="background-color: #6374ff;">
                                    <a href="" class="text-light d-flex justify-content-between" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <span class="align-self-center">header</span> </a>
                                </div> --}}

                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="form-group" align="center">
                                    <div class="row">
                                        @for ($m = 0; $m < $totimg; $m++)
                                            <div class="col-md-3">
                                            </div>
                                            <div class="col-md-6">
                                                <div id="carouselIndicators{{ $m }}"
                                                    class="carousel slide mySlides" data-ride="carousel">
                                                    <div class="carousel-inner">
                                                        @for ($i = 0; $i < $totimg; $i++)
                                                            <div
                                                                class="carousel-item @if ($i === 0) active @endif">
                                                                <img src="{{ asset($qrgallery[$i]) }}"
                                                                    class="d-block w-100"
                                                                    alt="Image {{ $i }}">
                                                            </div>
                                                        @endfor
                                                    </div>
                                                    <a class="carousel-control-prev"
                                                        href="#carouselIndicators{{ $m }}" role="button"
                                                        data-slide="prev">
                                                        <span class="carousel-control-prev-icon"
                                                            aria-hidden="true"></span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="carousel-control-next"
                                                        href="#carouselIndicators{{ $m }}" role="button"
                                                        data-slide="next">
                                                        <span class="carousel-control-next-icon"
                                                            aria-hidden="true"></span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
            </div>
            <div class="col-lg-4"></div>

        </div>

        <div class="col-md-12">
            <div style="float:right">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>



    </form>
@endif
<!-- Modal Add new Close -->



<script>
    $("#SellerRegFormApproved").validate({

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



    $('#SellerRegFormApproved').submit(function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var approvedstatus = $('#approvedstatus').val();
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            $.ajax({
                url: '{{ route('AdmsellerApproved') }}',
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
                        $('#appshopreg-message').text(response.mesge).fadeIn();
                        $('#appshopreg-message').addClass('success-message');
                        setTimeout(function() {
                            $('#appshopreg-message').fadeOut();
                        }, 5000); // 5000 milliseconds = 5 seconds
                        $('#SellerRegFormApproved')[0].reset();
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#ShopApprovedModal').modal('hide');
                        shwdets();
                    } else if (response.result == 2) {
                        $('#appshopreg-message').text(response.mesge).fadeIn();
                        $('#appshopreg-message').addClass('error');
                        setTimeout(function() {
                            $('#appshopreg-message').fadeOut();
                        }, 5000); // 5000 milliseconds = 5 seconds
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#ShopApprovedModal').modal('hide');
                        shwdets();

                    } else {
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                    }
                }
            });
        }
    });

    $(document).ready(function() {

        var i = 1;
        var maxRows = 10;
        var j = parseInt($('#cntmedia').val());
        $('#addMoreRowssh').click(function(event) {

            event.preventDefault();
            if (i < maxRows) {
                i++;
                j++;

                var recRowmm = '<div class="row mb-5" id="added_fieldah' + i +
                    '"><div class="col-md-3 fv-row fv-plugins-icon-container"><select class="form-select form-control form-control-lg" id="mediatype' +
                    i + '" name="mediatype[' + j +
                    ']"><option selected="">Choose...</option><option value="1">Facebook</option><option value="2">Instagram</option><option value="3">Linked In</option><option value="4">Web site URL</option><option value="5">Youtub Video URL</option></select></div><div class="col-md-9 fv-row fv-plugins-icon-container"><div class="input-group"><input type="text"  id="mediaurl' +
                    i + '" name="mediaurl[' + j +
                    ']" class="form-control form-control-lg" placeholder="https://"  value="" tabindex="22"  maxlength="60"/><div align="right"><button id="removeRowsh' +
                    i +
                    '" type="button" name="add_fieldss" class="btn btn-danger" onclick="removeRowsh(' +
                    i + ');" >-</button></div></div></div>';
                $('#addedRowssh').append(recRowmm);
            }
        });

    });



    function removeRowdh(rowNum) {
        $('#added_fieldemh' + rowNum).remove();
    }

    function removeRowsh(rowNum) {
        $('#added_fieldah' + rowNum).remove();
    }



    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
        showDivs(slideIndex += n);
    }

    function currentDiv(n) {
        showDivs(slideIndex = n);
    }

    function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");
        if (n > x.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = x.length
        }
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" w3-white", "");
        }
        x[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " w3-white";
    }
</script>
