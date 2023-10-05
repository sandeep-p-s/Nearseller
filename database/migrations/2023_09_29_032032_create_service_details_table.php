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
        Schema::create('service_details', function (Blueprint $table) {
            $table->id();
            $table->string('service_name', 100)->nullable();
            $table->longText('service_images')->nullable();
            $table->string('is_attribute',10)->nullable();
            $table->string('created_by')->nullable();
            $table->timestamp('created_time')->nullable();
            $table->string('service_status')->default('Y')->nullable();
            $table->string('is_approved',1)->default('N')->nullable();
            $table->string('approved_by',10)->nullable();
            $table->timestamp('approved_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_details');
    }
};
