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
                                <h4 class="page-title">Home</h4>

                            </div>

                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div> <!--end row-->

            <form>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Phone Number</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1"  value="Peethamparan" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Location</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" value="Kulappuram" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Country </label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" value="India" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">State</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" value="Tamilnadu" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Registration Date</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" value="Kanyakumari" readonly>
                                </div>
                                <div class="form-group">
                                  <label for="exampleFormControlInput1">Direct Affiliate</label>
                                  <input type="text" class="form-control" id="exampleFormControlInput1" value="Kanyakumari" readonly>
                              </div>
                              <div class="form-group">
                                <label for="exampleFormControlInput1">Coordinator</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value="Kanyakumari" readonly>
                            </div>
                            <div class="form-group">
                              <label for="exampleFormControlInput1">Date of Birth</label>
                              <input type="text" class="form-control" id="exampleFormControlInput1" value="05-04-2023" readonly>
                          </div>
                        </div><!--end card-body-->
                    </div><!--end card-->

                </div> <!--end col-->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">

                          <div class="form-group">
                            <h4 class="mb15">Bank Account</h4>
                            <label for="exampleFormControlInput1">Account Name</label>
                            <input type="text" class="form-control mb15" id="exampleFormControlInput1"  placeholder="Peethamparan" readonly>
                            <label for="exampleFormControlInput1">Account Number</label>
                            <input type="text" class="form-control mb15" id="exampleFormControlInput1"  placeholder="9383882329999" readonly>
                            <label for="exampleFormControlInput1">Bank Name</label>
                            <input type="text" class="form-control mb15" id="exampleFormControlInput1"  placeholder="HDFC Bank" readonly>
                            <label for="exampleFormControlInput1">Bank Branch</label>
                            <input type="text" class="form-control mb15" id="exampleFormControlInput1"  placeholder="Parassala" readonly>
                            <label for="exampleFormControlInput1">IFSC Code</label>
                            <input type="text" class="form-control mb15" id="exampleFormControlInput1"  placeholder="212121" readonly>
                            <label for="exampleFormControlInput1">PAN</label>
                            <input type="text" class="form-control mb15" id="exampleFormControlInput1"  placeholder="IFJ43445k" readonly>


                        </div>

                        </div><!--end card-body-->
                    </div><!--end card-->

                </div>  <!--end col-->

            </div><!--end row-->

        </form>

            <!-- end page title end breadcrumb -->

     </div><!-- container -->
@endsection
