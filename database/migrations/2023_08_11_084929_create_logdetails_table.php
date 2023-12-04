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
        Schema::create('logdetails', function (Blueprint $table) {
            $table->id();
            $table->string('user_id',10)->nullable()->index();
            $table->string('ip_address')->nullable();
            $table->dateTime('log_time')->nullable();
            $table->longText('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logdetails');
    }
};
