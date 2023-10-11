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
                                <h4 class="page-title">Add Service Sub Category</h4>

                            </div>

                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div> <!--end row-->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('store.servicesubcategory') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Service Category<span class="text-danger">*</span></label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="service_category_name">
                                        <option value="0">Select Service Category</option>
                                        @foreach ($servicecategory as $sc)
                                            <option value="{{ $sc->id }}" {{ old('service_category_name') == $sc->id ? 'selected' : '' }}>{{ $sc->service_category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="addShopType">Service Sub Category Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control mb-3" id="shop_id"
                                        placeholder="Enter service sub category name" name="service_subcategory_name">
                                        @error('service_subcategory_name')
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
