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
        Schema::create('open_close_day_times', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable()->index();
            $table->integer('is_set_time')->nullable();
            $table->string('open_close_days',25)->nullable();
            $table->string('from_time',25)->nullable();
            $table->string('to_time',25)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('open_close_day_times');
    }
};
