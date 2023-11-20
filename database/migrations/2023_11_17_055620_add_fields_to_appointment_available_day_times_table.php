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
        Schema::table('appointment_available_day_times', function (Blueprint $table) {
            $table->integer('service_id')->nullable()->after('grace_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointment_available_day_times', function (Blueprint $table) {
            $table->dropColumn('service_id');
        });
    }
};
