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
                                @if (session('roleid') == '1')
                                    <h4 class="page-title">{{ $shoporservice }} Approval List</h4>
                                    <div class="col text-right">
                                        <button class="btn add_btn d-none" data-bs-toggle="modal" data-bs-target="#addNewModal" id="addSellerButton">Add
                                            New {{ $shoporservice }}</button>
                                        {{-- <button class="btn add_btn" data-bs-toggle="modal" data-bs-target="#UploadShopModal">Upload Shops</button> --}}
                                    </div>
                                @endif
                            </div>
                        </div>




                    </div>
                </div>
            </div>

            <div id="loading-overlay"></div>
            <img id="loading-image" src="{{ asset('img/loading.gif') }}" style="display: none; width:100px;">


            <input type="hidden" id="typeid" name="typeid" value="{{ $typeid }}" />

            {{-- @if (session('roleid') == '1')
            <div class="row">
                <div class="col-12">

                    <div class="row">
                        <div class="col-md-3">
                          <input type="text" id="emal_mob" name="emal_mob" class="form-control  form-control-lg" placeholder="Email/Mobile No" onchange="shwdets();" />
                        </div>

                        <div class="col-md-3">

                          <input type="text" id="shopname" name="shopname" class="form-control  form-control-lg" placeholder="{{$shoporservice}} Name" onchange="shwdets();" />
                        </div>

                        <div class="col-md-3">

                            <input type="text" id="ownername" name="ownername" class="form-control  form-control-lg" placeholder="Owner Name" onchange="shwdets();" />
                          </div>


                        <div class="col-md-3">
                          <input type="text" id="referalid" name="referalid" class="form-control  form-control-lg" placeholder="Refferal ID" onchange="shwdets();" />

                        </div>

                        <div class="col-md-12 col-lg-12 d-flex justify-content-center" style="margin-top: 20px;">
                          <input type="button" id="btnsearch" name="btnsearch" class="btn btn-primary" value="Search" onClick="shwdets()" />

                        </div>

                    </div>
                </div>
            </div>
            @endif --}}

            <div class="col-md-12">
                <div id="shop_del-message" class="text-center" style="display: none;"></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div id="catcontent">

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div id="shop_approved-message" class="text-center" style="display: none;"></div>
            </div>

            <div class="col-md-12">
                <div id="appshopreg-message" class="text-center" style="display: none;"></div>
            </div>


            <div class="modal fade p-5" id="ViewEditModal" tabindex="-1" aria-labelledby="ViewEditModalLabel"
                aria-hidden="true" style="overflow-y: scroll;">
                <div class="modal-dialog custom-modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="ViewEditModalLabel">View / Edit - {{ $shoporservice }}
                                Details</h5>
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


            <div class="modal fade p-5" id="ShopApprovedModal" tabindex="-1" aria-labelledby="ShopApprovedModalLabel"
                aria-hidden="true" style="overflow-y: scroll;">
                <div class="modal-dialog custom-modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="ShopApprovedModalModalLabel">{{ $shoporservice }}
                                Approved</h5>
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

            <div class="modal fade p-5" id="deleteConfirmationModal" tabindex="-1" role="dialog"
                aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                title="Close">x</button>
                        </div>
                        <div class="modal-body">
                            Do you want to delete this {{ $shoporservice }}?
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
            $(document).ready(function() {
                var currentPageUrl = window.location.href;
                if (currentPageUrl.includes("/shopapprovals/")) {
                    $("#addSellerButton").addClass("d-none");
                    $(".page-title").text("{{ $shoporservice }} Approval List");
                } else {
                    $("#addSellerButton").removeClass("d-none");
                    $(".page-title").text("{{ $shoporservice }} List");
                }
            });



            function shwdets() {
                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var emal_mob = $("#emal_mob").val();
                var shopname = $("#shopname").val();
                var ownername = $("#ownername").val();
                var referalid = $("#referalid").val();
                var typeid = $("#typeid").val();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('admin.allshopsview') }}',
                    type: 'GET',
                    data: {
                        emal_mob: emal_mob,
                        shopname: shopname,
                        ownername: ownername,
                        referalid: referalid,
                        typeid: typeid,
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

            function checkrefrelno(referalno, numr) {
                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('shopnotregreferal') }}',
                    type: 'POST',
                    data: {
                        referalno: referalno,
                        numr: numr
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(data) {

                        if ((data.result == 1) && (numr == 1)) {
                            $('#s_refralid-message').text('Shop Referral ID Not Found').fadeIn();
                            $('#s_refralid-message').addClass('error');
                            setTimeout(function() {
                                $('#s_refralid-message').fadeOut();
                            }, 5000);
                            $("#s_refralid").val('');
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        } else if ((data.result == 1) && (numr == 2)) {
                            $('#a_refralid-message').text('Affiliate Referral ID Not Found').fadeIn();
                            $('#a_refralid-message').addClass('error');
                            setTimeout(function() {
                                $('#a_refralid-message').fadeOut();
                            }, 5000);
                            $("#a_refralid").val('');
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        } else if ((data.result == 1) && (numr == 3)) {
                            $('#es_refralid-message').text('Shop Referral ID Not Found').fadeIn();
                            $('#es_refralid-message').addClass('error');
                            setTimeout(function() {
                                $('#es_refralid-message').fadeOut();
                            }, 5000);
                            $("#es_refralid").val('');
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        } else {
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }
                    }
                });
            }


            function shopvieweditdet(shopid, typeid) {
                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('shopViewEdit') }}',
                    type: 'POST',
                    data: {
                        shopid: shopid,
                        typeid: typeid
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

            function DeltImagGalry(imgval) {
                var decoded = atob(imgval);
                var values = decoded.split('#');
                var imageSrc = values[0];
                var shopid = values[1];
                $('#loading-image').fadeOut();
                $('#loading-overlay').fadeIn();
                var typeid = $('#typeid').val();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('shopGalryDelte') }}',
                    type: 'POST',
                    data: {
                        imgval: imgval
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(data) {
                        if ((data.result == 1)) {
                            $('#shop_gal-message').text(data.mesge).fadeIn();
                            $('#shop_gal-message').addClass('success-message');
                            setTimeout(function() {
                                $('#shop_gal-message').fadeOut();
                            }, 5000);
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                            shopvieweditdet(shopid, typeid);
                        } else if ((data.result == 2)) {
                            $('#shop_gal-message').text(data.mesge).fadeIn();
                            $('#shop_gal-message').addClass('error');
                            setTimeout(function() {
                                $('#shop_gal-message').fadeOut();
                            }, 5000);
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                            shopvieweditdet(shopid, typeid);
                        } else {
                            $("#showshopeviewedit").html('');
                            $('#ViewEditModal').modal('hide');
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }







                    }
                });

            }


            function shopapprovedet(shopid, typeid) {
                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('shopApproved') }}',
                    type: 'POST',
                    data: {
                        shopid: shopid,
                        typeid: typeid
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


            function shopdeletedet(userid) {

                $('#deleteConfirmationModal').modal('show');
                $('#confirmDeleteBtn').click(function() {
                    $('#deleteConfirmationModal').modal('hide');
                    $('#loading-overlay').fadeIn();
                    $('#loading-image').fadeIn();
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '{{ route('shopDelete') }}',
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




            function exstshopname(u_shop, checkval) {
                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('existshopname') }}',
                    type: 'POST',
                    data: {
                        u_shop: u_shop
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(data) {
                        if (data.result == 1 && checkval == 1) {
                            $('#existshopname-message').text('Shop Name Already Exists.').fadeIn();
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

            function check() {

                if (document.getElementById('checkbox1').checked == true) {
                    for (i = 1; i <= document.getElementById('totalshopcnt').value; i++) {
                        document.getElementById('shopid' + i).checked = true;
                    }
                } else {
                    for (i = 1; i <= document.getElementById('totalshopcnt').value; i++) {
                        document.getElementById('shopid' + i).checked = false;
                    }
                }

            }



            function seller_service_approvedall() {
                var shopid = '';
                var totalshopcnt = document.getElementById('totalshopcnt').value;
                for (var i = 1; i <= totalshopcnt; i++) {
                    var checkbox = document.getElementById('shopid' + i);
                    if (checkbox && checkbox.checked) {
                        shopid = shopid + '#' + checkbox.value;
                    }
                }
                if (shopid === '') {
                    alert('No Shops Selected');
                    return false;
                }

                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('ShopServiceApprovedAll') }}',
                    type: 'POST',
                    data: {
                        shopid: shopid
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(data) {
                        if ((data.result == 1)) {
                            $('#shop_approved-message').text(data.mesge).fadeIn();
                            $('#shop_approved-message').addClass('success-message');
                            setTimeout(function() {
                                $('#shop_approved-message').fadeOut();
                            }, 5000);
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                            shwdets();
                        } else if ((data.result == 2)) {
                            $('#shop_approved-message').text(data.mesge).fadeIn();
                            $('#shop_approved-message').addClass('error');
                            setTimeout(function() {
                                $('#shop_approved-message').fadeOut();
                            }, 5000);
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                            shwdets();
                        } else {
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                            shwdets();
                        }
                    }
                });
            }
        </script>
    @endsection
