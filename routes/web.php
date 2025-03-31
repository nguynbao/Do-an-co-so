<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\BannerController;

use Illuminate\Support\Facades\Route;

// Apply the web middleware group to ensure session persistence
Route::middleware(['web'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/trang-chu', [HomeController::class, 'index']);
    Route::post('/search', [HomeController::class, 'search']);
    Route::get('/show-contact', [HomeController::class, 'show_contact']);

    //danh muc

    Route::get('/danh-muc-sp/{category_id}', [CategoryProductController::class, 'show_cate']);
    Route::get('/thuong-hieu-sp/{brand_id}', [BrandProduct::class, 'show_brand']);
    Route::get('/chi-tiet-san-pham/{product_id}', [ProductController::class, 'show_product']);

    //Login facebook
    Route::get('/login-facebook', [AdminController::class, 'login_facebook']);
    Route::get('/admin/callback', [AdminController::class, 'callback_facebook']);

    // Admin
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
    Route::get('/logout', [AdminController::class, 'logout']);
    Route::post('/dashboard', [AdminController::class, 'login'])->name('admin.dashboard');
    Route::get('/show-info-admin', [AdminController::class, 'show_info_admin']);
    Route::get('/edit-admin', [AdminController::class, 'edit_admin'])->name('edit_admin');
    Route::post('/update-admin/{id}', [AdminController::class, 'update_admin'])->name('update_admin');



    // CategoryProductController
    Route::get('/add-category-product', [CategoryProductController::class, 'add_category_product']);
    Route::get('/edit-category-product/{category_id}', [CategoryProductController::class, 'edit_category_product']);
    Route::get('/delete-category-product/{category_id}', [CategoryProductController::class, 'delete_category_product']);
    Route::get('/all-category-product', [CategoryProductController::class, 'all_category_product']);
    Route::post('/save-category', [CategoryProductController::class, 'save_category']);
    Route::post('/update-category/{category_id}', [CategoryProductController::class, 'update_category']);
    Route::get('/unactive-category-product/{category_id}', [CategoryProductController::class, 'unactive']);
    Route::get('/active-category-product/{category_id}', [CategoryProductController::class, 'active']);

    // BrandProductController
    Route::get('/add-brand-product', [BrandProduct::class, 'add_brand_product']);
    Route::get('/edit-brand-product/{brand_id}', [BrandProduct::class, 'edit_brand_product']);
    Route::get('/delete-brand-product/{brand_id}', [BrandProduct::class, 'delete_brand_product']);
    Route::get('/all-brand-product', [BrandProduct::class, 'all_brand_product']);
    Route::post('/save-brand', [BrandProduct::class, 'save_brand']);
    Route::post('/update-brand/{brand_id}', [BrandProduct::class, 'update_brand']);
    Route::get('/unactive-brand-product/{brand_id}', [BrandProduct::class, 'unactive']);
    Route::get('/active-brand-product/{brand_id}', [BrandProduct::class, 'active']);

    // ProductController
    Route::get('/add-product', [ProductController::class, 'add_product']);
    Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product']);
    Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product']);
    Route::get('/all-product', [ProductController::class, 'all_product']);
    Route::post('/save-product', [ProductController::class, 'save_product']);
    Route::post('/update-product/{product_id}', [ProductController::class, 'update_product']);
    Route::get('/unactive-product/{product_id}', [ProductController::class, 'unactive']);
    Route::get('/active-product/{product_id}', [ProductController::class, 'active']);
    //cart
    Route::post('/add-cart', [CartController::class, 'addToCart']);
    Route::get('/show-cart', [CartController::class, 'show_cart'])->name('show-cart');
    Route::get('/xoa-cart/{product_id}', [CartController::class, 'dalete_cart']);
    Route::get('/update-cart/{id}/{action}', [CartController::class, 'updateCart']);
    //coupon
    Route::post('/check-coupon', [cartController::class, 'check_coupon']);
    Route::get('/remove-coupon', [CartController::class, 'remove_coupon']);
    Route::get('/manage-coupon', [cartController::class, 'show_coupon']);
    Route::get('/add-coupon', [cartController::class, 'add_coupon']);
    Route::get('/edit-coupon/{coupon_id}', [cartController::class, 'edit_coupon']);
    Route::get('/delete-coupon/{coupon_id}', [cartController::class, 'delete_coupon']);
    Route::post('/save-coupon', [cartController::class, 'save_coupon']);
    Route::post('/update-coupon/{coupon_id}', [cartController::class, 'update_coupon']);

    //checkout
    Route::get('/login-checkout', [CheckOutController::class, 'login_checkout']);
    Route::post('/login', [CheckOutController::class, 'login']);
    Route::post('/add-user', [CheckOutController::class, 'add_user']);
    Route::post('/register', [CheckOutController::class, 'register']);
    Route::get('/logout', [CheckOutController::class, 'logout']);
    Route::get('/checkout', [CheckOutController::class, 'checkout'])->name('checkout');
    Route::post('/save-checkout', [CheckOutController::class, 'save_checkout'])->name('save.checkout');
    Route::post('/process-payment', [CheckOutController::class, 'process_payment']);
    Route::get('/order-complete', [CheckOutController::class, 'order_complete']);
    Route::get('/manage-order', [CheckOutController::class, 'show_order']);
    Route::get('/confirm-order/{order_id}', [CheckOutController::class, 'confirm_order']);
    Route::get('/manage-customer', [CheckOutController::class, 'show_customer']);
    Route::get('/delete-customer/{customer_id}', [CheckOutController::class, 'delete_customer']);
    Route::get('/edit-customer/{customer_id}', [CheckOutController::class, 'edit_customer']);
    Route::post('/update-customer/{customer_id}', [CheckOutController::class, 'update_customer']);

    //Banner
    Route::get('/manage-banner', [BannerController::class, 'show_banner']);
    Route::get('/add-banner', [BannerController::class, 'add_banner']);
    Route::post('/save-banner', [BannerController::class, 'save_banner']);
    Route::get('/delete-banner/{banner_id}', [BannerController::class, 'delete_banner']);
    Route::get('/edit-banner/{banner_id}', [BannerController::class, 'edit_banner']);
    Route::post('/update-banner/{banner_id}', [BannerController::class, 'update_banner']);

});
