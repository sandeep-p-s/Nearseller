@if ($allusercount > 0)
    <table id="datatable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>SINO</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Role</th>
                <th>User Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alluserdetails as $index => $userDets)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $userDets->name }}</td>
                    <td>{{ $userDets->email }}</td>
                    <td>{{ $userDets->mobno }}</td>
                    <td>{{ $userDets->role_name }}</td>
                    <td><span
                        class="badge p-2 {{ $userDets->user_status === 'Y' ? 'badge badge-success' : 'badge badge-danger' }}">
                        {{ $userDets->user_status === 'Y' ? 'Active' : 'Inactive' }}
                    </span></td>
                    <td>
                        <div class="btn-group mb-2 mb-md-0">
                            <button type="button" class="btn view_btn dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Action
                                <i class="mdi mdi-chevron-down"></i></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item view_btn1" href="#"
                                    onclick="uservieweditdet({{ $userDets->id }})">View/Edit</a>
                                @if ($userDets->role_id != '1')
                                    <a class="dropdown-item delete_btn" href="#"
                                        onclick="userdeletedet({{ $userDets->id }})">Delete</a>
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
<div class="modal fade" id="addNewModal" tabindex="-1" aria-labelledby="addNewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="addNewModalLabel">Add New Users </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    title="Close">x</button>
            </div>
            <div class="modal-body">


                <form id="UserRegForm" enctype="multipart/form-data" method="POST">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">


                                <div class="form-outline mb-3"><label>User Role</label>
                                    <select class="form-select form-control form-control-lg" name="roleid"
                                        aria-label="Default select example" id="roleid" required tabindex="2">
                                        <option value="">Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="roleid" class="error"></label>
                                </div>

                                <div class="form-outline mb-3"><label>Name <font style="color: #097728;">
                                            (Shop/Service/Customer/Others)</font></label>
                                    <input type="text" id="s_name" name="s_name"
                                        class="form-control form-control-lg" maxlength="50" placeholder="Name" required
                                        tabindex="2"  onchange="exstshopname(this.value,'1');" />
                                    <label for="s_name" class="error"></label>
                                    <div id="existshopname-message" class="text-center" style="display: none;"></div>
                                </div>
                                <div class="form-outline mb-3"><label>Mobile Number</label>
                                    <input type="text" id="s_mobno" name="s_mobno"
                                        class="form-control form-control-lg" oninput="numberOnlyAllowed(this)"
                                        maxlength="10" placeholder="Mobile No" required tabindex="3"
                                        onchange="exstmobno(this.value,'2')" />
                                    <label for="s_mobno" class="error"></label>
                                    <div id="smob-message" class="text-center" style="display: none;"></div>
                                </div>
                                <div class="form-outline mb-3"><label>Email ID</label>
                                    <input type="email" id="s_email" name="s_email"
                                        class="form-control form-control-lg" maxlength="35" placeholder="Email ID"
                                        tabindex="4" onchange="exstemilid(this.value,'2')" />
                                    <label for="s_email" class="error"></label>
                                    <div id="semil-message" class="text-center" style="display: none;"></div>
                                    <span id="emailid-error" style="color: red;"></span>
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
                                <div id="userreg-message" class="text-center" style="display: none;"></div>
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

    $(document).ready(function() {
        $('#resetButton').click(function() {
            $('#UserRegForm input, #UserRegForm select').val('');
            $('#UserRegForm .error').text('');
        });
    });
    function numberOnlyAllowed(inputElement) {
        let value = inputElement.value.replace(/\D/g, '');
        if (value.length > 10) {
            value = value.slice(0, 10);
        }
        inputElement.value = value;
    }



    jQuery.validator.addMethod("validEmail", function(value, element) {
        var emailRegex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
        return this.optional(element) || emailRegex.test(value);
    }, "Invalid e-Mail ID. It should be in the format abcdxxxxxx123@gmail.com");


    $("#UserRegForm").validate({

        rules: {
            s_name: {
                required: true,
                pattern: /^[A-Za-z\s\.]+$/,
            },
            s_mobno: {
                required: true,
                digits: true,
                minlength: 10,
            },
            s_email: {
                //required: true,
                email: true,
                validEmail: true,
            },

            roleid: {
                required: true,
            },



        },
        messages: {
            roleid: {
                required: "Please select role."
            },
            s_name: {
                pattern: "Only characters, spaces, and dots are allowed.",
            },
            s_email: {
                validEmail: "Invalid email format. It should be in the format abcdxxxxxx123@gmail.com"
            },
            s_mobno: {
                digits: "Please enter a valid mobile number.",
            }

        },
    });


    // $('#s_name').on('input', function() {
    // var value = $(this).val();
    // value = value.replace(/[^A-Za-z\s\.]+/, '');
    // $(this).val(value);
    // });




    $('#UserRegForm').submit(function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            $.ajax({
                url: '{{ route('AdmUserCreate') }}',
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
                    $('#userreg-message').text(
                        'User creation successful. Please verify email and login!').fadeIn();
                    $('#userreg-message').addClass('success-message');
                    setTimeout(function() {
                        $('#userreg-message').fadeOut();
                    }, 5000); // 5000 milliseconds = 5 seconds
                    $('#UserRegForm')[0].reset();
                    $('#loading-image').fadeOut();
                    $('#loading-overlay').fadeOut();
                    $('#addNewModal').modal('hide');
                    shwdets();


                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    $('#userreg-message').text('Registration failed.').fadeIn();
                    $('#userreg-message').addClass('error');
                    setTimeout(function() {
                        $('#userreg-message').fadeOut();
                    }, 5000);
                    $('#loading-image').fadeOut();
                    $('#loading-overlay').fadeOut();
                    $('#addNewModal').modal('show');

                }
            });
        }
    });
</script>
