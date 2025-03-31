@extends('admin_layout');
@section('admin_content');
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm danh mục sản phẩm
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
                        <form role="form" action="{{URL::to('/save-category')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục</label>
                                <input type="text" name="cate_product_name" class="form-control" id="exampleInputEmail1"
                                    placeholder="Tên danh mục">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả</label>
                                <textarea type="password" name="cate_product_desc" class="form-control"
                                    id="exampleInputPassword1" placeholder="Mô tả danh mục"> </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Trạng Thái</label>
                                <select name="cate_product_status" class="form-control input-sm m-bot15">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>

                                </select>
                            </div>
                            <button type="submit" name="add_brand" class="btn btn-info">Thêm danh mục</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>

    </div>
@endsection