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
                                <h4 class="page-title">Add Bank Branch</h4>
                            </div>
                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div> <!--end row-->

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('store.bank_branch') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Select District</label>
                                    <select class="form-control mb15" id="exampleFormControlSelect1" name="district_name">
                                        <option value="0">Select District</option>
                                        @foreach ($districts as $d)
                                            <option value="{{ $d->id }}">{{ $d->country_name }} >
                                                {{ $d->state_name }} > {{ $d->district_name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="exampleFormControlSelect1">Select Bank</label>
                                    <select class="form-control mb15" id="exampleFormControlSelect1" name="bank_name">
                                        <option value="0">Select Bank</option>
                                        @foreach ($banks as $b)
                                            <option value="{{ $b->id }}">{{ $b->bank_name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="addShopType">Add Bank Branch</label>
                                    <input type="text" class="form-control mb15" id="branch_name"
                                        placeholder="Enter Branch Name" name="branch_name">
                                    <label for="message">Branch Address</label>
                                    <textarea class="form-control mb15" rows="5" id="message" name="branch_address" placeholder="Enter Address"></textarea>
                                    <label for="addShopType">IFSC Code</label>
                                    <input type="text" class="form-control mb15" id="ifsc_code"
                                        placeholder="Enter IFSC Code" name="ifsc_code">
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
                                    <button type="submit" class="btn view_btn">Add</button>
                                </div>
                            </form>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!--end col-->
            </div><!--end row-->

        </div><!-- container -->
    @endsection
