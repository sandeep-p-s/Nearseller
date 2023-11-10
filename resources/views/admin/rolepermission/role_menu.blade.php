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
                                <h4 class="page-title">Role Menu Mapping</h4>
                                {{-- <div class="col text-right">
                                    <button class="btn add_btn" data-bs-toggle="modal" data-bs-target="#addNewModal">Add New Role</button>
                                </div> --}}

                            </div>
                        </div>




                    </div>
                </div>
            </div>

            <div id="loading-overlay"></div>
            <img id="loading-image" src="{{ asset('img/loading.gif') }}" style="display: none; width:100px;">


            <div class="row">
                <div class="col-12">

                    <div class="row">

                        {{-- <div class="col-md-6 justify-content-center"><label >Roles</label>
                            <select class="form-select form-control form-control-lg" name="roleid"  aria-label="Default select example" id="roleid" onChange="showRoleMenuitems(this.value);" required  tabindex="2" >
                                <option value="">Select Role</option>
                                    @foreach ($roles as $userdets)

                                            <option value="{{ $userdets->id }}">{{ $userdets->role_name }}</option>

                                    @endforeach
                            </select>
                            <label for="roleid" class="error"></label>
                        </div> --}}


                        <div class="col-md-6 justify-content-center">
                            <input type="text" id="roleid" name="roleid" class="enterroleiddets form-control"
                                maxlength="60" placeholder="Enter Role Name" required tabindex="1"
                                onchange="showRoleMenuitems();"  />
                            <label for="roleid" class="error"></label>
                        </div>






                        {{-- <div class="col-md-12 col-lg-12 d-flex justify-content-center" style="margin-top: 20px;">
                          <input type="button" id="btnsearch" name="btnsearch" class="btn btn-primary" value="Search" onClick="showRoleMenuitems(roleid.value)" />

                        </div> --}}

                    </div>
                </div>
            </div>



            <div id="catcontent">

            </div>
        </div>







        <script>
            $(document).ready(function() {
                var url = "{{ route('NewRoleNameSearch') }}";
                $('#roleid').autocomplete({
                    source: function(request, response) {
                        $.post(url, {
                            rolename: request.term
                        }, function(data) {
                            var options = [];
                            if (data.length > 0) {
                                data.forEach(function(rolesdets) {
                                    var optionText = rolesdets.role_name;
                                    options.push({
                                        value: optionText,
                                        label: optionText,
                                        id: rolesdets.id
                                    });
                                });
                            }
                            response(options);
                        }, 'json');
                    },
                    minLength: 1,
                    select: function(event, ui) {
                        $('#selectedRoleId').val(ui.item.id);
                    }
                });
            });

            function shwdets() {
                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('user.allrolepermenuview') }}',
                    type: 'GET',
                    data: {
                        _token: csrfToken
                    },
                    success: function(data) {
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
    @endsection
