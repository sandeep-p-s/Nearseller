

@if($attributescount > 0)
<table id="datatable" class="table table-striped table-bordered" >
        <thead>
            <tr>
                <th>SINO</th>
                <th>Attribute Name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attributeslist as $index => $attributes)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $attributes->attribute_name }}</td>
                    <td><span class="badge  p-2 {{ $attributes->status === 'Y' ? 'badge badge-success' : 'badge badge-danger' }}">
                        {{ $attributes->status === 'Y' ? 'Active' : 'Inactive' }}
                    </span></td>
                    <td>
                        <div class="btn-group mb-2 mb-md-0">
                            <button type="button" class="btn view_btn dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                <i class="mdi mdi-chevron-down"></i></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item view_btn1" href="#" onclick="attributevieweditdet({{ $attributes->id }})">View/Edit</a>

                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <table>
        <tr><td colspan="13" align="center">
            <img src="{{ asset('backend/assets/images/notfoundimg.png') }}" alt="notfound" class="rounded-circle" style="width: 30%;" />
        </td></tr>
    </table>
@endif



<!-- Modal Add New -->
<div class="modal fade" id="addNewModal" tabindex="-1" aria-labelledby="addNewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="addNewModalLabel">Add New Attributes </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Close">x</button>
            </div>
            <div class="modal-body">


                <form id="AttributeForm" enctype="multipart/form-data" method="POST">
                <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-outline mb-3"><label >Attribute Name</label>
                            <input type="text" id="att_name" name="att_name" class="form-control form-control-lg" maxlength="50"  placeholder="Attribute Name" required  tabindex="1" />
                            <label for="s_name" class="error"></label>
                        </div>

                    </div>


                    <div class="col-md-12">
                        <div style="float:right">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div id="addattr-message"  class="text-center" style="display: none;"></div>
                    </div>


                 </div>
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


        $("#AttributeForm").validate({

            rules: {
                att_name: {
                    required: true,
                    pattern: /^[A-Za-z\s\.]+$/,
                },

            },
            messages: {
                att_name: {
                    pattern: "Only characters, spaces, and dots are allowed.",
                }
            },
            });
            $('#att_name').on('input', function() {
            var value = $(this).val();
            value = value.replace(/[^A-Za-z\s\.]+/, '');
            $(this).val(value);
            });

            $('#AttributeForm').submit(function(e) {
            e.preventDefault();
            if ($(this).valid()) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('#loading-overlay').fadeIn();
            $('#loading-image').fadeIn();
            $.ajax({
                url: '{{ route("AddAttributeForm") }}',
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                headers: {
                'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    console.log(response);
                    $('#addattr-message').text('Successfully Added').fadeIn();
                    $('#addattr-message').addClass('success-message');
                    setTimeout(function() {
                        $('#addattr-message').fadeOut();
                    }, 5000); // 5000 milliseconds = 5 seconds
                    $('#AttributeForm')[0].reset();
                    $('#loading-image').fadeOut();
                    $('#loading-overlay').fadeOut();
                    $('#addNewModal').modal('hide');
                    shwdets();


                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    $('#addattr-message').text('Registration failed.').fadeIn();
                    $('#addattr-message').addClass('error');
                    setTimeout(function() {
                        $('#addattr-message').fadeOut();
                    }, 5000);
                    $('#loading-image').fadeOut();
                    $('#loading-overlay').fadeOut();
                    $('#addNewModal').modal('show');

                }
            });
            }
            });



            var mm = 1;
            $(document).ready(function(){
                $('#addMoreurls').click(function(event){
                    event.preventDefault();
                        mm++;
                        var recRowm = '<div class="row mb-5" id="addedfieldurl'+mm+'"><div class="col-md-3 fv-row fv-plugins-icon-container"><select class="form-select form-control form-control-lg" id="mediatype'+mm+'" name="mediatype['+mm+']"><option selected="">Choose...</option><option value="1">Facebook</option><option value="2">Instagram</option><option value="3">Linked In</option><option value="4">Web site URL</option><option value="5">Youtub Video URL</option></select></div><div class="col-md-9 fv-row fv-plugins-icon-container"><div class="input-group"><input type="text"  id="mediaurl'+mm+'" name="mediaurl['+mm+']" class="form-control form-control-lg" placeholder="https://"  value="" tabindex="22"  maxlength="60"/><div align="right"><button id="removeRowurl'+mm+'" type="button" name="add_fieldurl" class="btn btn-danger" onclick="removeRowurl('+mm+');" >-</button></div></div></div>';
                    $('#addedUrls').append(recRowm);
                });
            });

            function removeRowurl(rowNum){
                    $('#addedfieldurl'+rowNum).remove();
                }









    </script>

