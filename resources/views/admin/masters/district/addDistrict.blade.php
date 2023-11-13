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
                                <h4 class="page-title">Add District</h4>
                            </div>
                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div> <!--end row-->

            <div class="row">
                <div class="col-lg-6">
                    <div class="button-items d-flex align-items-end flex-column">
                        <a href="{{ route('list.district') }}"><button type="button" class="btn btn-secondary">Back</button></a>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('store.district') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Select State</label>
                                    <select class="form-control mb15" id="exampleFormControlSelect1" name="state_name">
                                        <option value="0">Select State</option>
                                        @foreach ($states as $st)
                                            <option value="{{ $st->id }}"
                                                {{ old('state_name') == $st->id ? 'selected' : '' }}>
                                                {{ $st->country_name }} ➤ {{ $st->state_name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="addShopType">Add District</label>
                                    <input type="text" class="form-control mb15" id="district_name"
                                        placeholder="Enter District Name" name="district_name">
                                    @error('state_name')
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
                                    @error('district_name')
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
