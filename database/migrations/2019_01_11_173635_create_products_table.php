<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('url_id');
            $table->string('title')->nullable();
            $table->text('image')->nullable();
            $table->longText('description')->nullable();
            $table->string('currency')->nullable();
            $table->float('ammount')->nullable();
            $table->timestamps();

            $table->foreign('url_id')->references('id')->on('urls')->onUpdate('cascade')->onDelete('cascade');
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
