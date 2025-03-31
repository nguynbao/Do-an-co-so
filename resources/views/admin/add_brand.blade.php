@extends('admin_layout');
@section('admin_content');
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm thương hiệu sản phẩm
                </header>
                <div class="panel-body">
                    @if (session('message'))
                                <div class="text-alert" style="
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
                        <form role="form" action="{{URL::to('/save-brand')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Thương hiệu</label>
                                <input type="text" name="brand_product_name" class="form-control" id="exampleInputEmail1"
                                    placeholder="Tên Thương hiệu">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả</label>
                                <textarea type="password" name="brand_product_desc" class="form-control"
                                    id="exampleInputPassword1" placeholder="Mô tả Thương hiệu"> </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Trạng Thái</label>
                                <select name="brand_product_status" class="form-control input-sm m-bot15">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>

                                </select>
                            </div>
                            <button type="submit" name="add_cate" class="btn btn-info">Thêm Thương hiệu</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>

    </div>
@endsection