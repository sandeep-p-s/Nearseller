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
                                <h4 class="page-title">Add Role</h4>

                            </div>

                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div> <!--end row-->


            <div class="row">



                <div class="col-lg-6">
                    <div class="button-items d-flex align-items-end flex-column">
                        <a href="{{ route('list.roles') }}"><button type="button"
                                class="btn btn-secondary">Back</button></a>
                    </div><br>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('store.roles') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Role Name</label>
                                    <input type="text" class="form-control mb-3" id="role_name"
                                        placeholder="Enter role name" name="role_name" value="{{ old('role_name') }}" required maxlength="50" pattern="^[a-zA-Z\s]+$" />
                                    @error('role_name')
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
