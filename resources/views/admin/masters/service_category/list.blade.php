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
                                <h4 class="page-title">Business Category</h4>

                            </div>
                            <div class="col-auto align-self-center">
                                <a href="{{ route('add.servicecategory') }}"><button type="button" class="btn add_btn ">Add
                                    Business Category </button></a>
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
            <style>
                tfoot {
                    display: table-caption;
                }

                tfoot input {
                    width: 100%;
                    padding: 3px;
                    box-sizing: border-box;
                }
            </style>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            {{-- <div class="text-center">
                                <span class="badge badge-soft-info p-2">
                                    Total Service Categories : {{ $total_servicecategories }}
                                </span>
                                <span class="badge badge-soft-danger p-2">
                                    Inactive Service Categories : {{ $inactive_servicecategories }}
                                </span>
                            </div> --}}
                            <table id="datatable3" class="table table-bordered table-striped nowrap"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Business Category</th>
                                        <th>Business Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($servicecategory as $sc)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sc->service_category_name }}</td>
                                            <td>
                                                <span class="badge p-2 badge-success">
                                                    {{ $sc->business_name }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge p-2  {{ $sc->status === 'Y' ? 'badge badge-success' : 'badge badge-danger' }}">
                                                    {{ $sc->status === 'Y' ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group mb-2 mb-md-0">
                                                    <button type="button" class="btn view_btn dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">Action <i
                                                            class="mdi mdi-chevron-down"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item view_btn1"
                                                            href="{{ route('edit.servicecategory', $sc->id) }}">Edit</a>
                                                        <a class="dropdown-item delete_btn"
                                                            href="{{ route('delete.servicecategory', $sc->id) }}"
                                                            onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        {{-- @if (session('roleid') == 1 || session('roleid') == 11)
                                        <th style="border: 0px solid #eaf0f7"></th>
                                        @endif --}}
                                        <th style="border: 0px solid #eaf0f7"></th>
                                        <th style="border: 0px solid #eaf0f7">Business Category</th>
                                        <th style="border: 0px solid #eaf0f7">Business Type</th>
                                        <th style="border: 0px solid #eaf0f7"></th>
                                    </tr>
                                </tfoot>

                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div><!-- container -->

        <script>
            $(document).ready(function() {
                var table = $('#datatable3').DataTable({
                    initComplete: function() {
                        this.api()
                            .columns()
                            .every(function() {
                                let column = this;
                                let title = column.footer().textContent;
                                if (title == "")
                                    return;
                                // Create input element
                                let input = document.createElement('input');
                                input.className = "form-control form-control-lg";
                                input.type = "text";
                                input.placeholder = title;
                                column.footer().replaceChildren(input);

                                // Event listener for user input
                                input.addEventListener('keyup', () => {
                                    if (column.search() !== this.value) {
                                        column.search(input.value).draw();
                                    }
                                });
                            });
                    },
                    "columnDefs": [{
                        "targets": 0,
                        "orderable": false
                    }]
                });


            });
        </script>

    @endsection
