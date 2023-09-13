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
        Schema::create('shop_offers', function (Blueprint $table) {
            $table->id();
            $table->string('offer_to_display')->nullable();
            $table->longText('conditions')->nullable();
            $table->dateTime('from_date_time');
            $table->dateTime('to_date_time');
            $table->string('offer_image')->nullable();
            $table->string('status')->default('Y')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_offers');
    }
};
