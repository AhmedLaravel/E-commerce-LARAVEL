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
            $table->string('name_ar');
            $table->string('color_name_ar');
            $table->string('color_name_en');
            $table->string('name_en');
            $table->string('catalog')->nullable();
            $table->string('file_name')->nullable();
            $table->string('logo');
            $table->string('color');
            $table->string('brand');
            $table->longtext('description');
            $table->double('price');
            $table->string('model');
            $table->string('shipping_cost')->nullable();
            $table->enum('size',['large','medium','small']);
            $table->string('discount')->nullable();
            $table->string('email')->nullable();
            $table->integer('parent')->unsigned();
            $table->foreign('parent')->references('id')->on('departments')->onDelete('cascade');
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
}
