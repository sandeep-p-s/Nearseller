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
                                <h4 class="page-title">Edit Executive</h4>
                            </div>
                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div> <!--end row-->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('update.executive', $executive->id) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Executive Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control mb-3" id="executive_name"
                                        name="executive_name" placeholder="Enter executive name"
                                        value="{{ $executive->executive_name }}">
                                        @error('business_name')
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Executive Type <span class="text-danger">*</span></label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="executive_type">
                                            <option value="1" @if($executive->executive_type === 1) selected @endif>Sales</option>
                                            <option value="2" @if($executive->executive_type === 2) selected @endif>Service</option>
                                        </select>
                                    </div>
                                    @error('executive_type')
                                    <div class="text-danger mb15">{{ $message }}</div>
                                @enderror
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Status <span class="text-danger">*</span></label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="status">
                                            <option value="Active" @if($executive->status === 'Y') selected @endif>Active</option>
                                            <option value="Inactive" @if($executive->status === 'N') selected @endif>Inactive</option>
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
