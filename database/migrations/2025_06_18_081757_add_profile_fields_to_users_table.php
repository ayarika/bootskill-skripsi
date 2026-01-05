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
            if (!Schema::hasColumn('users', 'profile_image')) {
            $table->string('profile_image')->nullable();
            }

            if (!Schema::hasColumn('users', 'description')) {
                $table->text('description')->nullable();
            }

            if (!Schema::hasColumn('users', 'social_link')) {
                $table->string('social_link')->nullable();
            }

            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('student');
            }

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'profile_image')) {
                $table->dropColumn('profile_image');
            }

            if (Schema::hasColumn('users', 'description')) {
                $table->dropColumn('description');
            }

            if (Schema::hasColumn('users', 'social_link')) {
                $table->dropColumn('social_link');
            }

            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
        });
    }
};
