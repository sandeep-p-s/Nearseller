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
                                <h4 class="page-title">Edit Country</h4>
                            </div>
                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div> <!--end row-->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('update.country', $country->id) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Edit Country</label>
                                    <input type="text" class="form-control mb15" id="exampleFormControlInput1"
                                        name="country_name" placeholder="Enter Country Name"
                                        value="{{ $country->country_name }}">
                                    <label for="exampleFormControlSelect1">Status</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="status">
                                        <option value="N" {{ $country->status == 'N' ? 'selected' : '' }}>Inactive
                                        </option>
                                        <option value="Y" {{ $country->status == 'Y' ? 'selected' : '' }}>Active
                                        </option>
                                    </select>
                                    <br>
                                    @error('country_name')
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
                                    <br>
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
