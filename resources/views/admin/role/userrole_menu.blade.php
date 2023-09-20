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
                                <h4 class="page-title">User Role Menu Mapping</h4>
                            </div>
                        </div>




                    </div>
                </div>
            </div>

            <div id="loading-overlay"></div>
            <img id="loading-image" src="{{ asset('img/loading.gif') }}"  style="display: none; width:100px;">


            <div class="row">
                <div class="col-12">
                    <form name="frm" method="post" action="#">

                        <div class="row">

                            <div class="col-md-12 justify-content-center"><label >Users</label>
                                <select class="form-select form-control form-control-lg" name="userid"  aria-label="Default select example" id="userid" onChange="showRoleitems(this.value);" required  tabindex="2" >
                                     {{--<option value="">Select User</option>
                                        @foreach ($alluserdetails as $userdets)

                                                <option value="{{ $userdets->id }}">{{ $userdets->name.' ( '.$userdets->role_name.' )' }}</option>

                                        @endforeach --}}

                                        <option value="">Select User</option>
                                        @foreach ($alluserdetails as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name }} ({{ $user->roles }})
                                            </option>
                                        @endforeach


                                </select>
                                <label for="userid" class="error"></label>
                            </div>

                            <div class="col-md-12 justify-content-center"><label >Roles</label>

                                <ul class="metismenu left-sidenav-menu">
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach($rolesm as $row)
                                    <li>
                                        <input type="checkbox" name="roles" id="roles" onclick="checkrolee(this.value)" value="{{ $row->id }}">{{ $row->role_name }}
                                    </li>
                                    {{-- <hr class="hr hr-menu"> --}}

                                    @php
                                        $i++;
                                    @endphp
                                    @endforeach
                                </ul>
                                <input type="hidden" id="rolehidid" value="{{ $i }}">
                                <label for="roles" class="error"></label>
                            </div>

                            <div class="col-md-12 col-lg-12 d-flex justify-content-center" style="margin-top: 20px;">
                                <input type="button" id="btnsearch" name="btnsearch" class="btn btn-primary" value="Save" onClick="saveuserrolemenumap(userid.value)" />

                            </div>


                        </div>
                        <div class="col-md-12">
                            <div id="userpage-message"  class="text-center" style="display: none;"></div>
                        </div>
                    </form>
                </div>
            </div>

        </div>







    <script>




            function showRoleitems(user_id)
                {
                    //alert(user_id)
                    uid=user_id;
                    $('#loading-overlay').fadeIn();
                    $('#loading-image').fadeIn();
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '{{ route("user.getUserRoleMenu") }}',
                                type: 'POST',
                                data: {user_id:user_id,_token: csrfToken
                            },
                            success: function(data) {
                                $('#loading-image').fadeOut();
                                $('#loading-overlay').fadeOut();
                                uncheckAll();
                                var y=data.split(',');
                                var n=y.length-1;
                                var m=document.frm.roles.length;
                                var i=0;
                                var j=0;;
                                    for(i=0;i<m;i++)
                                    {
                                        for(j=0;j<n;j++)
                                        {
                                            if(document.frm.roles[i].value==y[j])
                                            {
                                                document.frm.roles[i].checked =true ;
                                            }
                                        }
                                    }
                                }
                        });

                    }
            function uncheckAll()
                {
                    var i=0;
                    for (i = 0; i < document.frm.roles.length; i++)
                        document.frm.roles[i].checked = false ;
                }
                function checkrolee(r)
                    {
                        var r=r;
                        var val=document.frm.roles[r-1].value;
                        for(var i=0;i<document.frm.roles.length;i++)
                            {
                                document.frm.roles[i].checked=false;
                            }
                                document.frm.roles[r-1].checked=true;
					}


    function shwdets()
	    {
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
			$.ajax({
                url: '{{ route("user.allrolemenuview") }}',
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



    function saveuserrolemenumap()
        {
            var userid = $('#userid').val();
            if((userid==null)||(userid==''))
            {
                alert("Select User");
                return;
            }
            var value='';
            var i=0;
            for(i=0;i<document.frm.roles.length;i++)
            {
                if(document.frm.roles[i].checked==true)
                {
                    value=value+document.frm.roles[i].value+",";
                }
            }
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
			$.ajax({
                url: '{{ route("user.userrolepagemenu") }}',
                        type: 'POST',
                        data: {user_id:userid,roles:value,_token: csrfToken
                    },
                    success: function(data) {
                        if((data.result==1))
                            {
                                $('#userpage-message').text(data.mesge).fadeIn();
                                $('#userpage-message').addClass('success-message');
                                setTimeout(function() {
                                $('#userpage-message').fadeOut();
                                }, 5000);
                                $('#loading-image').fadeOut();
                                $('#loading-overlay').fadeOut();
                            }
                        else if((data.result==2))
                            {
                                $('#userpage-message').text(data.mesge).fadeIn();
                                $('#userpage-message').addClass('error');
                                setTimeout(function() {
                                $('#userpage-message').fadeOut();
                                }, 5000);
                                $('#loading-image').fadeOut();
                                $('#loading-overlay').fadeOut();
                            }
                        }
                    });
                }











    </script>
    @endsection
