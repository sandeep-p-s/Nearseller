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
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ $errors->first('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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


                            <div class="emailform">
                                <form id="userEmailForm">
                                    <div class="form-outline mb-4">
                                        <input type="email" id="emailid" name="emailid" class="form-control form-control-lg" placeholder="Email"  onchange="checkemilmob(this.value,'3')" required />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="password" id="passwd" name="passwd" class="form-control form-control-lg" placeholder="password" required />
                                    </div>
                                    <p class="small mb-5 pb-lg-2 float-end" id="forget"><a class="" href="#" style="color:#432791;">Forgot password?</a></p>
                                    <div class="pt-1 mb-4 loginform_btn">
                                        <button class="btn btn-info btn-lg btn-block" type="submit">Login</button>
                                    </div>
                                    <div id="errinemaillogn-message"  class="text-center" style="display: none;"></div>
                                    <div id="emailnotapproved-message"  class="text-center" style="display: none;"></div>
                                    <div id="emailnotregister-message"  class="text-center" style="display: none;"></div>
                                </form>
                            </div>



                            <div style="display: none;" id="Login" class="mobileform">
                                <form id="userMobForm">
                                    <div class="form-outline mb-4">

                                        <input type="text" id="logn_mob" name="logn_mob" class="form-control form-control-lg" placeholder="Enter Mobile No"  onchange="checkemilmob(this.value,'1')" required />
                                    </div>
                                    <div id="moblogn-message" class="text-center" style="display: none;"></div>
                                    <div class="pt-1 mb-4 loginform_btn">
                                        <button class="btn btn-info btn-lg btn-block" type="submit">Generate OTP</button>

                                    </div>
                                    <div id="errinmoblogn-message"  class="text-center" style="display: none;"></div>
                                    <div id="usernotapproved-message"  class="text-center" style="display: none;"></div>
                                </form>
                            </div>

                        <div>
                            <p class="text-center" id="signup">Don't have an account? <a href="#" class="" style="color: #452896;">Sign Up</a></p>
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
                                        <input tabindex="2"  type="email" id="u_emid" name="u_emid" class="form-control form-control-lg" maxlength="50" placeholder="Enter Email" required   onchange="exstemilid(this.value,'1')" />
                                        <label for="u_emid" class="error"></label>
                                        <div id="uemil-message"  class="text-center" style="display: none;"></div>
                                    </div>

                                    <div class="form-outline  mb-2">
                                        <input  tabindex="3"  type="text" id="u_mobno" name="u_mobno" class="form-control form-control-lg" maxlength="10" placeholder="Enter Mobile No" required   onchange="exstmobno(this.value,'1')" />
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
                                    <div id="sellerfirst">
                                        <div class="form-outline mb-3">
                                            <input type="text" id="s_name" name="s_name" class="form-control form-control-lg" maxlength="50"  placeholder="Shop Name" required  tabindex="1" />
                                            <label for="s_name" class="error"></label>
                                        </div>
                                        <div class="form-outline mb-3">
                                            <input type="text" id="s_ownername" name="s_ownername" class="form-control form-control-lg"  maxlength="50"   placeholder="Owner Name" required tabindex="2" />
                                            <label for="s_ownername" class="error"></label>
                                        </div>
                                        <div class="form-outline mb-3">
                                            <input type="text" id="s_mobno" name="s_mobno" class="form-control form-control-lg"  maxlength="10"  placeholder="Enter Mobile No" required tabindex="3"  onchange="exstmobno(this.value,'2')" />
                                            <label for="s_mobno" class="error"></label>
                                            <div id="smob-message"  class="text-center" style="display: none;"></div>
                                        </div>
                                        <div class="form-outline mb-3">
                                            <input type="email" id="s_email" name="s_email" class="form-control form-control-lg"  maxlength="35"  placeholder="Enter Email" required tabindex="4"  onchange="exstemilid(this.value,'2')" />
                                            <label for="s_email" class="error"></label>
                                            <div id="semil-message"  class="text-center" style="display: none;"></div>
                                        </div>
                                        <div class="form-outline mb-3">
                                            <input type="text" id="s_refralid" name="s_refralid" class="form-control form-control-lg"  maxlength="50"  placeholder="Referral ID" tabindex="5"/>
                                        </div>
                                        <div class="form-outline mb-3">
                                            <select class="form-select form-control form-control-lg" id="s_busnestype" name="s_busnestype"  required tabindex="6">
                                                <option value="" >Business Type</option><br/>
                                                    @foreach ($business as $busnes)
                                                        <option value="{{ $busnes->id }}">{{ $busnes->business_name }}</option>
                                                    @endforeach
                                            </select>
                                            <label for="s_busnestype" class="error"></label>
                                        </div>
                                        <div class="form-outline mb-3">
                                            <select class="form-select form-control form-control-lg" id="s_shopservice" name="s_shopservice" required tabindex="7">
                                                <option value="">Shop/Service Type</option><br/>
                                                <option value="1">test 1</option><br/>
                                                <option value="2">test 2</option>
                                            </select>
                                            <label for="s_shopservice" class="error"></label>
                                        </div>
                                        <div class="form-outline mb-3">
                                            <select class="form-select form-control form-control-lg" id="s_shopexectename" name="s_shopexectename" required tabindex="8" >
                                                <option value="">Shop Adding Executive Name</option><br/>
                                                    @foreach ($executives as $exec)
                                                        <option value="{{ $exec->id }}">{{ $exec->executive_name }}</option>
                                                    @endforeach
                                            </select>
                                            <label for="s_shopexectename" class="error"></label>
                                        </div>
                                        <p class="small mb-3 pb-lg-2 float-end" id="login_form_shopfirst">Already have an account?<a href="#" style="color:#432791;">Sign in</a></p>
                                        <div class="pt-1 mb-4 loginform_btn">
                                            <button class="btn btn-primary loginform_btn" type="button" id="sellerSecondPage"  tabindex="9">Continue</button>
                                        </div>
                                    </div>





                                    <div id="sellersecond" style="display: none;">

                                        <div class="form-outline mb-3">
                                            <input type="text" id="s_lisence" name="s_lisence" class="form-control form-control-lg"  maxlength="25"  placeholder="License Number" required  tabindex="10"/>
                                            <label for="s_lisence" class="error"></label>
                                        </div>
                                        <div class="form-outline mb-3">
                                            <input type="text" id="s_buldingorhouseno" name="s_buldingorhouseno"  maxlength="100"  class="form-control form-control-lg" placeholder="Building/House Name & Number" required  tabindex="11" />
                                            <label for="s_buldingorhouseno" class="error"></label>
                                        </div>
                                        <div class="form-outline mb-3">
                                            <input type="text" id="s_locality" name="s_locality"  maxlength="100"  class="form-control form-control-lg"placeholder="Locality" required  tabindex="12" />
                                            <label for="s_locality" class="error"></label>
                                        </div>
                                        <div class="form-outline mb-3">
                                            <input type="text" id="s_villagetown" name="s_villagetown"  maxlength="100"  class="form-control form-control-lg" placeholder="Village/Town/Municipality" required  tabindex="13" />
                                            <label for="s_villagetown" class="error"></label>
                                        </div>
                                        <div class="form-outline mb-3">
                                            <select class="form-select form-control form-control-lg" name="country"  aria-label="Default select example" id="country" required  tabindex="14" >
                                                <option value="">Select country</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                                    @endforeach
                                            </select>
                                            <label for="country" class="error"></label>
                                        </div>
                                        <div class="form-outline mb-3">
                                            <select class="form-select form-control form-control-lg" name="state" aria-label="Default select example" id="state" required  tabindex="15">

                                            </select>
                                            <label for="state" class="error"></label>
                                        </div>
                                        <div class="form-outline mb-3">
                                            <select class="form-select form-control form-control-lg" aria-label="Default select example" id="district" name="district" required  tabindex="16">

                                            </select>
                                            <label for="district" class="error"></label>
                                        </div>
                                        <div class="form-outline mb-3">
                                            <input type="text" id="s_pincode" name="s_pincode"  maxlength="6"  class="form-control form-control-lg" placeholder="Pin Code" required  tabindex="17" />
                                            <label for="s_pincode" class="error"></label>
                                        </div>
                                        <div class="form-outline mb-3">
                                            <input type="text" id="s_googlelink" name="s_googlelink"   id class="form-control form-control-lg"   placeholder="Google map link location" required  tabindex="18" />
                                            <label for="s_googlelink" class="error"></label>
                                        </div>
                                        <div class="form-outline mb-3">
                                            <input type="file" id="s_photo" name="s_photo" class="form-control form-control-lg" placeholder="Shop Photo" required tabindex="19" accept="image/jpeg, image/png" />
                                            <label for="s_photo" class="error"></label>
                                        </div>
                                        <div class="image-preview" style="display: none;">
                                            <img id="preview" src="#" alt="Preview" style="max-width: 100px;" />
                                            <button type="button" id="remove-preview" class="btn btn-danger">Remove</button>
                                        </div>



                                        <div class="form-outline mb-3">
                                            <input type="text" id="s_gstno" name="s_gstno"  maxlength="25"  class="form-control form-control-lg" placeholder="GST Number" required   tabindex="20" />
                                            <label for="s_gstno" class="error"></label>
                                        </div>
                                        <div class="form-outline mb-3">
                                            <input type="text" id="s_panno" name="s_panno"  maxlength="12"  class="form-control form-control-lg" placeholder="PAN Number" required  tabindex="21" />
                                            <label for="s_panno" class="error"></label>
                                        </div>


                                        <div class="form-outline mb-3">
                                            <input type="date" id="s_establishdate" name="s_establishdate"  maxlength="10"  class="form-control form-control-lg" placeholder="Establishment date"  tabindex="22" />
                                            <label for="s_establishdate" class="error"></label>
                                        </div>


                                        <div class="form-outline  mb-2">
                                            <input  tabindex="23" type="password" id="s_paswd" name="s_paswd"  maxlength="10"  class="form-control form-control-lg" maxlength="10" placeholder="Enter Password" required />
                                            <label for="s_shopexectename" class="error"></label>
                                            <label for="s_paswd" class="error"></label>
                                        </div>
                                        <div class="form-outline  mb-2">
                                            <input  tabindex="24" type="password" id="s_rpaswd" name="s_rpaswd"  maxlength="10"  class="form-control form-control-lg" maxlength="10" placeholder="Re-Enter password" required />
                                            <label for="s_rpaswd" class="error"></label>
                                        </div>


                                        <div class="checkbox form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="s_termcondtn" name="s_termcondtn" value="1" required tabindex="25" >
                                            <label class="s_termcondtn" for="inlineCheckbox1"> Accept Terms & Conditions </label>
                                        </div>

                                        <p class="small mb-3 pb-lg-2 float-end" id="login_form_shopsecond">Already have an account?<a href="#" style="color:#432791;">Sign in</a></p>

                                        <div class="pt-1 mb-4 loginform_btn btn-group">
                                             <button class="btn btn-info btn-lg btn-block" type="button"  id="sellerFirstPage"  tabindex="26" >Back</button>&nbsp;&nbsp;&nbsp;&nbsp;
                                             <button class="btn btn-primary loginform_btn mb-2" type="submit"  tabindex="27"  >Submit</button>
                                        </div>



                                    </div>

                                </form>
                            </div>



                            <div id="affiliatereg" style="display: none;">
                                <form id="AffiliateRegForm">

                                    <div class="form-outline mb-3">
                                        <input type="text" id="" class="form-control form-control-lg" placeholder="Name" />
                                    </div>
                                    <div class="form-outline mb-3">
                                        <input type="text" id="" class="form-control form-control-lg"  placeholder="Mobile Number" />
                                    </div>
                                    <div class="form-outline mb-3">
                                        <input type="date" id="" class="form-control form-control-lg" placeholder="Date of birth" />
                                    </div>
                                    <div class="form-outline mb-3">
                                        <input type="email" id="" class="form-control form-control-lg" placeholder="Referral ID" />
                                    </div>

                                    <div class="form-outline mb-3">
                                        <input type="email" id="" class="form-control form-control-lg"  placeholder="Aadhaar Number" />
                                    </div>
                                    <div class="form-outline mb-3">
                                        <input type="email" id="" class="form-control form-control-lg"  placeholder="Locality" />
                                    </div>
                                    <div class="form-outline mb-3">
                                        <select class="form-select form-control form-control-lg"
                                            aria-label="Default select example" id="country">
                                            <option value="Select Country">Select country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="form-outline mb-3">
                                        <select class="form-select form-control form-control-lg"
                                            aria-label="Default select example" id="state">

                                        </select>
                                    </div>
                                    <div class="form-outline mb-3">
                                        <select class="form-select form-control form-control-lg"
                                            aria-label="Default select example" id="district">

                                        </select>
                                    </div>
                                    <div class="form-outline mb-3">
                                        <label class="mb10">Upload aadhaar</label>
                                        <input type="file" id="" class="form-control form-control-lg" placeholder="Upload Aadhaar (front & back)" />
                                    </div>

                                    <div class="checkbox form-check-inline">
                                        <input type="checkbox" id="inlineCheckbox1" value="option1">
                                        <label class="terms_text" for="inlineCheckbox1"> Accept Terms & Conditions
                                        </label>
                                    </div>

                                    <p class="small mb-5 pb-lg-2 float-end" id="login_form_afiliate">Already have an account?<a href="#" style="color:#432791;">Sign in</a></p>
                                    <div class="pt-1 mb-4 loginform_btn">
                                        <button class="btn btn-info btn-lg btn-block" type="submit">Sign Up</button>
                                    </div>
                                </form>

                            </div>







                        </div>





                        <div class="Reset_password" style="display: none;" id="password_reset">
                            <h5 class="mb-3 pb-3 mt-5 text-center">Reset Password</h5>
                            <form id="ResetPasswd">
                                <div class="form-outline mb-4">
                                    <input type="text" id="emal_mob" name="emal_mob" class="form-control form-control-lg" placeholder="Enter Email/Mobile No"  onchange="checkemilmob(this.value,'2')" required />
                                </div>
                                <div id="restfirst-message" class="text-center" style="display: none;"></div>
                                <div class="pt-1 mb-4 loginform_btn">
                                    <!-- Button trigger modal -->
                                <button type="submit" class="btn btn-primary loginform_btn">
                                    Continue
                                </button>
                                </div>
                                <div class="pt-1 mb-4 back_btn">
                                    <button class="btn btn-info btn-lg btn-block" type="button" id="back_to_page">Back</button>
                                </div>
                                <div id="notapproved-message" class="text-center" style="display: none;"></div>
                                <div id="notfounddata-message" class="text-center" style="display: none;"></div>

                            </form>
                        </div>


                        <div class="Resetnew_password" style="display: none;" id="passwordnew_reset">
                            <h5 class="mb-3 pb-3 mt-5 text-center">Reset Password</h5>
                            <form id="ResetNewPasswd">
                                <div class="form-outline mb-4">
                                    <input type="hidden" id="sentovalhid" name="sentovalhid" />
                                    <input type="password" id="newpaswd" name="newpaswd" class="form-control form-control-lg" placeholder="Enter New Password" required />
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" id="confirmpaswd" name="confirmpaswd" class="form-control form-control-lg" placeholder="Re-Enter New Password" required />
                                </div>

                                <div class="pt-1 mb-4 loginform_btn">
                                    <!-- Button trigger modal -->
                                <button type="submit" class="btn btn-primary loginform_btn">Submit</button>
                                </div>
                                <div class="pt-1 mb-4 back_btn">
                                    <button class="btn btn-info btn-lg btn-block" type="button" id="back_to_pages">Back</button>
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
                <input type="text" id="firstbox" name="firstbox" tabindex="1" maxlength="1" class="form-control otp-input" autofocus="" required />
                <input type="text" id="secndbox" name="secndbox" tabindex="2" maxlength="1"  class="form-control otp-input" required />
                <input type="text" id="thirdbox" name="thirdbox" tabindex="3" maxlength="1"  class="form-control otp-input" required />
                <input type="text"  id="fourthbox" name="fourthbox" tabindex="4" maxlength="1"  class="form-control otp-input" required />
                <input type="text"  id="fifthbox" name="fifthbox" tabindex="5" maxlength="1"  class="form-control otp-input" required />
                <input type="text"  id="sixtbox" name="sixtbox" tabindex="6" maxlength="1"  class="form-control otp-input" required />
            </div>
            <p class="text-center mt-3 text-secondary" id="timer">Enter OTP within <span id="countdown">00:59</span></p>
            <p class="text-center">If you didn't receive the code <a href="#" style="color: #452896;" id="resendBtn">Resend OTP</a></p>
            <button class="btn btn-primary"  data-bs-dismiss="modal"   id="VerifyBtn" type="button" >Verify</button>
            </div>
            <div id="restpass-message" class="text-center" style="display: none;"></div>
            <div id="resetpassotp-message" class="text-center" style="display: none;"></div>

        </div>
        </div>
    </div>


    <div class="modal fade" id="mobileotpstatic" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mobileOtpLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="btnh-close" data-bs-dismiss="modal" aria-label="Close" ></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="sentootpmobno" name="sentootpmobno" />
            <h5 class="modal-title text-center mb-2" id="mobileOtpLabel">Verify OTP</h5>
            <p class="text-center">The OTP has been send to your mobile number</p>
            <div class="d-flex flex-row mt-3 justify-content-center">
                <input type="text" id="m_firstbox" name="m_firstbox" tabindex="1" maxlength="1" class="form-control otp-inputs" autofocus="" required />
                <input type="text" id="m_secndbox" name="m_secndbox" tabindex="2" maxlength="1" class="form-control otp-inputs" required />
                <input type="text" id="m_thirdbox" name="m_thirdbox" tabindex="3" maxlength="1" class="form-control otp-inputs" required />
                <input type="text"  id="m_fourthbox" name="m_fourthbox" tabindex="4" maxlength="1" class="form-control otp-inputs" required />
                <input type="text"  id="m_fifthbox" name="m_fifthbox" tabindex="5" maxlength="1" class="form-control otp-inputs" required />
                <input type="text"  id="m_sixtbox" name="m_sixtbox" tabindex="6" maxlength="1" class="form-control otp-inputs" required />
            </div>
            <p class="text-center mt-3 text-secondary" id="timer">Enter OTP within <span id="m_countdown">00:59</span></p>
            <p class="text-center">If you didn't receive the code <a href="#" style="color: #452896;" id="m_resendBtnMob">Resend OTP</a></p>
            <a href="#"><button class="btn btn-primary"  data-bs-dismiss="modal"  id="m_VerifyBtn" >Verify</button></a>
            </div>
            <div id="mobotp-message" class="text-center" style="display: none;"></div>
            <div id="otpentered-message" class="text-center" style="display: none;"></div>
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
                $(".Resetnew_password").hide();
            });
            $("#mobile").click(function () {
                $(".login_credentails").show();
                $(".mobileform").show();
                $(".emailform").hide();
                $(".sign_up").hide();
                $(".verify_otp").hide();
                $(".Reset_password").hide();
                $(".Resetnew_password").hide();

            });


            // $("#sellerSecondPage").click(function () {
            //     $("#sellersecond").show();
            //     $("#sellerfirst").hide();
            // });

            $("#sellerFirstPage").click(function () {
                $("#sellersecond").hide();
                $("#sellerfirst").show();
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
                $(".Resetnew_password").hide();
                $("#sellersecond").hide();
                $("#sellerfirst").hide();


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
                $(".Resetnew_password").hide();
                $("#sellersecond").hide();
                $("#sellerfirst").show();


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
                $(".Resetnew_password").hide();
                $("#sellersecond").hide();
                $("#sellerfirst").hide();

            });


            $("#Generate_Otp").click(function () {
                $(".login_credentails").hide();
                $(".mobileform").hide();
                $(".emailform").hide();
                $(".sign_up").hide();
                $(".verify_otp").show();
                $(".Reset_password").hide();
                $(".Resetnew_password").hide();

            });
            $("#signup").click(function () {
                $(".login_credentails").hide();
                $(".emailform").hide();
                $(".mobileform").hide();
                $(".sign_up").show();
                $(".verify_otp").hide();
                $(".Reset_password").hide();
                $(".Resetnew_password").hide();

            });
            $("#login_form").click(function () {
                $(".login_credentails").show();
                $(".emailform").show();
                $(".mobileform").hide();
                $(".sign_up").hide();
                $(".verify_otp").hide();
                $(".Reset_password").hide();
                $(".Resetnew_password").hide();
            });

            $("#login_form_shopfirst").click(function () {
                $(".login_credentails").show();
                $(".emailform").show();
                $(".mobileform").hide();
                $(".sign_up").hide();
                $(".verify_otp").hide();
                $(".Reset_password").hide();
                $(".Resetnew_password").hide();
            });
            $("#login_form_shopsecond").click(function () {
                $(".login_credentails").show();
                $(".emailform").show();
                $(".mobileform").hide();
                $(".sign_up").hide();
                $(".verify_otp").hide();
                $(".Reset_password").hide();
                $(".Resetnew_password").hide();
            });



            $("#login_form_afiliate").click(function () {
                $(".login_credentails").show();
                $(".emailform").show();
                $(".mobileform").hide();
                $(".sign_up").hide();
                $(".verify_otp").hide();
                $(".Reset_password").hide();
                $(".Resetnew_password").hide();
            });


            $("#forget").click(function () {
                $(".login_credentails").hide();
                $(".emailform").hide();
                $(".mobileform").hide();
                $(".sign_up").hide();
                $(".verify_otp").hide();
                $(".Reset_password").show();
                $(".Resetnew_password").hide();
            });
            $("#back_to_page").click(function () {
                $(".login_credentails").show();
                $(".emailform").show();
                $(".mobileform").hide();
                $(".sign_up").hide();
                $(".verify_otp").hide();
                $(".Reset_password").hide();
                $(".Resetnew_password").hide();
            });
            $("#back_to_pages").click(function () {
                $(".login_credentails").show();
                $(".emailform").show();
                $(".mobileform").hide();
                $(".sign_up").hide();
                $(".verify_otp").hide();
                $(".Reset_password").hide();
                $(".Resetnew_password").hide();
            });
        });

        $(document).ready(function () {
            $('#country').change(function () {
                $('#district').empty();
                var countryId = $(this).val();
                if (countryId) {
                    $.get("/getStates/" + countryId, function (data) {
                        $('#state').empty().append('<option value="">Select State</option>');
                        $.each(data, function (index, state) {
                            $('#state').append('<option value="' + state.id + '">' + state.state_name + '</option>');
                        });
                    });
                }
            });

            $('#state').change(function () {
                var stateId = $(this).val();
                if (stateId) {
                    $.get("/getDistricts/" + stateId, function (data) {
                        $('#district').empty().append('<option value="">Select District</option>');
                        $.each(data, function (index, district) {
                            $('#district').append('<option value="' + district.id + '">' + district.district_name + '</option>');
                        });
                    });
                }
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
                            else if(response.result==5)
                            {
                                $('#notapproved-message').text(mobemailmesge).fadeIn();
                                $('#notapproved-message').addClass('error');
                                setTimeout(function() {
                                $('#notapproved-message').fadeOut();
                                }, 5000);
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

            $('#userMobForm').validate({
                rules: {

                    logn_mob: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 10,
                        pattern: /^(?!0+$)\d+$/
                    },

                },
                messages: {
                    logn_mob: {
                        pattern: "Please enter a valid 10-digit mobile number without leading zeroes."
                    }
                }
            });

            $('#userMobForm').submit(function(e) {
                e.preventDefault();
                if ($(this).valid()) {
                    var formData = $(this).serialize();
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $('#loading-overlay').fadeIn();
                    $('#loading-image').fadeIn();
                    //$('#userRegForm').hide();
                    $.ajax({
                        url: '{{ route("mobotpgenrte") }}',
                        type: 'POST',
                        data: formData,
                        headers: {
                        'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                        var mobotpmessage=response.mesge;
                        var sentovalue=response.sendto;
                        $('#sentootpmobno').val(sentovalue);
                            if(response.result==3)
                            {
                                //$('#restpass-message').text('OTP Successfully sent your registered mobile number.').fadeIn();
                                $('#mobotp-message').text(mobotpmessage).fadeIn();
                                $('#mobotp-message').addClass('success-message');
                                setTimeout(function() {
                                $('#mobotp-message').fadeOut();
                                }, 10000);
                                $('#loading-image').fadeOut();
                                $('#loading-overlay').fadeOut();
                                $('#mobileotpstatic').modal('show');

                            }
                            else if(response.result==5)
                            {
                                //$('#restpass-message').text('OTP Successfully sent your registered mobile number.').fadeIn();
                                $('#usernotapproved-message').text(mobotpmessage).fadeIn();
                                $('#usernotapproved-message').addClass('error');
                                setTimeout(function() {
                                $('#usernotapproved-message').fadeOut();
                                }, 10000);
                                $('#loading-image').fadeOut();
                                $('#loading-overlay').fadeOut();

                            }

                            else if(response.result==2)
                            {
                                $('#mobotp-message').text('Error in Data.').fadeIn();
                                $('#mobotp-message').addClass('error');
                                setTimeout(function() {
                                $('#mobotp-message').fadeOut();
                                }, 5000);
                                $('#loading-image').fadeOut();
                                $('#loading-overlay').fadeOut();
                                $('#mobileotpstatic').modal('hide');
                            }

                        }

                    });
                }
            });


            $('#userEmailForm').validate({
                rules: {

                    emailid: {
                        required: true,
                        maxlength: 75,
                        email: true
                    },
                    passwd: {
                        required: true,
                        minlength: 6,
                    },

                },
            });

            $('#userEmailForm').submit(function(e) {
                e.preventDefault();
                if ($(this).valid()) {
                    var formData = $(this).serialize();
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $('#loading-overlay').fadeIn();
                    $('#loading-image').fadeIn();
                    //$('#userRegForm').hide();
                    $.ajax({
                        url: '{{ route("EmailLogin") }}',
                        type: 'POST',
                        data: formData,
                        headers: {
                        'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response)
                        {
                            var sentovalue=response.sendto;
                            var msage=response.mesge;
                            var logtype='eml';
                            var passingvalue=sentovalue+'-'+logtype;
                            if(response.result==3)
                                {
                                    $('#errinemaillogn-message').text('Successfully Logged In.').fadeIn();
                                    $('#errinemaillogn-message').addClass('success-message');
                                    setTimeout(function() {
                                    $('#errinemaillogn-message').fadeOut();
                                    }, 5000);
                                    $('#loading-image').fadeOut();
                                    $('#loading-overlay').fadeOut();
                                    var utf8Bytes = unescape(encodeURIComponent(passingvalue));
                                    var mobencode = btoa(utf8Bytes);
                                    var form = document.createElement('form');
                                    form.method = 'post';
                                    form.action = '{{ route("LoggedPage", ["sentoval" => ":sentoval"]) }}'.replace(':sentoval', mobencode);
                                    form.style.display = 'none';
                                    var csrfInput = document.createElement('input');
                                    csrfInput.type = 'hidden';
                                    csrfInput.name = '_token';
                                    csrfInput.value = $('meta[name="csrf-token"]').attr('content');
                                    form.appendChild(csrfInput);
                                    document.body.appendChild(form);
                                    form.submit();


                                }
                                else if(response.result==5){
                                    $('#emailnotapproved-message').text(msage).fadeIn();
                                    $('#emailnotapproved-message').addClass('error');
                                    setTimeout(function() {
                                    $('#emailnotapproved-message').fadeOut();
                                    }, 5000);
                                    $('#loading-image').fadeOut();
                                    $('#loading-overlay').fadeOut();

                                }
                            else{
                                    $('#errinemaillogn-message').text(msage).fadeIn();
                                    $('#errinemaillogn-message').addClass('error');
                                    setTimeout(function() {
                                    $('#errinemaillogn-message').fadeOut();
                                    }, 5000);

                                    $('#loading-image').fadeOut();
                                    $('#loading-overlay').fadeOut();

                                }
                        }

                    });
                }
            });




                $("#SellerRegForm").validate({
                    rules: {
                        s_name: {
                            required: true,
                            pattern: /^[A-Za-z\s\.]+$/,
                        },
                        s_ownername: {
                            required: true,
                            pattern: /^[A-Za-z\s\.]+$/,
                        },
                        s_mobno: {
                            required: true,
                            digits: true,
                            minlength: 10,
                        },
                        s_email: {
                            required: true,
                            email: true,
                        },

                        s_busnestype: {
                            required: true,

                        },
                        s_shopservice: {
                            required: true,

                        },
                        s_shopexectename: {
                            required: true,

                        },
                        s_lisence: {
                            required: true,
                        },
                        s_buldingorhouseno: {
                            required: true,
                        },

                        s_locality: {
                            required: true,
                        },

                        s_villagetown: {
                            required: true,
                        },

                        s_cntry: {
                            required: true,
                            numericOnly: true
                        },
                        s_state: {
                            required: true,

                        },
                        s_district: {
                            required: true,

                        },
                        s_pincode: {
                            required: true,

                        },
                        s_googlelink: {
                            required: true,
                        },
                        s_gstno: {
                            required: true,
                        },
                        s_panno: {
                            required: true,
                        },
                        s_establishdate: {
                            required: true,
                        },
                        s_termcondtn: {
                            required: true,
                        },
                        s_photo: {
                            required: true,
                            extension: 'jpg|jpeg|png',
                        },
                        s_paswd: {
                            required: true,
                            minlength: 6,
                            strongPassword: true
                        },
                        s_rpaswd: {
                            required: true,
                            equalTo: "#s_paswd"
                        },

                    },
                    messages: {
                        s_name: {
                            pattern: "Only characters, spaces, and dots are allowed.",
                        },
                        s_ownername: {
                            pattern: "Only characters, spaces, and dots are allowed.",
                        },
                        s_mobno: {
                            digits: "Please enter a valid mobile number.",
                        },
                        s_email: {
                            email: "Please enter a valid email address.",
                        },
                        s_photo: {
                            extension: "Only JPG and PNG files are allowed.",
                        },
                        s_lisence: {
                            required: "Please enter the license number.",
                            maxlength: "License number must not exceed 25 characters."
                        },
                        s_buldingorhouseno: {
                            required: "Please enter building/house name and number.",
                            maxlength: "Building/house name and number must not exceed 100 characters."
                        },
                        s_locality: {
                            required: "Please enter the locality.",
                            maxlength: "Locality must not exceed 100 characters."
                        },
                        s_villagetown: {
                            required: "Please enter village/town/municipality.",
                            maxlength: "Village/town/municipality must not exceed 100 characters."
                        },
                        country: {
                            required: "Please select a country."
                        },
                        state: {
                            required: "Please select a state."
                        },
                        district: {
                            required: "Please select a district."
                        },
                        s_pincode: {
                            required: "Please enter the pin code.",
                            maxlength: "Pin code must be 6 digits."
                        },
                        s_googlelink: {
                            required: "Please enter the Google map link location."
                        },
                        s_gstno: {
                            required: "Please enter the GST number.",
                            maxlength: "GST number must not exceed 25 characters."
                        },
                        s_panno: {
                            required: "Please enter the PAN number.",
                            maxlength: "PAN number must not exceed 12 characters."
                        },
                        s_establishdate: {
                            required: "Please select the establishment date."
                        },
                        s_termcondtn: {
                            required: "Please accept the terms and conditions."
                        }
                    },
        });

        $("#sellerSecondPage").click(function() {
            if ($("#SellerRegForm").valid()) {
                $("#sellerfirst").hide();
                $("#sellersecond").show();
            }
        });

        $("#sellerFirstPage").click(function() {
            $("#sellersecond").hide();
            $("#sellerfirst").show();
        });





        $("#s_photo").change(function() {
            if (this.files && this.files[0]) {
                readURL(this);
                $(".image-preview").show();
            }
        });

        $("#remove-preview").click(function() {
            $("#s_photo").val("");
            $("#preview").attr("src", "#");
            $(".image-preview").hide();
        });



            $('#SellerRegForm').submit(function(e) {
                e.preventDefault();
                if ($(this).valid()) {
                    var formData = $(this).serialize();
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $('#loading-overlay').fadeIn();
                    $('#loading-image').fadeIn();
                    //$('#userRegForm').hide();
                    $.ajax({
                        url: '{{ route("sellerRegisteration") }}',
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





            $('#s_photo').change(function() {
                var file = this.files[0];
                var fileType = file.type;
                if (fileType !== 'image/jpeg' && fileType !== 'image/png') {
                    alert("Only JPG and PNG files are allowed for photo upload.");
                    $(this).val('');
                } else {
                    // Display a preview of the uploaded image if needed
                }
            });

            $('#s_name, #s_ownername').on('input', function() {
                var value = $(this).val();
                value = value.replace(/[^A-Za-z\s\.]+/, '');
                $(this).val(value);
            });


            $.validator.addMethod("strongPassword", function(value, element) {
                return this.optional(element) || /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}$/.test(value);
            }, "Password must contain at least one letter, one number, and one special character.");



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
                                    $('.otp-input').val('');

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
                                    $('.otp-input').val('');
                                }
                                else if(response.result==2)
                                {
                                    $('#notfounddata-message').text('Error in Data.').fadeIn();
                                    $('#notfounddata-message').addClass('error');
                                    setTimeout(function() {
                                    $('#notfounddata-message').fadeOut();
                                    }, 5000);
                                    // $('#emal_mob').val('');
                                    $('#loading-image').fadeOut();
                                    $('#loading-overlay').fadeOut();
                                    $('.otp-input').val('');
                                }

                        }
                });

            });


        $('#m_resendBtnMob').click(function()
            {
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            var sentoval= $('#sentootpmobno').val();
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
                        if(response.result==3)
                            {
                                //$('#restpass-message').text('OTP Successfully sent your registered mobile number.').fadeIn();
                                $('#mobotp-message').text(mobemailmesge).fadeIn();
                                $('#mobotp-message').addClass('success-message');
                                setTimeout(function() {
                                $('#mobotp-message').fadeOut();
                                }, 10000);
                                // $('#emal_mob').val('');
                                $('#loading-image').fadeOut();
                                $('#loading-overlay').fadeOut();


                            }
                            else if(response.result==2)
                            {
                                $('#mobotp-message').text('Error in Data.').fadeIn();
                                $('#mobotp-message').addClass('error');
                                setTimeout(function() {
                                $('#mobotp-message').fadeOut();
                                }, 5000);
                                // $('#emal_mob').val('');
                                $('#loading-image').fadeOut();
                                $('#loading-overlay').fadeOut();

                            }

                    }
            });

        });



        $('#m_VerifyBtn').click(function()
            {


                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var sentoval= $('#sentootpmobno').val();
                var logtype='mob';
                var passingvalue=sentoval+'-'+logtype;
                var firstbox= $('#m_firstbox').val();
                var secndbox= $('#m_secndbox').val();
                var thirdbox= $('#m_thirdbox').val();
                var fourthbox= $('#m_fourthbox').val();
                var fifthbox= $('#m_fifthbox').val();
                var sixtbox= $('#m_sixtbox').val();
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
                            if(response.result==3)
                                {
                                    $('#errinmoblogn-message').text('Successfully Logged In.').fadeIn();
                                    $('#errinmoblogn-message').addClass('success-message');
                                    setTimeout(function() {
                                    $('#errinmoblogn-message').fadeOut();
                                    }, 5000);
                                    $('#loading-image').fadeOut();
                                    $('#loading-overlay').fadeOut();
                                    var utf8Bytes = unescape(encodeURIComponent(passingvalue)); // Convert to UTF-8 binary
                                    var mobencode = btoa(utf8Bytes);
                                    var form = document.createElement('form');
                                    form.method = 'post';
                                    form.action = '{{ route("LoggedPage", ["sentoval" => ":sentoval"]) }}'.replace(':sentoval', mobencode);
                                    form.style.display = 'none';
                                    var csrfInput = document.createElement('input');
                                    csrfInput.type = 'hidden';
                                    csrfInput.name = '_token';
                                    csrfInput.value = $('meta[name="csrf-token"]').attr('content');
                                    form.appendChild(csrfInput);
                                    document.body.appendChild(form);
                                    form.submit();


                                }
                            else{
                                    $('#errinmoblogn-message').text('Error in Data.').fadeIn();
                                    $('#errinmoblogn-message').addClass('error');
                                    setTimeout(function() {
                                    $('#errinmoblogn-message').fadeOut();
                                    }, 5000);

                                    $('#loading-image').fadeOut();
                                    $('#loading-overlay').fadeOut();

                                }
                        }
                });

        });







    function exstemilid(u_emid,checkval)
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
                        if(data.result==1 && checkval==1)
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
                        else if(data.result==3 && checkval==1)
                        {
                            $('#uemil-message').text('Error in Data').fadeIn();
                            $('#uemil-message').addClass('error');
                            setTimeout(function() {
                            $('#uemil-message').fadeOut();
                            }, 5000);
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }
                        else if(data.result==1 && checkval==2)
                        {
                            $('#semil-message').text('Email ID Already Exists.').fadeIn();
                            $('#semil-message').addClass('error');
                            setTimeout(function() {
                            $('#semil-message').fadeOut();
                            }, 5000);
                            $('#s_email').val('');
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }
                        else if(data.result==3 && checkval==2)
                        {
                            $('#semil-message').text('Error in Data').fadeIn();
                            $('#semil-message').addClass('error');
                            setTimeout(function() {
                            $('#semil-message').fadeOut();
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

    function exstmobno(u_mobno,checkval)
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
                        if(data.result==1 && checkval==1)
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
                        else if(data.result==3 && checkval==1)
                        {
                            $('#umob-message').text('Error in Data').fadeIn();
                            $('#umob-message').addClass('error');
                            setTimeout(function() {
                            $('#umob-message').fadeOut();
                            }, 5000);
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }
                        else if(data.result==1 && checkval==2)
                        {
                            $('#smob-message').text('Mobile Number Already Exists.').fadeIn();
                            $('#smob-message').addClass('error');
                            setTimeout(function() {
                            $('#smob-message').fadeOut();
                            }, 5000);
                            $('#s_mobno').val('');
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }
                        else if(data.result==3 && checkval==2)
                        {
                            $('#smob-message').text('Error in Data').fadeIn();
                            $('#smob-message').addClass('error');
                            setTimeout(function() {
                            $('#smob-message').fadeOut();
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

    function checkemilmob(emailmob,numr)
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
                        if((data.result==1) && (numr==2))
                        {
                            $('#restfirst-message').text('Email ID not registered').fadeIn();
                            $('#restfirst-message').addClass('error');
                            setTimeout(function() {
                            $('#restfirst-message').fadeOut();
                            }, 5000);
                            $("#emal_mob").val('');
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }

                        else if((data.result==1) && (numr==3))
                        {
                            $('#emailnotregister-message').text('Email ID not registered').fadeIn();
                            $('#emailnotregister-message').addClass('error');
                            setTimeout(function() {
                            $('#emailnotregister-message').fadeOut();
                            }, 5000);
                            $("#emailid").val('');
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }
                        else if((data.result==1) && (numr==1))
                        {
                            $('#moblogn-message').text('Mobile number not registered').fadeIn();
                            $('#moblogn-message').addClass('error');
                            setTimeout(function() {
                            $('#moblogn-message').fadeOut();
                            }, 5000);
                            $("#logn_mob").val('');
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

                // $('#staticBackdrop').on('hide.bs.modal', function() {
                //     $('.otp-input').val('');
                //     clearInterval(interval);
                // });

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


            $(document).ready(function() {
                var m_countdown = 120;
                var m_interval;

                $('.otp-inputs').on('input', function(e) {
                    var input = $(this);
                    var val = input.val();
                    val = val.replace(/\D/g, '');
                    input.val(val);

                    var nextInput = input.next('.otp-inputs');
                    var prevInput = input.prev('.otp-inputs');

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

                $('.otp-inputs').on('keydown', function(e) {
                    if (e.which === 8 && $(this).val() === '') { // Backspace key
                        e.preventDefault();
                        var prevInput = $(this).prev('.otp-inputs');
                        if (prevInput.length > 0) {
                            prevInput.focus();
                        }
                    }
                });

                function startTimer() {
                    m_interval = setInterval(function() {
                        m_countdown--;
                        var m_minutes = Math.floor(m_countdown / 60);
                        var m_seconds = m_countdown % 60;
                        var m_formattedTime = (m_minutes < 10 ? '0' : '') + m_minutes + ':' + (m_seconds < 10 ? '0' : '') + m_seconds;

                        $('#m_countdown').text(m_formattedTime);

                        if (m_countdown <= 0) {
                            clearInterval(m_interval);
                            $('#mobileotpstatic').modal('hide'); // Close the modal
                        }
                    }, 1000);
                }

                $('#mobileotpstatic').on('shown.bs.modal', function() {
                    startTimer();
                    $('#m_firstbox').focus();
                });

                // $('#mobileotpstatic').on('hide.bs.modal', function() {
                //     $('.otp-inputs').val('');
                //     clearInterval(m_interval);
                // });

                $('#m_resendBtnMob').click(function() {
                    clearInterval(m_interval);
                    m_countdown = 120;
                    $('#m_countdown').text('00:59');
                    startTimer();
                });

                $('#m_firstbox').on('paste', function(e) {
                    e.preventDefault();
                    var m_pastedValue = e.originalEvent.clipboardData.getData('text');
                    m_distributeOTPValue(m_pastedValue);
                });

                function m_distributeOTPValue(otpValue) {
                    var m_otpArray = otpValue.trim().split('');
                    $('.otp-inputs').each(function(index) {
                        if (m_otpArray[index]) {
                            $(this).val(m_otpArray[index]);
                        }
                    });
                }
            });




            function readURL(input) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#preview").attr("src", e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }




    </script>
    </body>

</html>
