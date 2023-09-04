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
                    <div class="card">
                        @if ($errors->any())
                            <div class="text-danger pl-4 pt-4">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="text-success pl-4 pt-4">
                                <div>{{ session('success') }}</div>
                            </div>
                        @endif
                        <div class="card-body">
                            <form method="POST" action="{{ route('store.role') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="addRoleType">Add Role</label>
                                    <select class="form-select form-control" aria-label="Default select example" id="role_name" name="role_name">
                                        <option value="">Select Role</option>
                                            @foreach ($roles as $rl)
                                                <option value="{{ $rl->id }}">{{ $rl->role_name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <b style="font-size: 15px;">Grant Permissions</b>
                                @foreach ($site_module as $perm)
                                    <div class="card mb-3 mt-2">
                                        <div class="card-header c-maroon">
                                            <b>{{ $perm->module_description }}</b>
                                        </div>
                                        <div class="pt-2 pb-2 ml-5">
                                            @foreach ($perm->sub as $data)
                                                <div class="ps-3">
                                                    @if (!$data->is_disabled)
                                                        <span class="checkspan">
                                                            <input class="form-check-input" type="checkbox"
                                                                value={{ $data->id }} name="perm[]">
                                                        </span>
                                                        <span class="checkdata">{{ $data->description }}</span>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                                <button type="submit" class="btn view_btn">Add</button>
                            </form>
                        </div><!--end card-body-->
                    </div><!--end card-->

                </div> <!--end col-->

            </div><!--end row-->


            <!-- end page title end breadcrumb -->

        </div><!-- container -->
    @endsection
