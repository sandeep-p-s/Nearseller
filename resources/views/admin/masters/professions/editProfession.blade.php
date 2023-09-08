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
                                <h4 class="page-title">Edit Profession</h4>
                            </div>
                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div> <!--end row-->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('update.profession', $profession->id) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Edit Profession</label>
                                    <input type="text" class="form-control mb15" id="exampleFormControlInput1"
                                        name="profession_name" placeholder="Enter Profession Name"
                                        value="{{ $profession->profession_name }}">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Status</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="status">
                                            <option value="N" {{ $profession->status == 'N' ? 'selected' : '' }}>Inactive
                                            </option>
                                            <option value="Y" {{ $profession->status == 'Y' ? 'selected' : '' }}>Active
                                            </option>
                                        </select>
                                    </div>
                                    @error('profession_name')
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
