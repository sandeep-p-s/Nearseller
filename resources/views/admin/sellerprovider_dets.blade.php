@php
    $roleid = session('roleid');
    $roleIdsArray = explode(',', $roleid);
@endphp

@if (in_array('1', $roleIdsArray) || in_array('11', $roleIdsArray))

    @if ($sellerCount > 0)
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
        @if (session('roleid') == '1' || session('roleid') == '11')
            <div class="text-center">
                <span class="badge badge-soft-info p-2">
                    Approved {{ $shoporservice }} Provider Type : {{ $activecounts->user_status_y_count }}
                </span>
                <span class="badge badge-soft-danger p-2">
                    Not Approved {{ $shoporservice }} Provider Type : {{ $activecounts->user_status_not_y_count }}
                </span>
            </div>
        @endif


        <table id="datatable3" class="table table-striped table-bordered" style="width: 100%">
            {{-- <tfoot>
                <tr>
                    @if (session('roleid') == '1' || session('roleid') == '11')
                        <th style="border: 0px solid #eaf0f7"></th>
                        <th style="border: 0px solid #eaf0f7"></th>
                    @endif
                    <th style="border: 0px solid #eaf0f7">{{ $shoporservice }} Provider Type</th>
                    <th style="border: 0px solid #eaf0f7">Approval Status</th>
                    <th style="border: 0px solid #eaf0f7"></th>
                </tr>
            </tfoot> --}}
            <thead>
                <tr>
                    @if (session('roleid') == '1' || session('roleid') == '11')
                        <th width="5px" data-sorting="true"><input type='checkbox' name='checkbox1' id='checkbox1'
                                class="selectAll" onclick='' />
                        </th>
                        <th>S.No.</th>
                    @endif
                    <th>{{ $shoporservice }} Provider Type</th>
                    <th>Approval Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ServiceType as $index => $sellerDetail)
                    <tr>
                        @if (session('roleid') == '1' || session('roleid') == '11')
                            <td><input name="shopid[]" type="checkbox" id="shopid{{ $index + 1 }}"
                                    value="{{ $sellerDetail->id }}"
                                    {{ $sellerDetail->seller_approved === 'Y' ? '' : '' }} />
                            </td>
                            <td>{{ $index + 1 }}</td>
                        @endif
                        <td>{{ $sellerDetail->service_name }}</td>
                        <td>
                            {{-- <span
                                class="badge p-2 {{ $sellerDetail->status === 'Y' ? 'badge badge-info' : 'badge badge-danger' }}">
                                {{ $sellerDetail->status === 'Y' ? 'Approved' : 'Not Approved' }}
                            </span> --}}
                            @if ($sellerDetail->status === 'Y')
                                @php
                                    $selpr_status = 'Approved';
                                @endphp
                            @else
                                @php
                                    $selpr_status = 'Not Approved';
                                @endphp
                            @endif
                            {{ $selpr_status }}
                        </td>


                        <td>
                            <div class="btn-group mb-2 mb-md-0">
                                <button type="button" class="btn view_btn dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">Action
                                    <i class="mdi mdi-chevron-down"></i></button>
                                <div class="dropdown-menu">
                                    @if (session('roleid') == '1' || session('roleid') == '11')
                                        <a class="dropdown-item approve_btn" href="#"
                                            onclick="sellerserviceapprovedet({{ $sellerDetail->id }},{{ $typeid }})">Approved</a>
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
                <button class="btn btn-primary" style="cursor:pointer" onclick="seller_service_approvedall();">Approve
                    All</button>
            </div>
        @endif
    @endif




@endif


<script>
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
                    var excludeColumns = [0, 1, 4];
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



        $(".selectAll").on("click", function(event) {
            var isChecked = $(this).is(":checked");
            $("#datatable3 tbody input[type='checkbox']").prop("checked", isChecked);
        });

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
</script>
