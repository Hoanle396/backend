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
        Schema::create('products', function (Blueprint $table) {
            $table->increments("product_id");
            $table->string("product_name",100);
            $table->string("product_description",255);
            $table->string("product_image",255);
            $table->integer("product_price");
            $table->string("product_origin",255);
            $table->string("product_manufacturer",255);
            $table->integer("product_discount");
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
        Schema::dropIfExists('products');
    }
};
