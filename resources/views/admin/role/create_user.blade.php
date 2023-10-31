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

                                <h4 class="page-title">User List</h4>
                                <div class="col text-right">
                                    <button class="btn add_btn" data-bs-toggle="modal" data-bs-target="#addNewModal">Add New
                                        User</button>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div id="loading-overlay"></div>
            <img id="loading-image" src="{{ asset('img/loading.gif') }}" style="display: none; width:100px;">




            {{-- @if (session('roleid') == '1')
            <div class="row">
                <div class="col-12">

                    <div class="row">
                        <div class="col-md-3">
                          <input type="text" id="emal_mob" name="emal_mob" class="form-control  form-control-lg" placeholder="Email/Mobile No" onchange="shwdets();" />
                        </div>

                        <div class="col-md-3">
                          <input type="text" id="uname" name="uname" class="form-control  form-control-lg" placeholder="Name" onchange="shwdets();" />
                        </div>

                        <div class="col-md-12 col-lg-12 d-flex justify-content-center" style="margin-top: 20px;">
                          <input type="button" id="btnsearch" name="btnsearch" class="btn btn-primary" value="Search" onClick="shwdets()" />

                        </div>

                    </div>
                </div>
            </div>
            @endif --}}

            <div id="catcontent">

            </div>


            <div class="modal fade" id="ViewEditModal" tabindex="-1" aria-labelledby="ViewEditModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="ViewEditModalLabel">View / Edit - User Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                title="Close">x</button>
                        </div>
                        <div class="modal-body">
                            <div id="showshopeviewedit">

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="ShopApprovedModal" tabindex="-1" aria-labelledby="ShopApprovedModalLabel"
                aria-hidden="true">
                <div class="modal-dialog custom-modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="ShopApprovedModalModalLabel">User Approved</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                title="Close">x</button>
                        </div>
                        <div class="modal-body">
                            <div id="showshopeapproved">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog"
                aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                title="Close">x</button>
                        </div>
                        <div class="modal-body">
                            Do you want to delete this user?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>







        <script>
            function shwdets() {
                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var emal_mob = $("#emal_mob").val();
                var uname = $("#uname").val();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('user.allusersview') }}',
                    type: 'GET',
                    data: {
                        emal_mob: emal_mob,
                        uname: uname,
                        _token: csrfToken
                    },
                    success: function(data) {
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        setTimeout(() => {
                            $('#datatable').DataTable();
                        }, 0);
                        $('#catcontent').html(data);

                    }
                });
            }

            function exstshopname(u_shop, checkval) {

                var roleidcheck = $("#roleid").val();
                if (roleidcheck == '0' || roleidcheck == '') {
                    alert('Please select user role');
                    $('#s_name').val('');
                    return false;
                } else {
                    $('#loading-overlay').fadeIn();
                    $('#loading-image').fadeIn();
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '{{ route('existnewusercreate') }}',
                        type: 'POST',
                        data: {
                            u_shop: u_shop,
                            roleidcheck: roleidcheck
                        },
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(data) {
                            if (data.result == 1 && checkval == 1) {
                                $('#existshopname-message').text('Name Already Exists.').fadeIn();
                                $('#existshopname-message').addClass('error');
                                setTimeout(function() {
                                    $('#existshopname-message').fadeOut();
                                }, 5000);
                                $('#s_name').val('');
                                $('#loading-image').fadeOut();
                                $('#loading-overlay').fadeOut();
                            } else if (data.result == 3 && checkval == 1) {
                                $('#existshopname-message').text('Error in Data').fadeIn();
                                $('#existshopname-message').addClass('error');
                                setTimeout(function() {
                                    $('#existshopname-message').fadeOut();
                                }, 5000);
                                $('#loading-image').fadeOut();
                                $('#loading-overlay').fadeOut();
                            } else {
                                $('#loading-image').fadeOut();
                                $('#loading-overlay').fadeOut();
                            }
                        }
                    });
                }

            }






            function exstemilid(u_emid, checkval) {
                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('existemail') }}',
                    type: 'POST',
                    data: {
                        u_emid: u_emid
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(data) {
                        if (data.result == 1 && checkval == 2) {
                            $('#semil-message').text('Email ID Already Exists.').fadeIn();
                            $('#semil-message').addClass('error');
                            setTimeout(function() {
                                $('#semil-message').fadeOut();
                            }, 5000);
                            $('#s_email').val('');
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        } else if (data.result == 3 && checkval == 2) {
                            $('#semil-message').text('Error in Data').fadeIn();
                            $('#semil-message').addClass('error');
                            setTimeout(function() {
                                $('#semil-message').fadeOut();
                            }, 5000);
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        } else {
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }
                    }
                });

            }

            function exstmobno(u_mobno, checkval) {
                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('existmobno') }}',
                    type: 'POST',
                    data: {
                        u_mobno: u_mobno
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(data) {
                        if (data.result == 1 && checkval == 2) {
                            $('#smob-message').text('Mobile Number Already Exists.').fadeIn();
                            $('#smob-message').addClass('error');
                            setTimeout(function() {
                                $('#smob-message').fadeOut();
                            }, 5000);
                            $('#s_mobno').val('');
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        } else if (data.result == 3 && checkval == 2) {
                            $('#smob-message').text('Error in Data').fadeIn();
                            $('#smob-message').addClass('error');
                            setTimeout(function() {
                                $('#smob-message').fadeOut();
                            }, 5000);
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        } else {
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }
                    }
                });

            }



            function uservieweditdet(userid) {
                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('UserViewEdit') }}',
                    type: 'POST',
                    data: {
                        userid: userid
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(data) {

                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        var data1 = data.trim();
                        $("#showshopeviewedit").html(data1);
                        $('#ViewEditModal').modal('show');

                    }
                });

            }

            function shopapprovedet(shopid) {
                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('shopApproved') }}',
                    type: 'POST',
                    data: {
                        shopid: shopid
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(data) {

                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        var data1 = data.trim();
                        $("#showshopeapproved").html(data1);
                        $('#ShopApprovedModal').modal('show');

                    }
                });

            }


            function userdeletedet(userid) {

                $('#deleteConfirmationModal').modal('show');
                $('#confirmDeleteBtn').click(function() {
                    $('#deleteConfirmationModal').modal('hide');
                    $('#loading-overlay').fadeIn();
                    $('#loading-image').fadeIn();
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '{{ route('userDelete') }}',
                        type: 'POST',
                        data: {
                            userid: userid,
                            _token: csrfToken
                        },
                        success: function(data) {
                            if ((data.result == 1)) {
                                $('#shop_del-message').text(data.mesge).fadeIn();
                                $('#shop_del-message').addClass('success-message');
                                setTimeout(function() {
                                    $('#shop_del-message').fadeOut();
                                }, 5000);
                                $('#loading-image').fadeOut();
                                $('#loading-overlay').fadeOut();
                                shwdets();
                            } else if ((data.result == 2)) {
                                $('#shop_del-message').text(data.mesge).fadeIn();
                                $('#shop_del-message').addClass('error');
                                setTimeout(function() {
                                    $('#shop_del-message').fadeOut();
                                }, 5000);
                                $('#loading-image').fadeOut();
                                $('#loading-overlay').fadeOut();
                                shwdets();
                            }



                        }
                    });
                });
            }
        </script>
    @endsection
