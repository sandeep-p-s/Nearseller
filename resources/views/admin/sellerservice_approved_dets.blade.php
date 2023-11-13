

    <form id="SellerServiceProviderApproved" enctype="multipart/form-data" method="POST">
        <input type="hidden" id="shopidhidapp" name="shopidhidapp" value="{{ $ServiceType->id }}"
            class="form-control form-control-lg" maxlength="50" placeholder="Shop User id" required tabindex="1" />

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <label class="col-xl-6">{{ $shoporservice }} Provider Type</label>
                            <div class="col-xl-6 align-self-center">

                                <input type="text" class="form-control mb-3" id="serviceprovider_name"
                                        placeholder="Enter Seller/Service type" required name="serviceprovider_name" onchange="existservicecategory(this.value)" value=" {{ $ServiceType->service_name }}">
                                        <div id="existserviceprovider-message" class="text-center" style="display: none;"></div>

                            </div>
                        </div>

                        <hr class="new_hr">
                        <div class="form-group row">
                            <label class="col-xl-6">Approved</label>
                            <div class="form-outline mb-3">
                                <select class="form-select form-control form-control-lg" name="approvedstatus"
                                    id="approvedstatus" required tabindex="1">
                                    <option value="">Select</option>
                                    <option value="Y" @if ($ServiceType->status == 'Y') selected @endif>Approved
                                    </option>
                                    <option value="N" @if ($ServiceType->status == 'N') selected @endif>Not
                                        Approved
                                    </option>

                                </select>
                                <label for="approvedstatus" class="error"></label>
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

    </form>




<script>

$(document).ready(function() {
            $('#serviceprovider_name').on('input', function() {
                var inputValue = $(this).val();
                var regex = /^[a-zA-Z./& -]*$/;

                if (!regex.test(inputValue)) {
                    $(this).val(inputValue.slice(0, -
                    1));
                }
            });
        });

        function existservicecategory(category) {
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{ route('existServicetypeName') }}',
                type: 'POST',
                data: {
                    category: category
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(data) {
                    if (data.result == 1) {
                        $('#existserviceprovider-message').text('Seller/Service Provider Type Already Exists.')
                            .fadeIn();
                        $('#existserviceprovider-message').addClass('error');
                        setTimeout(function() {
                            $('#existserviceprovider-message').fadeOut();
                        }, 5000);
                        $('#serviceprovider_name').val('');
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                    } else if (data.result == 3) {
                        $('#existserviceprovider-message').text('Error in Data').fadeIn();
                        $('#existserviceprovider-message').addClass('error');
                        setTimeout(function() {
                            $('#existserviceprovider-message').fadeOut();
                        }, 5000);
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                    } else {
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                    }
                }
            });

        }



        $('#SellerServiceProviderApproved').submit(function(e) {
            e.preventDefault();
            var approvedstatus = $('#approvedstatus').val();
            if(approvedstatus=='' || approvedstatus=='0')
            {
                alert('Please select approved status');
                return false;
            }
            if ($(this).valid()) {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                $.ajax({
                    url: '{{ route('ServiceproviderApprovaltype') }}',
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
                        $('#serviceprovider-message').text(
                            'Added!').fadeIn();
                        $('#serviceprovider-message').addClass('success-message');
                        setTimeout(function() {
                            $('#serviceprovider-message').fadeOut();
                        }, 5000); // 5000 milliseconds = 5 seconds
                        $('#SellerServiceProviderApproved')[0].reset();
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#ShopApprovedModal').modal('hide');
                        shwdets();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        $('#serviceprovider-message').text('Failed.').fadeIn();
                        $('#serviceprovider-message').addClass('error');
                        setTimeout(function() {
                            $('#serviceprovider-message').fadeOut();
                        }, 5000);
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#ShopApprovedModal').modal('show');

                    }
                });
            }
        });
















    $("#SellerRegFormApproved").validate({

        rules: {

            approvedstatus: {
                required: true,

            },
        },
        messages: {
            approvedstatus: {
                required: "Please select an approved status."
            },

        },
    });



    $('#SellerRegFormApproved').submit(function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var approvedstatus = $('#approvedstatus').val();
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            $.ajax({
                url: '{{ route('AdmsellerApproved') }}',
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
                        $('#appshopreg-message').text(response.mesge).fadeIn();
                        $('#appshopreg-message').addClass('success-message');
                        setTimeout(function() {
                            $('#appshopreg-message').fadeOut();
                        }, 5000); // 5000 milliseconds = 5 seconds
                        $('#SellerRegFormApproved')[0].reset();
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#ShopApprovedModal').modal('hide');
                        shwdets();
                    } else if (response.result == 2) {
                        $('#appshopreg-message').text(response.mesge).fadeIn();
                        $('#appshopreg-message').addClass('error');
                        setTimeout(function() {
                            $('#appshopreg-message').fadeOut();
                        }, 5000); // 5000 milliseconds = 5 seconds
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                        $('#ShopApprovedModal').modal('hide');
                        shwdets();

                    } else {
                        $('#loading-image').fadeOut();
                        $('#loading-overlay').fadeOut();
                    }
                }
            });
        }
    });




</script>
