@if ($ProductDetails->isEmpty())
<div class="col text-center">
    <h4><font color="red">Products Not Found</font></h4>
</div>
@else
<div class="row">
    @foreach ($ProductDetails as $product)
        <div class="col-md-4">
            <div class="product-box">
                <h3>{{ $product->product_name }}</h3>
                <p>{{ $product->product_description }}</p>
            </div>
        </div>
    @endforeach
</div>
@endif
