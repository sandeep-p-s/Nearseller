<form id="AppointmentRegFormEdit" enctype="multipart/form-data" method="POST">
    <input type="hidden" id="appointment_id" name="appointment_id" class="form-control" placeholder="Appointment ID"
        value="{{ $ServiceAppointment->id }}" />
    <div class="row">

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">


                    <div class="form-group"><label>Set Availability Dates</label>
                        <select class="form-select form-control form-control-lg" id="setavailbledates"
                            name="setavailbledates" required tabindex="1">
                            <option value="">Select</option><br />
                            <option value="{{ $ServiceAppointment->is_setdates }}"
                                @if ($ServiceAppointment->is_setdates == 1) selected @endif>Avialability Date</option><br />
                        </select>
                        <label for="setavailbledates" class="error"></label>
                    </div>

                    <div class="form-group" id="dateFieldss"
                        style="display: {{ $ServiceAppointment->is_setdates == 1 ? 'block' : 'none' }};">
                        <div class="input-group">
                            <div class="col-lg-5">
                                <label for="setavailblefromdates">From Date</label>
                                <input type="date" class="form-control form-control-lg" id="setavailblefromdates"
                                    name="setavailblefromdates" required tabindex="2"
                                    value="{{ $ServiceAppointment->available_from_date }}">
                            </div>
                            <div class="col-lg-4">
                                <label for="setavailbletodates">To Date</label>
                                <input type="date" class="form-control form-control-lg" id="setavailbletodates"
                                    name="setavailbletodates" required tabindex="3"
                                    value="{{ $ServiceAppointment->available_to_date }}">
                            </div>
                            <div class="col-lg-3"><label for="isnotavailables">Not Available</label>
                                <input class="form-control" type="checkbox" id="isnotavailables" name="isnotavailables"
                                    value="{{ $ServiceAppointment->is_not_available }}" style="width: 10%;"
                                    {{ $ServiceAppointment->is_not_available == 1 ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="singleDateFields"
                        style="{{ $ServiceAppointment->is_not_available == 1 ? 'block' : 'none' }};">
                        <fieldset>
                            <div class="repeater-defaults">
                                <div data-repeater-list="notavailabledate_datas">
                                    <!-- Heading Row -->
                                    <div class="form-group row">
                                        <div class="col">
                                            <label class="control-label"> Not Available Date </label>
                                        </div>
                                    </div>
                                    <!-- Dynamic Rows -->
                                    @php
                                        $countnotavailabledates=count($notavailabledates);
                                    @endphp
                                    @if($countnotavailabledates>0)
                                    @foreach ($notavailabledates as $notavaildate)
                                        <div data-repeater-item="">
                                            <div class="form-group row d-flex align-items-end">
                                                <div class="col">
                                                    <input type="date" class="form-control form-control-lg"
                                                        name="setavailblesingledates" tabindex="4"
                                                        value="{{ $notavaildate->not_available_date }}">
                                                    <div class="dateValidationMessages" style="color: red;"></div>
                                                </div>
                                                <div class="col">
                                                    <span data-repeater-delete="" class="btn btn-danger btn-sm">
                                                        <span class="far fa-trash-alt mr-1"></span> Delete
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @endif
                                    <div data-repeater-item="" id="notavailbledate_no" style="display: none;">
                                        <div class="form-group row d-flex align-items-end">
                                            <div class="col">
                                                <input type="date" class="form-control form-control-lg"
                                                    name="setavailblesingledates" tabindex="4">
                                                <div class="dateValidationMessages" style="color: red;"></div>
                                            </div>
                                            <div class="col">
                                                <span data-repeater-delete="" class="btn btn-danger btn-sm">
                                                    <span class="far fa-trash-alt mr-1"></span> Delete
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-0 row">
                                    <div class="col-sm-12 text-right">
                                        <span data-repeater-create="" class="btn btn-secondary btn-sm">
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
                            <div class="repeater-default-times">
                                <div data-repeater-list="availabletime_datas">
                                    <!-- Heading Row -->
                                    <div class="form-group row">
                                        <div class="col">
                                            <label class="control-label"> Set Available time </label>
                                        </div>
                                        <div class="col">
                                            <label class="control-label"> Day </label>
                                        </div>
                                        <div class="col">
                                            <label class="control-label"> From Time </label>
                                        </div>
                                        <div class="col">
                                            <label class="control-label"> To Time </label>
                                        </div>
                                    </div>
                                    <!-- Dynamic Rows -->
                                    @php
                                        $countavialabletime=count($appointmentavailable);
                                    @endphp
                                    @if($countavialabletime>0)

                                    @foreach ($appointmentavailable as $availdatetime)
                                        <div data-repeater-item="">
                                            <div class="form-group row d-flex align-items-end">
                                                <div class="col">
                                                    <input class="form-control" type="checkbox" id="settimestatuss"
                                                        name="settimestatuss" value="1" style="width: 10%;"
                                                        {{ $availdatetime->is_set_time == 1 ? 'checked' : '' }}>
                                                </div>
                                                <div class="col">
                                                    <select id="setdayss" name="setdayss"
                                                        class="day-select form-control">
                                                        <option value="0">Days</option>
                                                        <option value="Sunday"
                                                            @if ($availdatetime->appt_days == 'Sunday') selected @endif>Sunday
                                                        </option>
                                                        <option value="Monday"
                                                            @if ($availdatetime->appt_days == 'Monday') selected @endif>Monday
                                                        </option>
                                                        <option value="Tuesday"
                                                            @if ($availdatetime->appt_days == 'Tuesday') selected @endif>Tuesday
                                                        </option>
                                                        <option value="Wednesday"
                                                            @if ($availdatetime->appt_days == 'Wednesday') selected @endif>Wednesday
                                                        </option>
                                                        <option value="Thursday"
                                                            @if ($availdatetime->appt_days == 'Thursday') selected @endif>Thursday
                                                        </option>
                                                        <option value="Friday"
                                                            @if ($availdatetime->appt_days == 'Friday') selected @endif>Friday
                                                        </option>
                                                        <option value="Saturday"
                                                            @if ($availdatetime->appt_days == 'Saturday') selected @endif>Saturday
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="setfrom_times" name="setfrom_times"
                                                        class="form-control timepicker_s"
                                                        value="{{ $availdatetime->from_time }}">
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="setto_times" name="setto_times"
                                                        class="form-control timepicker_s"
                                                        value="{{ $availdatetime->to_time }}">
                                                </div>
                                                <div class="col">
                                                    <span data-repeater-delete="" class="btn btn-danger btn-sm">
                                                        <span class="far fa-trash-alt mr-1"></span> Delete
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @endif

                                    <div data-repeater-item="" id="availabletime_no" style="display: none;" >
                                        <div class="form-group row d-flex align-items-end">
                                            <div class="col">
                                                <input class="form-control" type="checkbox" id="settimestatuss"
                                                    name="settimestatuss" value="1" style="width: 10%;">
                                            </div>
                                            <div class="col">
                                                <select id="setdayss" name="setdayss"
                                                    class="day-select form-control">
                                                    <option value="0">Days</option>
                                                    <option value="Sunday">Sunday</option>
                                                    <option value="Monday">Monday</option>
                                                    <option value="Tuesday">Tuesday</option>
                                                    <option value="Wednesday">Wednesday</option>
                                                    <option value="Thursday">Thursday</option>
                                                    <option value="Friday">Friday</option>
                                                    <option value="Saturday">Saturday</option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <input type="text" id="setfrom_times" name="setfrom_times"
                                                    class="form-control timepicker_s" value="">
                                            </div>
                                            <div class="col">
                                                <input type="text" id="setto_times" name="setto_times"
                                                    class="form-control timepicker_s" value="">
                                            </div>
                                            <div class="col">
                                                <span data-repeater-delete="" class="btn btn-danger btn-sm">
                                                    <span class="far fa-trash-alt mr-1"></span> Delete
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-0 row">
                                    <div class="col-sm-12 text-right">
                                        <span data-repeater-create="" class="btn btn-secondary btn-sm">
                                            <span class="fas fa-plus"></span> Add New Time
                                        </span>
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
                            <div class="repeater-default-questions">
                                <div data-repeater-list="setquestion_datas">
                                    <!-- Heading Row -->
                                    <div class="form-group row">
                                        <div class="col">
                                            <label class="control-label"> Set Question for Customer
                                            </label>
                                        </div>
                                    </div>
                                    <!-- Dynamic Rows -->
                                    @php
                                        $countsetquestions=count($setquestions);
                                    @endphp
                                    @if($countsetquestions>0)
                                    @foreach ($setquestions as $setqustn)
                                        <div data-repeater-item="">
                                            <div class="form-group row d-flex align-items-end">

                                                <div class="col">
                                                    <textarea id="setquestions" name="setquestions" placeholder="Set Question" class="form-control" maxlength="250"
                                                        tabindex="6">{{ $setqustn->questions }}</textarea>
                                                    <label for="setquestions"></label>
                                                </div>

                                                <div class="col">
                                                    <span data-repeater-delete="" class="btn btn-danger btn-sm">
                                                        <span class="far fa-trash-alt mr-1"></span> Delete
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @endif
                                    <div data-repeater-item="" id="setquestion_no" style="display: none;">
                                        <div class="form-group row d-flex align-items-end">

                                            <div class="col">
                                                <textarea id="setquestions" name="setquestions" placeholder="Set Question" class="form-control" maxlength="250"
                                                    tabindex="6"></textarea>
                                                <label for="setquestions"></label>
                                            </div>

                                            <div class="col">
                                                <span data-repeater-delete="" class="btn btn-danger btn-sm">
                                                    <span class="far fa-trash-alt mr-1"></span> Delete
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group mb-0 row">
                                    <div class="col-sm-12 text-right">
                                        <span data-repeater-create="" class="btn btn-secondary btn-sm">
                                            <span class="fas fa-plus"></span> Add New Question
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>





                    <div class="form-group"><label>Service Required?</label>
                        <select class="selectservicetype form-select form-control form-control-lg"
                            id="service_type_ids" name="service_type_ids" required tabindex="1">
                            <option value="">Select Services</option><br />
                            @foreach ($servicedetails as $shps)
                                <option value="{{ $shps->id }}" @if ($shps->id == $ServiceAppointment->service_id) selected @endif>
                                    {{ $shps->service_name }}</option>
                            @endforeach
                        </select>
                        <label for="service_type_ids" class="error"></label>
                    </div>




                    <div class="form-group"><label>Preffered Employee</label>
                        <select class="selectserviceemploye form-select form-control form-control-lg"
                            id="service_employe_ids" name="service_employe_ids" required tabindex="1">
                            <option value="">Select Employee</option><br />
                            @foreach ($serviceemployees as $emplye)
                                <option value="{{ $emplye->id }}" @if ($emplye->id == $ServiceAppointment->employee_id) selected @endif>
                                    {{ $emplye->employee_name }}
                                </option>
                            @endforeach
                        </select>
                        <label for="service_employe_ids" class="error"></label>
                    </div>

                    <div class="form-group"><label>Suggestions</label>
                        <textarea id="sugections" name="sugections" placeholder="Suggestions" class="form-control" maxlength="500"
                            tabindex="6">{{ $ServiceAppointment->suggestion }}</textarea>
                        <label for="sugections" class="error"></label>
                    </div>







                    <div class="form-group mb-0 row">
                        <label class="col-md-4">Service Point </label>
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="athomes"
                                        name="servicepoints" value="1" tabindex="10"
                                        {{ $ServiceAppointment->service_point == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="athomes">At Home</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="atshops"
                                        name="servicepoints" value="2" tabindex="11"
                                        {{ $ServiceAppointment->service_point == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="atshops">At Shop</label>
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
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>


    <div class="col-md-12">
        <div id="apptmentedit-message" class="text-center" style="display: none;"></div>
    </div>



</form>




<script>
    $(document).ready(function() {

        function initializeTimepicker() {
            $('.timepicker_s').timepicker({
                showMeridian: true,
                defaultTime: '00:00 AM',
                minuteStep: 1,
                disableFocus: true,
                showInputs: false,
                format: 'hh:ii AA'
            });
            //$('.timepickers').timepicker('setTime', '06:30 PM');
        }

        initializeTimepicker();

        $(document).on("click", "span[data-repeater-create]", function() {
            var repeaterList = $(this).closest(".repeater-default-times").find(
                "[data-repeater-list='availabletime_datas']");
            var rowCount = repeaterList.children("[data-repeater-item]").length;
            //alert(rowCount)
            // if (rowCount < 14) {
            var clonedRow = repeaterList.find("[data-repeater-item]:last").clone();
            initializeTimepicker(clonedRow);
            clonedRow.find(".timepicker_s").data('timepicker-enabled', true);
            clonedRow.find(".timepicker_s").timepicker('setTime', '00:00 AM');
            repeaterList.append(clonedRow);
            // } else {
            // alert("You cannot add more than 7 days.");
            //}
        });



        $("#setavailbledates").on("change", function() {
            var selectedValue = $(this).val();
            if (selectedValue === "1") {
                $("#dateFieldss").show();
            } else {
                $("#dateFieldss").hide();
            }
        });
        $("#isnotavailables").on("change", function() {
            if ($(this).is(":checked")) {
                $("#singleDateFields").show();
            } else {
                $("#singleDateFields").hide();
            }
        });

        $(document).on("change", "input[name^='notavailabledate_datas'][name$='[setavailblesingledates]']",
            function() {
                var fromDateValue = new Date($("#setavailblefromdates").val());
                var toDateValue = new Date($("#setavailbletodates").val());
                var notAvailableDateValue = new Date($(this).val());
                var dateValidationMessage = $(this).closest('.form-group').find(".dateValidationMessages");

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

    $('.repeater-defaults').repeater({
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


    $('.repeater-default-times').repeater({

        show: function() {
            $(this).find('.day-select').val('');
            $(this).slideDown();
            updateFieldIds($(this));
        },
        hide: function(deleteElement) {
            if (confirm('Are you sure you want to delete this day time?')) {
                $(this).slideUp(deleteElement);
            }
        },
    });

    $('.repeater-default-questions').repeater({

        show: function() {
            $(this).slideDown();
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








    $('#ViewEditModal .selectservicetype').each(function() {
        var $p = $(this).parent();
        $(this).select2({
            dropdownParent: $p
        });
    });
    $('#ViewEditModal .selectserviceemploye').each(function() {
        var $p = $(this).parent();
        $(this).select2({
            dropdownParent: $p
        });
    });


    $("#AppointmentRegFormEdit").validate({
        rules: {
            setavailbledates: "required",
            setavailblefromdates: {
                required: function() {
                    return $("#setavailbledates").val() !== '';
                },
                date: true
            },
            setavailbletodates: {
                required: function() {
                    return $("#setavailbledates").val() !== '';
                },
                date: true
            },
            "notavailabledate_datas[][setavailblesingledates]": {
                required: function() {
                    return $("#isnotavailables").is(":checked");
                },
                date: true
            },
            setquestions: "required",
            service_type_ids: "required"
        },
        messages: {
            setavailbledates: "Availability date is mandatory.",
            setavailblefromdates: {
                required: "From date is mandatory when Set Availability Dates is selected.",
                date: "Please enter a valid date."
            },
            setavailbletodates: {
                required: "To date is mandatory when Set Availability Dates is selected.",
                date: "Please enter a valid date."
            },
            "notavailabledate_datas[][setavailblesingledates]": {
                required: "Not available date is mandatory if not available.",
                date: "Please enter a valid date."
            },
            setquestions: "Question for the customer is mandatory.",
            service_type_ids: "Service Required is mandatory."
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") === "notavailabledate_datas[][setavailblesingledates]") {
                if ($("#isnotavailables").is(":checked") && $("[name^='notavailabledate_datas[']").length >
                    0) {
                    error.insertAfter(element.closest(".form-group"));
                }
            } else {
                error.insertAfter(element);
            }
        }
    });



    $('#AppointmentRegFormEdit').submit(function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            $.ajax({
                url: '{{ route('AdmNewAppointmentEdit') }}',
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
                        $('#apptmentedit-message').text(response.mesge).fadeIn();
                        $('#apptmentedit-message').addClass('success-message');
                        setTimeout(function() {
                            $('#apptmentedit-message').fadeOut();
                        }, 5000);
                        $('#AppointmentRegFormEdit')[0].reset();
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#ViewEditModal').modal('hide');
                        shwdets();
                    } else if (response.result == 2) {
                        $('#apptmentedit-message').text(response.mesge).fadeIn();
                        $('#apptmentedit-message').addClass('error');
                        setTimeout(function() {
                            $('#apptmentedit-message').fadeOut();
                        }, 5000);
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#ViewEditModal').modal('show');

                    } else if (response.result == 3) {
                        $('#apptmentedit-message').text(response.mesge).fadeIn();
                        $('#apptmentedit-message').addClass('error');
                        setTimeout(function() {
                            $('#apptmentedit-message').fadeOut();
                        }, 5000);
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#ViewEditModal').modal('show');

                    } else {
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                    }
                }
            });
        }
    });
</script>
