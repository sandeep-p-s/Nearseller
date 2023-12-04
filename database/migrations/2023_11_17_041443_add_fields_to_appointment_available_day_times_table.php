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
            $table->integer('employee_id')->after('to_time')->nullable()->index();
            $table->string('grace_time')->after('employee_id')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointment_available_day_times', function (Blueprint $table) {
            $table->dropColumn('employee_id');
            $table->dropColumn('grace_time');
        });
    }
};
