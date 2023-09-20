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
                                <h4 class="page-title">User Menu Mapping</h4>
                                {{-- <div class="col text-right">
                                    <button class="btn add_btn" data-bs-toggle="modal" data-bs-target="#addNewModal">Add New User</button>
                                </div> --}}

                            </div>
                        </div>




                    </div>
                </div>
            </div>

            <div id="loading-overlay"></div>
            <img id="loading-image" src="{{ asset('img/loading.gif') }}"  style="display: none; width:100px;">


            <div class="row">
                <div class="col-12">

                    <div class="row">

                        <div class="col-md-12 justify-content-center"><label >Users</label>
                            <select class="form-select form-control form-control-lg" name="userid" aria-label="Default select example" id="userid" onChange="showUserMenuitems(this.value);" required tabindex="2">
                                <option value="">Select User</option>
                                @foreach ($alluserdetails as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }} ({{ $user->roles }})
                                    </option>
                                @endforeach
                            </select>

                            <label for="roleid" class="error"></label>
                        </div>

                        <div class="col-md-12 col-lg-12 d-flex justify-content-center" style="margin-top: 20px;">
                          <input type="button" id="btnsearch" name="btnsearch" class="btn btn-primary" value="Search" onClick="showUserMenuitems(userid.value)" />

                        </div>

                    </div>
                </div>
            </div>



            <div id="catcontent">

            </div>
        </div>







    <script>


    function shwdets()
	    {
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
			$.ajax({
                url: '{{ route("user.allusermenuview") }}',
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
