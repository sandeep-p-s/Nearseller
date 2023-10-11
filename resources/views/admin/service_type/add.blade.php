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
                                <h4 class="page-title">Add Service Type</h4>

                            </div>

                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div> <!--end row-->


            <div class="row">



                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('store.service_type') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Business Type<span class="text-danger">*</span></label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="business_name">
                                        <option value="0">Select Business Type</option>
                                        @foreach ($businesstype as $bt)
                                            <option value="{{ $bt->id }}" {{ old('business_name') == $bt->id ? 'selected' : '' }}>{{ $bt->business_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="addShopType">Add Service Type<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control mb-3" id="service_name"
                                        placeholder="Enter service type" name="service_name" required>
                                        @error('service_name')
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
                                    <button type="submit" class="btn view_btn">Add</button>
                                </div>
                            </form>
                        </div><!--end card-body-->
                    </div><!--end card-->

                </div> <!--end col-->

            </div><!--end row-->


            <!-- end page title end breadcrumb -->

        </div><!-- container -->
    @endsection
