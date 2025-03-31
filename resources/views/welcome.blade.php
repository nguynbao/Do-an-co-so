<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{asset('fontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('fontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('fontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('fontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('fontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('fontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('fontend/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{asset('fontend/images/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="{{asset('fontend/images/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="{{asset('fontend/images/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="{{asset('fontend/images/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('fontend/images/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->

<body>
    @include('components.header')

    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach ($banner as $key => $slider)
                                <li data-target="#slider-carousel" data-slide-to="{{ $key }}" {{ $key == 0 ? 'class="active"' : '' }}></li>
                            @endforeach
                        </ol>

                        <div class="carousel-inner banner-wrapper">
                            @foreach ($banner as $key => $slider)

                                <div class="item {{ $key == 0 ? 'active' : '' }}">
                                    <div class="banner-container">
                                        <img src="{{ asset('uploads/banners/' . $slider->banner_image) }}"
                                            alt="{{ $slider->banner_desc }}" class="banner-image">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <a class="left carousel-control" href="#slider-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right carousel-control" href="#slider-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/slider-->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Category</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    @foreach ($category as $key => $cate)
                                        <h4 class="panel-title"><a
                                                href="{{URL::to('/danh-muc-sp/' . $cate->category_id) }}">{{ $cate->category_name }}</a>
                                        </h4>
                                    @endforeach
                                </div>
                            </div>

                        </div><!--/category-products-->

                        <div class="brands_products"><!--brands_products-->
                            <h2>Brands</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    @foreach ($brand as $key => $br)

                                        <li><a href="{{URL::to('/thuong-hieu-sp/' . $br->brand_id) }}">
                                                {{ $br->brand_name }}</a></li>
                                    @endforeach

                                </ul>
                            </div>
                        </div><!--/brands_products-->

                        <!-- price-range-->
                        <div class="price-range">
                            <h2>Price Range</h2>
                            <div class="well text-center">
                                <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600"
                                    data-slider-step="5" data-slider-value="[250,450]" id="sl2"><br />
                                <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                            </div>
                        </div>
                        <!--/price-range -->
                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>

    @include('components.footer')

    <script src="{{asset('fontend/js/jquery.js')}}"></script>
    <script src="{{asset('fontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('fontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('fontend/js/price-range.js')}}"></script>
    <script src="{{asset('fontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('fontend/js/main.js')}}"></script>
</body>

</html>