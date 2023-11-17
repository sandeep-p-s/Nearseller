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
                                {{-- @if (session('roleid') == '1') --}}
                                <h4 class="page-title">All Product List</h4>
                                <div class="col text-right">
                                    <button class="btn add_btn d-none" data-bs-toggle="modal" data-bs-target="#addNewModal"
                                        id="addProductButton">Add
                                        New Product</button>
                                </div>
                                {{-- @endif --}}
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
                            <div class="col-md-4">
                                <input type="text" id="prodname" name="prodname" class="form-control  form-control-lg"
                                    placeholder="Product Name" onchange="shwdets();" />
                            </div>

                            <div class="col-md-4">
                                <input type="text" id="shopid" name="shopid" class="form-control  form-control-lg"
                                    placeholder="Shop Name" onchange="shwdets();" />
                            </div>



                            <div class="col-md-4" style="display: none;">

                            </div>


                            <div class="col-md-12 col-lg-12 d-flex justify-content-center" style="margin-top: 20px;">
                                <input type="button" id="btnsearch" name="btnsearch" class="btn btn-primary" value="Search"
                                    onClick="shwdets()" />

                            </div>

                        </div>

                    </div>
                </div>
            @endif --}}



            <div class="col-md-12">
                <div id="product_approved-message" class="text-center" style="display: none;"></div>
            </div>
            <div class="col-md-12">
                <div id="product_del-message" class="text-center" style="display: none;"></div>
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

            <div class="modal fade p-5" id="ViewEditModal" tabindex="-1" aria-labelledby="ViewEditModalLabel"
                aria-hidden="true" style="overflow-y: scroll;">
                <div class="modal-dialog custom-modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="ViewEditModalLabel">View / Edit Product Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                title="Close">x</button>
                        </div>
                        <div class="modal-body">
                            <div id="showproductviewedit">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade p-5" id="ProductApprovedModal" tabindex="-1" aria-labelledby="ProductApprovedModalLabel"
                aria-hidden="true" style="overflow-y: scroll;">
                <div class="modal-dialog custom-modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="ProductApprovedModalLabel">Product Approved</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                title="Close">x</button>
                        </div>
                        <div class="modal-body">
                            <div id="showproductapproved">

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
                            Do you want to delete this product?
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
                var currentPagePath = window.location.pathname;
                if (currentPagePath === "/listshopproduct") {
                    $("#addProductButton").addClass("d-none");
                    $(".page-title").text("Product Approval List");
                } else {
                    $("#addProductButton").removeClass("d-none");
                    $(".page-title").text("Product List");

                }
            });



            function shwdets() {
                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var prodname = $("#prodname").val();
                var atribute = $("#atribute").val();
                var shopid = $("#shopid").val();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('product.allproductview') }}',
                    type: 'POST',
                    data: {
                        prodname: prodname,
                        atribute: atribute,
                        shopid: shopid,
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



            function check() {

                if (document.getElementById('checkbox1').checked == true) {
                    for (i = 1; i <= document.getElementById('totalproductcnt').value; i++) {
                        document.getElementById('productid' + i).checked = true;
                    }
                } else {
                    for (i = 1; i <= document.getElementById('totalproductcnt').value; i++) {
                        document.getElementById('productid' + i).checked = false;
                    }
                }

            }

            function productapprovedall() {
                var productid = '';
                var totalproductcnt = document.getElementById('totalproductcnt').value;
                for (var i = 1; i <= totalproductcnt; i++) {
                    var checkbox = document.getElementById('productid' + i);
                    if (checkbox && checkbox.checked) {
                        productid = productid + '#' + checkbox.value;
                    }
                }
                if (productid == '') {
                    alert('No Products Selected');
                    return false;
                }

                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('ProductApprovedAll') }}',
                    type: 'POST',
                    data: {
                        productid: productid
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(data) {
                        if ((data.result == 1)) {
                            $('#product_approved-message').text(data.mesge).fadeIn();
                            $('#product_approved-message').addClass('success-message');
                            setTimeout(function() {
                                $('#product_approved-message').fadeOut();
                            }, 5000);
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                            shwdets();
                        } else if ((data.result == 2)) {
                            $('#product_approved-message').text(data.mesge).fadeIn();
                            $('#product_approved-message').addClass('error');
                            setTimeout(function() {
                                $('#product_approved-message').fadeOut();
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


            function productvieweditdet(productid) {
                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('productViewEdit') }}',
                    type: 'POST',
                    data: {
                        productid: productid
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(data) {

                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        var data1 = data.trim();
                        $("#showproductviewedit").html(data1);
                        $('#ViewEditModal').modal('show');

                    }
                });

            }

            function DeltProductImag(imgval) {
                var decoded = atob(imgval);
                var values = decoded.split('#');
                var imageSrc = values[0];
                var productid = values[1];
                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('productValDelte') }}',
                    type: 'POST',
                    data: {
                        imgval: imgval
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(data) {
                        if ((data.result == 1)) {
                            $('#product_gal-message').text(data.mesge).fadeIn();
                            $('#product_gal-message').addClass('success-message');
                            setTimeout(function() {
                                $('#product_gal-message').fadeOut();
                            }, 5000);
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                            productvieweditdet(productid);
                        } else if ((data.result == 2)) {
                            $('#product_gal-message').text(data.mesge).fadeIn();
                            $('#product_gal-message').addClass('error');
                            setTimeout(function() {
                                $('#product_gal-message').fadeOut();
                            }, 5000);
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                            productvieweditdet(productid);
                        } else {
                            $("#showproductviewedit").html('');
                            $('#ViewEditModal').modal('hide');
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }
                    }
                });

            }

            function productapprovedet(productid) {
                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('productApproved') }}',
                    type: 'POST',
                    data: {
                        productid: productid
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(data) {

                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        var data1 = data.trim();
                        $("#showproductapproved").html(data1);
                        $('#ProductApprovedModal').modal('show');

                    }
                });

            }


            function productdeletedet(productid) {
                $('#deleteConfirmationModal').modal('show');
                $('#confirmDeleteBtn').click(function() {
                    $('#deleteConfirmationModal').modal('hide');
                    $('#loading-overlay').fadeIn();
                    $('#loading-image').fadeIn();
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '{{ route('ProductsDelete') }}',
                        type: 'POST',
                        data: {
                            productid: productid,
                            _token: csrfToken
                        },
                        success: function(data) {
                            if ((data.result == 1)) {
                                $('#product_del-message').text(data.mesge).fadeIn();
                                $('#product_del-message').addClass('success-message');
                                setTimeout(function() {
                                    $('#product_del-message').fadeOut();
                                }, 5000);
                                $('#loading-image').fadeOut();
                                $('#loading-overlay').fadeOut();
                                shwdets();
                            } else if ((data.result == 2)) {
                                $('#product_del-message').text(data.mesge).fadeIn();
                                $('#product_del-message').addClass('error');
                                setTimeout(function() {
                                    $('#product_del-message').fadeOut();
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
