@extends('backendlayout')
@section('content')
    @include('menu')
    @include('topnav')
    <style>

    </style>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="row">
                            <div class="col">
                                <h4 class="page-title">Add Category</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="button-items d-flex align-items-end flex-column">
                        <a href="{{ route('list.category') }}"><button type="button"
                                class="btn btn-secondary">Back</button></a>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('store.category') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="categorySelector">Select Parent Category</label>
                                    <select class="form-control mb15" id="categorySelector" name="parent_category" onchange="updateLevel()">
                                        <option value="0">Select Parent Category</option>
                                        @foreach ($filteredCategories as $key => $category)
                                            <option value="{{ $category->id }}" data-level="{{ $category->category_level }}">
                                                @for ($i = 0; $i < $category->category_level; $i++)
                                                     {{-- You can add any other content here for indentation if needed --}}
                                                @endfor
                                                <span class="{{ $key === count($filteredCategories) - 1 ? 'last-child' : '' }}">{{ $category->category_name }}</span>
                                            </option>
                                        @endforeach
                                    </select>
                                     <label for="addShopType">Category Name</label>
                                    <input type="text" class="form-control mb15" id="category_name"
                                        placeholder="Enter Category Name" name="category_name">
                                    <input type="hidden" class="form-control mb15" id="slug_name" placeholder=""
                                        name="slug_name">
                                    <input type="hidden" class="form-control mb15" id="category_level" placeholder=""
                                        name="category_level">
                                    {{-- <label for="addImage">Upload Image</label>
                                    <div class="card">
                                        <div class="card-body">
                                            <input type="file" id="input-file-now-custom-1" class="dropify"
                                                data-default-file="" name="category_image" accept="image/jpeg, image/png" />
                                        </div>
                                    </div> --}}



                                   <label>Category Image</label>
                                        <input type="file" id="category_image" name="category_image[]"
                                            class="form-control form-control-lg" placeholder="Shop Photo" required
                                            tabindex="19" accept="image/jpeg, image/png" />
                                        <label for="category_image" class="error"></label>

                                    <div class="col-md-12">
                                        <div class="form-group" align="left">
                                            <div id="image-preview" class="row"></div>
                                        </div>
                                    </div>



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
                                    <button type="submit" class="btn view_btn">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var category_name = document.getElementById("category_name");
                var slug = document.getElementById("slug_name");

                function updateSlug() {
                    var firstName = category_name.value.trim().toLowerCase().replace(/[^a-z0-9]/g, '-');
                    var randomNumber = Math.floor(Math.random() * 9000) +
                        1000;
                    slug.value = firstName + ('-' + randomNumber);
                }
                category_name.addEventListener("input", updateSlug);
            });

            document.addEventListener("DOMContentLoaded", function() {
                var levelInput = document.getElementById("category_level");
                levelInput.value = 0;
            });

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


            var fileArrs = [];
    var totalFiless = 0;

    $("#category_image").change(function(event) {
        var totalFileCount = $(this)[0].files.length;
        if (totalFiless + totalFileCount > 5) {
            alert('Maximum 5 images allowed');
            $(this).val('');
            $('#image-preview').html('');
            return;
        }

        for (var i = 0; i < totalFileCount; i++) {
            var file = $(this)[0].files[i];

            if (file.size > 3145728) {
                alert('File size exceeds the limit of 3MB');
                $(this).val('');
                $('#image-preview').html('');
                return;
            }

            fileArrs.push(file);
            totalFiless++;

            var reader = new FileReader();
            reader.onload = (function(file) {
                return function(event) {
                    var imgDiv = $('<div>').addClass('img-div col-md-3 img-container');
                    var img = $('<img>').attr('src', event.target.result).addClass(
                        'img-responsive image new_thumpnail').attr('width', '100');
                    var removeBtn = $('<button>').addClass('btn btn-danger remove-btns').attr(
                        'title', 'Remove Image').append('Remove').attr('role', file.name);

                    imgDiv.append(img);
                    imgDiv.append($('<div>').addClass('middle').append(removeBtn));

                    $('#image-preview').append(imgDiv);
                };
            })(file);

            reader.readAsDataURL(file);
        }
    });

    $(document).on('click', '.remove-btns', function() {
        var fileName = $(this).attr('role');

        for (var i = 0; i < fileArrs.length; i++) {
            if (fileArrs[i].name === fileName) {
                fileArrs.splice(i, 1);
                totalFiless--;
                break;
            }
        }

        document.getElementById('category_image').files = new FileListItem(fileArrs);
        $(this).closest('.img-div').remove();
    });

            function FileListItem(file) {
        file = [].slice.call(Array.isArray(file) ? file : arguments);
        var b = file.length;
        var d = true;
        for (var c; b-- && d;) {
            d = file[b] instanceof File;
        }
        if (!d) {
            throw new TypeError('Expected argument to FileList is File or array of File objects');
        }
        var clipboardData = new ClipboardEvent('').clipboardData || new DataTransfer();
        for (b = d = file.length; b--;) {
            clipboardData.items.add(file[b]);
        }
        return clipboardData.files;
    }
        </script>
    @endsection
