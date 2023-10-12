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
                                <h4 class="page-title">Services</h4>
                            </div><!--end col-->
                            <div class="col-auto align-self-center">
                                <a href="{{ route('add.service') }}" class="btn add_btn">Add Services
                                </a>
                            </div>
                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div><!--end row-->
            <!-- end page title end breadcrumb -->

            <div class="col-md-12">
                <div id="product_approved-message" class="text-center" style="display: none;"></div>
            </div>
            <div class="col-md-12">
                <div id="product_del-message" class="text-center" style="display: none;"></div>
            </div>
            @if (count($services) > 0)
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Approved all<input type='checkbox' name='checkbox1' id='checkbox1'
                                                    onclick='check();' /></th>
                                            <th>No</th>
                                            <th>Services</th>
                                            <th>Attributes</th>
                                            <th>Price</th>
                                            <th>Approved</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($services as $index => $sr)
                                            <tr>
                                                <td><input name="serviceid[]" type="checkbox"
                                                        id="serviceid{{ $index + 1 }}" value="{{ $sr->id }}"
                                                        {{ $sr->is_approved === 'Y' ? 'checked' : '' }} />
                                                </td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $sr->service_name }}</td>
                                                <td>
                                                    @if ($sr->is_attribute === 'Y')
                                                        {{ $sr->attribute_1 }}/{{ $sr->attribute_2 }}/{{ $sr->attribute_3 }}/{{ $sr->attribute_4 }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($sr->is_attribute === 'Y')
                                                        {{ $sr->offer_price }}/{{ $sr->mrp_price }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>

                                                <td>
                                                    <span
                                                        class="badge p-2 {{ $sr->is_approved === 'Y' ? 'badge badge-success' : ($sr->is_approved === 'R' ? 'badge badge-danger' : 'badge badge-warning') }}">
                                                        {{ $sr->is_approved === 'Y' ? 'Approved' : ($sr->is_approved === 'R' ? 'Rejected' : 'Not Approved') }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <div class="btn-group mb-2 mb-md-0">
                                                        <button type="button" class="btn view_btn dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">Action<i
                                                                class="mdi mdi-chevron-down"></i></button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item view_btn1"
                                                                href="{{ route('edit.service', $sr->id) }}">Edit</a>
                                                            @if (session('roleid') == 1)
                                                                <a class="dropdown-item approve_btn"
                                                                    href="{{ route('approve.service', $sr->id) }}">Approved</a>
                                                            @endif
                                                            <a class="dropdown-item delete_btn"
                                                                href="{{ route('delete.service', $sr->id) }}"
                                                                onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button type="button" class="btn btn-success" id="approveAll">Approve All</button>
                                    </div>
                                </div>
                                <input type="hidden" value="{{ $index + 1 }}" id="totalservicecnt">
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            @else
                <table>
                    <tr>
                        <td colspan="13" align="center">
                            <img src="{{ asset('backend/assets/images/notfoundimg.png') }}" alt="notfound"
                                class="rounded-circle" style="width: 30%;" />
                        </td>
                    </tr>
                </table>
            @endif








        </div><!-- container -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $('#approveAll').on('click', function() {
                serviceapprovedall(); 
            });

            function check() {

                if (document.getElementById('checkbox1').checked == true) {
                    for (i = 1; i <= document.getElementById('totalservicecnt').value; i++) {
                        document.getElementById('serviceid' + i).checked = true;
                    }
                } else {
                    for (i = 1; i <= document.getElementById('totalservicecnt').value; i++) {
                        document.getElementById('serviceid' + i).checked = false;
                    }
                }

            }

            function serviceapprovedall() {
                var serviceid = '';
                var totalservicecnt = document.getElementById('totalservicecnt').value;
                for (var i = 1; i <= totalservicecnt; i++) {
                    if (document.getElementById('serviceid' + i).checked) {
                        serviceid = serviceid + '#' + document.getElementById('serviceid' + i).value;
                    }
                }
                if (serviceid == '') {
                    alert('No Services Selected');
                    return false;
                }

                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('ServiceApprovedAll') }}',
                    type: 'POST',
                    data: {
                        serviceid: serviceid
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
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            }, 5000);
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        } else if ((data.result == 2)) {
                            $('#product_approved-message').text(data.mesge).fadeIn();
                            $('#product_approved-message').addClass('error');
                            setTimeout(function() {
                                $('#product_approved-message').fadeOut();
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            }, 5000);
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        } else {
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        }
                    }
                });
            }
        </script>
    @endsection
