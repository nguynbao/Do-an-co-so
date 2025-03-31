@extends('admin_layout');
@section('admin_content');
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Banner
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
                        <form role="form" action="{{URL::to('/save-banner')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Banner</label>
                                <input type="text" name="banner_name" class="form-control" id="exampleInputEmail1"
                                    placeholder="Tên Banner">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh</label>
                                <input type="file" name="banner_image" class="form-control" id="exampleInputEmail1"
                                    placeholder="Hình ảnh">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả</label>
                                <textarea type="text" name="banner_desc" class="form-control" id="exampleInputPassword1"
                                    placeholder="Mô tả banner"> </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Trạng Thái</label>
                                <select name="banner_status" class="form-control input-sm m-bot15">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>

                                </select>
                            </div>
                            <button type="submit" name="add_banner" class="btn btn-info">Thêm Banner</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>

    </div>
@endsection
