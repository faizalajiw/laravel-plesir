<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('place_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('senin')->nullable();
            $table->integer('selasa')->nullable();
            $table->integer('rabu')->nullable();
            $table->integer('kamis')->nullable();
            $table->integer('jumat')->nullable();
            $table->integer('sabtu')->nullable();
            $table->integer('minggu')->nullable();
            $table->integer('total_hari')->nullable();
            $table->timestamps();

            // relationship 
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('place_id')->references('id')->on('places');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitors');
    }
};
