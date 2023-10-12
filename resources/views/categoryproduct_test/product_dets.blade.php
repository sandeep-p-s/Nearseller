@if ($ProductCount > 0)
    @if ($flag == 1)
        <div class="row">
            @foreach ($ProductDetails as $category)
                <div class="col-md-3">
                    <div class="category-item">
                        <a href="#" onclick="showproductcategory({{ $category->categoryid }})">
                            <img src="{{ asset($category->category_image) }}"
                                alt="{{ $category->category_name }}" class="img-fluid new_image_response">
                            <h5>{{ $category->parent_id . ' ➤ ' . $category->category_id . ' ➤ ' . $category->category_name }}
                            </h5>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif ($flag == 2)
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
                            $attributesArray = [
                                $attribute->attribute_1,
                                $attribute->attribute_2,
                                $attribute->attribute_3,
                                $attribute->attribute_4,
                                $attribute->offer_price,
                                $attribute->mrp_price
                            ];

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
    <table>
        <tr>
            <td colspan="13" align="center">
                <img src="{{ asset('backend/assets/images/notfoundimg.png') }}" alt="notfound" class="rounded-circle"
                    style="width: 30%;" />
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
