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
                                <h4 class="page-title">Seller Offer List</h4>

                            </div>
                            <div class="col-auto align-self-center">
                                <a href="{{ route('add.shop_offer') }}"><button type="button" class="btn add_btn"
                                        id="addOfferButton">Add
                                        Shop Offer </button></a>
                            </div><!--end col-->


                        </div><!--end row-->
                    </div><!--end page-title-box-->
                    @if (session('success'))
                        <div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div><!--end col-->
            </div><!--end row-->
            <!-- end page title end breadcrumb -->
            <div class="col-md-12">
                <div id="shopoffer_approved-message" class="text-center" style="display: none;"></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="text-center">
                                <span class="badge badge-soft-info p-2">
                                    Active Offers : {{ $active_offers }}
                                </span>
                                <span class="badge badge-soft-danger p-2">
                                    Inactive Offers : {{ $inactive_offers }}
                                </span>
                                <span class="badge badge-soft-info p-2">
                                    Approved Offers : {{ $approved_offers }}
                                </span>
                                <span class="badge badge-soft-danger p-2">
                                    Not Approved Offers : {{ $notapproved_offers }}
                                </span>
                            </div>
                            <table id="datatable3" class="table table-striped table-bordered" style="width: 100%;">
                                <thead>
                                    <tr>
                                        @if (session('roleid') == 1 || session('roleid') == 11)
                                            {{-- <th data-sortable="false"><input type='checkbox' name='checkbox1' id='checkbox1'
                                                onclick='check();' /></th> --}}
                                            <th width="5px" class="checkboxcol"><input type='checkbox' name='checkbox1' id='checkbox1'
                                                    class="selectAll" onclick='' /></th>
                                        @endif
                                        <th>S.No.</th>
                                        <th>Offers</th>
                                        <th class="typecol">Business Type</th>
                                        <th>Active Status</th>
                                        <th>Approval Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalshop_offer = count($shop_offer);
                                    @endphp
                                    @if ($shop_offer)
                                        @foreach ($shop_offer as $index => $so)
                                            <tr>
                                                @if (session('roleid') == 1 || session('roleid') == 11)
                                                    <td width="8%" class="checkboxcol"><input name="shopofferid[]" type="checkbox"
                                                            id="shopofferid{{ $loop->iteration }}"
                                                            value="{{ $so->id }}"
                                                            {{ $so->approval_status === 'Y' ? '' : '' }} />
                                                    </td>
                                                @endif
                                                <td width="8%">{{ $loop->iteration }}</td>
                                                <td>{{ $so->offer_to_display }}</td>
                                                <td class="typecol">
                                                    @if ($so->type == 1)
                                                        Shop
                                                    @elseif ($so->type == 2)
                                                        Services
                                                    @else
                                                        Unknown Type
                                                    @endif
                                                </td>
                                                <td width="10%">
                                                    {{-- <span
                                                        class="badge p-2 {{ $so->status === 'Y' ? 'badge badge-success' : 'badge badge-danger' }}">
                                                        {{ $so->status === 'Y' ? 'Active' : 'Inactive' }}
                                                    </span> --}}
                                                    @if ($so->status === 'Y')
                                                        @php
                                                            $offer_status = 'Active';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $offer_status = 'Inctive';
                                                        @endphp
                                                    @endif


                                                    {{ $offer_status }}
                                                </td>
                                                <td width="10%">
                                                    {{-- <span
                                                        class="badge p-2 {{ $so->approval_status === 'Y' ? 'badge badge-success' : 'badge badge-danger' }}">
                                                        {{ $so->approval_status === 'Y' ? 'Approved' : 'Not Approved' }}
                                                    </span> --}}
                                                    @if ($so->approval_status === 'Y')
                                                        @php
                                                            $offer_aprv_status = 'Approved';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $offer_aprv_status = 'Not Approved';
                                                        @endphp
                                                    @endif


                                                    {{ $offer_aprv_status }}
                                                </td>
                                                <td width="10%">
                                                    <div class="btn-group mb-2 mb-md-0">
                                                        <button type="button" class="btn view_btn dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">Action <i
                                                                class="mdi mdi-chevron-down"></i></button>
                                                        <div class="dropdown-menu">
                                                            @if (session('roleid') == '1' || session('roleid') == '11')
                                                                <a class="dropdown-item view_btn1 d-none"
                                                                    href="{{ route('edit.shop_offer', $so->id) }}">View/Edit</a>
                                                                <a class="dropdown-item approve_btn"
                                                                    href="{{ route('approved.shopoffer', $so->id) }}">Activation/Approved</a>
                                                                <a class="dropdown-item delete_btn"
                                                                    href="{{ route('delete.shop_offer', $so->id) }}"
                                                                    onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                                                            @else
                                                                <a class="dropdown-item view_btn1 d-none"
                                                                    href="{{ route('edit.shop_offer', $so->id) }}">View/Edit</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan='4' style="text-align: center;">No shop offers found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <input type="hidden" value="{{ $totalshop_offer }}" id="totalservicecnt">
                            @if ($totalshop_offer > 0)
                                <div class="col text-center">
                                    <button class="btn btn-primary" style="cursor:pointer"
                                        onclick="shopoffer_approvedall();" id="approveAllBtn">Approve
                                        All</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div><!-- container -->
        <script>
            $(document).ready(function() {
                var currentPagePath = window.location.pathname;
                if (currentPagePath === "/addlistoffer") {
                    $(".view_btn1").addClass("d-none");
                    $(".approve_btn, .delete_btn").removeClass("d-none");
                    $(".checkboxcol").removeClass("d-none");
                    $(".typecol").removeClass("d-none");
                    $("#approveAllBtn").removeClass("d-none");
                } else if (currentPagePath === "/listshopoffer") {
                    $(".view_btn1").removeClass("d-none");
                    $(".approve_btn").addClass("d-none");
                    $(".checkboxcol").addClass("d-none");
                    $(".typecol").addClass("d-none");
                    $("#approveAllBtn").addClass("d-none");
                }
            });
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
                            var excludeColumns = [0, 1, 6];
                            var textColumns = [1, 2];

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
                var currentPageUrl = window.location.href;
                if (currentPageUrl.includes("/addlistoffer")) {
                    $("#addOfferButton").addClass("d-none");
                    $(".page-title").text("Offer Approval List");
                } else {
                    $("#addOfferButton").removeClass("d-none");
                    $(".page-title").text("Seller Offer List");
                }
            });
            $(document).ready(function() {

                $(".selectAll").on("click", function(event) {
                    var isChecked = $(this).is(":checked");
                    $("#datatable tbody input[type='checkbox']").prop("checked", isChecked);
                });
            });

            function check() {
                if (document.getElementById('checkbox1').checked == true) {
                    for (i = 1; i <= document.getElementById('totalservicecnt').value; i++) {
                        document.getElementById('shopofferid' + i).checked = true;
                    }
                } else {
                    for (i = 1; i <= document.getElementById('totalservicecnt').value; i++) {
                        document.getElementById('shopofferid' + i).checked = false;
                    }
                }
            }

            function shopoffer_approvedall() {
                var shopofferid = '';
                var totalservicecnt = document.getElementById('totalservicecnt').value;
                for (var i = 1; i <= totalservicecnt; i++) {
                    var checkbox = document.getElementById('shopofferid' + i);
                    if (checkbox && checkbox.checked) {
                        shopofferid = shopofferid + '#' + checkbox.value;
                    }
                }
                if (shopofferid === '') {
                    alert('No Shops Selected');
                    return false;
                }

                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('ShopOfferApprovedAll') }}',
                    type: 'POST',
                    data: {
                        shopofferid: shopofferid
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(data) {
                        if ((data.result == 1)) {
                            $('#shopoffer_approved-message').text(data.mesge).fadeIn();
                            $('#shopoffer_approved-message').addClass('success-message');
                            setTimeout(function() {
                                $('#shopoffer_approved-message').fadeOut();
                            }, 5000);
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                            window.location.reload();
                        } else if ((data.result == 2)) {
                            $('#shopoffer_approved-message').text(data.mesge).fadeIn();
                            $('#shopoffer_approved-message').addClass('error');
                            setTimeout(function() {
                                $('#shopoffer_approved-message').fadeOut();
                            }, 5000);
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                            window.location.reload();
                        } else {
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                            window.location.reload();
                        }
                    }
                });
            }
        </script>
    @endsection
