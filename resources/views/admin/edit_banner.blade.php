@extends('admin_layout');
@section('admin_content');
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa Banner
                </header>
                <div class="panel-body">
                    @if (session('message'))
                        <div class="text-alert"
                            style="text-align: center;
                                  color: red;
                                  width: 100%;
                                  font-size: 20px;
                                  font-weight: 600;">
                            {{ session('message') }}
                        </div>
                        @php session()->forget('message'); @endphp
                    @endif
                    @foreach ($edit_banner as $key => $edit_value)
                        <div class="position-center">
                            <form role="form" action="{{URL::to('/update-banner/' . $edit_value->banner_id)}}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Banner</label>
                                    <input type="text" name="banner_name" class="form-control" id="exampleInputEmail1"
                                        placeholder="Tên Banner" value="{{ $edit_value->banner_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh hiện tại</label>
                                    @if($edit_value->banner_image)
                                    <div>
                                        <img src="{{ asset('uploads/banners/'.$edit_value->banner_image) }}" width="100" height="100">
                                    </div>
                                    @else
                                    <div>Không có hình ảnh</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Thay đổi hình ảnh</label>
                                    <input type="file" name="banner_image" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea name="banner_desc" class="form-control" id="exampleInputPassword1"
                                        placeholder="Mô tả banner">{{ $edit_value->banner_desc }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Trạng Thái</label>
                                    <select name="banner_status" class="form-control input-sm m-bot15">
                                        <option value="0" {{ $edit_value->banner_status == 0 ? 'selected' : '' }}>Ẩn</option>
                                        <option value="1" {{ $edit_value->banner_status == 1 ? 'selected' : '' }}>Hiển thị</option>
                                    </select>
                                </div>
                                <button type="submit" name="update_banner" class="btn btn-info">Cập nhật Banner</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
@endsection
