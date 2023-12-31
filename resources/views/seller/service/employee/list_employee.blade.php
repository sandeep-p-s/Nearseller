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
                                <h4 class="page-title">Employees</h4>
                                {{-- <div class="col text-left">
                                    <a href="{{ route('admin.shopapprovalsadd', 2) }}" class="btn btn-danger">Back</a>
                                </div> --}}

                            </div>

                            <div class="col-auto align-self-center">
                                <a href="{{ route('admin.shopapprovalsadd', 2) }}" class="btn btn-danger">Back</a>
                                <a href="{{ route('add.service_employee', $serviceid) }}"><button type="button"
                                        class="btn add_btn ">Add
                                        Employee </button></a>
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
                            @if (count($service_emp) > 0)
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Designation/Skill</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($service_emp as $se)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $se->employee_name }}</td>
                                                <td> {{ $se->designation }}</td>
                                                <td>
                                                    <span
                                                        class="badge p-2  {{ $se->status === 'Y' ? 'badge badge-success' : 'badge badge-danger' }}">
                                                        {{ $se->status === 'Y' ? 'Active' : 'Inactive' }}
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
                                                                href="{{ route('edit.service_employee', $se->id) }}">Edit</a>
                                                            <a class="dropdown-item delete_btn"
                                                                href="{{ route('delete.service_employee', $se->id) }}"
                                                                onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div><!-- container -->

    @endsection
