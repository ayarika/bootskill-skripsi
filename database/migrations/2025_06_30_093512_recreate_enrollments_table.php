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
        Schema::dropIfExists('enrollments'); 

        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('bootcamp_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('email');
            $table->string('payment_proof');

            $table->timestamps();

            $table->foreign('bootcamp_id')->references('id')->on('bootcamps')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
