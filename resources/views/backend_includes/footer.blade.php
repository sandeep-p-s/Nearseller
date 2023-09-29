<footer class="footer text-center text-sm-left"> &copy;<a href="https://hyzventures.com/" target="_blank"> Hyz Ventures
        Intl Pvt Ltd</a></footer><!--end footer-->
</div>
<!-- end page content -->
</div>
<!-- end page-wrapper -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>



<!-- jQuery  -->
{{-- <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script> --}}
<script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('backend/assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/moment.js') }}"></script>
<script src="{{ asset('backend/assets/js/metismenu.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/waves.js') }}"></script>
<script src="{{ asset('backend/assets/js/feather.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/simplebar.min.js') }}"></script>
{{-- <script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script> --}}
<script src="{{ asset('backend/assets/js/bootstrap-datetimepicker.min.js') }}"></script>

<!-- Required datatable js -->
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Buttons examples -->
<script src="{{ asset('backend/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/buttons.colVis.min.js') }}"></script>
<!-- Responsive examples -->
<script src="{{ asset('backend/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/assets/pages/jquery.datatable.init.js') }}"></script>

<script src="{{ asset('backend/plugins/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('backend/assets/pages/jquery.form-upload.init.js') }}"></script>
<script src="{{ asset('backend/plugins/repeater/jquery.repeater.min.js') }}"></script>
<script src="{{ asset('backend/assets/pages/jquery.form-repeater.js') }}"></script>
<script src="{{ asset('backend/plugins/select2/select2.min.js') }}"></script>






<!-- App js -->
<script src="{{ asset('backend/assets/js/app.js') }}"></script>
<script>
    $(document).ready(function() {

        shwdets();
        setTimeout(() => {
            $('#datatable').DataTable();
        }, 0);

        $('.carousel').carousel();

        var url = "{{ route('ShopNameSearch') }}"
        $('#shopid').autocomplete({
            source: function(request, response) {
                $.post(url, {
                    shopname: request.term
                }, function(data) {
                    var options = [];
                    if (data.length > 0) {
                        data.forEach(function(shopdets) {
                            var optionText = shopdets.id + ' - ' + shopdets
                            .shopname;
                            options.push({
                                value: optionText,
                                label: optionText
                            });
                        });
                    }
                    response(options);
                }, 'json');
            },
            minLength: 1
        });

    });





    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.activate_btn').click(function() {
            var roleId = $(this).data('role-id');
            var isActive = $(this).data('is-active');
            var $button = $(this);

            $.ajax({
                url: '/update/activation/' + roleId,
                type: 'POST',
                data: {
                    isActive: isActive
                },
                success: function() {
                    isActive = !isActive;
                    $button.data('is-active', isActive);
                    $button.text(isActive ? 'Deactivate' : 'Activate');
                    $('#success-message').fadeIn('fast', function() {
                        setTimeout(function() {
                            $('#success-message').fadeOut('fast');
                        }, 1000);
                    });

                }
            });
        });
    });

    setTimeout(function() {
        $('#successMessage').fadeOut('slow');
    }, 2000);

    $(document).ready(function() {
        $('#PasswordChangeForm').validate({
            rules: {
                s_email: {
                    required: true,
                    maxlength: 75,
                    email: true
                },
                u_paswd: {
                    required: true,
                    minlength: 6,
                    strongPassword: true
                },
                u_rpaswd: {
                    required: true,
                    equalTo: "#u_paswd"
                }
            },
            messages: {
                s_email: {
                    email: "Please enter a valid email address.",
                },
            },

        });
        $.validator.addMethod("strongPassword", function(value, element) {
            return this.optional(element) ||
                /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}$/.test(value);
        }, "Password must contain at least one letter, one number, and one special character.");

        $('#PasswordChangeForm').submit(function(e) {
            e.preventDefault();
            if ($(this).valid()) {
                var formData = $(this).serialize();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $('#loading-overlay').fadeIn();
                $('#loading-image').fadeIn();
                $.ajax({
                    url: '{{ route('ChangeNewPassword') }}',
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        var mobemailmesge = response.mesge;
                        if (response.result == 1) {
                            $('#changepass-message').text(mobemailmesge).fadeIn();
                            $('#changepass-message').addClass('success-message');
                            setTimeout(function() {
                                $('#changepass-message').fadeOut();
                            }, 5000);
                            $('#u_paswd').val('');
                            $('#u_rpaswd').val('');
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();
                            window.location.href = '{{ route('logout') }}';

                        } else if (response.result == 2) {
                            $('#changepass-message').text(mobemailmesge).fadeIn();
                            $('#changepass-message').addClass('error');
                            setTimeout(function() {
                                $('#changepass-message').fadeOut();
                            }, 5000);
                            $('#loading-image').fadeOut();
                            $('#loading-overlay').fadeOut();

                        }

                    }
                });
            }
        });
    });
</script>


</body>

</html>
