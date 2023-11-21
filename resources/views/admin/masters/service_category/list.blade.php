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
                                <h4 class="page-title">Business Category</h4>

                            </div>
                            <div class="col-auto align-self-center">
                                <a href="{{ route('add.servicecategory') }}"><button type="button" class="btn add_btn ">Add
                                        Business Category </button></a>
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
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            {{-- <div class="text-center">
                                <span class="badge badge-soft-info p-2">
                                    Total Service Categories : {{ $total_servicecategories }}
                                </span>
                                <span class="badge badge-soft-danger p-2">
                                    Inactive Service Categories : {{ $inactive_servicecategories }}
                                </span>
                            </div> --}}
                            <table id="datatable3" class="table table-bordered table-striped nowrap" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Business Category</th>
                                        <th>Business Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($servicecategory as $sc)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sc->service_category_name }}</td>

                                            <td width="10%" class="text-center">

                                                @if ($sc->business_name == 'Sales')
                                                    @php
                                                        $business_name = 'Sales';
                                                    @endphp
                                                @else
                                                    @php
                                                        $business_name = 'Services';
                                                    @endphp
                                                @endif


                                                {{-- <span
                                                    class="badge p-2 {{ $c->status === 'Y' ? 'badge badge-success' : 'badge badge-danger' }}">
                                                    {{ $c->status === 'Y' ? 'Active' : 'Inactive' }}
                                                </span> --}}

                                                {{ $business_name }}
                                            </td>
                                            <td width="10%" class="text-center">

                                                @if ($sc->status == 'Y')
                                                    @php
                                                        $business_categorystatus = 'Active';
                                                    @endphp
                                                @else
                                                    @php
                                                        $business_categorystatus = 'Inctive';
                                                    @endphp
                                                @endif


                                                {{-- <span
                                                    class="badge p-2 {{ $c->status === 'Y' ? 'badge badge-success' : 'badge badge-danger' }}">
                                                    {{ $c->status === 'Y' ? 'Active' : 'Inactive' }}
                                                </span> --}}

                                                {{ $business_categorystatus }}
                                            </td>
                                            <td>
                                                <div class="btn-group mb-2 mb-md-0">
                                                    <button type="button" class="btn view_btn dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">Action <i
                                                            class="mdi mdi-chevron-down"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item view_btn1"
                                                            href="{{ route('edit.servicecategory', $sc->id) }}">Edit</a>
                                                        <a class="dropdown-item delete_btn"
                                                            href="{{ route('delete.servicecategory', $sc->id) }}"
                                                            onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div><!-- container -->

        <script>
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
                            var excludeColumns = [0, 4];
                            var textColumns = [1];

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
        </script>
    @endsection
