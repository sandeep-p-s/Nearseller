@if ($ProductDetails->isEmpty())
    <div class="col text-center">
        <h4>
            <font color="red">Products Not Found</font>
        </h4>
    </div>
@else
    <div class="text-center" style="padding: 5px; background-color: #442896; margin-bottom: 30px;}">

        <h6>
            <span style="color: white">Shop Name : {{ $usershopdets->name }}</span>
        </h6>
    </div>
    @foreach ($ProductDetails as $index => $product)

    <div class="row text-left justify-content-center" style="border: 1px solid #5940a130; margin:10px 10px 25px 10px; box-shadow: 10px 10px 30px #eaeaea,
    -10px -10px 30px #eaeaea; padding: 30px;border-radius:10px;">

            @php
                $product_images = json_decode($product->product_images, true);
                $carouselId = 'carouselIndicators_' . $product->id;
            @endphp

            <div class="col-md-4"  >

                    <h3><span class="badge badge-soft-danger p-2">Product Name : {{ $product->product_name }}</span></h3>
                    <p><u>Category </u>: {{ $product->category_name }}</p>
                    <p><i class="la la-angle-double-right text-info mr-2" style="font-size: 20px;"></i>Product Specification : {{ $product->product_specification }}</p>
                    <p><i class="la la-angle-double-right text-info mr-2" style="font-size: 20px;"></i>Manufacture : {{ $product->manufacture_details }}</p>
                    <p><i class="la la-angle-double-right text-info mr-2" style="font-size: 20px;"></i>Brand Name : {{ $product->brand_name }}</p>
                    <p><i class="la la-angle-double-right text-info mr-2" style="font-size: 20px;"></i>Total Stock : {{ $product->product_stock }}</p>
                    <p><i class="la la-angle-double-right text-info mr-2" style="font-size: 20px;"></i>Product Status : <span
                            class="badge p-2 {{ $product->product_status === 'Y' ? 'badge badge-success' : 'badge badge-danger' }}">
                            {{ $product->product_status === 'Y' ? 'Available' : 'Notavailable' }}
                        </span></p>
                    <p><i class="la la-angle-double-right text-info mr-2" style="font-size: 20px;"></i>Payment Mode : <span
                            class="badge p-2 {{ $product->paying_mode === 'cod' ? 'badge badge-success' : ($product->paying_mode === 'shop' ? 'badge badge-primary' : ($product->paying_mode === 'calshop' ? 'badge badge-warning' : 'badge badge-danger')) }}">
                            {{ $product->paying_mode === 'cod' ? 'Cash on Delivery' : ($product->paying_mode === 'shop' ? 'Buy From Shop' : ($product->paying_mode === 'calshop' ? 'Call Shop' : 'Unknown')) }}
                        </span></p>

            </div>
                 <div class="col-md-4"  style="display: flex; align-items: center; justify-content: center;flex-direction:column" >
                    @if ($product->product_status == 'Y')
                        <div class="row">
                            @foreach ($product->attributes as $attribute)
                                @php
                                    $attributesArray = [
                                        'Attribute 1' => $attribute->attribute_1,
                                        'Attribute 2' => $attribute->attribute_2,
                                        'Attribute 3' => $attribute->attribute_3,
                                        'Attribute 4' => $attribute->attribute_4,
                                        'Offer Price' => $attribute->offer_price,
                                        'MRP Price' => $attribute->mrp_price,
                                        'Stocks' => $attribute->stock_status == 1 ? 'Available' : 'Not Available',
                                        'Total Stock' => $attribute->attribute_stock,
                                    ];

                                    $filteredAttributes = [];

                                    foreach ($attributesArray as $label => $value) {
                                        if ($value !== null && $value !== 0) {
                                            if (strpos($label, 'Attribute') === false) {
                                                $filteredAttributes[] = "$label: $value";
                                            } else {
                                                $filteredAttributes[] = $value;
                                            }
                                        }
                                    }
                                @endphp

                                <div class="col-md-12">
                                    <ul>

                                        <li style="list-style-type: none;"><i class="la la-angle-double-right text-info mr-2" style="font-size: 20px;"></i>  {{ implode('   |   ', $filteredAttributes) }}<br></li>
                                    </ul>

                                </div>
                            @endforeach
                        </div>
                    @endif




                </div>
                    <div class="col-md-4 " style="display: flex; align-items: center; justify-content: center;flex-direction:column">
                        @if (!empty($product_images) && is_array($product_images['fileval']))
                            <div class="col-md-6">
                                <div id="{{ $carouselId }}" class="carousel slide mySlides">
                                    <div class="carousel-inner">
                                        @foreach ($product_images['fileval'] as $index => $imagePath)
                                            <div class="carousel-item @if ($index === 0) active @endif">
                                                <img src="{{ asset($imagePath) }}" class="d-block w-100"
                                                    alt="Image {{ $index }}"
                                                    style="width: 100px; height:200px;">
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#{{ $carouselId }}" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#{{ $carouselId }}" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                        @endif
                    </div>
                </div>
            </div>
    </div>
    @endforeach

@endif






<script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
        showDivs(slideIndex += n);
    }

    function currentDiv(n) {
        showDivs(slideIndex = n);
    }

    function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");
        if (n > x.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = x.length
        }
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "block";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" w3-white", "");
        }
        x[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " w3-white";
    }
</script>
