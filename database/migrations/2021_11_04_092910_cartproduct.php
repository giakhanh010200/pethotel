<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cartproduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cart_id_render');
            $table->unsignedBigInteger('user_id');
            $table->string('user_name')->nullable();
            $table->string('user_address')->nullable();
            $table->string('user_phone')->nullable();
            $table->string('status');
            $table->date('created_at');
            $table->date('payment_at')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->string('product_name')->nullable();
            $table->string('product_thumbnail')->nullable();
            $table->smallInteger('quantity');
            $table->string('product_price')->nullable();
            $table->string('total_prices')->nullable();
            $table->foreign('product_id')->references('id')
            ->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_product');
    }
}
