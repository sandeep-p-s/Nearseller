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
        Schema::table('roles_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('rp_created_by')->default('0')->index()->after('permission_id');
            $table->unsignedBigInteger('rp_last_updated_by')->default('0')->index()->after('rp_created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles_permissions', function (Blueprint $table) {
            $table->dropColumn('rp_created_by');
            $table->dropColumn('rp_last_updated_by');
        });
    }
};
