<footer class="footer text-center text-sm-left"> &copy;<a href="https://hyzventures.com/" target="_blank"> Hyz Ventures Intl Pvt Ltd</a></footer><!--end footer-->
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

        <script src="{{ asset('backend/assets/js/bootstrap-datetimepicker.min.js') }}"></script>


        <!-- App js -->
        <script src="{{ asset('backend/assets/js/app.js') }}"></script>
        <script>
        $(document).ready(function() {
            
            shwdets();
            setTimeout(() => {
                $('#datatable').DataTable();
            }, 0);
            });

            $(document).ready(function() {
                $('.carousel').carousel();
            });

            $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.activate_btn').click(function () {
                var roleId = $(this).data('role-id');
                var isActive = $(this).data('is-active');
                var $button = $(this);

                $.ajax({
                    url: '/update/activation/' + roleId,
                    type: 'POST',
                    data: {
                        isActive: isActive
                    },
                    success: function () {
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


  </script>


    </body>

</html>
