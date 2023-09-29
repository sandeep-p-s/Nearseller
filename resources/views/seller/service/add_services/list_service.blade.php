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
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Services</th>
                                        <th>Attributes</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($services as $sr)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sr->service_name }}</td>
                                            <td>
                                                @if ($sr->is_attribute === 'Y')
                                                    {{ $sr->attribute_1 }}/{{ $sr->attribute_2 }}
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
                                                <div class="btn-group mb-2 mb-md-0">
                                                    <button type="button" class="btn view_btn dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">Action<i
                                                            class="mdi mdi-chevron-down"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item view_btn1"
                                                            href="{{ route('edit.service', $sr->id) }}">Edit</a>
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

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div><!-- container -->
    @endsection
