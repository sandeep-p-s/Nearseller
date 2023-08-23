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
                                    <h4 class="page-title">Add Business Type</h4>

                                </div>

                            </div><!--end row-->
                        </div><!--end page-title-box-->
                    </div><!--end col-->
                </div> <!--end row-->


                <div class="row">



                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                {{-- <form action="{{ route('store.business_type') }}" method="POST"> --}}
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Add Business Type</label>
                                        <input type="text" class="form-control mb15" id="business_name"
                                            placeholder="Enter business type" name="business_name">
                                        <button type="submit" class="btn view_btn" id="addBusinessType">Add</button>
                                    </div>
                                {{-- </form> --}}
                            </div><!--end card-body-->
                        </div><!--end card-->

                    </div> <!--end col-->

                </div><!--end row-->


                <!-- end page title end breadcrumb -->

            </div><!-- container -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function () {
                    $('#addBusinessType').click(function () {
                        var businessName = $('#business_name').val();

                        $.ajax({
                            type: 'POST',
                            url: '{{ route('store.business_type') }}',
                            data: {
                                _token: '{{ csrf_token() }}',
                                business_name: businessName
                            },
                            success: function (response) {
                                if (response.success) {
                                    // Get the success message from the response
                                    var successMessage = response.message;

                                    // Display the success message in the designated div
                                    $('#successMessage').html(successMessage);

                                    // Clear the input field
                                    $('#business_name').val('');

                                    // Redirect to the list page
                                    window.location.href = '{{ route('list.businesstype') }}';
                                } else {
                                    // Handle error, e.g., show an error message
                                    alert('Failed to add Business Type.');
                                }
                            },
                            error: function () {
                                // Handle error, e.g., show an error message
                                alert('Failed to add Business Type.');
                            }
                        });
                    });
                });
            </script>

        @endsection
