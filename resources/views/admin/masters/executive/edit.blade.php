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
                                <h4 class="page-title">Edit Executive</h4>
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
                            <form method="POST" action="{{ route('update.executive', $executive->id) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Executive Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control mb-3" id="executive_name"
                                        name="executive_name" placeholder="Enter executive name"
                                        value="{{ $executive->executive_name }}" onchange="exstexcutename(this.value)">
                                        <div id="exisececutename-message" class="text-center" style="display: none;"></div>
                                        @error('business_name')
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Executive Type <span class="text-danger">*</span></label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="executive_type">
                                            @foreach ($businesstype as $bt)
                                            <option {{ $bt->id == $executive->business_type_id? 'selected' : '' }} value="{{$bt->id}}">{{$bt->business_name}}</option>
                                                {{-- <option value="{{ $bt->id }}" {{ old('business_name') == $bt->id ? 'selected' : '' }}>{{ $bt->business_name }}</option> --}}
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('executive_type')
                                    <div class="text-danger mb15">{{ $message }}</div>
                                @enderror
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Status <span class="text-danger">*</span></label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="status">
                                            <option value="Active" @if($executive->status === 'Y') selected @endif>Active</option>
                                            <option value="Inactive" @if($executive->status === 'N') selected @endif>Inactive</option>
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
        <script>
            function exstexcutename(executename) {
                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('existExecutivename') }}',
                    type: 'POST',
                    data: {
                        executename: executename
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(data) {
                        if (data.result == 1) {
                            $('#exisececutename-message').text('Executive Name Already Exists.').fadeIn();
                            $('#exisececutename-message').addClass('error');
                            setTimeout(function() {
                                $('#exisececutename-message').fadeOut();
                            }, 5000);
                            //$('#executive_name').val('');
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        } else if (data.result == 3) {
                            $('#exisececutename-message').text('Error in Data').fadeIn();
                            $('#exisececutename-message').addClass('error');
                            setTimeout(function() {
                                $('#existshopname-message').fadeOut();
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
        </script>
    @endsection
