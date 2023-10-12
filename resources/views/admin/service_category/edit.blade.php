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
                                <h4 class="page-title">Edit Shop Type</h4>
                            </div>
                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div> <!--end row-->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('update.servicecategory', $servicecategory->id) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Business Type</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="business_name">
                                        <option value="0">Select Business Type</option>
                                        @foreach ($businesstype as $bt)
                                        <option {{ $bt->id == $servicecategory->business_type_id? 'selected' : '' }} value="{{$bt->id}}">{{$bt->business_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Service Category Name</label>
                                    <input type="text" class="form-control mb-3" id="exampleFormControlInput1"
                                        name="service_category_name" placeholder="Enter Service Category" value="{{ $servicecategory->service_category_name }}">
                                        @error('service_category_name')
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
                                </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Status</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="status">
                                            <option value="select">Select</option>
                                            <option value="Active" @if($servicecategory->status === 'Y') selected @endif>Active</option>
                                            <option value="Inactive" @if($servicecategory->status === 'N') selected @endif>Inactive</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn view_btn">Update</button>

                            </form>
                        </div><!--end card-body-->
                    </div><!--end card-->

                </div> <!--end col-->

            </div><!--end row-->


            <!-- end page title end breadcrumb -->

        </div><!-- container -->
    @endsection
