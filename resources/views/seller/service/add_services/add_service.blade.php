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
                                <h4 class="page-title">Add Service</h4>
                            </div>

                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div> <!--end row-->

            <form method="POST" action="{{ route('store.service') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="service_name">Service User <span
                                                    class="text-danger">*</span></label>
                                            <select class="selectservice form-select form-control "
                                                id="serviceuser_name" name="serviceuser_name" required tabindex="1">
                                                <option value="">Select Service User</option><br />
                                                @foreach ($userservicedets as $serviceuser)
                                                    <option value="{{ $serviceuser->id }}">{{ $serviceuser->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('serviceuser_name')
                                                <div class="text-danger mb-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="service_name">Service Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="service_name" name="service_name"
                                                placeholder="Enter Service Name" value="{{ old('service_name') }}">
                                            @error('service_name')
                                                <div class="text-danger mb-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="service_images">Service Image<span class="text-danger">*</span></label>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <input type="file" id="input-file-now-custom-3" class="dropify"
                                                    data-default-file="" name="service_images" id="service_images" />
                                            </div><!--end card-body-->
                                        </div><!--end card-->
                                        @error('service_images')
                                            <div class="text-danger mb-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <label for="selectAttributes" class="col-md-3 my-1 control-label">Do you want to select
                                        attributes?<span class="text-danger">*</span></label>
                                    <div class="col-md-3">
                                        <div class="form-check-inline my-1">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="yesCheck" name="customRadio"
                                                    class="custom-control-input" value="Y">
                                                <label class="custom-control-label" for="yesCheck">Yes</label>
                                            </div>
                                        </div>
                                        <div class="form-check-inline my-1">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="noCheck" name="customRadio"
                                                    class="custom-control-input" value="N">
                                                <label class="custom-control-label" for="noCheck">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="ifYes" style="visibility:hidden">

                                    <fieldset>
                                        <div class="repeater-default">
                                            <div data-repeater-list="car">
                                                <div data-repeater-item="">
                                                    <div class="form-group row d-flex align-items-end">

                                                        <div class="col">
                                                            <label for="showstatus" class="control-label">Show status<span class="text-danger">*</span>
                                                            </label>
                                                            <input type="checkbox" class="form-control" id="showstatus"
                                                                name="showstatus" value="1" style="width: 10%"
                                                                data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                        </div>
                                                        <div class="col">
                                                            <label for="attribute1" class="control-label">Attribute
                                                                1<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="attribute1"
                                                                id="attribute1">
                                                        </div>
                                                        <div class="col">
                                                            <label for="attribute2" class="control-label">Attribute
                                                                2<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="attribute2"
                                                                id="attribute2">
                                                        </div>
                                                        <div class="col">
                                                            <label for="attribute3" class="control-label">Attribute
                                                                3<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="attribute3"
                                                                id="attribute3">
                                                        </div>
                                                        <div class="col">
                                                            <label for="attribute4" class="control-label">Attribute
                                                                4<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="attribute4"
                                                                id="attribute4">
                                                        </div>
                                                        <div class="col">
                                                            <label for="offerprice" class="control-label">Offer
                                                                Price<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="offerprice"
                                                                id="offerprice">
                                                        </div>
                                                        <div class="col">
                                                            <label for="mrp" class="control-label">MRP<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="mrp"
                                                                id="mrp">
                                                        </div>
                                                        <div class="col">
                                                            <label for="callshop" class="control-label">Call shop<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="callshop"
                                                                id="callshop">
                                                        </div>
                                                        <div class="col">
                                                            <span data-repeater-delete="" class="btn btn-danger btn-sm">
                                                                <span class="far fa-trash-alt mr-1"></span> Delete
                                                            </span>
                                                        </div><!--end col-->
                                                    </div><!--end row-->
                                                </div><!--end /div-->


                                            </div><!--end repet-list-->
                                            <div class="form-group mb-0 row">
                                                <div class="col-sm-12">
                                                    <span data-repeater-create="" class="btn btn-secondary btn-sm">
                                                        <span class="fas fa-plus"></span> Add
                                                    </span>
                                                </div><!--end col-->
                                            </div><!--end row-->
                                        </div> <!--end repeter-->
                                    </fieldset>
                                </div>

                            </div><!--end card-body-->
                        </div><!--end card-->

                    </div> <!--end col-->

                </div><!--end row-->
                <div class="form-group mt30">
                    <button type="submit" class="btn view_btn">Save</button>
                    <a href="{{ route('list.service') }}"><button type="button"
                            class="btn delete_btn">Close</button></a>
                </div>
            </form>

            <!-- end page title end breadcrumb -->

        </div><!-- container -->

        <script>
            $(document).ready(function() {
                $("input[name='customRadio']").on("change", function() {
                    if ($(this).val() === "Y" && $(this).is(":checked")) {
                        $("#ifYes").css("visibility", "visible");
                    } else {
                        $("#ifYes").css("visibility", "hidden");
                    }
                });

                $('.selectservice').each(function() {
                    var $p = $(this).parent();
                    $(this).select2({
                        dropdownParent: $p
                    });
                });
            });
        </script>
    @endsection
