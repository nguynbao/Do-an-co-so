@extends('admin_layout');
@section('admin_content');
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm sản phẩm
                </header>

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
                                                                                                                                      ?>
                <div class="panel-body"></div>
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục</label>
                            <select name="product_category" class="form-control input-sm m-bot15">
                                @foreach ($cate_product as $key => $cate)
                                    <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
                                @endforeach


                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thương hiệu</label>
                            <select name="product_brand" class="form-control input-sm m-bot15">
                                @foreach ($brand_product as $key => $brand)
                                    <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên</label>
                            <input type="text" name="product_name" class="form-control" id="exampleInputEmail1"
                                placeholder="Tên">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">kích thước</label>
                            <input type="text" name="product_size" class="form-control" id="exampleInputEmail1"
                                placeholder="kích thước">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá</label>
                            <input type="text" name="product_price" class="form-control" id="exampleInputEmail1"
                                placeholder="Giá">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh</label>
                            <input type="file" name="product_image" class="form-control" id="exampleInputEmail1"
                                placeholder="Hình ảnh">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung</label>
                            <textarea type="text" name="product_content" class="form-control" id="exampleInputPassword1"
                                placeholder="Nội dung"> </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tóm tắt</label>
                            <textarea type="text" name="product_desc" class="form-control" id="exampleInputPassword1"
                                placeholder="tóm tẳt"> </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Trạng Thái</label>
                            <select name="product_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>

                            </select>
                        </div>
                        <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                    </form>
                </div>

        </div>
        </section>

    </div>

    </div>
@endsection