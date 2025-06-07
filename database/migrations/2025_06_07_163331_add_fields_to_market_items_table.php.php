<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('market_items', function (Blueprint $table) {
            $table->decimal('price_ngn', 10, 2)->nullable()->after('price');
            $table->string('image')->nullable()->after('price_ngn');
            $table->string('external_link')->nullable()->after('image');
            $table->enum('status', ['active', 'pending'])->default('active')->after('external_link');
        });
    }

    public function down(): void
    {
        Schema::table('market_items', function (Blueprint $table) {
            $table->dropColumn(['image', 'external_link', 'status', 'price_ngn']);
        });
    }
};

// This migration adds 'image', 'external_link', and 'status' fields to the 'market_items' table.
// The 'image' field is a string that can be null, allowing for optional image links.
// The 'external_link' field is also a string that can be null, allowing for optional external links.
// The 'status' field is an enum with two possible values: 'active' and 'pending', defaulting to 'active'.
// The 'up' method defines the changes to be made when the migration is run, while the 'down' method defines how to revert those changes if needed.
// This migration is useful for enhancing the 'market_items' table with additional fields that can help in managing items more effectively, such as linking to images and external resources, and tracking the status of each item.
