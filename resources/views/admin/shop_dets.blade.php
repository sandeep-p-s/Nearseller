@if ($sellerCount > 0)
    <table id="datatable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>SINO</th>
                <th>Reg. ID</th>
                <th>{{ $shoporservice }} Name</th>
                <th>Owner Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Business Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sellerDetails as $index => $sellerDetail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $typeid == 1 ? 'SHOP' : ($typeid == 2 ? 'SER' : '') }}{{ str_pad($sellerDetail->shop_reg_id, 9, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $sellerDetail->shop_name }}</td>
                    <td>{{ $sellerDetail->owner_name }}</td>
                    <td>{{ $sellerDetail->shop_email }}</td>
                    <td>{{ $sellerDetail->shop_mobno }}</td>
                    <td class="text-success">{{ $sellerDetail->business_name }}</td>
                    <td>
                        <div class="btn-group mb-2 mb-md-0">
                            <button type="button" class="btn view_btn dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Action
                                <i class="mdi mdi-chevron-down"></i></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item view_btn1" href="#"
                                    onclick="shopvieweditdet({{ $sellerDetail->id }},{{ $typeid }})">View/Edit</a>
                                @if (session('roleid') == '1')
                                    <a class="dropdown-item approve_btn" href="#"
                                        onclick="shopapprovedet({{ $sellerDetail->id }},{{ $typeid }})">Approved</a>
                                    <a class="dropdown-item delete_btn" href="#"
                                        onclick="shopdeletedet({{ $sellerDetail->id }})">Delete</a>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <table>
        <tr>
            <td colspan="13" align="center">
                <img src="{{ asset('backend/assets/images/notfoundimg.png') }}" alt="notfound" class="rounded-circle"
                    style="width: 30%;" />
            </td>
        </tr>
    </table>
@endif



<!-- Modal Add New -->
<div class="modal fade" id="addNewModal" tabindex="-1" aria-labelledby="addNewModalLabel" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog custom-modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="addNewModalLabel">Add New {{ $shoporservice }} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    title="Close">x</button>
            </div>
            <div class="modal-body">


                <form id="SellerRegForm" enctype="multipart/form-data" method="POST">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-outline mb-3"><label>{{ $shoporservice }} Name</label>
                                    <input type="text" id="s_name" name="s_name"
                                        class="form-control form-control-lg" maxlength="50"
                                        placeholder="{{ $shoporservice }} Name" required tabindex="1" />
                                    <label for="s_name" class="error"></label>
                                </div>
                                @if ($typeid == 1)
                                    <div class="form-outline mb-3"><label>Owner Name</label>
                                        <input type="text" id="s_ownername" name="s_ownername"
                                            class="form-control form-control-lg" maxlength="50" placeholder="Owner Name"
                                            required tabindex="2" />
                                        <label for="s_ownername" class="error"></label>
                                    </div>
                                @endif
                                <div class="form-outline mb-3"><label>Mobile Number</label>
                                    <input type="text" id="s_mobno" name="s_mobno"
                                        class="form-control form-control-lg" maxlength="10" placeholder="Mobile No"
                                        required tabindex="3" onchange="exstmobno(this.value,'2')" />
                                    <label for="s_mobno" class="error"></label>
                                    <div id="smob-message" class="text-center" style="display: none;"></div>
                                </div>
                                <div class="form-outline mb-3"><label>Email ID</label>
                                    <input type="email" id="s_email" name="s_email"
                                        class="form-control form-control-lg" maxlength="35" placeholder="Email ID"
                                        required tabindex="4" onchange="exstemilid(this.value,'2')" />
                                    <label for="s_email" class="error"></label>
                                    <div id="semil-message" class="text-center" style="display: none;"></div>
                                </div>
                                <div class="form-outline mb-3"><label>Referral ID</label>
                                    <input type="text" id="s_refralid" name="s_refralid"
                                        class="form-control form-control-lg" maxlength="50" placeholder="Referral ID"
                                        tabindex="5" onchange="checkrefrelno(this.value,'1')" />
                                    <div id="s_refralid-message" class="text-center" style="display: none;"></div>
                                </div>
                                <div class="form-outline mb-3"><label>Business Type</label>
                                    <select class="form-select form-control form-control-lg" id="s_busnestype"
                                        name="s_busnestype" required tabindex="6">
                                        <option value="" >Business Type</option><br/>
                                        @foreach ($business as $busnes)
                                            <option value="{{ $busnes->id }}">
                                                {{ $busnes->business_name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="s_busnestype" class="error"></label>
                                </div>
                                <div class="form-outline mb-3"><label>{{ $shoporservice }} Category</label>
                                    <select class="form-select form-control form-control-lg" id="s_shopservice"
                                        name="s_shopservice" required tabindex="7">

                                        {{-- @foreach ($shopservicecategory as $shopser)
                                    <option value="{{ $shopser->id }}">{{ $shopser->service_category_name }}
                                    </option>
                                @endforeach --}}
                                    </select>
                                    <label for="s_shopservice" class="error"></label>
                                </div>




                                <div class="form-outline mb-3"><label>{{ $shoporservice }} Sub Category</label>
                                    <select class="form-select form-control form-control-lg" id="s_subshopservice"
                                        name="s_subshopservice" required tabindex="7">
                                        <option value="">{{ $shoporservice }} Sub Category</option><br />
                                        {{-- @foreach ($shopservicesubcategory as $shoptyp)
                                    <option value="{{ $shoptyp->id }}">{{ $shoptyp->sub_category_name }}
                                    </option>
                                @endforeach --}}
                                    </select>
                                    <label for="s_subshopservice" class="error"></label>
                                </div>


                                <div class="form-outline mb-3"><label>{{ $shoporservice }} Type</label>
                                    <select class="form-select form-control form-control-lg" id="s_shopservicetype"
                                        name="s_shopservicetype" required tabindex="7">
                                        <option value="">{{ $shoporservice }} Type</option><br />
                                        {{-- @foreach ($shopservice as $shtypes)
                                    <option value="{{ $shtypes->id }}">{{ $shtypes->service_name }}</option>
                                @endforeach --}}
                                    </select>
                                    <label for="s_shopservicetype" class="error"></label>
                                </div>


                                <div class="form-outline mb-3"><label>{{ $shoporservice }} Executive Name</label>
                                    <select class="form-select form-control form-control-lg" id="s_shopexectename"
                                        name="s_shopexectename" required tabindex="8">
                                        <option value="">{{ $shoporservice }} Executive Name</option><br />
                                        {{-- @foreach ($executives as $exec)
                                    <option value="{{ $exec->id }}">{{ $exec->executive_name }}</option>
                                @endforeach --}}
                                    </select>
                                    <label for="s_shopexectename" class="error"></label>
                                </div>

                                <div class="form-outline mb-3"><label>Social Media</label>
                                    <div class="row mb-5">
                                        <div class="col-md-3 fv-row fv-plugins-icon-container">
                                            <select class="form-select form-control form-control-lg" id="mediatype"
                                                name="mediatype[1]" tabindex="21">
                                                <option selected="">Choose...</option>
                                                <option value="1">Facebook</option>
                                                <option value="2">Instagram</option>
                                                <option value="3">Linked In</option>
                                                <option value="4">Web site URL</option>
                                                <option value="5">Youtub Video URL</option>
                                            </select>
                                        </div>

                                        <div class="col-md-9 fv-row fv-plugins-icon-container">
                                            <div class="input-group">
                                                <input type="text" id="mediaurl" name="mediaurl[1]"
                                                    class="form-control form-control-lg" placeholder="https://"
                                                    value="" tabindex="22" maxlength="60" />
                                                <div align="right">
                                                    <a href="#" id="addMoreurls" name="add_fieldurl"
                                                        class="btn icon btn-success">+</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="addedUrls"></div>

                                </div>



                            </div>






                            <div class="col-md-4">

                                <div class="form-outline mb-3"><label>Building/House Name & Number</label>
                                    <input type="text" id="s_buldingorhouseno" name="s_buldingorhouseno"
                                        maxlength="100" class="form-control form-control-lg"
                                        placeholder="Building/House Name & Number" required tabindex="11" />
                                    <label for="s_buldingorhouseno" class="error"></label>
                                </div>
                                <div class="form-outline mb-3"><label>Locality</label>
                                    <input type="text" id="s_locality" name="s_locality" maxlength="100"
                                        class="form-control form-control-lg"placeholder="Locality" required
                                        tabindex="12" />
                                    <label for="s_locality" class="error"></label>
                                </div>
                                <div class="form-outline mb-3"><label>Village/Town/Municipality</label>
                                    <input type="text" id="s_villagetown" name="s_villagetown" maxlength="100"
                                        class="form-control form-control-lg" placeholder="Village/Town/Municipality"
                                        required tabindex="13" />
                                    <label for="s_villagetown" class="error"></label>
                                </div>
                                <div class="form-outline mb-3"><label>Country</label>
                                    <select class="form-select form-control form-control-lg" name="country"
                                        aria-label="Default select example" id="country" required tabindex="14">
                                        <option value="">Select country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="country" class="error"></label>
                                </div>
                                <div class="form-outline mb-3"><label>State</label>
                                    <select class="form-select form-control form-control-lg" name="state"
                                        aria-label="Default select example" id="state" required tabindex="15">

                                    </select>
                                    <label for="state" class="error"></label>
                                </div>
                                <div class="form-outline mb-3"><label>District</label>
                                    <select class="form-select form-control form-control-lg"
                                        aria-label="Default select example" id="district" name="district" required
                                        tabindex="16">

                                    </select>
                                    <label for="district" class="error"></label>
                                </div>
                                <div class="form-outline mb-3"><label>Pincode</label>
                                    <input type="text" id="s_pincode" name="s_pincode" maxlength="6"
                                        class="form-control form-control-lg" placeholder="Pin Code" required
                                        tabindex="17" />
                                    <label for="s_pincode" class="error"></label>
                                </div>
                                <div class="form-outline mb-3"><label>Google map link location</label>
                                    <input type="text" id="s_googlelink" name="s_googlelink" id
                                        class="form-control form-control-lg" placeholder="Google map link location"
                                        required tabindex="18" />
                                    <label for="s_googlelink" class="error"></label>
                                </div>
                                <div class="form-outline mb-3"><label>{{ $shoporservice }} Photo's</label>
                                    <input type="file" id="s_photo" multiple="" name="s_photo[]"
                                        class="form-control form-control-lg" placeholder="Shop Photo" required
                                        tabindex="19" accept="image/jpeg, image/png" />
                                    <label for="s_photo" class="error"></label>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group" align="left">
                                        <div id="image-preview" class="row"></div>
                                    </div>
                                </div>


                            </div>
                            <div class="col-md-4">

                                <div class="form-outline mb-3"><label>License Number</label>
                                    <input type="text" id="s_lisence" name="s_lisence"
                                        class="form-control form-control-lg" maxlength="25"
                                        placeholder="License Number" required tabindex="10" />
                                    <label for="s_lisence" class="error"></label>
                                </div>

                                <div class="form-outline mb-3"><label>GST Number</label>
                                    <input type="text" id="s_gstno" name="s_gstno" maxlength="25"
                                        class="form-control form-control-lg" placeholder="GST Number" required
                                        tabindex="20" />
                                    <label for="s_gstno" class="error"></label>
                                </div>
                                <div class="form-outline mb-3"><label>PAN Number</label>
                                    <input type="text" id="s_panno" name="s_panno" maxlength="12"
                                        class="form-control form-control-lg" placeholder="PAN Number" required
                                        tabindex="21" />
                                    <label for="s_panno" class="error"></label>
                                </div>


                                <div class="form-outline mb-3"><label> Establishment Date</label>
                                    <input type="date" id="s_establishdate" name="s_establishdate" maxlength="10"
                                        class="form-control form-control-lg" placeholder="Establishment Date"
                                        tabindex="22" />
                                    <label for="s_establishdate" class="error"></label>
                                </div>





                                <div class="form-outline mb-3">
                                    <label>Open Time</label>
                                    <div class="input-group date" id="from-time-picker" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#from-time-picker" id="opentime" name="opentime" required
                                            maxlength="20" data-format="ddd hh:mm A" />
                                        <div class="input-group-append" data-target="#from-time-picker"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                        </div>
                                        <label for="opentime" class="error"></label>
                                    </div>
                                </div>

                                <div class="form-outline mb-3">
                                    <label>Close Time</label>
                                    <div class="input-group date" id="to-time-picker" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#to-time-picker" id="closetime" name="closetime" required
                                            maxlength="20" data-format="ddd hh:mm A" />
                                        <div class="input-group-append" data-target="#to-time-picker"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                        </div>
                                        <label for="closetime" class="error"></label>
                                    </div>
                                </div>


                                <div class="form-outline mb-3"><label> Registration Date</label>
                                    <input type="date" id="s_registerdate" name="s_registerdate" maxlength="10"
                                        class="form-control form-control-lg" placeholder="Registration Date"
                                        tabindex="24" maxlength="10" />
                                    <label for="s_registerdate" class="error"></label>
                                </div>

                                <div class="form-outline mb-3"><label>Manufactoring Details</label>
                                    <textarea id="manufactringdets" name="manufactringdets" placeholder="Manufactoring Details"
                                        class="form-control form-control-lg" tabindex="25" required></textarea>
                                    <label for="manufactringdets" class="error"></label>
                                </div>

                                <div class="form-outline mb-3"><label>Direct Affiliate</label>
                                    <input type="text" class="form-control form-control-lg" id="directafflte"
                                        name="directafflte">
                                    <label for="directafflte" class="error"></label>
                                </div>

                                <div class="form-outline mb-3"><label>Second Affiliate</label>
                                    <input type="text" class="form-control form-control-lg" id="secondafflte"
                                        name="secondafflte">
                                    <label for="secondafflte" class="error"></label>
                                </div>

                                <div class="form-outline mb-3"><label>Co-Ordinator</label>
                                    <input type="text" class="form-control form-control-lg" id="coordinater"
                                        name="coordinater">
                                    <label for="coordinater" class="error"></label>
                                </div>

                                <div class="checkbox form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="s_termcondtn"
                                        name="s_termcondtn" value="1" required tabindex="26">
                                    <label class="inlineCheckbox1" for="s_termcondtn"> Accept Terms & Conditions
                                    </label>
                                </div>

                            </div>


                            <div class="col-md-12">
                                <div style="float:right">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div id="shopreg-message" class="text-center" style="display: none;"></div>
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







<!-- Modal Add New -->
<div class="modal fade" id="UploadShopModal" tabindex="-1" aria-labelledby="UploadShopModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="UploadShopModalLabel">Upload Shops Details </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    title="Close">x</button>
            </div>
            <div class="modal-body">
                <form id="UploadSellerRegForm" enctype="multipart/form-data" method="POST">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-outline mb-3"><label>Upload File</label>
                                    <input type="file" id="shopupload" name="shopupload"
                                        class="form-control form-control-lg" placeholder="Upload File" accept=".csv"
                                        required tabindex="1" />
                                    <label for="shopupload" class="error"></label>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div style="float:right">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div id="shopupload-message" class="text-center" style="display: none;"></div>
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
    $(function() {
        //$('#datetimepicker').datetimepicker();
        var datetimeFormat = 'ddd hh:mm A';
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

    $('#country').change(function() {
        $('#district').empty();
        var countryId = $(this).val();
        if (countryId) {
            $.get("/getStates/" + countryId, function(data) {
                $('#state').empty().append('<option value="">Select State</option>');
                $.each(data, function(index, state) {
                    $('#state').append('<option value="' + state.id + '">' + state.state_name +
                        '</option>');
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
                    $('#district').append('<option value="' + district.id + '">' + district
                        .district_name + '</option>');
                });
            });
        }
    });



    $('#s_busnestype').change(function() {
        var busnescategory = $(this).val();

        if (busnescategory) {
            var categry = '';
            if (busnescategory == 1) {
                categry = 'Shop';
            } else if (busnescategory == 2) {
                categry = 'Service';
            }
            $('#s_subshopservice').empty();
            $.get("/BusinessCategory/" + busnescategory, function(data) {
                $('#s_shopservice').empty().append(
                    '<option value="">Select ' + categry + ' Category</option>');
                $.each(data, function(index, shopservice) {
                    $('#s_shopservice').append('<option value="' + shopservice.id +
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
                $('#s_shopservicetype').empty().append(
                    '<option value="">Select ' + shopcategry + ' Type</option>');
                $.each(data, function(index, servicetype) {
                    $('#s_shopservicetype').append('<option value="' + servicetype
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
                $('#s_shopexectename').empty().append(
                    '<option value="">Select ' + subshopexe + ' Executive Name</option>'
                );
                $.each(data, function(index, executive) {
                    $('#s_shopexectename').append('<option value="' + executive.id +
                        '">' + executive.executive_name + '</option>');
                });
            });
        }

    });

    $('#s_shopservice').change(function() {
        var shopcategryid = $(this).val();
        var busnescate = $("#s_busnestype").val();
        if (shopcategryid) {
            var subshopcategry = '';
            if (busnescate == 1) {
                subshopcategry = 'Shop';
            } else if (busnescate == 2) {
                subshopcategry = 'Service';
            }

            $.get("/getsubshopservice/" + shopcategryid, function(data) {
                $('#s_subshopservice').empty().append(
                    '<option value="">Select ' + subshopcategry +
                    ' Sub Category</option>');
                $.each(data, function(index, category) {
                    $('#s_subshopservice').append('<option value="' + category.id +
                        '">' +
                        category.sub_category_name + '</option>');
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
                    var img = $('<img>').attr('src', event.target.result).addClass(
                        'img-responsive image new_thumpnail').attr('width', '100');
                    var removeBtn = $('<button>').addClass('btn btn-danger remove-btns').attr(
                        'title', 'Remove Image').append('Remove').attr('role', file.name);

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


    $("#SellerRegForm").validate({

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
            s_subshopservice: {
                required: true,

            },
            s_shopservicetype: {
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



    $('#SellerRegForm').submit(function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            $.ajax({
                url: '{{ route('AdmsellerRegisteration') }}',
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
                    $('#shopreg-message').text(
                        'Registration successful. Please verify email and login!').fadeIn();
                    $('#shopreg-message').addClass('success-message');
                    $('#image-preview').empty();
                    setTimeout(function() {
                        $('#shopreg-message').fadeOut();
                    }, 5000); // 5000 milliseconds = 5 seconds
                    $('#SellerRegForm')[0].reset();
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
    $(document).ready(function() {
        $('#addMoreurls').click(function(event) {
            event.preventDefault();
            mm++;
            var recRowm = '<div class="row mb-5" id="addedfieldurl' + mm +
                '"><div class="col-md-3 fv-row fv-plugins-icon-container"><select class="form-select form-control form-control-lg" id="mediatype' +
                mm + '" name="mediatype[' + mm +
                ']"><option selected="">Choose...</option><option value="1">Facebook</option><option value="2">Instagram</option><option value="3">Linked In</option><option value="4">Web site URL</option><option value="5">Youtub Video URL</option></select></div><div class="col-md-9 fv-row fv-plugins-icon-container"><div class="input-group"><input type="text"  id="mediaurl' +
                mm + '" name="mediaurl[' + mm +
                ']" class="form-control form-control-lg" placeholder="https://"  value="" tabindex="22"  maxlength="60"/><div align="right"><button id="removeRowurl' +
                mm +
                '" type="button" name="add_fieldurl" class="btn btn-danger" onclick="removeRowurl(' +
                mm + ');" >-</button></div></div></div>';
            $('#addedUrls').append(recRowm);
        });
    });

    function removeRowurl(rowNum) {
        $('#addedfieldurl' + rowNum).remove();
    }

    $("#UploadSellerRegForm").validate({
        rules: {
            shopupload: {
                required: true,
                accept: "csv"
            }
        },
        messages: {
            shopupload: {
                required: "Please select a CSV file",
                accept: "Only CSV files are allowed"
            }
        }
    });


    $('#UploadSellerRegForm').submit(function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            $.ajax({
                url: '{{ route('UploadsellerRegister') }}',
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
                    $('#shopupload-message').text('Shop details successfully submitted').fadeIn();
                    $('#shopupload-message').addClass('success-message');
                    setTimeout(function() {
                        $('#shopupload-message').fadeOut();
                    }, 5000); // 5000 milliseconds = 5 seconds
                    $('#UploadSellerRegForm')[0].reset();
                    $('#loading-image').fadeOut();
                    $('#loading-overlay').fadeOut();
                    $('#UploadShopModal').modal('hide');
                    shwdets();


                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    $('#shopupload-message').text('Upload failed.').fadeIn();
                    $('#shopupload-message').addClass('error');
                    setTimeout(function() {
                        $('#shopupload-message').fadeOut();
                    }, 5000);
                    $('#loading-image').fadeOut();
                    $('#loading-overlay').fadeOut();
                    $('#UploadShopModal').modal('show');

                }
            });
        }
    });
</script>
