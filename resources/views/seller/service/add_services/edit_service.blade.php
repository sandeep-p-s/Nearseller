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
                                <h4 class="page-title">Edit Service</h4>
                            </div>

                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div> <!--end row-->

            <form method="POST" action="{{ route('update.service', $service->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="service_name">Service Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="service_name" name="service_name"
                                                placeholder="Enter Service Name" value="{{ $service->service_name }}">
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
                                                    data-default-file="{{ asset('uploads/service_images/' . $service->service_images) }}"
                                                    name="service_images" id="service_images" />
                                            </div><!--end card-body-->
                                        </div><!--end card-->
                                        {{-- @error('service_images')
                                            <div class="text-danger mb-2">{{ $message }}</div>
                                        @enderror --}}
                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <label for="selectAttributes" class="col-md-3 my-1 control-label">Do you want to select
                                        attributes?</label>
                                    <div class="col-md-3">
                                        {{-- <div class="form-check-inline my-1">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="yesCheck" name="customRadio"
                                                    class="custom-control-input" value="Y"
                                                    {{ $service->is_attribute === 'Y' ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="yesCheck">Yes</label>
                                            </div>
                                        </div>
                                        <div class="form-check-inline my-1">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="noCheck" name="customRadio"
                                                    class="custom-control-input" value="N"
                                                    {{ $service->is_attribute === 'N' ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="noCheck">No</label>
                                            </div>
                                        </div> --}}
                                        <div class="form-check-inline my-1">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="yesCheck" name="customRadio"
                                                    class="custom-control-input" value="Y"
                                                    {{ $service->is_attribute === 'Y' ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="yesCheck">Yes</label>
                                            </div>
                                        </div>
                                        <div class="form-check-inline my-1">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="noCheck" name="customRadio"
                                                    class="custom-control-input" value="N"
                                                    {{ $service->is_attribute === 'N' ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="noCheck">No</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div id="ifYes"
                                    style="{{ $service->is_attribute === 'Y' ? 'display: block' : 'display: none' }}">

                                    <fieldset>
                                        @foreach ($attributes as $index => $attribute)
                                            <div class="repeater-default">
                                                <div data-repeater-list="car">
                                                    <div data-repeater-item="">
                                                        <div class="form-group row d-flex align-items-end">
                                                            <input type="hidden"
                                                                name="car[{{ $index }}][attribute_id]"
                                                                value="{{ $attribute->id }}">
                                                            <div class="col">
                                                                <label for="showstatus" class="control-label">Show status
                                                                </label>
                                                                <input type="checkbox" class="form-control"
                                                                    id="car[{{ $index }}][showstatus]"
                                                                    name="showstatus" style="width: 10%"
                                                                    {{ $attribute->show_status ? 'checked' : '' }}>
                                                            </div>
                                                            <div class="col">
                                                                <label for="attribute1" class="control-label">Attribute
                                                                    1</label>
                                                                <input type="text" class="form-control" name="attribute1"
                                                                    id="attribute1" value="{{ $attribute->attribute_1 }}">
                                                            </div>
                                                            <div class="col">
                                                                <label for="attribute2" class="control-label">Attribute
                                                                    2</label>
                                                                <input type="text" class="form-control" name="attribute2"
                                                                    id="attribute2" value="{{ $attribute->attribute_2 }}">
                                                            </div>
                                                            <div class="col">
                                                                <label for="attribute3" class="control-label">Attribute
                                                                    3</label>
                                                                <input type="text" class="form-control"
                                                                    name="attribute3" id="attribute3"
                                                                    value="{{ $attribute->attribute_3 }}">
                                                            </div>
                                                            <div class="col">
                                                                <label for="attribute4" class="control-label">Attribute
                                                                    4</label>
                                                                <input type="text" class="form-control"
                                                                    name="attribute4" id="attribute4"
                                                                    value="{{ $attribute->attribute_4 }}">
                                                            </div>
                                                            <div class="col">
                                                                <label for="offerprice" class="control-label">Offer
                                                                    Price</label>
                                                                <input type="text" class="form-control"
                                                                    name="offerprice" id="offerprice"
                                                                    value="{{ $attribute->offer_price }}">
                                                            </div>
                                                            <div class="col">
                                                                <label for="mrp" class="control-label">MRP</label>
                                                                <input type="text" class="form-control" name="mrp"
                                                                    id="mrp" value="{{ $attribute->mrp_price }}">
                                                            </div>
                                                            <div class="col">
                                                                <label for="callshop" class="control-label">Call
                                                                    shop</label>
                                                                <input type="text" class="form-control"
                                                                    name="callshop" id="callshop"
                                                                    value="{{ $attribute->call_shop }}">
                                                            </div>
                                                            <div class="col">
                                                                <span data-repeater-delete=""
                                                                    class="btn btn-danger btn-sm">
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
                                        @endforeach
                                    </fieldset>
                                </div>

                            </div><!--end card-body-->
                        </div><!--end card-->

                    </div> <!--end col-->

                </div><!--end row-->
                <div class="form-group mt30">
                    <button type="submit" class="btn view_btn">Update</button>
                    <a href="{{ route('list.service') }}"><button type="button"
                            class="btn delete_btn">Close</button></a>
                </div>
            </form>

            <!-- end page title end breadcrumb -->

        </div><!-- container -->

        <script>
            $(document).ready(function() {
                function toggleAttributeFields() {
                    if ($("#yesCheck").prop("checked")) {
                        $("#ifYes").css("display", "block");
                    } else {
                        $("#ifYes").css("display", "none");
                    }
                }

                toggleAttributeFields();

                $("input[name='customRadio']").on("change", function() {
                    toggleAttributeFields();
                });
            });

            // $(document).ready(function() {
            //     $("input[name='customRadio']").on("change", function() {
            //         if ($(this).val() === "Y" && $(this).is(":checked")) {
            //             $("#ifYes").css("display", "block");
            //         } else {
            //             $("#ifYes").css("display", "none");
            //         }
            //     });
            // });
        </script>
    @endsection
