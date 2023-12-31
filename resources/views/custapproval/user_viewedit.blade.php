<form id="UserRegFormEdit" enctype="multipart/form-data" method="POST">
    <input type="hidden" id="useridhid" name="useridhid" value="{{ $alluserdetails->id }}"
        class="form-control form-control-lg" maxlength="50" placeholder="Shop id" required tabindex="1" />
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="form-outline mb-3"><label>User Role</label>
                    <select class="form-select form-control form-control-lg" name="eroleid"
                        aria-label="Default select example" id="eroleid" required tabindex="2" disabled>
                        {{-- <option value="">Select Role</option> --}}
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" @if ($role->id == $alluserdetails->role_id) selected @endif>
                                {{ $role->role_name }}</option>
                        @endforeach
                    </select>
                    <label for="eroleid" class="error"></label>
                </div>

                <div class="form-outline mb-3"><label>Name</label>
                    <input type="text" id="es_name" name="es_name" value="{{ $alluserdetails->name }}"
                        class="form-control form-control-lg" maxlength="50" placeholder="Shop Name" required
                        tabindex="1" disabled />
                    <label for="es_name" class="error"></label>
                </div>
                <div class="form-outline mb-3"><label>Mobile Number</label>
                    <input type="text" id="es_mobno" name="es_mobno" value="{{ $alluserdetails->mobno }}"
                        class="form-control form-control-lg" maxlength="10" placeholder="Mobile No" required
                        tabindex="3" onchange="exstmobno(this.value,'2')" disabled />
                    <label for="es_mobno" class="error"></label>
                    <div id="esmob-message" class="text-center" style="display: none;"></div>
                </div>
                <div class="form-outline mb-3"><label>Email ID</label>
                    <input type="email" id="es_email" name="es_email" value="{{ $alluserdetails->email }}"
                        class="form-control form-control-lg" maxlength="35" placeholder="Email ID" tabindex="4"
                        onchange="exstemilid(this.value,'2')" disabled />
                    <label for="es_email" class="error"></label>
                    <div id="esemil-message" class="text-center" style="display: none;"></div>
                </div>
                <div class="form-outline mb-3"><label>Customer Status</label>
                    <select class="form-select form-control form-control-lg" name="userstatus" id="userstatus" required
                        tabindex="27">
                        <option value="">Select</option>
                        <option value="Y" @if ($alluserdetails->user_status == 'Y') selected @endif>Active</option>
                        <option value="N" @if ($alluserdetails->user_status == 'N') selected @endif>Suspend User
                        </option>



                    </select>
                    <label for="userstatus" class="error"></label>
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
            userstatus: {
                required: true,
            },



        },
        messages: {
            userstatus: {
                digits: "Please select Customer status.",
            },
        },
    });


    $('#UserRegFormEdit').submit(function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            $.ajax({
                url: '{{ route('AdmCustomerEditDetails') }}',
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
