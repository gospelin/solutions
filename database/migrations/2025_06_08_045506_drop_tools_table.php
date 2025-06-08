<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::dropIfExists('tools');
    }

    public function down()
    {
        // Optionally recreate tools table if needed for rollback
    }
};
