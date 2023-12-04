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
            $table->string('service_name', 100)->nullable()->index();
            $table->longText('service_images')->nullable();
            $table->string('is_attribute',10)->nullable()->index();
            $table->string('created_by')->nullable();
            $table->timestamp('created_time')->nullable();
            $table->integer('service_status')->default(1)->nullable()->index();
            $table->integer('is_approved')->default(0)->nullable()->index();
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
