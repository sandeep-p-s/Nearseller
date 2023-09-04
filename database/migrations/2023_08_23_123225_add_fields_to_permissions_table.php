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
        Schema::table('permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_created_by')->default(0)->index()->after('description');
            $table->unsignedBigInteger('permission_last_updated_by')->default('0')->index()->after('permission_created_by');
            $table->tinyInteger('is_deleted')->default(0)->after('permission_last_updated_by');
            $table->integer('module_id')->index()->default(0)->after('is_deleted');
            $table->tinyInteger("is_disabled")->default(0)->after('module_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('permission_created_by');
            $table->dropColumn('permission_last_updated_by');
            $table->dropColumn('is_deleted');
            $table->dropColumn('module_id');
            $table->dropColumn('is_disabled');
        });
    }
};
