@extends('backendlayout')
@section('content')
    @include('menu')
    @include('topnav')

    <!-- Page Content-->
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="row">
                            <div class="col">
                                <h4 class="page-title">Service Offer List</h4>

                            </div>
                            <div class="col-auto align-self-center">
                                <a href="{{ route('add.service_offer') }}"><button type="button" class="btn add_btn ">Add
                                        Service Offer </button></a>
                            </div><!--end col-->


                        </div><!--end row-->
                    </div><!--end page-title-box-->
                    @if (session('success'))
                        <div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div><!--end col-->
            </div><!--end row-->
            <!-- end page title end breadcrumb -->
            <div class="col-md-12">
                <div id="serviceoffer_approved-message" class="text-center" style="display: none;"></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        @if (session('roleid') == 1 || session('roleid') == 11)
                                            {{-- <th data-sortable="false"><input type='checkbox' name='checkbox1' id='checkbox1'
                                                onclick='check();' /></th> --}}
                                            <th width="5px"><input type='checkbox' name='checkbox1' id='checkbox1'
                                                    class="selectAll" onclick='' /></th>
                                        @endif
                                        <th>S.No.</th>
                                        <th>Offer</th>
                                        <th>Active Status</th>
                                        <th>Approval Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalservice_offer = count($service_offer);
                                    @endphp
                                    @if ($service_offer)
                                        @foreach ($service_offer as $index => $se)
                                            <tr>
                                                @if (session('roleid') == 1 || session('roleid') == 11)
                                                    <td width="8%"><input name="serviceofferid[]" type="checkbox"
                                                            id="serviceofferid{{ $loop->iteration }}"
                                                            value="{{ $se->id }}"
                                                            {{ $se->approval_status === 'Y' ? '' : '' }} />
                                                    </td>
                                                @endif
                                                <td width="8%">{{ $loop->iteration }}</td>
                                                <td>{{ $se->offer_to_display }}</td>
                                                <td width="10%">
                                                    <span
                                                        class="badge p-2 {{ $se->status === 'Y' ? 'badge badge-success' : 'badge badge-danger' }}">
                                                        {{ $se->status === 'Y' ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </td>
                                                <td width="10%">
                                                    <span
                                                        class="badge p-2 {{ $se->approval_status === 'Y' ? 'badge badge-success' : 'badge badge-danger' }}">
                                                        {{ $se->approval_status === 'Y' ? 'Approved' : 'Not Approved' }}
                                                    </span>
                                                </td>
                                                <td width="10%">
                                                    <div class="btn-group mb-2 mb-md-0">
                                                        <button type="button" class="btn view_btn dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">Action <i
                                                                class="mdi mdi-chevron-down"></i></button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item view_btn1"
                                                                href="{{ route('edit.service_offer', $se->id) }}">Edit</a>
                                                            <a class="dropdown-item approve_btn"
                                                                href="{{ route('approved.serviceoffer', $se->id) }}">Approved</a>
                                                            <a class="dropdown-item delete_btn"
                                                                href="{{ route('delete.service_offer', $se->id) }}"
                                                                onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan='4' style="text-align: center;">No shop offers found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <input type="hidden" value="{{ $totalservice_offer }}" id="totalservicecnt">
                            @if ($totalservice_offer > 0)
                                <div class="col text-center">
                                    <button class="btn btn-primary" style="cursor:pointer"
                                        onclick="serviceoffer_approvedall();">Approve
                                        All</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div><!-- container -->
        <script>
            $(document).ready(function() {

                $(".selectAll").on("click", function(event) {
                    var isChecked = $(this).is(":checked");
                    $("#datatable tbody input[type='checkbox']").prop("checked", isChecked);
                });
            });

            function check() {
                if (document.getElementById('checkbox1').checked == true) {
                    for (i = 1; i <= document.getElementById('totalservicecnt').value; i++) {
                        document.getElementById('serviceofferid' + i).checked = true;
                    }
                } else {
                    for (i = 1; i <= document.getElementById('totalservicecnt').value; i++) {
                        document.getElementById('serviceofferid' + i).checked = false;
                    }
                }
            }

            function serviceoffer_approvedall() {
            var serviceofferid = '';
            var totalservicecnt = document.getElementById('totalservicecnt').value;
            for (var i = 1; i <= totalservicecnt; i++) {
                var checkbox = document.getElementById('serviceofferid' + i);
                if (checkbox && checkbox.checked) {
                    serviceofferid = serviceofferid + '#' + checkbox.value;
                }
            }
            if (serviceofferid === '') {
                alert('No services Selected');
                return false;
            }

            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{ route('ServiceOfferApprovedAll') }}',
                type: 'POST',
                data: {
                    serviceofferid: serviceofferid
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(data) {
                    if ((data.result == 1)) {
                        $('#serviceoffer_approved-message').text(data.mesge).fadeIn();
                        $('#serviceoffer_approved-message').addClass('success-message');
                        setTimeout(function() {
                            $('#serviceoffer_approved-message').fadeOut();
                        }, 5000);
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        window.location.reload();
                    } else if ((data.result == 2)) {
                        $('#serviceoffer_approved-message').text(data.mesge).fadeIn();
                        $('#serviceoffer_approved-message').addClass('error');
                        setTimeout(function() {
                            $('#serviceoffer_approved-message').fadeOut();
                        }, 5000);
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        window.location.reload();
                    } else {
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        window.location.reload();
                    }
                }
            });
        }
        </script>
    @endsection
