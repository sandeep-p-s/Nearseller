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
                                    <label for="addImage">Upload Image</label>
                                    <div class="card">
                                        <div class="card-body">
                                            <input type="file" id="input-file-now-custom-1" class="dropify"
                                                data-default-file="" name="category_image" />
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

        </script>
    @endsection
