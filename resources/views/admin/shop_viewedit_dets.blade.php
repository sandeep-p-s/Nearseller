
@php
    //$open_close_time = $sellerDetails->open_close_time;
    $open_close_time = $sellerDetails->open_close_time;
    if($open_close_time=='' || $open_close_time=='NULL')
        {
            $opentime = '';
            $closetime = '';

        }
    else {
        $expldopenclose = explode('-', $open_close_time);
        $opentime = $expldopenclose[0];
        $closetime = $expldopenclose[1];

    }

    $gallery_dets=$sellerDetails->shop_photo;
    $qrgallerydetsarray = json_decode($gallery_dets);
    $qrgallery=$qrgallerydetsarray->fileval;
    $qrqrgalleryval = json_decode(json_encode($qrgallery),true);
    $totimg = count($qrqrgalleryval);
@endphp



                <form id="SellerRegFormEdit" enctype="multipart/form-data" method="POST">
                  <input type="hidden" id="shopid" name="shopid" value="{{ $sellerDetails->id }}"  class="form-control form-control-lg" maxlength="50"  placeholder="Shop id" required  tabindex="1" />
                <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-outline mb-3">
                            <input type="text" id="s_name" name="s_name" value="{{ $sellerDetails->shop_name }}"  class="form-control form-control-lg" maxlength="50"  placeholder="Shop Name" required  tabindex="1" />
                            <label for="s_name" class="error"></label>
                        </div>
                        <div class="form-outline mb-3">
                            <input type="text" id="s_ownername" name="s_ownername"  value="{{ $sellerDetails->owner_name }}" class="form-control form-control-lg"  maxlength="50"   placeholder="Owner Name" required tabindex="2" />
                            <label for="s_ownername" class="error"></label>
                        </div>
                        <div class="form-outline mb-3">
                            <input type="text" id="s_mobno" name="s_mobno" value="{{ $sellerDetails->shop_mobno }}"  class="form-control form-control-lg"  maxlength="10"  placeholder="Mobile No" required tabindex="3"  onchange="exstmobno(this.value,'2')" />
                            <label for="s_mobno" class="error"></label>
                            <div id="smob-message"  class="text-center" style="display: none;"></div>
                        </div>
                        <div class="form-outline mb-3">
                            <input type="email" id="s_email" name="s_email"  value="{{ $sellerDetails->shop_email }}"  class="form-control form-control-lg"  maxlength="35"  placeholder="Email ID" required tabindex="4"  onchange="exstemilid(this.value,'2')" />
                            <label for="s_email" class="error"></label>
                            <div id="semil-message"  class="text-center" style="display: none;"></div>
                        </div>
                        <div class="form-outline mb-3">
                            <input type="text" id="s_refralid" name="s_refralid"  value="{{ $sellerDetails->referal_id }}"  class="form-control form-control-lg"  maxlength="50"  placeholder="Referral ID" tabindex="5" onchange="checkrefrelno(this.value,'1')"/>
                            <div id="s_refralid-message"  class="text-center" style="display: none;"></div>
                        </div>

                        <div class="form-outline mb-3">
                            <select class="form-select form-control form-control-lg" id="s_busnestype" name="s_busnestype"  required tabindex="6">
                                <option value="" >Business Type</option><br/>
                                    @foreach ($business as $busnes)
                                        <option value="{{ $busnes->id }}" @if ($busnes->id == $sellerDetails->busnes_type) selected @endif >{{ $busnes->business_name }}</option>
                                    @endforeach
                            </select>
                            <label for="s_busnestype" class="error"></label>
                        </div>
                        <div class="form-outline mb-3">
                            <select class="form-select form-control form-control-lg" id="s_shopservice" name="s_shopservice" required tabindex="7">
                                <option value="">Shop/Service Type</option><br/>
                                @foreach ($shopservice as $shopser)
                                        <option value="{{ $shopser->id }}" @if ($shopser->id == $sellerDetails->shop_service_type) selected @endif>{{ $shopser->service_name }}</option>
                                    @endforeach
                            </select>
                            <label for="s_shopservice" class="error"></label>
                        </div>
                        <div class="form-outline mb-3">
                            <select class="form-select form-control form-control-lg" id="s_shopexectename" name="s_shopexectename" required tabindex="8" >
                                <option value="">Shop Adding Executive Name</option><br/>
                                    @foreach ($executives as $exec)
                                        <option value="{{ $exec->id }}" @if ($exec->id == $sellerDetails->shop_executive) selected @endif>{{ $exec->executive_name }}</option>
                                    @endforeach
                            </select>
                            <label for="s_shopexectename" class="error"></label>
                        </div>
                        <div class="form-outline mb-3">
                            <input type="text" id="s_lisence" name="s_lisence" value="{{ $sellerDetails->shop_licence }}" class="form-control form-control-lg"  maxlength="25"  placeholder="License Number" required  tabindex="10"/>
                            <label for="s_lisence" class="error"></label>
                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-outline mb-3">
                            <input type="text" id="s_buldingorhouseno" name="s_buldingorhouseno" value="{{ $sellerDetails->house_name_no }}" maxlength="100"  class="form-control form-control-lg" placeholder="Building/House Name & Number" required  tabindex="11" />
                            <label for="s_buldingorhouseno" class="error"></label>
                        </div>
                        <div class="form-outline mb-3">
                            <input type="text" id="s_locality" name="s_locality" value="{{ $sellerDetails->locality }}" maxlength="100"  class="form-control form-control-lg"placeholder="Locality" required  tabindex="12" />
                            <label for="s_locality" class="error"></label>
                        </div>
                        <div class="form-outline mb-3">
                            <input type="text" id="s_villagetown" name="s_villagetown" value="{{ $sellerDetails->village }}" maxlength="100"  class="form-control form-control-lg" placeholder="Village/Town/Municipality" required  tabindex="13" />
                            <label for="s_villagetown" class="error"></label>
                        </div>
                        <div class="form-outline mb-3">
                            <select class="form-select form-control form-control-lg" name="country"  aria-label="Default select example" id="country" required  tabindex="14" >
                                <option value="">Select country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" @if ($country->id == $sellerDetails->country) selected @endif>{{ $country->country_name }}</option>
                                    @endforeach
                            </select>
                            <label for="country" class="error"></label>
                        </div>
                        <div class="form-outline mb-3">
                            <select class="form-select form-control form-control-lg" name="state" aria-label="Default select example" id="state" required  tabindex="15">
                                @foreach ($states as $state)
                                <option value="{{ $state->id }}" @if ($state->id == $sellerDetails->state) selected @endif>{{ $state->state_name }}</option>
                                @endforeach
                            </select>
                            <label for="state" class="error"></label>
                        </div>
                        <div class="form-outline mb-3">
                            <select class="form-select form-control form-control-lg" aria-label="Default select example" id="district" name="district" required  tabindex="16">
                                @foreach ($districts as $dist)
                                <option value="{{ $dist->id }}" @if (($dist->id == $sellerDetails->district) && ($dist->state_id == $sellerDetails->state)) selected @endif>{{ $dist->district_name }}</option>
                                @endforeach
                            </select>
                            <label for="district" class="error"></label>
                        </div>

                        <div class="form-outline mb-3">
                            <input type="text" id="s_pincode" name="s_pincode"  value="{{ $sellerDetails->pincode }}"  maxlength="6"  class="form-control form-control-lg" placeholder="Pin Code" required  tabindex="17" />
                            <label for="s_pincode" class="error"></label>
                        </div>
                        <div class="form-outline mb-3">
                            <input type="text" id="s_googlelink" name="s_googlelink"  value="{{ $sellerDetails->googlemap }}"   id class="form-control form-control-lg"   placeholder="Google map link location" required  tabindex="18" />
                            <label for="s_googlelink" class="error"></label>
                        </div>
                        <div class="form-outline mb-3">
                            <input type="file" id="s_photo"  multiple=""  name="s_photo[]" class="form-control form-control-lg" placeholder="Shop Photo" tabindex="19" accept="image/jpeg, image/png"  />
                            <label for="s_photo" class="error"></label>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" align="left">
                                    <div id="image-preview" class="row"></div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group" align="center">
                                <div class="row">
                                    @for($m = 0; $m < $totimg; $m++)
                                        <div class="col-md-3">
                                            <a href="#" data-toggle="modal" data-target="#myModal{{ $m }}">
                                                <img id="img-bufferm" src="{{ asset($qrgallery[$m]) }}" width="100" height="100">
                                                @php
                                                    $valen = $qrgallery[$m] . "#" . $sellerDetails->id;
                                                    $deleencde = base64_encode($valen);
                                                @endphp
                                            </a><br>
                                            <button id="remv" type="button" name="remv" class="btn btn-danger" onClick="DeltImagGalry('{{ $deleencde }}');">X</button>
                                        </div>

                                        <div class="modal fade" id="myModal{{ $m }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width: 80%;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="{{ asset($qrgallery[$m]) }}" class="img-responsive">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="col-md-4">

                        <div class="form-outline mb-3">
                            <input type="text" id="s_gstno" name="s_gstno"  value="{{ $sellerDetails->shop_gstno }}"  maxlength="25"  class="form-control form-control-lg" placeholder="GST Number" required   tabindex="20" />
                            <label for="s_gstno" class="error"></label>
                        </div>
                        <div class="form-outline mb-3">
                            <input type="text" id="s_panno" name="s_panno"  value="{{ $sellerDetails->shop_panno }}"  maxlength="12"  class="form-control form-control-lg" placeholder="PAN Number" required  tabindex="21" />
                            <label for="s_panno" class="error"></label>
                        </div>


                        <div class="form-outline mb-3"><label class="esdate" for="esdate"> Establishment Date</label>
                            <input type="date" id="s_establishdate" name="s_establishdate"  value="{{ $sellerDetails->establish_date }}"  maxlength="10"  class="form-control form-control-lg" placeholder="Establishment Date"  tabindex="22" />
                            <label for="s_establishdate" class="error"></label>
                        </div>


                        <div class="form-outline mb-3"><label> Open Time</label>
                            <div class="input-group date" id="from-time-picker" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#from-time-picker" id="opentime" name="opentime"  value="{{ $opentime }}"  required  maxlength="10" />
                                <label for="opentime" class="error"></label>
                            </div>
                        </div>

                        <div class="form-outline mb-3"><label > Close Time</label>
                            <div class="input-group date" id="from-time-picker" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#to-time-picker" id="closetime" name="closetime"  value="{{ $closetime }}"  required maxlength="10" />
                                <label for="closetime" class="error"></label>
                            </div>
                        </div>


                        <div class="form-outline mb-3"><label class="regis_date" for="regis_date"> Registration Date</label>
                            <input type="date" id="s_registerdate" name="s_registerdate"  value="{{ $sellerDetails->registration_date }}"   maxlength="10"  class="form-control form-control-lg" placeholder="Registration Date"  tabindex="24" maxlength="10" />
                            <label for="s_registerdate" class="error"></label>
                        </div>

                        <div class="checkbox form-check-inline">
                            <input class="form-check-input" type="checkbox" id="s_termcondtn" name="s_termcondtn" value="1" required tabindex="25" {{ $sellerDetails->term_condition == 1 ? 'checked' : '' }}  >
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

<!-- Modal Add new Close -->



<script>


            $(function() {
                var datetimeFormat = 'hh:mm A';
                $('#from-time-picker, #to-time-picker').datetimepicker({
                    format: datetimeFormat,
                    icons: {
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down"
                    }
                });
                $('#from-time-picker, #to-time-picker').on('click', function() {
                    $(this).datetimepicker('toggle');
                });
                $('#from-time-picker, #to-time-picker').on('show.datetimepicker', function() {
                    $(this).datetimepicker('date', moment().format(datetimeFormat));
                });
			});

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


        $("#SellerRegFormEdit").validate({

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
                    // required: true,
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



            $('#SellerRegFormEdit').submit(function(e) {
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
                    $('#SellerRegFormEdit')[0].reset();
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




    </script>

