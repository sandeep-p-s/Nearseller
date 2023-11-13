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
                                <h4 class="page-title">Add States</h4>
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
                            <form method="POST" action="{{ route('store.state') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Select Country</label>
                                    <select class=" selectauto select2 form-control  mb15" id="exampleFormControlSelect1" name="country_name" style="width: 100%; height:36px;">
                                        <option value="0">Select Country</option>
                                        @foreach ($countries as $ct)
                                            <option value="{{ $ct->id }}" {{ old('country_name') == $ct->id ? 'selected' : '' }}>{{ $ct->country_name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="addShopType">Add States</label>
                                    <input type="text" class="form-control mb15" id="state_name"
                                        placeholder="Enter State Name" name="state_name">
                                    @error('country_name' )
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
                                    @error( 'state_name')
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
                                    <button type="submit" class="btn view_btn">Save</button>
                                </div>
                            </form>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!--end col-->
            </div><!--end row-->

        </div><!-- container -->
    @endsection
