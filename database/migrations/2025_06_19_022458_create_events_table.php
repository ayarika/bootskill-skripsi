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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organizer_id');
            $table->string('title');
            $table->text('description');
            $table->string('image_path')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->string('evaluation_test_url')->nullable();
            $table->string('group_url')->nullable();
            $table->integer('price')->nullable();
            $table->string('evaluation_event_url')->nullable();
            $table->string('meeting_link')->nullable();
            $table->timestamps();

            $table->foreign('organizer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
