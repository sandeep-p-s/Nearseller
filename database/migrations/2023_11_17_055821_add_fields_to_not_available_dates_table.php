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
        Schema::table('not_available_dates', function (Blueprint $table) {
            $table->integer('service_id')->nullable()->after('not_available_date')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('not_available_dates', function (Blueprint $table) {
            $table->dropColumn('service_id');
        });
    }
};
