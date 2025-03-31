@extends('admin_layout')
@section('admin_content')

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật sản phẩm
                </header>

                @if (Session::has('message'))
                    <span class="text-alert" style="color: red; font-size: 20px; font-weight: 600;">
                        {{ Session::get('message') }}
                    </span>
                    {{ Session::forget('message') }}
                @endif

                <div class="panel-body">
                    <div class="position-center">
                        @if(isset($edit_product) && count($edit_product) > 0)
                            @foreach ($edit_product as $edit_value)
                                <form role="form" action="{{ URL::to('/update-product/' . $edit_value->product_id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="product_category">Danh mục</label>
                                        <select name="product_category" class="form-control input-sm m-bot15">
                                            @foreach ($cate_product as $cate)
                                                <option value="{{ $cate->category_id }}" {{ $cate->category_id == $edit_value->category_id ? 'selected' : '' }}>
                                                    {{ $cate->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="product_brand">Thương hiệu</label>
                                        <select name="product_brand" class="form-control input-sm m-bot15">
                                            @foreach ($brand_product as $brand)
                                                <option value="{{ $brand->brand_id }}" {{ $brand->brand_id == $edit_value->brand_id ? 'selected' : '' }}>
                                                    {{ $brand->brand_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="product_name">Tên</label>
                                        <input type="text" name="product_name" class="form-control"
                                            value="{{ old('product_name', $edit_value->product_name) }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="product_size">Kích thước</label>
                                        <input type="text" name="product_size" class="form-control"
                                            value="{{ old('product_size', $edit_value->product_size) }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="product_price">Giá</label>
                                        <input type="text" name="product_price" class="form-control"
                                            value="{{ old('product_price', $edit_value->product_price) }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="product_image">Hình ảnh</label>
                                        <input type="file" name="product_image" class="form-control">
                                        @if (!empty($edit_value->product_image))
                                            <img src="{{ asset('uploads/product/' . $edit_value->product_image) }}" width="100">
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="product_content">Nội dung</label>
                                        <textarea name="product_content" class="form-control"
                                            rows="5">{{ old('product_content', $edit_value->product_content) }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="product_desc">Tóm tắt</label>
                                        <textarea name="product_desc" class="form-control"
                                            rows="3">{{ old('product_desc', $edit_value->product_desc) }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="product_status">Trạng thái</label>
                                        <select name="product_status" class="form-control input-sm m-bot15">
                                            <option value="0" {{ $edit_value->product_status == 0 ? 'selected' : '' }}>Ẩn</option>
                                            <option value="1" {{ $edit_value->product_status == 1 ? 'selected' : '' }}>Hiển thị
                                            </option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-info">Cập nhật sản phẩm</button>
                                </form>
                            @endforeach
                        @else
                            <p class="text-center text-danger">Không tìm thấy sản phẩm!</p>
                        @endif
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection