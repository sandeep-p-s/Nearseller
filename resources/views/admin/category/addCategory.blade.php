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
                                <h4 class="page-title">Add Category</h4>
                            </div>
                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div> <!--end row-->

            <div class="row">
                <div class="col-lg-6">
                    <div class="button-items d-flex align-items-end flex-column">
                        <a href="{{ route('list.category') }}"><button type="button"
                                class="btn btn-secondary">Back</button></a>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('store.category') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Select Parent Category</label>
                                    {{-- <select class="form-control mb15" id="exampleFormControlSelect1" name="parent_category">
                                        <option value="0">Select Parent Category</option>
                                        @foreach ($categories as $c)
                                            <option value="{{ $c->child_id }}"{{ old('parent_category') == $c->child_id ? 'selected' : '' }}>
                                                {{ $c->parent_name.'>'.$c->child_name }}
                                            </option>
                                        @endforeach
                                    </select> --}}
                                    <select class="form-control mb15" id="exampleFormControlSelect1" name="parent_category">
                                        <option value="0">Select Parent Category</option>
                                        @if ($categories)
                                            @php
                                                $indentation = ''; // Define the indentation string
                                            @endphp

                                            @foreach ($categories as $category)
                                                <option value="{{ $category->child_id }}"
                                                    @if ($loop->last) style="color: #ff0000;" @endif>
                                                    {{ str_repeat($indentation, $category->level) }}{{ $category->parent_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <label for="addShopType">Add Category</label>
                                    <input type="text" class="form-control mb15" id="category_name"
                                        placeholder="Enter Category Name" name="category_name">
                                    <input type="hidden" class="form-control mb15" id="slug_name" placeholder=""
                                        name="slug_name">
                                    @error('category_name')
                                        <div class="text-danger mb15">{{ $message }}</div>
                                    @enderror
                                    <button type="submit" class="btn view_btn">Add</button>
                                </div>
                            </form>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!--end col-->
            </div><!--end row-->

        </div><!-- container -->

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var category_name = document.getElementById("category_name");
                var slug = document.getElementById("slug_name");

                function updateSlug() {
                    var firstName = category_name.value.trim().toLowerCase().replace(/[^a-z0-9]/g, '-');
                    var randomNumber = Math.floor(Math.random() * 9000) +
                        1000; // Generates a random number between 1000 and 9999
                    slug.value = firstName + ('-' + randomNumber);
                }
                category_name.addEventListener("input", updateSlug);
            });
        </script>
    @endsection
