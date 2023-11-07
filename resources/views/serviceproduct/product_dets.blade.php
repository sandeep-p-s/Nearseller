@if ($ProductCount > 0)
    <style>
        tfoot {
            display: table-caption;
        }

        tfoot input {
            width: 100%;
            padding: 3px;
            box-sizing: border-box;
        }
    </style>
    @if (session('roleid') == '1' || session('roleid') == '11')
        <div class="text-center">
            <span class="badge badge-soft-info p-2">
                Total Available Services : {{ $approvedproductcounts->prod_status_y_count }}
            </span>
            <span class="badge badge-soft-danger p-2">
                Total Not Available Services : {{ $approvedproductcounts->prod_status_not_y_count }}
            </span>

            <span class="badge badge-soft-info p-2">
                Total Approved Services : {{ $approvedproductcounts->approved_y_count }}
            </span>
            <span class="badge badge-soft-danger p-2">
                Total Not Approved Services : {{ $approvedproductcounts->approved_not_y_count }}
            </span>
            <span class="badge badge-soft-danger p-2">
                Total Rejected Services : {{ $approvedproductcounts->approved_reject_y_count }}
            </span>


        </div>
    @endif
    <table id="datatable3" class="table table-striped table-bordered" style="width: 100%">
        <thead>
            <tr>
                {{-- <th>Approved all<input type='checkbox' name='checkbox1' id='checkbox1' onclick='check();' /></th> --}}
                @if (session('roleid') == '1' || session('roleid') == '11')
                    <th width="5px" data-sorting="true"><input type='checkbox' name='checkbox1' id='checkbox1'
                            class="selectAll" onclick='' /></th>
                @endif
                <th>S.No.</th>
                <th>Service ID</th>
                <th>Service Name</th>
                <th>Service Provider Name</th>
                <th>Status</th>
                <th>Is Approved?</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($ServiceDetails as $index => $prodDetails)
                <tr>
                    @if (session('roleid') == '1' || session('roleid') == '11')
                        <td><input name="productid[]" type="checkbox" id="productid{{ $index + 1 }}"
                                value="{{ $prodDetails->id }}"
                                {{ $prodDetails->is_approved === 'Y' ? 'checked' : '' }} />
                        </td>
                    @endif
                    <td>{{ $index + 1 }}</td>
                    <td>SER{{ str_pad($prodDetails->id, 9, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $prodDetails->service_name }}</td>
                    <td>{{ $prodDetails->shopname }}</td>
                    <td><span
                            class="badge p-2 {{ $prodDetails->service_status === 'Y' ? 'badge badge-success' : 'badge badge-danger' }}">
                            {{ $prodDetails->service_status === 'Y' ? 'Available' : 'Not Available' }}
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
        <tfoot>
            <tr>
                @if (session('roleid') == '1' || session('roleid') == '11')
                    <th style="border: 0px solid #eaf0f7"></th>
                @endif
                <th style="border: 0px solid #eaf0f7"></th>
                <th style="border: 0px solid #eaf0f7">Service ID</th>
                <th style="border: 0px solid #eaf0f7">Service Name</th>
                <th style="border: 0px solid #eaf0f7">Service Provider Name</th>
                <th style="border: 0px solid #eaf0f7">Status</th>
                <th style="border: 0px solid #eaf0f7">Is Approved?</th>
                <th style="border: 0px solid #eaf0f7"></th>
            </tr>
        </tfoot>
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
@if (session('roleid') == '1' || session('roleid') == '11')
    @if ($ProductCount > 0)
        <div class="col text-center">
            <button class="btn btn-primary" style="cursor:pointer" onclick="productapprovedall();">Approved</button>
        </div>
    @endif
@endif


<!-- Modal Add New -->
<div class="modal fade p-5" id="addNewModal" tabindex="-1" aria-labelledby="addNewModalLabel" aria-hidden="true">
    <div class="modal-dialog custom-modal-dialog" style="overflow-y: scroll;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="addNewModalLabel">Add New Services</h5>
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


                                    <div class="form-group" {{ $shopshowhide }}><label>Service Provider Name<span
                                                class="text-danger">*</span></label>
                                        <select class="selectshops form-select form-control form-control-lg"
                                            id="shop_name" name="shop_name" required tabindex="1">
                                            <option value="">Select Service Provider</option><br />
                                            @if (count($userservicedets) > 0)
                                                @foreach ($userservicedets as $shps)
                                                    <option value="{{ $shps->id }}"
                                                        @if ($shps->id == session('user_id')) selected @endif>
                                                        {{ $shps->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <label for="shop_name" class="error"></label>
                                    </div>


                                    <div class="form-group"><label>Service Name<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="prod_name" name="prod_name"
                                            class="enterproduct form-control" maxlength="60"
                                            placeholder="Service Name" required tabindex="1" />
                                        <label for="prod_name" class="error"></label>
                                    </div>

                                    <div class="form-group"><label>Service Image<span
                                                class="text-danger">*</span></label>
                                        <input type="file" id="s_photo" name="s_photo[]" class="form-control"
                                            placeholder="Service Photo" tabindex="5" required
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
                                        <label>Service Description <span class="text-danger">*</span></label>
                                        <textarea id="prod_description" name="prod_description" placeholder="Service Description" class="form-control"
                                            maxlength="7000" tabindex="4" required rows="3"></textarea>
                                        <label for="prod_description"></label>
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
                                                            value="Y">
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
                                        <div id="ifYes" style="display:none">
                                            <fieldset>
                                                <div class="repeater-default">
                                                    <div data-repeater-list="attributedata">
                                                        <!-- Heading Row -->
                                                        <div class="form-group row">
                                                            <div class="col">
                                                                <label class="control-label"> Show status </label>
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
                                                                        maxlength="10" class="form-control"
                                                                        oninput="numberOnlyAllowedDot(this)">
                                                                </div>
                                                                <div class="col">
                                                                    <input type="text" id="mrprice1"
                                                                        name="mrprice1" placeholder="MRP"
                                                                        maxlength="10" class="form-control"
                                                                        oninput="numberOnlyAllowedDot(this)">
                                                                </div>
                                                                <div class="col">
                                                                    <input type="text" id="attr_calshop1"
                                                                        name="attr_calshop1" placeholder="Call Shop"
                                                                        maxlength="10" class="form-control"
                                                                        oninput="numberOnlyAllowed(this)">
                                                                </div>
                                                                <div class="col">
                                                                    <span data-repeater-delete=""
                                                                        class="btn btn-danger btn-sm">
                                                                        <span class="far fa-trash-alt mr-1"></span>
                                                                        Delete
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
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger" id="resetButton">Reset</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div id="productsub-message" class="text-center" style="display: none;"></div>
                        </div>

                        <div class="col-md-12">
                            <div id="product_del-message" class="text-center" style="display: none;"></div>
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
    function yesnoCheck() {
        if (document.getElementById('yesCheck').checked) {
            document.getElementById('ifYes').style.display = 'block';
        } else {
            document.getElementById('ifYes').style.display = 'none';
            $('#errorstock-message').hide();
        }

    }

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

    $(document).ready(function() {

        var table = $('#datatable3').DataTable({
            initComplete: function() {
                this.api()
                    .columns()
                    .every(function() {
                        let column = this;
                        let title = column.footer().textContent;
                        if (title == "")
                            return;
                        // Create input element
                        let input = document.createElement('input');
                        input.className = "form-control form-control-lg";
                        input.type = "text";
                        input.placeholder = title;
                        column.footer().replaceChildren(input);

                        // Event listener for user input
                        input.addEventListener('keyup', () => {
                            if (column.search() !== this.value) {
                                column.search(input.value).draw();
                            }
                        });
                    });
            },
            "columnDefs": [{
                "targets": 0,
                "orderable": false
            }]
        });



        $(".selectAll").on("click", function(event) {
            var isChecked = $(this).is(":checked");
            $("#datatable3 tbody input[type='checkbox']").prop("checked", isChecked);
        });


        $('#resetButton').click(function() {
            $('#ProductAddForm input, #ProductAddForm select').val('');
            $('#ProductAddForm .error').text('');
            $('#image-preview').html('');
            $('#ProductAddForm input[type="file"]').val('');
        });
    });


    $(document).ready(function() {
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

        $('#addNewModal .selectshops').each(function() {
            var $p = $(this).parent();
            $(this).select2({
                dropdownParent: $p
            });
        });


    });




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
            if (totalFiless > 1) {
                alert('Maximum 1 images allowed');
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
                    if (fileArrs.length > 0)
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
            },
            prod_description: {
                required: true,
            },
            customRadio: {
                required: true,
            },

        },
        messages: {
            shop_name: {
                required: "Please select shop name",
            },
            prod_name: {
                required: "Please enter services name",
            },
            prod_description: {
                required: "Please enter service description",
            },
            customRadio: {
                required: "Please select attribute",
            },

        },
    });


    $.validator.addMethod('maxSize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param);
    }, 'File size must be less than {0} KB');


    $('#ProductAddForm').submit(function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            $.ajax({
                url: '{{ route('AdmNewServiceAdd') }}',
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
</script>
