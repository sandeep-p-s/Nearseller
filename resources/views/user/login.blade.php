<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>NearSeller</title>
    <link href="{{ asset('img/favicon.png')}}" rel="shortcut icon"/>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel='stylesheet' type='text/css' media='screen' href='{{ asset('css/bootstrap.css')}}'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;700;800;900&display=swap"
        rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='{{ asset('css/main.css') }}'>
    <link rel='stylesheet' type='text/css' media='screen' href='{{ asset('css/responsive.css') }}'>
</head>
<body>
    <style>
        .error{
            color: red;
        }
        .success-message {
            color: green;
        }
        #loading-image {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
        }
        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Adjust the color and opacity as needed */
            z-index: 9998; /* Place the overlay below the loading image */
            display: none; /* Hide the overlay by default */
        }

    </style>


    <section class="vh-100">
        <div class="container-fluid">
            <div id="loading-overlay"></div>
            <img id="loading-image" src="{{ asset('img/loading.gif') }}"  style="display: none; width:100px;">


            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-6 text-black">
                    <div class="px-5 pt-5 mt-5 login_logo">
                        <a href="#"><img src="{{ asset('img/header_logo.png') }}"></a>
                    </div>


                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->has('error'))
                        <div class="alert alert-danger">
                            {{ $errors->first('error') }}
                        </div>
                    @endif



                    <div class="align-items-center h-custom-2 login_credentails">
                        <h5 class="mb-3 pb-3 mt-5 text-center">Sign in</h5>
                        <fieldset>
                            <div class="radio_class mb-3 ms-3 d-flex justify-content-center gap-3">
                                <div>
                                    <input type="radio" class="radio" name="x" value="y" id="email" checked />
                                    <label for="y">Email</label>
                                </div>
                                <div>
                                    <input type="radio" class="radio" name="x" value="z" id="mobile" />
                                    <label for="z">Mobile</label>
                                </div>
                            </div>
                        </fieldset>

                        <form>
                            <div class="emailform">
                                <div class="form-outline mb-4">
                                    <input type="email" id="emailormob" class="form-control form-control-lg"
                                        placeholder="Email/ Mobile No" />
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" id="passwd" name="passwd" class="form-control form-control-lg"
                                        placeholder="password" />
                                </div>
                                <p class="small mb-5 pb-lg-2 float-end" id="forget"><a class="" href="#"
                                        style="color:#432791;">Forgot password?</a></p>
                                <div class="pt-1 mb-4 loginform_btn">
                                    <button class="btn btn-info btn-lg btn-block" type="button">Login</button>
                                </div>
                            </div>
                        </form>

                        <form>
                            <div style="display: none;" id="Login" class="mobileform">
                                <div class="form-outline mb-4">
                                    <input type="text" id="" class="form-control form-control-lg"
                                        placeholder="Mobile No" />
                                </div>
                                <div class="pt-1 mb-4 loginform_btn">
                                    <button class="btn btn-info btn-lg btn-block" type="button"
                                        id="Generate_Otp">Generate OTP</button>
                                </div>
                            </div>
                        </form>
                        <div>
                            <p class="text-center" id="signup">Don't have an account? <a href="#" class="" style="color: #452896;">Sign Up</a></p>
                        </div>
                    </div>

                    <div class="verify_otp" style="display: none;" id="Vertify-OTP">
                        <h5 class="text-center mt-5">Verify OTP</h5>
                        <p class="text-center">The OTP has been sent to your registered phone number</p>
                        <div class="d-flex flex-row mt-5 justify-content-center">
                            <input type="text" class="form-control" autofocus="" />
                            <input type="text" class="form-control" />
                            <input type="text" class="form-control" />
                            <input type="text" class="form-control" />
                        </div>
                        <p class="text-center mt-3 mt-5 text-secondary">Enter OTP within 00:59</p>
                        <p class="text-center">If you didn't receive the code <a style="color: #452896;">Resend OTP</a>
                        </p>
                        <div class="pt-1 mb-4 loginform_btn">
                            <button class="btn btn-info btn-lg btn-block" type="button">Login</button>
                        </div>
                    </div>


                        <div class="sign_up" style="display:none;">
                            <h5 class="text-center mt-5">Sign Up</h5>

                            <fieldset>
                                <div class="radio_class mb-3 ms-3 d-flex justify-content-center gap-3">
                                    <div>
                                        <input type="radio" class="radio" name="h" value="a" id="userreg_r" checked />
                                        <label for="a">User</label>
                                    </div>

                                    <div>
                                        <input type="radio" class="radio" name="h" value="b" id="sellerreg_r" />
                                        <label for="b">Seller</label>
                                    </div>

                                    <div>
                                        <input type="radio" class="radio" name="h" value="c" id="affiliatereg_r" />
                                        <label for="c">Affiliate</label>
                                    </div>


                                </div>
                            </fieldset>

                            <div id="userreg">
                                <form id="userRegForm">
                                    <div class="form-outline  mb-2">
                                        <input tabindex="1" type="text" id="u_name" name="u_name" class="form-control form-control-lg" maxlength="50" placeholder="Enter Name" required />
                                        <label for="u_name" class="error"></label>
                                    </div>
                                    <div class="form-outline  mb-2">
                                        <input tabindex="2"  type="email" id="u_emid" name="u_emid" class="form-control form-control-lg" maxlength="50" placeholder="Enter Email" required   onchange="exstemilid(this.value)" />
                                        <label for="u_emid" class="error"></label>
                                        <div id="uemil-message"  class="text-center" style="display: none;"></div>
                                    </div>



                                    <div class="form-outline  mb-2">
                                        <input  tabindex="3"  type="text" id="u_mobno" name="u_mobno" class="form-control form-control-lg" maxlength="10" placeholder="Enter Mobile No" required   onchange="exstmobno(this.value)" />
                                        <label for="u_mobno" class="error"></label>
                                        <div id="umob-message"  class="text-center" style="display: none;"></div>
                                    </div>

                                    <div class="form-outline  mb-2">
                                        <input  tabindex="4" type="password" id="u_paswd" name="u_paswd" class="form-control form-control-lg" maxlength="10" placeholder="Enter Password" required />
                                        <label for="u_paswd" class="error"></label>
                                    </div>
                                    <div class="form-outline  mb-2">
                                        <input  tabindex="5" type="password" id="u_rpaswd" name="u_rpaswd" class="form-control form-control-lg" maxlength="10" placeholder="Re-Enter password" required />
                                        <label for="u_rpaswd" class="error"></label>
                                    </div>
                                    <div class="form-outline">
                                        <input type="hidden" id="regval" name="regval" class="form-control form-control-lg" value="1" />
                                    </div>
                                    <p class="small mb-2 pb-lg-2 float-end" id="login_form">Already have an account?<a href="#" style="color:#432791;">Sign in</a></p>
                                    <div class="pt-1 mb-2 loginform_btn">
                                        <button class="btn btn-info btn-lg btn-block"  tabindex="6"  type="submit">Sign Up</button>
                                    </div>
                                    <div class="form-outline  mb-2">
                                        <div id="ureg-message"  class="text-center" style="display: none;"></div>
                                    </div>
                                </form>
                            </div>



                            <div id="sellerreg" style="display: none;">
                                <form id="SellerRegForm">
                                    <div class="form-outline mb-4">
                                        <input type="text" id="s_name" name="s_name" class="form-control form-control-lg" placeholder="Enter Name" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="email" id="s_emid" name="s_emid" class="form-control form-control-lg" placeholder="Enter Email" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="text" id="s_mobno" name="s_mobno" class="form-control form-control-lg" placeholder="Enter Mobile No" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="password" id="s_paswd" name="s_paswd" class="form-control form-control-lg" placeholder="Enter Password" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="password" id="s_rpaswd" name="s_rpaswd" class="form-control form-control-lg" placeholder="Re-Enter password" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="hidden" id="regval" name="regval" class="form-control form-control-lg" value="2" />
                                    </div>
                                    <p class="small mb-5 pb-lg-2 float-end" id="login_form">Already have an account?<a href="#" style="color:#432791;">Sign in</a></p>
                                    <div class="pt-1 mb-4 loginform_btn">
                                        <button class="btn btn-info btn-lg btn-block" type="submit">Sign Up</button>
                                    </div>
                                </form>
                            </div>



                            <div id="affiliatereg" style="display: none;">
                                <form id="AffiliateRegForm">

                                    <div class="form-outline mb-4">
                                        <input type="text" id="a_name" name="a_name" class="form-control form-control-lg" placeholder="Enter Name" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="email" id="a_emid" name="a_emid" class="form-control form-control-lg" placeholder="Enter Email" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="text" id="a_mobno" name="a_mobno" class="form-control form-control-lg" placeholder="Enter Mobile No" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="password" id="a_paswd" name="a_paswd" class="form-control form-control-lg" placeholder="Enter Password" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="password" id="a_rpaswd" name="a_rpaswd" class="form-control form-control-lg" placeholder="Re-Enter password" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="hidden" id="regval" name="regval" class="form-control form-control-lg" value="3" />
                                    </div>
                                </form>
                                <p class="small mb-5 pb-lg-2 float-end" id="login_form">Already have an account?<a href="#" style="color:#432791;">Sign in</a></p>
                                    <div class="pt-1 mb-4 loginform_btn">
                                        <button class="btn btn-info btn-lg btn-block" type="submit">Sign Up</button>
                                    </div>

                            </div>







                        </div>





                        <div class="Reset_password" style="display: none;" id="password_reset">
                            <h5 class="mb-3 pb-3 mt-5 text-center">Reset Password</h5>
                            <form id="ResetPasswd">
                                <div class="form-outline mb-4">
                                    <input type="text" id="emal_mob" name="emal_mob" class="form-control form-control-lg" placeholder="Enter Email/Mobile No"  onchange="checkemilmob(this.value)" />
                                </div>
                                <div class="pt-1 mb-4 loginform_btn">
                                    <!-- Button trigger modal -->
                                <button type="submit" class="btn btn-primary loginform_btn">
                                    Continue
                                </button>
                                </div>
                                <div class="pt-1 mb-4 back_btn">
                                    <button class="btn btn-info btn-lg btn-block" type="button" id="back_to_page">Back</button>
                                </div>

                            </form>
                        </div>


                        <div class="Resetnew_password" style="display: none;" id="passwordnew_reset">
                            <h5 class="mb-3 pb-3 mt-5 text-center">Reset Password</h5>
                            <form id="ResetNewPasswd">
                                <div class="form-outline mb-4">
                                    <input type="hidden" id="sentovalhid" name="sentovalhid" />
                                    <input type="password" id="newpaswd" name="newpaswd" class="form-control form-control-lg" placeholder="Enter New Password" />
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" id="confirmpaswd" name="confirmpaswd" class="form-control form-control-lg" placeholder="Re-Enter New Password" />
                                </div>

                                <div class="pt-1 mb-4 loginform_btn">
                                    <!-- Button trigger modal -->
                                <button type="submit" class="btn btn-primary loginform_btn">Submit</button>
                                </div>
                                <div class="pt-1 mb-4 back_btn">
                                    <button class="btn btn-info btn-lg btn-block" type="button" id="back_to_page">Back</button>
                                </div>
                                <div id="newpasswd-message" class="text-center" style="display: none;"></div>
                            </form>
                        </div>

















                </div>



                <div class="col-lg-7 col-md-6 col-sm-6 px-0 d-none d-sm-block login_banner_img">
                    <div class="login_innerimage">
                        <img src="{{ asset('img/shopping.png') }}">
                        <div class="banner_img_cont">
                            <h2>Near Sellers</h2>
                            <h6>Every purchase will be made with pleasure</h6>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci amet dolor,
                                necessitatibus assumenda odit nobis, beatae quaerat aliquam deserunt fugiat ex aperiam,
                                sint repellendus.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


  <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="sentoval" name="sentoval" />
            <h5 class="modal-title text-center mb-2" id="staticBackdropLabel">Verify OTP</h5>
            <p class="text-center">The OTP has been send to your registered email id</p>
            <div class="d-flex flex-row mt-3 justify-content-center">
                <input type="text" id="firstbox" name="firstbox" tabindex="1" maxlength="1" class="form-control otp-input" autofocus="" />
                <input type="text" id="secndbox" name="secndbox" tabindex="2" maxlength="1" class="form-control otp-input" />
                <input type="text" id="thirdbox" name="thirdbox" tabindex="3" maxlength="1" class="form-control otp-input" />
                <input type="text"  id="fourthbox" name="fourthbox" tabindex="4" maxlength="1" class="form-control otp-input" />
                <input type="text"  id="fifthbox" name="fifthbox" tabindex="5" maxlength="1" class="form-control otp-input" />
                <input type="text"  id="sixtbox" name="sixtbox" tabindex="6" maxlength="1" class="form-control otp-input" />
            </div>
            <p class="text-center mt-3 text-secondary" id="timer">Enter OTP within <span id="countdown">00:59</span></p>
            <p class="text-center">If you didn't receive the code <a href="#" style="color: #452896;" id="resendBtn">Resend OTP</a></p>
            <a href="#"><button class="btn btn-primary"  data-bs-dismiss="modal"  id="VerifyBtn" >Verify</button></a>
            </div>
            <div id="restpass-message" class="text-center" style="display: none;"></div>

        </div>
        </div>
    </div>

    {{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#email").click(function () {
                $(".login_credentails").show();
                $(".emailform").show();
                $(".mobileform").hide();
                $(".sign_up").hide();
                $(".verify_otp").hide();
                $(".Reset_password").hide();
            });
            $("#mobile").click(function () {
                $(".login_credentails").show();
                $(".mobileform").show();
                $(".emailform").hide();
                $(".sign_up").hide();
                $(".verify_otp").hide();
                $(".Reset_password").hide();

            });


            $("#userreg_r").click(function () {
                $(".login_credentails").hide();
                $(".mobileform").hide();
                $(".emailform").hide();
                $(".sign_up").show();
                $(".verify_otp").hide();
                $(".Reset_password").hide();
                $("#userreg").show();
                $("#sellerreg").hide();
                $("#affiliatereg").hide();


            });

            $("#sellerreg_r").click(function () {
                $(".login_credentails").hide();
                $(".mobileform").hide();
                $(".emailform").hide();
                $(".sign_up").show();
                $(".verify_otp").hide();
                $(".Reset_password").hide();
                $("#userreg").hide();
                $("#sellerreg").show();
                $("#affiliatereg").hide();

            });

            $("#affiliatereg_r").click(function () {
                $(".login_credentails").hide();
                $(".mobileform").hide();
                $(".emailform").hide();
                $(".sign_up").show();
                $(".verify_otp").hide();
                $(".Reset_password").hide();
                $("#userreg").hide();
                $("#sellerreg").hide();
                $("#affiliatereg").show();

            });


            $("#Generate_Otp").click(function () {
                $(".login_credentails").hide();
                $(".mobileform").hide();
                $(".emailform").hide();
                $(".sign_up").hide();
                $(".verify_otp").show();
                $(".Reset_password").hide();

            });
            $("#signup").click(function () {
                $(".login_credentails").hide();
                $(".emailform").hide();
                $(".mobileform").hide();
                $(".sign_up").show();
                $(".verify_otp").hide();
                $(".Reset_password").hide();

            });
            $("#login_form").click(function () {
                $(".login_credentails").show();
                $(".emailform").show();
                $(".mobileform").hide();
                $(".sign_up").hide();
                $(".verify_otp").hide();
                $(".Reset_password").hide();
            });
            $("#forget").click(function () {
                $(".login_credentails").hide();
                $(".emailform").hide();
                $(".mobileform").hide();
                $(".sign_up").hide();
                $(".verify_otp").hide();
                $(".Reset_password").show();
            });
            $("#back_to_page").click(function () {
                $(".login_credentails").show();
                $(".emailform").show();
                $(".mobileform").hide();
                $(".sign_up").hide();
                $(".verify_otp").hide();
                $(".Reset_password").hide();
            });
        });




        $(document).ready(function() {
            $('#userRegForm').validate({
                rules: {
                    u_name: {
                        required: true,
                        maxlength: 50,
                        pattern: /^[a-zA-Z\s.]+$/
                    },
                    u_emid: {
                        required: true,
                        maxlength: 75,
                        email: true
                    },
                    u_mobno: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 10,
                        pattern: /^(?!0+$)\d+$/
                    },
                    u_paswd: {
                        required: true,
                        minlength: 6,
                        strongPassword: true
                    },
                    u_rpaswd: {
                        required: true,
                        equalTo: "#u_paswd"
                    }
                },
                messages: {
                    u_name: {
                        pattern: "Only letters, spaces, and dots are allowed."
                    },
                    u_mobno: {
                        pattern: "Please enter a valid 10-digit mobile number without leading zeroes."
                    }
                }
            });

            $.validator.addMethod("strongPassword", function(value, element) {
                return this.optional(element) || /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}$/.test(value);
            }, "Password must contain at least one letter, one number, and one special character.");


            $('#userRegForm').submit(function(e) {
                e.preventDefault();
                if ($(this).valid()) {
                    var formData = $(this).serialize();
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $('#loading-overlay').fadeIn();
                    $('#loading-image').fadeIn();
                    //$('#userRegForm').hide();
                    $.ajax({
                        url: '{{ route("Register") }}',
                        type: 'POST',
                        data: formData,
                        headers: {
                        'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            console.log(response);
                            $('#ureg-message').text('Registration successful. Please verify email and login!').fadeIn();
                            $('#ureg-message').addClass('success-message');
                            setTimeout(function() {
                                $('#ureg-message').fadeOut();
                            }, 5000); // 5000 milliseconds = 5 seconds
                            $("#u_name").val('');
                            $("#u_emid").val('');
                            $("#u_mobno").val('');
                            $("#u_paswd").val('');
                            $("#u_rpaswd").val('');
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                            //$('#userRegForm').show();

                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                            $('#ureg-message').text('Registration failed.').fadeIn();
                            $('#ureg-message').addClass('error');
                            setTimeout(function() {
                                $('#ureg-message').fadeOut();
                            }, 5000); // 5000 milliseconds = 5 seconds
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                            //$('#userRegForm').show();

                        }
                    });
                }
            });


            $('#ResetPasswd').validate({
                rules: {
                    emal_mob: {
                        required: true,
                        maxlength: 75,
                    }
                }
            });
            $('#ResetPasswd').submit(function(e) {
                e.preventDefault();
                if ($(this).valid()) {
                    var formData = $(this).serialize();
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $('#loading-overlay').fadeIn();
                    $('#loading-image').fadeIn();
                    //$('#userRegForm').hide();
                    $.ajax({
                        url: '{{ route("ResetPaswd") }}',
                        type: 'POST',
                        data: formData,
                        headers: {
                        'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                        var mobemailmesge=response.mesge;
                        var sentovalue=response.sendto;
                        $('#sentoval').val(sentovalue);
                            if(response.result==1)
                            {
                                $('#restpass-message').text(mobemailmesge).fadeIn();
                                $('#restpass-message').addClass('success-message');
                                setTimeout(function() {
                                $('#restpass-message').fadeOut();
                                }, 5000);
                                //$('#emal_mob').val('');
                                $('#loading-image').fadeOut();
                                $('#loading-overlay').fadeOut();
                                $('#staticBackdrop').modal('show');

                            }
                            else if(response.result==3)
                            {
                                //$('#restpass-message').text('OTP Successfully sent your registered mobile number.').fadeIn();
                                $('#restpass-message').text(mobemailmesge).fadeIn();
                                $('#restpass-message').addClass('success-message');
                                setTimeout(function() {
                                $('#restpass-message').fadeOut();
                                }, 10000);
                               // $('#emal_mob').val('');
                                $('#loading-image').fadeOut();
                                $('#loading-overlay').fadeOut();
                                $('#staticBackdrop').modal('show');

                            }
                            else if(response.result==2)
                            {
                                $('#restpass-message').text('Error in Data.').fadeIn();
                                $('#restpass-message').addClass('error');
                                setTimeout(function() {
                                $('#restpass-message').fadeOut();
                                }, 5000);
                               // $('#emal_mob').val('');
                                $('#loading-image').fadeOut();
                                $('#loading-overlay').fadeOut();
                                $('#staticBackdrop').modal('hide');
                            }

                        }

                    });
                }
            });












            $('#ResetNewPasswd').validate({
                rules: {
                    newpaswd: {
                        required: true,
                        minlength: 6,
                        strongPassword: true
                    },
                    confirmpaswd: {
                        required: true,
                        equalTo: "#newpaswd"
                    }
                }
            });
            $('#ResetNewPasswd').submit(function(e) {
                e.preventDefault();
                if ($(this).valid()) {
                    var formData = $(this).serialize();
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $('#loading-overlay').fadeIn();
                    $('#loading-image').fadeIn();
                    //$('#userRegForm').hide();
                    $.ajax({
                        url: '{{ route("newpaswrd") }}',
                        type: 'POST',
                        data: formData,
                        headers: {
                        'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                        var mobemailmesge=response.mesge;
                            if(response.result==1)
                            {
                                $('#restpass-message').text(mobemailmesge).fadeIn();
                                $('#restpass-message').addClass('success-message');
                                setTimeout(function() {
                                $('#restpass-message').fadeOut();
                                }, 10000);
                                $('#loading-image').fadeOut();
                                $('#loading-overlay').fadeOut();
                                window.location.reload();

                            }
                            else if(response.result==3)
                            {
                                $('#restpass-message').text(mobemailmesge).fadeIn();
                                $('#restpass-message').addClass('success-message');
                                setTimeout(function() {
                                $('#restpass-message').fadeOut();
                                }, 10000);
                                $('#loading-image').fadeOut();
                                $('#loading-overlay').fadeOut();
                                window.location.reload();

                            }
                            else if(response.result==2)
                            {
                                $('#restpass-message').text('Error in Data.').fadeIn();
                                $('#restpass-message').addClass('error');
                                setTimeout(function() {
                                $('#restpass-message').fadeOut();
                                }, 10000);
                                $('#loading-image').fadeOut();
                                $('#loading-overlay').fadeOut();
                                window.location.reload();
                            }

                        }

                    });
                }
            });



        });









        $('#resendBtn').click(function()
        {
        $('#loading-overlay').fadeIn();
        $('#loading-image').fadeIn();
        var sentoval= $('#sentoval').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{ route("regenerateotp") }}',
                    type: 'POST',
                    data: {sentoval:sentoval},
                    headers: {
                    'X-CSRF-TOKEN': csrfToken
                    },
            success:function(response)
                {
                    var mobemailmesge=response.mesge;
                    var sentovalue=response.sendto;
                    $('#sentovalhid').val(sentovalue);
                    if(response.result==1)
                        {
                            $('#restpass-message').text(mobemailmesge).fadeIn();
                            $('#restpass-message').addClass('success-message');
                            setTimeout(function() {
                            $('#restpass-message').fadeOut();
                            }, 5000);
                            //$('#emal_mob').val('');
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();


                        }
                        else if(response.result==3)
                        {
                            //$('#restpass-message').text('OTP Successfully sent your registered mobile number.').fadeIn();
                            $('#restpass-message').text(mobemailmesge).fadeIn();
                            $('#restpass-message').addClass('success-message');
                            setTimeout(function() {
                            $('#restpass-message').fadeOut();
                            }, 10000);
                            // $('#emal_mob').val('');
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();


                        }
                        else if(response.result==2)
                        {
                            $('#restpass-message').text('Error in Data.').fadeIn();
                            $('#restpass-message').addClass('error');
                            setTimeout(function() {
                            $('#restpass-message').fadeOut();
                            }, 5000);
                            // $('#emal_mob').val('');
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();

                        }

                }
        });

    });




    $('#VerifyBtn').click(function()
        {
        $('#loading-overlay').fadeIn();
        $('#loading-image').fadeIn();
        var sentoval= $('#sentoval').val();
        var firstbox= $('#firstbox').val();
        var secndbox= $('#secndbox').val();
        var thirdbox= $('#thirdbox').val();
        var fourthbox= $('#fourthbox').val();
        var fifthbox= $('#fifthbox').val();
        var sixtbox= $('#sixtbox').val();

        var otpval=firstbox+''+secndbox+''+thirdbox+''+fourthbox+''+fifthbox+''+sixtbox;

        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{ route("verifyOTP") }}',
                    type: 'POST',
                    data: {sentoval:sentoval,otpval:otpval},
                    headers: {
                    'X-CSRF-TOKEN': csrfToken
                    },
            success:function(response)
                {
                    var mobemailmesge=response.mesge;
                    var sentovalue=response.sendto;
                    $('#sentovalhid').val(sentovalue);
                    if(response.result==1)
                        {
                            $('#newpasswd-message').text(mobemailmesge).fadeIn();
                            $('#newpasswd-message').addClass('success-message');
                            setTimeout(function() {
                            $('#newpasswd-message').fadeOut();
                            }, 5000);
                            //$('#emal_mob').val('');
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                            $('#passwordnew_reset').show();
                            $('#password_reset').hide();

                        }
                        else if(response.result==3)
                        {
                            //$('#restpass-message').text('OTP Successfully sent your registered mobile number.').fadeIn();
                            $('#newpasswd-message').text(mobemailmesge).fadeIn();
                            $('#newpasswd-message').addClass('success-message');
                            setTimeout(function() {
                            $('#newpasswd-message').fadeOut();
                            }, 5000);
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                            $('#passwordnew_reset').show();
                            $('#password_reset').hide();
                        }
                        else if(response.result==2)
                        {
                            $('#newpasswd-message').text('Error in Data.').fadeIn();
                            $('#newpasswd-message').addClass('error');
                            setTimeout(function() {
                            $('#newpasswd-message').fadeOut();
                            }, 5000);
                            // $('#emal_mob').val('');
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }

                }
        });

    });





    function exstemilid(u_emid)
	{
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
			$.ajax({
                url: '{{ route("existemail") }}',
                        type: 'POST',
                        data: {u_emid:u_emid},
                        headers: {
                        'X-CSRF-TOKEN': csrfToken
                        },
                success:function(data)
					{
                        if(data.result==1)
                        {
                            $('#uemil-message').text('Email ID Already Exists.').fadeIn();
                            $('#uemil-message').addClass('error');
                            setTimeout(function() {
                            $('#uemil-message').fadeOut();
                            }, 5000);
                            $('#u_emid').val('');
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }
                        else if(data.result==3)
                        {
                            $('#uemil-message').text('Error in Data').fadeIn();
                            $('#uemil-message').addClass('error');
                            setTimeout(function() {
                            $('#uemil-message').fadeOut();
                            }, 5000);
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }
                        else
                        {
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }
					}
            });

	}

    function exstmobno(u_mobno)
	{
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
			$.ajax({
                url: '{{ route("existmobno") }}',
                        type: 'POST',
                        data: {u_mobno:u_mobno},
                        headers: {
                        'X-CSRF-TOKEN': csrfToken
                        },
                success:function(data)
					{
                        if(data.result==1)
                        {
                            $('#umob-message').text('Mobile Number Already Exists.').fadeIn();
                            $('#umob-message').addClass('error');
                            setTimeout(function() {
                            $('#umob-message').fadeOut();
                            }, 5000);
                            $('#u_mobno').val('');
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }
                        else if(data.result==3)
                        {
                            $('#umob-message').text('Error in Data').fadeIn();
                            $('#umob-message').addClass('error');
                            setTimeout(function() {
                            $('#umob-message').fadeOut();
                            }, 5000);
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }
                        else
                        {
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }
					}
            });

	}

    function checkemilmob(emailmob)
	{
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
			$.ajax({
                url: '{{ route("notregister") }}',
                        type: 'POST',
                        data: {emailmob:emailmob},
                        headers: {
                        'X-CSRF-TOKEN': csrfToken
                        },
                success:function(data)
					{
                        if(data.result==1)
                        {
                            $('#restpass-message').text('Data Not Found').fadeIn();
                            $('#restpass-message').addClass('error');
                            setTimeout(function() {
                            $('#restpass-message').fadeOut();
                            }, 5000);
                            $("#emal_mob").val('');
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }
                        else
                        {
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }
					}
            });

	}




    $(document).ready(function() {
        var countdown = 120;
        var interval;

        $('.otp-input').on('input', function(e) {
            var input = $(this);
            var val = input.val();
            val = val.replace(/\D/g, '');
            input.val(val);

            var nextInput = input.next('.otp-input');
            var prevInput = input.prev('.otp-input');

            if (val.length > 0) {
                if (nextInput.length > 0) {
                    nextInput.focus();
                }
            } else {
                if (prevInput.length > 0) {
                    prevInput.focus();
                }
            }
        });

        $('.otp-input').on('keydown', function(e) {
            if (e.which === 8 && $(this).val() === '') { // Backspace key
                e.preventDefault();
                var prevInput = $(this).prev('.otp-input');
                if (prevInput.length > 0) {
                    prevInput.focus();
                }
            }
        });

        function startTimer() {
            interval = setInterval(function() {
                countdown--;
                var minutes = Math.floor(countdown / 60);
                var seconds = countdown % 60;
                var formattedTime = (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;

                $('#countdown').text(formattedTime);

                if (countdown <= 0) {
                    clearInterval(interval);
                    $('#staticBackdrop').modal('hide'); // Close the modal
                }
            }, 1000);
        }

        $('#staticBackdrop').on('shown.bs.modal', function() {
            startTimer();
            $('#firstbox').focus();
        });

        $('#staticBackdrop').on('hide.bs.modal', function() {
            $('.otp-input').val('');
            clearInterval(interval);
        });

        $('#resendBtn').click(function() {
            clearInterval(interval);
            countdown = 120;
            $('#countdown').text('00:59');
            startTimer();
        });

        $('#firstbox').on('paste', function(e) {
            e.preventDefault();
            var pastedValue = e.originalEvent.clipboardData.getData('text');
            distributeOTPValue(pastedValue);
        });

        function distributeOTPValue(otpValue) {
            var otpArray = otpValue.trim().split('');
            $('.otp-input').each(function(index) {
                if (otpArray[index]) {
                    $(this).val(otpArray[index]);
                }
            });
        }
    });















    </script>
    </body>

</html>
