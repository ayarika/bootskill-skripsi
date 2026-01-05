<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bootcamps', function (Blueprint $table) {
            $table->id();
            $table->string('title');                         // title bootcamp
            $table->text('description')->nullable();         //desc bootcamp
            $table->unsignedBigInteger('organizer_id');      // Relation to Organizer
            $table->integer('price')->default(0);   // Price: 0 = Free, >0= Paid
            $table->timestamps();

            // Foreign Key ke tabel organizers
            $table->foreign('organizer_id')
                  ->references('id')
                  ->on('organizers')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bootcamps');
    }
};