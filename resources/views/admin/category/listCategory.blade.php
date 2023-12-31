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
                                <h4 class="page-title">Category List</h4>
                            </div>
                            <div class="col-auto align-self-center">
                                <a href="{{ route('add.category') }}"><button type="button" class="btn add_btn d-none"
                                        id="addCategoryButton">Add New
                                        Category </button></a>
                            </div>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successMessage">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="successMessage">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <div id="loading-overlay"></div>
            <img id="loading-image" src="{{ asset('img/loading.gif') }}" style="display: none; width:100px;">

            <div class="col-md-12">
                <div id="category_approved-message" class="text-center" style="display: none;"></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <input type="hidden" id="hidroleid" name="hidroleid" value="{{ session('roleid') }}" />
                        <div class="card-body">
                            <div class="d-flex justify-content-center align-items-center mb-2">
                                <span class="badge badge-soft-info p-2 ml-2">Active Categories :
                                    {{ $active_categories }}</span><span class="badge badge-soft-danger p-2 ml-2">Inactive
                                    Categories : {{ $inactive_categories }}</span><span
                                    class="badge badge-soft-info p-2 ml-2">Approved Categories :
                                    {{ $approved_categories }}</span><span class="badge badge-soft-danger p-2 ml-2">Not
                                    Approved Categories : {{ $notapproved_categories }}
                                </span>
                            </div>
                            @php
                                $totalCategories = count($categories);
                            @endphp
                            @if ($totalCategories > 0)
                                <table id="datatable3" class="table table-striped table-bordered" style="width: 100%">


                                    <thead>
                                        <tr>
                                            @if (session('roleid') == 1 || session('roleid') == 11)
                                                {{-- <th data-sortable="false"><input type='checkbox' name='checkbox1' id='checkbox1'
                                                onclick='check();' /></th> --}}
                                                <th width="5px" data-sorting="true" class="checkbox_table"><input
                                                        type='checkbox' name='checkbox1' id='checkbox1' class="selectAll"
                                                        onclick='' /></th>
                                            @endif

                                            <th>S.No.</th>
                                            <th>Category Name</th>
                                            <th>Active Status</th>
                                            <th>Approval Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($categories as $index => $c)
                                            <tr>
                                                @if (session('roleid') == 1 || session('roleid') == 11)
                                                    <td class="checkbox_table" width="5%"><input name="categoryid[]"
                                                            type="checkbox" id="categoryid{{ $loop->iteration }}"
                                                            value="{{ $c->id }}"
                                                            {{ $c->approval_status === 'Y' ? '' : '' }} />
                                                    </td>
                                                @endif

                                                <td width="5%">{{ $loop->iteration }}</td>
                                                <td width="55%">
                                                    @foreach (explode(' ➤ ', $c->category_name) as $key => $path)
                                                        @if ($loop->last)
                                                            <span class="badge badge-soft-orange p-2"
                                                                style="font-size: 15px !important;">{{ $path }}</span>
                                                        @else
                                                            @if ($key === count(explode(' ➤ ', $c->category_name)) - 1)
                                                                {{ $path }}
                                                            @else
                                                                {{ $path }} ➤
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </td>

                                                <td width="10%" class="text-center">

                                                    @if ($c->status == 'Y')
                                                        @php
                                                            $ustatus = 'Active';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $ustatus = 'Inctive';
                                                        @endphp
                                                    @endif


                                                    {{-- <span
                                                    class="badge p-2 {{ $c->status === 'Y' ? 'badge badge-success' : 'badge badge-danger' }}">
                                                    {{ $c->status === 'Y' ? 'Active' : 'Inactive' }}
                                                </span> --}}

                                                    {{ $ustatus }}
                                                </td>
                                                <td width="15%" class="text-center">

                                                    @if ($c->approval_status == 'Y')
                                                        @php
                                                            $uapproved = 'Approved';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $uapproved = 'Not Approved';
                                                        @endphp
                                                    @endif


                                                    {{ $uapproved }}
                                                    {{-- <span
                                                    class="badge p-2 {{ $c->approval_status === 'Y' ? 'badge badge-success' : 'badge badge-danger' }}">
                                                    {{ $c->approval_status === 'Y' ? 'Approved' : 'Not Approved' }}
                                                </span> --}}
                                                </td>
                                                <td width="10%" class="text-center">
                                                    {{-- {{ $c->id }} --}}
                                                    <div class="btn-group mb-2 mb-md-0">
                                                        <button type="button" class="btn view_btn dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">Action <i
                                                                class="mdi mdi-chevron-down"></i></button>
                                                        <div class="dropdown-menu">

                                                            @if (session('roleid') == 1 || session('roleid') == 11 || session('user_id') == $c->created_by)
                                                                <a class="dropdown-item view_btn1 d-none" id="editBtn"
                                                                    href="{{ route('edit.category', $c->category_slug) }}">Edit/View</a>
                                                            @endif
                                                            @if (session('roleid') == 1 || session('roleid') == 11)
                                                                <a class="dropdown-item approve_btn " id="approvalBtn"
                                                                    href="{{ route('approved.category', $c->category_slug) }}">Activation/Approval</a>
                                                            @endif
                                                            @if (session('roleid') == 1 || session('roleid') == 11)
                                                                <a class="dropdown-item delete_btn" id="deleteBtn"
                                                                    href="{{ route('delete.category', $c->category_slug) }}"
                                                                    onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <input type="hidden" value="{{ $totalCategories }}" id="totalservicecnt">
                                @if ($totalCategories > 0)
                                    <div class="col text-center">
                                        <button class="btn btn-primary px-5 approve_all_btn"
                                            onclick="category_approvedall();">Approve
                                            All</button>
                                    </div>
                                @endif
                            @else
                                <table>
                                    <tr>
                                        <td colspan="13" align="center">
                                            <img src="{{ asset('backend/assets/images/notfoundimg.png') }}"
                                                alt="notfound" class="rounded-circle" style="width: 30%;" />
                                        </td>
                                    </tr>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div><!-- container -->


    <script>
        $(document).ready(function() {
            var currentPageUrl = window.location.pathname;
            if (currentPageUrl === "/addlistcategory") {
                $("#addCategoryButton").removeClass("d-none");
                $(".approve_btn").addClass("d-none");
                $(".view_btn1").removeClass("d-none");
                $(".approve_all_btn").addClass("d-none");
                $(".checkbox_table").addClass("d-none");

            } else {
                $("#addCategoryButton").addClass("d-none");
                $(".approve_btn").removeClass("d-none");
                $(".view_btn1").addClass("d-none");
                $(".approve_all_btn").removeClass("d-none");
                $(".checkbox_table").removeClass("d-none");
            }
        });

        // $('#approveAll').on('click', function() {
        //     serviceapprovedall(); // Call the serviceapprovedall function
        // });
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
                        var hidroleid = $('#hidroleid').val();
                        if (hidroleid == 1 || hidroleid == 11) {
                            var excludeColumns = [0, 1, 5];
                            var textColumns = [2];
                        } else {
                            var excludeColumns = [0, 4];
                            var textColumns = [1];

                        }


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
        });


        function check() {
            if (document.getElementById('checkbox1').checked == true) {
                for (i = 1; i <= document.getElementById('totalservicecnt').value; i++) {
                    document.getElementById('categoryid' + i).checked = true;
                }
            } else {
                for (i = 1; i <= document.getElementById('totalservicecnt').value; i++) {
                    document.getElementById('categoryid' + i).checked = false;
                }
            }
        }


        function category_approvedall() {
            var categoryid = '';
            var totalservicecnt = document.getElementById('totalservicecnt').value;
            for (var i = 1; i <= totalservicecnt; i++) {
                var checkbox = document.getElementById('categoryid' + i);
                if (checkbox && checkbox.checked) {
                    categoryid = categoryid + '#' + checkbox.value;
                }
            }
            if (categoryid === '') {
                alert('Please Select Category');
                return false;
            }

            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{ route('CategoryApprovedAll') }}',
                type: 'POST',
                data: {
                    categoryid: categoryid
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(data) {
                    if ((data.result == 1)) {
                        $('#category_approved-message').text(data.mesge).fadeIn();
                        $('#category_approved-message').addClass('success-message');
                        setTimeout(function() {
                            $('#category_approved-message').fadeOut();
                        }, 5000);
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        window.location.reload();
                    } else if ((data.result == 2)) {
                        $('#category_approved-message').text(data.mesge).fadeIn();
                        $('#category_approved-message').addClass('error');
                        setTimeout(function() {
                            $('#category_approved-message').fadeOut();
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
