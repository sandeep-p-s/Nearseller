@if ($ProductDetails->isEmpty())
    <div class="col text-center">
        <h4>
            <font color="red">Products Not Found</font>
        </h4>
    </div>
@else
    <div class="row">
        @foreach ($ProductDetails as $product)
            @php
                $product_images = json_decode($product->product_images, true);
                $carouselId = 'carouselIndicators_' . $product->id;
            @endphp

            <div class="col-md-4">
                <div class="product-box">
                    <h3>{{ $product->product_name }}</h3>
                    <p>{{ $product->product_description }}</p>

                    <div class="row">
                        @if (!empty($product_images) && is_array($product_images['fileval']))
                            <div id="{{ $carouselId }}" class="carousel slide mySlides" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($product_images['fileval'] as $index => $imagePath)
                                        <div class="carousel-item @if ($index === 0) active @endif">
                                            <img src="{{ asset($imagePath) }}" class="d-block w-100"
                                                alt="Image {{ $index }}">
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
        @endforeach
    </div>
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
            x[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" w3-white", "");
        }
        x[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " w3-white";
    }
</script>
