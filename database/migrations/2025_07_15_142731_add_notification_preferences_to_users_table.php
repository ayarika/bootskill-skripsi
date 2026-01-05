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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('email_notification')->default(true);
            $table->boolean('inapp_notification')->default(false);
            $table->boolean('bootcamp_updates')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('email_notification');
            $table->dropColumn('inapp_notification');
            $table->dropColumn('bootcamp_updates');
        });
    }
};
