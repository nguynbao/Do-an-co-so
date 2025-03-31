@extends('welcome')
@section('content')
    <div class="col-sm-9 padding-right">
        <div class="product-details"><!--product-details-->
            @foreach ($details_product as $key => $pro)
                <div class="col-sm-5">
                    <div class="view-product">
                        <img src="{{ asset('uploads/products/' . $pro->product_image) }}" alt="" />
                        <h3>ZOOM</h3>
                    </div>

                </div>
                <div class="col-sm-7">
                    <div class="product-information"><!--/product-information-->

                        <h1>{{ $pro->product_name }}</h1>
                        <!-- <p>{{ $pro->product_desc }}</p> -->
                        <form action="{{ URL::to('/add-cart') }}" method="post">
                            @csrf
                            <span>
                                <span>{{ number_format($pro->product_price, 0, ',', '.') }} VNĐ</span>
                                <label>Quantity:</label>
                                <input name="qty" type="number" min="1" value="1" />
                                <input name="productid_hidden" type="hidden" value="{{ $pro->product_id }}" />
                                <button type="submit" class="btn btn-fefault cart">
                                    <i class="fa fa-shopping-cart"></i>
                                    Add to cart
                                </button>
                            </span>
                        </form>
                        <p><b>Availability:</b> In Stock</p>
                        <p><b>Mã ID:</b> {{ $pro->product_id }}</p>
                        <p><b>Category:</b> {{ $pro->category_name }}</p>
                        <p><b>Brand:</b> {{ $pro->brand_name }}</p>
                        <a href=""><img src="images/product-details/share.png" class="share img-responsive" alt="" /></a>
                    </div><!--/product-information-->
                </div>
            @endforeach
        </div><!--/product-details-->
        <!-- <div class="category-tab shop-details-tab ">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
                            <li><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="details">
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{asset('public/fontend/images/gallery1.jpg') }}" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <button type="button" class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i><a
                                                    href="{{URL::to('/them-vao-gio-hang/' . $pro->product_id) }}">Add to
                                                    cart</a></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade active in" id="reviews">
                            <div class="col-sm-12">
                                <ul>
                                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                                    labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                    nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate
                                    velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                <p><b>Write Your Review</b></p>

                                <form action="#">
                                    <span>
                                        <input type="text" placeholder="Your Name" />
                                        <input type="email" placeholder="Email Address" />
                                    </span>
                                    <textarea name=""></textarea>
                                    <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                                    <button type="button" class="btn btn-default pull-right">
                                        Submit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>/category-tab -->

        <div class="recommended_items"><!--recommended_items-->
            <h2 class="title text-center">recommended items</h2>

            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active">
                        @foreach ($related_product as $key => $rela)
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ asset('uploads/products/' . $rela->product_image) }}" alt="" />
                                            <h2>{{ number_format($rela->product_price, 0, ',', '.') }} VNĐ</h2>
                                            <p>{{ $rela->product_name }}</p>
                                            <button type="button" class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i>Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>

        </div><!--/recommended_items-->
    </div>
@endsection