@extends('backendlayout')
@section('content')
    @include('menu')
    @include('topnav')

    <div class="modal fade" id="exampleModalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLogin"
        aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <h6 class="modal-title m-0" id="exampleModalDefaultLogin">New Attribute</h6>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active p-2" id="LogIn_Tab" role="tabpanel">

                                <form method="POST" action="{{ route('store.attribute') }}" id="attributeForm">
                                    @csrf
                                    <div class="form-group">
                                        <label for="addAttribute">Add Attribute</label>
                                        <input type="text" class="form-control mb15  @error('attribute_name') is-invalid @enderror" id="attribute_name"
                                            placeholder="Enter Attribute Name" name="attribute_name">
                                        <label for="attribute_name" class="error"></label><br>
                                        @error('attribute_name')
                                            <div class="text-danger mb15">{{ $message }}</div>
                                        @enderror
                                        <div class="text-danger mb15" id="validationErrors"></div>
                                        <button type="submit" class="btn view_btn" id="submitBtn">Add</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="row">
                            <div class="col">
                                <h4 class="page-title">Attributes List</h4>
                            </div>
                            <div class="col-auto align-self-center">
                                {{-- <a href="{{ route('add.attribute') }}"><button type="button" class="btn add_btn "
                                        data-toggle="modal" data-target="#exampleModalLogin">Add
                                        New Attributes </button></a> --}}
                                <a><button type="button" class="btn add_btn " data-toggle="modal"
                                        data-target="#exampleModalLogin">Add
                                        New Attributes </button></a>
                            </div>
                        </div>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successMessage">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="successMessage">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <span class="badge badge-soft-info p-2">
                                    Total Attributes : {{ $total_attributes }}
                                </span>
                                <span class="badge badge-soft-danger p-2">
                                    Inactive Attributes : {{ $inactive_attributes }}
                                </span>
                            </div>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Attributes Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attributes as $at)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $at->attribute_name }}</td>
                                            <td>
                                                <span
                                                    class="badge  p-2 {{ $at->status === 'Y' ? 'badge badge-success' : 'badge badge-danger' }}">
                                                    {{ $at->status === 'Y' ? 'Active' : 'Inactive' }}
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
                                                            href="{{ route('edit.attribute', $at->id) }}">Edit</a>
                                                        <a class="dropdown-item delete_btn"
                                                            href="{{ route('delete.attribute', $at->id) }}"
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
                </div>
            </div>
        </div>

        @if($errors->has('attribute_name'))
        <script>
        $(function() {
            $('#exampleModalLogin').modal({
                show: true
            });
        });
        </script>
    @endif

        @endsection
