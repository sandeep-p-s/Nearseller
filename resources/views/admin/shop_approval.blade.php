@extends('backendlayout')
@section('content')
    @include('menu')
    @include('topnav')



    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="row">
                            <div class="col">
                                <h4 class="page-title">Shop Approval List</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="loading-overlay"></div>
            <img id="loading-image" src="{{ asset('img/loading.gif') }}"  style="display: none; width:100px;">


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <table >
                            <tr>
                                <td>
                                    <input type="text" id="emal_mob" name="emal_mob" class="form-control  form-control-lg" placeholder="Email/Mobile No" onchange="shwdets();" />
                                </td>
                                <td>
                                    <input type="text" id="shopname" name="shopname" class="form-control  form-control-lg" placeholder="Shop Name"  onchange="shwdets();" />
                                </td>
                                <td>
                                    <input type="text" id="ownername" name="ownername" class="form-control  form-control-lg" placeholder="Owner Name"  onchange="shwdets();" />
                                </td>
                                <td>
                                    <input type="text" id="referalid" name="referalid" class="form-control  form-control-lg" placeholder="Refferal ID"  onchange="shwdets();" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" align="center">
                                    <input type="button" id="btnsearch" name="btnsearch" class="btn btn-primary" value="Search" onClick="shwdets()" />
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>


                            <div id="catcontent" style="overflow:auto;">

                            </div>

        </div>
    @endsection
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        shwdets();
        setTimeout(() => {
                    $('#datatable').DataTable();
                }, 0);
        });

    function shwdets()
	    {
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            var emal_mob = $("#emal_mob").val();
            var shopname = $("#shopname").val();
            var ownername = $("#ownername").val();
            var referalid = $("#referalid").val();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
			$.ajax({
                url: '{{ route("admin.allshopsview") }}',
                        type: 'GET',
                        data: {emal_mob: emal_mob, shopname: shopname, ownername: ownername,referalid: referalid, _token: csrfToken
                    },
                success:function(data)
					{
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        setTimeout(() => {
                    $('#datatable').DataTable();
                }, 0);
                        $('#catcontent').html(data);

					}
            });
         }


    </script>
