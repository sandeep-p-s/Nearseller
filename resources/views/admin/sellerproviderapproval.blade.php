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
                                    <h4 class="page-title">{{ $shoporservice }} Provider Approval List</h4>
                                    {{-- <div class="col text-right">
                                        <button class="btn add_btn" data-bs-toggle="modal" data-bs-target="#addNewModal">Add
                                            New {{ $shoporservice }}</button>
                                    </div> --}}
                                @endif
                            </div>
                        </div>




                    </div>
                </div>
            </div>

            <div id="loading-overlay"></div>
            <img id="loading-image" src="{{ asset('img/loading.gif') }}" style="display: none; width:100px;">
            <input type="hidden" id="typeid" name="typeid" value="{{ $typeid }}" />
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

            <div id="serviceprovider-message" class="text-center" style="display: none;"></div>

            <div class="col-md-12">
                <div id="shop_approved-message" class="text-center" style="display: none;"></div>
            </div>

            <div class="col-md-12">
                <div id="appshopreg-message" class="text-center" style="display: none;"></div>
            </div>



            <div class="modal fade p-5" id="ShopApprovedModal" tabindex="-1" aria-labelledby="ShopApprovedModalLabel"
                aria-hidden="true" style="overflow-y: scroll;">
                <div class="modal-dialog custom-modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="ShopApprovedModalModalLabel">{{ $shoporservice }}
                                Provider Type Approved</h5>
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


        </div>







        <script>
            function shwdets() {
                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var typeid = $("#typeid").val();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('admin.allsellerproviderview') }}',
                    type: 'GET',
                    data: {
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


            function sellerserviceapprovedet(shopid, typeid) {
                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('serviceSeller_Approved') }}',
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
                    alert('Not Selected');
                    return false;
                }

                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('SellerServiceApprovedAll') }}',
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
