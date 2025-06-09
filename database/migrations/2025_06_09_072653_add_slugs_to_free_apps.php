<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Migration to add slug column
        Schema::table('free_apps', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('category');
        });

        // Update existing categories with slugs
        DB::table('free_apps')->get()->each(function ($app) {
            DB::table('free_apps')
                ->where('id', $app->id)
                ->update(['slug' => Str::slug($app->category)]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('free_apps', function (Blueprint $table) {
            //
        });
    }
};
