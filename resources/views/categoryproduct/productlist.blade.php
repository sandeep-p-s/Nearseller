@extends('backendlayout')
@section('content')
    @include('menu')
    @include('topnav')



    <div class="page-content section_wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="row">
                            <div class="col">
                                {{-- @if (session('roleid') == '1') --}}
                                <h4 class="page-title">My Product List</h4>
                                <div class="col text-right">
                                    {{-- <button class="btn add_btn" data-bs-toggle="modal" data-bs-target="#addNewModal">Add
                                            New Product</button> --}}
                                </div>
                                {{-- @endif --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="loading-overlay"></div>
            <img id="loading-image" src="{{ asset('img/loading.gif') }}" style="display: none; width:100px;">
            {{-- @if (session('roleid') == '1') --}}
                <div class="row">
                    <div class="col-md-12">




                                <select class="selectcategoryauto form-control" id="categorySelector" name="parent_category"
                                    tabindex="3" required onchange="shwdets();">
                                    <option value="0">Parent Category</option>
                                    @foreach ($filteredCategories as $key => $category)
                                        <option value="{{ $category->id }}" data-level="{{ $category->category_level }}">
                                            @for ($i = 0; $i < $category->category_level; $i++)
                                            @endfor
                                            <span
                                                class="{{ $key === count($filteredCategories) - 1 ? 'last-child' : '' }}">{{ $category->category_name }}</span>
                                        </option>
                                    @endforeach
                                </select>







                    </div>
                </div>
            {{-- @endif --}}
            <br>

            <div class="modal fade p-5" id="ViewEditModal" tabindex="-1" aria-labelledby="ViewEditModalLabel"
                aria-hidden="true" style="overflow-y: scroll;">
                <div class="modal-dialog custom-modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="ViewEditModalLabel">View Products</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                title="Close">x</button>
                        </div>
                        <div class="modal-body">
                            <div id="showproductview">

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div id="catcontent" style="display: none;">

                            </div>

                        </div>
                    </div>
                </div>
            </div>




            <div id="categorycatcontent1"  style="display: none;">

            </div>

            <div id="categorycatcontent2"  style="display: none;">

            </div>

            <div id="categorycatcontent3"  style="display: none;">

            </div>

            <div id="categorycatcontent4"  style="display: none;">

            </div>

            <div id="categorycatcontent5"  style="display: none;">

            </div>

            <div id="categorycatcontent6"  style="display: none;">

            </div>

            <div id="categorycatcontent7"  style="display: none;">

            </div>

            <div id="categorycatcontent8"  style="display: none;">

            </div>

            <div id='myViewDiv'>
            </div>


            <script>
                function shwdets() {
                    $('#loading-overlay').fadeIn();
                    $('#loading-image').fadeIn();
                    $("#catcontent").show();
                    $('#catcontent').html('');
                    $("#categorycatcontent1").hide();
                    $("#categorycatcontent2").hide();
                    $("#categorycatcontent3").hide();
                    $("#categorycatcontent4").hide();
                    $("#categorycatcontent5").hide();
                    $("#categorycatcontent6").hide();
                    $("#categorycatcontent7").hide();
                    $("#categorycatcontent8").hide();

                    var flag=1;
                    var categoryid = $("#categorySelector").val();
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '{{ route('productlist.parentcategories') }}',
                        type: 'POST',
                        data: {
                            categoryid: categoryid,
                            flag: flag,
                            _token: csrfToken
                        },
                        success: function(data) {
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                            $('#catcontent').html(data);
                            $("#categorycatcontent1").html('');
                            $("#categorycatcontent2").html('');
                            $("#categorycatcontent3").html('');
                            $("#categorycatcontent4").html('');
                            $("#categorycatcontent5").html('');
                            $("#categorycatcontent6").html('');
                            $("#categorycatcontent7").html('');
                            $("#categorycatcontent8").html('');
                        }
                    });
                }

                function showproductcategory1(categoryid) {
                    $('#loading-overlay').fadeIn();
                    $('#loading-image').fadeIn();
                    $("#catcontent").show();
                    $("#categorycatcontent1").show();
                    $("#categorycatcontent2").hide();
                    $("#categorycatcontent3").hide();
                    $("#categorycatcontent4").hide();
                    $("#categorycatcontent5").hide();
                    $("#categorycatcontent6").hide();
                    $("#categorycatcontent7").hide();
                    $("#categorycatcontent8").hide();
                    var flag=2;
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '{{ route('productlist.parentcategories') }}',
                        type: 'POST',
                        data: {
                            categoryid: categoryid,
                            flag: flag,
                            _token: csrfToken
                        },
                        success: function(data) {
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                            $('#catcontent').show();
                            $("#categorycatcontent1").html(data);
                            $("#categorycatcontent2").html('');
                            $("#categorycatcontent3").html('');
                            $("#categorycatcontent4").html('');
                            $("#categorycatcontent5").html('');
                            $("#categorycatcontent6").html('');
                            $("#categorycatcontent7").html('');
                            $("#categorycatcontent8").html('');

                        }
                    });
                }

                function showproductcategory2(categoryid) {
                    $('#loading-overlay').fadeIn();
                    $('#loading-image').fadeIn();
                    $("#catcontent").show();
                    $("#categorycatcontent1").show();
                    $("#categorycatcontent2").show();
                    $("#categorycatcontent3").hide();
                    $("#categorycatcontent4").hide();
                    $("#categorycatcontent5").hide();
                    $("#categorycatcontent6").hide();
                    $("#categorycatcontent7").hide();
                    $("#categorycatcontent8").hide();
                    var flag=3;
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '{{ route('productlist.parentcategories') }}',
                        type: 'POST',
                        data: {
                            categoryid: categoryid,
                            flag: flag,
                            _token: csrfToken
                        },
                        success: function(data) {
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                            $('#catcontent').show();
                            $('#categorycatcontent1').show();
                            $("#categorycatcontent2").html(data);
                            $("#categorycatcontent3").html('');
                            $("#categorycatcontent4").html('');
                            $("#categorycatcontent5").html('');
                            $("#categorycatcontent6").html('');
                            $("#categorycatcontent7").html('');
                            $("#categorycatcontent8").html('');

                        }
                    });
                }

                function showproductcategory3(categoryid) {
                    $('#loading-overlay').fadeIn();
                    $('#loading-image').fadeIn();
                    $("#catcontent").show();
                    $("#categorycatcontent1").show();
                    $("#categorycatcontent2").show();
                    $("#categorycatcontent3").show();
                    $("#categorycatcontent4").hide();
                    $("#categorycatcontent5").hide();
                    $("#categorycatcontent6").hide();
                    $("#categorycatcontent7").hide();
                    $("#categorycatcontent8").hide();
                    var flag=4;
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '{{ route('productlist.parentcategories') }}',
                        type: 'POST',
                        data: {
                            categoryid: categoryid,
                            flag: flag,
                            _token: csrfToken
                        },
                        success: function(data) {
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                            $('#catcontent').show();
                            $('#categorycatcontent1').show();
                            $("#categorycatcontent2").show();
                            $("#categorycatcontent3").html(data);
                            $("#categorycatcontent4").html('');
                            $("#categorycatcontent5").html('');
                            $("#categorycatcontent6").html('');
                            $("#categorycatcontent7").html('');
                            $("#categorycatcontent8").html('');

                        }
                    });
                }

                function showproductcategory4(categoryid) {
                    $('#loading-overlay').fadeIn();
                    $('#loading-image').fadeIn();
                    $("#catcontent").show();
                    $("#categorycatcontent1").show();
                    $("#categorycatcontent2").show();
                    $("#categorycatcontent3").show();
                    $("#categorycatcontent4").show();
                    $("#categorycatcontent5").hide();
                    $("#categorycatcontent6").hide();
                    $("#categorycatcontent7").hide();
                    $("#categorycatcontent8").hide();
                    var flag=5;
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '{{ route('productlist.parentcategories') }}',
                        type: 'POST',
                        data: {
                            categoryid: categoryid,
                            flag: flag,
                            _token: csrfToken
                        },
                        success: function(data) {
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                            $('#catcontent').show();
                            $('#categorycatcontent1').show();
                            $("#categorycatcontent2").show();
                            $("#categorycatcontent3").show();
                            $("#categorycatcontent4").html(data);
                            $("#categorycatcontent5").html('');
                            $("#categorycatcontent6").html('');
                            $("#categorycatcontent7").html('');
                            $("#categorycatcontent8").html('');

                        }
                    });
                }

                function showproductcategory5(categoryid) {
                    $('#loading-overlay').fadeIn();
                    $('#loading-image').fadeIn();
                    $("#catcontent").show();
                    $("#categorycatcontent1").show();
                    $("#categorycatcontent2").show();
                    $("#categorycatcontent3").show();
                    $("#categorycatcontent4").show();
                    $("#categorycatcontent5").show();
                    $("#categorycatcontent6").hide();
                    $("#categorycatcontent7").hide();
                    $("#categorycatcontent8").hide();
                    var flag=6;
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '{{ route('productlist.parentcategories') }}',
                        type: 'POST',
                        data: {
                            categoryid: categoryid,
                            flag: flag,
                            _token: csrfToken
                        },
                        success: function(data) {
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                            $('#catcontent').show();
                            $('#categorycatcontent1').show();
                            $("#categorycatcontent2").show();
                            $("#categorycatcontent3").show();
                            $("#categorycatcontent4").show();
                            $("#categorycatcontent5").html(data);
                            $("#categorycatcontent6").html('');
                            $("#categorycatcontent7").html('');
                            $("#categorycatcontent8").html('');

                        }
                    });
                }

                function showproductcategory6(categoryid) {
                    $('#loading-overlay').fadeIn();
                    $('#loading-image').fadeIn();
                    $("#catcontent").show();
                    $("#categorycatcontent1").show();
                    $("#categorycatcontent2").show();
                    $("#categorycatcontent3").show();
                    $("#categorycatcontent4").show();
                    $("#categorycatcontent5").show();
                    $("#categorycatcontent6").show();
                    $("#categorycatcontent7").hide();
                    $("#categorycatcontent8").hide();
                    var flag=7;
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '{{ route('productlist.parentcategories') }}',
                        type: 'POST',
                        data: {
                            categoryid: categoryid,
                            flag: flag,
                            _token: csrfToken
                        },
                        success: function(data) {
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                            $('#catcontent').show();
                            $('#categorycatcontent1').show();
                            $("#categorycatcontent2").show();
                            $("#categorycatcontent3").show();
                            $("#categorycatcontent4").show();
                            $("#categorycatcontent5").show();
                            $("#categorycatcontent6").html(data);
                            $("#categorycatcontent7").html('');
                            $("#categorycatcontent8").html('');


                        }
                    });
                }

                function showproductcategory7(categoryid) {
                    $('#loading-overlay').fadeIn();
                    $('#loading-image').fadeIn();
                    $("#catcontent").show();
                    $("#categorycatcontent1").show();
                    $("#categorycatcontent2").show();
                    $("#categorycatcontent3").show();
                    $("#categorycatcontent4").show();
                    $("#categorycatcontent5").show();
                    $("#categorycatcontent6").show();
                    $("#categorycatcontent7").show();
                    $("#categorycatcontent8").hide();
                    var flag=8;
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '{{ route('productlist.parentcategories') }}',
                        type: 'POST',
                        data: {
                            categoryid: categoryid,
                            flag: flag,
                            _token: csrfToken
                        },
                        success: function(data) {
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                            $('#catcontent').show();
                            $('#categorycatcontent1').show();
                            $("#categorycatcontent2").show();
                            $("#categorycatcontent3").show();
                            $("#categorycatcontent4").show();
                            $("#categorycatcontent5").show();
                            $("#categorycatcontent6").show();
                            $("#categorycatcontent7").html(data);
                            $("#categorycatcontent8").html('');

                        }
                    });
                }

                function showproductcategory8(categoryid) {
                    $('#loading-overlay').fadeIn();
                    $('#loading-image').fadeIn();
                    $("#catcontent").show();
                    $("#categorycatcontent1").show();
                    $("#categorycatcontent2").show();
                    $("#categorycatcontent3").show();
                    $("#categorycatcontent4").show();
                    $("#categorycatcontent5").show();
                    $("#categorycatcontent6").show();
                    $("#categorycatcontent7").show();
                    $("#categorycatcontent8").show();
                    var flag=9;
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '{{ route('productlist.parentcategories') }}',
                        type: 'POST',
                        data: {
                            categoryid: categoryid,
                            flag: flag,
                            _token: csrfToken
                        },
                        success: function(data) {
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                            $('#catcontent').show();
                            $('#categorycatcontent1').show();
                            $("#categorycatcontent2").show();
                            $("#categorycatcontent3").show();
                            $("#categorycatcontent4").show();
                            $("#categorycatcontent5").show();
                            $("#categorycatcontent6").show();
                            $("#categorycatcontent7").show();
                            $("#categorycatcontent8").html(data);

                        }
                    });
                }


                function productviewdet(categoryid) {
                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('productlist.productView') }}',
                    type: 'POST',
                    data: {
                        categoryid: categoryid
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(data) {

                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        var data1 = data.trim();
                        $("#showproductview").html(data1);
                        $('#ViewEditModal').modal('show');

                    }
                });

            }



            </script>
            {{-- <div align="right"><a href='javascript:void(0)' onclick='parent.window.scrollTo(0,0);'><b>
                        <font color="#FF0000">Back To Top</font>
                    </b></a>
            </div> --}}
        @endsection
