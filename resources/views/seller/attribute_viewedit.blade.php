


                <form id="AttributeFormEdit" enctype="multipart/form-data" method="POST">
                  <input type="hidden" id="atributeidhid" name="atributeidhid" value="{{ $attributeslist->id }}"  class="form-control form-control-lg" maxlength="50"  placeholder="Shop id" required  tabindex="1" />
                <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-outline mb-3"><label >Attribute Name</label>
                            <input type="text" id="eattr_name" name="eattr_name" value="{{ $attributeslist->attribute_name }}"  class="form-control form-control-lg" maxlength="50"  placeholder="Attribute Name" required  tabindex="1" />
                            <label for="es_name" class="error"></label>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div style="float:right">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>

                        </div>
                    </div>

                    <div class="col-md-12">
                        <div id="editattr-message"  class="text-center" style="display: none;"></div>
                    </div>
                 </div>
                </div>
                </form>

<!-- Modal Add new Close -->



<script>




      


            var fileArrs = [];
            var totalFiless = 0;

            $("#es_photo").change(function(event) {
                var totalFileCount = $(this)[0].files.length;
                if (totalFiless + totalFileCount > 5) {
                    alert('Maximum 5 images allowed');
                    $(this).val('');
                    $('#eimage-preview').html('');
                    return;
                }

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

                    var reader = new FileReader();
                    reader.onload = (function(file) {
                        return function(event) {
                            var imgDiv = $('<div>').addClass('img-div col-md-3 img-container');
                            var img = $('<img>').attr('src', event.target.result).addClass('img-responsive image img-thumbnail').attr('width', '100');
                            var removeBtn = $('<button>').addClass('btn btn-danger remove-btns').attr('title', 'Remove Image').append('X').attr('role', file.name);

                            imgDiv.append(img);
                            imgDiv.append($('<div>').addClass('middle').append(removeBtn));

                            $('#eimage-preview').append(imgDiv);
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

                document.getElementById('es_photo').files = new FileListItem(fileArrs);
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
                es_name: {
                    required: true,
                    pattern: /^[A-Za-z\s\.]+$/,
                },
                es_ownername: {
                    required: true,
                    pattern: /^[A-Za-z\s\.]+$/,
                },
                es_mobno: {
                    required: true,
                    digits: true,
                    minlength: 10,
                },
                es_email: {
                    required: true,
                    email: true,
                },

                es_busnestype: {
                    required: true,

                },
                es_shopservice: {
                    required: true,

                },
                es_shopexectename: {
                    required: true,

                },
                es_lisence: {
                    required: true,
                },
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
                es_googlelink: {
                    required: true,
                },
                es_gstno: {
                    required: true,
                },
                es_panno: {
                    required: true,
                },
                es_establishdate: {
                    required: true,
                },
                es_termcondtn: {
                    required: true,
                },
                es_photo: {
                    // required: true,
                    extension: 'jpg|jpeg|png',
                },
                eopentime: {
                    required: true,
                },
                eclosetime: {
                    required: true,
                },
                es_registerdate: {
                    required: true,
                },
                emanufactringdets: {
                    required: true,
                },


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
                ees_photo: {
                    extension: "Only JPG and PNG files are allowed.",
                },
                es_lisence: {
                    required: "Please enter the license number.",
                    maxlength: "License number must not exceed 25 characters."
                },
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
                es_googlelink: {
                    required: "Please enter the Google map link location."
                },
                es_gstno: {
                    required: "Please enter the GST number.",
                    maxlength: "GST number must not exceed 25 characters."
                },
                es_panno: {
                    required: "Please enter the PAN number.",
                    maxlength: "PAN number must not exceed 12 characters."
                },
                es_establishdate: {
                    required: "Please select the establishment date."
                },
                es_termcondtn: {
                    required: "Please accept the terms and conditions."
                },
                eopentime: {
                    required: "Please select open time."
                },
                eclosetime: {
                    required: "Please select close time."
                },
                es_registerdate: {
                    required: "Please select the registration date."
                },

            },
            });


            $('#es_name, #es_ownername').on('input', function() {
            var value = $(this).val();
            value = value.replace(/[^A-Za-z\s\.]+/, '');
            $(this).val(value);
            });

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
                url: '{{ route("AdmsellerUpdate") }}',
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
                    $('#eshopreg-message').text('Shop details successfully updated!').fadeIn();
                    $('#eshopreg-message').addClass('success-message');
                    $('#eimage-preview').empty();
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

            $(document).ready(function(){

                var i = 1;
                var maxRows = 10;
                var j = parseInt($('#cntmedia').val());
                $('#addMoreRowssh').click(function(event){

                    event.preventDefault();
                    if(i < maxRows) {
                    i++;
                    j++;

                    var recRowmm = '<div class="row mb-5" id="added_fieldah'+i+'"><div class="col-md-3 fv-row fv-plugins-icon-container"><select class="form-select form-control form-control-lg" id="mediatype'+i+'" name="mediatype['+j+']"><option selected="">Choose...</option><option value="1">Facebook</option><option value="2">Instagram</option><option value="3">Linked In</option><option value="4">Web site URL</option><option value="5">Youtub Video URL</option></select></div><div class="col-md-9 fv-row fv-plugins-icon-container"><div class="input-group"><input type="text"  id="mediaurl'+i+'" name="mediaurl['+j+']" class="form-control form-control-lg" placeholder="https://"  value="" tabindex="22"  maxlength="60"/><div align="right"><button id="removeRowsh'+i+'" type="button" name="add_fieldss" class="btn btn-danger" onclick="removeRowsh('+i+');" >-</button></div></div></div>';
                    $('#addedRowssh').append(recRowmm);
                    }
                });

                });



            function removeRowdh(rowNum){
                $('#added_fieldemh'+rowNum).remove();
            }
            function removeRowsh(rowNum){
                $('#added_fieldah'+rowNum).remove();
            }




    </script>

