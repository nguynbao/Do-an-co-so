<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="index.html"><img src="{{asset('fontend/imagesB/logo.png')}}" alt="" /></a>
                    </div>
                    <div class="btn-group pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa"
                                data-toggle="dropdown">
                                USA
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canada</a></li>
                                <li><a href="#">UK</a></li>
                            </ul>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa"
                                data-toggle="dropdown">
                                DOLLAR
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canadian Dollar</a></li>
                                <li><a href="#">Pound</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            @if(Auth::check())
                                <li style="position: relative; display: inline-block;">
                                    <a href="{{ url('/user-profile') }}" style="text-decoration: none;">
                                        <i class="fa fa-user"></i> Welcome, {{ Auth::user()->name }}
                                    </a>
                                    <ul style="display: none; position: absolute; top: 100%; left: 0; background-color: white; padding: 10px;
                                                            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); list-style: none; min-width: 120px;"
                                        class="logout-menu">
                                        <li>
                                            <a href="{{ url('/logout') }}"
                                                style="text-decoration: none; display: block; padding: 5px;">
                                                <i class="fa fa-lock"></i> Logout
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <style>
                                    li:hover .logout-menu {
                                        display: block !important;
                                    }
                                </style>
                            @else
                                <li><a href="{{ url('/login-checkout') }}"><i class="fa fa-lock"></i> Login</a></li>
                            @endif
                            <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
                            <li><a href="{{URL::to('/check-out') }}"><i class="fa fa-crosshairs"></i> Checkout</a>
                            </li>
                            <li><a href="{{ URL::to('/show-cart') }}"><i class="fa fa-shopping-cart"></i> Cart</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="{{URL::to('/trang-chu')}}" class="active">Home</a></li>
                            <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="shop.html">Products</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#">News<i class="fa fa-angle-down"></i></a>
                            </li>
                            <li><a href="{{ URL::to('/show-cart') }}">Cart</a></li>
                            <li><a href="{{ URL::to('/show-contact') }}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <form action="{{ URL::to('/search') }}" method="post" class="search_box pull-right">
                        @csrf
                        <input type="text" name="key_word" placeholder="Search" />
                        <button type="submit" name="search_items">🔍</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->
