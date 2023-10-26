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
                                <h4 class="page-title">Add Business Type</h4>

                            </div>

                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div> <!--end row-->


            <div class="row">



                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('store.business_type') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Add Business Type</label>
                                    <input type="text" class="form-control mb-3" id="business_name"
                                        placeholder="Enter business type" name="business_name" value="{{ old('business_name') }}">
                                    @error('business_name')
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
                                    <button type="submit" class="btn view_btn" id="addBusinessType">Add</button>
                                </div>
                            </form>
                        </div><!--end card-body-->
                    </div><!--end card-->

                </div> <!--end col-->

            </div><!--end row-->


            <!-- end page title end breadcrumb -->

        </div><!-- container -->
    @endsection
