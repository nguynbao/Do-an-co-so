<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Banner;

class CartController extends Controller
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

    public function check_coupon(Request $request)
    {
        $coupon_code = $request->coupon;

        // Tìm mã giảm giá trong cơ sở dữ liệu
        $coupon = DB::table('coupons')->where('coupon_name', $coupon_code)->first();

        if (!$coupon) {
            return redirect()->back()->with('error', 'Mã giảm giá không tồn tại!');
        }

        // Kiểm tra số lượng mã giảm giá còn lại
        if ($coupon->coupon_quantity <= 0) {
            return redirect()->back()->with('error', 'Mã giảm giá đã hết lượt sử dụng!');
        }

        // Kiểm tra ngày hết hạn (nếu có)
        if ($coupon->coupon_date && strtotime($coupon->coupon_date) < strtotime(now())) {
            return redirect()->back()->with('error', 'Mã giảm giá đã hết hạn!');
        }

        // Lưu mã giảm giá vào Session
        Session::put('coupon', [
            'name' => $coupon->coupon_name,
            'discount' => $coupon->coupon_desc,
            'id' => $coupon->coupon_id
        ]);

        // Giảm số lượng mã giảm giá đi 1
        DB::table('coupons')
            ->where('coupon_id', $coupon->coupon_id)
            ->update(['coupon_quantity' => $coupon->coupon_quantity - 1]);

        return redirect()->back()->with('success', 'Áp dụng mã giảm giá thành công!');
    }

    public function remove_coupon()
    {
        Session::forget('coupon');
        return redirect()->back()->with('success', 'Đã xóa mã giảm giá!');
    }

    public function addToCart(Request $request)
    {
        // Lấy danh mục sản phẩm và thương hiệu để hiển thị trên trang giỏ hàng
        $cate_product = DB::table('category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

        // Lấy product_id và số lượng từ request
        $productid = $request->productid_hidden;
        $quantity = $request->qty ?? 1; // Mặc định là 1 nếu không có giá trị

        // Lấy thông tin sản phẩm từ database
        $product = DB::table('tbl_product')->where('product_id', $productid)->first();


        // Kiểm tra nếu sản phẩm không tồn tại
        if (!$product) {
            return Redirect::back()->with('error', 'Sản phẩm không tồn tại!');
        }
        // Lấy giỏ hàng hiện tại từ session
        $cart = Session()->get('cart', []);
        // Kiểm tra nếu sản phẩm đã có trong giỏ hàng
        if (isset($cart[$productid])) {
            $cart[$productid]['quantity'] += $quantity;
        } else {
            // Thêm sản phẩm mới vào giỏ hàng
            $cart[$productid] = [
                "id" => $product->product_id,
                "name" => $product->product_name,
                "price" => $product->product_price,
                "image" => $product->product_image,
                "quantity" => $quantity
            ];
        }

        // Lưu giỏ hàng vào Session
        Session()->put('cart', $cart);
        Session()->save();

        return Redirect('/show-cart');
    }
    public function show_cart()
    {
        $banner = Banner::orderBy('banner_id', 'desc')->take(3)->get();
        $cate_product = DB::table('category_product')
            ->where('category_status', '0')
            ->orderBy('category_id', 'desc')
            ->get();

        $brand_product = DB::table('brand_product')
            ->where('brand_status', '0')
            ->orderBy('brand_id', 'desc')
            ->get();

        // Lấy giỏ hàng từ Session
        $cart = Session()->get('cart', []);

        // Tính tổng tiền
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Kiểm tra nếu có mã giảm giá
        $coupon_info = null;
        $discount = 0;
        if (Session::has('coupon')) {
            $coupon_info = Session::get('coupon');
            $discount = $coupon_info['discount'];
        }

        $final_total = max(0, $total - $discount); // Tổng tiền sau giảm giá

        return view('pages.cart.cart_product')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('cart', $cart)
            ->with('total', $total)
            ->with('discount', $discount)
            ->with('final_total', $final_total)
            ->with('coupon_info', $coupon_info)
            ->with('banner', $banner);
    }
    public function dalete_cart($product_id)
    {
        $cart = Session()->get('cart', []);

        // Kiểm tra nếu sản phẩm có tồn tại trong giỏ hàng
        if (isset($cart[$product_id])) {
            unset($cart[$product_id]); // Xóa sản phẩm khỏi giỏ hàng
            Session()->put('cart', $cart); // Cập nhật lại Session
        }

        return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng');
    }
    public function updateCart($id, $action)
    {
        $cart = Session()->get('cart');

        if (isset($cart[$id])) {
            if ($action == 'increase') {
                $cart[$id]['quantity'] += 1;
            } elseif ($action == 'decrease') {
                if ($cart[$id]['quantity'] > 1) {
                    $cart[$id]['quantity'] -= 1;
                } else {
                    unset($cart[$id]); // Nếu số lượng = 0 thì xóa luôn sản phẩm
                }
            }
            Session()->put('cart', $cart);
        }

        return redirect()->back();
    }

    //coupon
    public function add_coupon()
    {
        $this->check();
        return view('admin.add_coupon');
    }
    public function show_coupon()
    {
        $this->check();
        $all_coupon = DB::table('coupons')->get();
        $manager = view('admin.manage_coupon')->with('all_coupon', $all_coupon);
        return view('admin_layout')->with('admin.manage_coupon', $manager);
    }
    public function save_coupon(Request $request)
    {
        $data = array();
        $data['coupon_name'] = $request->coupon_name;
        $data['coupon_desc'] = $request->coupon_desc;
        $data['coupon_date'] = $request->coupon_date;
        $data['coupon_quantity'] = $request->coupon_quantity;
        // $data['category_status'] = $request->cate_product_status;
        DB::table('coupons')->insert($data);
        Session::put('message', "Bạn đã thêm danh mục thành công");
        return Redirect::to('add-coupon');
    }
    public function edit_coupon($coupon_id)
    {
        $this->check();
        $edit_coupon = DB::table('coupons')->where('coupon_id', $coupon_id)->get();
        $manager = view('admin.edit_coupon')->with('edit_coupon', $edit_coupon);

        return view('admin_layout')->with('admin.edit_coupon', $manager);
    }
    public function update_coupon(Request $request, $coupon_id)
    {
        $data = array();
        $data['coupon_name'] = $request->coupon_name;
        $data['coupon_desc'] = $request->coupon_desc;
        $data['coupon_date'] = $request->coupon_date;
        $data['coupon_quantity'] = $request->coupon_quantity;
        DB::table('coupons')->where('coupon_id', $coupon_id)->update($data);
        return Redirect::to('all-coupon');
    }
    public function delete_coupon($coupon_id)
    {
        $coupon = DB::table('coupons')->where('coupon_id', $coupon_id)->first();
        if (!$coupon) {
            return redirect()->back()->with('error', 'Danh mục không tồn tại.');
        }

        // Xóa danh mục
        DB::table('coupons')->where('coupon_id', $coupon_id)->delete();

        return redirect()->back()->with('success', 'Xóa danh mục thành công.');
    }
}
