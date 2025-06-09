<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreeAppUserTable extends Migration
{
    public function up()
    {
        Schema::create('free_app_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('free_app_id')->constrained('free_apps')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('downloaded_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('free_app_user');
    }
}