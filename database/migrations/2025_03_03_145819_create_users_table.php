<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // ID tự động tăng
            $table->string('name'); // Tên người dùng
            $table->string('email')->unique(); // Email (duy nhất)
            $table->string('password'); // Mật khẩu
            $table->string('phone')->nullable(); // Số điện thoại (có thể null)
            $table->boolean('is_admin')->default(false); // Phân quyền
            $table->timestamps(); // Tạo cột created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
