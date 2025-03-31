@extends('welcome')
@section('content')
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">New Products</h2>
        @foreach ($all_product as $key => $pro)
            <a href="{{URL::to('/chi-tiet-san-pham/' . $pro->product_id) }}">
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('uploads/products/' . $pro->product_image) }}" alt="" />
                                <h2>{{ number_format($pro->product_price, 0, ',', '.') }} VNĐ</h2>
                                <p>{{ $pro->product_name }}</p>
                                <a href="{{ URL::to('/chi-tiet-san-pham/' . $pro->product_id) }}"
                                    class="btn btn-default add-to-cart">Detail product</a>
                            </div>
                        </div>
                        <div class="choose">    
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div><!--features_items-->
@endsection