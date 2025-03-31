@extends('welcome')
@section('content')
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Kết quả tìm kiếm</h2>
        @foreach ($search_product as $key => $search)
            <a href="{{URL::to('/chi-tiet-san-pham/' . $search->product_id) }}">
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('uploads/products/' . $search->product_image) }}" alt="" />
                                <h2>{{ number_format($search->product_price, 0, ',', '.') }} VNĐ</h2>
                                <p>{{ $search->product_name }}</p>
                                <a href="{{ URL::to('/chi-tiet-san-pham/' . $search->product_id) }}"
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