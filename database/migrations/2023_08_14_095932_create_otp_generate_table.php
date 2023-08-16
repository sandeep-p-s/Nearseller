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
        Schema::create('otp_generate', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('otpmsgtype')->nullable();
            $table->string('otp', 8)->nullable();
            $table->dateTime('created_time')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otp_generate');
    }
};
