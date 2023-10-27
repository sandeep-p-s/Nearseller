@if ($ProductDetails->isEmpty())
    <div class="col text-center">
        <h4>
            <font color="red">Products Not Found</font>
        </h4>
    </div>
@else
    <div class="container-fluid">

        <div class="row mt-4">
            <div class="col-12">
                <div class="card calendar-cta" >
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <img src="{{ asset('img/shopimage.png') }}" alt="" class="" height="150">
                            </div>
                            <div class="col d-flex align-items-left flex-column justify-content-center">

                                <p></p><p></p><br><br>
                                <h5 class="font-20"> {{ $usershopdets->name }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>




    {{-- <div class='col text-center badge badge-soft-info p-2'><h4><font color='red'>Shop Name : {{ $usershopdets->name }}</font></h4></div> --}}
    @foreach ($ProductDetails as $index => $product)
        <div class="row text-left justify-content-center"
            style="border: 1px solid #5940a130; margin:10px 10px 25px 10px; box-shadow: 10px 10px 30px #eaeaea,
    -10px -10px 30px #eaeaea; padding: 30px;border-radius:10px;">

            @php
                $product_images = json_decode($product->product_images, true);
                $carouselId = 'carouselIndicators_' . $product->id;

                $paymodes = $product->paying_mode;
                $explodepaymode = explode(',', $paymodes);
                $cashdeposit = $explodepaymode[0];
                $fromshop = $explodepaymode[1];
                $calshop = $explodepaymode[2];

            @endphp

            <div class="col-md-4">
                <div class="card" style="height: 500px">
                    <div class="card-body">

                        <h3><span class="badge badge-soft-danger p-2">Product Name : {{ $product->product_name }}</span>
                        </h3>
                        <p><u>Category </u>: {{ $product->category_name }}</p>
                        <p><i class="la la-angle-double-right text-info mr-2" style="font-size: 20px;"></i>Product
                            Specification
                            : {{ $product->product_specification }}</p>

                        @if ($product->manufacture_details != '')
                            <p><i class="la la-angle-double-right text-info mr-2"
                                    style="font-size: 20px;"></i>Manufacture :
                                {{ $product->manufacture_details }}</p>
                        @endif
                        @if ($product->brand_name != '')
                            <p><i class="la la-angle-double-right text-info mr-2" style="font-size: 20px;"></i>Brand
                                Name :
                                {{ $product->brand_name }}</p>
                        @endif
                        {{-- <p><i class="la la-angle-double-right text-info mr-2" style="font-size: 20px;"></i>Total Stock :
                    {{ $product->product_stock }}</p> --}}
                        <p><i class="la la-angle-double-right text-info mr-2" style="font-size: 20px;"></i>Product
                            Status :
                            <span style="font-size: 10px !important;"
                                class="badge p-2 {{ $product->product_status === 'Y' ? 'badge badge-success' : 'badge badge-danger' }}">
                                {{ $product->product_status === 'Y' ? 'Available' : 'Notavailable' }}
                            </span>
                        </p>
                        <p><i class="la la-angle-double-right text-info mr-2" style="font-size: 20px;"></i>Payment Modes
                            :

                            <span style="font-size: 10px !important;"
                                class="badge p-2 {{ $cashdeposit === '1' ? 'badge badge-info' : '' }}">
                                {{ $cashdeposit === '1' ? 'Cash on Delivery' : '' }}
                            </span>

                            <span style="font-size: 10px !important;"
                                class="badge p-2 {{ $fromshop === '1' ? 'badge badge-info' : '' }}">
                                {{ $fromshop === '1' ? 'Buy From Shop' : '' }}
                            </span>

                            <span style="font-size: 10px !important;"
                                class="badge p-2 {{ $calshop === '1' ? 'badge badge-info' : '' }}">
                                {{ $calshop === '1' ? 'Call Shop' : '' }}
                            </span>

                        </p>
                    </div>
                </div>

            </div>



            <div class="col-md-4"
                style="display: flex; align-items: center; justify-content: center;flex-direction:column">
                <div class="card" style="height: 500px">
                    <div class="card-body">
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
                                            // 'Total Stock' => $attribute->attribute_stock,
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

                                            <li style="list-style-type: none;"><i
                                                    class="la la-angle-double-right text-info mr-2"
                                                    style="font-size: 20px;"></i>
                                                {{ implode('   |   ', $filteredAttributes) }}<br></li>
                                        </ul>

                                    </div>
                                @endforeach
                            </div>
                    </div>
                </div>
    @endif




    </div>
    <div class="col-md-4 " style="display: flex; align-items: center; justify-content: center;flex-direction:column">
        <div class="card" style="height: 500px">
            <div class="card-body">
                @if (!empty($product_images) && is_array($product_images['fileval']))
                    <div class="col-md-12">
                        <div id="{{ $carouselId }}" class="carousel slide mySlides" style="width: 100%">
                            <div class="carousel-inner">
                                @foreach ($product_images['fileval'] as $index => $imagePath)
                                    <div class="carousel-item @if ($index === 0) active @endif">
                                        <img src="{{ asset($imagePath) }}" class="d-block w-100"
                                            alt="Image {{ $index }}" style="width: 100%; height:400px;object-fit:cover">
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
