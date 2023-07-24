<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('pet_id');
            $table->string('name');
            $table->string('thumbnail');
            $table->text('description');
            $table->bigInteger('serial');
            $table->string('manufacturer');
            $table->integer('sale_price');
            $table->integer('import_price');
            $table->integer('quantity');
            $table->foreign('category_id')->references('id')
            ->on('category')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
