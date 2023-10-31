@extends('backendlayout')
@section('content')
    @include('menu')
    @include('topnav')



    <div class="page-content section_wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="row">
                            <div class="col">
                                <h4 class="page-title">Change Password</h4>
                                {{-- <div class="col text-right">
                                    <button class="btn add_btn" data-bs-toggle="modal" data-bs-target="#addNewModal">Add New User</button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="loading-overlay"></div>
            <img id="loading-image" src="{{ asset('img/loading.gif') }}" style="display: none; width:100px;">

            <div class="row">
                <div class="col-12">
                    <form id="PasswordChangeForm" method="POST">
                        <div class="row card col-md-6 p-4">
                            <div class="col-md-12">
                            </div>
                            <div class="col-md-12">
                                @foreach ($userdetails as $userd)
                                    <div class="form-outline mb-3"><label>Email ID</label>
                                        <input type="email" id="s_email" name="s_email"
                                            class="form-control form-control-lg" maxlength="35" placeholder="Email ID"
                                            required tabindex="1" readonly value="{{ $userd->email }}" />
                                        <div for="s_email" class="error"></div>
                                        <div id="semil-message" class="text-center" style="display: none;"></div>
                                    </div>
                                @endforeach

                                <div class="form-outline mb-3"><label>New password</label>
                                    <input tabindex="4" type="password" id="u_paswd" name="u_paswd"
                                        class="form-control form-control-lg" maxlength="20" placeholder="Enter new password"
                                        required />
                                    <div for="u_paswd" class="error"></div>
                                </div>
                                <div class="form-outline mb-3"><label>Re-enter password</label>
                                    <input tabindex="5" type="password" id="u_rpaswd" name="u_rpaswd"
                                        class="form-control form-control-lg" maxlength="20" placeholder="Re-enter password"
                                        required />
                                    <div for="u_rpaswd" class="error"></div>
                                </div>

                                <div class="text-center"> <button class="btn btn-primary px-5 font-weight-bold" tabindex="6"
                                        type="submit">SUBMIT</button>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="changepass-message" class="text-center" style="display: none;"></div>
                        </div>
                    </form>
                </div>

            </div>


        </div>
    @endsection
