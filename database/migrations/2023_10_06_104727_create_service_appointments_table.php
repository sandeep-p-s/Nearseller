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
        Schema::create('service_appointments', function (Blueprint $table) {
            $table->id();
            $table->date('available_from_date')->nullable()->index();
            $table->date('available_to_date')->nullable()->index();
            $table->integer('is_not_available')->nullable()->index();
            $table->longtext('not_available_dates')->nullable();
            $table->longtext('working_hours')->nullable();
            $table->integer('service_id')->nullable()->index();
            $table->integer('employee_id')->nullable()->index();
            $table->longtext('suggestion')->nullable();
            $table->string('service_point')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_appointments');
    }
};
