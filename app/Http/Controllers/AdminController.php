<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Models\Social; //sử dụng model Social
use App\Models\Login;
use Illuminate\Support\Facades\Auth;


use Laravel\Socialite\Facades\Socialite; //sử dụng Socialite

class AdminController extends Controller
{
    public function login_facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook()
    {
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider', 'facebook')->where('provider_user_id', $provider->getId())->first();

        if ($account) {
            //login in vao trang quan tri
            $account_name = Login::where('admin_id', $account->user)->first();
            Session::put('admin_name', $account_name->admin_name);
            Session::put('admin_id', $account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        } else {

            $Bao = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = Login::where('admin_email', $provider->getEmail())->first();

            if (!$orang) {
                $orang = Login::create([

                    'admin_name' => $provider->getName(),
                    'admin_email' => $provider->getEmail(),
                    'admin_password' => '',
                    'admin_phone' => '',
                ]);
            }
            $Bao->login()->associate($orang);
            $Bao->save();

            $account_name = Login::where('admin_id', $account->user)->first();

            Session::put('admin_name', $account_name->admin_name);
            Session::put('admin_id', $account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        }
    }

    public function check()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function index()
    {
        return view('admin_login');
    }

    public function show_dashboard()
    {
        $this->check();
        if (!Session::has('admin_id')) {
            return Redirect::to('/admin')->with('error', 'Bạn chưa đăng nhập');
        }
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        $admin = DB::table('tbl_admin')
            ->where('admin_email', $admin_email)
            ->where('admin_password', $admin_password)
            ->first();


        if ($admin == true) {
            Session::put('admin_name', $admin->admin_name);
            Session::put('admin_id', $admin->admin_id);
            return Redirect::to('/dashboard'); // Chuyển hướng đến dashboard
        } else {
            Session::put('message', 'Email hoặc mật khẩu không đúng!');
            return Redirect::to('/admin'); // Quay lại trang đăng nhập
        }
    }
    public function logout()
    {
        $this->check();
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return view('admin');
    }


    public function show_info_admin()
    {
        $admin_id = Session::get('admin_id'); // Lấy ID admin từ session
        if (!$admin_id) {
            return redirect('/admin')->with('error', 'Bạn chưa đăng nhập!');
        }

        // Truy vấn thông tin admin từ database
        $admin = DB::table('tbl_admin')->where('admin_id', $admin_id)->first();
        // dd($admin);
        if (!$admin) {
            return redirect('/admin')->with('error', 'Không tìm thấy thông tin admin!');
        }

        return view('admin.show_info_admin')->with('admin', $admin);
    }

    public function edit_admin()
    {
        $admin_id = Session::get('admin_id');
        $admin = DB::table('tbl_admin')->where('admin_id', $admin_id)->first(); // Thêm `first()` để lấy object thay vì collection

        if (!$admin) {
            return redirect('/admin')->with('error', 'Không tìm thấy thông tin admin!');
        }

        return view('admin.edit_admin', compact('admin'));
    }

    public function update_admin(Request $request, $id)
    {
        $this->check(); // Kiểm tra admin có đăng nhập không

        $data = [
            'admin_name' => $request->admin_name,
            'admin_email' => $request->admin_email,
            'admin_password' => md5($request->admin_password), // Mã hóa mật khẩu
            'admin_phone' => $request->admin_phone,
        ];

        DB::table('tbl_admin')->where('admin_id', $id)->update($data);

        return redirect('/edit-admin')->with('message', 'Cập nhật thông tin thành công!');
    }





}
