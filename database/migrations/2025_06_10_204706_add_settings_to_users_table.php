<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'theme')) {
                $table->string('theme')->default('dark')->after('email');
            }
            if (!Schema::hasColumn('users', 'notifications')) {
                $table->boolean('notifications')->default(true)->after('theme');
            }
            if (!Schema::hasColumn('users', 'language')) {
                $table->string('language')->default('en')->after('notifications');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['theme', 'notifications', 'language']);
        });
    }
};