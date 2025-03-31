<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_product', function (Blueprint $table) {
            $table->increments('product_id'); // Khóa chính, tự tăng

            $table->integer('brand_id')->unsigned(); // ID thương hiệu
            $table->integer('category_id')->unsigned(); // ID danh mục
            $table->text('product_name');
            $table->text('product_desc'); // Mô tả sản phẩm
            $table->text('product_content'); // Nội dung chi tiết sản phẩm
            $table->decimal('product_price', 10, 2); // Giá sản phẩm (vd: 99999.99)
            $table->string('product_image'); // Ảnh sản phẩm
            $table->string('product_size')->nullable(); // Kích thước sản phẩm (nullable nếu không bắt buộc)
            $table->string('product_color')->nullable(); // Màu sắc sản phẩm (nullable nếu không bắt buộc)
            $table->boolean('product_status')->default(1); // Trạng thái sản phẩm (1: active, 0: inactive)

            $table->timestamps(); // Tạo 2 cột `created_at` và `updated_at`
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_product');
    }
};
