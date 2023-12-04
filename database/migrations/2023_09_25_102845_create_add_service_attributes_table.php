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
        Schema::create('add_service_attributes', function (Blueprint $table) {
            $table->id();
            $table->integer('service_id')->nullable()->index();
            $table->string('attribute_1')->nullable()->index();
            $table->string('attribute_2')->nullable()->index();
            $table->string('attribute_3')->nullable()->index();
            $table->string('attribute_4')->nullable()->index();
            $table->string('call_shop')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_service_attributes');
    }
};
