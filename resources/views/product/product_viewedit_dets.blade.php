@php
    $product_images = $ProductDetails->product_images;
    $product_imagesarray = json_decode($product_images);
    $fileval = $product_imagesarray->fileval;
    $product_imagesval = json_decode(json_encode($fileval), true);
    $totadarimg = count($product_imagesval);

    $product_document = $ProductDetails->product_document;
    $product_videos = $ProductDetails->product_videos;

@endphp
<form id="ProductRegFormEdit" enctype="multipart/form-data" method="POST">
    <input type="hidden" id="prod_id" name="prod_id" class="form-control" placeholder="Product ID"
        value="{{ $ProductDetails->id }}" />
    <div class="row">

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    @php
                        $shopshowhide = session('roleid') == 1 || session('roleid') == 11 || session('roleid') == 3 ? 'style=display:block;' : 'style=display:none;';
                    @endphp
                    <div class="form-group"  {{ $shopshowhide }}><label>Shop Name</label>
                        <select class="selectshopss form-select form-control form-control-lg" id="shop_names" name="shop_names" required tabindex="1">
                            <option value="">Select Shop Name</option><br/>
                                @foreach ($usershopdets as $shps)
                                    <option value="{{ $shps->id }}" @if ($shps->id == $ProductDetails->shop_id) selected @endif>{{ $shps->name }}</option>
                                @endforeach
                        </select>
                        <label for="shop_names" class="error"></label>
                    </div>

                    <div class="form-group"><label>Product Name</label>
                        <input type="text" id="prod_names" name="prod_names" class="form-control" maxlength="60"
                            placeholder="Product Name" required tabindex="1"
                            value="{{ $ProductDetails->product_name }}" />
                        <label for="prod_names" class="error"></label>
                    </div>
                    <div class="form-group"><label> Product Specification</label>
                        <textarea id="prod_specifications" name="prod_specifications" placeholder="Product Specification" class="form-control"
                            maxlength="250" tabindex="2" required> {{ $ProductDetails->product_specification }}</textarea>
                        <label for="prod_specifications"></label>
                    </div>

                    <div class="form-group"><label>Category</label>
                        <select class="form-control" id="categorySelectors" name="parent_categorys" tabindex="3"
                            required>
                            <option value="0">Select Category</option>
                            @foreach ($filteredCategories as $key => $category)
                                <option value="{{ $category->id }}" data-level="{{ $category->category_level }}"
                                    {{ $category->id == $ProductDetails->category_id ? 'selected' : '' }}>
                                    @for ($i = 0; $i < $category->category_level; $i++)
                                    @endfor
                                    <span
                                        class="{{ $key === count($filteredCategories) - 1 ? 'last-child' : '' }}">{{ $category->category_name }}</span>
                                </option>
                            @endforeach
                        </select>

                    </div>



                    <div class="form-group">
                        <label>Product Description </label>
                        <textarea id="prod_descriptions" name="prod_descriptions" placeholder="Product Description" class="form-control"
                            maxlength="7000" tabindex="4" required rows="3">{{ $ProductDetails->product_description }}</textarea>
                        <label for="prod_descriptions"></label>
                    </div>


                    <div class="form-group"><label>Product Images</label>
                        <input type="file" id="s_photos" multiple="" name="s_photos[]" class="form-control"
                            placeholder="Shop Photo" tabindex="5" accept="image/jpeg, image/png" />
                        <label for="s_photos" class="error"></label>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" align="left">
                            <div id="image-previews" class="row"></div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group" align="center">
                            <div class="row">
                                @for ($m = 0; $m < $totadarimg; $m++)
                                    <div class="col-md-3">
                                        <a href="#" data-toggle="modal" data-target="#myModals{{ $m }}">
                                        <img id="img-bufferm" src="{{ asset($fileval[$m]) }}" width="100"
                                            height="100">
                                        @php
                                            $valen = $fileval[$m] . '#' . $ProductDetails->id;
                                            $deleencde = base64_encode($valen);
                                        @endphp
                                        </a>
                                        <br>

                                        <button id="remv" type="button" name="remv" class="btn btn-danger"
                                            onClick="DeltProductImag('{{ $deleencde }}');">Remove</button>

                                    </div>

                                    <div class="modal fade" id="myModals{{ $m }}" tabindex="-1" role="dialog" aria-labelledby="myModalsLabel" style="overflow-y: scroll;" aria-hidden="true" style="width: 80%;">
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

                    <div class="form-group"><label>Product Status</label>
                        <select class="form-select form-control form-control-lg" name="productstatus"  id="productstatus" required  tabindex="6" >
                            <option value="">Select</option>
                            <option value="Y"  @if ($ProductDetails->product_status=='Y') selected @endif>Available</option>
                            <option value="N"  @if ($ProductDetails->product_status=='N') selected @endif>Not Available</option>
                        </select>

                    </div>


                    <div class="col-md-12">
                        <div id="product_gal-message" class="text-center" style="display: none;"></div>
                    </div>



                </div>

            </div>

        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label>Upload Video</label>
                        <input type="file" class="form-control" id="videofiles" name="videofiles" tabindex="6"
                            accept="video/*" onchange="displayVideoPreviews(this)">
                        <div id="video-previews"  style="display: {{ $ProductDetails->product_videos !='' ? 'block' : 'none' }};">
                            <video id="previews" width="320" height="240" controls>
                                <source src="{{ asset($product_videos) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <div class="video-remove-button" id="removeButtons">Remove</div>
                        </div>

                    </div>



                    <div class="form-group">
                        <label for="prod_docs">Add PDF Document</label>
                        <input type="file" name="prod_docs" id="prod_docs" tabindex="7" class="form-control"
                            accept="application/pdf">
                        <div class="form-group">
                            <div id="pdfmm_previews" class="row">
                                <div class='img-div col-md-12 img-container text-right' align='center'>
                                    @if ($product_document != '' && $product_document != '0')
                                        <a href="{{ asset($product_document) }}" download title="Download">
                                            <embed src=" {{ asset($product_document) }} " type='application/pdf'
                                                width='100%' height='400px' />
                                            <div class='middle'></div>
                                </div>

                                <br>
                                <div class='col-md-12 text-right'><i
                                        class="fas fa-download btn btn-success text-right"> Download</i>
                                    </a>
                                    @endif

                                </div>
                            </div>
                        </div>




                        <div class="form-group">
                            <label>Manufacturer Details</label>
                            <textarea id="prod_manufactures" name="prod_manufactures" placeholder="Manufacturer Details" class="form-control"
                                maxlength="250" rows="2" tabindex="8" required> {{ $ProductDetails->manufacture_details }}</textarea>
                            <label for="prod_manufactures" class="error"></label>
                        </div>
                        <div class="form-group">
                            <label>Brand Name</label>
                            <input type="text" class="form-control" id="brand_names" name="brand_names"
                                maxlength="120" placeholder="Brand Name" tabindex="9"
                                value="{{ $ProductDetails->brand_name }}" />
                        </div>

                        @php
                            $paymodes = $ProductDetails->paying_mode;
                            $explodepaymode = explode(',', $paymodes);
                            $cashdeposit = $explodepaymode[0];
                            $fromshop = $explodepaymode[1];
                            $calshop = $explodepaymode[2];
                        @endphp

                        <div class="form-group mb-0 row">
                            <label class="col-md-4">Buying Option : </label>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-control" type="checkbox" id="cashdepositss"
                                            name="cashdepositss" value="1"
                                            {{ $cashdeposit == 1 ? 'checked' : '' }} style="width: 27%;">

                                        {{-- <input type="radio" class="form-check-input" id="codsx"
                                            name="paymodesx" value="cod" tabindex="10"
                                            {{ $ProductDetails->paying_mode === 'cod' ? 'checked' : '' }}> --}}
                                        <label class="form-check-label" for="cod">COD</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-control" type="checkbox" id="fromshopss" name="fromshopss"
                                            value="1" {{ $fromshop == 1 ? 'checked' : '' }} style="width: 11%;">

                                        {{-- <input type="radio" class="form-check-input" id="fromshopsx"
                                            name="paymodesx" value="shop" tabindex="11"
                                            {{ $ProductDetails->paying_mode === 'shop' ? 'checked' : '' }}> --}}
                                        <label class="form-check-label" for="fromshop">Buy From Shop</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-control" type="checkbox" id="calshopss" name="calshopss"
                                            value="1" {{ $calshop == 1 ? 'checked' : '' }} style="width: 16%;">

                                        {{-- <input type="radio" class="form-check-input" id="calshopsx"
                                            name="paymodesx" value="calshop" tabindex="12"
                                            {{ $ProductDetails->paying_mode === 'calshop' ? 'checked' : '' }}> --}}
                                        <label class="form-check-label" for="calshop">Call Shop</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group"  style="display: none">
                            <label>Stock </label>
                            <input type="number" class="form-control" id="totstocks" name="totstocks"
                                tabindex="13" value="{{ $ProductDetails->product_stock }}" />
                        </div>
                        <div class="form-group"  style="display: none">
                            <div id="errorstocks-message" class="text-danger" style="display: none;">Total
                                stock and attribute stock must be equal.</div>

                        </div>


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
                                            {{ $ProductDetails->is_attribute === 'Y' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="yesChecks">Yes</label>
                                    </div>
                                </div>
                                <div class="form-check-inline my-1">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="noChecks" name="customRadios"
                                            class="custom-control-input" onclick="javascript:yesnoChecks();"
                                            tabindex="15" value="N"
                                            {{ $ProductDetails->is_attribute === 'N' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="noChecks">No</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>

                        <div id="ifYess"
                            style="display: {{ $ProductDetails->is_attribute == 'Y' ? 'block' : 'none' }};">
                            <fieldset>
                                <div class="repeater-defaults">
                                    <div data-repeater-list="attributedatas">
                                        <!-- Heading Row -->
                                        <div class="form-group row">
                                            <div class="col">
                                                <label class="control-label"> Stock Status </label>
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
                                                            {{ $attribte->stock_status == 1 ? 'checked' : '' }}>
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
                                                            placeholder="Offer Price" class="form-control" oninput="numberOnlyAllowedDot(this)"
                                                            value="{{ $attribte->offer_price }}">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" id="mrprices1" name="mrprices1"
                                                            placeholder="MRP" class="form-control" oninput="numberOnlyAllowedDot(this)"
                                                            value="{{ $attribte->mrp_price }}">
                                                    </div>
                                                    <div class="col"  style="display: none;">
                                                        <input type="text" id="attr_stocks1" name="attr_stocks1"
                                                            placeholder="Attribute Stock"
                                                            class="form-control attr-stocks" oninput="numberOnlyAllowed(this)"
                                                            value="{{ $attribte->attribute_stock }}">
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
                                                        placeholder="Offer Price" class="form-control" oninput="numberOnlyAllowedDot(this)"/>
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="mrprices1" name="mrprices1"
                                                        placeholder="MRP" class="form-control" oninput="numberOnlyAllowedDot(this)"/>
                                                </div>
                                                <div class="col"  style="display: none;">
                                                    <input type="text" id="attr_stocks1" name="attr_stocks1"
                                                        placeholder="Attribute Stock"
                                                        class="form-control attr-stocks" oninput="numberOnlyAllowed(this)"/>
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
            <div id="productsubs-message" class="text-center" style="display: none;"></div>
        </div>



</form>




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


    function updateLevel() {
        var select = document.getElementById("categorySelectors");
        var levelInput = document.getElementById("category_levels");
        var selectedOption = select.options[select.selectedIndex];
        var level = selectedOption.getAttribute("data-level");
        if (level == null) {
            level = 0; // Default value is 0
        } else if (!isNaN(level)) {
            level = parseInt(level) + 1;
        } else {
            level = 0; // Default value is 0
        }

        levelInput.value = level;
    }



    function yesnoChecks() {
        if (document.getElementById('yesChecks').checked) {
            document.getElementById('ifYess').style.display = 'block';
        } else {
            document.getElementById('ifYess').style.display = 'none';
            $('#errorstocks-message').hide();
        }

    }


    $(document).ready(function() {
        // $('#totstocksx').on('input', function() {
        //     var value = $(this).val();
        //     if (parseFloat(value) < 0) {
        //         $(this).val(0);
        //     }
        // });
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
        // $(document).on('keyup', '.attr-stocks', function() {
        //     if ($("input[name='customRadios']:checked").val() === "Y") {
        //         var totalAttributeStock = 0;
        //         $('.attr-stocks').each(function() {
        //             var value = parseInt($(this).val()) || 0;
        //             totalAttributeStock += value;
        //         });
        //         var totalStock = parseInt($('#totstocks').val()) || 0;
        //         //console.log('Total Attribute Stock:', totalAttributeStock);
        //         //console.log('Total Stock:', totalStock);
        //         if (totalAttributeStock !== totalStock) {
        //             $('#errorstocks-message').show();
        //         } else {
        //             $('#errorstocks-message').hide();
        //         }
        //     }

        // });
        //Remove video
        $("#removeButtons").click(function() {
            $("#previews")[0].src = "";
            $("#videofiles").val('');
            $("#video-previews").hide();
        });


        $('#prod_docs').on('change', function() {
            var files = $(this).prop('files');
            var maxSize = 1 * 1024 * 1024; // 1MB

            $('#pdfmm_previews').empty();

            if (files && files.length > 0) {
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];

                    if (file.type === 'application/pdf') {
                        if (file.size <= maxSize) {
                            var reader = new FileReader();

                            reader.onload = function(event) {
                                $('#pdfmm_previews').append(
                                    "<div class='img-div col-md-12 img-container text-right' align='center'><button class='btn btn-danger remove-btn' title='Remove PDF'>Remove</button><embed src='" +
                                    event.target.result +
                                    "' type='application/pdf' width='100%' height='400px' /><div class='middle'></div></div>"
                                );
                            };

                            reader.readAsDataURL(file);
                        } else {
                            alert("PDF file size exceeds the limit of 1MB.");
                            $('#prod_docs').val('');
                            return false;
                        }
                    } else {
                        alert("Only PDF files are allowed.");
                        $('#prod_docs').val('');
                        return false;
                    }
                }
            }
        });

        // Remove image
        $(document).on('click', '.remove-btn', function() {
            $(this).closest('.img-div').remove();
            $('#prod_docs').val('');
        });

        $('#ProductRegFormEdit .selectshopss').each(function() {
            var $p = $(this).parent();
            $(this).select2({
                dropdownParent: $p
            });
        });
    });



    function displayVideoPreviews(input) {
        const file = input.files[0];
        if (!file) {
            document.getElementById('video-previews').style.display = 'none';
            return;
        }
        const videoURL = URL.createObjectURL(file);
        const videoPreview = document.getElementById('previews');
        videoPreview.src = videoURL;
        document.getElementById('video-previews').style.display = 'block';
    }




    function calculateTotalAttributeStock() {
        var totalAttributeStock = 0;
        $('.attr-stocks').each(function() {
            var value = parseInt($(this).val()) || 0;
            totalAttributeStock += value;
        });
        return totalAttributeStock;
    }

    // function handleSubmit() {
    //     if ($("input[name='customRadios']:checked").val() === "Y") {
    //         var totalStock = parseInt($('#totstocks').val()) || 0;
    //         var totalAttributeStock = calculateTotalAttributeStock();
    //         if (totalAttributeStock !== totalStock) {
    //             $('#errorstocks-message').show();
    //         }
    //         // else {
    //         //     $('#ProductAddForm').submit();
    //         // }
    //     }
    // }




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
            if (totalFiless  > 10) {
            alert('Maximum 10 images allowed');
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
                    if(fileArrs.length > 0)
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





    $("#ProductRegFormEdit").validate({

        rules: {
            shop_names: {
                required: true,
            },

            prod_names: {
                required: true,
                pattern: /^[A-Za-z\s\.]+$/,
            },
            parent_categorys: {
                required: true,
            },

            prod_descriptions: {
                required: true,
            },
            // totstocks: {
            //     required: true,
            //     digits: true,
            // },
            paymodes: {
                required: true,
            },
            customRadios: {
                required: true,
            },
            productstatus: {
                required: true,
            },

        },
        messages: {
            shop_names: {
                required: "Please select shop name."
            },
            prod_names: {
                pattern: "Only characters, spaces, and dots are allowed.",
            },
            parent_categorys: {
                required: "Please select a category."
            },
            prod_descriptions: {
                required: "Please enter product description.",
                maxlength: "Locality must not exceed 700 characters."
            },
            // totstocks: {
            //     digits: "Please enter a number.",
            // },
            paymodes: {
                required: "Please select Buying Option",
            },
            customRadios: {
                required: "Please select attribute",
            },
            productstatus: {
                required: "Please select product status",
            },

        },
    });


    $('#prod_names').on('input', function() {
        var value = $(this).val();
        value = value.replace(/[^A-Za-z\s\.]+/, '');
        $(this).val(value);
    });


    $.validator.addMethod('maxSize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param);
    }, 'File size must be less than {0} KB');


    $('#ProductRegFormEdit').submit(function(e) {
        e.preventDefault();
        //handleSubmit();
        if ($(this).valid()) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            $.ajax({
                url: '{{ route('AdmPrdoductEdit') }}',
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
                        $('#productsubs-message').text(response.mesge).fadeIn();
                        $('#productsubs-message').addClass('success-message');
                        $('#image-previews').empty();
                        $("#previews")[0].src = "";
                        $("#videofiles").val('');
                        $("#video-previews").hide();
                        $('#pdfmm_previews').empty();
                        setTimeout(function() {
                            $('#productsubs-message').fadeOut();
                        }, 5000);
                        $('#ProductRegFormEdit')[0].reset();
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#ViewEditModal').modal('hide');
                        shwdets();
                    } else if (response.result == 2) {
                        $('#productsubs-message').text(response.mesge).fadeIn();
                        $('#productsubs-message').addClass('error');
                        setTimeout(function() {
                            $('#productsubs-message').fadeOut();
                        }, 5000);
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#ViewEditModal').modal('show');

                    } else if (response.result == 3 || response.result == 4) {
                        $('#productsubs-message').text(response.mesge).fadeIn();
                        $('#productsubs-message').addClass('error');
                        setTimeout(function() {
                            $('#productsubs-message').fadeOut();
                        }, 5000);
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#ViewEditModal').modal('show');

                    } else {
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                    }
                }
            });
        }
    });
</script>
