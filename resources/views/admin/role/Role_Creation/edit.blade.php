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
                                <h4 class="page-title">Edit Role</h4>
                            </div>
                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div> <!--end row-->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('update.roles', $role->id) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Edit Role</label>
                                    <input type="text" class="form-control mb-3" id="exampleFormControlInput1"
                                        name="role_name" placeholder="Enter role"
                                        value="{{ $role->role_name }}" maxlength="50">
                                        @error('role_name')
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Status</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="status">
                                            <option value="select">Select</option>
                                            <option value="Active" @if($role->is_active === 1) selected @endif>Active</option>
                                            <option value="Inactive" @if($role->is_active === 0) selected @endif>Inactive</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn view_btn">Update</button>
                                </div>
                            </form>
                        </div><!--end card-body-->
                    </div><!--end card-->

                </div> <!--end col-->

            </div><!--end row-->


            <!-- end page title end breadcrumb -->

        </div><!-- container -->
    @endsection
