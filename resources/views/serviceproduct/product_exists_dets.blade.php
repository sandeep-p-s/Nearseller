@php
    $product_images = $ProductDetails->product_images;
    $product_imagesarray = json_decode($product_images);
    $fileval = $product_imagesarray->fileval;
    $product_imagesval = json_decode(json_encode($fileval), true);
    $totadarimg = count($product_imagesval);

    $product_document = $ProductDetails->product_document;
    $product_videos = $ProductDetails->product_videos;

@endphp
<form id="ProductRegExistAddNew" enctype="multipart/form-data" method="POST">
    <input type="hidden" id="prod_id" name="prod_id" class="form-control" placeholder="Product ID"
        value="{{ $ProductDetails->id }}" />
    <div class="row">

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group"><label>Shop Name</label>
                        <select class="selectshopse form-select form-control form-control-lg" id="shop_namesx"
                            name="shop_namesx" required tabindex="1">
                            <option value="">Select Shop Name</option><br />
                            @foreach ($usershopdets as $shps)
                                <option value="{{ $shps->id }}" @if ($shps->id == $ProductDetails->shop_id) selected @endif>
                                    {{ $shps->name }}</option>
                            @endforeach
                        </select>
                        <label for="shop_namesx" class="error"></label>
                    </div>

                    <div class="form-group"><label>Product Name</label>
                        <input type="text" id="prod_namesx" name="prod_namesx" class="form-control" maxlength="60"
                            placeholder="Product Name" required tabindex="1"
                            value="{{ $ProductDetails->product_name }}" />
                        <label for="prod_namesx" class="error"></label>
                    </div>
                    <div class="form-group"><label> Product Specification</label>
                        <textarea id="prod_specificationsx" name="prod_specificationsx" placeholder="Product Specification" class="form-control"
                            maxlength="250" tabindex="2" required> {{ $ProductDetails->product_specification }}</textarea>
                        <label for="prod_specificationsx"></label>
                    </div>

                    <div class="form-group"><label>Category</label>
                        <select class="selectautox form-control" id="categorySelectorsx" name="parent_categorysx" tabindex="3"
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
                        <textarea id="prod_descriptionsx" name="prod_descriptionsx" placeholder="Product Description" class="form-control"
                            maxlength="7000" tabindex="4" required rows="3">{{ $ProductDetails->product_description }}</textarea>
                        <label for="prod_descriptions"></label>
                    </div>


                    <div class="form-group"><label>Product Images</label>
                        <input type="file" id="s_photosx" multiple="" name="s_photosx[]" class="form-control"
                            placeholder="Shop Photo" tabindex="5" accept="image/jpeg, image/png" required />
                        <label for="s_photosx" class="error"></label>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" align="left">
                            <div id="image-previewsx" class="row"></div>
                        </div>
                    </div>

                    {{-- <div class="col-md-12">
                        <div class="form-group" align="center">
                            <div class="row">
                                @for ($m = 0; $m < $totadarimg; $m++)
                                    <div class="col-md-3"> --}}
                    {{-- <a href="#" data-toggle="modal" data-target="#myModals{{ $m }}"> --}}
                    {{-- <img id="img-bufferm" src="{{ asset($fileval[$m]) }}" width="100"
                                            height="100">
                                        @php
                                            $valen = $fileval[$m] . '#' . $ProductDetails->id;
                                            $deleencde = base64_encode($valen);
                                        @endphp --}}
                    {{-- </a> --}}
                    {{-- <br>

                                        <button id="remv" type="button" name="remv" class="btn btn-danger"
                                            onClick="DeltProductImag('{{ $deleencde }}');">Remove</button>

                                    </div> --}}

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
                    {{-- @endfor
                            </div>
                        </div>
                    </div> --}}

                    <div class="form-group"><label>Product Status</label>
                        <select class="form-select form-control form-control-lg" name="productstatusx" id="productstatusx"
                            required tabindex="6">
                            <option value="">Select</option>
                            <option value="Y" @if ($ProductDetails->product_status == 'Y') selected @endif>Available</option>
                            <option value="N" @if ($ProductDetails->product_status == 'N') selected @endif>Not Available
                            </option>
                        </select>

                    </div>


                    <div class="col-md-12">
                        <div id="product_galx-message" class="text-center" style="display: none;"></div>
                    </div>



                </div>

            </div>

        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label>Upload Video</label>
                        <input type="file" class="form-control" id="videofilesx" name="videofilesx" tabindex="6"
                            accept="video/*" onchange="displayVideoPreviewsx(this)">
                        <div id="video-previewsx" style="display:none">
                            {{-- <div id="video-previews"  style="display: {{ $ProductDetails->product_videos !='' ? 'block' : 'none' }};"> --}}
                            <video id="previewsx" width="320" height="240" controls>
                                {{-- <source src="{{ asset($product_videos) }}" type="video/mp4"> --}}
                                Your browser does not support the video tag.
                            </video>
                            <div class="video-remove-button" id="removeButtonsx">Remove</div>
                        </div>

                    </div>



                    <div class="form-group">
                        <label for="prod_docs">Add PDF Document</label>
                        <input type="file" name="prod_docsx" id="prod_docsx" tabindex="7" class="form-control"
                            accept="application/pdf">
                        <div class="form-group">
                            <div id="pdfmm_previewsx" class="row">
                                {{-- <div class='img-div col-md-12 img-container text-right' align='center'>
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

                                </div> --}}
                            </div>
                        </div>




                        <div class="form-group">
                            <label>Manufacturer Details</label>
                            <textarea id="prod_manufacturesx" name="prod_manufacturesx" placeholder="Manufacturer Details" class="form-control"
                                maxlength="250" rows="2" tabindex="8" required> {{ $ProductDetails->manufacture_details }}</textarea>
                            <label for="prod_manufacturesx" class="error"></label>
                        </div>
                        <div class="form-group">
                            <label>Brand Name</label>
                            <input type="text" class="form-control" id="brand_namesx" name="brand_namesx"
                                maxlength="120" placeholder="Brand Name" tabindex="9"
                                value="{{ $ProductDetails->brand_name }}" />
                        </div>

                        <div class="form-group mb-0 row">
                            <label class="col-md-4">Buying Option : </label>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" id="codsx"
                                            name="paymodesx" value="cod" tabindex="10"
                                            {{ $ProductDetails->paying_mode === 'cod' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="cod">COD</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" id="fromshopsx"
                                            name="paymodesx" value="shop" tabindex="11"
                                            {{ $ProductDetails->paying_mode === 'shop' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="fromshop">Buy From Shop</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" id="calshopsx"
                                            name="paymodesx" value="calshop" tabindex="12"
                                            {{ $ProductDetails->paying_mode === 'calshop' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="calshop">Call Shop</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Stock </label>
                            <input type="number" class="form-control" id="totstocksx" name="totstocksx"
                                tabindex="13" required value="{{ $ProductDetails->product_stock }}" />
                        </div>
                        <div class="form-group">
                            <div id="errorstocksx-message" class="text-danger" style="display: none;">Total
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
                                        <input type="radio" id="yesChecksx" name="customRadiosx"
                                            class="custom-control-input" onclick="javascript:yesnoChecksx();"
                                            tabindex="14" value="Y"
                                            {{ $ProductDetails->is_attribute === 'Y' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="yesChecksx">Yes</label>
                                    </div>
                                </div>
                                <div class="form-check-inline my-1">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="noChecksx" name="customRadiosx"
                                            class="custom-control-input" onclick="javascript:yesnoChecksx();"
                                            tabindex="15" value="N"
                                            {{ $ProductDetails->is_attribute === 'N' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="noChecksx">No</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>

                        <div id="ifYessx"
                            style="display: {{ $ProductDetails->is_attribute == 'Y' ? 'block' : 'none' }};">
                            <fieldset>
                                <div class="repeater-defaultsx">
                                    <div data-repeater-list="attributedatasx">
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
                                                            id="stockstatussx1" name="stockstatussx1" value="1"
                                                            style="width: 10%;"
                                                            {{ $attribte->stock_status == 1 ? 'checked' : '' }}>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" id="attatibutesx1" name="attatibutesx1"
                                                            placeholder="Attribute1" class="form-control" required
                                                            value="{{ $attribte->attribute_1 }}">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" id="attatibutesx2" name="attatibutesx2"
                                                            placeholder="Attribute2" class="form-control" required
                                                            value="{{ $attribte->attribute_2 }}">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" id="attatibutesx3" name="attatibutesx3"
                                                            placeholder="Attribute3" class="form-control" required
                                                            value="{{ $attribte->attribute_3 }}">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" id="attatibutesx4" name="attatibutesx4"
                                                            placeholder="Attribute4" class="form-control"
                                                            value="{{ $attribte->attribute_4 }}">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" id="offerpricesx1" name="offerpricesx1"
                                                            placeholder="Offer Price" class="form-control"
                                                            value="{{ $attribte->offer_price }}">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" id="mrpricesx1" name="mrpricesx1"
                                                            placeholder="MRP" class="form-control"
                                                            value="{{ $attribte->mrp_price }}">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" id="attr_stocksx1" name="attr_stocksx1"
                                                            placeholder="Attribute Stock"
                                                            class="form-control attr-stocksx"
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
                                        <div data-repeater-item="" id="attribute_nox" style="display: none;">
                                            <div class="form-group row d-flex align-items-end">
                                                <div class="col">
                                                    <input class="form-control" type="checkbox" id="stockstatussx1"
                                                        name="stockstatussx1" value="1" style="width: 10%;">
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="attatibutesx1" name="attatibutesx1"
                                                        placeholder="Attribute" class="form-control" required />
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="attatibutesx2" name="attatibutesx2"
                                                        placeholder="Attribute" class="form-control" required />
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="attatibutesx3" name="attatibutesx3"
                                                        placeholder="Attribute" class="form-control" required />
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="attatibutesx4" name="attatibutesx4"
                                                        placeholder="Attribute" class="form-control" />
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="offerpricesx1" name="offerpricesx1"
                                                        placeholder="Offer Price" class="form-control" />
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="mrpricesx1" name="mrpricesx1"
                                                        placeholder="MRP" class="form-control" />
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="attr_stocksx1" name="attr_stocksx1"
                                                        placeholder="Attribute Stock"
                                                        class="form-control attr-stocksx" />
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
            <div id="productsubsx-message" class="text-center" style="display: none;"></div>
        </div>



</form>




<script>
    function updateLevel() {
        var select = document.getElementById("categorySelectorsx");
        var levelInput = document.getElementById("category_levelsx");
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



    function yesnoChecksx() {
        if (document.getElementById('yesChecksx').checked) {
            document.getElementById('ifYessx').style.display = 'block';
        } else {
            document.getElementById('ifYessx').style.display = 'none';
            $('#errorstocksx-message').hide();
        }

    }


    $(document).ready(function() {

        $('#ExistProductModal .selectshopse').each(function() {
            var $p = $(this).parent();
            $(this).select2({
                dropdownParent: $p
            });
        });
        $('#ExistProductModal .selectautox').each(function() {
            var $p = $(this).parent();
            $(this).select2({
                dropdownParent: $p
            });
        });




        $('.repeater-defaultsx').repeater({
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
        $(document).on('keyup', '.attr-stocksx', function() {
            if ($("input[name='customRadiosx']:checked").val() === "Y") {
                var totalAttributeStock = 0;
                $('.attr-stocksx').each(function() {
                    var value = parseInt($(this).val()) || 0;
                    totalAttributeStock += value;
                });
                var totalStock = parseInt($('#totstocksx').val()) || 0;
                //console.log('Total Attribute Stock:', totalAttributeStock);
                //console.log('Total Stock:', totalStock);
                if (totalAttributeStock !== totalStock) {
                    $('#errorstocksx-message').show();
                } else {
                    $('#errorstocksx-message').hide();
                }
            }

        });
        //Remove video
        $("#removeButtonsx").click(function() {
            $("#previewsx")[0].src = "";
            $("#videofilesx").val('');
            $("#video-previewsx").hide();
        });


        $('#prod_docsx').on('change', function() {
            var files = $(this).prop('files');
            var maxSize = 1 * 1024 * 1024; // 1MB

            $('#pdfmm_previewsx').empty();

            if (files && files.length > 0) {
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];

                    if (file.type === 'application/pdf') {
                        if (file.size <= maxSize) {
                            var reader = new FileReader();

                            reader.onload = function(event) {
                                $('#pdfmm_previewsx').append(
                                    "<div class='img-div col-md-12 img-container text-right' align='center'><button class='btn btn-danger remove-btnx' title='Remove PDF'>Remove</button><embed src='" +
                                    event.target.result +
                                    "' type='application/pdf' width='100%' height='400px' /><div class='middle'></div></div>"
                                );
                            };

                            reader.readAsDataURL(file);
                        } else {
                            alert("PDF file size exceeds the limit of 1MB.");
                            $('#prod_docsx').val('');
                            return false;
                        }
                    } else {
                        alert("Only PDF files are allowed.");
                        $('#prod_docsx').val('');
                        return false;
                    }
                }
            }
        });

        // Remove image
        $(document).on('click', '.remove-btnx', function() {
            $(this).closest('.img-div').remove();
            $('#prod_docsx').val('');
        });
    });



    function displayVideoPreviewsx(input) {
        const file = input.files[0];
        if (!file) {
            document.getElementById('video-previewsx').style.display = 'none';
            return;
        }
        const videoURL = URL.createObjectURL(file);
        const videoPreview = document.getElementById('previewsx');
        videoPreview.src = videoURL;
        document.getElementById('video-previewsx').style.display = 'block';
    }




    function calculateTotalAttributeStock() {
        var totalAttributeStock = 0;
        $('.attr-stocksx').each(function() {
            var value = parseInt($(this).val()) || 0;
            totalAttributeStock += value;
        });
        return totalAttributeStock;
    }

    function handleSubmit() {
        if ($("input[name='customRadiosx']:checked").val() === "Y") {
            var totalStock = parseInt($('#totstocksx').val()) || 0;
            var totalAttributeStock = calculateTotalAttributeStock();
            if (totalAttributeStock !== totalStock) {
                $('#errorstocksx-message').show();
            }
            // else {
            //     $('#ProductAddForm').submit();
            // }
        }
    }




    // var fileArrs = [];
    // var totalFiless = 0;

    // $("#s_photosx").change(function(event) {
    //     var totalFileCount = $(this)[0].files.length;
    //     if (totalFiless + totalFileCount > 10) {
    //         alert('Maximum 10 images allowed');
    //         $(this).val('');
    //         $('#image-previewsx').html('');
    //         return;
    //     }

    //     for (var i = 0; i < totalFileCount; i++) {
    //         var file = $(this)[0].files[i];

    //         if (file.size > 3145728) {
    //             alert('File size exceeds the limit of 3MB');
    //             $(this).val('');
    //             $('#image-previewsx').html('');
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
    //                 var removeBtn = $('<button>').addClass('btn btn-danger remove-btnsx').attr(
    //                     'title', 'Remove Image').append('Remove').attr('role', file.name);

    //                 imgDiv.append(img);
    //                 imgDiv.append($('<div class="text-center">').addClass('middle').append(
    //                     removeBtn));

    //                 $('#image-previewsx').append(imgDiv);
    //             };
    //         })(file);

    //         reader.readAsDataURL(file);
    //     }
    // });

    // $(document).on('click', '.remove-btnsx', function() {
    //     var fileName = $(this).attr('role');

    //     for (var i = 0; i < fileArrs.length; i++) {
    //         if (fileArrs[i].name === fileName) {
    //             fileArrs.splice(i, 1);
    //             totalFiless--;
    //             break;
    //         }
    //     }

    //     document.getElementById('s_photosx').files = new FileListItem(fileArrs);
    //     $(this).closest('.img-div').remove();
    // });

    var fileArrs = [];
    var totalFiless = 0;

    $("#s_photosx").change(function(event) {
        //$('#image-previewsx').html('');
        var totalFileCount = $(this)[0].files.length;


        for (var i = 0; i < totalFileCount; i++) {
            var file = $(this)[0].files[i];

            if (file.size > 3145728) {
                alert('File size exceeds the limit of 3MB');
                $(this).val('');
                $('#image-previewsx').html('');
                return;
            }

            fileArrs.push(file);
            totalFiless++;
            if (totalFiless  > 10) {
            alert('Maximum 10 images allowed');
            $(this).val('');
            $('#image-previewsx').html('');
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

                    $('#image-previewsx').append(imgDiv);
                };
            })(file);

            reader.readAsDataURL(file);
        }
        document.getElementById('s_photosx').files = new FileListItem([]);
        document.getElementById('s_photosx').files = new FileListItem(fileArrs);

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

        document.getElementById('s_photosx').files = new FileListItem(fileArrs);
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





    $("#ProductRegExistAddNew").validate({

        rules: {
            shop_namesx: {
                required: true,
            },

            prod_namesx: {
                required: true,
                pattern: /^[A-Za-z\s\.]+$/,
            },
            parent_categorysx: {
                required: true,
            },

            prod_descriptionsx: {
                required: true,
            },
            totstocksx: {
                required: true,
                digits: true,
            },
            paymodesx: {
                required: true,
            },
            customRadiosx: {
                required: true,
            },
            productstatusx: {
                required: true,
            },

        },
        messages: {
            shop_namesx: {
                required: "Please select shop name."
            },
            prod_namesx: {
                pattern: "Only characters, spaces, and dots are allowed.",
            },
            parent_categorysx: {
                required: "Please select a category."
            },
            prod_descriptionsx: {
                required: "Please enter product description.",
                maxlength: "Locality must not exceed 700 characters."
            },
            totstocksx: {
                digits: "Please enter a number.",
            },
            paymodesx: {
                required: "Please select Buying Option",
            },
            customRadiosx: {
                required: "Please select attribute",
            },
            productstatusx: {
                required: "Please select product status",
            },

        },
    });


    $('#prod_namesx').on('input', function() {
        var value = $(this).val();
        value = value.replace(/[^A-Za-z\s\.]+/, '');
        $(this).val(value);
    });


    $.validator.addMethod('maxSize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param);
    }, 'File size must be less than {0} KB');


    $('#ProductRegExistAddNew').submit(function(e) {
        e.preventDefault();
        handleSubmit();
        if ($(this).valid()) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            $.ajax({
                url: '{{ route('AdmPrdoductExist') }}',
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
                        $('#productsubsx-message').text(response.mesge).fadeIn();
                        $('#productsubsx-message').addClass('success-message');
                        $('#image-previewsx').empty();
                        $("#previewsx")[0].src = "";
                        $("#videofilesx").val('');
                        $("#video-previewsx").hide();
                        $('#pdfmm_previewsx').empty();
                        setTimeout(function() {
                            $('#productsubsx-message').fadeOut();
                        }, 5000);
                        $('#ProductAddForm')[0].reset();
                        $('#ProductRegExistAddNew')[0].reset();
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#ExistProductModal').modal('hide');
                        shwdets();
                    } else if (response.result == 2) {
                        $('#productsubsx-message').text(response.mesge).fadeIn();
                        $('#productsubsx-message').addClass('error');
                        setTimeout(function() {
                            $('#productsubsx-message').fadeOut();
                        }, 5000);
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#ExistProductModal').modal('show');

                    } else if (response.result == 3 || response.result == 4) {
                        $('#productsubsx-message').text(response.mesge).fadeIn();
                        $('#productsubsx-message').addClass('error');
                        setTimeout(function() {
                            $('#productsubsx-message').fadeOut();
                        }, 5000);
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#ExistProductModal').modal('show');

                    } else {
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                    }
                }
            });
        }
    });
</script>
