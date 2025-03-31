<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Banner;
class BrandProduct extends Controller
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
    public function add_brand_product()
    {
        $this->check();
        return view('admin.add_brand');

    }
    public function all_brand_product()
    {
        $this->check();
        $all_brand_product = DB::table('brand_product')->get();
        $manager = view('admin.all_brand')->with('all_brand_product', $all_brand_product);

        return view('admin_layout')->with('admin.all_brand', $manager);
    }
    public function save_brand(Request $request)
    {
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;
        DB::table('brand_product')->insert($data);
        Session::put('message', "Bạn đã thêm Thương hiệu thành công");
        return Redirect::to('add-brand-product');
    }
    public function unactive($brand_id)
    {
        if (!$brand_id) {
            return redirect()->back()->with('error', 'Không tìm thấy ID Thương hiệu!');
        }

        DB::table('brand_product')
            ->where('brand_id', $brand_id)
            ->update(['brand_status' => 1]);

        return redirect('all-brand-product')->with('success', 'Thương hiệu đã ẩn thành công!');
    }

    public function active($brand_id)
    {
        if (!$brand_id) {
            return redirect()->back()->with('error', 'Không tìm thấy ID Thương hiệu!');
        }

        DB::table('brand_product')
            ->where('brand_id', $brand_id)
            ->update(['brand_status' => 0]);

        return redirect('all-brand-product')->with('success', 'Thương hiệu đã hiển thị!');
    }
    public function edit_brand_product($brand_id)
    {
        $this->check();
        $edit_brand_product = DB::table('brand_product')->where('brand_id', $brand_id)->get();
        $manager = view('admin.edit_brand')->with('edit_brand_product', $edit_brand_product);

        return view('admin_layout')->with('admin.edit_brand', $manager);
    }
    public function update_brand(Request $request, $brand_id)
    {
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        DB::table('brand_product')->where('brand_id', $brand_id)->update($data);
        return Redirect::to('all-brand-product');

    }
    public function delete_brand_product($brand_id)
    {
        // Kiểm tra xem Thương hiệu có tồn tại không
        $brand = DB::table('brand_product')->where('brand_id', $brand_id)->first();
        if (!$brand) {
            return redirect()->back()->with('error', 'Thương hiệu không tồn tại.');
        }

        // Xóa Thương hiệu
        DB::table('brand_product')->where('brand_id', $brand_id)->delete();

        return redirect()->back()->with('success', 'Xóa Thương hiệu thành công.');
    }
    public function show_brand($brand_id)
    {
        $banner = Banner::orderBy('banner_id', 'desc')->take(4)->get();
        $cate_product = DB::table('category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();
        $brand_by_id = DB::table('tbl_product')->join('brand_product', 'tbl_product.brand_id', '=', 'brand_product.brand_id')
            ->where('tbl_product.brand_id', '=', $brand_id)->get();
        $br_name = DB::table('brand_product')->where('brand_product.brand_id', $brand_id)->limit(1)->get();
        return view('pages.brand.show_brand')
            ->with('category', $cate_product)->with('brand', $brand_product)->with('brand_by_id', $brand_by_id)->with('br_name', $br_name)->with('banner', $banner);
    }

}
