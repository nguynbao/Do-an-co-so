<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
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
    public function add_product()
    {
        $this->check();
        $cate_product = DB::table('category_product')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('brand_product')->orderBy('brand_id', 'desc')->get();
        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);

    }
    public function all_product()
    {
        $this->check();
        $all_product = DB::table('tbl_product')
            ->Join('category_product', 'category_product.category_id', '=', 'tbl_product.category_id')
            ->Join('brand_product', 'brand_product.brand_id', '=', 'tbl_product.brand_id')
            ->select('tbl_product.*', 'category_product.category_name', 'brand_product.brand_name')
            ->get();

        return view('admin.all_product', compact('all_product'));

    }
    public function save_product(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
            'product_desc' => 'required|string',
            'product_content' => 'required|string',
            'product_price' => 'required|numeric|min:0', // Chỉ nhận số >= 0
            'product_size' => 'nullable|string',
            'product_image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'product_status' => 'required|integer|in:0,1',
        ]);

        if ($validator->fails()) {
            return Redirect::to('add-product')->withErrors($validator)->withInput();
        }

        $data = [
            'category_id' => $request->product_category,
            'brand_id' => $request->product_brand,
            'product_name' => $request->product_name,
            'product_desc' => $request->product_desc,
            'product_price' => (float) $request->product_price, // Chuyển về số
            'product_size' => $request->product_size,
            'product_content' => $request->product_content,
            'product_status' => (int) $request->product_status,
        ];


        // Xử lý upload hình ảnh
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $image_name);
            $data['product_image'] = $image_name;
        } else {
            $data['product_image'] = ""; // Nếu không có ảnh
        }

        // Thêm dữ liệu vào database
        DB::table('tbl_product')->insert($data);
        Session::put('message', "Bạn đã thêm sản phẩm thành công");

        return Redirect::to('add-product');
    }
    public function unactive($product_id)
    {
        if (!$product_id) {
            return redirect()->back()->with('error', 'Không tìm thấy ID danh mục!');
        }

        DB::table('tbl_product')
            ->where('product_id', $product_id)
            ->update(['product_status' => 1]);

        return redirect('all-product')->with('success', 'Danh mục đã ẩn thành công!');
    }
    public function active($product_id)
    {
        if (!$product_id) {
            return redirect()->back()->with('error', 'Không tìm thấy ID danh mục!');
        }

        DB::table('tbl_product')
            ->where('product_id', $product_id)
            ->update(['product_status' => 0]);

        return redirect('all-product')->with('success', 'Danh mục đã hiển thị!');
    }
    public function edit_product($product_id)
    {
        $this->check();
        $edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get();
        $cate_product = DB::table('category_product')->get();
        $brand_product = DB::table('brand_product')->get();

        return view('admin.edit_product')
            ->with('edit_product', $edit_product)
            ->with('cate_product', $cate_product)
            ->with('brand_product', $brand_product);
    }

    public function update_product(Request $request, $product_id)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_size'] = $request->product_size;
        $data['product_price'] = $request->product_price;
        $data['product_content'] = $request->product_content;
        $data['product_desc'] = $request->product_desc;
        $data['product_status'] = $request->product_status;
        $data['category_id'] = $request->product_category;
        $data['brand_id'] = $request->product_brand;

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $image_name);
            $data['product_image'] = $image_name;
        }

        DB::table('tbl_product')->where('product_id', $product_id)->update($data);

        Session::put('message', 'Cập nhật sản phẩm thành công!');
        return Redirect::to('/all-product');
    }
    public function delete_product($product_id)
    {
        // Kiểm tra xem danh mục có tồn tại không
        $product = DB::table('tbl_product')->where('product_id', $product_id)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Danh mục không tồn tại.');
        }

        // Xóa danh mục
        DB::table('tbl_product')->where('product_id', $product_id)->delete();

        return redirect()->back()->with('success', 'Xóa danh mục thành công.');
    }

    public function show_product($product_id)
    {
        $banner = Banner::orderBy('banner_id', 'desc')->take(3)->get();
        $cate_product = DB::table('category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();
        $details_product = DB::table('tbl_product')
            ->Join('category_product', 'category_product.category_id', '=', 'tbl_product.category_id')
            ->Join('brand_product', 'brand_product.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_product.product_id', $product_id)
            ->limit(1)->get();
        foreach ($details_product as $key => $value) {
            $category_id = $value->category_id;
        }
        $related_product = DB::table('tbl_product')
            ->Join('category_product', 'category_product.category_id', '=', 'tbl_product.category_id')
            ->Join('brand_product', 'brand_product.brand_id', '=', 'tbl_product.brand_id')
            ->where('category_product.category_id', $category_id)->whereNotIn('tbl_product.product_id', [$product_id])
            ->take(3)
            ->get();

        return view('pages.product.product-details')->with('category', $cate_product)->with('brand', $brand_product)->with('details_product', $details_product)->with('related_product', $related_product)->with('banner', $banner);
    }

}
