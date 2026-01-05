<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('organizer_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('organizer_id')->references('id')->on('organizers')->onDelete('cascade');

            $table->unique(['user_id', 'organizer_id']); // This is for preventing duplicate entries
        });
    }

    public function down()
    {
        Schema::dropIfExists('favorites');
    }
}