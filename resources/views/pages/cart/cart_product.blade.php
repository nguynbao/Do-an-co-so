@extends('welcome')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ URL::to('/trang-chu') }}">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (!empty($cart) && count($cart) > 0)
                <div class="table-responsive cart_info">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="image">Item</td>
                                <td class="price">Price</td>
                                <td class="quantity">Quantity</td>
                                <td class="total">Total</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $key => $value)
                                <tr>
                                    <td class="cart_product">
                                        <a href="{{ asset('uploads/products/' . $value['image']) }}" target="_blank">
                                            <img src="{{ asset('uploads/products/' . $value['image']) }}" width="100">
                                        </a>
                                    </td>
                                    <td class="cart_price">
                                        <p>{{ number_format($value['price'], 0, ',', '.') }} VNĐ</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">
                                            <a class="cart_quantity_up"
                                                href="{{ URL::to('/update-cart/' . $value['id'] . '/increase') }}"> + </a>
                                            <input class="cart_quantity_input" type="text" name="quantity"
                                                value="{{ $value['quantity'] }}" readonly size="2">
                                            <a class="cart_quantity_down"
                                                href="{{ URL::to('/update-cart/' . $value['id'] . '/decrease') }}"> - </a>
                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">
                                            {{ number_format($value['price'] * $value['quantity'], 0, ',', '.') }} VNĐ
                                        </p>
                                    </td>
                                    <td class="cart_delete">
                                        <a class="cart_quantity_delete" href="{{ URL::to('/xoa-cart/' . $value['id']) }}"><i
                                                class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p style="font-size: 23px; margin-bottom: 20px;" class="text-center">Your cart is empty.</p>
            @endif
        </div>
    </section> <!--/#cart_items-->

    <section id="do_action">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="total_area"
                        style="padding: 15px; background: #f8f9fa; border-radius: 8px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                        <ul style="list-style: none; margin: 0; padding: 0;">
                            <li
                                style="padding: 10px 15px; font-size: 16px; color: #333; border-bottom: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center;">
                                Total <span
                                    style="font-weight: bold; color: rgb(84, 105, 201);">{{ number_format($total, 0, ',', '.') }}
                                    VNĐ</span>
                            </li>

                            @if(Session::has('coupon'))
                                <li
                                    style="padding: 10px 15px; font-size: 16px; color: #333; border-bottom: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center;">
                                    Coupon: {{ Session::get('coupon')['name'] }}
                                    <a href="{{ url('/remove-coupon') }}"
                                        style="font-size: 12px; padding: 5px 10px; border-radius: 5px; background: #d9534f; color: white; text-decoration: none; border: none;">Xóa</a>
                                </li>
                                <li
                                    style="padding: 10px 15px; font-size: 16px; color: #333; border-bottom: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center;">
                                    Discount <span
                                        style="font-weight: bold; color: #28a745;">-{{ number_format(Session::get('coupon')['discount'], 0, ',', '.') }}
                                        VNĐ</span>
                                </li>
                                <li
                                    style="padding: 10px 15px; font-size: 16px; color: #333; border-bottom: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center;">
                                    Final Total <span
                                        style="font-weight: bold; color: rgb(84, 105, 201);">{{ number_format($final_total, 0, ',', '.') }}
                                        VNĐ</span>
                                </li>
                            @endif

                            <li
                                style="padding: 10px 15px; font-size: 16px; color: #333; display: flex; justify-content: space-between; align-items: center;">
                                Shipping fee <span style="font-weight: bold; color: #28a745;">Free</span>
                            </li>
                        </ul>

                        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 15px;">
                            @if(!empty($cart) && count($cart) > 0)
                                <form action="{{ URL::to('/check-coupon') }}" method="post"
                                    style="display: flex; flex-grow: 1;">
                                    @csrf
                                    <input type="text" name="coupon" class="form-control" placeholder="Nhập mã giảm giá"
                                        style="width: 60%; padding: 8px; border: 1px solid #ccc; border-radius: 5px; margin-right: 10px;">
                                    <input type="submit" class="btn btn-default check_coupon" name="check_coupon"
                                        value="Áp dụng"
                                        style="background: rgb(84, 105, 201); color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer;">
                                </form>
                                <a class="btn btn-default check_out" href="{{ URL::to('/checkout') }}"
                                    style="background: #28a745; color: white; border: none; padding: 8px 15px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                                    Buy
                                </a>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section><!--/#do_action-->
@endsection