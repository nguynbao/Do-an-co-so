@extends('admin_layout');
@section('admin_content');
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa thông tin Khách Hàng
                </header>
                @if (session()->has('message'))
                    <span class="text-alert"
                        style="
                                                                                                                                                                                                            text-align: center;
                                                                                                                                                                                                            color: red;
                                                                                                                                                                                                            width: 100%;
                                                                                                                                                                                                            font-size: 20px;
                                                                                                                                                                                                            font-weight: 600;">
                        {{ session('message') }}
                    </span>
                    {{ session()->forget('message') }}
                @endif


                <div class="panel-body">
                    @foreach ($edit_customer as $key => $edit_value)

                        <div class="position-center">
                            <form role="form" action="{{ url('/update-customer/' . $edit_value->id) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Khách Hàng</label>
                                    <input type="text" value="{{ $edit_value->name }}" name="name" class="form-control"
                                        id="exampleInputEmail1" placeholder="Tên khách hàng">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" value="{{ $edit_value->email }}" name="email" class="form-control"
                                        id="exampleInputEmail1" placeholder="email khách hàng">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input type="text" value="{{ $edit_value->phone }}" name="phone" class="form-control"
                                        id="exampleInputEmail1" placeholder="Số điện thoại">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input type="text" value="{{ $edit_value->password }}" name="password" class="form-control"
                                        id="exampleInputEmail1" placeholder="password">
                                </div>

                                <button type="submit" name="update_customer" class="btn btn-info">Sửa thông tin khách
                                    hàng</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </section>

        </div>

    </div>
@endsection