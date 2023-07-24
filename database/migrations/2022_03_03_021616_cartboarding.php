<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cartboarding extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_boarding', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cart_id');
            $table->unsignedBigInteger('boarding_id');
            $table->bigInteger('boarding_price')->nullable();
            $table->string('boarding_name')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('user_name')->nullable();
            $table->string('user_phone')->nullable();
            $table->string('user_email')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->date('created_at');
            $table->integer('store_id');
            $table->string('store_add');
            $table->unsignedInteger('pet_id');
            $table->string('pet_name');
            $table->string('total_pet');
            $table->string('status')->nullable();
            $table->string('total_price')->nullable();
            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');
            $table->foreign('boarding_id')->references('id')
            ->on('boarding')->onDelete('cascade');
            $table->foreign('pet_id')->references('id')
            ->on('pet')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_boarding');
    }
}
