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
            @if (session('roleid') == '1')
                <div class="row">
                    <div class="col-12">

                        <div class="row">
                            <div class="col-md-2">

                            </div>

                            <div class="col-md-8">
                                <select class="selectcategoryauto form-control" id="categorySelector" name="parent_category"
                                    tabindex="3" required onchange="shwdets();">
                                    <option value="0">Select Category</option>
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



                            <div class="col-md-2">

                            </div>


                            <div class="col-md-12 col-lg-12 d-flex justify-content-center" style="margin-top: 20px;">
                                <input type="button" id="btnsearch" name="btnsearch" class="btn btn-primary" value="Search"
                                    onClick="shwdets()" />

                            </div>

                        </div>

                    </div>
                </div>
            @endif


            <div id="catcontent" style="display: none;">

            </div>
            <div id='myViewDiv'>
            </div>

            <div id="categorycatcontent"  style="display: none;">

            </div>




            <script>
                function shwdets() {
                    $('#loading-overlay').fadeIn();
                    $('#loading-image').fadeIn();
                    $("#catcontent").show();
                    $('#catcontent').html('');
                    $("#categorycatcontent").hide();
                    var flag=1;
                    var categoryid = $("#categorySelector").val();
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '{{ route('productlist.allcategoryproduct') }}',
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
                            $("#categorycatcontent").html('');

                        }
                    });
                }

                function showproductcategory(categoryid) {
                    $('#loading-overlay').fadeIn();
                    $('#loading-image').fadeIn();
                    $("#catcontent").show();
                    $("#categorycatcontent").show();
                    var flag=2;
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '{{ route('productlist.allcategoryproduct') }}',
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
                            $("#categorycatcontent").html(data);

                        }
                    });
                }





            </script>
            {{-- <div align="right"><a href='javascript:void(0)' onclick='parent.window.scrollTo(0,0);'><b>
                        <font color="#FF0000">Back To Top</font>
                    </b></a>
            </div> --}}
        @endsection
