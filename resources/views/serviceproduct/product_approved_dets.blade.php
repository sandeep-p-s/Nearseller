<form id="ProductRegFormApproved" enctype="multipart/form-data" method="POST">
    <input type="hidden" id="serprod_ids" name="serprod_ids" class="form-control" placeholder="Service ID"
        value="{{ $ServiceDetails->id }}" />
    <div class="row">

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    @php
                        $shopshowhide = session('roleid') == 1 || session('roleid') == 11 || session('roleid') == 3 ? 'style=display:block;' : 'style=display:none;';
                    @endphp


                    <div class="form-group" {{ $shopshowhide }}><label>Service Provider Name<span
                                class="text-danger">*</span></label>
                        <select class="selectshopssh form-control form-control-lg" id="shop_names" name="shop_names"
                            required tabindex="1">
                            <option value="">Select Service Provider</option><br />

                            @foreach ($userservicede as $shpss)
                                @php
                                    echo $shpss->id . '==' . $ServiceDetails->id;
                                @endphp
                                <option value="{{ $shpss->id }}" @if ($shpss->id == $ServiceDetails->service_id) selected @endif>
                                    {{ $shpss->name }}</option>
                            @endforeach

                        </select>
                        <label for="shop_name" class="error"></label>
                    </div>


                    <div class="form-group"><label>Service Name<span class="text-danger">*</span></label>
                        <input type="text" id="prod_names" name="prod_names" class="form-control" maxlength="60"
                            placeholder="Service Name" required tabindex="1"
                            value="{{ $ServiceDetails->service_name }}" />
                        <label for="prod_names" class="error"></label>
                    </div>

                    <div class="form-outline mb-3"><label>Service Images<span class="text-danger">*</span></label>
                        <input type="file" id="s_photos" name="s_photos[]" class="form-control form-control-lg"
                            placeholder="Service Photo" tabindex="19" accept="image/jpeg, image/png" />
                        <label for="s_photos" class="error"></label>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" align="left">
                            <div id="image-previews" class="row"></div>
                        </div>
                    </div>



                    <div class="col-md-12"
                        style="{{ $ServiceDetails->service_images ? 'display: block;' : 'display: none;' }}">
                        <div class="form-group" align="center">
                            <div class="row">@php
                                $k = 1;
                            @endphp

                                <div class="col-md-3">
                                    <a href="#" data-toggle="modal" data-target="#myModalmm{{ $k }}">
                                        <img id="img-bufferms" class="img-responsive image new_thumpnail"
                                            src="{{ asset($ServiceDetails->service_images) }}" width="450"
                                            height="250">
                                        @php

                                            $valenl = $ServiceDetails->service_images . '#' . $ServiceDetails->id;
                                            $deleencdel = base64_encode($valenl);
                                        @endphp
                                    </a>
                                </div>

                                <div class="modal fade" id="myModalmm{{ $k }}" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabelmm" aria-hidden="true" style="width: 80%;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{ asset($ServiceDetails->service_images) }}"
                                                    class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label>Service Description <span
                            class="text-danger">*</span></label>
                        <textarea id="prod_descriptions" name="prod_descriptions" placeholder="Service Description" class="form-control"
                            maxlength="7000" tabindex="4" required rows="3">{{ $ServiceDetails->service_description }}</textarea>
                        <label for="prod_descriptions"></label>
                    </div>

                    <div class="form-group"><label>Service Status</label>
                        <select class="form-select form-control form-control-lg" name="productstatus" id="productstatus"
                            required tabindex="6">
                            <option value="">Select</option>
                            <option value="Y" @if ($ServiceDetails->service_status == 'Y') selected @endif>Available</option>
                            <option value="N" @if ($ServiceDetails->service_status == 'N') selected @endif>Not Available
                            </option>
                        </select>

                    </div>

                    <div class="form-group"><label>Approval Status</label>
                        <select class="form-select form-control form-control-lg" name="productapproval"
                            id="productapproval" required tabindex="6">
                            <option value="">Select</option>
                            <option value="Y" @if ($ServiceDetails->is_approved == 'Y') selected @endif>Approved</option>
                            <option value="N" @if ($ServiceDetails->is_approved == 'N') selected @endif>Not Approved
                            </option>
                            <option value="R" @if ($ServiceDetails->is_approved == 'R') selected @endif>Rejected</option>
                        </select>

                    </div>


                    <div class="col-md-12">
                        <div id="product_gal-message" class="text-center" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group mb-0 row">
                            <label class="col-md-6 my-1 control-label">Do you want to select
                                attributes?</label>
                            <div class="col-md-6">
                                <div class="form-check-inline my-1">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="yesChecks" name="customRadios"
                                            class="custom-control-input" onclick="javascript:yesnoChecks();"
                                            tabindex="14" value="Y"
                                            {{ $ServiceDetails->is_attribute === 'Y' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="yesChecks">Yes</label>
                                    </div>
                                </div>
                                <div class="form-check-inline my-1">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="noChecks" name="customRadios"
                                            class="custom-control-input" onclick="javascript:yesnoChecks();"
                                            tabindex="15" value="N"
                                            {{ $ServiceDetails->is_attribute === 'N' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="noChecks">No</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>

                        <div id="ifYess"
                            style="display: {{ $ServiceDetails->is_attribute == 'Y' ? 'block' : 'none' }};">
                            <fieldset>
                                <div class="repeater-defaults">
                                    <div data-repeater-list="attributedatas">
                                        <!-- Heading Row -->
                                        <div class="form-group row">
                                            <div class="col">
                                                <label class="control-label"> Show status </label>
                                            </div>
                                        </div>
                                        <!-- Dynamic Rows -->
                                        @foreach ($productAttibutes as $attribte)
                                            <div data-repeater-item="">
                                                <div class="form-group row d-flex align-items-end">
                                                    <div class="col">
                                                        <input class="form-control" type="checkbox"
                                                            id="stockstatuss1" name="stockstatuss1" value="1"
                                                            style="width: 10%;"
                                                            {{ $attribte->show_status == 1 ? 'checked' : '' }}>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" id="attatibutes1" name="attatibutes1"
                                                            placeholder="Attribute1" class="form-control" required
                                                            value="{{ $attribte->attribute_1 }}">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" id="attatibutes2" name="attatibutes2"
                                                            placeholder="Attribute2" class="form-control" required
                                                            value="{{ $attribte->attribute_2 }}">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" id="attatibutes3" name="attatibutes3"
                                                            placeholder="Attribute3" class="form-control" required
                                                            value="{{ $attribte->attribute_3 }}">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" id="attatibutes4" name="attatibutes4"
                                                            placeholder="Attribute4" class="form-control"
                                                            value="{{ $attribte->attribute_4 }}">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" id="offerprices1" name="offerprices1"
                                                            maxlength="10" placeholder="Offer Price"
                                                            class="form-control"
                                                            value="{{ $attribte->offer_price }}">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" id="mrprices1" name="mrprices1"
                                                            maxlength="10" placeholder="MRP" class="form-control"
                                                            value="{{ $attribte->mrp_price }}">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" id="attr_calshops1"
                                                            name="attr_calshops1" maxlength="10"
                                                            placeholder="Call Shop" class="form-control attr-stocks"
                                                            value="{{ $attribte->call_shop }}">
                                                    </div>
                                                    <div class="col">
                                                        <span data-repeater-delete="" class="btn btn-danger btn-sm">
                                                            <span class="far fa-trash-alt mr-1"></span> Delete
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div data-repeater-item="" id="attribute_no" style="display: none;">
                                            <div class="form-group row d-flex align-items-end">
                                                <div class="col">
                                                    <input class="form-control" type="checkbox" id="stockstatuss1"
                                                        name="stockstatuss1" value="1" style="width: 10%;">
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="attatibutes1" name="attatibutes1"
                                                        placeholder="Attribute" class="form-control" required />
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="attatibutes2" name="attatibutes2"
                                                        placeholder="Attribute" class="form-control" required />
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="attatibutes3" name="attatibutes3"
                                                        placeholder="Attribute" class="form-control" required />
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="attatibutes4" name="attatibutes4"
                                                        placeholder="Attribute" class="form-control" />
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="offerprices1" name="offerprices1"
                                                        maxlength="10" placeholder="Offer Price"
                                                        class="form-control" />
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="mrprices1" name="mrprices1"
                                                        maxlength="10" placeholder="MRP" class="form-control" />
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="attr_calshops1" name="attr_calshops1"
                                                        maxlength="10" placeholder="Call Shop"
                                                        class="form-control attr-stocks" />
                                                </div>
                                                <div class="col">
                                                    <span data-repeater-delete="" class="btn btn-danger btn-sm">
                                                        <span class="far fa-trash-alt mr-1"></span> Delete
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0 row">
                                        <div class="col-sm-12">
                                            <span data-repeater-create="" class="btn btn-secondary btn-sm">
                                                <span class="fas fa-plus"></span> Add New
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
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
            <div id="productapproved-message" class="text-center" style="display: none;"></div>
        </div>



</form>




<script>
    function yesnoChecks() {
        if (document.getElementById('yesChecks').checked) {
            document.getElementById('ifYess').style.display = 'block';
        } else {
            document.getElementById('ifYess').style.display = 'none';
            $('#errorstocks-message').hide();
        }

    }


    $(document).ready(function() {
        $('.repeater-defaults').repeater({
            show: function() {
                $(this).slideDown();
                updateFieldIds($(this));
            },
            hide: function(deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
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
        $('#ProductRegFormApproved .selectshopssh').each(function() {
            var $p = $(this).parent();
            $(this).select2({
                dropdownParent: $p
            });
        });






    });







    // var fileArrs = [];
    // var totalFiless = 0;

    // $("#s_photos").change(function(event) {
    //     var totalFileCount = $(this)[0].files.length;
    //     if (totalFiless + totalFileCount > 10) {
    //         alert('Maximum 10 images allowed');
    //         $(this).val('');
    //         $('#image-previews').html('');
    //         return;
    //     }

    //     for (var i = 0; i < totalFileCount; i++) {
    //         var file = $(this)[0].files[i];

    //         if (file.size > 3145728) {
    //             alert('File size exceeds the limit of 3MB');
    //             $(this).val('');
    //             $('#image-previews').html('');
    //             return;
    //         }

    //         fileArrs.push(file);
    //         totalFiless++;

    //         var reader = new FileReader();
    //         reader.onload = (function(file) {
    //             return function(event) {
    //                 var imgDiv = $('<div>').addClass('img-div col-md-3 img-container');
    //                 var img = $('<img>').attr('src', event.target.result).addClass(
    //                     'img-responsive image img-thumbnail').attr('width', '200', 'height',
    //                     '200');
    //                 var removeBtn = $('<button>').addClass('btn btn-danger remove-btns').attr(
    //                     'title', 'Remove Image').append('Remove').attr('role', file.name);

    //                 imgDiv.append(img);
    //                 imgDiv.append($('<div class="text-center">').addClass('middle').append(
    //                     removeBtn));

    //                 $('#image-previews').append(imgDiv);
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

    //     document.getElementById('s_photos').files = new FileListItem(fileArrs);
    //     $(this).closest('.img-div').remove();
    // });


    var fileArrs = [];
    var totalFiless = 0;

    $("#s_photos").change(function(event) {
        //$('#image-preview').html('');
        var totalFileCount = $(this)[0].files.length;


        for (var i = 0; i < totalFileCount; i++) {
            var file = $(this)[0].files[i];

            if (file.size > 3145728) {
                alert('File size exceeds the limit of 3MB');
                $(this).val('');
                $('#image-previews').html('');
                return;
            }

            fileArrs.push(file);
            totalFiless++;
            if (totalFiless > 1) {
                alert('Maximum 1 images allowed');
                $(this).val('');
                $('#image-previews').html('');
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

                    $('#image-previews').append(imgDiv);
                };
            })(file);

            reader.readAsDataURL(file);
        }
        document.getElementById('s_photos').files = new FileListItem([]);
        document.getElementById('s_photos').files = new FileListItem(fileArrs);

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

        document.getElementById('s_photos').files = new FileListItem(fileArrs);
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





    $("#ProductRegFormApproved").validate({

        rules: {
            productapproval: {
                required: true,
            },

        },
        messages: {
            productapproval: {
                required: "Please select service approval."
            },

        },
    });


    $.validator.addMethod('maxSize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param);
    }, 'File size must be less than {0} KB');


    $('#ProductRegFormApproved').submit(function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            $.ajax({
                url: '{{ route('AdmApprovedservice') }}',
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
                        $('#productapproved-message').text(response.mesge).fadeIn();
                        $('#productapproved-message').addClass('success-message');
                        $('#image-previews').empty();
                        setTimeout(function() {
                            $('#productapproved-message').fadeOut();
                        }, 5000);
                        $('#ProductRegFormApproved')[0].reset();
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#ProductApprovedModal').modal('hide');
                        shwdets();
                    } else if (response.result == 2) {
                        $('#productapproved-message').text(response.mesge).fadeIn();
                        $('#productapproved-message').addClass('error');
                        setTimeout(function() {
                            $('#productapproved-message').fadeOut();
                        }, 5000);
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#ProductApprovedModal').modal('show');

                    } else if (response.result == 3 || response.result == 4) {
                        $('#productapproved-message').text(response.mesge).fadeIn();
                        $('#productapproved-message').addClass('error');
                        setTimeout(function() {
                            $('#productapproved-message').fadeOut();
                        }, 5000);
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#ProductApprovedModal').modal('show');

                    } else {
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                    }
                }
            });
        }
    });
</script>
