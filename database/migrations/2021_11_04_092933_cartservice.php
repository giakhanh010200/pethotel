<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cartservice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("cart_id");
            $table->unsignedBigInteger('user_id');

            $table->string('user_name')->nullable();
            $table->string('user_email')->nullable();
            $table->string('user_phone')->nullable();
            $table->unsignedInteger('service_id');
            $table->string('service_name')->nullable();
            $table->string('service_price')->nullable();
            $table->unsignedInteger('pet_id');
            $table->smallInteger('total_pet');
            $table->date('created_at');
            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');
            $table->foreign('service_id')->references('id')
            ->on('services')->onDelete('cascade');
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
        Schema::dropIfExists('cart_services');
    }
}
