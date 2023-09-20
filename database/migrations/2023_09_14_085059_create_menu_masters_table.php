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
        Schema::create('menu_masters', function (Blueprint $table) {
            $table->id();
            $table->string('menu_desc')->nullable();
            $table->bigInteger('menu_level_1')->nullable();
            $table->bigInteger('menu_level_2')->nullable();
            $table->bigInteger('menu_level_3')->nullable();
            $table->string('url')->nullable();
            $table->integer('status')->default(1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_masters');
    }
};
