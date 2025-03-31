@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa Thông tin
                </header>
                <div class="panel-body">
                    @if (session('message'))
                        <div class="text-alert"
                            style="text-align: center; color: red; width: 100%; font-size: 20px; font-weight: 600;">
                            {{ session('message') }}
                        </div>
                        @php session()->forget('message'); @endphp
                    @endif

                    <form role="form" action="{{ route('update_admin', $admin->admin_id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Tên admin</label>
                            <input type="text" name="admin_name" class="form-control" value="{{ $admin->admin_name }}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="admin_email" class="form-control" value="{{ $admin->admin_email }}">
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input type="password" name="admin_password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <input type="text" name="admin_phone" class="form-control" value="{{ $admin->admin_phone }}">
                        </div>

                        <button type="submit" class="btn btn-info">Cập nhật</button>
                    </form>

                </div>
            </section>
        </div>
    </div>
@endsection