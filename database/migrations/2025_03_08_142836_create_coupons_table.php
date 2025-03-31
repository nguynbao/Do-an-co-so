<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id('coupon_id'); // ID tự động tăng
            $table->string('coupon_name'); // Tên coupon
            $table->date('coupon_date'); // Ngày áp dụng coupon
            $table->integer('coupon_quantity')->default(0); // Thêm số lượng mã
            $table->timestamps(); // Thêm cột created_at, updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('coupons'); // Xóa bảng nếu rollback
    }
};