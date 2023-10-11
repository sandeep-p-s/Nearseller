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
                                <h4 class="page-title">Service Category</h4>

                            </div>
                            <div class="col-auto align-self-center">
                                <a href="{{ route('add.servicecategory') }}"><button type="button" class="btn add_btn ">Add
                                    Service Category </button></a>
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
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="text-center">
                                <span class="badge badge-soft-info p-2">
                                    Total Service Categories : {{ $total_servicecategories }}
                                </span>
                                <span class="badge badge-soft-danger p-2">
                                    Inactive Service Categories : {{ $inactive_servicecategories }}
                                </span>
                            </div>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Service Category</th>
                                        <th>Business Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($servicecategory as $sc)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sc->service_category_name }}</td>
                                            <td>
                                                <span class="badge p-2 {{ $sc->business_name === 'Sales' ? 'badge-success' : 'badge-danger' }}">
                                                    {{ $sc->business_name }}
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
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div><!-- container -->
    @endsection
