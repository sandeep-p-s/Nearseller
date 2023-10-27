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
                                <h4 class="page-title">Edit Service Type</h4>
                            </div>
                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div> <!--end row-->
            <div id="loading-overlay"></div>
            <img id="loading-image" src="{{ asset('img/loading.gif') }}" style="display: none; width:100px;">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('update.servicetype', $servicetype->id) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Business Type</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="business_name">
                                        {{-- <option value="0">Select Business Type</option> --}}
                                        @foreach ($businesstype as $bt)
                                        <option {{ $bt->id == $servicetype->business_type_id? 'selected' : '' }} value="{{$bt->id}}">{{$bt->business_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Edit Service Type</label>
                                    <input type="text" class="form-control mb-3" id="service_name" name="service_name"
                                        placeholder="Enter service type" value="{{ $servicetype->service_name }}" onchange="existservicecategory(this.value)">
                                        <div id="existcategory-message" class="text-center" style="display: none;"></div>

                                        @error('service_name')
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Status</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="status">
                                            <option value="Active" @if($servicetype->status === 'Y') selected @endif>Active</option>
                                            <option value="Inactive" @if($servicetype->status === 'N') selected @endif>Inactive</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn view_btn">Update</button>
                                </div>
                            </form>
                        </div><!--end card-body-->
                    </div><!--end card-->

                </div> <!--end col-->

            </div><!--end row-->


            <!-- end page title end breadcrumb -->

        </div><!-- container -->
        {{-- <script>
            function existservicecategory(category) {
                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('existServicetypeName') }}',
                    type: 'POST',
                    data: {
                        category: category
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(data) {
                        if (data.result == 1) {
                            $('#existcategory-message').text('Service Type Name Already Exists.').fadeIn();
                            $('#existcategory-message').addClass('error');
                            setTimeout(function() {
                                $('#existcategory-message').fadeOut();
                            }, 5000);
                            $('#service_category_name').val('');
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        } else if (data.result == 3) {
                            $('#existcategory-message').text('Error in Data').fadeIn();
                            $('#existcategory-message').addClass('error');
                            setTimeout(function() {
                                $('#existcategory-message').fadeOut();
                            }, 5000);
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        } else {
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }
                    }
                });

            }
        </script> --}}

    @endsection
