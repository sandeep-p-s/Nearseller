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
                                <h4 class="page-title">Approved Service Offer</h4>
                            </div>
                            <div class="col">
                                <div class="button-items d-flex align-items-end flex-column">
                                    <a href="{{ route('list.service_offer') }}"><button type="button"
                                            class="btn btn-secondary">Back</button></a>
                                </div>
                            </div>
                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div> <!--end row-->

            <form action="{{ route('approvedstatus.service', $serviceoffer->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group" style="display: none;">
                                            <label for="service_name">Service User <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select form-control form-control-lg" id="serviceuser_name"
                                                name="serviceuser_name" required tabindex="1">
                                                <option value="">Select Service User</option><br />
                                                @foreach ($userservicedets as $serviceuser)
                                                    <option value="{{ $serviceuser->id }}"
                                                        @if ($serviceuser->id == $serviceoffer->user_id) selected @endif>
                                                        {{ $serviceuser->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('serviceuser_name')
                                                <div class="text-danger mb-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Offer to Display</label>
                                            <input type="text" class="form-control" id="offer"
                                                name="offer_to_display" placeholder="Enter offer"
                                                value="{{ $serviceoffer->offer_to_display }}" readonly>
                                            @error('offer_to_display')
                                                <div class="text-danger mb15">{{ $message }}</div>
                                            @enderror
                                            <!--end col-->
                                        </div>
                                        <fieldset class="mb20">
                                            <div class="repeater-default">
                                                <div data-repeater-list="car">
                                                    @if (isset($serviceoffer->conditions) && is_array(json_decode($serviceoffer->conditions)))
                                                        @php
                                                            $conditionsArray = json_decode($serviceoffer->conditions, true);
                                                        @endphp
                                                        @foreach ($conditionsArray as $index => $condition)
                                                            <div data-repeater-item="">
                                                                <div class="form-group">
                                                                    <label class="control-label">Conditions</label>
                                                                    <input type="text" class="form-control"
                                                                        id="conditions_{{ $index }}"
                                                                        name="car[{{ $index }}][conditions]"
                                                                        placeholder="Enter conditions"
                                                                        value="{{ $condition['conditions'] }}" readonly>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div data-repeater-item="">
                                                            <div class="form-group">
                                                                <label class="control-label">Conditions</label>
                                                                <input type="text" class="form-control" id="conditions"
                                                                    name="car[0][conditions]" placeholder="Enter conditions"
                                                                    value="" readonly>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-0 row">
                                                    <div class="col-sm-12">
                                                        <span data-repeater-create="" class="btn btn-secondary btn-sm">
                                                            <span class="fas fa-plus"></span> Add Condition
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <h5 class="mb15">Time Phrame</h5>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="control-label">From Date & Time</label>
                                                    <input type="datetime-local" class="form-control" id="from_time"
                                                        name="from_date_time" placeholder="Enter offer"
                                                        value="{{ $serviceoffer->from_date_time }}" readonly>
                                                    @error('from_date_time')
                                                        <div class="text-danger mb15">{{ $message }}</div>
                                                    @enderror
                                                    <!--end col-->
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="control-label">To Date & Time</label>
                                                    <input type="datetime-local" class="form-control" id="to_time"
                                                        name="to_date_time" placeholder="Enter offer"
                                                        value="{{ $serviceoffer->to_date_time }}" readonly>
                                                    @error('to_date_time')
                                                        <div class="text-danger mb15">{{ $message }}</div>
                                                    @enderror
                                                    <!--end col-->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Status</label>
                                            <select class="form-control" id="exampleFormControlSelect1" name="status">
                                                <option value="Active" @if($serviceoffer->status === 'Y') selected @endif>Active</option>
                                                <option value="Inactive" @if($serviceoffer->status === 'N') selected @endif>Inactive</option>
                                            </select>
                                        </div>
                                        <div class="form-group"><label>Approval Status</label>
                                            <select class="form-control" id="serviceofferapproved"
                                                name="serviceofferapproved">
                                                <option value="Y"
                                                    {{ $serviceoffer->approval_status == 'Y' ? 'selected' : '' }}>
                                                    Approved
                                                </option>
                                                <option value="N"
                                                    {{ $serviceoffer->approval_status == 'N' ? 'selected' : '' }}>
                                                    Not Approved
                                                </option>
                                                {{-- <option value="R" {{ $shopoffer->approval_status  == 'R' ? 'selected' : '' }}>
                                                    Rejected
                                                </option> --}}
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Upload Image</h4>

                                            </div><!--end card-header-->
                                            <div class="card-body">
                                                <div class="dropify-wrapper" style="height: 320px;">
                                                    <div class="dropify-message"><span class="file-icon">
                                                            <p>Drag and drop a file here or click</p>
                                                        </span>
                                                        <p class="dropify-error">Ooops, something wrong appended.
                                                        </p>
                                                    </div>
                                                    <div class="dropify-loader"></div>
                                                    <div class="dropify-errors-container">
                                                        <ul></ul>
                                                    </div>
                                                    <input type="file" id="input-file-now-custom-2" class="dropify"
                                                        data-height="300" name="offer_image"
                                                        data-default-file="{{ asset('uploads/service_offer/' . $serviceoffer->offer_image) }}"
                                                        readonly>
                                                    <button type="button" class="dropify-clear">Remove</button>
                                                    <div class="dropify-preview"><span class="dropify-render"></span>
                                                        <div class="dropify-infos">
                                                            <div class="dropify-infos-inner">
                                                                <p class="dropify-filename"><span
                                                                        class="file-icon"></span>
                                                                    <span class="dropify-filename-inner"></span>
                                                                </p>
                                                                <p class="dropify-infos-message">Drag and drop or
                                                                    click to replace</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!--end card-body-->
                                        </div>
                                        {{-- @error('offer_image')
                                            <div class="text-danger mb-2">{{ $message }}</div>
                                        @enderror --}}
                                    </div>
                                </div><!--end fieldset-->
                                <!--end form-->
                                <div class="content_center">
                                    <button type="submit" class="btn view_btn">Approve</button>
                                </div>
                            </div><!--end card-body-->
                        </div>
                    </div>
                </div><!--end row-->

            </form>

            <!-- end page title end breadcrumb -->

        </div><!-- container -->
        <script>
            $(document).ready(function() {
                $('.selectshop').each(function() {
                    var $p = $(this).parent();
                    $(this).select2({
                        dropdownParent: $p
                    });
                });
            });
            document.addEventListener("DOMContentLoaded", function() {
                const fromTimeInput = document.getElementById("from_time");
                const toTimeInput = document.getElementById("to_time");

                fromTimeInput.addEventListener("change", function() {
                    const fromTimeValue = new Date(fromTimeInput.value);

                    toTimeInput.min = fromTimeValue.toISOString().slice(0, 16);

                    toTimeInput.addEventListener("change", function() {
                        const toTimeValue = new Date(toTimeInput.value);
                        if (toTimeValue <= fromTimeValue) {
                            alert("To Date & Time should be after From Date & Time");
                            toTimeInput.value = "";
                        }
                    });
                });
            });
        </script>
    @endsection
