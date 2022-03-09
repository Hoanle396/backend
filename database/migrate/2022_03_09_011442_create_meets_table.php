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
        Schema::create('meets', function (Blueprint $table) {
            $table->increments("meets_id");
            $table->unsignedBigInteger("id");
            $table->foreign('id',)->references('id')->on('services')->onDelete('cascade')->onUpdate('cascade');
            $table->string("service_fullname")->nullable();
            $table->string("service_email")->nullable();
            $table->string("time")->nullable();
            $table->string("date")->nullable();
            $table->text("description")->nullable();
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
        Schema::dropIfExists('meets');
    }
};
