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
                    <div class="button-items d-flex align-items-end flex-column">
                        <a href="{{ route('list.state') }}"><button type="button" class="btn btn-secondary">Back</button></a>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('update.state', $state->id) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Select Country</label>
                                    <select class="form-control mb15" id="exampleFormControlSelect1" name="country_name">

                                        @foreach ($countries as $ct)
                                        <option {{ $ct->id == $state->country_id? 'selected' : '' }} value="{{$ct->id}}">{{$ct->country_name}}</option>

                                        @endforeach
                                            </select>
                                    <label for="exampleFormControlInput1">Edit State</label>
                                    <input type="text" class="form-control mb15" id="exampleFormControlInput1"
                                        name="state_name" placeholder="Enter State Name"
                                        value="{{ $state->state_name }}">
                                    <label for="exampleFormControlSelect1">Status</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="status">
                                        <option value="Y" {{ $state->status == 'Y' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="N" {{ $state->status == 'N' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                    <br>
                                    @error('country_name')
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
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
