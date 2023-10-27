@if ($categoriesCount > 0)
    @if ($flag == 1)
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-2">
                    <div class="category-item">
                        <h5>{{ $category->category_name }}</h5>
                        <hr>
                        <a href="#" onclick="showproductcategory1({{ $category->id }})">
                            {{-- <img src="{{ asset($category->category_image) }}"
                                alt="{{ $category->category_name }}" class="img-fluid new_image_response"> --}}

                                <img src="{{ asset($category->category_image) }}"
                                alt="{{ $category->category_name }}" class="img-fluid new_image_response">

                        </a>
                    </div>
                    <div class="col text-center">
                        <a href="#" class="btn btn-danger" style="margin-top: 15px" onclick="productviewdet({{ $category->id }})">View
                           </a>

                    </div>
                </div>
            @endforeach
        </div>
    @elseif ($flag == 2)
        <hr>
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-3">
                    <div class="category-item">
                        @if (!empty($parentNames))
                            <h5>
                                @foreach ($parentNames as $parentName)
                                    {{ $parentName . ' ➤ ' }}
                                @endforeach
                                {{ $category->category_name }}
                            </h5>
                        @else
                            <h5>{{ $category->category_name }}</h5>
                        @endif
                        <hr>
                        <a href="#" onclick="showproductcategory2({{ $category->id }})">
                            <img src="{{ asset($category->category_image) }}"
                                alt="{{ $category->category_name }}" class="img-fluid new_image_response">
                        </a>


                    </div>
                    <div class="col text-center">
                        <a href="#" class="btn btn-danger" onclick="productviewdet({{ $category->id }})">View
                            Product</a>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif ($flag == 3)
        <hr>
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-3">
                    <div class="category-item">
                        @if (!empty($parentNames))
                            <h5>
                                @foreach ($parentNames as $parentName)
                                    {{ $parentName . ' ➤ ' }}
                                @endforeach
                                {{ $category->category_name }}
                            </h5>
                        @else
                            <h5>{{ $category->category_name }}</h5>
                        @endif
                        <hr>
                        <a href="#" onclick="showproductcategory3({{ $category->id }})">
                            <img src="{{ asset($category->category_image) }}"
                                alt="{{ $category->category_name }}" class="img-fluid new_image_response">
                        </a>
                    </div>
                    <div class="col text-center">
                        <a href="#" class="btn btn-danger" onclick="productviewdet({{ $category->id }})">View
                            Product</a>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif ($flag == 4)
        <hr>
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-3">
                    <div class="category-item">
                        @if (!empty($parentNames))
                            <h5>
                                @foreach ($parentNames as $parentName)
                                    {{ $parentName . ' ➤ ' }}
                                @endforeach
                                {{ $category->category_name }}
                            </h5>
                        @else
                            <h5>{{ $category->category_name }}</h5>
                        @endif
                        <hr>
                        <a href="#" onclick="showproductcategory2({{ $category->id }})">
                            <img src="{{ asset($category->category_image) }}"
                                alt="{{ $category->category_name }}" class="img-fluid new_image_response">
                        </a>
                    </div>
                    <div class="col text-center">
                        <a href="#" class="btn btn-danger" onclick="productviewdet({{ $category->id }})">View
                            Product</a>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif ($flag == 5)
        <hr>
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-3">
                    <div class="category-item">
                        @if (!empty($parentNames))
                            <h5>
                                @foreach ($parentNames as $parentName)
                                    {{ $parentName . ' ➤ ' }}
                                @endforeach
                                {{ $category->category_name }}
                            </h5>
                        @else
                            <h5>{{ $category->category_name }}</h5>
                        @endif
                        <hr>
                        <a href="#" onclick="showproductcategory4({{ $category->id }})">
                            <img src="{{ asset($category->category_image) }}"
                                alt="{{ $category->category_name }}" class="img-fluid new_image_response">
                        </a>
                    </div>
                    <div class="col text-center">
                        <a href="#" class="btn btn-danger" onclick="productviewdet({{ $category->id }})">View
                            Product</a>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif ($flag == 6)
        <hr>
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-3">
                    <div class="category-item">
                        @if (!empty($parentNames))
                            <h5>
                                @foreach ($parentNames as $parentName)
                                    {{ $parentName . ' ➤ ' }}
                                @endforeach
                                {{ $category->category_name }}
                            </h5>
                        @else
                            <h5>{{ $category->category_name }}</h5>
                        @endif
                        <hr>
                        <a href="#" onclick="showproductcategory5({{ $category->id }})">
                            <img src="{{ asset($category->category_image) }}"
                                alt="{{ $category->category_name }}" class="img-fluid new_image_response">
                        </a>
                    </div>
                    <div class="col text-center">
                        <a href="#" class="btn btn-danger" onclick="productviewdet({{ $category->id }})">View
                            Product</a>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif ($flag == 7)
        <hr>
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-3">
                    <div class="category-item">
                        @if (!empty($parentNames))
                            <h5>
                                @foreach ($parentNames as $parentName)
                                    {{ $parentName . ' ➤ ' }}
                                @endforeach
                                {{ $category->category_name }}
                            </h5>
                        @else
                            <h5>{{ $category->category_name }}</h5>
                        @endif
                        <hr>
                        <a href="#" onclick="showproductcategory6({{ $category->id }})">
                            <img src="{{ asset($category->category_image) }}"
                                alt="{{ $category->category_name }}" class="img-fluid new_image_response">
                        </a>
                    </div>
                    <div class="col text-center">
                        <a href="#" class="btn btn-danger" onclick="productviewdet({{ $category->id }})">View
                            Product</a>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif ($flag == 8)
        <hr>
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-3">
                    <div class="category-item">
                        @if (!empty($parentNames))
                            <h5>
                                @foreach ($parentNames as $parentName)
                                    {{ $parentName . ' ➤ ' }}
                                @endforeach
                                {{ $category->category_name }}
                            </h5>
                        @else
                            <h5>{{ $category->category_name }}</h5>
                        @endif
                        <hr>
                        <a href="#" onclick="showproductcategory7({{ $category->id }})">
                            <img src="{{ asset($category->category_image) }}"
                                alt="{{ $category->category_name }}" class="img-fluid new_image_response">
                        </a>
                    </div>
                    <div class="col text-center">
                        <a href="#" class="btn btn-danger" onclick="productviewdet({{ $category->id }})">View
                            Product</a>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif ($flag == 100)
        <div class="row">
            @foreach ($ProductDetails as $category)
                @php
                    $product_images = $category->product_images;
                    $gallerydetsarray = json_decode($product_images);
                    $gallery = $gallerydetsarray->fileval;
                    if ($gallery != '') {
                        $galleryval = json_decode(json_encode($gallery), true);
                        $totimg = count($galleryval);
                    } else {
                        $totimg = 0;
                    }
                @endphp
                <div class="col-md-3">
                    <div class="category-item">
                        <a href="#" onclick="showproductcategory({{ $category->categoryid }})">
                            @for ($m = 0; $m < 1; $m++)
                                <img src="{{ asset($gallery[$m]) }}" alt="{{ $category->category_name }}"
                                    class="img-fluid new_image_response">
                                <h5>{{ $category->parent_id . ' ➤ ' . $category->category_id . ' ➤ ' . $category->category_name . ' ➤ ' . $category->product_name }}
                                </h5>
                            @endfor
                        </a>
                        <div class="row">
                            @foreach ($category->attributes as $attribute)
                                @php
                                    $attributesArray = [$attribute->attribute_1, $attribute->attribute_2, $attribute->attribute_3, $attribute->attribute_4, $attribute->offer_price, $attribute->mrp_price];

                                    $filteredAttributes = [];

                                    foreach ($attributesArray as $attr) {
                                        if ($attr !== null && $attr !== 0 && !in_array($attr, $filteredAttributes)) {
                                            $filteredAttributes[] = $attr;
                                        }
                                    }
                                @endphp


                                <div class="col-md-8">
                                    {{ implode(' | ', $filteredAttributes) }}<br>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

    @endif
@else
    <br>
    <hr>
    <table>
        <tr>
            <td colspan="13" align="center">
                <img src="{{ asset('backend/assets/images/notfoundimg.png') }}" alt="notfound"
                    class="rounded-circle" style="width: 30%;" />
            </td>
        </tr>
    </table>
@endif


<script>
    scrollToElement('#myViewDiv', function() {});

    function scrollToElement(selector, callback) {
        var animation = {
            scrollTop: $(selector).offset().top
        };
        $('html,body').animate(animation, 'slow', 'swing', function() {
            if (typeof callback == 'function') {
                callback();
            }
            callback = null;
        });
    }
</script>
