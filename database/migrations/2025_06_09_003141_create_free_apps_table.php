<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreeAppsTable extends Migration
{
    public function up()
    {
        Schema::create('free_apps', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->string('category', 255);
            $table->string('image')->nullable();
            $table->integer('downloads_count')->default(0);
            $table->string('external_link', 255)->nullable();
            $table->string('status', 50)->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('free_apps');
    }
}