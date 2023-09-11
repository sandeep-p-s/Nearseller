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
                                <h4 class="page-title">Edit Bank Branch</h4>
                            </div>
                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div> <!--end row-->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            @foreach ($branch as $b)
                                <form method="POST" action="{{ route('update.bank_branch', $b->id) }}">
                            @endforeach
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Select District</label>
                                <select class="form-control mb15" id="exampleFormControlSelect1" name="district_name">
                                    <option value="0">Select District</option>
                                    @foreach ($branch as $b)
                                        <option value="{{ $b->district_code }}"
                                            {{ $b->district_code == $b->district_id ? 'selected' : '' }}>
                                            {{ $b->country_name }} >
                                            {{ $b->state_name }} > {{ $b->district_name }}</option>
                                    @endforeach
                                </select>
                                <label for="exampleFormControlSelect1">Select Bank</label>
                                <select class="form-control mb15" id="exampleFormControlSelect1" name="bank_name">
                                    <option value="0">Select Bank</option>
                                    @foreach ($branch as $b)
                                        <option
                                            value="{{ $b->bank_id }}" {{ $b->bank_id == $b->bank_code ? 'selected' : '' }}>
                                            {{ $b->bank_name }}</option>
                                </select>
                                <label for="exampleFormControlInput1">Edit Bank Branch</label>
                                <input type="text" class="form-control mb15" id="exampleFormControlInput1"
                                    name="bank_name" placeholder="Enter Bank Branch Name" value="{{ $b->branch_name }}">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Status</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="status">
                                        <option value="Y" {{ $b->status == 'Y' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="N" {{ $b->status == 'N' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                </div>
                                <label for="message">Branch Address</label>
                                <textarea class="form-control mb15" rows="5" id="message" name="branch_address" placeholder="Enter Address">{{ $b->branch_address }}</textarea>
                                <label for="addShopType">IFSC Code</label>
                                <input value="{{ $b->ifsc_code }}" type="text" class="form-control mb15" id="ifsc_code"
                                    placeholder="Enter IFSC Code" name="ifsc_code">
                                @endforeach

                                <br>
                                @error('district_name')
                                    <div class="text-danger mb15">{{ $message }}</div>
                                @enderror
                                @error('bank_name')
                                    <div class="text-danger mb15">{{ $message }}</div>
                                @enderror
                                @error('branch_name')
                                    <div class="text-danger mb15">{{ $message }}</div>
                                @enderror
                                @error('branch_address')
                                    <div class="text-danger mb15">{{ $message }}</div>
                                @enderror
                                @error('ifsc_code')
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
