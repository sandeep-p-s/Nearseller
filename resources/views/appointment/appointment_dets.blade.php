@if ($serviceCount > 0)
    <table id="datatable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>SINO</th>
                <th>Service Name</th>
                <th>Available Date</th>
                {{-- <th>Service Type</th> --}}
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($ServiceAppointment as $index => $service)
                @php
                    $available_from_date = $service->available_from_date;
                    $available_to_date = $service->available_to_date;
                    $formattedFromDate = date('d-m-Y', strtotime($available_from_date));
                    $formattedToDate = date('d-m-Y', strtotime($available_to_date));
                @endphp

                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $service->service_name }}</td>
                    <td>
                        <span class="badge p-2 badge badge-danger">&nbsp;{{ $formattedFromDate }}</span> &nbsp;<span
                            class="badge p-2 badge badge-info">To</span> &nbsp;<span class="badge p-2 badge badge-danger">
                            &nbsp; {{ $formattedToDate }}
                        </span>
                    </td>
                    {{-- <td>
                        <span
                            class="badge p-2 {{ $service->service_point == '1' ? 'badge badge-success' : ($service->service_point == '2' ? 'badge badge-info' : 'badge badge-danger') }}">
                            {{ $service->service_point == '1' ? 'At Home' : ($service->service_point == '2' ? 'At Shop' : 'None') }}
                        </span>
                    </td> --}}
                    <td>
                        <div class="btn-group mb-2 mb-md-0">
                            <button type="button" class="btn view_btn dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Action
                                <i class="mdi mdi-chevron-down"></i></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item view_btn1" href="#"
                                    onclick="Appointmentvieweditdet({{ $service->id }})">View/Edit</a>
                                    @if (session('roleid') == '1' || session('roleid') == '11')
                                    {{-- <a class="dropdown-item approve_btn" href="#"
                                        onclick="productapprovedet({{ $service->id }})">Approved</a> --}}
                                    <a class="dropdown-item delete_btn" href="#"
                                        onclick="Appointmentdeletedet({{ $service->id }})">Delete</a>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach



        </tbody>
    </table>
@else
    <table>
        <tr>
            <td colspan="13" align="center">
                <img src="{{ asset('backend/assets/images/notfoundimg.png') }}" alt="notfound" class="rounded-circle"
                    style="width: 30%;" />
            </td>
        </tr>
    </table>
@endif




<!-- Modal Add New -->
<div class="modal fade p-5" id="addNewModal" tabindex="-1" aria-labelledby="addNewModalLabel" aria-hidden="true">
    <div class="modal-dialog custom-modal-dialog" style="overflow-y: scroll;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="addNewModalLabel">Add New Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    title="Close">x</button>
            </div>
            <div class="modal-body">
                <form id="AppointmentAddForm" enctype="multipart/form-data" method="POST">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">


                                    <div class="form-group"><label>Set Availability Dates<span
                                                class="text-danger">*</span></label>
                                        <select class="form-select form-control form-control-lg" id="setavailbledate"
                                            name="setavailbledate" required tabindex="1">
                                            <option value="">Select</option><br />
                                            <option value="1">Avialability Date</option><br />
                                        </select>
                                        <label for="setavailbledate" class="error"></label>
                                    </div>

                                    <div class="form-group" id="dateFields" style="display: none;">
                                        <div class="input-group">
                                            <div class="col-lg-5">
                                                <label for="setavailblefromdate">From Date</label>
                                                <input type="date" class="form-control form-control-lg"
                                                    id="setavailblefromdate" name="setavailblefromdate" required
                                                    tabindex="2">
                                            </div>
                                            <div class="col-lg-4">
                                                <label for="setavailbletodate">To Date</label>
                                                <input type="date" class="form-control form-control-lg"
                                                    id="setavailbletodate" name="setavailbletodate" required
                                                    tabindex="3">
                                            </div>
                                            <div class="col-lg-3"><label for="isnotavailable">Not Available</label>
                                                <input class="form-control" type="checkbox" id="isnotavailable"
                                                    name="isnotavailable" value="1" style="width: 10%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="singleDateField" style="display: none;">
                                        <fieldset>
                                            <div class="repeater-default">
                                                <div data-repeater-list="notavailabledate_data">
                                                    <!-- Heading Row -->
                                                    <div class="form-group row">
                                                        <div class="col">
                                                            <label class="control-label"> Not Available Date </label>
                                                        </div>
                                                    </div>
                                                    <!-- Dynamic Rows -->
                                                    <div data-repeater-item="">
                                                        <div class="form-group row d-flex align-items-end">
                                                            <div class="col">
                                                                <input type="date"
                                                                    class="form-control form-control-lg"
                                                                    name="setavailblesingledate" tabindex="4">
                                                                <div class="dateValidationMessage"
                                                                    style="color: red;"></div>
                                                            </div>
                                                            <div class="col">
                                                                <span data-repeater-delete=""
                                                                    class="btn btn-danger btn-sm">
                                                                    <span class="far fa-trash-alt mr-1"></span> Delete
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0 row">
                                                    <div class="col-sm-12 text-right">
                                                        <span data-repeater-create=""
                                                            class="btn btn-secondary btn-sm">
                                                            <span class="fas fa-plus"></span> Add recurring holidays to
                                                            eliminate
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>



                                    <div class="form-group">
                                        <fieldset>
                                            <div class="repeater-default-time">
                                                <div data-repeater-list="availabletime_data">
                                                    <!-- Heading Row -->
                                                    <div class="form-group row">
                                                        <div class="col-md-2">
                                                            <label class="control-label"> Set Available time </label>
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
                                                        <div class="form-group row d-flex align-items-end">
                                                            <div class="col-md-2">
                                                                <input class="form-control" type="checkbox"
                                                                    id="settimestatus" name="settimestatus"
                                                                    value="1" style="width: 20%;">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select id="setdays" name="setdays"
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
                                                                <input type="text" id="setfrom_time"
                                                                    name="setfrom_time"
                                                                    class="form-control timepicker-input">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input type="text" id="setto_time"
                                                                    name="setto_time"
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
                                                        @if (session('roleid') == '1' || session('roleid') == '11')
                                                            <button type="button" id="addSameTiming"
                                                                class="btn btn-primary btn-sm">
                                                                Add Same Timing for All Days
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">


                                    <div class="form-group">
                                        <fieldset>
                                            <div class="repeater-default-question">
                                                <div data-repeater-list="setquestion_data">
                                                    <!-- Heading Row -->
                                                    <div class="form-group row">
                                                        <div class="col">
                                                            <label class="control-label"> Set Question for Customer
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <!-- Dynamic Rows -->
                                                    <div data-repeater-item="">
                                                        <div class="form-group row d-flex align-items-end">

                                                            <div class="col">
                                                                <textarea id="setquestion" name="setquestion" placeholder="Set Question" class="form-control" maxlength="250"
                                                                    tabindex="6" rows="5" cols="5"></textarea>
                                                                <label for="setquestion"></label>
                                                            </div>

                                                            <div class="col">
                                                                <span data-repeater-delete=""
                                                                    class="btn btn-danger btn-sm">
                                                                    <span class="far fa-trash-alt mr-1"></span> Delete
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0 row">
                                                    <div class="col-sm-12 text-right">
                                                        <span data-repeater-create=""
                                                            class="btn btn-secondary btn-sm">
                                                            <span class="fas fa-plus"></span> Add New Question
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="form-group"><label>Service Required?<span
                                                class="text-danger">*</span></label>
                                        <select class="selectservicetype form-select form-control form-control-lg"
                                            id="service_type_id" name="service_type_id" required tabindex="1">
                                            <option value="">Select Services</option><br />
                                            @foreach ($servicedetails as $shps)
                                                <option value="{{ $shps->id }}">{{ $shps->service_name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="service_type_id" class="error"></label>
                                    </div>

                                    <div class="form-group"><label>Preffered Employee<span
                                                class="text-danger">*</span></label>
                                        <select class="selectserviceemploye form-select form-control form-control-lg"
                                            id="service_employe_id" name="service_employe_id" required
                                            tabindex="1">
                                            <option value="">Select Employee</option><br />
                                            @foreach ($serviceemployees as $emplye)
                                                <option value="{{ $emplye->id }}">{{ $emplye->employee_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="service_employe_id" class="error"></label>
                                    </div>

                                    <div class="form-group"><label>Suggestions</label>
                                        <textarea id="sugection" name="sugection" placeholder="Suggestions" class="form-control" maxlength="500"
                                            tabindex="6"></textarea>
                                        <label for="sugection" class="error"></label>
                                    </div>

                                    <div class="form-group mb-0 row">
                                        <label class="col-md-3">Service Point </label>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <div class="form-check form-check-inline">

                                                    <input class="form-control" type="checkbox" id="servicepoint1"
                                                        name="servicepoint1" value="1" style="width: 18%;">
                                                    <label class="form-check-label" for="servicepoint1">At Home</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-control" type="checkbox" id="servicepoint2"
                                                        name="servicepoint2" value="1" style="width: 19%;">
                                                    <label class="form-check-label" for="servicepoint2">At Shop</label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>




                    <div class="col-md-12">
                        <div style="float:right">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger" id="resetButton">Reset</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div id="apptment-message" class="text-center" style="display: none;"></div>
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


<script>




    $(document).ready(function() {
        $('#resetButton').click(function() {
            $('#AppointmentAddForm input, #AppointmentAddForm select, #AppointmentAddForm textarea').val('');
            $('#AppointmentAddForm .error').text('');
            $('#AppointmentAddForm .selectpicker').selectpicker('val', '');
        });

        // function initializeTimepicker() {
        //     // Select all elements with the class '.timepicker-input' and initialize timepicker
        //     $('.timepicker-input').timepicker({
        //         showMeridian: true,
        //         defaultTime: '00:00 AM',
        //         minuteStep: 1,
        //         disableFocus: true,
        //         showInputs: false,
        //         format: 'hh:ii AA'
        //     });
        // }

        // // Initialize timepicker for the initial row
        // initializeTimepicker();

        // $('.repeater-default-time').repeater({
        //     show: function() {
        //         $(this).find('.day-select').val('Sunday');
        //         $(this).slideDown();
        //         updateFieldIds($(this));

        //         // Initialize timepicker for the new row
        //         $(this).find('.timepicker-input').timepicker({
        //             showMeridian: true,
        //             defaultTime: '00:00 AM',
        //             minuteStep: 1,
        //             disableFocus: true,
        //             showInputs: false,
        //             format: 'hh:ii AA'
        //         });
        //     },
        //     hide: function(deleteElement) {
        //         if (confirm('Are you sure you want to delete this day time?')) {
        //             $(this).slideUp(deleteElement);
        //         }
        //     },
        // });


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

        var repeater = $('.repeater-default-time');
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




        $("#setavailbledate").on("change", function() {
            var selectedValue = $(this).val();
            if (selectedValue === "1") {
                $("#dateFields").show();
            } else {
                $("#dateFields").hide();
            }
        });
        $("#isnotavailable").on("change", function() {
            if ($(this).is(":checked")) {
                $("#singleDateField").show();
            } else {
                $("#singleDateField").hide();
            }
        });

        $(document).on("change", "input[name^='notavailabledate_data'][name$='[setavailblesingledate]']",
            function() {
                var fromDateValue = new Date($("#setavailblefromdate").val());
                var toDateValue = new Date($("#setavailbletodate").val());
                var notAvailableDateValue = new Date($(this).val());
                var dateValidationMessage = $(this).closest('.form-group').find(".dateValidationMessage");

                if (!isNaN(notAvailableDateValue) &&
                    notAvailableDateValue >= fromDateValue &&
                    notAvailableDateValue <= toDateValue) {
                    dateValidationMessage.text("");
                } else {
                    dateValidationMessage.text(
                        "Not Available Date must be within the range of From Date and To Date.");
                    $(this).val("");
                }
            });


    });

    $('.repeater-default').repeater({
        show: function() {
            $(this).slideDown();
            updateFieldIds($(this));
        },
        hide: function(deleteElement) {
            if (confirm('Are you sure you want to delete this not available date?')) {
                $(this).slideUp(deleteElement);
            }
        },
    });




    // $('.repeater-default-question').repeater({

    //     show: function() {
    //         $(this).slideDown();
    //         updateFieldIds($(this));
    //     },
    //     hide: function(deleteElement) {
    //         if (confirm('Are you sure you want to delete the question?')) {
    //             $(this).slideUp(deleteElement);
    //         }
    //     },
    // });


    var maxQuestions = 6;
    $('.repeater-default-question').repeater({
        show: function() {
            var $list = $('[data-repeater-list="setquestion_data"]');
            var currentCount = $list.children('[data-repeater-item]').length;
            if (currentCount < maxQuestions) {
                $(this).slideDown();
                $list.find('[data-repeater-create]').trigger('click');

                currentCount = $list.children('[data-repeater-item]').length;
            } else {
                alert("You can add a maximum of " + maxQuestions + " questions.");
            }

            updateFieldIds($(this));
        },
        hide: function(deleteElement) {
            if (confirm('Are you sure you want to delete the question?')) {
                $(this).slideUp(deleteElement);
            }
        },
    });



    function updateFieldIds(row) {
        var rowIndex = row.index() + 1;
        row.find('[id]').each(function() {
            var currentId = $(this).attr('id');
            var newId = currentId + rowIndex;
            $(this).attr('id', newId);
        });
    }


    $('#addNewModal .selectservicetype').each(function() {
        var $p = $(this).parent();
        $(this).select2({
            dropdownParent: $p
        });
    });
    $('#addNewModal .selectserviceemploye').each(function() {
        var $p = $(this).parent();
        $(this).select2({
            dropdownParent: $p
        });
    });


    $("#AppointmentAddForm").validate({
        rules: {
            setavailbledate: "required",
            setavailblefromdate: {
                required: function() {
                    return $("#setavailbledate").val() !== '';
                },
                date: true
            },
            setavailbletodate: {
                required: function() {
                    return $("#setavailbledate").val() !== '';
                },
                date: true
            },
            "notavailabledate_data[][setavailblesingledate]": {
                required: function() {
                    return $("#isnotavailable").is(":checked");
                },
                date: true
            },
            setquestion: "required",
            service_type_id: "required"
        },
        messages: {
            setavailbledate: "Availability date is mandatory.",
            setavailblefromdate: {
                required: "From date is mandatory when Set Availability Dates is selected.",
                date: "Please enter a valid date."
            },
            setavailbletodate: {
                required: "To date is mandatory when Set Availability Dates is selected.",
                date: "Please enter a valid date."
            },
            "notavailabledate_data[][setavailblesingledate]": {
                required: "Not available date is mandatory if not available.",
                date: "Please enter a valid date."
            },
            setquestion: "Question for the customer is mandatory.",
            service_type_id: "Service Required is mandatory."
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") === "notavailabledate_data[][setavailblesingledate]") {
                if ($("#isnotavailable").is(":checked") && $("[name^='notavailabledate_data[']").length >
                    0) {
                    error.insertAfter(element.closest(".form-group"));
                }
            } else {
                error.insertAfter(element);
            }
        }
    });



    $('#AppointmentAddForm').submit(function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            $.ajax({
                url: '{{ route('AdmNewAppointmentAdd') }}',
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {


                    if (response.result == 1) {
                        $('#apptment-message').text(response.mesge).fadeIn();
                        $('#apptment-message').addClass('success-message');
                        setTimeout(function() {
                            $('#apptment-message').fadeOut();
                        }, 5000);
                        $('#AppointmentAddForm')[0].reset();
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#addNewModal').modal('hide');
                        shwdets();
                    } else if (response.result == 2) {
                        $('#apptment-message').text(response.mesge).fadeIn();
                        $('#apptment-message').addClass('error');
                        setTimeout(function() {
                            $('#apptment-message').fadeOut();
                        }, 5000);
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#addNewModal').modal('show');

                    } else if (response.result == 3) {
                        $('#apptment-message').text(response.mesge).fadeIn();
                        $('#apptment-message').addClass('error');
                        setTimeout(function() {
                            $('#apptment-message').fadeOut();
                        }, 5000);
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#addNewModal').modal('show');

                    } else {
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                    }
                }
            });
        }
    });
</script>
