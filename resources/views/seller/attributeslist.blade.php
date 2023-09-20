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

                                <h4 class="page-title">Attributes List</h4>
                                <div class="col text-right">
                                    <button class="btn add_btn" data-bs-toggle="modal" data-bs-target="#addNewModal">Add New Attribute</button>
                                </div>

                            </div>
                        </div>




                    </div>
                </div>
            </div>

            <div id="loading-overlay"></div>
            <div class="card-body" id="loading-image"  style="display: none;">
                <div class="spinner-grow text-primary" role="status"></div>
                <div class="spinner-grow text-success" role="status"></div>
                <div class="spinner-grow text-danger" role="status"></div>
                <div class="spinner-grow text-warning" role="status"></div>
                <div class="spinner-grow text-info" role="status"></div>
                <div class="spinner-grow text-purple" role="status"></div>
            </div>


            {{-- <img  id="loading-image"  src="{{ asset('img/loading.gif') }}"  style="display: none; width:100px;"> --}}
            <div id="catcontent">

            </div>
            <div class="modal fade" id="ViewEditModal" tabindex="-1" aria-labelledby="ViewEditModalLabel" aria-hidden="true">
                <div class="modal-dialog custom-modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="ViewEditModalLabel">View / Edit - Attribute Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Close">x</button>
                        </div>
                        <div class="modal-body">
                            <div id="showshopeviewedit">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Do you want to delete this attribute?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>







    <script>


    function shwdets()
	    {
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
			$.ajax({
                url: '{{ route("new.allattributes") }}',
                        type: 'GET',
                        data: {_token: csrfToken
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


            function attributevieweditdet(id)
                {
                        $('#loading-overlay').fadeIn();
                        $('#loading-image').fadeIn();
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: '{{ route("AttributeViewEdit") }}',
                                    type: 'POST',
                                    data: {id:id},
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


                function shopdeletedet(userid) {

                    $('#deleteConfirmationModal').modal('show');
                    $('#confirmDeleteBtn').click(function() {
                        $('#deleteConfirmationModal').modal('hide');
                        $('#loading-overlay').fadeIn();
                        $('#loading-image').fadeIn();
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: '{{ route("shopDelete") }}',
                            type: 'POST',
                            data: {userid: userid, _token: csrfToken},
                            success: function(data) {
                                if((data.result==1))
                                    {
                                        $('#shop_del-message').text(data.mesge).fadeIn();
                                        $('#shop_del-message').addClass('success-message');
                                        setTimeout(function() {
                                        $('#shop_del-message').fadeOut();
                                        }, 5000);
                                        $('#loading-image').fadeOut();
                                        $('#loading-overlay').fadeOut();
                                        shwdets();
                                    }
                                else if((data.result==2))
                                    {
                                        $('#shop_del-message').text(data.mesge).fadeIn();
                                        $('#shop_del-message').addClass('error');
                                        setTimeout(function() {
                                        $('#shop_del-message').fadeOut();
                                        }, 5000);
                                        $('#loading-image').fadeOut();
                                        $('#loading-overlay').fadeOut();
                                        shwdets();
                                    }



                            }
                        });
                    });
                }









    </script>
    @endsection
