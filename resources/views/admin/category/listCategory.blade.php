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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- <div class="text-center">
                                <span class="badge badge-soft-info p-2">
                                    Total Categories : {{ $total_categories }}
                                </span>
                                <span class="badge badge-soft-danger p-2">
                                    Inactive Categories : {{ $inactive_categories }}
                                </span>
                            </div> --}}
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Select all&nbsp;&nbsp;<input type='checkbox' name='checkbox1' id='checkbox1'
                                                onclick='check();' /></th>
                                        <th>No</th>
                                        <th>Category Name</th>
                                        <th>Status</th>
                                        <th>Approved</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $index => $c)
                                        <tr>
                                            <td width="5%"><input name="categoryid[]" type="checkbox"
                                                    id="categoryid{{ $index + 1 }}" value="{{ $c->id }}"
                                                    {{ $c->approval_status === 'Y' ? 'checked' : '' }} />
                                            </td>

                                            <td width="5%">{{ $loop->iteration }}</td>
                                            <td width="65%">
                                                @foreach (explode(' ➤ ', $c->category_name) as $key => $path)
                                                    @if ($loop->last)
                                                        <span
                                                            class="badge {{ $c->category_type === 1 ? 'badge-soft-orange' : 'badge-soft-primary' }}  p-2"
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
                                                        <a class="dropdown-item view_btn1"
                                                            href="{{ route('edit.category', $c->category_slug) }}">Edit</a>
                                                        @if (session('roleid') == 1)
                                                            <a class="dropdown-item view_btn1"
                                                                href="{{ route('approved.category', $c->category_slug) }}">Approved</a>
                                                        @endif
                                                        {{-- <a class="dropdown-item delete_btn"
                                                        href="{{ route('delete.category', $c->category_slug) }}"
                                                        onclick="return confirm('Are you sure you want to delete?')">Delete</a> --}}
                                                    </div>
                                                </div>
                                                {{-- {{ $c->parent_id }} --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <input type="hidden" value="{{ $index + 1 }}" id="totalservicecnt">

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div><!-- container -->

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $('#approveAll').on('click', function() {
                serviceapprovedall(); // Call the serviceapprovedall function
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
        </script>
    @endsection
