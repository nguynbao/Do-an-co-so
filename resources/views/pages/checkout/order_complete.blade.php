@extends('welcome')

@section('content')

    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ URL::to('/') }}">Trang chủ</a>
                    </li>
                    <li class="active">Đặt hàng thành công</li>
                </ol>
            </div>

            <div class="order-message text-center">
                <div class="alert alert-success">
                    <h3>
                        <i class="fa fa-check-circle"></i> Cảm ơn bạn đã đặt hàng!
                    </h3>
                    <p>Đơn hàng của bạn đã được xác nhận và đang chờ xử lý.</p>
                    <p>Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.</p>

                    <div class="mt-4">
                        <a href="{{ url('/trang-chu') }}" class="btn btn-primary">
                            Tiếp tục mua sắm
                        </a>

                        @if(Auth::check())
                            <a href="{{ url('/order-history') }}" ; style="margin-top: 16px" ; class="btn btn-info">
                                Xem lịch sử đơn hàng
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection