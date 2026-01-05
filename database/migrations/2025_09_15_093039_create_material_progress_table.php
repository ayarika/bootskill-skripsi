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
        Schema::create('material_progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enroll_id');
            $table->string('material_key');
            $table->boolean('completed')->default(false);
            $table->timestamps();

            $table->foreign('enroll_id')
                ->references('id')->on('enrollments')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_progress');
    }
};
