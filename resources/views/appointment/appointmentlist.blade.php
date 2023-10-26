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
                                    <h4 class="page-title">Appointments</h4>
                                    <div class="col text-right">
                                        <button class="btn add_btn" data-bs-toggle="modal" data-bs-target="#addNewModal">Add
                                            New Appointment</button>
                                    </div>
                                {{-- @endif --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="loading-overlay"></div>
            <img id="loading-image" src="{{ asset('img/loading.gif') }}" style="display: none; width:100px;">

                {{-- <div class="row">
                    <div class="col-12">

                        <div class="row">
                            <div class="col-md-4">
                                <select class="selectservicelist form-select form-control form-control-lg"
                                            id="service_name" name="service_name" tabindex="1"  onchange="shwdets();">
                                            <option value="">Select Service Type</option><br />
                                            @foreach ($ServiceDetails as $service)
                                                <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                                            @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <select class="selectservicepoint form-select form-control form-control-lg"
                                id="service_point" name="service_point" tabindex="2"  onchange="shwdets();">
                                <option value="">Select Service Point</option><br />
                                    <option value="1">At Home</option>
                                    <option value="2">At Shop</option>
                               </select>
                            </div>



                            <div class="col-md-4" style="display: none;">

                            </div>


                            <div class="col-md-12 col-lg-12 d-flex justify-content-center" style="margin-top: 20px;">
                                <input type="button" id="btnsearch" name="btnsearch" class="btn btn-primary" value="Search"
                                    onClick="shwdets()" />

                            </div>

                        </div>

                    </div>
                </div> --}}




            <div class="col-md-12">
                <div id="product_approved-message" class="text-center" style="display: none;"></div>
            </div>
            <div class="col-md-12">
                <div id="appointment_del-message" class="text-center" style="display: none;"></div>
            </div>

            <div id="catcontent">

            </div>

            <div class="modal fade p-5" id="ViewEditModal" tabindex="-1" aria-labelledby="ViewEditModalLabel"
                aria-hidden="true" style="overflow-y: scroll;">
                <div class="modal-dialog custom-modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="ViewEditModalLabel">View / Edit Appointment Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                title="Close">x</button>
                        </div>
                        <div class="modal-body">
                            <div id="showappointmentviewedit">

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
                aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true" >
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

            function shwdets() {
                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var service_name = $("#service_name").val();
                var service_point = $("#service_point").val();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('appointment.listappointmentadd') }}',
                    type: 'POST',
                    data: {
                        service_name: service_name,
                        service_point: service_point,
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
                    if (document.getElementById('productid' + i).checked) {
                        productid = productid + '#' + document.getElementById('productid' + i).value;
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


            function Appointmentvieweditdet(appointmentid) {
                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('AppointmentViewEdit') }}',
                    type: 'POST',
                    data: {
                        appointmentid: appointmentid
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(data) {

                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        var data1 = data.trim();
                        $("#showappointmentviewedit").html(data1);
                        $('#ViewEditModal').modal('show');

                    }
                });

            }

            function Appointmentdeletedet(appointmentid) {
                $('#deleteConfirmationModal').modal('show');
                $('#confirmDeleteBtn').click(function() {
                    $('#deleteConfirmationModal').modal('hide');
                    $('#loading-overlay').fadeIn();
                    $('#loading-image').fadeIn();
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '{{ route('AppointmentDelete') }}',
                        type: 'POST',
                        data: {
                            appointmentid: appointmentid,
                            _token: csrfToken
                        },
                        success: function(data) {
                            if ((data.result == 1)) {
                                $('#appointment_del-message').text(data.mesge).fadeIn();
                                $('#appointment_del-message').addClass('success-message');
                                setTimeout(function() {
                                    $('#appointment_del-message').fadeOut();
                                }, 5000);
                                $('#loading-image').fadeOut();
                                $('#loading-overlay').fadeOut();
                                shwdets();
                            } else if ((data.result == 2)) {
                                $('#appointment_del-message').text(data.mesge).fadeIn();
                                $('#appointment_del-message').addClass('error');
                                setTimeout(function() {
                                    $('#appointment_del-message').fadeOut();
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
