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
                                <h4 class="page-title">Edit State</h4>
                            </div>
                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div> <!--end row-->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('update.state', $state->id) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Select Country</label>
                                    <select class="form-control mb15" id="exampleFormControlSelect1" name="country_name">
                                        <option value="0">Select Country</option>

                                        <option value="{{ $state->id }}" @if ($state->id == $selectedCountryId) selected @endif>
                                            {{ $state->state_name }}
                                        </option>
                                    </select>
                                    <label for="exampleFormControlInput1">Edit State</label>
                                    <input type="text" class="form-control mb15" id="exampleFormControlInput1"
                                        name="state_name" placeholder="Enter State Name"
                                        value="{{ $state->state_name }}">
                                    <label for="exampleFormControlSelect1">Status</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="status">
                                        <option value="N" {{ $state->status == 'N' ? 'selected' : '' }}>Inactive
                                        </option>
                                        <option value="Y" {{ $state->status == 'Y' ? 'selected' : '' }}>Active
                                        </option>
                                    </select>
                                    <br>
                                    @error('state_name')
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