<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // NOTE: Running this migration requires doctrine/dbal package to be installed.
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_image')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_image')->nullable(false)->change();
        });
    }
};
