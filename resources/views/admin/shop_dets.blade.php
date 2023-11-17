@php
    $roleid = session('roleid');
    $roleIdsArray = explode(',', $roleid);
@endphp
@if (in_array('2', $roleIdsArray) || in_array('9', $roleIdsArray))

    @if ($sellerCount > 0)

        @foreach ($sellerDetails as $indexh => $sellerDetailh)
            @php
                //$open_close_time = $sellerDetails->open_close_time;
                $open_close_time = $sellerDetailh->open_close_time;
                if ($open_close_time == '' || $open_close_time == 'NULL') {
                    $opentime = '';
                    $closetime = '';
                } else {
                    $expldopenclose = explode('-', $open_close_time);
                    $opentime = $expldopenclose[0];
                    $closetime = $expldopenclose[1];
                }

                $gallery_dets = $sellerDetailh->shop_photo;
                $qrgallerydetsarray = json_decode($gallery_dets);
                $qrgallery = $qrgallerydetsarray->fileval;
                $qrqrgalleryval = json_decode(json_encode($qrgallery), true);
                $totimg = count($qrqrgalleryval);

                $socialmedia = $sellerDetailh->socialmedia;
                $qrsocialmediaarray = json_decode($socialmedia);
                $qrsocialmedia = $qrsocialmediaarray->mediadets;
                $qrsocialmediaval = json_decode(json_encode($qrsocialmedia), true);

                $sel_approved = $sellerDetailh->seller_approved;
                $userstatus = $sellerDetailh->user_status;
                $executivesm = $sellerDetailh->shop_executive;
            @endphp
            @if ($sellerDetailh->seller_approved != 'Y')
                <div class="col text-right">
                    <a class="btn add_btn" href="#"
                        onclick="shopvieweditdet({{ $sellerDetailh->id }},{{ $typeid }})">Edit Details</a>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="dastyle-profile">
                                <div class="row">
                                    <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                                        <div class="dastyle-profile-main">
                                            <div class="dastyle-profile-main-pic">
                                                @if ($totimg > 0)
                                                    <img src="{{ asset($qrgallery[0]) }}" alt="" height="110"
                                                        class="rounded-circle">
                                                @endif

                                            </div>
                                            <div class="dastyle-profile_user-detail">
                                                <h5 class="dastyle-user-name">{{ $shoporservice }} :
                                                    {{ $sellerDetailh->shop_name }}</h5>
                                                <p class="mb-0 dastyle-user-name-post">{{ $shoporservice }} Owner :
                                                    {{ $sellerDetailh->owner_name }}</p>
                                            </div>
                                        </div>
                                    </div><!--end col-->

                                    <div class="col-lg-4 ml-auto align-self-center">
                                        <ul class="list-unstyled personal-detail mb-0">
                                            <li class=""><b> Phone </b> :
                                                {{ $sellerDetailh->mob_country_code . '' . $sellerDetailh->shop_mobno }}
                                            </li>
                                            @if ($sellerDetailh->shop_email != '')
                                                <li class="mt-2"> <b> Email </b> : {{ $sellerDetailh->shop_email }}
                                                </li>
                                            @endif

                                            <li class="mt-2"> <b> Address </b> :
                                                {{ $sellerDetailh->house_name_no . ',' . $sellerDetailh->locality . ',' . $sellerDetailh->village . ',' . $sellerDetailh->pincode . ',' . $sellerDetailh->district_name . ',' . $sellerDetailh->state_name . ',' . $sellerDetailh->country_name }}
                                            </li>
                                        </ul>

                                    </div><!--end col-->
                                    <div class="col-lg-4 align-self-center">

                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h4 class="card-title">Social Profile</h4>
                                                    </div><!--end col-->
                                                </div> <!--end row-->
                                            </div><!--end card-header-->
                                            @php
                                                $qrsocialmediaval = json_decode(json_encode($qrsocialmedia), true);
                                                $mediaUrlcnt = count($qrsocialmedia);
                                            @endphp

                                            @if ($mediaUrlcnt > 0)
                                                <div class="card-body">
                                                    <div class="button-list btn-social-icon">
                                                        @foreach ($qrsocialmediaval as $mediaItem)
                                                            @php
                                                                $titurl = '';
                                                                $media = '';
                                                                switch ($mediaItem['mediatype']) {
                                                                    case 1:
                                                                        $titurl = 'facebook';
                                                                        $media = '<i class="fab fa-facebook-f" style="font-size: 25px;"></i>';
                                                                        break;
                                                                    case 2:
                                                                        $titurl = 'instagram';
                                                                        $media = '<i class="fab fa-instagram" style="font-size: 25px;"></i>';
                                                                        break;
                                                                    case 3:
                                                                        $titurl = 'linkedin';
                                                                        $media = '<i class="fa-brands fa-linkedin" style="font-size: 25px;"></i>';
                                                                        break;
                                                                    case 4:
                                                                        $titurl = 'website';
                                                                        $media = '<i class="fa fa-globe" style="font-size: 25px;"></i>';
                                                                        break;
                                                                    case 5:
                                                                        $titurl = 'youtube';
                                                                        $media = '<i class="fa-brands fa-youtube" style="font-size: 25px;"></i>';
                                                                        break;
                                                                }
                                                            @endphp

                                                            @if (!empty($mediaItem['mediaurl']))
                                                                <a href="{{ $mediaItem['mediaurl'] }}"
                                                                    class="btn btn-primary" target="_blank"
                                                                    title="{{ $titurl }}">
                                                                    {!! $media !!}
                                                                </a>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end f_profile-->
                        </div><!--end card-body-->
                    </div> <!--end card-->
                </div><!--end col-->
            </div><!--end row-->

            <div class="row">
                <div class="col-lg-6 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title">{{ $shoporservice }} Information</h4>
                                </div><!--end col-->
                            </div> <!--end row-->
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-xl-6 col-lg-6 ">Business Type</label>
                                <div class="col-lg-6 col-xl-6">
                                    <p>{{ $sellerDetailh->business_name }} </p>
                                </div>
                            </div>
                            @if ($sellerDetailh->service_category_name != '')
                                <div class="form-group row">
                                    <label class="col-xl-6 col-lg-6 ">{{ $shoporservice }} category Type </label>
                                    <div class="col-lg-6 col-xl-6">
                                        <p>{{ $sellerDetailh->service_category_name }}</p>
                                    </div>
                                </div>
                            @endif
                            @if ($sellerDetailh->service_name != '')
                                <div class="form-group row">
                                    <label class="col-xl-6 col-lg-6 ">{{ $shoporservice }} Type</label>
                                    <div class="col-lg-6 col-xl-6">
                                        <p>{{ $sellerDetailh->service_name }}</p>
                                    </div>
                                </div>
                            @endif
                            @if ($executivesm == '0' || $executivesm == '')
                            @else
                                <div class="form-group row">
                                    <label class="col-xl-6 col-lg-6 ">{{ $shoporservice }} Executive Name</label>
                                    <div class="col-lg-6 col-xl-6">
                                        <p> {{ $executives->name }}</p>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row">
                                {{-- <label class="col-xl-3 col-lg-3 ">{{ $shoporservice }} Open and Close Time</label> --}}
                                <div class="col-lg-12 col-xl-12">
                                    <p>
                                        @if ($shopavailable->count() > 0)
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Days</th>
                                                        <th>Open Time</th>
                                                        <th>Close Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($shopavailable as $openclosetime)
                                                        <tr>
                                                            <td>{{ $openclosetime->open_close_days }}</td>
                                                            <td>{{ $openclosetime->from_time }}</td>
                                                            <td>{{ $openclosetime->to_time }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <table>
                                                <tr>
                                                    <td colspan="3" align="center"><b class="error">Not Found Open
                                                            and Close Time</b></td>
                                                </tr>
                                            </table>
                                        @endif
                                    </p>
                                </div>
                            </div>





                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title">{{ $shoporservice }} Information</h4>
                                </div><!--end col-->
                            </div> <!--end row-->
                        </div><!--end card-header-->
                        <div class="card-body">
                            @if ($sellerDetailh->shop_licence != '')
                                <div class="form-group row">
                                    <label class="col-xl-6 col-lg-6 ">{{ $shoporservice }} License Number</label>
                                    <div class="col-lg-6 col-xl-6">
                                        <p>{{ $sellerDetailh->shop_licence }}</p>
                                    </div>
                                </div>
                            @endif
                            @if ($sellerDetailh->shop_gstno != '')
                                <div class="form-group row">
                                    <label class="col-xl-6 col-lg-6 ">GST Number</label>
                                    <div class="col-lg-6 col-xl-6">
                                        <p>{{ $sellerDetailh->shop_gstno }}</p>
                                    </div>
                                </div>
                            @endif
                            @if ($sellerDetailh->shop_panno != '')
                                <div class="form-group row">
                                    <label class="col-xl-6 col-lg-6 ">PAN Number</label>
                                    <div class="col-lg-6 col-xl-6">
                                        <p> {{ $sellerDetailh->shop_panno }}</p>
                                    </div>
                                </div>
                            @endif
                            @if ($sellerDetailh->establish_date != '')
                                <div class="form-group row">
                                    <label class="col-xl-6 col-lg-6 ">Establishment Date</label>
                                    <div class="col-lg-6 col-xl-6">
                                        <p>{{ date('d-m-Y', strtotime($sellerDetailh->establish_date)) }}</p>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row">
                                <label class="col-xl-6 col-lg-6 ">Registration Date</label>
                                <div class="col-lg-6 col-xl-6">
                                    <p>{{ date('d-m-Y H:i:s', strtotime($sellerDetailh->created_at)) }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-6 col-lg-6 ">Accept Terms & Conditions</label>
                                <div class="col-lg-6 col-xl-6">
                                    <p><span
                                            class="badge  p-2 {{ $sellerDetailh->term_condition == '1' ? 'badge badge-success' : 'badge badge-danger' }}">
                                            {{ $sellerDetailh->term_condition == '1' ? 'Accepted' : 'No' }}
                                        </span></p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-6 col-lg-6 ">Active Status</label>
                                <div class="col-lg-6 col-xl-6">
                                    <p> <span
                                            class="badge  p-2 {{ $sellerDetailh->user_status === 'Y' ? 'badge badge-success' : 'badge badge-danger' }}">
                                            {{ $sellerDetailh->user_status === 'Y' ? 'Active' : 'Inactive' }}
                                        </span></p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-6 col-lg-6 ">Approved Status</label>
                                <div class="col-lg-6 col-xl-6">
                                    <p><span
                                            class="badge  p-2 {{ $sellerDetailh->seller_approved === 'Y' ? 'badge badge-success' : 'badge badge-danger' }}">
                                            {{ $sellerDetailh->seller_approved === 'Y' ? 'Approved' : 'Not Approved' }}
                                        </span></p>
                                </div>
                            </div>


                        </div>
                    </div>
                </div> <!--end col-->

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title">{{ $shoporservice }} Images</h4>
                                </div><!--end col-->
                            </div> <!--end row-->
                        </div><!--end card-header-->
                        <div class="card-body">

                            <div class="col-md-12">
                                <div class="form-group" align="center">
                                    <div class="row">
                                        @for ($m = 0; $m < $totimg; $m++)
                                            <div class="col-md-3">
                                                <a href="#" data-toggle="modal"
                                                    data-target="#myModalm{{ $m }}">
                                                    <img id="img-bufferm" class="img-responsive image"
                                                        style="padding: 2px;  width: 277px; margin: 1px;"
                                                        src="{{ asset($qrgallery[$m]) }}" width="450"
                                                        height="250">
                                                    @php
                                                        $valenm = $qrgallery[$m] . '#' . $sellerDetailh->id;
                                                        $deleencdem = base64_encode($valenm);
                                                    @endphp
                                                </a>
                                                <br>
                                                {{-- @if (!($sel_approved == 'Y' && ($roleid == 3 || $roleid == 2))) --}}
                                                {{-- @if (!($sel_approved == 'Y'))
                                                    <button id="remv" type="button" name="remv"
                                                        class="btn btn-danger"
                                                        onClick="DeltImagGalry('{{ $deleencdems }}');">Remove</button>
                                                @endif --}}
                                            </div>

                                            <div class="modal fade" id="myModalm{{ $m }}" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                                style="width: 80%;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close"
                                                                data-dismiss="modal"
                                                                aria-hidden="true">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="{{ asset($qrgallery[$m]) }}" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        @endforeach

    @endif

@endif



@if (in_array('1', $roleIdsArray) || in_array('11', $roleIdsArray))

    @if ($sellerCount > 0)
        @if (session('roleid') == '1' || session('roleid') == '11')
            <div class="text-center">
                <span class="badge badge-soft-info p-2">
                    Total Active {{ $shoporservice }} : {{ $activecounts->user_status_y_count }}
                </span>
                <span class="badge badge-soft-danger p-2">
                    Total Inactive {{ $shoporservice }} : {{ $activecounts->user_status_not_y_count }}
                </span>
                <span class="badge badge-soft-info p-2">
                    Total Approved {{ $shoporservice }} : {{ $activecounts->approved_y_count }}
                </span>
                <span class="badge badge-soft-danger p-2">
                    Total Not Approved {{ $shoporservice }} : {{ $activecounts->approved_not_y_count }}
                </span>
            </div>
        @endif


        <table id="datatable3" class="table table-striped table-bordered" style="width: 100%">

            <thead>
                <tr>
                    @if (session('roleid') == '1' || session('roleid') == '11')
                        {{-- <th width="5px"><input type='checkbox' name='checkbox1' id='checkbox1'
                                onclick='check();' /> --}}

                        <th width="5px" data-sorting="true" class="checkboxcol"><input type='checkbox'
                                name='checkbox1' id='checkbox1' class="selectAll" onclick='' />
                        </th>


                        <th>S.No.</th>
                    @endif
                    {{--  <th>Reg. ID</th>  --}}
                    <th>{{ $shoporservice }} Name</th>
                    <th>{{ $shoporservice }} Type</th>
                    <th>Owner Name</th>
                    {{-- <th>{{ $shoporservice }} Type</th> --}}
                    {{--  <th>Mobile</th>  --}}
                    {{-- <th>Business Type</th> --}}
                    <th>Active Status</th>
                    <th>Approval Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sellerDetails as $index => $sellerDetail)
                    <tr>
                        @if (session('roleid') == '1' || session('roleid') == '11')
                            <td class="checkboxcol"><input name="shopid[]" type="checkbox"
                                    id="shopid{{ $index + 1 }}"
                                    value="{{ $sellerDetail->id . '*' . $sellerDetail->user_id }}"
                                    {{ $sellerDetail->seller_approved === 'Y' ? '' : '' }} />
                            </td>
                            <td>{{ $index + 1 }}</td>
                        @endif
                        {{--  <td>{{ $typeid == 1 ? 'SHOP' : ($typeid == 2 ? 'SER' : '') }}{{ str_pad($sellerDetail->shop_reg_id, 9, '0', STR_PAD_LEFT) }}
                        </td>  --}}
                        <td>{{ $sellerDetail->shop_name }}</td>
                        <td>{{ $sellerDetail->service_name }} </td>
                        <td>{{ $sellerDetail->owner_name }}</td>
                        {{-- <td>{{ $sellerDetail->service_name }}</td> --}}
                        {{--  <td>{{ $sellerDetail->mob_country_code.''.$sellerDetail->shop_mobno }}</td>  --}}
                        {{-- <td class="text-success">{{ $sellerDetail->business_name }}</td> --}}
                        <td>
                            @if ($sellerDetail->user_status == 'Y')
                                @php
                                    $userstatus = 'Active';
                                @endphp
                            @else
                                @php
                                    $userstatus = 'Inctive';
                                @endphp
                            @endif

                            {{-- <span
                                class="badge p-2 {{ $sellerDetail->user_status === 'Y' ? 'badge badge-success' : 'badge badge-danger' }}">
                                {{ $sellerDetail->user_status === 'Y' ? 'Active' : 'Inactive' }}
                            </span> --}}
                            {{ $userstatus }}
                        </td>
                        <td>
                            @if ($sellerDetail->seller_approved == 'Y')
                                @php
                                    $approvedstatus = 'Approved';
                                @endphp
                            @else
                                @php
                                    $approvedstatus = 'Not Approved';
                                @endphp
                            @endif


                            {{-- <span
                                class="badge p-2 {{ $sellerDetail->seller_approved === 'Y' ? 'badge badge-info' : 'badge badge-danger' }}">
                                {{ $sellerDetail->seller_approved === 'Y' ? 'Approved' : 'Not Approved' }}
                            </span> --}}

                            {{ $approvedstatus }}
                        </td>


                        <td>
                            <div class="btn-group mb-2 mb-md-0">
                                <button type="button" class="btn view_btn dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">Action
                                    <i class="mdi mdi-chevron-down"></i></button>
                                <div class="dropdown-menu">
                                    @if (session('roleid') == '1' || session('roleid') == '11')
                                        <a class="dropdown-item view_btn1 d-none" id="viewbtn" href="#"
                                            onclick="shopvieweditdet({{ $sellerDetail->id }},{{ $typeid }})">View/Edit</a>
                                        <a class="dropdown-item approve_btn" href="#"
                                            onclick="shopapprovedet({{ $sellerDetail->id }},{{ $typeid }})">Activation/Approval</a>
                                        <a class="dropdown-item delete_btn" href="#"
                                            onclick="shopdeletedet({{ $sellerDetail->id }})">Delete</a>
                                    @else
                                        <a class="dropdown-item view_btn1" href="#"
                                            onclick="shopvieweditdet({{ $sellerDetail->id }},{{ $typeid }})">View/Edit</a>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        <input type="hidden" value="{{ $index + 1 }}" id="totalshopcnt">
        {{-- <div class="pagination">
        {{ $sellerDetails->links() }}
    </div> --}}
    @else
        <table>
            <tr>
                <td colspan="13" align="center">
                    <img src="{{ asset('backend/assets/images/notfoundimg.png') }}" alt="notfound"
                        class="rounded-circle" style="width: 30%;" />
                </td>
            </tr>
        </table>
    @endif

    @if ($sellerCount > 0)
        @if (session('roleid') == '1' || session('roleid') == '11')
            <div class="col text-center">
                <button class="btn btn-primary" style="cursor:pointer" onclick="seller_service_approvedall();"
                    id="approveAllBtn">Approve
                    All</button>
            </div>
        @endif
    @endif



    <!-- Modal Add New -->
    <div class="modal fade p-5" id="addNewModal" tabindex="-1" aria-labelledby="addNewModalLabel"
        aria-hidden="true" style="overflow-y: scroll;">
        <div class="modal-dialog custom-modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="addNewModalLabel">Add New {{ $shoporservice }} </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        title="Close">x</button>
                </div>
                <div class="modal-body">


                    <form id="SellerRegForm" enctype="multipart/form-data" method="POST">
                        <input type="hidden" id="typeidhid" name="typeidhid" value="{{ $typeid }}" />
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-outline mb-3"><label>{{ $shoporservice }} Name<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="s_name" name="s_name"
                                            class="form-control form-control-lg" maxlength="50"
                                            placeholder="{{ $shoporservice }} Name" required tabindex="1"
                                            onchange="exstshopname(this.value,'1')" />
                                        <div for="s_name" class="error"></div>
                                        <div id="existshopname-message" class="text-center" style="display: none;">
                                        </div>
                                    </div>

                                    <div class="form-outline mb-3"><label>Owner Name<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="s_ownername" name="s_ownername"
                                            class="form-control form-control-lg" maxlength="50"
                                            placeholder="Owner Name" required tabindex="2" />
                                        <div for="s_ownername" class="error"></div>
                                    </div>
                                    <label>Mobile Number<span class="text-danger">*</span></label>
                                    <div class="form-outline mb-3 d-flex">
                                        <select name="s_mobcntrycode" id="s_mobcntrycode" class="form-control"
                                            style="width: 20%;" required>
                                            <option value="+91">+91</option>
                                        </select>
                                        <input type="text" id="s_mobno" name="s_mobno"
                                            class="form-control form-control-lg" maxlength="10"
                                            placeholder="Mobile No" required tabindex="3"
                                            onchange="exstmobno(this.value,'2')" oninput="numberOnlyAllowed(this)" />
                                        <div for="s_mobno" class="error"></div>
                                        <div id="smob-message" class="text-center" style="display: none;"></div>
                                    </div>
                                    <div class="form-outline mb-3"><label>Email ID</label>
                                        <input type="email" id="s_email" name="s_email"
                                            class="form-control form-control-lg" maxlength="35"
                                            placeholder="Email ID" tabindex="4"
                                            onchange="exstemilid(this.value,'2')"
                                            pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" />
                                        <div for="s_email" class="error"></div>
                                        <div id="semil-message" class="text-center" style="display: none;"></div>
                                    </div>
                                    <div class="form-outline mb-3"><label>Referral ID</label>
                                        <input type="text" id="s_refralid" name="s_refralid"
                                            class="form-control form-control-lg" maxlength="50"
                                            placeholder="Referral ID" tabindex="5"
                                            onchange="checkrefrelno(this.value,'1')" />
                                        <div id="s_refralid-message" class="text-center" style="display: none;">
                                        </div>
                                    </div>
                                    <div class="form-outline mb-3" style="display: none;"><label>Business Type<span
                                                class="text-danger">*</span></label>
                                        <select class="form-select form-control form-control-lg" id="s_busnestype"
                                            name="s_busnestype" required tabindex="6">
                                            @foreach ($business as $busnes)
                                                <option value="{{ $busnes->id }}">
                                                    {{ $busnes->business_name }}</option>
                                            @endforeach
                                        </select>
                                        <div for="s_busnestype" class="error"></div>
                                    </div>
                                    <div class="form-outline mb-3"><label>Business Category<span
                                                class="text-danger">*</span></label>
                                        <select class="form-select form-control form-control-lg" id="s_shopservice"
                                            name="s_shopservice" required tabindex="7">
                                            <option value="">Business Category</option><br />
                                            @foreach ($shopservicecategory as $shopser)
                                                <option value="{{ $shopser->id }}">
                                                    {{ $shopser->service_category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div for="s_shopservice" class="error"></div>
                                    </div>




                                    {{-- <div class="form-outline mb-3"><label>{{ $shoporservice }} Sub Category</label>
                                    <select class="form-select form-control form-control-lg" id="s_subshopservice"
                                        name="s_subshopservice" required tabindex="7">
                                        <option value="">{{ $shoporservice }} Sub Category</option><br />

                                    </select>
                                    <label for="s_subshopservice" class="error"></label>
                                </div> --}}


                                    <div class="form-outline mb-3"><label>{{ $shoporservice }} Provider Type<span
                                                class="text-danger">*</span></label>
                                        <select class="form-select form-control form-control-lg"
                                            id="s_shopservicetype" name="s_shopservicetype" required tabindex="7">
                                            <option value="">{{ $shoporservice }} Provider Type</option><br />
                                            @foreach ($shopservice as $shtypes)
                                                <option value="{{ $shtypes->id }}">{{ $shtypes->service_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div for="s_shopservicetype" class="error"></div>
                                    </div>


                                    <div class="form-outline mb-3"><label>{{ $shoporservice }} Executive Name</label>
                                        <select class="form-select form-control form-control-lg" id="s_shopexectename"
                                            name="s_shopexectename" tabindex="8">
                                            <option value="">{{ $shoporservice }} Executive Name</option><br />
                                            @foreach ($executives as $exec)
                                                <option value="{{ $exec->id }}">{{ $exec->name }}</option>
                                            @endforeach
                                        </select>
                                        <div for="s_shopexectename" class="error"></div>
                                    </div>

                                    <div class="form-outline mb-3"><label>Social Media</label>
                                        <div class="row mb-5">
                                            <div class="col-md-3 fv-row fv-plugins-icon-container">
                                                <select class="form-select form-control form-control-lg"
                                                    id="mediatype" name="mediatype[1]" tabindex="21">
                                                    <option value="">Choose...</option>
                                                    <option value="1">Facebook</option>
                                                    <option value="2">Instagram</option>
                                                    <option value="3">Linked In</option>
                                                    <option value="4">Web site URL</option>
                                                    <option value="5">Youtub Video URL</option>
                                                </select>
                                            </div>

                                            <div class="col-md-9 fv-row fv-plugins-icon-container">
                                                <div class="input-group">
                                                    <input type="url" id="mediaurl" name="mediaurl[1]"
                                                        class="form-control form-control-lg" placeholder="https://"
                                                        value="" tabindex="22" maxlength="60" />
                                                    <div align="right">
                                                        <a href="#" id="addMoreurls" name="add_fieldurl"
                                                            class="btn icon btn-success">+</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="addedUrls"></div>
                                    </div>
                                </div>

                                <div class="col-md-4">

                                    <div class="form-outline mb-3"><label>Building/House Name & Number<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="s_buldingorhouseno" name="s_buldingorhouseno"
                                            maxlength="100" class="form-control form-control-lg"
                                            placeholder="Building/House Name & Number" required tabindex="11" />
                                        <div for="s_buldingorhouseno" class="error"></div>
                                    </div>
                                    <div class="form-outline mb-3"><label>Locality<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="s_locality" name="s_locality" maxlength="100"
                                            class="form-control form-control-lg"placeholder="Locality" required
                                            tabindex="12" />
                                        <div for="s_locality" class="error"></div>
                                    </div>
                                    <div class="form-outline mb-3"><label>Village/Town/Municipality<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="s_villagetown" name="s_villagetown"
                                            maxlength="100" class="form-control form-control-lg"
                                            placeholder="Village/Town/Municipality" required tabindex="13" />
                                        <div for="s_villagetown" class="error"></div>
                                    </div>
                                    <div class="form-outline mb-3"><label>Country<span
                                                class="text-danger">*</span></label>
                                        <select class="form-select form-control form-control-lg" name="country"
                                            aria-label="Default select example" id="country" required
                                            tabindex="14">
                                            <option value="">Select country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->country_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div for="country" class="error"></div>
                                    </div>
                                    <div class="form-outline mb-3"><label>State<span
                                                class="text-danger">*</span></label>
                                        <select class="form-select form-control form-control-lg" name="state"
                                            aria-label="Default select example" id="state" required
                                            tabindex="15">

                                        </select>
                                        <div for="state" class="error"></div>
                                    </div>
                                    <div class="form-outline mb-3"><label>District<span
                                                class="text-danger">*</span></label>
                                        <select class="form-select form-control form-control-lg"
                                            aria-label="Default select example" id="district" name="district"
                                            required tabindex="16">

                                        </select>
                                        <div for="district" class="error"></div>
                                    </div>
                                    <div class="form-outline mb-3"><label>Pincode<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="s_pincode" name="s_pincode" maxlength="6"
                                            class="form-control form-control-lg" placeholder="Pin Code" required
                                            tabindex="17" oninput="numberOnlyAllowed(this)" />
                                        <div for="s_pincode" class="error"></div>
                                    </div>


                                    <div class="form-outline mb-3"><label>Latitude (Google map location)<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="s_googlelatitude" name="s_googlelatitude"
                                            class="form-control form-control-lg"
                                            placeholder="Latitude (Google map location)" required tabindex="18"
                                            pattern="^-?([1-8]?\d(\.\d{1,6})?|90(\.0{1,6})?)" />
                                        <div for="s_googlelatitude" class="error"></div>
                                    </div>



                                    <div class="form-outline mb-3"><label>Longitude (Google map location)<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="s_googlelongitude" name="s_googlelongitude"
                                            class="form-control form-control-lg"
                                            placeholder="Longitude (Google map location)" required tabindex="18"
                                            pattern="^-?([1-8]?\d(\.\d{1,6})?|90(\.0{1,6})?)" />
                                        <div for="s_googlelongitude" class="error"></div>
                                    </div>



                                    <div class="form-outline mb-3"><label>{{ $shoporservice }} Photo's<span
                                                class="text-danger">*</span></label>
                                        <input type="file" id="s_photo" multiple="" name="s_photo[]"
                                            class="form-control form-control-lg" placeholder="Shop Photo" required
                                            tabindex="19" accept="image/jpeg, image/png" />
                                        <div for="s_photo" class="error"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group" align="left">
                                            <div id="image-preview" class="row"></div>
                                        </div>
                                    </div>

                                    <div class="form-outline mb-3"><label>{{ $shoporservice }} Logo</label>
                                        <input type="file" id="s_logo" name="s_logo[]"
                                            class="form-control form-control-lg" placeholder="Shop Logo"
                                            tabindex="19" accept="image/jpeg, image/png" />
                                        <div for="s_logo" class="error"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group" align="left">
                                            <div id="image-preview-logo" class="row"></div>
                                        </div>
                                    </div>
                                    <div class="form-outline mb-3" style="display: none;"><label>{{ $shoporservice }}
                                            Background Color</label>
                                        <input type="color" id="s_bgcolor" name="s_bgcolor" id
                                            class="form-control" placeholder="{{ $shoporservice }} Background Color"
                                            required tabindex="18" />
                                        <div for="s_bgcolor" class="error"></div>
                                    </div>

                                </div>
                                <div class="col-md-4">

                                    <div class="form-outline mb-3"><label>{{ $shoporservice }} License Number</label>
                                        <input type="text" id="s_lisence" name="s_lisence"
                                            class="form-control form-control-lg" maxlength="15"
                                            placeholder="{{ $shoporservice }} License Number" tabindex="10"
                                            pattern="^[A-Z0-9/&._%+-]+$" />
                                        <div for="s_lisence" class="error"></div>
                                    </div>

                                    <div class="form-outline mb-3"><label>GST Number</label>
                                        <input type="text" id="s_gstno" name="s_gstno" maxlength="15"
                                            class="form-control form-control-lg" placeholder="GST Number"
                                            tabindex="20" />
                                        <div for="s_gstno" class="error"></div>
                                        <div id="gst-error-message" style="color: red;"></div>
                                    </div>
                                    <div class="form-outline mb-3"><label>PAN Number</label>
                                        <input type="text" id="s_panno" name="s_panno" maxlength="10"
                                            class="form-control form-control-lg" placeholder="PAN Number"
                                            tabindex="21" />
                                        <div for="s_panno" class="error"></div>
                                        {{-- <div id="pan-error-message" style="color: red;"></div> --}}
                                    </div>


                                    <div class="form-outline mb-3"><label> Establishment Date @if ($typeid == 1)
                                                <span class="text-danger">*</span>
                                            @endif
                                        </label>
                                        <input type="date" id="s_establishdate" name="s_establishdate"
                                            maxlength="10" class="form-control form-control-lg"
                                            placeholder="Establishment Date" tabindex="22"
                                            max="{{ date('Y-m-d') }}" />
                                        <div for="s_establishdate" class="error"></div>
                                    </div>





                                    {{-- <div class="form-outline mb-3">
                                    <label>Open Time</label>
                                    <div class="input-group date" id="from-time-picker" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#from-time-picker" id="opentime" name="opentime" required
                                            maxlength="20" data-format="ddd hh:mm A" />
                                        <div class="input-group-append" data-target="#from-time-picker"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                        </div>
                                        <label for="opentime" class="error"></label>
                                    </div>
                                </div>

                                <div class="form-outline mb-3">
                                    <label>Close Time</label>
                                    <div class="input-group date" id="to-time-picker" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#to-time-picker" id="closetime" name="closetime" required
                                            maxlength="20" data-format="ddd hh:mm A" />
                                        <div class="input-group-append" data-target="#to-time-picker"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                        </div>
                                        <label for="closetime" class="error"></label>
                                    </div>
                                </div> --}}




                                    <div class="form-group">
                                        <fieldset>
                                            <div class="repeater-default-timem">
                                                <div data-repeater-list="availabletime_datam">
                                                    <!-- Heading Row -->
                                                    <div class="form-group row">
                                                        <div class="col-md-2">
                                                            <label class="control-label"> Status </label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="control-label"> Day </label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="control-label"> From Time </label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="control-label"> To Time </label>
                                                        </div>
                                                    </div>
                                                    <!-- Dynamic Rows -->
                                                    <div data-repeater-item="">
                                                        <div class="form-group row ">
                                                            <div class="col-md-2">
                                                                <input class="form-control" type="checkbox"
                                                                    id="settimestatusm" name="settimestatusm"
                                                                    value="1" style="width: 20%;">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select id="setdaysm" name="setdaysm"
                                                                    class="day-select form-control">
                                                                    <option value="Sunday">Sunday</option>
                                                                    <option value="Monday">Monday</option>
                                                                    <option value="Tuesday">Tuesday</option>
                                                                    <option value="Wednesday">Wednesday</option>
                                                                    <option value="Thursday">Thursday</option>
                                                                    <option value="Friday">Friday</option>
                                                                    <option value="Saturday">Saturday</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input type="text" id="setfrom_timem"
                                                                    name="setfrom_timem"
                                                                    class="form-control timepicker-input">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input type="text" id="setto_timem"
                                                                    name="setto_timem"
                                                                    class="form-control timepicker-input">
                                                            </div>
                                                            <div class="col-md-1">
                                                                <span data-repeater-delete=""
                                                                    class="btn btn-danger btn-sm">
                                                                    <span class="far fa-trash-alt mr-1"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0 row">
                                                    <div class="col-sm-12 text-right">
                                                        <span data-repeater-create=""
                                                            class="btn btn-secondary btn-sm">
                                                            <span class="fas fa-plus"></span> Add New Time
                                                        </span>
                                                        {{-- @if (session('roleid') == 1) --}}
                                                        <button type="button" id="addSameTiming"
                                                            class="btn btn-primary btn-sm">
                                                            Add Same Timing for All Days
                                                        </button>
                                                        {{-- @endif --}}

                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>







                                    {{-- <div class="form-outline mb-3"><label> Registration Date</label>
                                    <input type="date" id="s_registerdate" name="s_registerdate" maxlength="10"
                                        class="form-control form-control-lg" placeholder="Registration Date"
                                        tabindex="24" maxlength="10" />
                                    <label for="s_registerdate" class="error"></label>
                                </div> --}}

                                    {{-- <div class="form-outline mb-3"><label>Manufactoring Details</label>
                                    <textarea id="manufactringdets" name="manufactringdets" placeholder="Manufactoring Details"
                                        class="form-control form-control-lg" tabindex="25" required></textarea>
                                    <label for="manufactringdets" class="error"></label>
                                </div> --}}

                                    <div class="form-outline mb-3"><label>Direct Affiliate</label>
                                        <input type="text" class="form-control form-control-lg" id="directafflte"
                                            name="directafflte">
                                        <div for="directafflte" class="error"></div>
                                    </div>

                                    <div class="form-outline mb-3"><label>Second Affiliate</label>
                                        <input type="text" class="form-control form-control-lg" id="secondafflte"
                                            name="secondafflte">
                                        <div for="secondafflte" class="error"></div>
                                    </div>

                                    <div class="form-outline mb-3"><label>Co-Ordinator</label>
                                        <input type="text" class="form-control form-control-lg" id="coordinater"
                                            name="coordinater">
                                        <div for="coordinater" class="error"></div>
                                    </div>

                                    @php
                                        $requiredval = session('roleid') == '1' || session('roleid') == '11' ? '' : 'required';
                                    @endphp
                                    @if (session('roleid') == '1' || session('roleid') == '11')
                                    @else
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="s_termcondtn"
                                                name="s_termcondtn" value="1" tabindex="26"
                                                {{ $requiredval }}>
                                            <label class="inlineCheckbox1" for="s_termcondtn"> Accept Terms &
                                                Conditions
                                                {{-- <span class="text-danger">*</span> --}}
                                            </label>
                                        </div>
                                    @endif

                                </div>


                                <div class="col-md-12">
                                    <div style="float:right">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-danger" id="resetButton">Reset</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div id="shopreg-message" class="text-center" style="display: none;"></div>
                                </div>


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>




    </div>

    </div>
    </div>
    </div>
    <!-- Modal Add new Close -->







    <!-- Modal Add New -->
    <div class="modal fade" id="UploadShopModal" tabindex="-1" aria-labelledby="UploadShopModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="UploadShopModalLabel">Upload Shops Details </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        title="Close">x</button>
                </div>
                <div class="modal-body">
                    <form id="UploadSellerRegForm" enctype="multipart/form-data" method="POST">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-outline mb-3"><label>Upload File</label>
                                        <input type="file" id="shopupload" name="shopupload"
                                            class="form-control form-control-lg" placeholder="Upload File"
                                            accept=".csv" required tabindex="1" />
                                        <label for="shopupload" class="error"></label>
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <div style="float:right">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div id="shopupload-message" class="text-center" style="display: none;"></div>
                                </div>


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>




    </div>

    </div>
    </div>
    </div>
    <!-- Modal Add new Close -->

@endif


<script>
    $(document).ready(function() {
        var currentPageUrl = window.location.href;

        if (currentPageUrl.includes("/shopapprovals/")) {
            $("#viewbtn").addClass("d-none");
            $(".approve_btn, .delete_btn").removeClass("d-none");
        } else if (currentPageUrl.includes("/shopapprovalsadd/")) {
            $("#viewbtn").removeClass("d-none");
            $(".approve_btn").addClass("d-none");
        }
    });
    $(document).ready(function() {
        var currentPageUrl = window.location.href;

        // Check if the current page is the "shopapprovals/" page
        if (currentPageUrl.includes("/shopapprovals/")) {
            // On the "shopapprovals/" page, show checkbox columns and approve all button
            $(".checkboxcol").removeClass("d-none");
            $("#approveAllBtn").removeClass("d-none");
        } else if (currentPageUrl.includes("/shopapprovalsadd/")) {
            // On the "shopapprovalsadd/" page, hide checkbox columns and approve all button
            $(".checkboxcol").addClass("d-none");
            $("#approveAllBtn").addClass("d-none");
        }
    });

    function numberOnlyAllowed(inputElement) {
        let value = inputElement.value.replace(/\D/g, '');
        if (value.length > 10) {
            value = value.slice(0, 10);
        }
        inputElement.value = value;
    }

    function numberOnlyAllowedDot(inputElement) {
        let value = inputElement.value.replace(/[^0-9.]/g, '');
        if (value.length > 10) {
            value = value.slice(0, 10);
        }
        inputElement.value = value;
    }

    $(document).ready(function() {

        function cbDropdown(column) {
            return $('<ul>', {
                'class': 'cb-dropdown form-control'
            }).appendTo($('<div>', {
                'class': 'cb-dropdown-wrap '
            }).appendTo(column));
        }

        $('#datatable3').DataTable({
            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;
                    var colIndex = column[0][0];
                    var excludeColumns = [0, 1, 7];
                    var textColumns = [2, 4];

                    if (jQuery.inArray(colIndex, excludeColumns) !== -1)
                        return;

                    if (jQuery.inArray(colIndex, textColumns) !== -1) {

                        var mainDiv = $('<div>', {
                            'class': 'cb-textBox-wrap'
                        }).appendTo($(column.header()));

                        let input = $('<input placeholder="Search" class="form-control">');
                        input.className = "";
                        input.type = "text";
                        mainDiv.append(input);

                        input.on('keyup', () => {
                            if (column.search() !== this.value) {
                                column.search(input.val()).draw();
                            }
                        });
                        return;

                    }

                    var ddmenu = cbDropdown($(column.header()))
                        .on('change', ':checkbox', function() {
                            var active;
                            var vals = $(':checked', ddmenu).map(function(index,
                                element) {
                                active = true;
                                return $.fn.dataTable.util.escapeRegex($(
                                    element).val());
                            }).toArray().join('|');

                            column
                                .search(vals.length > 0 ? '^(' + vals + ')$' : '', true,
                                    false)
                                .draw();

                            // Highlight the current item if selected.
                            if (this.checked) {
                                $(this).closest('li').addClass('active');
                            } else {
                                $(this).closest('li').removeClass('active');
                            }

                            // Highlight the current filter if selected.
                            var active2 = ddmenu.parent().is('.active');
                            if (active && !active2) {
                                ddmenu.parent().addClass('active');
                            } else if (!active && active2) {
                                ddmenu.parent().removeClass('active');
                            }
                        });

                    column.data().unique().sort().each(function(d, j) {
                        var
                            $label = $('<label>'),
                            $text = $('<span>', {
                                text: d
                            }),
                            $cb = $('<input>', {
                                type: 'checkbox',
                                value: d
                            });

                        $text.appendTo($label);
                        $cb.appendTo($label);


                        ddmenu.append($('<li>').append($label));
                    });
                });
            },
            "columnDefs": [{
                "targets": 0,
                "orderable": false
            }]
        });
    });




    $(document).ready(function() {

        // var table = $('#datatable3').DataTable({
        //     initComplete: function() {
        //         this.api()
        //             .columns()
        //             .every(function() {
        //                 let column = this;
        //                 let title = column.footer().textContent;
        //                 if (title == "")
        //                     return;
        //                 // Create input element
        //                 let input = document.createElement('input');
        //                 input.className = "form-control form-control-lg";
        //                 input.type = "text";
        //                 input.placeholder = title;
        //                 column.footer().replaceChildren(input);

        //                 // Event listener for user input
        //                 input.addEventListener('keyup', () => {
        //                     if (column.search() !== this.value) {
        //                         column.search(input.value).draw();
        //                     }
        //                 });
        //             });
        //     },
        //     "columnDefs": [{
        //         "targets": 0,
        //         "orderable": false
        //     }]
        // });



        $(".selectAll").on("click", function(event) {
            var isChecked = $(this).is(":checked");
            $("#datatable3 tbody input[type='checkbox']").prop("checked", isChecked);
        });

        // $('#s_locality').on('input', function () {
        //         var inputText = $(this).val();
        //         var pattern = /^[a-zA-Z0-9\s]+$/;
        //         if (!pattern.test(inputText)) {
        //             $(this).next('.error').text('Must include at least one alphabetic character.');
        //         } else {
        //             $(this).next('.error').text('');
        //         }
        //     });

        //     $('#s_villagetown').on('input', function () {
        //         var inputText = $(this).val();
        //         var pattern = /^[a-zA-Z0-9\s]+$/;
        //         if (!pattern.test(inputText)) {
        //             $(this).next('.error').text('Must include at least one alphabetic character.');
        //         } else {
        //             $(this).next('.error').text('');
        //         }
        //     });





        $('#resetButton').click(function() {
            $('#SellerRegForm input, #SellerRegForm select, #SellerRegForm textarea').val('');
            $('#SellerRegForm .error').text('');
            $('#image-preview').html('');
            $('#image-preview-logo').html('');
            $('#SellerRegForm input[type="file"]').val('');
            $('#SellerRegForm .selectpicker').selectpicker('val', '');
        });
    });








    // $(document).ready(function() {

    //     function initializeTimepicker() {
    //         $('.timepicker-input').timepicker({
    //             showMeridian: true,
    //             defaultTime: '00:00 AM',
    //             minuteStep: 1,
    //             disableFocus: true,
    //             showInputs: false,
    //             format: 'hh:ii AA'
    //         });
    //     }


    //     initializeTimepicker();

    //     $('.repeater-default-timem').repeater({
    //         show: function() {
    //             $(this).find('.day-select').val('Sunday');
    //             $(this).slideDown();
    //             updateFieldIds($(this));
    //             $(this).find('.timepicker-input').timepicker({
    //                 showMeridian: true,
    //                 defaultTime: '00:00 AM',
    //                 minuteStep: 1,
    //                 disableFocus: true,
    //                 showInputs: false,
    //                 format: 'hh:ii AA'
    //             });
    //         },
    //         hide: function(deleteElement) {
    //             if (confirm('Are you sure you want to delete this day time?')) {
    //                 $(this).slideUp(deleteElement);
    //             }
    //         },
    //     });

    //     function updateFieldIds(row) {
    //         var rowIndex = row.index() + 1;
    //         row.find('[id]').each(function() {
    //             var currentId = $(this).attr('id');
    //             var newId = currentId + rowIndex;
    //             $(this).attr('id', newId);
    //         });
    //     }
    // });


    $(document).ready(function() {
        function initializeTimepicker(element) {
            element.timepicker({
                showMeridian: true,
                defaultTime: '00:00 AM',
                minuteStep: 1,
                disableFocus: true,
                showInputs: false,
                format: 'hh:ii AA'
            });
        }

        initializeTimepicker($('.timepicker-input'));

        var repeater = $('.repeater-default-timem');
        repeater.repeater({
            show: function() {
                var row = $(this);
                row.find('.day-select').val('Sunday');
                row.slideDown();
                updateFieldIds(row);
                initializeTimepicker(row.find('.timepicker-input'));
            },
            hide: function(deleteElement) {
                if (confirm('Are you sure you want to delete this day time?')) {
                    $(this).slideUp(deleteElement);
                }
            },
        });

        $('#addSameTiming').on('click', function() {
            var firstDayTimingRow = repeater.find('[data-repeater-item]').first();
            var timing = {
                from: firstDayTimingRow.find('[id^="setfrom_time"]').val(),
                to: firstDayTimingRow.find('[id^="setto_time"]').val()
            };

            repeater.find('[data-repeater-item]').not(':first').each(function() {
                $(this).find('[id^="setfrom_time"]').val(timing.from);
                $(this).find('[id^="setto_time"]').val(timing.to);
            });
        });

        function updateFieldIds(row) {
            var rowIndex = row.index() + 1;
            row.find('[id]').each(function() {
                var currentId = $(this).attr('id');
                var newId = currentId + rowIndex;
                $(this).attr('id', newId);
            });
        }
    });





    $(function() {
        //$('#datetimepicker').datetimepicker();
        var datetimeFormat = 'ddd hh:mm A';
        $('#from-time-picker, #to-time-picker').datetimepicker({
            format: datetimeFormat,
            icons: {
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down"
            }
        });
        $('#from-time-picker, #to-time-picker').on('click', function() {
            $(this).datetimepicker('toggle');
        });
        $('#from-time-picker, #to-time-picker').on('show.datetimepicker', function() {
            $(this).datetimepicker('date', moment().format(datetimeFormat));
        });
    });

    $('#country').change(function() {
        $('#district').empty();
        var countryId = $(this).val();
        if (countryId) {
            $.get("/getStates/" + countryId, function(data) {
                $('#state').empty().append('<option value="">Select State</option>');
                $.each(data, function(index, state) {
                    $('#state').append('<option value="' + state.id + '">' + state.state_name +
                        '</option>');
                });
            });
        }
    });

    $('#state').change(function() {
        var stateId = $(this).val();
        if (stateId) {
            $.get("/getDistricts/" + stateId, function(data) {
                $('#district').empty().append('<option value="">Select District</option>');
                $.each(data, function(index, district) {
                    $('#district').append('<option value="' + district.id + '">' + district
                        .district_name + '</option>');
                });
            });
        }
    });



    $('#s_busnestype').change(function() {
        var busnescategory = $(this).val();
        if (busnescategory == '' || busnescategory == 0) {
            $('#s_shopservice').empty();
            $('#s_shopservicetype').empty();

        }
        if (busnescategory) {
            var categry = '';
            if (busnescategory == 1) {
                categry = 'Shop';
            } else if (busnescategory == 2) {
                categry = 'Service';
            }
            $('#s_subshopservice').empty();
            $.get("/BusinessCategory/" + busnescategory, function(data) {
                $('#s_shopservice').empty().append(
                    '<option value="">Select Business Category</option>');
                $.each(data, function(index, shopservice) {
                    $('#s_shopservice').append('<option value="' + shopservice.id +
                        '">' + shopservice.service_category_name + '</option>');
                });
            });
        }

        var busnes = $(this).val();
        if (busnes) {
            var shopcategry = '';
            if (busnes == 1) {
                shopcategry = 'Shop';
            } else if (busnes == 2) {
                shopcategry = 'Service';
            }
            $.get("/shopservicetype/" + busnes, function(data) {
                $('#s_shopservicetype').empty().append(
                    '<option value="">Select ' + shopcategry + ' Provider Type</option>');
                $.each(data, function(index, servicetype) {
                    $('#s_shopservicetype').append('<option value="' + servicetype
                        .id +
                        '">' + servicetype.service_name + '</option>');
                });
            });
        }

        var busnescate = $(this).val();
        if (busnescate) {
            var subshopexe = '';
            if (busnescate == 1) {
                subshopexe = 'Shop';
            } else if (busnescate == 2) {
                subshopexe = 'Service';
            }
            $.get("/executivename/" + busnescate, function(data) {
                $('#s_shopexectename').empty().append(
                    '<option value="">Select ' + subshopexe + ' Executive Name</option>'
                );
                $.each(data, function(index, executive) {
                    $('#s_shopexectename').append('<option value="' + executive.id +
                        '">' + executive.executive_name + '</option>');
                });
            });
        }

    });


    // $('#s_shopservice').change(function() {
    //     var shopcategryid = $(this).val();
    //     var busnescate = $("#s_busnestype").val();
    //     if (shopcategryid) {
    //         var subshopcategry = '';
    //         if (busnescate == 1) {
    //             subshopcategry = 'Shop';
    //         } else if (busnescate == 2) {
    //             subshopcategry = 'Service';
    //         }

    //         $.get("/getsubshopservice/" + shopcategryid, function(data) {
    //             $('#s_subshopservice').empty().append(
    //                 '<option value="">Select ' + subshopcategry +
    //                 ' Sub Category</option>');
    //             $.each(data, function(index, category) {
    //                 $('#s_subshopservice').append('<option value="' + category.id +
    //                     '">' +
    //                     category.sub_category_name + '</option>');
    //             });
    //         });
    //     }
    // });



    var fileArrs = [];
    var totalFiless = 0;
    var maxSize = 10485760; // 10MB in bytes
    var minSize = 512000; // 500KB in bytes

    $("#s_photo").change(function(event) {
        //$('#image-preview').html('');
        var totalFileCount = $(this)[0].files.length;
        for (var i = 0; i < totalFileCount; i++) {
            var file = $(this)[0].files[i];
            if (file.size > 3145728) {
                alert('File size exceeds the limit of 3MB');
                $(this).val('');
                $('#image-preview').html('');
                return;
            }
            // var fileSize = file.size;
            // if (fileSize > maxSize) {
            //     alert('File size exceeds the limit of 10MB');
            //     $(this).val('');
            //     $('#image-preview').html('');
            //     return;
            // }
            // if (fileSize < minSize) {
            //     alert('File size is less than 500KB');
            //     $(this).val('');
            //     $('#image-preview').html('');
            //     return;
            // }

            fileArrs.push(file);
            totalFiless++;
            if (totalFiless > 5) {
                alert('Maximum 5 images allowed');
                $(this).val('');
                $('#image-preview').html('');

                totalFiless = 0;
                fileArrs = [];
                file = "";
                return false;
            }


            var reader = new FileReader();
            reader.onload = (function(file) {
                return function(event) {
                    var imgDiv = $('<div>').addClass('img-div col-md-3 img-container');
                    var img = $('<img>').attr('src', event.target.result).addClass(
                        'img-responsive image new_thumpnail').attr('width', '100');
                    var removeBtn = $('<button>').addClass('btn btn-danger remove-btns').attr(
                        'title', 'Remove Image').append('Remove').attr('role', file.name);

                    imgDiv.append(img);
                    imgDiv.append($('<div>').addClass('middle').append(removeBtn));
                    if (fileArrs.length > 0)
                        $('#image-preview').append(imgDiv);
                };
            })(file);

            reader.readAsDataURL(file);
        }
        document.getElementById('s_photo').files = new FileListItem([]);
        document.getElementById('s_photo').files = new FileListItem(fileArrs);


    });

    $(document).on('click', '.remove-btns', function() {
        var fileName = $(this).attr('role');

        for (var i = 0; i < fileArrs.length; i++) {
            if (fileArrs[i].name === fileName) {
                fileArrs.splice(i, 1);
                totalFiless--;
                break;
            }
        }

        document.getElementById('s_photo').files = new FileListItem(fileArrs);
        $(this).closest('.img-div').remove();
    });

    // var fileArr = [];
    // var totalFiles = 0;

    // $("#s_logo").change(function(event) {
    //     var totalFileCount = $(this)[0].files.length;
    //     if (totalFiles + totalFileCount > 1) {
    //         alert('Maximum 1 images allowed');
    //         $(this).val('');
    //         $('#image-preview-logo').html('');
    //         return;
    //     }

    //     for (var i = 0; i < totalFileCount; i++) {
    //         var file = $(this)[0].files[i];

    //         if (file.size > 204800) {
    //             alert('File size exceeds the limit of 200Kb');
    //             $(this).val('');
    //             $('#image-preview-logo').html('');
    //             return;
    //         }

    //         fileArr.push(file);
    //         totalFiles++;

    //         var reader = new FileReader();
    //         reader.onload = (function(file) {
    //             return function(event) {
    //                 var imgDiv = $('<div>').addClass('img-divs col-md-3 img-container');
    //                 var img = $('<img>').attr('src', event.target.result).addClass(
    //                     'img-responsive image new_thumpnail').attr('width', '100');
    //                 var removeBtn = $('<button>').addClass('btn btn-danger remove-btnss').attr(
    //                     'title', 'Remove Image').append('Remove').attr('role', file.name);

    //                 imgDiv.append(img);
    //                 imgDiv.append($('<div>').addClass('middle').append(removeBtn));

    //                 $('#image-preview-logo').append(imgDiv);
    //             };
    //         })(file);

    //         reader.readAsDataURL(file);
    //     }
    // });

    // $(document).on('click', '.remove-btnss', function() {
    //     var fileName = $(this).attr('role');

    //     for (var i = 0; i < fileArr.length; i++) {
    //         if (fileArr[i].name === fileName) {
    //             fileArr.splice(i, 1);
    //             totalFiles--;
    //             break;
    //         }
    //     }

    //     document.getElementById('s_logo').files = new FileListItem(fileArr);
    //     $(this).closest('.img-divs').remove();
    // });

    var fileArr = [];
    var totalFiles = 0;

    $("#s_logo").change(function(event) {
        //$('#eimage-preview').html('');
        var totalFileCount = $(this)[0].files.length;

        for (var i = 0; i < totalFileCount; i++) {
            var file = $(this)[0].files[i];

            if (file.size > 3145728) {
                alert('File size exceeds the limit of 3MB');
                $(this).val('');
                $('#image-preview-logo').html('');
                return;
            }

            fileArr.push(file);
            totalFiles++;
            if (totalFiles > 1) {
                alert('Maximum 1 images allowed');
                $(this).val('');
                $('#image-preview-logo').html('');
                totalFiles = 0;
                fileArr = [];
                return;
            }


            var reader = new FileReader();
            reader.onload = (function(file) {
                return function(event) {
                    var imgDiv = $('<div>').addClass('img-divs col-md-3 img-container');
                    var img = $('<img>').attr('src', event.target.result).addClass(
                        'img-responsive image new_thumpnail').attr('width', '100');
                    var removeBtn = $('<button>').addClass('btn btn-danger remove-btnss').attr(
                        'title', 'Remove Image').append('Remove').attr('role', file.name);

                    imgDiv.append(img);
                    imgDiv.append($('<div>').addClass('middle').append(removeBtn));
                    if (fileArr.length > 0)
                        $('#image-preview-logo').append(imgDiv);
                };
            })(file);

            reader.readAsDataURL(file);
        }
        document.getElementById('s_logo').files = new FileListItem([]);
        document.getElementById('s_logo').files = new FileListItem(fileArr);

    });

    $(document).on('click', '.remove-btnss', function() {
        var fileName = $(this).attr('role');

        for (var i = 0; i < fileArr.length; i++) {
            if (fileArr[i].name === fileName) {
                fileArr.splice(i, 1);
                totalFiles--;
                break;
            }
        }

        document.getElementById('s_logo').files = new FileListItem(fileArr);
        $(this).closest('.img-divs').remove();
    });





    function FileListItem(file) {
        file = [].slice.call(Array.isArray(file) ? file : arguments);
        var b = file.length;
        var d = true;
        for (var c; b-- && d;) {
            d = file[b] instanceof File;
        }
        if (!d) {
            throw new TypeError('Expected argument to FileList is File or array of File objects');
        }
        var clipboardData = new ClipboardEvent('').clipboardData || new DataTransfer();
        for (b = d = file.length; b--;) {
            clipboardData.items.add(file[b]);
        }
        return clipboardData.files;
    }

    jQuery.validator.addMethod("validPAN", function(value, element) {
        var panRegex = /^[A-Z]{5}[0-9]{4}[A-Z]$/;
        return this.optional(element) || panRegex.test(value);
    }, "Invalid PAN format. It should be in the format AEDFR2568H");

    jQuery.validator.addMethod("validGST", function(value, element) {
        var gstRegex = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[0-9]{1}[A-Z]{1}[0-9]{1}$/;
        return this.optional(element) || gstRegex.test(value);
    }, "Invalid GST format. It should be in the format 29ABCDE1234F1Z5");

    // jQuery.validator.addMethod("validLicence", function(value, element) {
    //     var licenceRegex = /^[A-Z]{3}\d{5}$/;
    //     return this.optional(element) || licenceRegex.test(value);
    // }, "Invalid license number format. It should be 3 uppercase letters followed by 5 digits.");

    jQuery.validator.addMethod("validlocality", function(value, element) {
        var localityRegex = /^(?=.*[a-zA-Z])[a-zA-Z0-9\s]*$/;
        return this.optional(element) || localityRegex.test(value);
    }, "Must include at least one alphabetic character and allow only alphanumeric characters.");

    jQuery.validator.addMethod("validvillagetown", function(value, element) {
        var villagetownRegex = /^(?=.*[a-zA-Z])[a-zA-Z0-9\s]*$/;
        return this.optional(element) || villagetownRegex.test(value);
    }, "Must include at least one alphabetic character and allow only alphanumeric characters.");


    $("#SellerRegForm").validate({

        rules: {
            s_name: {
                required: true,
                // pattern: /^[A-Za-z\s\.]+$/,
            },
            s_ownername: {
                required: true,
                // pattern: /^[A-Za-z\s\.]+$/,
            },
            s_mobno: {
                required: true,
                digits: true,
                minlength: 10,
            },
            s_mobcntrycode: {
                required: true,
            },

            s_email: {
                // required: true,
                email: true,
            },

            s_busnestype: {
                required: true,

            },
            s_shopservice: {
                required: true,

            },
            // s_subshopservice: {
            //     required: true,

            // },
            s_shopservicetype: {
                required: true,

            },
            // s_shopexectename: {
            //     required: true,

            // },
            // s_lisence: {
            //     validLicence: true,
            // },
            s_buldingorhouseno: {
                required: true,
            },

            s_locality: {
                validlocality: true,
                required: true,

            },

            s_villagetown: {
                validvillagetown: true,
                required: true,
            },

            country: {
                required: true,
                // numericOnly: true
            },
            state: {
                required: true,

            },
            district: {
                required: true,

            },
            s_pincode: {
                required: true,
                digits: true,
                minlength: 6,

            },
            // s_googlelink: {
            //      required: true,
            // },
            //s_gstno: {
            // required: true,
            //},
            //s_panno: {
            //required: true,
            // },
            s_googlelatitude: {
                required: true,
                pattern: /^-?([1-8]?\d(\.\d{1,6})?|90(\.0{1,6})?)$/
            },
            s_googlelongitude: {
                required: true,
                pattern: /^-?([1-8]?\d(\.\d{1,6})?|90(\.0{1,6})?)$/
            },

            s_establishdate: {
                required: function(element) {
                    return $("#typeidhid").val() === "1";
                }
            },
            s_termcondtn: {
                //required: true,
            },
            s_photo: {
                required: true,
                extension: 'jpg|jpeg|png',
            },
            // s_logo: {
            //     required: true,
            //     extension: 'jpg|jpeg|png',
            // },
            // opentime: {
            //     required: true,
            // },
            // closetime: {
            //     required: true,
            // },
            // s_registerdate: {
            //     required: true,
            // },
            s_panno: {
                validPAN: true,
                // minlength: 10,
                // maxlength: 10
            },
            s_gstno: {
                validGST: true,
                // minlength: 15,
                // maxlength: 15
            },

            // manufactringdets: {
            //     required: true,
            // },

            // s_paswd: {
            //     required: true,
            //     minlength: 6,
            //     strongPassword: true
            // },
            // s_rpaswd: {
            //     required: true,
            //     equalTo: "#s_paswd"
            // },

        },
        messages: {
            s_name: {
                pattern: "Only characters, spaces, and dots are allowed.",
            },
            s_ownername: {
                pattern: "Only characters, spaces, and dots are allowed.",
            },
            s_mobno: {
                digits: "Please enter a valid mobile number.",
            },
            s_email: {
                email: "Please enter a valid email address.",
            },
            s_photo: {
                extension: "Only JPG and PNG files are allowed.",
            },
            // s_logo: {
            //     extension: "Only JPG and PNG files are allowed.",
            // },

            // s_lisence: {
            //     validLicence: "Invalid license number format. It should be 3 uppercase letters followed by 5 digits."
            // },
            s_buldingorhouseno: {
                required: "Please enter building/house name and number.",
                maxlength: "Building/house name and number must not exceed 100 characters."
            },
            s_locality: {
                required: "Please enter the locality.",
                maxlength: "Locality must not exceed 100 characters.",
                validlocality: "Must include at least one alphabetic character and allow only alphanumeric characters."
            },
            s_villagetown: {
                required: "Please enter village/town/municipality.",
                maxlength: "Village/town/municipality must not exceed 100 characters.",
                validvillagetown: "Must include at least one alphabetic character and allow only alphanumeric characters."
            },
            country: {
                required: "Please select a country."
            },
            state: {
                required: "Please select a state."
            },
            district: {
                required: "Please select a district."
            },
            s_pincode: {
                required: "Please enter the pin code.",
                maxlength: "Pin code must be 6 digits."
            },
            // s_googlelink: {
            //     required: "Please enter the Google map link location."
            // },
            // s_gstno: {
            //     required: "Please enter the GST number.",
            //     maxlength: "GST number must not exceed 25 characters."
            // },
            // s_panno: {
            //     required: "Please enter the PAN number.",
            //     maxlength: "PAN number must not exceed 12 characters."
            // },

            s_googlelatitude: {
                required: "Please enter google map location - Latitude."
            },

            s_googlelongitude: {
                required: "Please enter google map location - Longitude."
            },
            // s_termcondtn: {
            //     required: "Please accept the terms and conditions."
            // },
            s_establishdate: {
                required: "Please select the establishment date."
            },
            s_panno: {
                validPAN: "Invalid PAN format. It should be in the format AEDFR2568H"
            },
            s_gstno: {
                validGST: "Invalid GST format. It should be in the format 29ABCDE1234F1Z5"
            },

            // opentime: {
            //     required: "Please select open time."
            // },
            // closetime: {
            //     required: "Please select close time."
            // },
            // s_registerdate: {
            //     required: "Please select the registration date."
            // }

        },
    });


    $('#s_name, #s_ownername').on('input', function() {
        var value = $(this).val();
        value = value.replace(/[^A-Za-z\s.#&/'-]+/, '');
        $(this).val(value);
    });

    // $.validator.addMethod("strongPassword", function(value, element) {
    // return this.optional(element) || /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}$/.test(value);
    // }, "Password must contain at least one letter, one number, and one special character.");


    $.validator.addMethod('maxSize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param);
    }, 'File size must be less than {0} KB');



    $(document).ready(function() {
        $("#SellerRegForm").submit(function(event) {
            let valid = true;
            $("div[data-repeater-item]").each(function() {
                const $row = $(this);
                const setDay = $row.find("[name='setdaysm']").val() !== '';
                const setFromTime = $row.find("[name='setfrom_timem']").val() !== '';
                const setToTime = $row.find("[name='setto_timem']").val() !== '';
                if (!setDay || !setFromTime || !setToTime) {
                    valid = false;
                    return false;
                }
            });
            if (!valid) {
                alert("Please fill out all required fields in each row.");
                event.preventDefault();
            }
        });
    });



    $('#SellerRegForm').submit(function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            $.ajax({
                url: '{{ route('AdmsellerRegisteration') }}',
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {

                    console.log(response);
                    $('#shopreg-message').text(
                        'Registration successful. Please verify email and login!').fadeIn();
                    $('#shopreg-message').addClass('success-message');
                    $('#image-preview').empty();
                    $('#image-preview-logo').empty();
                    setTimeout(function() {
                        $('#shopreg-message').fadeOut();
                    }, 5000); // 5000 milliseconds = 5 seconds
                    $('#SellerRegForm')[0].reset();
                    $('#loading-image').fadeOut();
                    $('#loading-overlay').fadeOut();
                    $('#addNewModal').modal('hide');
                    shwdets();


                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    $('#shopreg-message').text('Registration failed.').fadeIn();
                    $('#shopreg-message').addClass('error');
                    setTimeout(function() {
                        $('#shopreg-message').fadeOut();
                    }, 5000);
                    $('#loading-image').fadeOut();
                    $('#loading-overlay').fadeOut();
                    $('#addNewModal').modal('show');

                }
            });
        }
    });



    // var mm = 1;
    // $(document).ready(function() {
    //     $('#addMoreurls').click(function(event) {
    //         event.preventDefault();
    //         mm++;
    //         var recRowm = '<div class="row mb-5" id="addedfieldurl' + mm +
    //             '"><div class="col-md-3 fv-row fv-plugins-icon-container"><select class="form-select form-control form-control-lg" id="mediatype' +
    //             mm + '" name="mediatype[' + mm +
    //             ']"><option selected="">Choose...</option><option value="1">Facebook</option><option value="2">Instagram</option><option value="3">Linked In</option><option value="4">Web site URL</option><option value="5">Youtub Video URL</option></select></div><div class="col-md-9 fv-row fv-plugins-icon-container"><div class="input-group"><input type="text"  id="mediaurl' +
    //             mm + '" name="mediaurl[' + mm +
    //             ']" class="form-control form-control-lg" placeholder="https://"  value="" tabindex="22"  maxlength="60"/><div align="right"><button id="removeRowurl' +
    //             mm +
    //             '" type="button" name="add_fieldurl" class="btn btn-danger" onclick="removeRowurl(' +
    //             mm + ');" >-</button></div></div></div>';
    //         $('#addedUrls').append(recRowm);
    //     });
    // });



    // function removeRowurl(rowNum) {
    //     $('#addedfieldurl' + rowNum).remove();
    // }




    var mm = 1;
    $(document).ready(function() {
        $('#addMoreurls').click(function(event) {
            event.preventDefault();
            $("#mediaurl,#mediatype").prop('required', true);
            var checkTe = $('#mediaurl,#mediatype').valid();
            $("#mediaurl,#mediatype").prop('required', false);
            if (!checkTe)
                return false;
            mm++;
            var recRowm = '<div class="row mb-5" id="addedfieldurl' + mm +
                '"><div class="col-md-3 fv-row fv-plugins-icon-container"><select required class="form-select form-control form-control-lg" id="mediatype' +
                mm + '" name="mediatype[' + mm +
                ']"><option value="">Choose...</option><option value="1">Facebook</option><option value="2">Instagram</option><option value="3">Linked In</option><option value="4">Web site URL</option><option value="5">Youtub Video URL</option></select></div><div class="col-md-9 fv-row fv-plugins-icon-container"><div class="input-group"><input type="url"  id="mediaurl' +
                mm + '" name="mediaurl[' + mm +
                ']" class="form-control form-control-lg" placeholder="https://" required  value="" tabindex="22"  maxlength="60"/><div align="right"><button id="removeRowurl' +
                mm +
                '" type="button" name="add_fieldurl" class="btn btn-danger" onclick="removeRowurl(' +
                mm + ');" >-</button></div></div></div>';
            $('#addedUrls').append(recRowm);
        });
    });

    function removeRowurl(rowNum) {
        $('#addedfieldurl' + rowNum).remove();
    }


    $("#UploadSellerRegForm").validate({
        rules: {
            shopupload: {
                required: true,
                accept: "csv"
            }
        },
        messages: {
            shopupload: {
                required: "Please select a CSV file",
                accept: "Only CSV files are allowed"
            }
        }
    });


    $('#UploadSellerRegForm').submit(function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            $.ajax({
                url: '{{ route('UploadsellerRegister') }}',
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {

                    console.log(response);
                    $('#shopupload-message').text('Shop details successfully submitted').fadeIn();
                    $('#shopupload-message').addClass('success-message');
                    setTimeout(function() {
                        $('#shopupload-message').fadeOut();
                    }, 5000); // 5000 milliseconds = 5 seconds
                    $('#UploadSellerRegForm')[0].reset();
                    $('#loading-image').fadeOut();
                    $('#loading-overlay').fadeOut();
                    $('#UploadShopModal').modal('hide');
                    shwdets();


                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    $('#shopupload-message').text('Upload failed.').fadeIn();
                    $('#shopupload-message').addClass('error');
                    setTimeout(function() {
                        $('#shopupload-message').fadeOut();
                    }, 5000);
                    $('#loading-image').fadeOut();
                    $('#loading-overlay').fadeOut();
                    $('#UploadShopModal').modal('show');

                }
            });
        }
    });
</script>
