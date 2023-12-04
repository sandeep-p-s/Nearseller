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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable()->comment("1 -> Shop ,2 -> Service")->index();
            $table->string('offer_to_display')->nullable()->index();
            $table->longText('conditions')->nullable();
            $table->dateTime('from_date_time')->index();
            $table->dateTime('to_date_time')->index();
            $table->string('offer_image')->nullable()->index();
            $table->integer('status')->default(1)->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
