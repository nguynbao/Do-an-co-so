<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Banner;


class CategoryProductController extends Controller
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
    public function add_category_product()
    {
        $this->check();
        return view('admin.add_cate');

    }
    public function all_category_product()
    {
        $this->check();
        $all_category_product = DB::table('category_product')->get();
        $manager = view('admin.all_cate')->with('all_category_product', $all_category_product);

        return view('admin_layout')->with('admin.all_cate', $manager);
    }
    public function save_category(Request $request)
    {
        $data = array();
        $data['category_name'] = $request->cate_product_name;
        $data['category_desc'] = $request->cate_product_desc;
        $data['category_status'] = $request->cate_product_status;
        DB::table('category_product')->insert($data);
        Session::put('message', "Bạn đã thêm danh mục thành công");
        return Redirect::to('add-category-product');
    }
    public function unactive($category_id)
    {
        if (!$category_id) {
            return redirect()->back()->with('error', 'Không tìm thấy ID danh mục!');
        }

        DB::table('category_product')
            ->where('category_id', $category_id)
            ->update(['category_status' => 1]);

        return redirect('all-category-product')->with('success', 'Danh mục đã ẩn thành công!');
    }

    public function active($category_id)
    {
        if (!$category_id) {
            return redirect()->back()->with('error', 'Không tìm thấy ID danh mục!');
        }

        DB::table('category_product')
            ->where('category_id', $category_id)
            ->update(['category_status' => 0]);

        return redirect('all-category-product')->with('success', 'Danh mục đã hiển thị!');
    }
    public function edit_category_product($category_id)
    {
        $this->check();
        $edit_category_product = DB::table('category_product')->where('category_id', $category_id)->get();
        $manager = view('admin.edit_cate')->with('edit_category_product', $edit_category_product);

        return view('admin_layout')->with('admin.edit_cate', $manager);
    }
    public function update_category(Request $request, $category_id)
    {
        $data = array();
        $data['category_name'] = $request->cate_product_name;
        $data['category_desc'] = $request->cate_product_desc;
        DB::table('category_product')->where('category_id', $category_id)->update($data);
        return Redirect::to('all-category-product');

    }
    public function delete_category_product($category_id)
    {
        $category = DB::table('category_product')->where('category_id', $category_id)->first();
        if (!$category) {
            return redirect()->back()->with('error', 'Danh mục không tồn tại.');
        }

        // Xóa danh mục
        DB::table('category_product')->where('category_id', $category_id)->delete();

        return redirect()->back()->with('success', 'Xóa danh mục thành công.');
    }

    public function show_cate($category_id)
    {
        $banner = Banner::orderBy('banner_id', 'desc')->take(4)->get();
        $cate_product = DB::table('category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

        $category_by_id = DB::table('tbl_product')->join('category_product', 'tbl_product.category_id', '=', 'category_product.category_id')
            ->where('tbl_product.category_id', '=', $category_id)->get();
        $cate_name = DB::table('category_product')->where('category_product.category_id', $category_id)->limit(1)->get();
        return view('pages.category.show_category')->with('category', $cate_product)->with('brand', $brand_product)->with('category_by_id', $category_by_id)->with('cate_name', $cate_name)->with('banner', $banner);
    }
}
