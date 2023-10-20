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
    if ($qrgallery != '') {
        $qrqrgalleryval = json_decode(json_encode($qrgallery), true);
        $totimg = count($qrqrgalleryval);
    } else {
        $totimg = 0;
    }
    $socialmedia = $sellerDetails->socialmedia;
    $qrsocialmediaarray = json_decode($socialmedia);
    $qrsocialmedia = $qrsocialmediaarray->mediadets;
    $qrsocialmediaval = json_decode(json_encode($qrsocialmedia), true);
    $sel_approved = $sellerDetails->seller_approved;
    $roleid = session('roleid');
    $userstatus = $sellerDetails->user_status;

@endphp



<form id="SellerRegFormEdit" enctype="multipart/form-data" method="POST">
    @if ($sel_approved == 'Y')
        <div class="col-md-12">
            <h3 style="text-align: center; color:#ff002b;">{{ $shoporservice }} Approved</h3>
        </div>
        <hr>
    @endif
    <input type="hidden" id="shopidhid" name="shopidhid" value="{{ $sellerDetails->id }}"
        class="form-control form-control-lg" maxlength="50" placeholder="Shop id" required tabindex="1" />
    <input type="hidden" id="etypeidhid" name="etypeidhid" value="{{ $typeid }}" />


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="form-outline mb-3"><label>{{ $shoporservice }} Name<span
                            class="text-danger">*</span></label>
                    <input type="text" id="es_name" name="es_name" value="{{ $sellerDetails->shop_name }}"
                        class="form-control form-control-lg" maxlength="50" placeholder="Shop Name" required
                        tabindex="1" />
                    <label for="es_name" class="error"></label>
                </div>


                <div class="form-outline mb-3"><label>Owner Name<span class="text-danger">*</span></label>
                    <input type="text" id="es_ownername" name="es_ownername" value="{{ $sellerDetails->owner_name }}"
                        class="form-control form-control-lg" maxlength="50" placeholder="Owner Name" required
                        tabindex="2" />
                    <label for="s_ownername" class="error"></label>
                </div>



                <div class="form-outline mb-3"><label>Mobile Number<span class="text-danger">*</span></label>
                    <input type="text" id="es_mobno" name="es_mobno" value="{{ $sellerDetails->shop_mobno }}"
                        class="form-control form-control-lg" maxlength="10" placeholder="Mobile No" required
                        tabindex="3" onchange="exstmobno(this.value,'2')"  oninput="numberOnlyAllowed(this)"/>
                    <label for="es_mobno" class="error"></label>
                    <div id="esmob-message" class="text-center" style="display: none;"></div>
                </div>
                <div class="form-outline mb-3"><label>Email ID</label>
                    <input type="email" id="es_email" name="es_email" value="{{ $sellerDetails->shop_email }}"
                        class="form-control form-control-lg" maxlength="35" placeholder="Email ID" tabindex="4"
                        onchange="exstemilid(this.value,'2')" />
                    <label for="es_email" class="error"></label>
                    <div id="esemil-message" class="text-center" style="display: none;"></div>
                </div>
                <div class="form-outline mb-3"><label>Referral ID</label>
                    <input type="text" id="es_refralid" name="es_refralid" value="{{ $sellerDetails->referal_id }}"
                        class="form-control form-control-lg" maxlength="50" placeholder="Referral ID" tabindex="5"
                        onchange="checkrefrelno(this.value,'3')" />
                    <div id="es_refralid-message" class="text-center" style="display: none;"></div>
                </div>

                <div class="form-outline mb-3" style="display: none;"><label>Business Type<span class="text-danger">*</span></label>
                    <select class="form-select form-control form-control-lg" id="es_busnestype" name="es_busnestype"
                        required tabindex="6">
                        @foreach ($business as $busnes)
                            <option value="{{ $busnes->id }}" @if ($busnes->id == $sellerDetails->busnes_type) selected @endif>
                                {{ $busnes->business_name }}</option>
                        @endforeach
                    </select>
                    <label for="es_busnestype" class="error"></label>
                </div>
                <div class="form-outline mb-3"><label>{{ $shoporservice }} Category<span
                            class="text-danger">*</span></label>
                    <select class="form-select form-control form-control-lg" id="es_shopservice" name="es_shopservice"
                        required tabindex="7">
                        <option value="">{{ $shoporservice }} Category</option><br />
                        @foreach ($shopservicecategory as $shopser)
                            <option value="{{ $shopser->id }}" @if ($shopser->id == $sellerDetails->shop_service_type) selected @endif>
                                {{ $shopser->service_category_name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="es_shopservice" class="error"></label>
                </div>




                {{-- <div class="form-outline mb-3"><label>{{ $shoporservice }} Sub Category</label>
                    <select class="form-select form-control form-control-lg" id="es_subshopservice"
                        name="es_subshopservice" required tabindex="7">
                        <option value="">{{ $shoporservice }} Sub Category</option><br />
                        @foreach ($shopservicesubcategory as $shoptyp)
                            <option value="{{ $shoptyp->id }}" @if ($shoptyp->id == $sellerDetails->service_subcategory_id) selected @endif>
                                {{ $shoptyp->sub_category_name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="es_subshopservice" class="error"></label>
                </div> --}}


                <div class="form-outline mb-3"><label>{{ $shoporservice }} Type<span
                            class="text-danger">*</span></label>
                    <select class="form-select form-control form-control-lg" id="es_shopservicetype"
                        name="es_shopservicetype" required tabindex="7">
                        <option value="">{{ $shoporservice }} Type</option><br />
                        @foreach ($shopservice as $shtypes)
                            <option value="{{ $shtypes->id }}" @if ($shtypes->id == $sellerDetails->shop_type) selected @endif>
                                {{ $shtypes->service_name }}</option>
                        @endforeach
                    </select>
                    <label for="es_shopservicetype" class="error"></label>
                </div>


                <div class="form-outline mb-3"><label>{{ $shoporservice }} Executive Name</label>
                    <select class="form-select form-control form-control-lg" id="es_shopexectename"
                        name="es_shopexectename" tabindex="8">
                        <option value="">{{ $shoporservice }} Executive Name</option><br />
                        @foreach ($executives as $exec)
                            <option value="{{ $exec->id }}" @if ($exec->id == $sellerDetails->shop_executive) selected @endif>
                                {{ $exec->executive_name }}</option>
                        @endforeach
                    </select>
                    <label for="es_shopexectename" class="error"></label>
                </div>

                <div class="form-outline mb-3"><label>Social Media</label>


                    @php
                        $cntmedia = count($qrsocialmediaval);
                    @endphp

                    @foreach ($qrsocialmediaval as $n => $media)
                        @php
                            $mediatype = $media['mediatype'];
                            $mediaurl = $media['mediaurl'];
                        @endphp

                        <div class="row mb-5" id="added_fieldemh{{ $n + 1 }}">
                            <div class="col-md-3 fv-row fv-plugins-icon-container">
                                <select class="form-select form-control form-control-lg" id="mediatype"
                                    name="mediatype[{{ $n }}]" tabindex="21">
                                    <option value="0" {{ $mediatype == '0' ? 'selected' : '' }}>Choose...
                                    </option>
                                    <option value="1" {{ $mediatype == '1' ? 'selected' : '' }}>Facebook</option>
                                    <option value="2" {{ $mediatype == '2' ? 'selected' : '' }}>Instagram
                                    </option>
                                    <option value="3" {{ $mediatype == '3' ? 'selected' : '' }}>LinkedIn</option>
                                    <option value="4" {{ $mediatype == '4' ? 'selected' : '' }}>Website URL
                                    </option>
                                    <option value="5" {{ $mediatype == '5' ? 'selected' : '' }}>YouTube Video URL
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-9 fv-row fv-plugins-icon-container">
                                <div class="input-group">
                                    <input type="text" id="mediaurl" name="mediaurl[{{ $n }}]"
                                        class="form-control form-control-lg" placeholder="https://"
                                        value="{{ $mediaurl }}" tabindex="22" maxlength="60" />
                                    <div align="right"><button id="removeRowsh {{ $n + 1 }}" type="button"
                                            name="add_fieldh" class="btn btn-danger"
                                            onClick="removeRowdh('{{ $n + 1 }}');">-</div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="col-md-12 row" align="right">
                        <div class="form-group">
                            <button id="addMoreRowssh" type="button" name="add_fieldssh"
                                class="btn icon btn-outline-primary btn-sm mt-3">+ Add More Social Media</button>
                        </div>
                    </div>

                    <div id="addedRowssh"></div>
                    <input type="hidden" name="cntmedia" id="cntmedia" value="{{ $cntmedia }}"
                        class="form-control" />

                </div>
            </div>

            <div class="col-md-4">


                <div class="form-outline mb-3"><label>Building/House Name & Number<span
                            class="text-danger">*</span></label>
                    <input type="text" id="es_buldingorhouseno" name="es_buldingorhouseno"
                        value="{{ $sellerDetails->house_name_no }}" maxlength="100"
                        class="form-control form-control-lg" placeholder="Building/House Name & Number" required
                        tabindex="11" />
                    <label for="es_buldingorhouseno" class="error"></label>
                </div>
                <div class="form-outline mb-3"><label>Locality<span class="text-danger">*</span></label>
                    <input type="text" id="es_locality" name="es_locality"
                        value="{{ $sellerDetails->locality }}" maxlength="100" class="form-control form-control-lg"
                        placeholder="Locality" required tabindex="12" />
                    <label for="es_locality" class="error"></label>
                </div>
                <div class="form-outline mb-3"><label>Village/Town/Municipality<span
                            class="text-danger">*</span></label>
                    <input type="text" id="es_villagetown" name="es_villagetown"
                        value="{{ $sellerDetails->village }}" maxlength="100" class="form-control form-control-lg"
                        placeholder="Village/Town/Municipality" required tabindex="13" />
                    <label for="es_villagetown" class="error"></label>
                </div>
                <div class="form-outline mb-3"><label>Country<span class="text-danger">*</span></label>
                    <select class="form-select form-control form-control-lg" name="ecountry"
                        aria-label="Default select example" id="ecountry" required tabindex="14">
                        <option value="">Select country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" @if ($country->id == $sellerDetails->country) selected @endif>
                                {{ $country->country_name }}</option>
                        @endforeach
                    </select>
                    <label for="ecountry" class="error"></label>
                </div>
                <div class="form-outline mb-3"><label>State<span class="text-danger">*</span></label>
                    <select class="form-select form-control form-control-lg" name="estate"
                        aria-label="Default select example" id="estate" required tabindex="15">
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}" @if ($state->id == $sellerDetails->state) selected @endif>
                                {{ $state->state_name }}</option>
                        @endforeach
                    </select>
                    <label for="estate" class="error"></label>
                </div>
                <div class="form-outline mb-3"><label>District<span class="text-danger">*</span></label>
                    <select class="form-select form-control form-control-lg" aria-label="Default select example"
                        id="edistrict" name="edistrict" required tabindex="16">
                        @foreach ($districts as $dist)
                            <option value="{{ $dist->id }}" @if ($dist->id == $sellerDetails->district && $dist->state_id == $sellerDetails->state) selected @endif>
                                {{ $dist->district_name }}</option>
                        @endforeach
                    </select>
                    <label for="edistrict" class="error"></label>
                </div>

                <div class="form-outline mb-3"><label>Pincode<span class="text-danger">*</span></label>
                    <input type="text" id="es_pincode" name="es_pincode" value="{{ $sellerDetails->pincode }}"
                        maxlength="6" class="form-control form-control-lg" placeholder="Pin Code" required
                        tabindex="17"  oninput="numberOnlyAllowed(this)" />
                    <label for="es_pincode" class="error"></label>
                </div>




                {{-- <div class="form-outline mb-3"><label>Google map link location</label>
                    <input type="text" id="es_googlelink" name="es_googlelink"
                        value="{{ $sellerDetails->googlemap }}" id class="form-control form-control-lg"
                        placeholder="Google map link location" required tabindex="18" />
                    <label for="es_googlelink" class="error"></label>
                </div> --}}


                <div class="form-outline mb-3"><label>Latitude (Google map location)<span
                            class="text-danger">*</span></label>
                    <input type="text" id="es_googlelatitude" name="es_googlelatitude"
                        value="{{ $sellerDetails->latitude }}" class="form-control form-control-lg"
                        placeholder="Latitude (Google map location)" required tabindex="18" />
                    <label for="es_googlelatitude" class="error"></label>
                </div>



                <div class="form-outline mb-3"><label>Longitude (Google map location)<span
                            class="text-danger">*</span></label>
                    <input type="text" id="es_googlelongitude" name="es_googlelongitude"
                        value="{{ $sellerDetails->longitude }}" class="form-control form-control-lg"
                        placeholder="Longitude (Google map location)" required tabindex="18" />
                    <label for="es_googlelongitude" class="error"></label>
                </div>



                <div class="form-outline mb-3"><label>{{ $shoporservice }} Photo's<span
                            class="text-danger">*</span></label>
                    <input type="file" id="es_photo" multiple="" name="es_photo[]"
                        class="form-control form-control-lg" placeholder="Shop Photo" tabindex="19"
                        accept="image/jpeg, image/png" />
                    <label for="es_photo" class="error"></label>
                </div>
                <div class="col-md-12">
                    <div class="form-group" align="left">
                        <div id="eimage-preview" class="row"></div>
                    </div>
                </div>



                <div class="col-md-12">
                    <div class="form-group" align="center">
                        <div class="row">
                            @for ($m = 0; $m < $totimg; $m++)
                                <div class="col-md-3">
                                    <a href="#" data-toggle="modal" data-target="#myModal{{ $m }}">
                                        <img id="img-bufferm" class="img-responsive image new_thumpnail"
                                            src="{{ asset($qrgallery[$m]) }}" width="450" height="250">
                                        @php
                                            $valen = $qrgallery[$m] . '#' . $sellerDetails->id;
                                            $deleencde = base64_encode($valen);
                                        @endphp
                                    </a>
                                    <br>
                                    {{-- @if (!($sel_approved == 'Y' && ($roleid == 3 || $roleid == 2))) --}}
                                    @if (!($sel_approved == 'Y'))
                                        <button id="remv" type="button" name="remv" class="btn btn-danger"
                                            onClick="DeltImagGalry('{{ $deleencde }}');">Remove</button>
                                    @endif
                                </div>

                                <div class="modal fade" id="myModal{{ $m }}" tabindex="-1"
                                    role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                    style="width: 80%;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{ asset($qrgallery[$m]) }}" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

                @if (session('roleid') == '1')
                    <div class="form-outline mb-3"><label>{{ $shoporservice }} Logo</label>
                        <input type="file" id="es_logo" name="es_logo[]" class="form-control form-control-lg"
                            placeholder="Shop Logo" tabindex="19" accept="image/jpeg, image/png" />
                        <label for="es_logo" class="error"></label>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" align="left">
                            <div id="eimage-preview-logo" class="row"></div>
                        </div>
                    </div>



                    <div class="col-md-12"
                        style="{{ $sellerDetails->shoplogo ? 'display: block;' : 'display: none;' }}">
                        <div class="form-group" align="center">
                            <div class="row">@php
                                $k = 1;
                            @endphp

                                <div class="col-md-3">
                                    <a href="#" data-toggle="modal"
                                        data-target="#myModalmm{{ $k }}">
                                        <img id="img-bufferms" class="img-responsive image new_thumpnail"
                                            src="{{ asset($sellerDetails->shoplogo) }}" width="450"
                                            height="250">
                                        @php

                                            $valenl = $sellerDetails->shoplogo . '#' . $sellerDetails->id;
                                            $deleencdel = base64_encode($valenl);
                                        @endphp
                                    </a>
                                </div>

                                <div class="modal fade" id="myModalmm{{ $k }}" tabindex="-1"
                                    role="dialog" aria-labelledby="myModalLabelmm" aria-hidden="true"
                                    style="width: 80%;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{ asset($sellerDetails->shoplogo) }}" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="form-outline mb-3"><label>{{ $shoporservice }} Background Color</label>
                        <input type="color" id="es_bgcolor" name="es_bgcolor" id class="form-control"
                            placeholder="{{ $shoporservice }} Background Color" required tabindex="18"
                            value="{{ $sellerDetails->colorpicks }}" />
                        <label for="es_bgcolor" class="error"></label>
                    </div>
                @endif



            </div>
            <div class="col-md-4">
                <div class="form-outline mb-3"><label>License Number</label>
                    <input type="text" id="es_lisence" name="es_lisence"
                        value="{{ $sellerDetails->shop_licence }}" class="form-control form-control-lg"
                        maxlength="25" placeholder="License Number"  tabindex="10" />
                    <label for="es_lisence" class="error"></label>
                </div>

                <div class="form-outline mb-3"><label>GST Number</label>
                    <input type="text" id="es_gstno" name="es_gstno" value="{{ $sellerDetails->shop_gstno }}"
                        maxlength="25" class="form-control form-control-lg" placeholder="GST Number" maxlength="15"
                        tabindex="20" />
                    <label for="es_gstno" class="error"></label>
                </div>
                <div class="form-outline mb-3"><label>PAN Number</label>
                    <input type="text" id="es_panno" name="es_panno" value="{{ $sellerDetails->shop_panno }}"
                        maxlength="12" class="form-control form-control-lg" placeholder="PAN Number" maxlength="10"
                        tabindex="21" />
                    <label for="es_panno" class="error"></label>
                    <div id="epan-error-message" style="color: red;"></div>
                </div>


                <div class="form-outline mb-3"><label> Establishment Date @if($typeid==1)<span
                    class="text-danger">*</span> @endif</label>
                    <input type="date" id="es_establishdate" name="es_establishdate"
                        value="{{ $sellerDetails->establish_date }}" maxlength="10"
                        class="form-control form-control-lg" placeholder="Establishment Date" tabindex="22"
                        max="{{ date('Y-m-d') }}" />
                    <label for="es_establishdate" class="error"></label>
                </div>


                {{-- <div class="form-outline mb-3"><label> Open Time</label>
                    <div class="input-group date" id="from-time-picker" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input"
                            data-target="#from-time-picker" id="eopentime" name="eopentime"
                            value="{{ $opentime }}" required maxlength="20" data-format="ddd hh:mm A" />
                        <label for="eopentime" class="error"></label>
                    </div>
                </div>

                <div class="form-outline mb-3"><label> Close Time</label>
                    <div class="input-group date" id="from-time-picker" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#to-time-picker"
                            id="eclosetime" name="eclosetime" value="{{ $closetime }}" required maxlength="20"
                            data-format="ddd hh:mm A" />
                        <label for="eclosetime" class="error"></label>
                    </div>
                </div> --}}



                <div class="form-group">
                    <fieldset>
                        <div class="repeater-default-times">
                            <div data-repeater-list="availabletime_datas">
                                <!-- Heading Row -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label class="control-label"> Set Available time </label>
                                    </div>
                                    <div class="col">
                                        <label class="control-label"> Day </label>
                                    </div>
                                    <div class="col">
                                        <label class="control-label"> Open Time </label>
                                    </div>
                                    <div class="col">
                                        <label class="control-label"> Close Time </label>
                                    </div>
                                </div>
                                <!-- Dynamic Rows -->
                                @php
                                    $countavialabletime = count($shopavailable);
                                @endphp
                                @if ($countavialabletime > 0)

                                    @foreach ($shopavailable as $availdatetime)
                                        <div data-repeater-item="">
                                            <div class="form-group row d-flex align-items-end">
                                                <div class="col">
                                                    <input class="form-control" type="checkbox" id="settimestatuss"
                                                        name="settimestatuss" value="1" style="width: 20%;"
                                                        {{ $availdatetime->is_set_time == 1 ? 'checked' : '' }}>
                                                </div>
                                                <div class="col">
                                                    <select id="setdayss" name="setdayss"
                                                        class="day-select form-control">
                                                        <option value="0">Day</option>
                                                        <option value="Sunday"
                                                            @if ($availdatetime->open_close_days == 'Sunday') selected @endif>Sunday
                                                        </option>
                                                        <option value="Monday"
                                                            @if ($availdatetime->open_close_days == 'Monday') selected @endif>Monday
                                                        </option>
                                                        <option value="Tuesday"
                                                            @if ($availdatetime->open_close_days == 'Tuesday') selected @endif>Tuesday
                                                        </option>
                                                        <option value="Wednesday"
                                                            @if ($availdatetime->open_close_days == 'Wednesday') selected @endif>
                                                            Wednesday
                                                        </option>
                                                        <option value="Thursday"
                                                            @if ($availdatetime->open_close_days == 'Thursday') selected @endif>Thursday
                                                        </option>
                                                        <option value="Friday"
                                                            @if ($availdatetime->open_close_days == 'Friday') selected @endif>Friday
                                                        </option>
                                                        <option value="Saturday"
                                                            @if ($availdatetime->open_close_days == 'Saturday') selected @endif>Saturday
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="setfrom_times" name="setfrom_times"
                                                        class="form-control timepicker-input"
                                                        value="{{ $availdatetime->from_time }}">
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="setto_times" name="setto_times"
                                                        class="form-control timepicker-input"
                                                        value="{{ $availdatetime->to_time }}">
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
                                @if ($countavialabletime == 0)
                                    <div data-repeater-item="" id="availabletime_no" style="display: none;">
                                        <div class="form-group row d-flex align-items-end">
                                            <div class="col">
                                                <input class="form-control" type="checkbox" id="settimestatuss"
                                                    name="settimestatuss" value="1" style="width: 20%;">
                                            </div>
                                            <div class="col">
                                                <select id="setdayss" name="setdayss"
                                                    class="day-select form-control">
                                                    <option value="0">Day</option>
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
                                                <span data-repeater-delete="" class="btn btn-danger btn-sm">
                                                    <span class="far fa-trash-alt mr-1"></span> Delete
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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









                {{-- <div class="form-outline mb-3"><label> Registration Date</label>
                    <input type="date" id="es_registerdate" name="es_registerdate"
                        value="{{ $sellerDetails->registration_date }}" maxlength="10"
                        class="form-control form-control-lg" placeholder="Registration Date" tabindex="24"
                        maxlength="10" />
                    <label for="es_registerdate" class="error"></label>
                </div>

                <div class="form-outline mb-3"><label>Manufactoring Details</label>
                    <textarea id="emanufactringdets" name="emanufactringdets" placeholder="Manufactoring Details"
                        class="form-control form-control-lg" tabindex="25" required>{{ $sellerDetails->manufactoring_details }}</textarea>
                    <label for="emanufactringdets" class="error"></label>
                </div> --}}

                <div class="form-outline mb-3"><label>Direct Affiliate</label>
                    <input type="text" class="form-control form-control-lg" id="sdirectafflte"
                        name="sdirectafflte" value="{{ $sellerDetails->direct_affiliate }}">
                    <label for="directafflte" class="error"></label>
                </div>

                <div class="form-outline mb-3"><label>Second Affiliate</label>
                    <input type="text" class="form-control form-control-lg" id="ssecondafflte"
                        name="ssecondafflte" value="{{ $sellerDetails->second_affiliate }}">
                    <label for="secondafflte" class="error"></label>
                </div>

                <div class="form-outline mb-3"><label>{{ $shoporservice }} Co-Ordinator</label>
                    <input type="text" class="form-control form-control-lg" id="scoordinater" name="scoordinater"
                        value="{{ $sellerDetails->shop_coordinator }}">
                    <label for="coordinater" class="error"></label>
                </div>
                @if (!($roleid == 3 || $roleid == 2))
                    <div class="form-outline mb-3"><label>User Status</label>
                        <select class="form-select form-control form-control-lg" name="userstatus" id="userstatus"
                            required tabindex="27">
                            <option value="">Select</option>
                            <option value="Y" @if ($userstatus == 'Y') selected @endif>Active</option>
                            <option value="N" @if ($userstatus == 'N') selected @endif>Inactive
                            </option>

                        </select>
                        <label for="userstatus" class="error"></label>
                    </div>
                @endif


                <div class="form-check-inline">
                    <input class="form-check-input" type="checkbox" id="es_termcondtn" name="es_termcondtn"
                        value="1" required tabindex="25"
                        {{ $sellerDetails->term_condition == 1 ? 'checked' : '' }}>
                    <label class="inlineCheckbox1" for="es_termcondtn"> Accept Terms & Conditions </label>
                </div>

            </div>


            <div class="col-md-12">
                <div style="float:right">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- @if (!($sel_approved == 'Y' && ($roleid == 3 || $roleid == 2))) --}}
                    <button type="submit" class="btn btn-primary">Save</button>
                    {{-- @endif --}}
                </div>
            </div>


            <div class="col-md-12">
                <div id="shop_gal-message" class="text-center" style="display: none;"></div>
            </div>

            <div class="col-md-12">
                <div id="eshopreg-message" class="text-center" style="display: none;"></div>
            </div>
        </div>
    </div>
</form>

<!-- Modal Add new Close -->



<script>

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
    document.getElementById('es_panno').addEventListener('input', function() {
        var panInput = this.value;
        var panRegex = /^[A-Z]{5}[0-9]{4}[A-Z]$/;

        if (panRegex.test(panInput)) {
            // PAN format is valid
            document.getElementById('epan-error-message').textContent = "";
        } else {
            // PAN format is invalid
            //document.getElementById('pan-error-message').textContent = "Invalid PAN format. It should be in the format AEDFR2568H";
        }
    });
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
                updateFieldIds($(this));

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

        function updateFieldIds(row) {
            var rowIndex = row.index() + 1;
            row.find('[id]').each(function() {
                var currentId = $(this).attr('id');
                var newId = currentId + rowIndex;
                $(this).attr('id', newId);
            });
        }
    });





    // $(function() {
    //     var datetimeFormat = 'ddd hh:mm A';
    //     $('#from-time-picker, #to-time-picker').datetimepicker({
    //         format: datetimeFormat,
    //         icons: {
    //             up: "fa fa-chevron-up",
    //             down: "fa fa-chevron-down"
    //         }
    //     });
    //     $('#from-time-picker, #to-time-picker').on('click', function() {
    //         $(this).datetimepicker('toggle');
    //     });
    //     $('#from-time-picker, #to-time-picker').on('show.datetimepicker', function() {
    //         $(this).datetimepicker('date', moment().format(datetimeFormat));
    //     });
    // });

    $('#ecountry').change(function() {
        $('#edistrict').empty();
        var countryId = $(this).val();
        if (countryId) {
            $.get("/getStates/" + countryId, function(data) {
                $('#estate').empty().append('<option value="">Select State</option>');
                $.each(data, function(index, state) {
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
                    $('#edistrict').append('<option value="' + district.id + '">' + district
                        .district_name + '</option>');
                });
            });
        }
    });



    $('#es_busnestype').change(function() {
        var busnescategory = $(this).val();

        if (busnescategory) {
            var categry = '';
            if (busnescategory == 1) {
                categry = 'Shop';
            } else if (busnescategory == 2) {
                categry = 'Service';
            }
            $('#es_subshopservice').empty();
            $.get("/BusinessCategory/" + busnescategory, function(data) {
                $('#es_shopservice').empty().append(
                    '<option value="">Select ' + categry + ' Category</option>');
                $.each(data, function(index, shopservice) {
                    $('#es_shopservice').append('<option value="' + shopservice.id +
                        '">' + shopservice.service_category_name + '</option>');
                });
            });
        }

        var busnes = $(this).val();
        if (busnes) {
            var shopcategry = '';
            if (busnes == 1) {
                shopcategry = 'Shop';
            } else if (busnes == 2) {
                shopcategry = 'Service';
            }
            $.get("/shopservicetype/" + busnes, function(data) {
                $('#es_shopservicetype').empty().append(
                    '<option value="">Select ' + shopcategry + ' Type</option>');
                $.each(data, function(index, servicetype) {
                    $('#es_shopservicetype').append('<option value="' + servicetype
                        .id +
                        '">' + servicetype.service_name + '</option>');
                });
            });
        }

        var busnescate = $(this).val();
        if (busnescate) {
            var subshopexe = '';
            if (busnescate == 1) {
                subshopexe = 'Shop';
            } else if (busnescate == 2) {
                subshopexe = 'Service';
            }
            $.get("/executivename/" + busnescate, function(data) {
                $('#es_shopexectename').empty().append(
                    '<option value="">Select ' + subshopexe + ' Executive Name</option>'
                );
                $.each(data, function(index, executive) {
                    $('#es_shopexectename').append('<option value="' + executive.id +
                        '">' + executive.executive_name + '</option>');
                });
            });
        }

    });

    // $('#es_shopservice').change(function() {
    //     var shopcategryid = $(this).val();
    //     var busnescate = $("#es_busnestype").val();
    //     if (shopcategryid) {
    //         var subshopcategry = '';
    //         if (busnescate == 1) {
    //             subshopcategry = 'Shop';
    //         } else if (busnescate == 2) {
    //             subshopcategry = 'Service';
    //         }

    //         $.get("/getsubshopservice/" + shopcategryid, function(data) {
    //             $('#es_subshopservice').empty().append(
    //                 '<option value="">Select ' + subshopcategry +
    //                 ' Sub Category</option>');
    //             $.each(data, function(index, category) {
    //                 $('#es_subshopservice').append('<option value="' + category.id +
    //                     '">' +
    //                     category.sub_category_name + '</option>');
    //             });
    //         });
    //     }
    // });


    // var fileArrs = [];
    // var totalFiless = 0;

    // $("#es_photo").change(function(event) {
    //     var totalFileCount = $(this)[0].files.length;
    //     if (totalFiless + totalFileCount > 5) {
    //         alert('Maximum 5 images allowed');
    //         $(this).val('');
    //         $('#eimage-preview').html('');
    //         return;
    //     }

    //     for (var i = 0; i < totalFileCount; i++) {
    //         var file = $(this)[0].files[i];

    //         if (file.size > 3145728) {
    //             alert('File size exceeds the limit of 3MB');
    //             $(this).val('');
    //             $('#eimage-preview').html('');
    //             return;
    //         }

    //         fileArrs.push(file);
    //         totalFiless++;

    //         var reader = new FileReader();
    //         reader.onload = (function(file) {
    //             return function(event) {
    //                 var imgDiv = $('<div>').addClass('img-div col-md-3 img-container');
    //                 var img = $('<img>').attr('src', event.target.result).addClass(
    //                     'img-responsive image new_thumpnail').attr('width', '100');
    //                 var removeBtn = $('<button>').addClass('btn btn-danger remove-btns').attr(
    //                     'title', 'Remove Image').append('Remove').attr('role', file.name);

    //                 imgDiv.append(img);
    //                 imgDiv.append($('<div>').addClass('middle').append(removeBtn));

    //                 $('#eimage-preview').append(imgDiv);
    //             };
    //         })(file);

    //         reader.readAsDataURL(file);
    //     }
    // });

    // $(document).on('click', '.remove-btns', function() {
    //     var fileName = $(this).attr('role');

    //     for (var i = 0; i < fileArrs.length; i++) {
    //         if (fileArrs[i].name === fileName) {
    //             fileArrs.splice(i, 1);
    //             totalFiless--;
    //             break;
    //         }
    //     }

    //     document.getElementById('es_photo').files = new FileListItem(fileArrs);
    //     $(this).closest('.img-div').remove();
    // });


    var fileArrs = [];
    var totalFiless = 0;

    $("#es_photo").change(function(event) {
        //$('#eimage-preview').html('');
        var totalFileCount = $(this)[0].files.length;


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
            if (totalFiless > 5) {
                alert('Maximum 5 images allowed');
                $(this).val('');
                $('#eimage-preview').html('');
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

                    $('#eimage-preview').append(imgDiv);
                };
            })(file);

            reader.readAsDataURL(file);
        }
        document.getElementById('es_photo').files = new FileListItem([]);
        document.getElementById('es_photo').files = new FileListItem(fileArrs);

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

        document.getElementById('es_photo').files = new FileListItem(fileArrs);
        $(this).closest('.img-div').remove();
    });

    // var fileArr = [];
    // var totalFiles = 0;

    // $("#es_logo").change(function(event) {
    //     var totalFileCount = $(this)[0].files.length;
    //     if (totalFiles + totalFileCount > 1) {
    //         alert('Maximum 1 images allowed');
    //         $(this).val('');
    //         $('#eimage-preview-logo').html('');
    //         return;
    //     }

    //     for (var i = 0; i < totalFileCount; i++) {
    //         var file = $(this)[0].files[i];

    //         if (file.size > 204800) {
    //             alert('File size exceeds the limit of 200Kb');
    //             $(this).val('');
    //             $('#eimage-preview-logo').html('');
    //             return;
    //         }

    //         fileArr.push(file);
    //         totalFiles++;

    //         var reader = new FileReader();
    //         reader.onload = (function(file) {
    //             return function(event) {
    //                 var imgDiv = $('<div>').addClass('img-divs col-md-3 img-container');
    //                 var img = $('<img>').attr('src', event.target.result).addClass(
    //                     'img-responsive image new_thumpnail').attr('width', '100');
    //                 var removeBtn = $('<button>').addClass('btn btn-danger remove-btnss').attr(
    //                     'title', 'Remove Image').append('Remove').attr('role', file.name);

    //                 imgDiv.append(img);
    //                 imgDiv.append($('<div>').addClass('middle').append(removeBtn));

    //                 $('#eimage-preview-logo').append(imgDiv);
    //             };
    //         })(file);

    //         reader.readAsDataURL(file);
    //     }
    // });

    // $(document).on('click', '.remove-btnss', function() {
    //     var fileName = $(this).attr('role');

    //     for (var i = 0; i < fileArr.length; i++) {
    //         if (fileArr[i].name === fileName) {
    //             fileArr.splice(i, 1);
    //             totalFiles--;
    //             break;
    //         }
    //     }

    //     document.getElementById('es_logo').files = new FileListItem(fileArr);
    //     $(this).closest('.img-divs').remove();
    // });


    var fileArr = [];
    var totalFiles = 0;

    $("#es_logo").change(function(event) {
        //$('#eimage-preview').html('');
        var totalFileCount = $(this)[0].files.length;

        for (var i = 0; i < totalFileCount; i++) {
            var file = $(this)[0].files[i];

            if (file.size > 3145728) {
                alert('File size exceeds the limit of 3MB');
                $(this).val('');
                $('#eimage-preview-logo').html('');
                return;
            }

            fileArr.push(file);
            totalFiles++;
            if (totalFiles > 1) {
                alert('Maximum 1 images allowed');
                $(this).val('');
                $('#eimage-preview-logo').html('');
                totalFiles = 0;
                fileArr = [];
                return;
            }


            var reader = new FileReader();
            reader.onload = (function(file) {
                return function(event) {
                    var imgDiv = $('<div>').addClass('img-divs col-md-3 img-container');
                    var img = $('<img>').attr('src', event.target.result).addClass(
                        'img-responsive image new_thumpnail').attr('width', '100');
                    var removeBtn = $('<button>').addClass('btn btn-danger remove-btnss').attr(
                        'title', 'Remove Image').append('Remove').attr('role', file.name);

                    imgDiv.append(img);
                    imgDiv.append($('<div>').addClass('middle').append(removeBtn));

                    $('#eimage-preview-logo').append(imgDiv);
                };
            })(file);

            reader.readAsDataURL(file);
        }
        document.getElementById('es_logo').files = new FileListItem([]);
        document.getElementById('es_logo').files = new FileListItem(fileArr);

    });

    $(document).on('click', '.remove-btnss', function() {
        var fileName = $(this).attr('role');

        for (var i = 0; i < fileArr.length; i++) {
            if (fileArr[i].name === fileName) {
                fileArr.splice(i, 1);
                totalFiles--;
                break;
            }
        }

        document.getElementById('es_logo').files = new FileListItem(fileArr);
        $(this).closest('.img-divs').remove();
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

    jQuery.validator.addMethod("validPAN", function(value, element) {
        // Define the PAN format regular expression
        var panRegex = /^[A-Z]{5}[0-9]{4}[A-Z]$/;
        return this.optional(element) || panRegex.test(value);
    }, "Invalid PAN format. It should be in the format AEDFR2568H");

    jQuery.validator.addMethod("validGST", function(value, element) {
        var gstRegex = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[0-9]{1}[A-Z]{1}[0-9]{1}$/;
        return this.optional(element) || gstRegex.test(value);
    }, "Invalid GST format. It should be in the format 29ABCDE1234F1Z5");

    $("#SellerRegFormEdit").validate({

        rules: {
            es_name: {
                required: true,
                // pattern: /^[A-Za-z\s\.]+$/,
            },
            es_ownername: {
                required: true,
                // pattern: /^[A-Za-z\s\.]+$/,
            },
            es_mobno: {
                required: true,
                digits: true,
                minlength: 10,
            },
            es_email: {
                // required: true,
                email: true,
            },

            es_busnestype: {
                required: true,

            },
            es_shopservice: {
                required: true,

            },
            // es_subshopservice: {
            //     required: true,

            // },
            es_shopservicetype: {
                required: true,

            },
            // es_shopexectename: {
            //     required: true,

            // },
            // es_lisence: {
            //     required: true,
            // },
            es_buldingorhouseno: {
                required: true,
            },

            es_locality: {
                required: true,
            },

            es_villagetown: {
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
            es_pincode: {
                required: true,
                digits: true,
                minlength: 6,

            },
            es_googlelatitude: {
                required: true,
            },
            es_googlelongitude: {
                required: true,
            },
            es_gstno: {
                //     required: true,
            },
            es_panno: {
                //     required: true,
            },
            es_establishdate: {
                required: function(element) {
                return $("#etypeidhid").val() === "1";
                }
            },
            es_termcondtn: {
                required: true,
            },
            es_photo: {
                // required: true,
                extension: 'jpg|jpeg|png',
            },
            // es_logo: {
            //     required: true,
            //     extension: 'jpg|jpeg|png',
            // },
            // eopentime: {
            //     required: true,
            // },
            // eclosetime: {
            //     required: true,
            // },
            // es_registerdate: {
            //     required: true,
            // },
            // emanufactringdets: {
            //     required: true,
            // },
            es_panno: {
                validPAN: true // Apply the custom PAN validation
            },
            es_gstno: {
                validGST: true // Apply the custom PAN validation
            }


        },
        messages: {
            es_name: {
                pattern: "Only characters, spaces, and dots are allowed.",
            },
            es_ownername: {
                pattern: "Only characters, spaces, and dots are allowed.",
            },
            es_mobno: {
                digits: "Please enter a valid mobile number.",
            },
            es_email: {
                email: "Please enter a valid email address.",
            },
            es_photo: {
                extension: "Only JPG and PNG files are allowed.",
            },
            // es_logo: {
            //     extension: "Only JPG and PNG files are allowed.",
            // },
            // es_lisence: {
            //     required: "Please enter the license number.",
            //     maxlength: "License number must not exceed 25 characters."
            // },
            es_buldingorhouseno: {
                required: "Please enter building/house name and number.",
                maxlength: "Building/house name and number must not exceed 100 characters."
            },
            es_locality: {
                required: "Please enter the locality.",
                maxlength: "Locality must not exceed 100 characters."
            },
            es_villagetown: {
                required: "Please enter village/town/municipality.",
                maxlength: "Village/town/municipality must not exceed 100 characters."
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
            es_pincode: {
                required: "Please enter the pin code.",
                maxlength: "Pin code must be 6 digits."
            },
            es_googlelatitude: {
                required: "Please enter google map location - Latitude."
            },

            es_googlelongitude: {
                required: "Please enter google map location - Longitude."
            },
            // es_gstno: {
            //     required: "Please enter the GST number.",
            //     maxlength: "GST number must not exceed 25 characters."
            // },
            // es_panno: {
            //     required: "Please enter the PAN number.",
            //     maxlength: "PAN number must not exceed 12 characters."
            // },
            es_establishdate: {
                required: "Please select the establishment date."
            },
            es_termcondtn: {
                required: "Please accept the terms and conditions."
            },
            s_panno: {
                validPAN: "Invalid PAN format. It should be in the format AEDFR2568H"
            },
            es_gstno: {
                validGST: "Invalid GST format. It should be in the format 29ABCDE1234F1Z5"
            },


            // eopentime: {
            //     required: "Please select open time."
            // },
            // eclosetime: {
            //     required: "Please select close time."
            // },
            // es_registerdate: {
            //     required: "Please select the registration date."
            // },

        },
    });


    // $('#es_name, #es_ownername').on('input', function() {
    //     var value = $(this).val();
    //     value = value.replace(/[^A-Za-z\s\.]+/, '');
    //     $(this).val(value);
    // });

    $.validator.addMethod('maxSize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param);
    }, 'File size must be less than {0} KB');


    $(document).ready(function() {
        $("#SellerRegFormEdit").submit(function(event) {
            // Validate each row
            let valid = true;
            $("div[data-repeater-item]").each(function() {
                const $row = $(this);
                const setDay = $row.find("[name='setdayss']").val() !== '';
                const setFromTime = $row.find("[name='setfrom_times']").val() !== '';
                const setToTime = $row.find("[name='setto_times']").val() !== '';

                if (!setDay || !setFromTime || !setToTime) {
                    valid = false;
                    return false;
                }
            });

            if (!valid) {
                alert("Please fill out all required fields in each row.");
                event.preventDefault();
            }
        });
    });



    $('#SellerRegFormEdit').submit(function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            $.ajax({
                url: '{{ route('AdmsellerUpdate') }}',
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
                    $('#eshopreg-message').text('Shop details successfully updated!').fadeIn();
                    $('#eshopreg-message').addClass('success-message');
                    $('#eimage-preview').empty();
                    $('#eimage-preview-logo').empty();
                    setTimeout(function() {
                        $('#eshopreg-message').fadeOut();
                    }, 5000); // 5000 milliseconds = 5 seconds
                    $('#SellerRegFormEdit')[0].reset();
                    $('#loading-image').fadeOut();
                    $('#loading-overlay').fadeOut();
                    $('#ViewEditModal').modal('hide');
                    shwdets();


                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    $('#eshopreg-message').text('updation failed.').fadeIn();
                    $('#eshopreg-message').addClass('error');
                    setTimeout(function() {
                        $('#eshopreg-message').fadeOut();
                    }, 5000);
                    $('#loading-image').fadeOut();
                    $('#loading-overlay').fadeOut();
                    $('#ViewEditModal').modal('show');

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
</script>
