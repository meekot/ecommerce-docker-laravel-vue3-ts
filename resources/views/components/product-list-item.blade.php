<!-- Start Single Product -->
<div class="single-product">
    <div class="product-image">
        <img src="{{$product['imageUrl']}}" style="max-height: 288px; object-fit: cover; object-position: 50% 50%" alt="#">
        <div class="button">
            <a href="product-details.html" class="btn"><i class="lni lni-cart"></i> Add to Cart</a>
        </div>
    </div>
    <div class="product-info">
        <!-- <span class="category">Watches</span> -->
        <h4 class="title">
            <a href="product-grids.html">{{ Str::upper($product['title']) }}</a>
        </h4>
        <!-- <ul class="review">
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star"></i></li>
            <li><span>4.0 Review(s)</span></li>
        </ul> -->
        <div class="price">
            <span>{{ $product['price'] }}€</span>
        </div>
    </div>
</div>
<!-- End Single Product -->