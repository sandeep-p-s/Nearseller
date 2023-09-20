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
                                <h4 class="page-title">Add Attribute</h4>
                            </div>
                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div> <!--end row-->

            <div class="row">
                <div class="col-lg-6">
                    <div class="button-items d-flex align-items-end flex-column">
                        <a href="{{ route('list.attribute') }}"><button type="button"
                                class="btn btn-secondary">Back</button></a>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('store.attribute') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Select Type</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="status">
                                        <option value="0">Select Type</option>
                                        <option value="1">Shop Type</option>
                                        <option value="2">Service Type</option>
                                    </select>
                                    <br>
                                    <label for="addShopType">Attribute Name</label>
                                    <input type="text" class="form-control mb15" id="attribute_name"
                                        placeholder="Enter Attribute Name" name="attribute_name">
                                    <br>
                                    @error('attribute_name')
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
