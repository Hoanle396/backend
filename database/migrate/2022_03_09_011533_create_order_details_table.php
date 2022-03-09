<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
//            $table->string("order_code");
            $table->string('order_code')->references('code')->on('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->integer("product_id")->references('product-id')->on('products');
            $table->string("product_name");
            $table->string("product_quantity");
            $table->string("user_fullname");
            $table->string('user_email')->references('email')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string("user_phonenumber");
            $table->string("user_address");
            $table->string("user_address2")->nullable();
            $table->string('order_status');
            $table->string("order_pay");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
};
