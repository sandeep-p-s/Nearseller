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
        Schema::table('offers', function (Blueprint $table) {
            $table->string('approval_status',1)->default('N')->after('status')->nullable();
            $table->dateTime('approved_time')->after('approval_status')->nullable();
            $table->string('approved_by')->after('approved_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn('approval_status');
            $table->dropColumn('approved_time');
            $table->dropColumn('approved_by');
        });
    }
};
