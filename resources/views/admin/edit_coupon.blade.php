@extends('admin_layout');
@section('admin_content');
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa Mã giảm giá
                </header>
                <div class="panel-body">
                    @if (session('message'))
                        <div class="text-alert"
                            style="
                                                                                                                                                                                 text-align: center;
                                                                                                                                                                                 color: red;
                                                                                                                                                                                 width: 100%;
                                                                                                                                                                                 font-size: 20px;
                                                                                                                                                                                 font-weight: 600;">
                            {{ session('message') }}
                        </div>
                        @php session()->forget('message'); @endphp
                    @endif

                    <div class="position-center">
                        <form role="form" action="{{URL::to('/save-coupon')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mã giảm giá</label>
                                <input type="text" name="coupon_name" class="form-control" id="exampleInputEmail1"
                                    placeholder="Mã giảm giá">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mức giảm</label>
                                <textarea type="password" name="coupon_desc" class="form-control" id="exampleInputPassword1"
                                    placeholder="Mức giảm"> </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hạn dùng</label>
                                <input type="text" name="coupon_date" class="form-control" id="exampleInputEmail1"
                                    placeholder="Mã giảm giá">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số lượng</label>
                                <input type="text" name="coupon_quantity" class="form-control" id="exampleInputEmail1"
                                    placeholder="Mã giảm giá">
                            </div>

                            <button type="submit" name="update_coupon" class="btn btn-info">Sửa coupon</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>

    </div>
@endsection