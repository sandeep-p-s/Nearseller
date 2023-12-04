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
                                <h4 class="page-title">Edit Seller Offer</h4>
                            </div>
                            <div class="col">
                                <div class="button-items d-flex align-items-end flex-column">
                                    <a href="{{ route('addlist.shop_offer') }}"><button type="button"
                                            class="btn btn-secondary">Back</button></a>
                                </div>
                            </div>
                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div> <!--end row-->

            <form action="{{ route('update.shop_offer', $shopoffer->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">


                    <div class="col-12">
                        <div class="card">

                            @php
                                $shopshowhide = session('roleid') == 1 || session('roleid') == 3 ? 'style=display:block;' : 'style=display:none;';
                            @endphp

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group" {{ $shopshowhide }}>
                                            <label for="service_name">Shop User <span class="text-danger">*</span></label>
                                            <select class="selectshop form-select form-control form-control-lg"
                                                id="serviceuser_name" name="shopeuser_name" required tabindex="1">
                                                <option value="">Select Shop User</option><br />
                                                @foreach ($usershopdets as $shopeuser)
                                                    <option value="{{ $shopeuser->id }}" @if ($shopeuser->id == $shopoffer->user_id) selected @endif>{{ $shopeuser->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('serviceuser_name')
                                                <div class="text-danger mb-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Offer to Display<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="offer"
                                                name="offer_to_display" placeholder="Enter offer"
                                                value="{{ $shopoffer->offer_to_display }}">
                                            @error('offer_to_display')
                                                <div class="text-danger mb15">{{ $message }}</div>
                                            @enderror
                                            <!--end col-->
                                        </div>
                                        <fieldset class="mb20">
                                            <div class="repeater-default">
                                                <div data-repeater-list="car">
                                                    @if (isset($shopoffer->conditions) && is_array(json_decode($shopoffer->conditions)))
                                                        @php
                                                            $conditionsArray = json_decode($shopoffer->conditions, true);
                                                        @endphp
                                                        @foreach ($conditionsArray as $index => $condition)
                                                            <div data-repeater-item="">
                                                                <div class="form-group">
                                                                    <label class="control-label">Conditions</label>
                                                                    <input type="text" class="form-control"
                                                                        id="conditions_{{ $index }}"
                                                                        name="car[{{ $index }}][conditions]"
                                                                        placeholder="Enter conditions"
                                                                        value="{{ $condition['conditions'] }}">
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div data-repeater-item="">
                                                            <div class="form-group">
                                                                <label class="control-label">Conditions</label>
                                                                <input type="text" class="form-control" id="conditions"
                                                                    name="car[0][conditions]"
                                                                    placeholder="Enter conditions"
                                                                    value="">
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
                                                    <label class="control-label">From Date & Time<span class="text-danger">*</span></label>
                                                    <input type="datetime-local" class="form-control" id="from_time"
                                                        name="from_date_time" placeholder="Enter offer"
                                                        value="{{ $shopoffer->from_date_time }}">
                                                    @error('from_date_time')
                                                        <div class="text-danger mb15">{{ $message }}</div>
                                                    @enderror
                                                    <!--end col-->
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="control-label">To Date & Time<span class="text-danger">*</span></label>
                                                    <input type="datetime-local" class="form-control" id="to_time"
                                                        name="to_date_time" placeholder="Enter offer"
                                                        value="{{ $shopoffer->to_date_time }}"
                                                        min="{{ date('Y-m-d\TH:i') }}">
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
                                                <option value="Active" @if($shopoffer->status === 'Y') selected @endif>Active</option>
                                                <option value="Inactive" @if($shopoffer->status === 'N') selected @endif>Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Upload Image<span class="text-danger">*</span></h4>

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
                                                        data-default-file="{{ asset('uploads/shop_offer/' . $shopoffer->offer_image) }}">
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
                                    </div>
                                </div><!--end fieldset-->
                                <!--end form-->
                                <div class="content_center">
                                    <button type="submit" class="btn view_btn">Update</button>
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
