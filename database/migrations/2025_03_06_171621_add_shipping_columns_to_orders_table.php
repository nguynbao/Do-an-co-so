<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->string('shipping_name')->after('user_id');
            $table->string('shipping_email')->after('shipping_name');
            $table->string('shipping_phone')->after('shipping_email');
            $table->text('shipping_notes')->nullable()->after('shipping_phone');
        });
    }

    public function down()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->dropColumn([
                'shipping_name',
                'shipping_email',
                'shipping_phone',
                'shipping_notes'
            ]);
        });
    }
};
