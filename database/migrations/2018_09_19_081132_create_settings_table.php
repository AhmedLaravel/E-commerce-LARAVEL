<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sitename_ar');
            $table->string('sitename_en');
            $table->string('time_to_deliver');
            $table->string('logo')->nullable();
            $table->string('icon')->nullable();
            $table->string('mail')->nullable();
            $table->string('main_currency');
            $table->string('dollar_egypt');
            $table->string('euro_egypt');
            $table->string('address1');
            $table->string('address2');
            $table->string('country');
            $table->string('phone');
            $table->string('fax');
            $table->string('manager')->nullable();
            $table->string('wish')->nullable();
            $table->string('insta')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('site_admin')->nullable();
            $table->string('main_lang')->default('ar');
            $table->longtext('description');
            $table->longtext('keywords')->nullable();
            $table->longtext('about_us')->nullable();
            $table->enum('status',['opened', 'closed'])->default('opened');
            $table->longtext('message_maintenance')->nullable();
            $table->timestamps();
        });
    }
    /*




    */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
