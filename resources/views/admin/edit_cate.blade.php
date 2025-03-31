@extends('admin_layout');
@section('admin_content');
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa danh mục sản phẩm
                </header>
                @if (session()->has('message'))
                        <span class="text-alert" style="
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
                    @foreach ($edit_category_product as $key => $edit_value)
                        <div class="position-center">
                            <form role="form" action="{{URL::to('/update-category/' . $edit_value->category_id)}}"
                                method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" value="{{ $edit_value->category_name }}" name="cate_product_name"
                                        class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea type="password" name="cate_product_desc" class="form-control"
                                        id="exampleInputPassword1" value="{{ $edit_value->category_desc }}"> </textarea>
                                </div>

                                <button type="submit" name="update_cart" class="btn btn-info">Sửa danh mục</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </section>

        </div>

    </div>
@endsection