<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Reverse the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('product_images')) {
            Schema::dropIfExists('product_images');
        }
    }

    public function down(): void
    {
        // no-op: table recreation handled by previous migration files (if desired)
    }
};
