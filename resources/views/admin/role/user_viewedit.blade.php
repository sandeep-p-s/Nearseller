<form id="UserRegFormEdit" enctype="multipart/form-data" method="POST">
    <input type="hidden" id="useridhid" name="useridhid" value="{{ $alluserdetails->id }}"
        class="form-control form-control-lg" maxlength="50" placeholder="Shop id" required tabindex="1" />
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="form-outline mb-3"><label>User Role</label>
                    <select class="form-select form-control form-control-lg" name="eroleid"
                        aria-label="Default select example" id="eroleid" required tabindex="2">
                        {{-- <option value="">Select Role</option> --}}
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" @if ($role->id == $alluserdetails->role_id) selected @endif>
                                {{ $role->role_name }}</option>
                        @endforeach
                    </select>
                    <div for="eroleid" class="error"></div>
                </div>

                <div class="form-outline mb-3"><label>Name</label>
                    <input type="text" id="es_name" name="es_name" value="{{ $alluserdetails->name }}"
                        class="form-control form-control-lg" maxlength="50" placeholder="Shop Name" required
                        tabindex="1" />
                    <div for="es_name" class="error"></div>
                </div>
                <label>Mobile Number</label>
                <div class="form-outline mb-3 d-flex">
                    <select name="emobcntrycode" id="emobcntrycode" class="form-control" style="width: 19%;" required>
                        <option value="+91">+91</option>
                    </select>
                    <input type="text" id="es_mobno" name="es_mobno" value="{{ $alluserdetails->mobno }}"
                        class="form-control form-control-lg" maxlength="10" placeholder="Mobile No" required
                        tabindex="3" onchange="exstmobno(this.value,'2')" />
                    <div for="es_mobno" class="error"></div>
                    <div id="esmob-message" class="text-center" style="display: none;"></div>
                </div>
                <div class="form-outline mb-3"><label>Email ID</label>
                    <input type="email" id="es_email" name="es_email" value="{{ $alluserdetails->email }}"
                        class="form-control form-control-lg" maxlength="35" placeholder="Email ID" tabindex="4"
                        onchange="exstemilid(this.value,'2')" />
                    <div for="es_email" class="error"></div>
                    <div id="esemil-message" class="text-center" style="display: none;"></div>
                </div>
                <div class="form-outline mb-3"><label>User Status</label>
                    <select class="form-select form-control form-control-lg" name="userstatus" id="userstatus" required
                        tabindex="27">
                        <option value="">Select</option>
                        <option value="Y" @if ($alluserdetails->user_status == 'Y') selected @endif>Active</option>
                        <option value="N" @if ($alluserdetails->user_status == 'N') selected @endif>Inactive
                        </option>

                    </select>
                    <div for="userstatus" class="error"></div>
                </div>




            </div>





            <div class="col-md-12">
                <div style="float:right">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>


            <div class="col-md-12">
                <div id="euserreg-message" class="text-center" style="display: none;"></div>
            </div>
        </div>
    </div>
</form>

<!-- Modal Add new Close -->



<script>
    jQuery.validator.addMethod("validEmail", function(value, element) {
        var emailRegex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
        return this.optional(element) || emailRegex.test(value);
    }, "Invalid e-Mail ID. It should be in the format abcdxxxxxx123@gmail.com");

    $("#UserRegFormEdit").validate({

        rules: {
            es_name: {
                required: true,
                pattern: /^[A-Za-z\s\.]+$/,
            },
            es_mobno: {
                required: true,
                digits: true,
                minlength: 10,
            },
            emobcntrycode: {
                required: true,
            },

            es_email: {
                //required: true,
                email: true,
                validEmail: true,
            },

            eroleid: {
                required: true,
            },
            userstatus: {
                required: true,
            },



        },
        messages: {
            eroleid: {
                required: "Please select role."
            },
            es_name: {
                pattern: "Only characters, spaces, and dots are allowed.",
            },
            es_email: {
                validEmail: "Invalid email format. It should be in the format 29ABCDE1234F1Z5"
            },
            es_mobno: {
                digits: "Please enter a valid mobile number.",
            },
            userstatus: {
                digits: "Please select user status.",
            }

        },
    });


    // $('#es_name').on('input', function() {
    // var value = $(this).val();
    // value = value.replace(/[^A-Za-z\s\.]+/, '');
    // $(this).val(value);
    // });

    $('#UserRegFormEdit').submit(function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            $.ajax({
                url: '{{ route('AdmEditUserDetails') }}',
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
                    $('#euserreg-message').text('User details successfully updated!').fadeIn();
                    $('#euserreg-message').addClass('success-message');
                    setTimeout(function() {
                        $('#euserreg-message').fadeOut();
                    }, 5000); // 5000 milliseconds = 5 seconds
                    $('#UserRegFormEdit')[0].reset();
                    $('#loading-image').fadeOut();
                    $('#loading-overlay').fadeOut();
                    $('#ViewEditModal').modal('hide');
                    shwdets();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    $('#euserreg-message').text('updation failed.').fadeIn();
                    $('#euserreg-message').addClass('error');
                    setTimeout(function() {
                        $('#euserreg-message').fadeOut();
                    }, 5000);
                    $('#loading-image').fadeOut();
                    $('#loading-overlay').fadeOut();
                    $('#ViewEditModal').modal('show');

                }
            });
        }
    });
</script>
