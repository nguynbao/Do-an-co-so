<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Models\Banner;

class BannerController extends Controller
{
    public function check()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function add_banner()
    {
        $this->check();
        return view('admin.add_banner');
    }
    public function show_banner()
    {
        $this->check();
        $all_banner = DB::table('tbl_banner')
            ->orderBy('banner_id', 'desc')
            ->get();


        return view('admin.manage_banner', compact('all_banner'));
    }
    public function save_banner(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'banner_name' => 'required|string|max:255',
            'banner_desc' => 'required|string',
            'banner_image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'banner_status' => 'required|integer|in:0,1',
        ]);

        if ($validator->fails()) {
            return Redirect::to('add-banner')->withErrors($validator)->withInput();
        }

        $data = [
            'banner_name' => $request->banner_name,
            'banner_desc' => $request->banner_desc,
            'banner_status' => (int) $request->banner_status,
        ];

        if ($request->hasFile('banner_image')) {
            try {
                $image = $request->file('banner_image');
                $image_name = time() . '.' . $image->getClientOriginalExtension();

                // Create directory if it doesn't exist
                $path = public_path('uploads/banners');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                $image->move($path, $image_name);

                $data['banner_image'] = $image_name;
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Lỗi upload ảnh: ' . $e->getMessage());
            }
        } else {
            $data['banner_image'] = null;
        }

        try {
            DB::table('tbl_banner')->insert($data);
            Session::put('message', "Bạn đã thêm banner thành công");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi lưu vào DB: ' . $e->getMessage());
        }

        return Redirect::to('add-banner');
    }

    public function edit_banner($banner_id)
    {
        $this->check();
        $edit_banner = DB::table('tbl_banner')->where('banner_id', $banner_id)->get();
        return view('admin.edit_banner')
            ->with('edit_banner', $edit_banner);
    }

    public function update_banner(Request $request, $banner_id)
    {
        $banner = DB::table('tbl_banner')->where('banner_id', $banner_id)->first();
        if (!$banner) {
            return redirect()->back()->with('error', 'Banner không tồn tại.');
        }

        $data = [
            'banner_name' => $request->banner_name,
            'banner_desc' => $request->banner_desc,
            'banner_status' => (int) $request->banner_status,
        ];

        if ($request->hasFile('banner_image')) {
            if (!empty($banner->banner_image)) {
                $old_image_path = public_path('uploads/banners/' . $banner->banner_image);
                if (file_exists($old_image_path)) {
                    unlink($old_image_path);
                }
            }

            $image = $request->file('banner_image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();

            $path = public_path('uploads/banners');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $image->move($path, $image_name);

            $data['banner_image'] = $image_name;
        }

        DB::table('tbl_banner')->where('banner_id', $banner_id)->update($data);

        return Redirect::to('/manage-banner')->with('success', 'Cập nhật banner thành công!');
    }
    public function delete_banner($banner_id)
    {
        // Kiểm tra xem danh mục có tồn tại không
        $banner = DB::table('tbl_banner')->where('banner_id', $banner_id)->first();
        if (!$banner) {
            return redirect()->back()->with('error', 'Danh mục không tồn tại.');
        }

        // Xóa file ảnh nếu có
        if (!empty($banner->banner_image)) {
            $image_path = public_path('uploads/banners/' . $banner->banner_image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }

        // Xóa danh mục
        DB::table('tbl_banner')->where('banner_id', $banner_id)->delete();

        return redirect()->back()->with('success', 'Xóa danh mục thành công.');
    }
}
