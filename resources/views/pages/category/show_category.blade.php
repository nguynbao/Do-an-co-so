@extends('welcome')
@section('content')
    <div class="features_items"><!--features_items-->
        @foreach ($cate_name as $key => $cate)
            <h2 class="title text-center">Danh mục {{ $cate->category_name }} </h2>
        @endforeach

        <div class="row">
            @foreach ($category_by_id as $key => $pro)
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <a href="{{ URL::to('/chi-tiet-san-pham/' . $pro->product_id) }}">
                                    <img src="{{ asset('uploads/products/' . $pro->product_image) }}" alt=""
                                        class="img-responsive" />
                                    <h2>{{ number_format($pro->product_price, 0, ',', '.') }} VNĐ</h2>
                                    <p>{{ $pro->product_name }}</p>
                                </a>
                                <a href="#" class="btn btn-default add-to-cart">
                                    <i class="fa fa-shopping-cart"></i> add to cart
                                </a>
                            </div>
                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="#"><i class="fa fa-plus-square"></i> Wishlist</a></li>
                                <!-- <li><a href="#"><i class="fa fa-plus-square"></i> So sánh</a></li> -->
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Xuống dòng sau mỗi 3 sản phẩm --}}
                @if (($key + 1) % 3 == 0)
                    <div class="clearfix"></div>
                @endif

            @endforeach
        </div>

    </div><!--features_items-->
@endsection