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
            $table->string('day')->nullable();
            $table->time('hours_start');
            $table->time('hours_end');
            $table->string('social_media')->nullable();
            $table->integer('price')->nullable();
            $table->double('longitude');
            $table->double('latitude');
            $table->timestamps();

            // relationship category
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            // relationship user
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
