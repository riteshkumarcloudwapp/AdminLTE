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
        Schema::table('admins', function (Blueprint $table) {
        // If created_at exists, drop it first
        if (Schema::hasColumn('admins', 'created_at')) {
            $table->dropColumn('created_at');
        }

        if (Schema::hasColumn('admins', 'updated_at')) {
            $table->dropColumn('updated_at');
        }

        // Now add timestamps properly
        $table->timestamp('created_at')->nullable()->after('deleted_at');
        $table->timestamp('updated_at')->nullable()->after('created_at');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            //
        });
    }
};
