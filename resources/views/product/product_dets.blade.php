@if ($ProductCount > 0)
    <table id="datatable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Approved all<input type='checkbox' name='checkbox1' id='checkbox1' onclick='check();' /></th>
                <th>SINO</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Shop Name</th>
                <th>Status</th>
                <th>Is Approved?</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($ProductDetails as $index => $prodDetails)
                <tr>
                    <td><input name="productid[]" type="checkbox" id="productid{{ $index + 1 }}"
                            value="{{ $prodDetails->id }}" {{ $prodDetails->is_approved === 'Y' ? 'checked' : '' }} />
                    </td>
                    <td>{{ $index + 1 }}</td>
                    <td>PRD{{ str_pad($prodDetails->id, 9, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $prodDetails->product_name }}</td>
                    <td>{{ $prodDetails->shopname }}</td>
                    <td><span
                            class="badge p-2 {{ $prodDetails->product_status === 'Y' ? 'badge badge-success' : 'badge badge-danger' }}">
                            {{ $prodDetails->product_status === 'Y' ? 'Available' : 'Not Available' }}
                        </span></td>
                    <td><span
                            class="badge p-2 {{ $prodDetails->is_approved === 'Y' ? 'badge badge-success' : ($prodDetails->is_approved === 'N' ? 'badge badge-info' : 'badge badge-danger') }}">
                            {{ $prodDetails->is_approved === 'Y' ? 'Yes' : ($prodDetails->is_approved === 'N' ? 'No' : 'Rejected') }}
                        </span></td>
                    <td>
                        <div class="btn-group mb-2 mb-md-0">
                            <button type="button" class="btn view_btn dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Action
                                <i class="mdi mdi-chevron-down"></i></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item view_btn1" href="#"
                                    onclick="productvieweditdet({{ $prodDetails->id }})">View/Edit</a>
                                    @if (session('roleid') == '1' || session('roleid') == '11')
                                    <a class="dropdown-item approve_btn" href="#"
                                        onclick="productapprovedet({{ $prodDetails->id }})">Approved</a>
                                    <a class="dropdown-item delete_btn" href="#"
                                        onclick="productdeletedet({{ $prodDetails->id }})">Delete</a>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach



        </tbody>
    </table>
    <input type="hidden" value="{{ $index + 1 }}" id="totalproductcnt">
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

@if ($ProductCount > 0)
    <div class="col text-center">
        <button class="btn btn-primary" style="cursor:pointer" onclick="productapprovedall();">Approved</button>
    </div>
@endif


<!-- Modal Add New -->
<div class="modal fade p-5" id="addNewModal" tabindex="-1" aria-labelledby="addNewModalLabel" aria-hidden="true">
    <div class="modal-dialog custom-modal-dialog" style="overflow-y: scroll;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="addNewModalLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    title="Close">x</button>
            </div>
            <div class="modal-body">
                <form id="ProductAddForm" enctype="multipart/form-data" method="POST">
                    <input type="hidden" id="selectedProductId" name="selectedProductId">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    @php
                                        $shopshowhide = session('roleid') == 1 || session('roleid') == 11 || session('roleid') == 3 ? 'style=display:block;' : 'style=display:none;';
                                    @endphp


                                    <div class="form-group" {{ $shopshowhide }}><label>Shop Name<span
                                                class="text-danger">*</span></label>
                                        <select class="selectshops form-select form-control form-control-lg"
                                            id="shop_name" name="shop_name" required tabindex="1">
                                            <option value="">Select Shop Name</option><br />
                                            @foreach ($usershopdets as $shps)
                                                <option value="{{ $shps->id }}"
                                                    @if ($shps->id == session('user_id')) selected @endif>
                                                    {{ $shps->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="shop_name" class="error"></label>
                                    </div>


                                    <div class="form-group"><label>Product Name<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="prod_name" name="prod_name"
                                            class="enterproduct form-control" maxlength="60" placeholder="Product Name"
                                            required tabindex="1" onchange="showexistproduct();" />
                                        <label for="prod_name" class="error"></label>
                                    </div>
                                    <div class="form-group"><label> Product Specification<span
                                                class="text-danger">*</span></label>
                                        <textarea id="prod_specification" name="prod_specification" placeholder="Product Specification" class="form-control"
                                            maxlength="250" tabindex="2" required></textarea>
                                        <label for="prod_specification"></label>
                                    </div>


                                    <div class="form-group"><label>Category<span class="text-danger">*</span></label>
                                        <select class="selectauto form-control" id="categorySelector"
                                            name="parent_category" tabindex="3" required>
                                            <option value="">Select Category</option>
                                            @foreach ($filteredCategories as $key => $category)
                                                <option value="{{ $category->id }}"
                                                    data-level="{{ $category->category_level }}">
                                                    @for ($i = 0; $i < $category->category_level; $i++)
                                                    @endfor
                                                    <span
                                                        class="{{ $key === count($filteredCategories) - 1 ? 'last-child' : '' }}">{{ $category->category_name }}</span>
                                                </option>
                                            @endforeach
                                        </select><label for="categorySelector"></label>
                                    </div>


                                    <div class="form-group">
                                        <label>Product Description <span class="text-danger">*</span></label>
                                        <textarea id="prod_description" name="prod_description" placeholder="Product Description" class="form-control"
                                            maxlength="7000" tabindex="4" required rows="3"></textarea>
                                        <label for="prod_description"></label>
                                    </div>


                                    <div class="form-group"><label>Product Images<span
                                                class="text-danger">*</span></label>
                                        <input type="file" id="s_photo" multiple="" name="s_photo[]"
                                            class="form-control" placeholder="Shop Photo" tabindex="5" required
                                            accept="image/jpeg, image/png" />
                                        <label for="s_photo" class="error"></label>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group" align="left">
                                            <div id="image-preview" class="row"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Upload Video</label>
                                        <input type="file" class="form-control" id="videofile" name="videofile"
                                            tabindex="6" accept="video/*" onchange="displayVideoPreview(this)">
                                        <div id="video-preview" style="display: none;">
                                            <video id="preview" width="320" height="240" controls>
                                                Your browser does not support the video tag.
                                            </video>
                                            <div class="video-remove-button" id="removeButton">Remove</div>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label>Add PDF Document</label>
                                        <input type='file' name='prod_doc' id="prod_doc" tabindex="7"
                                            class="form-control" accept="application/pdf">

                                        <div class="form-group">
                                            <div id="pdfmm_preview" class="row"></div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label>Manufacturer Details</label>
                                        <textarea id="prod_manufacture" name="prod_manufacture" placeholder="Manufacturer Details" class="form-control"
                                            maxlength="250" rows="2" tabindex="8"></textarea>
                                        <label for="prod_manufacture" class="error"></label>
                                    </div>
                                    <div class="form-group">
                                        <label>Brand Name</label>
                                        <input type="text" class="form-control" id="brand_name" name="brand_name"
                                            maxlength="120" placeholder="Brand Name" tabindex="9">
                                    </div>

                                    <div class="form-group mb-0 row">
                                        <label class="col-md-4">Buying Option : </label>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-control" type="checkbox" id="cashdeposit"
                                                        name="cashdeposit" value="1" style="width: 27%;">

                                                    {{-- <input type="radio" class="form-check-input" id="cod"
                                                        name="paymode" value="cod" tabindex="10"> --}}
                                                    <label class="form-check-label" for="cod">COD</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-control" type="checkbox" id="fromshop"
                                                        name="fromshop" value="1" style="width: 11%;">

                                                    {{-- <input type="radio" class="form-check-input" id="fromshop"
                                                        name="paymode" value="shop" tabindex="11"> --}}
                                                    <label class="form-check-label" for="fromshop">Buy From
                                                        Shop</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-control" type="checkbox" id="calshop"
                                                        name="calshop" value="1" style="width: 16%;">
                                                    {{-- <input type="radio" class="form-check-input" id="calshop"
                                                        name="paymode" value="calshop" tabindex="12"> --}}
                                                    <label class="form-check-label" for="calshop">Call Shop</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" style="display: none;">
                                        <label>Stock </label>
                                        <input type="number" class="form-control" id="totstock" name="totstock"
                                            tabindex="13" value="0">
                                    </div>
                                    <div class="form-group" style="display: none;">
                                        <div id="errorstock-message" class="text-danger" style="display: none;">Total
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
                                                    <input type="radio" id="yesCheck" name="customRadio"
                                                        class="custom-control-input"
                                                        onclick="javascript:yesnoCheck();" tabindex="14"
                                                        value="Y" checked>
                                                    <label class="custom-control-label" for="yesCheck">Yes</label>
                                                </div>
                                            </div>
                                            <div class="form-check-inline my-1">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="noCheck" name="customRadio"
                                                        class="custom-control-input"
                                                        onclick="javascript:yesnoCheck();" tabindex="15"
                                                        value="N">
                                                    <label class="custom-control-label" for="noCheck">No</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <hr>
                                    <div id="ifYes">
                                        {{-- style="display:none" --}}
                                        <fieldset>
                                            <div class="repeater-default">
                                                <div data-repeater-list="attributedata">
                                                    <!-- Heading Row -->
                                                    <div class="form-group row">
                                                        <div class="col">
                                                            <label class="control-label"> Stock Status </label>
                                                        </div>

                                                    </div>
                                                    <!-- Dynamic Rows -->
                                                    <div data-repeater-item="">
                                                        <div class="form-group row d-flex align-items-end">
                                                            <div class="col">
                                                                <input class="form-control" type="checkbox"
                                                                    id="stockstatus1" name="stockstatus1"
                                                                    value="1" style="width: 10%;">
                                                            </div>
                                                            <div class="col">
                                                                <input type="text" id="attatibute1"
                                                                    name="attatibute1" placeholder="Attribute1"
                                                                    required class="form-control">
                                                            </div>
                                                            <div class="col">
                                                                <input type="text" id="attatibute2"
                                                                    name="attatibute2" placeholder="Attribute2"
                                                                    required class="form-control">
                                                            </div>
                                                            <div class="col">
                                                                <input type="text" id="attatibute3"
                                                                    name="attatibute3" placeholder="Attribute3"
                                                                    required class="form-control">
                                                            </div>
                                                            <div class="col">
                                                                <input type="text" id="attatibute4"
                                                                    name="attatibute4" placeholder="Attribute4"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="col">
                                                                <input type="text" id="offerprice1"
                                                                    name="offerprice1" placeholder="Offer Price"
                                                                    class="form-control"
                                                                    oninput="numberOnlyAllowedDot(this)">
                                                            </div>
                                                            <div class="col">
                                                                <input type="text" id="mrprice1" name="mrprice1"
                                                                    placeholder="MRP" class="form-control"
                                                                    oninput="numberOnlyAllowedDot(this)">
                                                            </div>
                                                            <div class="col" style="display: none;">
                                                                <input type="text" id="attr_stock1"
                                                                    name="attr_stock1" placeholder="Attribute Stock"
                                                                    class="form-control attr-stock"
                                                                    oninput="numberOnlyAllowed(this)">
                                                            </div>
                                                            <div class="col">
                                                                <span data-repeater-delete=""
                                                                    class="btn btn-danger btn-sm">
                                                                    <span class="far fa-trash-alt mr-1"></span> Delete
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0 row">
                                                    <div class="col-sm-12">
                                                        <span data-repeater-create=""
                                                            class="btn btn-secondary btn-sm">
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
                            <button type="button" class="btn btn-danger" id="resetButton">Reset</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div id="productsub-message" class="text-center" style="display: none;"></div>
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


<div class="modal fade p-5" id="ExistProductModal" tabindex="-1" aria-labelledby="ExistProductModalLabel"
    aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog custom-modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="ExistProductModalLabel">Exist Product Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    title="Close">x</button>
            </div>
            <div class="modal-body">
                <div id="showproductexistedit">

                </div>
            </div>
        </div>
    </div>
</div>



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


    function yesnoCheck() {
        if (document.getElementById('yesCheck').checked) {
            document.getElementById('ifYes').style.display = 'block';
        } else {
            document.getElementById('ifYes').style.display = 'none';
            $('#errorstock-message').hide();
        }

    }

    $(document).ready(function() {
        $('#resetButton').click(function() {
            $('#ProductAddForm input, #ProductAddForm select, #ProductAddForm textarea').val('');
            $('#ProductAddForm .error').text('');
            $('#ProductAddForm #errorstock-message').text('');
            $('#image-preview').html('');
            $('#video-preview').html('');
            $('#pdfmm_preview').html('');
            $('#ProductAddForm input[type="file"]').val('');
            $('#ProductAddForm .selectpicker').selectpicker('val', '');
        });
        // $('#totstock').on('input', function() {
        //     var value = $(this).val();
        //     if (parseFloat(value) < 0) {
        //         $(this).val(0);
        //     }
        // });
    });


    $(document).ready(function() {
        var url = "{{ route('ProductNameSearch') }}";
        $('#prod_name').autocomplete({
            source: function(request, response) {
                $.post(url, {
                    prodname: request.term
                }, function(data) {
                    var options = [];
                    if (data.length > 0) {
                        data.forEach(function(productdets) {
                            var optionText = productdets.product_name;
                            options.push({
                                value: optionText,
                                label: optionText,
                                id: productdets.id
                            });
                        });
                    }
                    response(options);
                }, 'json');
            },
            minLength: 1,
            select: function(event, ui) {
                $('#selectedProductId').val(ui.item.id);
            }
        });



        $('.repeater-default').repeater({
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
        // $(document).on('keyup', '.attr-stock', function() {
        //     if ($("input[name='customRadio']:checked").val() === "Y") {
        //         var totalAttributeStock = 0;
        //         $('.attr-stock').each(function() {
        //             var value = parseInt($(this).val()) || 0;
        //             totalAttributeStock += value;
        //         });
        //         var totalStock = parseInt($('#totstock').val()) || 0;
        //         //console.log('Total Attribute Stock:', totalAttributeStock);
        //         //console.log('Total Stock:', totalStock);
        //         if (totalAttributeStock !== totalStock) {
        //             $('#errorstock-message').show();
        //         } else {
        //             $('#errorstock-message').hide();
        //         }
        //     }

        // });
        //Remove video
        $("#removeButton").click(function() {
            $("#preview")[0].src = "";
            $("#videofile").val('');
            $("#video-preview").hide();
        });


        $('#prod_doc').on('change', function() {
            var files = $(this).prop('files');
            var maxSize = 1 * 1024 * 1024; // 1MB

            $('#pdfmm_preview').empty();

            if (files && files.length > 0) {
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];

                    if (file.type === 'application/pdf') {
                        if (file.size <= maxSize) {
                            var reader = new FileReader();

                            reader.onload = function(event) {
                                $('#pdfmm_preview').append(
                                    "<div class='img-div col-md-12 img-container text-right' align='center'><button class='btn btn-danger remove-btn' title='Remove PDF'>Remove</button><embed src='" +
                                    event.target.result +
                                    "' type='application/pdf' width='100%' height='400px' /><div class='middle'></div></div>"
                                );
                            };

                            reader.readAsDataURL(file);
                        } else {
                            alert("PDF file size exceeds the limit of 1MB.");
                            $('#prod_doc').val('');
                            return false;
                        }
                    } else {
                        alert("Only PDF files are allowed.");
                        $('#prod_doc').val('');
                        return false;
                    }
                }
            }
        });

        // Remove image
        $(document).on('click', '.remove-btn', function() {
            $(this).closest('.img-div').remove();
            $('#prod_doc').val('');
        });

        $('#addNewModal .selectauto').each(function() {
            var $p = $(this).parent();
            $(this).select2({
                dropdownParent: $p
            });
        });
        $('#addNewModal .selectshops').each(function() {
            var $p = $(this).parent();
            $(this).select2({
                dropdownParent: $p
            });
        });


    });





    function displayVideoPreview(input) {
        const file = input.files[0];
        if (!file) {
            document.getElementById('video-preview').style.display = 'none';
            return;
        }

        const videoURL = URL.createObjectURL(file);
        const videoPreview = document.getElementById('preview');
        videoPreview.src = videoURL;
        document.getElementById('video-preview').style.display = 'block';
    }




    function calculateTotalAttributeStock() {
        var totalAttributeStock = 0;
        $('.attr-stock').each(function() {
            var value = parseInt($(this).val()) || 0;
            totalAttributeStock += value;
        });
        return totalAttributeStock;
    }

    // function handleSubmit() {
    //     if ($("input[name='customRadio']:checked").val() === "Y") {
    //         var totalStock = parseInt($('#totstock').val()) || 0;
    //         var totalAttributeStock = calculateTotalAttributeStock();

    //         if (totalAttributeStock !== totalStock) {
    //             $('#errorstock-message').show();
    //             return false;
    //         }

    //     }
    // }




    // var fileArrs = [];
    // var totalFiless = 0;

    // $("#s_photo").change(function(event) {
    //     var totalFileCount = $(this)[0].files.length;
    //     if (totalFiless + totalFileCount > 10) {
    //         alert('Maximum 10 images allowed');
    //         $(this).val('');
    //         $('#image-preview').html('');
    //         return;
    //     }

    //     for (var i = 0; i < totalFileCount; i++) {
    //         var file = $(this)[0].files[i];

    //         if (file.size > 3145728) {
    //             alert('File size exceeds the limit of 3MB');
    //             $(this).val('');
    //             $('#image-preview').html('');
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

    //                 $('#image-preview').append(imgDiv);
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

    //     document.getElementById('s_photo').files = new FileListItem(fileArrs);
    //     $(this).closest('.img-div').remove();
    // });



    var fileArrs = [];
    var totalFiless = 0;

    $("#s_photo").change(function(event) {
        //$('#image-preview').html('');
        var totalFileCount = $(this)[0].files.length;


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
            if (totalFiless > 10) {
                alert('Maximum 10 images allowed');
                $(this).val('');
                $('#image-preview').html('');
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
                    $('#image-preview').append(imgDiv);
                };
            })(file);

            reader.readAsDataURL(file);
        }
        document.getElementById('s_photo').files = new FileListItem([]);
        document.getElementById('s_photo').files = new FileListItem(fileArrs);

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





    $("#ProductAddForm").validate({

        rules: {
            shop_name: {
                required: true,
            },
            prod_name: {
                required: true,
                pattern: /^[A-Za-z\s\.]+$/,
            },
            parent_category: {
                required: true,
            },

            prod_description: {
                required: true,
            },
            //totstock: {
                //required: true,
                //digits: true,
            //},
            // paymode: {
            //     required: true,
            // },
            customRadio: {
                required: true,
            },

        },
        messages: {
            shop_name: {
                required: "Please select shop name",
            },
            prod_name: {
                pattern: "Only characters, spaces, and dots are allowed.",
            },
            parent_category: {
                required: "Please select a category."
            },
            prod_description: {
                required: "Please enter product description.",
                maxlength: "Locality must not exceed 700 characters."
            },
            // totstock: {
            //     digits: "Please enter a number.",
            // },
            // paymode: {
            //     required: "Please select Buying Option",
            // },
            customRadio: {
                required: "Please select attribute",
            },

        },
    });


    $('#prod_name').on('input', function() {
        var value = $(this).val();
        value = value.replace(/[^A-Za-z\s\.]+/, '');
        $(this).val(value);
        $('#selectedProductId').val('');
    });


    $.validator.addMethod('maxSize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param);
    }, 'File size must be less than {0} KB');


    $('#ProductAddForm').submit(function(e) {
        e.preventDefault();
        //handleSubmit();
        if ($(this).valid()) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            $.ajax({
                url: '{{ route('AdmNewPrdoductAdd') }}',
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
                        $('#productsub-message').text(response.mesge).fadeIn();
                        $('#productsub-message').addClass('success-message');
                        $('#image-preview').empty();
                        $("#preview")[0].src = "";
                        $("#videofile").val('');
                        $("#video-preview").hide();
                        $('#pdfmm_preview').empty();
                        setTimeout(function() {
                            $('#productsub-message').fadeOut();
                        }, 5000);
                        $('#ProductAddForm')[0].reset();
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#addNewModal').modal('hide');
                        shwdets();
                    } else if (response.result == 2) {
                        $('#productsub-message').text(response.mesge).fadeIn();
                        $('#productsub-message').addClass('error');
                        setTimeout(function() {
                            $('#productsub-message').fadeOut();
                        }, 5000);
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#addNewModal').modal('show');

                    } else if (response.result == 3) {
                        // var errorMessages = response.mesge;
                        // var errorText = "";
                        // for (var key in errorMessages) {
                        //     if (errorMessages.hasOwnProperty(key)) {
                        //         errorText += key + ": " + errorMessages[key] + "\n";
                        //     }
                        // }
                        // alert(errorText)
                        $('#productsub-message').text(response.mesge).fadeIn();
                        $('#productsub-message').addClass('error');
                        setTimeout(function() {
                            $('#productsub-message').fadeOut();
                        }, 5000);
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#addNewModal').modal('show');

                    } else {
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                    }
                }
            });
        }
    });



    function showexistproduct() {
        $('#loading-overlay').fadeIn();
        $('#loading-image').fadeIn();
        var existprodid = $('#selectedProductId').val();
        if (existprodid == '' || existprodid == '0') {
            $('#loading-image').fadeOut();
            $('#loading-overlay').fadeOut();
        } else {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{ route('productExistEdit') }}',
                type: 'POST',
                data: {
                    productid: existprodid
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(data) {

                    $('#loading-image').fadeOut();
                    $('#loading-overlay').fadeOut();
                    var data1 = data.trim();
                    $("#showproductexistedit").html(data1);
                    $('#ExistProductModal').modal('show');
                    $('#addNewModal').modal('hide');

                }
            });

        }
    }
</script>
