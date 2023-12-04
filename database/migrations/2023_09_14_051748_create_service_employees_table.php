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
        Schema::create('service_employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_name')->nullable()->index();
            $table->string('employee_id')->nullable()->index();
            $table->string('designation')->nullable();
            $table->date('joining_date')->nullable()->index();
            $table->bigInteger('aadhar_no')->nullable()->index();
            $table->longText('permanent_address')->nullable();
            $table->string('district')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('pincode')->nullable();
            $table->longText('present_address')->nullable();
            $table->string('present_district')->nullable();
            $table->string('present_state')->nullable();
            $table->string('present_country')->nullable();
            $table->string('present_pincode')->nullable();
            $table->string('image')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_employees');
    }
};
