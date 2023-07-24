<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Todos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('admin_up');
            $table->string('notes');
            $table->boolean('check');
            $table->date('upload_time');
            $table->date('start_time');
            $table->date('end_time');
            $table->date('done_time')->nullable();
            $table->unsignedBigInteger('admin_do');
            $table->foreign('admin_up')->references('id')
            ->on('users')->onDelete('cascade');
            $table->foreign('admin_do')->references('id')
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
        Schema::dropIfExists('todos');
    }
}
