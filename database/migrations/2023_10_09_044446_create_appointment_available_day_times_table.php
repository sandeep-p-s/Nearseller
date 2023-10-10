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
        Schema::create('appointment_available_day_times', function (Blueprint $table) {
            $table->id();
            $table->integer('appointment_id')->nullable();
            $table->integer('is_set_time')->nullable();
            $table->string('appt_days')->nullable();
            $table->string('from_time')->nullable();
            $table->string('to_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_available_day_times');
    }
};
