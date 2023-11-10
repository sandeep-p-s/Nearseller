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
                                <a href="{{ route('add.category') }}"><button type="button" class="btn add_btn ">Add New
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

            <style>
                tfoot {
                    display: table-caption;
                }

                tfoot {
                    width: 100%;
                    padding: 3px;
                    box-sizing: border-box;
                }
            </style>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-center align-items-center mb-2">
                                <span class="badge badge-soft-info p-2">Total Categories :
                                    {{ $total_categories }}</span><span class="badge badge-soft-info p-2 ml-2">Active Status
                                    Categories :
                                    {{ $active_categories }}</span><span class="badge badge-soft-danger p-2 ml-2">Inactive
                                    Status Categories : {{ $inactive_categories }}</span><span
                                    class="badge badge-soft-info p-2 ml-2">Approved Categories :
                                    {{ $approved_categories }}</span><span class="badge badge-soft-danger p-2 ml-2">Not
                                    Approved Categories : {{ $notapproved_categories }}
                                </span>
                            </div>
                            <table id="datatable3" class="table table-striped table-bordered" style="width: 100%">
                                <tfoot>
                                    <tr>
                                        @if (session('roleid') == 1 || session('roleid') == 11)
                                            <th style="border: 0px solid #eaf0f7"></th>
                                        @endif
                                        <th style="border: 0px solid #eaf0f7"></th>
                                        <th style="border: 0px solid #eaf0f7">Category Name</th>
                                        <th style="border: 0px solid #eaf0f7">Status</th>
                                        <th style="border: 0px solid #eaf0f7">Approved</th>
                                        <th style="border: 0px solid #eaf0f7"></th>
                                    </tr>
                                </tfoot>

                                <thead>
                                    <tr>
                                        @if (session('roleid') == 1 || session('roleid') == 11)
                                            {{-- <th data-sortable="false"><input type='checkbox' name='checkbox1' id='checkbox1'
                                                onclick='check();' /></th> --}}
                                            <th width="5px" data-sorting="true"><input type='checkbox' name='checkbox1'
                                                    id='checkbox1' class="selectAll" onclick='' /></th>
                                        @endif

                                        <th>S.No.</th>
                                        <th>Category Name</th>
                                        <th>Status</th>
                                        <th>Approved</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalCategories = count($categories);
                                    @endphp
                                    @foreach ($categories as $index => $c)
                                        <tr>
                                            @if (session('roleid') == 1 || session('roleid') == 11)
                                                <td width="5%"><input name="categoryid[]" type="checkbox"
                                                        id="categoryid{{ $loop->iteration }}" value="{{ $c->id }}"
                                                        {{ $c->approval_status === 'Y' ? '' : '' }} />
                                                </td>
                                            @endif

                                            <td width="5%">{{ $loop->iteration }}</td>
                                            <td width="65%">
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

                                            <td width="5%" class="text-center">
                                                <span
                                                    class="badge p-2 {{ $c->status === 'Y' ? 'badge badge-success' : 'badge badge-danger' }}">
                                                    {{ $c->status === 'Y' ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td width="10%" class="text-center">
                                                <span
                                                    class="badge p-2 {{ $c->approval_status === 'Y' ? 'badge badge-success' : 'badge badge-danger' }}">
                                                    {{ $c->approval_status === 'Y' ? 'Approved' : 'Not Approved' }}
                                                </span>
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
                                                            <a class="dropdown-item view_btn1"
                                                                href="{{ route('edit.category', $c->category_slug) }}">Edit/View</a>
                                                        @endif
                                                        @if (session('roleid') == 1 || session('roleid') == 11)
                                                            <a class="dropdown-item approve_btn"
                                                                href="{{ route('approved.category', $c->category_slug) }}">Approved</a>
                                                        @endif
                                                        @if (session('roleid') == 1 || session('roleid') == 11)
                                                            <a class="dropdown-item delete_btn"
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
                                    <button class="btn btn-primary" style="cursor:pointer"
                                        onclick="category_approvedall();">Approved
                                        All</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div><!-- container -->



    <script>
        // $('#approveAll').on('click', function() {
        //     serviceapprovedall(); // Call the serviceapprovedall function
        // });

        $(document).ready(function() {

            var table = $('#datatable3').DataTable({
                initComplete: function() {
                    this.api()
                        .columns()
                        .every(function() {
                            let column = this;
                            let title = column.footer().textContent;
                            if (title == "")
                                return;
                            // Create input element
                            let input = document.createElement('input');
                            input.className = "form-control form-control-lg";
                            input.type = "text";
                            input.placeholder = title;
                            column.footer().replaceChildren(input);

                            // Event listener for user input
                            input.addEventListener('keyup', () => {
                                if (column.search() !== this.value) {
                                    column.search(input.value).draw();
                                }
                            });
                        });
                },
                "columnDefs": [{
                    "targets": 0,
                    "orderable": false
                }]
            });



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
                alert('No Shops Selected');
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
