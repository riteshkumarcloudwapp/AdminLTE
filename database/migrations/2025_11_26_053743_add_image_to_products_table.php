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
        // Change image column from string to text (to store multiple image names)
        Schema::table('products', function (Blueprint $table) {
           $table->text('image')->nullable()->change();
        }
        );
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
             // Revert back to string if migrated down
        $table->string('image')->nullable()->change();
        });
    }
};
