@extends('backendlayout')
@section('content')
    @include('menu')
    @include('topnav')

    <!-- Page Content-->
    {{-- <style>
        tfoot {
            display: table-header-group;
        }

        tfoot input {
            width: 100%;
            padding: 3px;
            box-sizing: border-box;
        }
    </style> --}}
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="row">
                            <div class="col">
                                <h4 class="page-title">District List</h4>

                            </div>
                            <div class="col-auto align-self-center">
                                <a href="{{ route('add.district') }}"><button type="button" class="btn add_btn ">Add
                                        District </button></a>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end page-title-box-->
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
                </div><!--end col-->
            </div><!--end row-->
            <!-- end page title end breadcrumb -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- <div class="text-center">
                                <span class="badge badge-soft-info p-2">
                                    Total States : {{ $total_districts }}
                                </span>
                                <span class="badge badge-soft-danger p-2">
                                    Inactive States : {{ $inactive_districts }}
                                </span>
                            </div> --}}
                            <table id="datatable3" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                {{-- <tfoot>
                                    <tr>
                                        <th style="border: 0px solid #eaf0f7"></th>
                                        <th style="border: 0px solid #eaf0f7">District Name</th> --}}
                                {{-- <th style="border: 0px solid #eaf0f7">Email</th> --}}
                                {{-- <th style="border: 0px solid #eaf0f7">Mobile</th> --}}
                                {{-- <th style="border: 0px solid #eaf0f7">State Name</th>
                                        <th style="border: 0px solid #eaf0f7">Country Name</th>
                                        <th style="border: 0px solid #eaf0f7">Status</th>
                                        <th style="border: 0px solid #eaf0f7"></th>
                                    </tr>
                                </tfoot> --}}
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>District Name</th>
                                        <th>State Name</th>
                                        <th>Country Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($districts as $d)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $d->district_name }}
                                            </td>
                                            <td><span class="badge badge-soft-info p-2">{{ $d->state_name }}</span></td>
                                            <td><span class="badge badge-soft-purple p-2">{{ $d->country_name }}</span></td>
                                            <td>
                                                {{-- <span
                                                    class="badge  p-2 {{ $d->d_status === 'Y' ? 'badge badge-success' : 'badge badge-danger' }}">
                                                    {{ $d->d_status === 'Y' ? 'Active' : 'Inactive' }}
                                                </span> --}}
                                                @if ($d->d_status === 'Y')
                                                    @php
                                                        $d_status = 'Active';
                                                    @endphp
                                                @else
                                                    @php
                                                        $d_status = 'Inctive';
                                                    @endphp
                                                @endif


                                                {{ $d_status }}
                                            </td>
                                            <td>
                                                <div class="btn-group mb-2 mb-md-0">
                                                    <button type="button" class="btn view_btn dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">Action <i
                                                            class="mdi mdi-chevron-down"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item view_btn1"
                                                            href="{{ route('edit.district', $d->id) }}">Edit</a>
                                                        <a class="dropdown-item delete_btn"
                                                            href="{{ route('delete.district', $d->id) }}"
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
                            var excludeColumns = [0, , 5];
                            var textColumns = [1, 2, 3];

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
                        "orderable": true
                    }]
                });
            });
        </script>
    @endsection
