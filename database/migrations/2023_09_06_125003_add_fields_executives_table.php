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
        Schema::table('executives', function (Blueprint $table) {
            $table->unsignedBigInteger('executive_type')->after('executive_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('executives', function (Blueprint $table) {
            $table->dropColumn('executive_type');
        });
    }
};
