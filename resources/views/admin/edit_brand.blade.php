@extends('admin_layout');
@section('admin_content');
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa thương hiệu sản phẩm
                </header>
                <?php 

                                                        $message = Session::get('message');
    if ($message) {
        echo '<span class="text-alert" style="
                                                            text-align: center;
                                                            color: red;
                                                            width: 100%;
                                                            font-size: 20px;
                                                            font-weight: 600;">' . $message . '</span>';
        session()->put('message', null);
    }
                                                        ?>

                <div class="panel-body">
                    @foreach ($edit_brand_product as $key => $edit_value)
                        <div class="position-center">
                            <form role="form" action="{{URL::to('/update-brand/' . $edit_value->brand_id)}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                                    <input type="text" value="{{ $edit_value->brand_name }}" name="brand_product_name"
                                        class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea type="password" name="brand_product_desc" class="form-control"
                                        id="exampleInputPassword1" value="{{ $edit_value->brand_desc }}"> </textarea>
                                </div>

                                <button type="submit" name="update_brand" class="btn btn-info">Sửa thương hiệu</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </section>

        </div>

    </div>
@endsection