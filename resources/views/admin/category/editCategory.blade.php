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
                                <h4 class="page-title">Edit Category</h4>
                            </div>
                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div>
            <div class="button-items d-flex align-items-end flex-column">
                <a href="{{ route('list.addcategory') }}"><button type="button" class="btn btn-secondary">Back</button></a>
            </div>
            <div class="row ">
                <div class="col-lg-6">
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('update.category', $current_category->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    {{-- <label for="categorySelector">Select Type<span class="text-danger">*</span></label>
                                    <select class="form-control mb15" id="typeSelector" name="select_type">
                                        <option value="1" {{ $current_category->category_type == '1' ? 'selected' : '' }}>Shop</option>
                                        <option value="2" {{ $current_category->category_type == '2' ? 'selected' : '' }}>Service</option>
                                    </select> --}}
                                    <label for="categorySelector">Select Parent Category</label>
                                    <select class="form-control mb15" id="categorySelector" name="parent_category"
                                        onchange="updateLevel()">
                                        <option value="0">Select Parent Category</option>
                                        @if ($filteredCategories)
                                            @foreach ($filteredCategories as $category)
                                                <option
                                                    {{ $category->id == $current_category->parent_id ? 'selected' : '' }}
                                                    value="{{ $category->id }}"
                                                    data-level="{{ $category->category_level }}">
                                                    {{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <label for="exampleFormControlInput1">Category Name<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control mb15" id="exampleFormControlInput1"
                                        name="category_name" placeholder="Enter Category Name"
                                        value="{{ $current_category->category_name }}" required>
                                    <input type="hidden" class="form-control mb15" id="category_slug" placeholder=""
                                        name="category_slug" value="{{ $current_category->category_slug }}">
                                    <input type="hidden" class="form-control mb15" id="category_level" placeholder=""
                                        name="category_level" value="{{ $current_category->category_level }}">

                                    {{-- <div class="card">
                                        <input type="file" id="input-file-now-custom-1" class="dropify"
                                            data-default-file="{{ asset('storage/' . config('imageupload.categorydir') . '/' . config('imageupload.category.image') . $current_category->category_image) }}"
                                            alt="category image" width="300px" height="300px" name="category_image" accept="image/jpeg, image/png"/>
                                    </div> --}}

                                    {{-- <div class="card">
                                        <input type="file" id="input-file-now-custom-1" class="dropify"
                                            data-default-file="{{ asset($current_category->category_image)  }}"
                                            alt="category image" width="300px" height="300px" name="category_image" accept="image/jpeg, image/png"/>
                                    </div> --}}


                                    <label>Category Image</label>
                                    <input type="file" id="category_image" name="category_image"
                                        class="form-control form-control-lg mb15" placeholder="Category Images" tabindex="19"
                                        value="{{ $current_category->category_image }}"  accept="image/jpeg, image/png" />
                                    <label for="category_image" class="error"></label>






                                    @if (session('roleid') == 1 || session('roleid') == 11)
                                        <label for="categoryStatus">Status</label>
                                        <select class="form-control" id="categoryStatus" name="status">
                                            <option value="Y"
                                                {{ $current_category->status == 'Y' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="N"
                                                {{ $current_category->status == 'N' ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>
                                    @endif
                                    <br>
                                    @error('category_name')
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
                                    @error('slug_name')
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
                                    @error('category_level')
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
                                    @error('category_image')
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
                                    <br>
                                    <button type="submit" class="btn view_btn">Update</button>
                                </div>
                            </form>
                        </div><!--end card-body-->
                    </div>
                </div>
                <div class="col-lg-4" {{ $current_category->category_image ? '' : 'hidden' }}>
                    <br>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Uploaded Image</h4>
                            <p class="text-muted mb-0">You can change the image by uploading a new one.
                            </p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <img class="img-fluid" src="{{ asset('storage/' . config('imageupload.nearsellerdir') . '/' . config('imageupload.category.image') . $current_category->category_image) }}"
                                alt="category image" width="67%" height="100%">
                        </div><!--end card-body-->
                    </div>
                </div>
            </div>
        </div><!-- container -->

        <script>
            function updateLevel() {
                var select = document.getElementById("categorySelector");
                var levelInput = document.getElementById("category_level");
                var selectedOption = select.options[select.selectedIndex];
                var level = selectedOption.getAttribute("data-level");
                if (level == null) {
                    level = 0; // Default value is 0
                } else if (!isNaN(level)) {
                    level = parseInt(level) + 1;
                } else {
                    level = 0; // Default value is 0
                }

                levelInput.value = level;
            }




            // var fileArrs = [];
            // var totalFiless = 0;

            // $("#category_image").change(function(event) {
            //     //$('#image-preview').html('');
            //     var totalFileCount = $(this)[0].files.length;


            //     for (var i = 0; i < totalFileCount; i++) {
            //         var file = $(this)[0].files[i];

            //         if (file.size > 3145728) {
            //             alert('File size exceeds the limit of 3MB');
            //             $(this).val('');
            //             $('#image-preview').html('');
            //             return;
            //         }

            //         fileArrs.push(file);
            //         totalFiless++;
            //         if (totalFiless > 1) {
            //             alert('Maximum 1 images allowed');
            //             $(this).val('');
            //             $('#image-preview').html('');
            //             totalFiless = 0;
            //             fileArrs = [];
            //             return;
            //         }


            //         var reader = new FileReader();
            //         reader.onload = (function(file) {
            //             return function(event) {
            //                 var imgDiv = $('<div>').addClass('img-div col-md-3 img-container');
            //                 var img = $('<img>').attr('src', event.target.result).addClass(
            //                     'img-responsive image new_thumpnail').attr('width', '100');
            //                 var removeBtn = $('<button>').addClass('btn btn-danger remove-btns').attr(
            //                     'title', 'Remove Image').append('Remove').attr('role', file.name);

            //                 imgDiv.append(img);
            //                 imgDiv.append($('<div>').addClass('middle').append(removeBtn));
            //                 if (fileArrs.length > 0)
            //                     $('#image-preview').append(imgDiv);
            //             };
            //         })(file);

            //         reader.readAsDataURL(file);
            //     }
            //     document.getElementById('category_image').files = new FileListItem([]);
            //     document.getElementById('category_image').files = new FileListItem(fileArrs);

            // });

            // $(document).on('click', '.remove-btns', function() {
            //     var fileName = $(this).attr('role');

            //     for (var i = 0; i < fileArrs.length; i++) {
            //         if (fileArrs[i].name === fileName) {
            //             fileArrs.splice(i, 1);
            //             totalFiless--;
            //             break;
            //         }
            //     }

            //     document.getElementById('category_image').files = new FileListItem(fileArrs);
            //     $(this).closest('.img-div').remove();
            // });




            // function FileListItem(file) {
            //     file = [].slice.call(Array.isArray(file) ? file : arguments);
            //     var b = file.length;
            //     var d = true;
            //     for (var c; b-- && d;) {
            //         d = file[b] instanceof File;
            //     }
            //     if (!d) {
            //         throw new TypeError('Expected argument to FileList is File or array of File objects');
            //     }
            //     var clipboardData = new ClipboardEvent('').clipboardData || new DataTransfer();
            //     for (b = d = file.length; b--;) {
            //         clipboardData.items.add(file[b]);
            //     }
            //     return clipboardData.files;
            // }



            document.addEventListener("DOMContentLoaded", function() {
                var typeSelector = document.getElementById("typeSelector");
                var categorySelector = document.getElementById("categorySelector");
                var categorySelector = document.getElementById("category_slug");

                typeSelector.addEventListener("change", function() {
                    console.log("manu");
                    var selectedType = parseInt(typeSelector.value, 10);
                    if (selectedType !== 0 && (selectedType === 1 || selectedType === 2)) {
                        $.get("/parentcategoryedit/" + selectedType + categorySelector.value, function(data) {
                            $('#categorySelector').empty().append(
                                '<option value="0">Select Parent Category (optional)</option>');
                            $.each(data, function(index, filteredCategories) {
                                $('#categorySelector').append('<option value="' +
                                    filteredCategories.id + '" data-level="' +
                                    filteredCategories.category_level + '">' +
                                    filteredCategories
                                    .category_name + '</option>');
                            });
                        });
                    }
                });
            });
        </script>
    @endsection
