<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('avatar')->default('default.png');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('admin')->default(0);
        });

        Schema::create('userfavorites', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_service');
        });

        Schema::create('userappointments', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_service');
            $table->datetime('ap_datetime');
        });


        Schema::create('servicephotos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_service');
            $table->string('url');
        });

        Schema::create('servicereviews', function (Blueprint $table) {
            $table->id();
            $table->integer('id_service');
            $table->float('rate');
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('avatar')->default('03.png');
            $table->float('stars')->default(0);
            $table->float('price');
        });

        Schema::create('servicetestimonials', function (Blueprint $table) {
            $table->id();
            $table->integer('id_service');
            $table->string('name');
            $table->float('rate');
            $table->string('body');
        });

        Schema::create('serviceavailability', function (Blueprint $table) {
            $table->id();
            $table->integer('id_service');
            $table->integer('weekday');
            $table->text('hours');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('userfavorites');
        Schema::dropIfExists('userappointments');
        Schema::dropIfExists('servicephotos');
        Schema::dropIfExists('servicereviews');
        Schema::dropIfExists('services');
        Schema::dropIfExists('servicetestimonials');
        Schema::dropIfExists('serviceavailability');
    }
}
