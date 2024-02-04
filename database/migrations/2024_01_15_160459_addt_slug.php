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
        Schema::table('public_recipe_leftovers', function (Blueprint $table) {
            $table->string('slug', 500)->unique()->nullable();
        });

        Schema::table('public_announcements', function (Blueprint $table) {
            $table->string('slug', 500)->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('public_recipe_leftovers', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('public_announcements', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
