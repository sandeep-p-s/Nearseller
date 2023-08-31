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
                                <h4 class="page-title">Shop Approval List</h4>
                                <div class="col text-right">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewModal">Add New Shops</button>
                                </div>
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


            <div id="catcontent">

            </div>


            <div class="modal fade" id="ViewEditModal" tabindex="-1" aria-labelledby="ViewEditModalLabel" aria-hidden="true">
                <div class="modal-dialog custom-modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="ViewEditModalLabel">View Shop Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Close">x</button>
                        </div>
                        <div class="modal-body">
                            <div id="showshopeviewedit">

                            </div>
                        </div>
                    </div>
                </div>
            </div>






        </div>





    @endsection

    <script>


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




    function exstemilid(u_emid,checkval)
	{
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
			$.ajax({
                url: '{{ route("existemail") }}',
                        type: 'POST',
                        data: {u_emid:u_emid},
                        headers: {
                        'X-CSRF-TOKEN': csrfToken
                        },
                success:function(data)
					{
                        if(data.result==1 && checkval==2)
                        {
                            $('#semil-message').text('Email ID Already Exists.').fadeIn();
                            $('#semil-message').addClass('error');
                            setTimeout(function() {
                            $('#semil-message').fadeOut();
                            }, 5000);
                            $('#s_email').val('');
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }
                        else if(data.result==3 && checkval==2)
                        {
                            $('#semil-message').text('Error in Data').fadeIn();
                            $('#semil-message').addClass('error');
                            setTimeout(function() {
                            $('#semil-message').fadeOut();
                            }, 5000);
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }
                        else
                        {
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }
					}
            });

	}

    function exstmobno(u_mobno,checkval)
	{
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
			$.ajax({
                url: '{{ route("existmobno") }}',
                        type: 'POST',
                        data: {u_mobno:u_mobno},
                        headers: {
                        'X-CSRF-TOKEN': csrfToken
                        },
                success:function(data)
					{
                        if(data.result==1 && checkval==2)
                        {
                            $('#smob-message').text('Mobile Number Already Exists.').fadeIn();
                            $('#smob-message').addClass('error');
                            setTimeout(function() {
                            $('#smob-message').fadeOut();
                            }, 5000);
                            $('#s_mobno').val('');
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }
                        else if(data.result==3 && checkval==2)
                        {
                            $('#smob-message').text('Error in Data').fadeIn();
                            $('#smob-message').addClass('error');
                            setTimeout(function() {
                            $('#smob-message').fadeOut();
                            }, 5000);
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }
                        else
                        {
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }
					}
            });

	}

    function checkrefrelno(referalno,numr)
	    {
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
			$.ajax({
                url: '{{ route("shopnotregreferal") }}',
                        type: 'POST',
                        data: {referalno:referalno,numr:numr},
                        headers: {
                        'X-CSRF-TOKEN': csrfToken
                        },
                success:function(data)
					{

                        if((data.result==1) && (numr==1))
                        {
                            $('#s_refralid-message').text('Shop Referral ID Not Found').fadeIn();
                            $('#s_refralid-message').addClass('error');
                            setTimeout(function() {
                            $('#s_refralid-message').fadeOut();
                            }, 5000);
                            $("#s_refralid").val('');
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }
                        else if((data.result==1) && (numr==2))
                        {
                            $('#a_refralid-message').text('Affiliate Referral ID Not Found').fadeIn();
                            $('#a_refralid-message').addClass('error');
                            setTimeout(function() {
                            $('#a_refralid-message').fadeOut();
                            }, 5000);
                            $("#a_refralid").val('');
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }
                        else
                        {
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                        }
					}
            });
         }


         function shopvieweditdet(shopid)
                {
                        $('#loading-overlay').fadeIn();
                        $('#loading-image').fadeIn();
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: '{{ route("shopViewEdit") }}',
                                    type: 'POST',
                                    data: {shopid:shopid},
                                    headers: {
                                    'X-CSRF-TOKEN': csrfToken
                                    },
                            success:function(data)
                                {

                                    $('#loading-image').fadeOut();
                                    $('#loading-overlay').fadeOut();
                                    var data1=data.trim();
					                $("#showshopeviewedit").html(data1);
                                    $('#ViewEditModal').modal('show');

                                }
                        });

                }




    </script>
