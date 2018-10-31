<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnRecievesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('on_recieves', function (Blueprint $table) {
            $table->increments('id');
            $table->string('billing_country');
            $table->longtext('cart_content');
            $table->double('total');
            $table->string('billing_first_name');
            $table->string('billing_company');
            $table->string('billing_address_1');
            $table->string('billing_city');
            $table->string('billing_address_2');
            $table->string('billing_state');
            $table->string('billing_postcode');
            $table->string('billing_email');
            $table->string('billing_phone');
            $table->string('currency');
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
        Schema::dropIfExists('on_recieves');
    }
}
/*








*/