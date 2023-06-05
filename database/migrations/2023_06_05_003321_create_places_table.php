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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id');
            $table->text('description');
            $table->text('address');
            $table->string('operational_hours');
            $table->string('website');
            $table->string('social_media');
            $table->string('longitude');
            $table->string('latitude');
            $table->timestamps();

            // relationship category
            $table->foreign('category_id')->references('id')->on('categories');

            // relationship user
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places');
    }
};
