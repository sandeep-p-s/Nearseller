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
                <a href="{{ route('list.category') }}"><button type="button" class="btn btn-secondary">Back</button></a>
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
                                    <label for="exampleFormControlInput1">
                                        Edit Category Name</label>
                                    <input type="text" class="form-control mb15" id="exampleFormControlInput1"
                                        name="category_name" placeholder="Enter Category Name"
                                        value="{{ $current_category->category_name }}">
                                    <input type="hidden" class="form-control mb15" id="category_slug" placeholder=""
                                        name="category_slug" value="{{ $current_category->category_slug }}">
                                    <input type="hidden" class="form-control mb15" id="category_level" placeholder=""
                                        name="category_level" value="{{ $current_category->category_level }}">
                                    <label for="addImage">Edit Image</label>
                                    <div class="card">
                                        <input type="file" id="input-file-now-custom-1" class="dropify"
                                            data-default-file="{{ asset('storage/' . config('imageupload.categorydir') . '/' . config('imageupload.category.image') . $current_category->category_image) }}"
                                            alt="category image" width="300px" height="300px" name="category_image" accept="image/jpeg, image/png"/>
                                    </div>
                                    <label for="categoryStatus">Status</label>
                                    <select class="form-control" id="categoryStatus" name="status">
                                        <option value="Y" {{ $current_category->status == 'Y' ? 'selected' : '' }}>
                                            Active
                                        </option>
                                        <option value="N" {{ $current_category->status == 'N' ? 'selected' : '' }}>
                                            Inactive
                                        </option>
                                    </select>
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
                            <img class="img-fluid"
                                src="{{ asset('storage/' . config('imageupload.categorydir') . '/' . config('imageupload.category.image') . $current_category->category_image) }}"
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
        </script>
    @endsection
